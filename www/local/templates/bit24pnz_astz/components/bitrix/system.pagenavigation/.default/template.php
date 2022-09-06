<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>

<div class="d-flex align-items-center justify-content-between">
	<div class="d-none d-md-block">
		<?=$arResult["NavTitle"]?>
	
		<?if($arResult["bDescPageNumbering"] === true):?>
	
		<?=$arResult["NavFirstRecordShow"]?> <?=GetMessage("nav_to")?> <?=$arResult["NavLastRecordShow"]?> <?=GetMessage("nav_of")?> <?=$arResult["NavRecordCount"]?>
	</div>
	
	<div class="mx-n10 mx-xl-n20">
	
		<?if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
			<?if($arResult["bSavePage"]):?>
				<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><?=GetMessage("nav_begin")?></a>
				|
				<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><?=GetMessage("nav_prev")?></a>
				|
			<?else:?>
				<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=GetMessage("nav_begin")?></a>
				|
				<?if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"]+1) ):?>
					<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=GetMessage("nav_prev")?></a>
					|
				<?else:?>
					<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><?=GetMessage("nav_prev")?></a>
					|
				<?endif?>
			<?endif?>
		<?else:?>
			<?=GetMessage("nav_begin")?>&nbsp;|&nbsp;<?=GetMessage("nav_prev")?>&nbsp;|
		<?endif?>
	
		<?while($arResult["nStartPage"] >= $arResult["nEndPage"]):?>
			<?$NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;?>
	
			<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
				<b><?=$NavRecordGroupPrint?></b>
			<?elseif($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false):?>
				<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$NavRecordGroupPrint?></a>
			<?else:?>
				<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$NavRecordGroupPrint?></a>
			<?endif?>
	
			<?$arResult["nStartPage"]--?>
		<?endwhile?>
	
		|
	
		<?if ($arResult["NavPageNomer"] > 1):?>
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><?=GetMessage("nav_next")?></a>
			|
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"><?=GetMessage("nav_end")?></a>
		<?else:?>
			<?=GetMessage("nav_next")?>&nbsp;|&nbsp;<?=GetMessage("nav_end")?>
		<?endif?>
	
	<?else:?>
		<?=$arResult["NavFirstRecordShow"]?> <?=GetMessage("nav_to")?> <?=$arResult["NavLastRecordShow"]?> <?=GetMessage("nav_of")?> <?=$arResult["NavRecordCount"]?>
	</div>
	
	<div class="mx-n10 mx-xl-n20">
	
		<?if ($arResult["NavPageNomer"] > 1):?>
	
			<?if($arResult["bSavePage"]):?>
				<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1" class="btn btn-link px-10 px-xl-20"><?=GetMessage("nav_begin")?></a>
				|
				<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>" class="btn btn-link px-10 px-xl-20"><?=GetMessage("nav_prev")?></a>
				|
			<?else:?>
				<?/*<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" class="btn btn-link px-10 px-xl-20"><?=GetMessage("nav_begin")?></a>
				|*/?>
				<?if ($arResult["NavPageNomer"] > 2):?>
					<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>" class="btn btn-link px-10 px-xl-20"><span class="d-none d-xl-inline mr-20"><?=GetMessage("nav_prev")?></span><span class="icon-chevron-bold rotate-180 fz-12" aria-hidden="true"></span></a>
				<?else:?>
					<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" class="btn btn-link px-10 px-xl-20"><span class="d-none d-xl-inline mr-20"><?=GetMessage("nav_prev")?></span><span class="icon-chevron-bold rotate-180 fz-12" aria-hidden="true"></span></a>
				<?endif?>
			<?endif?>
	
		<?/*else:?>
			<?=GetMessage("nav_begin")?>&nbsp;|&nbsp;<?=GetMessage("nav_prev")?>&nbsp;|*/?>
		<?endif?>
	
		<?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>

			<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
				<a href="#" class="btn btn-link px-10 px-xl-20"><?=$arResult["nStartPage"]?></a>
			<?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
				<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" class="btn btn-link px-10 px-xl-20"><?=$arResult["nStartPage"]?></a>
			<?else:?>
				<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>" class="btn btn-link px-10 px-xl-20"><?=$arResult["nStartPage"]?></a>
			<?endif?>
			<?$arResult["nStartPage"]++?>
		<?endwhile?>
		<span>...</span>
	
		<?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>" class="btn btn-link px-10 px-xl-20"><?=$arResult["NavPageCount"]?></a>
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" class="btn btn-link px-10 px-xl-20"><span class="d-none d-xl-inline mr-20"><?=GetMessage("nav_next")?></span><span class="icon-chevron-bold fz-12" aria-hidden="true"></span></a>
		<?else:?>
			<?=GetMessage("nav_next")?>&nbsp;|&nbsp;<?=GetMessage("nav_end")?>
		<?endif?>
	
	<?endif?>
</div>


<?if ($arResult["bShowAll"]):?>
<noindex>
	<?if ($arResult["NavShowAll"]):?>
		|&nbsp;<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=0" rel="nofollow"><?=GetMessage("nav_paged")?></a>
	<?else:?>
		|&nbsp;<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=1" rel="nofollow"><?=GetMessage("nav_all")?></a>
	<?endif?>
</noindex>
<?endif?>

</div>
<div class="border-bottom border-blue-dark pt-5"></div>
<div class="border-top border-blue-dark"></div>