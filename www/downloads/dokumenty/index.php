<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>
<div class="container">
	<? $APPLICATION->IncludeComponent(
		"bitrix:news.index",
		"all_files",
		array(
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"COMPONENT_TEMPLATE" => "all_files",
			"DETAIL_URL" => "",
			"FIELD_CODE" => array(0 => "", 1 => "",),
			"FILTER_NAME" => "arrFilter",
			"IBLOCKS" => array(0 => "18", 1 => "19",),
			"IBLOCK_SORT_BY" => "SORT",
			"IBLOCK_SORT_ORDER" => "ASC",
			"IBLOCK_TYPE" => "Files",
			"IBLOCK_URL" => "/downloads/dokumenty/list.php?IBLOCK=#IBLOCK_CODE#",
			"NEWS_COUNT" => "3",
			"PROPERTY_CODE" => array(0 => "", 1 => "FILES",),
			"SORT_BY1" => "ACTIVE_FROM",
			"SORT_BY2" => "SORT",
			"SORT_ORDER1" => "DESC",
			"SORT_ORDER2" => "ASC"
		)
	); ?>
</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>