<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>

	<?foreach($arResult as $arItem):
		if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
			continue;?>

			<?if($arItem["SELECTED"]):?>
				<li class="header-menu__item text-red"><a href="#collapse-drop-menu" class="header-menu__link" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapse-drop-menu" aria-label="Дополнительное меню"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li class="header-menu__item"><a href="#collapse-drop-menu" class="header-menu__link" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapse-drop-menu" aria-label="Дополнительное меню"><?=$arItem["TEXT"]?></a></li>
			<?endif?>
		
	<?endforeach?>
<?endif?>