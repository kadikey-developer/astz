<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("Светотехнический завод"); ?>
<? $APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"mainpage_slider",
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "mainpage_slider",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(0 => "", 1 => "",),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "5",
		"IBLOCK_TYPE" => "slider",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MEDIA_PROPERTY" => "",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Слайдер",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(0 => "URL", 1 => "",),
		"SEARCH_PAGE" => "/search/",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SLIDER_PROPERTY" => "",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"TEMPLATE_THEME" => "blue",
		"USE_RATING" => "N",
		"USE_SHARE" => "N"
	)
); ?>
<div class="py-25 py-lg-60">
</div>
<section class="animation-fade-up active">
	<div class="container">
		<div class="text-center mb-20 mb-lg-60">
			<h2 class="ff-dinpro fz-20 fz-lg-36 fw-700 text-uppercase mb-5 mb-lg-10">
				Новости </h2>
			<div class="fz-14 fz-lg-18 text-uppercase">
				Обзор мероприятий
			</div>
		</div>
		<? $APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"news_anounce",
			array(
				"ACTIVE_DATE_FORMAT" => "d.m.Y",
				"ADD_SECTIONS_CHAIN" => "N",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "Y",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"CHECK_DATES" => "Y",
				"COMPONENT_TEMPLATE" => ".default",
				"DETAIL_URL" => "",
				"DISPLAY_BOTTOM_PAGER" => "N",
				"DISPLAY_DATE" => "N",
				"DISPLAY_NAME" => "Y",
				"DISPLAY_PICTURE" => "Y",
				"DISPLAY_PREVIEW_TEXT" => "Y",
				"DISPLAY_TOP_PAGER" => "N",
				"FIELD_CODE" => array(0 => "", 1 => "",),
				"FILTER_NAME" => "",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"IBLOCK_ID" => "1",
				"IBLOCK_TYPE" => "news",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"INCLUDE_SUBSECTIONS" => "N",
				"MEDIA_PROPERTY" => "",
				"MESSAGE_404" => "",
				"NEWS_COUNT" => "5",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "Y",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => ".default",
				"PAGER_TITLE" => "Новости",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"PREVIEW_TRUNCATE_LEN" => "",
				"PROPERTY_CODE" => array(0 => "", 1 => "",),
				"SEARCH_PAGE" => "/search/",
				"SET_BROWSER_TITLE" => "N",
				"SET_LAST_MODIFIED" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_STATUS_404" => "Y",
				"SET_TITLE" => "N",
				"SHOW_404" => "N",
				"SLIDER_PROPERTY" => "",
				"SORT_BY1" => "ACTIVE_FROM",
				"SORT_BY2" => "SORT",
				"SORT_ORDER1" => "DESC",
				"SORT_ORDER2" => "ASC",
				"STRICT_SECTION_CHECK" => "N",
				"TEMPLATE_THEME" => "blue",
				"USE_RATING" => "N",
				"USE_SHARE" => "N"
			)
		); ?>
	</div>
</section>
<div class="py-25 py-lg-60">
</div>
<section class="animation-fade-up">
	<div class="container">
		<div class="text-center mb-30 mb-lg-60">
			<h2 class="ff-dinpro fz-20 fz-lg-36 fw-700 text-uppercase">Продукция</h2>
		</div>
		<? $APPLICATION->IncludeComponent(
			"bitrix:catalog.section.list",
			"sections_slider",
			array(
				"ADD_SECTIONS_CHAIN" => "Y",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "Y",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"COMPONENT_TEMPLATE" => ".default",
				"COUNT_ELEMENTS" => "N",
				"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
				"FILTER_NAME" => "sectionsFilter",
				"HIDE_SECTION_NAME" => "N",
				"IBLOCK_ID" => "2",
				"IBLOCK_TYPE" => "products",
				"SECTION_CODE" => "",
				"SECTION_FIELDS" => array(0 => "", 1 => "",),
				"SECTION_ID" => $_REQUEST["SECTION_ID"],
				"SECTION_URL" => "",
				"SECTION_USER_FIELDS" => array(0 => "", 1 => "",),
				"SHOW_PARENT_NAME" => "N",
				"TOP_DEPTH" => "1",
				"VIEW_MODE" => "TILE"
			)
		); ?>
	</div>
