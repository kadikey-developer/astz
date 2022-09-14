<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (isset($arParams["TEMPLATE_THEME"]) && !empty($arParams["TEMPLATE_THEME"]))
{
	$arAvailableThemes = array();
	$dir = trim(preg_replace("'[\\\\/]+'", "/", dirname(__FILE__)."/themes/"));
	if (is_dir($dir) && $directory = opendir($dir))
	{
		while (($file = readdir($directory)) !== false)
		{
			if ($file != "." && $file != ".." && is_dir($dir.$file))
				$arAvailableThemes[] = $file;
		}
		closedir($directory);
	}

	if ($arParams["TEMPLATE_THEME"] == "site")
	{
		$solution = COption::GetOptionString("main", "wizard_solution", "", SITE_ID);
		if ($solution == "eshop")
		{
			$templateId = COption::GetOptionString("main", "wizard_template_id", "eshop_bootstrap", SITE_ID);
			$templateId = (preg_match("/^eshop_adapt/", $templateId)) ? "eshop_adapt" : $templateId;
			$theme = COption::GetOptionString("main", "wizard_".$templateId."_theme_id", "blue", SITE_ID);
			$arParams["TEMPLATE_THEME"] = (in_array($theme, $arAvailableThemes)) ? $theme : "blue";
		}
	}
	else
	{
		$arParams["TEMPLATE_THEME"] = (in_array($arParams["TEMPLATE_THEME"], $arAvailableThemes)) ? $arParams["TEMPLATE_THEME"] : "blue";
	}
}
else
{
	$arParams["TEMPLATE_THEME"] = "blue";
}

$arParams["FILTER_VIEW_MODE"] = (isset($arParams["FILTER_VIEW_MODE"]) && toUpper($arParams["FILTER_VIEW_MODE"]) == "HORIZONTAL") ? "HORIZONTAL" : "VERTICAL";
$arParams["POPUP_POSITION"] = (isset($arParams["POPUP_POSITION"]) && in_array($arParams["POPUP_POSITION"], array("left", "right"))) ? $arParams["POPUP_POSITION"] : "left";

/**
 * Дополнительный параметр для создания пути с установленным фильтром
 */
global $arFilterSections;
if ( !empty($arFilterSections) ) {
	$arFilterSections["PARAMS"] = array(
		"~SMART_FILTER_PATH" => $arParams["~SMART_FILTER_PATH"],
	);
}

/**
 * Жёстко задаём сортировку для характеристик в фильтре
 */
$arFirstItems = array(
	"MOSHCHNOST_VT",
	"SVETOVOY_POTOK_LM",
	"TSVETOVAYA_TEMPERATURA_K",
	"INDEKS_TSVETOPEREDACHI",
	"IP_STEPEN_ZASHCHITY",
	"BAP_BLOK_AVARIYNOGO_PITANIYA",
	"UPRAVLENIE",
	"UGOL_RASSEYANIYA_",
	"TIP_SVETOPROPUSKNOY_ARMATURY",
	"TSVET_SVETOPROPUSKAYUSHCHEY_ARMATURY",
);
// $tempArray = array();
/*foreach ($arFirstItems as $cur) { // найти в $arResult текущее значение $arFirstItems
	
	?><pre><?// print_r($cur); ?></pre><?
	// $key = array_search("CODE" == $cur, $arResult["ITEMS"]);
	$key = array_search($cur, array_column($arResult["ITEMS"], 'CODE'));
	?><pre><?// print_r($key); ?></pre><?
	// array_push(array_values()
}*/

/*foreach ($arResult["ITEMS"] as $key => $item) { // получаем список ключей которые есть
	if ( in_array($item["CODE"], $arFirstItems) ) {
		array_search($arFirstItems)
	}
}*/

foreach ($arResult["ITEMS"] as $key => $item) { // Если в текущем $arResult есть значение из $arFirstItems
	if ( in_array($item["CODE"], $arFirstItems) ) {
		unset($tempArray);
		unset($arResult["ITEMS"][$key]);
		$arResult["ITEMS"] = array($key => $item) + $arResult["ITEMS"];
	}
} // подставляет их в обратном порядке в начало массива
?><pre><?// print_r($tempArray); ?></pre><?

?><pre><?// var_dump($arResult["ITEMS"]); ?></pre><?