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

	$("#shipping_last_name").suggestions({
		serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
		token: php_vars.dadata_suggest_token,
		type: "NAME",
		params: {
			parts: ["SURNAME"]
		},
		count: 5,
	});

	$("#billing_company").suggestions({
		serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
		token: php_vars.dadata_suggest_token,
		type: "PARTY",
		count: 5,
		onSelect: function(suggestion) {
			$('#billing_company').val(suggestion.unrestricted_value);
			$('#billing_address').val(suggestion.data.address.value);
			$('#billing_inn').val(suggestion.data.inn);
			$('#billing_kpp').val(suggestion.data.kpp);
			$('#billing_ogrn').val(suggestion.data.ogrn);
        }
	});

	$("#billing_bank").suggestions({
		serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
		token: php_vars.dadata_suggest_token,
		type: "BANK",
		count: 5,
		onSelect: function(suggestion) {
			$('#billing_bank').val(suggestion.value);
			$('#billing_bank_address').val(suggestion.data.address.unrestricted_value);
			$('#billing_bank_bic').val(suggestion.data.bic);
			$('#billing_bank_swift').val(suggestion.data.swift);
			$('#billing_bank_correspondent_account').val(suggestion.data.correspondent_account);
        }
	});
});