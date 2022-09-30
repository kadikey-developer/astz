<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Тест");
?><div class="container">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:search.page", 
	"withTabs", 
	array(
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "N",
		"COMPONENT_TEMPLATE" => "withTabs",
		"DEFAULT_SORT" => "date",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FILTER_NAME" => "",
		"NO_WORD_LOGIC" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "arrows",
		"PAGER_TITLE" => "Результаты поиска",
		"PAGE_RESULT_COUNT" => "20",
		"PATH_TO_USER_PROFILE" => "",
		"RATING_TYPE" => "",
		"RESTART" => "Y",
		"SHOW_ITEM_DATE_CHANGE" => "N",
		"SHOW_ITEM_TAGS" => "N",
		"SHOW_ORDER_BY" => "Y",
		"SHOW_RATING" => "",
		"SHOW_TAGS_CLOUD" => "N",
		"SHOW_WHEN" => "N",
		"SHOW_WHERE" => "Y",
		"USE_LANGUAGE_GUESS" => "N",
		"USE_SUGGEST" => "N",
		"USE_TITLE_RANK" => "Y",
		"arrFILTER" => array(
			0 => "iblock_news",
			1 => "iblock_products",
		),
		"arrFILTER_iblock_products" => array(
			0 => "all",
		),
		"arrWHERE" => array(
			0 => "iblock_news",
			1 => "iblock_products",
		),
		"STRUCTURE_FILTER" => "structure",
		"NAME_TEMPLATE" => "",
		"SHOW_LOGIN" => "Y",
		"TAGS_SORT" => "NAME",
		"TAGS_PAGE_ELEMENTS" => "150",
		"TAGS_PERIOD" => "",
		"TAGS_URL_SEARCH" => "",
		"TAGS_INHERIT" => "Y",
		"FONT_MAX" => "50",
		"FONT_MIN" => "10",
		"COLOR_NEW" => "000000",
		"COLOR_OLD" => "C8C8C8",
		"PERIOD_NEW_TAGS" => "",
		"SHOW_CHAIN" => "Y",
		"COLOR_TYPE" => "Y",
		"WIDTH" => "100%",
		"arrFILTER_iblock_news" => array(
			0 => "all",
		)
	),
	false
);?>
</div><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>