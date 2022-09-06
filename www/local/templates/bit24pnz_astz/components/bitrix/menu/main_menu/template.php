<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
<?
	foreach($arResult as $arItem):
		$selected = "";
		if($arParams["MAX_LEVEL"] == 1 || $arItem["DEPTH_LEVEL"] > 1 ) 
			continue;

		if($arItem["SELECTED"])
			$selected = "text-red";

		if( !$arItem["IS_PARENT"] || $arItem["PARAMS"]["NO_DEPTH"] ):
			?>
			<li class="header-menu__item <?=$selected;?>"><a href="<?=$arItem["LINK"]?>" class="header-menu__link"><?=$arItem["TEXT"]?></a></li>
		<?else:?>
			<li class="header-menu__item <?=$selected;?>">
				<a href="#submenu-<?=$arItem["ITEM_INDEX"]?>" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="submenu-<?=$arItem["ITEM_INDEX"]?>" class="header-menu__link"><?=$arItem["TEXT"]?></a>
			</li>
		<?endif?>
	<?endforeach?>
<?endif?>