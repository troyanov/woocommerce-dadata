<?php
/**
 * Functions.php
 *
 * @package  WooCommerce_DaData
 * @author   Anton Troyanov
 * @since    1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * functions.php
 * Add PHP snippets here
 */

function load_scripts_and_styles(){
    wp_register_script( 
        'jquery.suggestions.min', 
        '/wp-content/plugins/woocommerce-dadata/custom/assets/js/jquery.suggestions.min.js',
        array( 'jquery' )
    );
    wp_enqueue_script( 'jquery.suggestions.min' );

    wp_register_script( 
        'jquery.xdomainrequest.min', 
        '/wp-content/plugins/woocommerce-dadata/custom/assets/js/jquery.xdomainrequest.min.js', 
        array( 'jquery' )
    );
    wp_enqueue_script( 'jquery.suggestions.min' );

    wp_enqueue_style( 'suggestions', 
        '/wp-content/plugins/woocommerce-dadata/custom/assets/css/suggestions.css' );    
}

add_action('wp_enqueue_scripts', 'load_scripts_and_styles');
