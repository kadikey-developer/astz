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
?>
<?
foreach($arResult["IBLOCKS"] as $arIBlock):?>
	<?$this->AddEditAction('iblock_'.$arIBlock['ID'], $arIBlock['ADD_ELEMENT_LINK'], CIBlock::GetArrayByID($arIBlock["ID"], "ELEMENT_ADD"));?>
	<div id="<?=$this->GetEditAreaId('iblock_'.$arIBlock['ID']);?>">
		<a href="<?=$arIBlock["LIST_PAGE_URL"]?>"><h2><?=$arIBlock["NAME"]?></h2></a>
		<div class="slider">
			<div class="slider__body">
				<div class="swiper js-three-columns-slider">
					<div class="swiper-wrapper">
						<?foreach($arIBlock["ITEMS"] as $arItem):?>
							<?
							$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
							$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNI_ELEMENT_DELETE_CONFIRM')));
							?>
							<div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="swiper-slide border">
								<? if ( isset($arItem["DISPLAY_PROPERTIES"]["FILES"]) ) $arFileValue = $arItem["DISPLAY_PROPERTIES"]["FILES"]["FILE_VALUE"]; ?>
								<? if (!is_array($arItem["PREVIEW_PICTURE"])) $arItem["PREVIEW_PICTURE"]["SRC"] = $this->GetFolder() . '/images/no_photo_' . $arItem["PROPERTIES"]["FILES"]["FILE_TYPE"] . '.jpg'; ?>
								<? if ( isset($arFileValue) && $arResult["USER_HAVE_ACCESS"] ) : ?>
									<a href="<?= $arFileValue["SRC"] ?>" class="d-block aspect-ratio aspect-ratio_60">
										<img class="swiper-lazy" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" data-src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>" height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>" title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>" style="float:left;object-fit:contain;-o-object-fit:contain;" />
									</a>
								<? else : ?>
									<img class="swiper-lazy" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" data-src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>" height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>" title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>" style="float:left;object-fit:contain;-o-object-fit:contain;" />
								<? endif; ?>
								<div class="text-left py-10 pt-xl-30 pb-xl-20 px-30">
									<? if ( isset($arFileValue) && $arResult["USER_HAVE_ACCESS"] ) : ?>
										<a href="<?= $arFileValue["SRC"] ?>" class="text-truncate-2 text-uppercase ff-dinpro fw-700 fz-14 fz-md-18 mb-5 mb-lg-25"><?=$arItem["NAME"] ?></a>
									<? else : ?>
										<div class="text-truncate-2 text-uppercase ff-dinpro fw-700 fz-14 fz-md-18 mb-5 mb-lg-25"><?=$arItem["NAME"] ?></div>
									<?endif;?>
								</div>
								<? if ($arItem["PREVIEW_TEXT"]) : ?>
									<? echo $arItem["PREVIEW_TEXT"]; ?>
								<? endif; ?>
								<? foreach ($arItem["DISPLAY_PROPERTIES"] as $pid => $arProperty) : ?>
									<? 
									if ( $pid == "FILES" ) {
										continue;
									} else {
										?>
										<small>
											<?= $arProperty["NAME"] ?>:&nbsp;
											<? if (is_array($arProperty["DISPLAY_VALUE"])) : ?>
												<?= implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]); ?>
											<? else : ?>
												<?= $arProperty["DISPLAY_VALUE"]; ?>
											<? endif ?>
										</small><br />
										<?
									}
									?>
								<? endforeach; ?>
							</div>
							<?unset($arFileValue);?>
						<?endforeach;?>
					</div>
					<div class="swiper-pagination"></div>
				</div>
			</div>
		</div>
	</div>
<?endforeach;?>