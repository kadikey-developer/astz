<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заголовок");
$APPLICATION->AddChainItem($APPLICATION->GetTitle());
?>

<div class="container typography text-grey fz-lg-18 fz-xl-20 px-xl-40">
	Text here...
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>