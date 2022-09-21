<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * Получаем список привязанных файлов
 */
$arFilter = array(
    "IBLOCK_TYPE" => "Files",
    "PROPERTY_B_IDDLYAFAYLA" => $arResult["ITEM"]["XML_ID"]
);
$arSelectFields =  array(
    "IBLOCK_ID",
    "ID",
    "IBLOCK_NAME",
);
$obFiles = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelectFields); // получает элементы инфоблока "файлы"

while ( $arFile = $obFiles->GetNextElement() ) {
    $obFields = $arFile->GetFields();
    $fileElement = $arFile->GetProperties(array(), array("CODE" => "FILES"));
    foreach ($fileElement["FILES"]["VALUE"] as $fileID) {
        $fileArray = CFile::GetFileArray($fileID);
        $fileArray["FILE_TYPE"] = $obFields["IBLOCK_NAME"];
        $arResult["ITEM"]["FILES"][] = $fileArray;
    } 
}

/**
 * Вывод в таблицу согласно заголовкам таблицы
 */
$arItem = $arResult["ITEM"];
$newDisplayProps = array();
foreach ( $arParams["T_HEADERS"] as $toDisplayProp ) {
    if ( !isset($arItem["DISPLAY_PROPERTIES"][$toDisplayProp["CODE"]]) ) {
        $thisProp = $arItem["PROPERTIES"][$toDisplayProp["CODE"]];
        $thisProp["DISPLAY_VALUE"] = $thisProp["~VALUE"];
        $newDisplayProps[$toDisplayProp["CODE"]] = $thisProp;
    } else {
        $newDisplayProps[$toDisplayProp["CODE"]] = $arItem["DISPLAY_PROPERTIES"][$toDisplayProp["CODE"]];
    }
}
$arResult["ITEM"]["DISPLAY_PROPERTIES"] = $newDisplayProps;
?>