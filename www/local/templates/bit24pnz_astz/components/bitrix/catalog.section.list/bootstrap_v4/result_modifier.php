<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arViewModeList = array('LIST', 'LINE', 'TEXT', 'TILE');

$columnCountList = array('1', '2', '3', '4', '6', '12');

$arDefaultParams = array(
	'VIEW_MODE' => 'LIST',
	'SHOW_PARENT_NAME' => 'Y',
	'HIDE_SECTION_NAME' => 'N',
	'LIST_COLUMNS_COUNT' => '6',
	'SECTIONS_SHOW_UF_DESCR' => 'Y'
);

$arParams = array_merge($arDefaultParams, $arParams);

if (!in_array($arParams['VIEW_MODE'], $arViewModeList))
	$arParams['VIEW_MODE'] = 'LIST';
if ('N' != $arParams['SHOW_PARENT_NAME'])
	$arParams['SHOW_PARENT_NAME'] = 'Y';
if ('Y' != $arParams['HIDE_SECTION_NAME'])
	$arParams['HIDE_SECTION_NAME'] = 'N';
if (!in_array($arParams['LIST_COLUMNS_COUNT'], $columnCountList))
	$arParams['LIST_COLUMNS_COUNT'] = '6';

$arResult['VIEW_MODE_LIST'] = $arViewModeList;

if (0 < $arResult['SECTIONS_COUNT'])
{
	if ('LIST' != $arParams['VIEW_MODE'])
	{
		$boolClear = false;
		$arNewSections = array();
		foreach ($arResult['SECTIONS'] as &$arOneSection)
		{
			if (1 < $arOneSection['RELATIVE_DEPTH_LEVEL'])
			{
				$boolClear = true;
				continue;
			}
			$arNewSections[] = $arOneSection;
		}
		unset($arOneSection);
		if ($boolClear)
		{
			$arResult['SECTIONS'] = $arNewSections;
			$arResult['SECTIONS_COUNT'] = count($arNewSections);
		}
		unset($arNewSections);
	}
}
if (0 < $arResult['SECTIONS_COUNT'])
{
	$boolPicture = false;
	$boolDescr = false;
	$arSelect = array('ID');
	$arMap = array();
	if ('LINE' == $arParams['VIEW_MODE'] || 'TILE' == $arParams['VIEW_MODE'])
	{
		reset($arResult['SECTIONS']);
		$arCurrent = current($arResult['SECTIONS']);
		if (!isset($arCurrent['PICTURE']))
		{
			$boolPicture = true;
			$arSelect[] = 'PICTURE';
		}
		if ('LINE' == $arParams['VIEW_MODE'] && !array_key_exists('DESCRIPTION', $arCurrent))
		{
			$boolDescr = true;
			$arSelect[] = 'DESCRIPTION';
			$arSelect[] = 'DESCRIPTION_TYPE';
		}
		/**
		 * Вывод пользовательских свойств
		 */
		foreach ($arResult['SECTIONS'] as &$arOneSection) {
			$ufProps = CIBlockSection::GetList( // Переделать чтобы один раз функция выполнялась, а не в каждой секции
				array("SORT" => "ASC"), 
				array(
					"IBLOCK_ID" => $arOneSection['IBLOCK_ID'],
					"ID" => $arOneSection['ID']
				), 
				false, 
				$arSelect = array("UF_*")
			);
			if($thisProp = $ufProps -> GetNext()){
				$arOneSection['UF_PROPS'] = array(
					'UF_SECTION_DESCR' => $thisProp['UF_SECTION_DESCR'],
					'~UF_SECTION_DESCR' => $thisProp['~UF_SECTION_DESCR']
				);
			}
		}
	}
	if ($boolPicture || $boolDescr)
	{
		foreach ($arResult['SECTIONS'] as $key => $arSection)
		{
			$arMap[$arSection['ID']] = $key;
		}
		$rsSections = CIBlockSection::GetList(array(), array('ID' => array_keys($arMap)), false, $arSelect);
		while ($arSection = $rsSections->GetNext())
		{
			if (!isset($arMap[$arSection['ID']]))
				continue;
			$key = $arMap[$arSection['ID']];
			if ($boolPicture)
			{
				$arSection['PICTURE'] = intval($arSection['PICTURE']);
				$arSection['PICTURE'] = (0 < $arSection['PICTURE'] ? CFile::GetFileArray($arSection['PICTURE']) : false);
				$arResult['SECTIONS'][$key]['PICTURE'] = $arSection['PICTURE'];
				$arResult['SECTIONS'][$key]['~PICTURE'] = $arSection['~PICTURE'];
			}
			if ($boolDescr)
			{
				$arResult['SECTIONS'][$key]['DESCRIPTION'] = $arSection['DESCRIPTION'];
				$arResult['SECTIONS'][$key]['~DESCRIPTION'] = $arSection['~DESCRIPTION'];
				$arResult['SECTIONS'][$key]['DESCRIPTION_TYPE'] = $arSection['DESCRIPTION_TYPE'];
				$arResult['SECTIONS'][$key]['~DESCRIPTION_TYPE'] = $arSection['~DESCRIPTION_TYPE'];
			}
		}
	}
}
if (0 == $arResult['SECTIONS_COUNT'] && 'TILE' == $arParams['VIEW_MODE']) {
	$boolPicture = true;
	$arSection = $arResult['SECTION'];
	if ($boolPicture)
	{
		$arSection['DETAIL_PICTURE'] = intval($arSection['DETAIL_PICTURE']);
		$arSection['DETAIL_PICTURE'] = (0 < $arSection['DETAIL_PICTURE'] ? CFile::GetFileArray($arSection['DETAIL_PICTURE']) : false);
		$arResult['SECTION']['DETAIL_PICTURE'] = $arSection['DETAIL_PICTURE'];
		$arResult['SECTION']['~DETAIL_PICTURE'] = $arSection['~DETAIL_PICTURE'];
	}
}

