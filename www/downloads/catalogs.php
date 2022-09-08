<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Каталоги");
?>
<div class="container typography text-grey fz-lg-18 fz-xl-20 px-xl-40">
	<h3>АСТЗ. Освещая жизнь!</h3>
	Основой для продуктивной работы и радостной жизни является, в том числе, здоровое световое окружение. Хороший свет способствует сохранению здоровья и повышению качества жизни. Поэтому, светить людям, освещать жизнь – великая миссия. Ардатовский светотехнический завод успешно выполняет именно эту задачу: давать людям хороший свет.<br>
	<p>
		Предприятие основано в 1949 г. как «Союзный государственный светотехнический завод». Сейчас это акционерное общество, полноценный производственно-коммерческий комплекс. На предприятии ведутся исследования и научно-технические разработки, создаются перспективные образцы осветительных приборов, проводятся их испытания, изготавливается оснастка, ведется серийный выпуск продукции, реализация через дилерскую сеть, обеспечивается проектирование освещения и консультирование потребителей.
	</p>
	<p>
		Основу современного освещения составляют безопасность, комфорт и эффективность. Безопасность обеспечивается качеством световых приборов и системами аварийного освещения. Комфорт и эффективность – правильностью проектирования, применением современных оптических систем, высокой световой отдачей источников света и системами управления освещением.
	</p>
	<p>
		Все это характеризует продукцию с маркой Ardatov и обеспечивает высокое качество.
	</p>
	<p>
		В производстве осваиваются новые общественные, промышленные и уличные светильники серий ДВО59 DLU, ДПО12 Universal, ДПО48 Prime, ДПО52 Optimus, ДСП03 Orion, ДСП15 Kosmos, ДСП19 Quant, ДСП47 Arsenal, ДСП52 Optima и другие. Для особых условий производятся аварийные светильники, взрывозащищенные приборы, изделия для пожароопасных зон. Все современные световые приборы, выпускаемые АСТЗ, имеют модификации, обеспечивающие возможность работы с перспективными цифровыми системами управления освещением (СУО).
	</p>
	<p>
		В цехах и офисах, школах и детских садах, поликлиниках и больницах, теплицах и фермах, на улицах и в парках, везде можно встретить светильники с маркой АСТЗ. Качественные материалы и комплектующие, высокая квалификация работников, совершенствование технологий обеспечивает полноценный жизненный цикл изделия.
	</p>
	<p>
		Ардатовский светотехнический завод ориентирован на долговременное сотрудничество. Работая на перспективу, АСТЗ готов предложить максимально эффективное светотехническое решение для Вас и Ваших клиентов!
	</p>
	<br>
	АСТЗ. Естественное стремление к свету!
	<hr>
</div>
<div class="container">
	<? $APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"astz_files",
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
			"CACHE_TYPE" => "A",
			"CHECK_DATES" => "Y",
			"DETAIL_URL" => "",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"DISPLAY_DATE" => "N",
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => "Y",
			"DISPLAY_PREVIEW_TEXT" => "Y",
			"DISPLAY_TOP_PAGER" => "N",
			"FIELD_CODE" => array(
				0 => "",
				1 => "",
			),
			"FILTER_NAME" => "",
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"IBLOCK_ID" => "57",
			"IBLOCK_TYPE" => "content",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
			"INCLUDE_SUBSECTIONS" => "Y",
			"MEDIA_PROPERTY" => "",
			"MESSAGE_404" => "",
			"NEWS_COUNT" => "3",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => ".default",
			"PAGER_TITLE" => "Новости",
			"PARENT_SECTION" => "",
			"PARENT_SECTION_CODE" => "",
			"PREVIEW_TRUNCATE_LEN" => "",
			"PROPERTY_CODE" => array(
				0 => "",
				1 => "CATALOG",
				2 => "",
			),
			"SEARCH_PAGE" => "/search/",
			"SET_BROWSER_TITLE" => "Y",
			"SET_LAST_MODIFIED" => "N",
			"SET_META_DESCRIPTION" => "Y",
			"SET_META_KEYWORDS" => "Y",
			"SET_STATUS_404" => "N",
			"SET_TITLE" => "Y",
			"SHOW_404" => "N",
			"SLIDER_PROPERTY" => "",
			"SORT_BY1" => "TIMESTAMP_X",
			"SORT_BY2" => "SORT",
			"SORT_ORDER1" => "DESC",
			"SORT_ORDER2" => "ASC",
			"STRICT_SECTION_CHECK" => "N",
			"TEMPLATE_THEME" => "blue",
			"USE_RATING" => "N",
			"USE_SHARE" => "N",
			"COMPONENT_TEMPLATE" => "astz_files"
		),
		false
	); ?>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>