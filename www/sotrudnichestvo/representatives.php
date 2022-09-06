<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Региональные представители");
?><div class="container pb-30">
	<div class="text-center mb-30 mb-lg-60">
		<h1 class="fz-20 fz-lg-36 ff-dinpro fw-700 text-uppercase mb-0">Региональные представители</h1>
	</div>
</div>

<?
/**
 * Получаем список разделов региональных представителей
 */
$arSections = CIBlockSection::GetList(
	Array("SORT" => "ASC"),
	Array(
		"IBLOCK_TYPE" => "contacts",
		"IBLOCK_CODE" => "representatives"
	),
	false,
	Array("ID", "NAME")
);
while ($sectionNames = $arSections->GetNext()) {
	$section[] = $sectionNames;
}
?>
<div class="container">
	<!-- <select name="SECTIONS_SELECT" id="sections_select" onchange="document.getElementById(this.options[this.selectedIndex].value).scrollIntoView({behavior: 'smooth', block: 'start'})"> -->
	<div class="row filter my-20">
		<div class="col-md-6 align-self-center ff-dinpro fw-700 fz-30">Выбор города</div>
		<div class="col-md-6">
			<div class="lib-select">
				<select name="SECTIONS_SELECT" id="sections_select" class="js-lib-select" onchange="document.getElementById(this.options[this.selectedIndex].value).scrollIntoView({behavior: 'smooth', block: 'center'})">
					<?
					foreach($section as $val) {
						?><option value="<?=$val["ID"]?>"><?=$val["NAME"]?></option><?
					}
					?>
				</select>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		
	</script>
</div>
<?
foreach ($section as $val) {
	?>
	<div class="container">
		<div id="<?=$val["ID"]?>" class="text-truncate-2 text-uppercase ff-dinpro fw-700 fz-16 fz-md-20"><?=$val["NAME"]?></div>
	</div>
	<?
	$APPLICATION->IncludeComponent("bitrix:news.list", "astz_projects", Array(
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"ADD_SECTIONS_CHAIN" => "Y",	// Включать раздел в цепочку навигации
		"AJAX_MODE" => "Y",	// Включить режим AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"ASPECT_RATIO" => "N",	// Растянуть изображение
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
		"COMPONENT_TEMPLATE" => "astz_projects",
		"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
		"DISPLAY_DATE" => "N",	// Выводить дату элемента
		"DISPLAY_NAME" => "Y",	// Выводить название элемента
		"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
		"DISPLAY_PREVIEW_TEXT" => "N",	// Выводить текст анонса
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"FIELD_CODE" => array(	// Поля
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "arrFilter",	// Фильтр
		"HIDE_LINK_WHEN_NO_DETAIL" => "Y",	// Скрывать ссылку, если нет детального описания
		"IBLOCK_ID" => "22",	// Код информационного блока
		"IBLOCK_TYPE" => "contacts",	// Тип информационного блока (используется только для проверки)
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",	// Включать инфоблок в цепочку навигации
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"MEDIA_PROPERTY" => "",	// Свойство для отображения медиа
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		"NEWS_COUNT" => "9",	// Количество новостей на странице
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "Y",	// Показывать ссылку "Все"
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
		"PAGER_TITLE" => "Региональные представители",	// Название категорий
		"PARENT_SECTION" => $val["ID"],	// ID раздела
		"PARENT_SECTION_CODE" => "",	// Код раздела
		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
		"PROPERTY_CODE" => array(	// Свойства
			0 => "MAIL",
			1 => "POSITION",
			2 => "RESPONSIBILITY",
			3 => "PHONE",
			4 => "",
		),
		"SEARCH_PAGE" => "/search/",	// Путь к странице поиска
		"SET_BROWSER_TITLE" => "Y",	// Устанавливать заголовок окна браузера
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"SET_META_DESCRIPTION" => "Y",	// Устанавливать описание страницы
		"SET_META_KEYWORDS" => "Y",	// Устанавливать ключевые слова страницы
		"SET_STATUS_404" => "Y",	// Устанавливать статус 404
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"SHOW_404" => "N",	// Показ специальной страницы
		"SLIDER_PROPERTY" => "",	// Свойство с изображениями для слайдера
		"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
		"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
		"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
		"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
		"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
		"TEMPLATE_THEME" => "blue",	// Цветовая тема
		"USE_RATING" => "N",	// Разрешить голосование
		"USE_SHARE" => "N",	// Отображать панель соц. закладок
	),
	false
);
}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>