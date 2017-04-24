<?$APPLICATION->IncludeComponent(
	"altop:search.title", 
	".default", 
	array(
		"SHOW_INPUT" => "Y",
		"INPUT_ID" => "title-search-input",
		"CONTAINER_ID" => "altop_search",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "13",
		"PAGE" => "/catalog/",
		"NUM_CATEGORIES" => "1",
		"TOP_COUNT" => "7",
		"ORDER" => "rank",
		"USE_LANGUAGE_GUESS" => "Y",
		"CHECK_DATES" => "Y",
		"MARGIN_PANEL_TOP" => "42",
		"MARGIN_PANEL_LEFT" => "0",
		"PROPERTY_CODE_MOD" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_SORT_FIELD" => "name",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_FIELD2" => "shows",
		"OFFERS_SORT_ORDER2" => "desc",
		"OFFERS_LIMIT" => "",
		"SHOW_PRICE" => "N",
		"PRICE_CODE" => array(
			0 => "Розничная цена",
		),
		"PRICE_VAT_INCLUDE" => "N",
		"SHOW_ADD_TO_CART" => "Y",
		"SHOW_ALL_RESULTS" => "Y",
		"CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS"),
		"CATEGORY_0" => array(
			0 => "iblock_catalog",
		),
		"CATEGORY_0_iblock_catalog" => array(
			0 => "13",
		),
		"CONVERT_CURRENCY" => "N",
		"CURRENCY_ID" => "",
		"OFFERS_CART_PROPERTIES" => array(
			0 => "ARTNUMBER",
		),
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?> 