/**
 * Реализовать включение по условию
 * Подсчитвыем количество элементов в зависимости от установленного фильтра
 */
global $arFilterSections;
if ( !empty($arFilterSections) ) {
	unset($arFilterSections["ID"]);

	foreach ($arResult["SECTIONS"] as $key => $section) { // для вывода количества в разделах
		$arElements = CIBlockElement::GetList(
			array(),
			array(
				"IBLOCK_ID" => $section["IBLOCK_ID"],
				"IBLOCK_TYPE" => $section["IBLOCK_TYPE_ID"],
				"ACTIVE" => "Y",
				// "IBLOCK_SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
				"SECTION_ID" => $section["ID"],
				"INCLUDE_SUBSECTIONS" => "N",
				$arFilterSections
			), // фильтровать по $arFilterSections
			array() // для вывода количества
		);
		$arResult["SECTIONS"][$key]["ELEMENT_CNT"] = $arElements;
		$arResult["SECTIONS"][$key]["~ELEMENT_CNT"] = $arElements;
		// $arResult["SECTIONS"][$key]["SECTION_PAGE_URL"] .= '/' .  $arFilterSections['PARAMS']
	}
}

/**
 * Описание раздела из описания элемента
 */
use \Bitrix\Main\Loader;
use \Bitrix\Highloadblock as HL;

/**
 * Получаем элемент с префиксом СЕРИЯ_ внутри ткужшего раздела
 */
$arSection = $arResult["SECTION"];
$elements = array();
$arFilter = array(
	"IBLOCK_ID" => $arSection["IBLOCK_ID"],
	"CODE" => "seriya%",
	// "ACTIVE" => "Y", // прищлось убрать, чтобы данные в иконки и другие выводимые свойства всегда подгружались, даже при неактивном элементе
	"SECTION_ID" => $arResult["SECTION"]["ID"]
);

