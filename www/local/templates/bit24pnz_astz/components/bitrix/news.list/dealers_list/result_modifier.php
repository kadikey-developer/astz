<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$arResult["yaMAP"] = array(
    /** Если карта большая и центруем по России */
    // "yandex_lat" => "55",
    // "yandex_lon" => "100",
    // "yandex_scale" => "4",
    /** Если карта маленькая, то центруем по Москве */
    "yandex_scale" => "5",
    "yandex_lat" => "55",
    "yandex_lon" => "40",
    "PLACEMARKS" => array()
);
$arFilter = array(
    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
    "ACTIVE" => "Y",
    "INCLUDE_SUBSECTIONS" => "Y"
);
$arFilter["SECTION_ID"] = $_REQUEST["SECTION_ID"] ?? "";
$request = $_REQUEST["SECTION_ID"] ?? "";
$arElements = CIBlockElement::GetList(
    array(),
    $arFilter,
    /*array(
        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "ACTIVE" => "Y",
        // "SECTION_ID" => (isset($_REQUEST["SECTION_ID"]) ? $_REQUEST["SECTION_ID"] : "")
    ),*/
    false,
    false,
    array(
        "ID",
        "NAME",
        "PROPERTY_B_SHIROTAIDOLGOTA",
    )
);
while ($element = $arElements->Fetch()) {
    $explodeCoor = explode(",", $element["PROPERTY_B_SHIROTAIDOLGOTA_VALUE"]);
    $arResult["yaMAP"]["PLACEMARKS"][] = array(
        // если в одной строке то использовать explode
        "LAT" => $explodeCoor[0],
        "LON" => $explodeCoor[1],
        "TEXT" => $element["ID"] . $element["NAME"]
    );
}
if (isset($request) && !$request == "") {
    $arResult["yaMAP"] = array(
        "yandex_lon" => $arResult["yaMAP"]["PLACEMARKS"][0]["LON"],
        "yandex_lat" => $arResult["yaMAP"]["PLACEMARKS"][0]["LAT"],
        "yandex_scale" => "10",
        "PLACEMARKS" => $arResult["yaMAP"]["PLACEMARKS"]
    );
}