</section>
<div class="py-25 py-lg-60">
</div>
<section class="animation-fade-up">
	<div class="container">
		<div class="text-center mb-30 mb-lg-60">
			<h2 class="ff-dinpro fz-20 fz-lg-36 fw-700 text-uppercase mb-10">
				Проекты </h2>
			<div class="fz-14 fz-lg-18 text-uppercase">
				Образование - Коммерческие Помещения - Складские - Спортивные - Уличное - Другое <br>
			</div>
		</div>
		<? $APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"projects_slider",
			array(
				"ACTIVE_DATE_FORMAT" => "d.m.Y",
				"ADD_SECTIONS_CHAIN" => "N",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "Y",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"CHECK_DATES" => "Y",
				"COMPONENT_TEMPLATE" => "projects_slider",
				"DETAIL_URL" => "",
				"DISPLAY_BOTTOM_PAGER" => "N",
				"DISPLAY_DATE" => "N",
				"DISPLAY_NAME" => "Y",
				"DISPLAY_PICTURE" => "Y",
				"DISPLAY_PREVIEW_TEXT" => "N",
				"DISPLAY_TOP_PAGER" => "N",
				"FIELD_CODE" => array(0 => "", 1 => "",),
				"FILTER_NAME" => "",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"IBLOCK_ID" => "9",
				"IBLOCK_TYPE" => "content",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"INCLUDE_SUBSECTIONS" => "N",
				"MESSAGE_404" => "",
				"NEWS_COUNT" => "10",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => ".default",
				"PAGER_TITLE" => "Проекты",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"PREVIEW_TRUNCATE_LEN" => "",
				"PROPERTY_CODE" => array(0 => "", 1 => "",),
				"SET_BROWSER_TITLE" => "N",
				"SET_LAST_MODIFIED" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_STATUS_404" => "N",
				"SET_TITLE" => "N",
				"SHOW_404" => "N",
				"SORT_BY1" => "ACTIVE_FROM",
				"SORT_BY2" => "SORT",
				"SORT_ORDER1" => "DESC",
				"SORT_ORDER2" => "ASC",
				"STRICT_SECTION_CHECK" => "N"
			)
		); ?>
	</div>
</section>
<div class="py-25 py-lg-60">
</div>
<section class="animation-fade-up">
	<div class="container">
		<div class="text-center mb-30 mb-lg-60">
			<h2 class="ff-dinpro fz-20 fz-lg-36 fw-700 text-uppercase mb-10">
				Новинки </h2>
			<div class="fz-14 fz-lg-18 text-uppercase">
				Наша продукция
			</div>
		</div>
		<? $APPLICATION->IncludeComponent(
			"bitrix:catalog.section.list",
			"new_series",
			array(
				"ADD_SECTIONS_CHAIN" => "N",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "Y",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"COMPONENT_TEMPLATE" => "new_series",
				"COUNT_ELEMENTS" => "Y",
				"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
				"FILTER_NAME" => "sectionsFilter",
				"FIND_BY_UF_NAME" => "Y",
				"HIDE_SECTION_NAME" => "N",
				"IBLOCK_ID" => "2",
				"IBLOCK_TYPE" => "products",
				"SECTION_CODE" => "",
				"SECTION_FIELDS" => array(0 => "", 1 => "",),
				"SECTION_ID" => "",
				"SECTION_URL" => "",
				"SECTION_USER_FIELDS" => array(0 => "", 1 => "",),
				"SHOW_PARENT_NAME" => "N",
				"SHOW_UF_SECTION_DESCR" => "Y",
				"TOP_DEPTH" => "1",
				"UF_NAME" => "UF_NEW",
				"VIEW_MODE" => "TILE"
			)
		); ?>
	</div>
</section>
<div class="py-25 py-lg-60"></div>
<section>
	<div class="pre-footer bg-blue-dark text-white pt-40 pb-0 py-lg-85 lazyload bgi-contain" data-bg="/html/img/home/bg-pre-footer.png">
		<div class="container">
			<h2 class="d-none">ПОдписаться на рассылку</h2>
			<!-- по стандарту w3c, section должен содержать как минмум один заголовок второго или третьего уровня. Пусть даже скрытый.  -->
			<div class="ff-dinpro fz-25 fw-700 mb-20 mb-lg-40">
				Подпишитесь на нашу рассылку<span class="d-none d-lg-inline">, <br>
					чтобы быть в курсе актуальных новинок, <br>
					последних тенденций освещения и текущих событий</span>
			</div>
			<div class="fz-18 mb-45">
				<div class="d-lg-inline-block mr-25">
					<span class="icon-mark fz-12 mr-5"></span><span>Тенденции освещения</span>
				</div>
				<div class="d-lg-inline-block mr-25">
					<span class="icon-mark fz-12 mr-5"></span><span>Текущие события</span>
				</div>
				<div class="d-lg-inline-block mr-25">
					<span class="icon-mark fz-12 mr-5"></span><span>Секрет производства</span>
				</div>
			</div>
			<? $APPLICATION->IncludeComponent(
				"bitrix:subscribe.form",
				"mainpage_subscribe",
				array(
					"CACHE_TIME" => "3600",	// Время кеширования (сек.)
					"CACHE_TYPE" => "A",	// Тип кеширования
					"PAGE" => "#SITE_DIR#about/subscr_edit.php",	// Страница редактирования подписки (доступен макрос #SITE_DIR#)
					"SHOW_HIDDEN" => "N",	// Показать скрытые рубрики подписки
					"USE_PERSONALIZATION" => "Y",	// Определять подписку текущего пользователя
					"COMPONENT_TEMPLATE" => ".default"
				),
				false
			); ?>
		</div>
	</div>
</section>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>