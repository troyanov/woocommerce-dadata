jQuery(document).ready(function ($) {
	$("#billing_address_1").suggestions({
		serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
		token: php_vars.dadata_suggest_token,
		type: "ADDRESS",
		count: 5,
		onSelect: function (suggestion) {
			$("#billing_city").val(suggestion.data.city);
			$("#billing_state").val(suggestion.data.region);
			$("#billing_postcode").val(suggestion.data.postal_code);
		}
	});

	$("#shipping_address_1").suggestions({
		serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
		token: php_vars.dadata_suggest_token,
		type: "ADDRESS",
		count: 5,
		onSelect: function (suggestion) {
			$("#shipping_city").val(suggestion.data.city);
			$("#shipping_state").val(suggestion.data.region);
			$("#shipping_postcode").val(suggestion.data.postal_code);
		}
	});

	$("#billing_email").suggestions({
		serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
		token: php_vars.dadata_suggest_token,
		type: "EMAIL",
		count: 5,
	});

	$("#billing_first_name").suggestions({
		serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
		token: php_vars.dadata_suggest_token,
		type: "NAME",
		params: {
			parts: ["NAME"]
		},
		count: 5,
	});

		$("#billing_last_name").suggestions({
		serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
		token: php_vars.dadata_suggest_token,
		type: "NAME",
		params: {
			parts: ["SURNAME"]
		},
		count: 5,
	});

	$("#shipping_first_name").suggestions({
		serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
		token: php_vars.dadata_suggest_token,
		type: "NAME",
		params: {
			parts: ["NAME"]
		},
		count: 5,
	});

	$("#shipping_last_name").suggestions({
		serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
		token: php_vars.dadata_suggest_token,
		type: "NAME",
		params: {
			parts: ["SURNAME"]
		},
		count: 5,
	});
});