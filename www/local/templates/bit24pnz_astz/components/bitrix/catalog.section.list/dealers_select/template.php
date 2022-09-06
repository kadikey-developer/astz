<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$this->addExternalJS($templateFolder . "/jquery.chained.js");

$strTitle = "";

/** через создание нового массива */
$arCountry = array();
$arCity = array();
foreach ($arResult["SECTIONS"] as $arSection) {
	if ($arSection["DEPTH_LEVEL"] == 1) {
		$arCountry[$arSection["ID"]] = array(
			"ID" => $arSection["ID"],
			"NAME" => $arSection["NAME"],
			"CODE" => $arSection["CODE"],
		);
	} else {
		$arCity[$arSection["ID"]] = array(
			"ID" => $arSection["ID"],
			"NAME" => $arSection["NAME"],
			"CODE" => $arSection["CODE"],
			"IBLOCK_SECTION_ID" => $arSection["IBLOCK_SECTION_ID"],
			"SECTION_PAGE_URL" => $arSection["SECTION_PAGE_URL"],
		);
	}
}
?>
<div class="lib-select lib-select-sm pb-20">
	<select name="country" id="country" class="js-lib-select">
		<option value="" disabled <?= ($_REQUEST["SECTION_ID"] ? "" : "selected") ?>>Выберите страну</option>
		<?
		foreach ($arCountry as $country) {
			$selected = ($arCity[$_REQUEST["SECTION_ID"]]["IBLOCK_SECTION_ID"] == $country["ID"] ? "selected" : "");
		?><option value="<?= $country["ID"] ?>" <?= $selected ?>><?= $country["NAME"] ?></option><?
																									}
																										?>
	</select>
</div>
<div class="lib-select lib-select-sm pb-20">
	<select name="city" id="city" class="js-lib-select" data-chained="country">
		<option value="" disabled <?= ($_REQUEST["SECTION_ID"] ? "" : "selected") ?>>Выберите город</option>
		<?
		foreach ($arCity as $city) {
			$selected = ($_REQUEST["SECTION_ID"] == $city["ID"] ? "selected" : "");
		?><option value="<?= $city["SECTION_PAGE_URL"] ?>" data-chained="<?= $city["IBLOCK_SECTION_ID"] ?>" <?= $selected ?>><?= $city["NAME"] ?></option><?
																																							}
																																								?>
	</select>
</div>
<?$curPage = $APPLICATION->GetCurPage();?>
<a href="<?=$curPage?>" class="text-white">Сбросить</a>
<?
