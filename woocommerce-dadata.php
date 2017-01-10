<?php
/**
 * Plugin Name:       WooCommerce DaData Support
 * Description:       Поддержка подсказок dadata.ru - быстрый ввод адресов, ФИО и email.
 * Plugin URI:        http://github.com/troyanov/woocommerce-dadata
 * Version:           1.0.0
 *
 * @package WooCommerce_DaData
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main WooCommerce_DaData Class
 *
 * @class WooCommerce_DaData
 * @version	1.0.0
 * @since 1.0.0
 * @package	WooCommerce_DaData
 */
final class WooCommerce_DaData {

	/**
	 * Set up the plugin
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'WooCommerce_DaData_setup' ), -1 );		
		require_once( 'custom/functions.php' );
	}

	/**
	 * Setup all the things
	 */
	public function WooCommerce_DaData_setup() {
		add_action( 'wp_enqueue_scripts', array( $this, 'WooCommerce_DaData_css' ), 999 );
		add_action( 'wp_enqueue_scripts', array( $this, 'WooCommerce_DaData_js' ));
		add_filter( 'template_include',   array( $this, 'WooCommerce_DaData_template' ), 11 );
		add_filter( 'wc_get_template',    array( $this, 'WooCommerce_DaData_wc_get_template' ), 11, 5 );
		add_filter( 'woocommerce_settings_tabs_array', array( $this, 'add_settings_tab'), 50 );
		add_action( 'woocommerce_settings_tabs_settings_tab_wcddc', array( $this, 'settings_tab') );
		add_action( 'woocommerce_update_options_settings_tab_wcddc', array( $this, 'update_settings') );
	}

	/**
	 * Enqueue the CSS
	 *
	 * @return void
	 */
	public function WooCommerce_DaData_css() {
		wp_enqueue_style( 'custom-css', plugins_url( '/custom/style.css', __FILE__ ) );
	}

	/**
	 * Enqueue the Javascript
	 *
	 * @return void
	 */
	public function WooCommerce_DaData_js() {
		wp_enqueue_script( 'custom-js', plugins_url( '/custom/custom.js', __FILE__ ), array( 'jquery' ) );
        
        $dataToBePassed = array(
            'dadata_suggest_token'            => get_option('wc_settings_tab_wcddc_dadata_suggest_token')
        );
        
        wp_localize_script( 'custom-js', 'php_vars', $dataToBePassed );
	}

	/**
	 * Look in this plugin for template files first.
	 * This works for the top level templates (IE single.php, page.php etc). However, it doesn't work for
	 * template parts yet (content.php, header.php etc).
	 *
	 * Relevant trac ticket; https://core.trac.wordpress.org/ticket/13239
	 *
	 * @param  string $template template string.
	 * @return string $template new template string.
	 */
	public function WooCommerce_DaData_template( $template ) {
		if ( file_exists( untrailingslashit( plugin_dir_path( __FILE__ ) ) . '/custom/templates/' . basename( $template ) ) ) {
			$template = untrailingslashit( plugin_dir_path( __FILE__ ) ) . '/custom/templates/' . basename( $template );
		}

		return $template;
	}

	/**
	 * Look in this plugin for WooCommerce template overrides.
	 *
	 * For example, if you want to override woocommerce/templates/cart/cart.php, you
	 * can place the modified template in <plugindir>/custom/templates/woocommerce/cart/cart.php
	 *
	 * @param string $located is the currently located template, if any was found so far.
	 * @param string $template_name is the name of the template (ex: cart/cart.php).
	 * @return string $located is the newly located template if one was found, otherwise
	 *                         it is the previously found template.
	 */
	public function WooCommerce_DaData_wc_get_template( $located, $template_name, $args, $template_path, $default_path ) {
		$plugin_template_path = untrailingslashit( plugin_dir_path( __FILE__ ) ) . '/custom/templates/woocommerce/' . $template_name;

		if ( file_exists( $plugin_template_path ) ) {
			$located = $plugin_template_path;
		}

		return $located;
	}

	public function add_settings_tab( $settings_tabs ) {
		$settings_tabs['settings_tab_wcddc'] = __( 'DaData', 'woocommerce-settings-tab-wcddc' );
		return $settings_tabs;
	}

	public function settings_tab() {
		woocommerce_admin_fields( $this->get_settings() );
	}

	public function update_settings() {
		woocommerce_update_options( $this->get_settings() );
	}

	public function get_settings() {
		$wcddc_settings = array(
			'section_title' => array(
				'name'     => __( 'DaData Подсказки', 'woocommerce-settings-tab-wcddc' ),
				'type'     => 'title',
				'desc'     => '',
				'id'       => 'wc_settings_tab_wcddc_section_title'
			),
			'wc_settings_tab_wcddc_dadata_suggest_token' => array(
				'name' => __( 'API-ключ', 'woocommerce-settings-tab-wcddc' ),
				'type' => 'text',
				'desc' => __( '<a href="https://dadata.ru/api/suggest/#registration_popup">Где взять ключ?</a>', 'woocommerce-settings-tab-wcddc' ),
				'id'   => 'wc_settings_tab_wcddc_dadata_suggest_token'
			),        
			'section_end' => array(
				'type' => 'sectionend',
				'id' => 'wc_settings_tab_wcddc_section_end'
			)
		);
		return apply_filters( 'wc_settings_tab_wcddc_settings', $wcddc_settings );
	}
} // End Class

/**
 * The 'main' function
 *
 * @return void
 */
function WooCommerce_DaData_main() {
	new WooCommerce_DaData();
}

/**
 * Initialise the plugin
 */
add_action( 'plugins_loaded', 'WooCommerce_DaData_main' );