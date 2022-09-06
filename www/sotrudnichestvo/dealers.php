<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Где купить");
?>
<div class="container">
	<div class="row">
		<div class="col-md-3">
			<div class="bg-grey p-20">
				<h4 class="text-white">Поиск дилеров по городам</h4>
				<hr>
				<?
				/**
				 * Попробовать сделать чтобы не кэшировались запросы $_REQUEST["SECTION_ID]
				 */
				?>
				<? $APPLICATION->IncludeComponent(
					"bitrix:catalog.section.list",
					"dealers_select",
					array(
						"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
						"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
						"CACHE_GROUPS" => "N",	// Учитывать права доступа
						"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
						"CACHE_TYPE" => "N",	// Тип кеширования
						"COMPONENT_TEMPLATE" => "tree",
						"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
						"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",	// Показывать количество
						"FILTER_NAME" => "sectionsFilter",	// Имя массива со значениями фильтра разделов
						"HIDE_SECTION_NAME" => "N",
						"IBLOCK_ID" => "25",	// Инфоблок
						"IBLOCK_TYPE" => "distrib",	// Тип инфоблока
						"SECTION_CODE" => "",	// Код раздела
						"SECTION_FIELDS" => array(	// Поля разделов
							0 => "",
							1 => "",
						),
						"SECTION_ID" => $arResult["SECTION_ID"],	// ID раздела
						"SECTION_URL" => "?SECTION_ID=#SECTION_ID#",	// URL, ведущий на страницу с содержимым раздела
						"SECTION_USER_FIELDS" => array(	// Свойства разделов
							0 => "",
							1 => "",
						),
						"SHOW_PARENT_NAME" => "Y",
						"TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
						"VIEW_MODE" => "TILE"
					),
					false
				); ?>
			</div>
		</div>
		<div class="col-md-9">
			<? $APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"dealers_list", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "N",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "dealers_list",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"IBLOCK_ID" => "25",
		"IBLOCK_TYPE" => "distrib",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "Y",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => $_REQUEST["SECTION_ID"],
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "B_E_MAIL",
			1 => "B_ADRES",
			2 => "B_GOROD",
			3 => "B_TELEFON",
			4 => "",
		),
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"TEMPLATE_THEME" => "blue",
		"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"MEDIA_PROPERTY" => "",
		"SLIDER_PROPERTY" => "",
		"SEARCH_PAGE" => "/search/",
		"USE_RATING" => "N",
		"USE_SHARE" => "N",
		"ASPECT_RATIO" => "Y",
		"PAGER_BASE_LINK" => "?SECTION_ID=".$_REQUEST["SECTION_ID"],
		"PAGER_PARAMS_NAME" => "arrPager"
	),
	false
); ?>
		</div>
	</div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>