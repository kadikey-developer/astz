<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? if (!empty($arResult)) : 

$tagOpened = false;
foreach ($arResult as $arItem) {
	if ( $arItem["DEPTH_LEVEL"] == 1 && $arItem["IS_PARENT"] && !$arItem["PARAMS"]["NO_DEPTH"] ) {
		//echo $arItem["IS_PARENT"];
		if ( $tagOpened ) {
			echo "</ul></div></div></div></div>";
			$tagOpened = false;
		}
		?>

		<div class="collapse text-grey-dark" id="submenu-<?=$arItem["ITEM_INDEX"]?>" data-parent="#accordionSubmenu" aria-label="подменю <?=$arItem["TEXT"]?>">
			<div class="scrollbar py-20">
				<?/*<a class="header-drop__close" data-toggle="collapse" href="#submenu-<?=$arItem["ITEM_INDEX"]?>" role="button" aria-expanded="false" aria-controls="submenu-<?=$arItem["ITEM_INDEX"]?>" aria-label="Закрыть дополнительное меню">
					<span class="icon-close fz-30 lh-1 align-middle"></span>
				</a>*/?>
				<div class="container">
					<div class="tabs">
						<ul class="nav nav-tabs">
		<?
		$tagOpened = true;
	} elseif ($tagOpened && $arItem["DEPTH_LEVEL"] != 1) {

							if ($arItem["PERMISSION"] > "D") {
								?>
								<li class="nav-item">
									<a href="<?= $arItem["LINK"] ?>" class="nav-link my-10 <?=($arItem["SELECTED"] ? "active" : "")?>">
										<?= $arItem["TEXT"] ?>
									</a>
								</li>
								<?
							}
	} else {
		continue;
	}
}
if ( $tagOpened ) {
	echo ("</ul></div></div></div></div>");
	$tagOpened = false;
}
endif;