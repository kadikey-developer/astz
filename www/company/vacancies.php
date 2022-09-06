<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Вакансии");
?>
<div class="container typography">
	<? $APPLICATION->IncludeComponent(
		"bitrix:furniture.vacancies",
		".default",
		array(
			"AJAX_MODE" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_SHADOW" => "Y",
			"AJAX_OPTION_STYLE" => "Y",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"IBLOCK_ID" => "4",
			"IBLOCK_TYPE" => "vacancies"
		)
	); ?>
</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>