$arElements = CIBlockElement::GetList( // получаем элементы Серия_
	array(),
	$arFilter,
);
if ($sElement = $arElements->GetNextElement()) {
	$arResult["S_ELEMENT"] = $sElement->GetFields(); // получаем поля элемента
	$arResult["S_ELEMENT"]["~NAME"] = preg_replace('/СЕРИЯ_/', '', $arResult["S_ELEMENT"]["~NAME"]); // отсекаем префикс
	$arResult["S_PROPERTIES"] = $sElement->GetProperties(); // Получаем список свойств
	foreach ( $arResult["S_PROPERTIES"] as $propCode => $arProp ) { // что было бы если бы через array_intersect_key()?
		if ( in_array($propCode, $arParams['DETAIL_MAIN_BLOCK_PROPERTY_CODE']) && !empty($arProp["VALUE"]) ) { // Если установлено в детальной карточке отображать свойства в блоке справа от картинки
			$arResult["S_DISPLAY_PROPERTIES"][$propCode] = $arProp;
		}
	}

	/**
	 * Форматируем расшифровку модификации
	 */
	$arDecription = array(
		"PERVAYA_TSIFRA",
		"VTORAYA_TSIFRA",
		"TRETYA_TSIFRA",
		"KOMMERCHESKIE_OBOZNACHENIYA"
	);

	foreach ( $arDecription as $decription) {
		$decr_value = $arResult["S_PROPERTIES"][$decription]["~VALUE"];
		if (!empty($decr_value)) {
			if (strpos($decr_value, ";") > 0) {
				$str = explode(";\n", $arResult["S_PROPERTIES"][$decription]["~VALUE"]);
			} else {
				$str = explode(".\n", $arResult["S_PROPERTIES"][$decription]["~VALUE"]);
			}
			foreach ($str as $key => $row) {
				$str[$key] = preg_replace('/^(.+)\s-/', '<strong>$1</strong> -', $row);
			}
		}
		$arResult["S_PROPERTIES"][$decription]["~VALUE"] = implode(';<br>', $str);
	}

	/**
	 * Подгружаем картинки из элемента Серия_
	 */
	$thisElFields = $sElement->GetFields();
	if ( 0 == $arResult['SECTIONS_COUNT'] && 'TILE' && $thisElFields['ACTIVE'] == 'Y' ) { // можно добавить, чтобы не перезаписывалось, если заполнено что-либо из админки
		/**
		 * Перезаписываем в $arResult["SECTION"]
		 */
		$section = new CIBlockSection;
		$picture = CFile::MakeFileArray($thisElFields['DETAIL_PICTURE']);
		$arUpdateFields = Array(
			"PICTURE" => $picture,
			"DETAIL_PICTURE" => $picture,
		);
		$update = $section->Update($arSection["ID"], $arUpdateFields, false, false, true); // можно добавить обновление $arResult, чтобы сразу картинка выводилась
		unset($arFilter["SECTION_ID"]); // без привязки к текущему разделу
		$arFilter["!ID"] = $thisElFields["ID"]; // все разделы кроме текущего
		$arElements = CIBlockElement::GetList( // !!! надо переделать на поиск Разделов, у которых нет картинок, чтобы избежать лишних проверок на проверку картинки внутри цикла.
			array(),
			$arFilter
		);
		while ( $element = $arElements->GetNext() ) {
			$thisSection = $section->GetByID($element["IBLOCK_SECTION_ID"]);
			if ($sFields = $thisSection->GetNext()) {
				if ( empty($sFields["DETAIL_PICTURE"]) ) { // выполняем обновление если поля были пустые
					$picture = CFile::MakeFileArray($element['DETAIL_PICTURE']);
					$arUpdateFields = Array(
						"PICTURE" => $picture,
						"DETAIL_PICTURE" => $picture,	
					);
					$update = $section->Update($element["IBLOCK_SECTION_ID"], $arUpdateFields, false, false, true);
				}
			}
		}


		/**
		 * Старый вариант. Когда картинка просто подставлялась в $arResult
		 */
		/*$sectionList = $section->GetList();
		while ( $section = $sectionList->GetNextElement() ) {
			?><pre><? print_r($section); ?></pre><?			
		}*/


		/*$arSection["DESCRIPTION"] = $arFields["DETAIL_TEXT"];
		$arSection["~DESCRIPTION"] = $arFields["~DETAIL_TEXT"];
		$arSection["DESCRIPTION_TYPE"] = $arFields["DETAIL_TEXT_TYPE"];
		$arSection["~DESCRIPTION_TYPE"] = $arFields["~DETAIL_TEXT_TYPE"];
		$arFields['DETAIL_PICTURE'] = intval($arFields['DETAIL_PICTURE']);
		$arSection['DETAIL_PICTURE'] = ( 0 < $arFields['DETAIL_PICTURE'] ? CFile::GetFileArray($arFields['DETAIL_PICTURE']) : false );


		$arSection["sPROPERTIES"] = $sElement->GetProperties();

		foreach ($arSection["sPROPERTIES"] as $key => $propParams) {
			if ( !in_array($key, $arParams["LIST_PROPERTY_CODE"]) || empty($propParams["~VALUE"]) ) {
				unset($arSection["sPROPERTIES"][$key]);
			}
		}

		$arResult["SECTION"] = $arSection; // записываем в $arResult
		*/
	}

	//$component = $this->getComponent();
	// $arParams = $component->applyTemplateModifications();

	/**
		* Добавляем списки типа справочник в $arResult. Сделано пока на один справочник, потом можно будет переделать на динамично все.
		*/
	$propertyCode = 'B_PIKTOGRAMY';
	$arHighloadProperty = $arResult["S_PROPERTIES"][$propertyCode];
	$sTableName = $arHighloadProperty['USER_TYPE_SETTINGS']['TABLE_NAME'];

	/**
		* Работаем только при условии, что
		*    - модуль highloadblock подключен
		*    - в описании присутствует таблица
		*    - есть заполненные значения 
		*/
	if (Loader::IncludeModule('highloadblock') && !empty($sTableName) && !empty($arHighloadProperty["VALUE"]))
	{
		$hlblock = HL\HighloadBlockTable::getRow([
			'filter' => [
				'=TABLE_NAME' => $sTableName
			],
		]);
		if ($hlblock) {
			/**
				* Магия highload-блоков компилируем сущность, чтобы мы смогли с ней работать
				* 
				*/
			$entity      = HL\HighloadBlockTable::compileEntity($hlblock);
			$entityClass = $entity->getDataClass();

			$arRecords = $entityClass::getList([
				'filter' => [
					'UF_XML_ID' => $arHighloadProperty["VALUE"],
				],
				'order' => [
					'UF_SORT' => 'ASC'
				]
			]);
			foreach ($arRecords as $record)
			{	
				/**
					* Тут любые преобразования с записью, полученной из таблицы.
					* Я транслировал почти все напрямую. 
					* 
					* Нужно помнить, что например в UF_FILE возвращается ID файла,
					* а не полный массив описывающий файл
					*/
				$arRecord = [
					'ID'                  => $record['ID'],
					'UF_NAME'             => $record['UF_NAME'],
					'UF_SORT'             => $record['UF_SORT'],
					'UF_XML_ID'           => $record['UF_XML_ID'],
					'UF_LINK'             => $record['UF_LINK'],
					'UF_DESCRIPTION'      => $record['UF_DESCRIPTION'],
					'UF_FULL_DESCRIPTION' => $record['UF_FULL_DESCRIPTION'],
					'UF_DEF'              => $record['UF_DEF'],
					'UF_FILE'             => [],
					'~UF_FILE'            => $record['UF_FILE'],
				];
				/**
					* Не очень быстрое решение - сколько записей в инфоблоке, столько файлов и получим
					* Хорошо было бы вынести под код и там за 1 запрос все получить, а не плодить
					* по дополнительному запросу на каждый файл
					*/
				if ( !empty($arRecord['~UF_FILE']) )
				{
					$arRecord['UF_FILE'] = \CFile::getById($arRecord['~UF_FILE'])->fetch();
				}

				$arHighloadProperty['EXTRA_VALUE'][] = $arRecord;
			}
		}
	}
	$arResult["S_PROPERTIES"][$propertyCode]["DISPLAY_VALUE"] = $arHighloadProperty['EXTRA_VALUE'];

	/** Делаем элемент неактивным, чтобы больше не обновлял */
	$el = new CIBlockElement;
	$res = $el->Update($thisElFields["ID"], array("ACTIVE" => "N"));
}