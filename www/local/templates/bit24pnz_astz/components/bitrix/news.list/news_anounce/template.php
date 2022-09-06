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
<div class="row" id="home-accordion">
<div class="col-lg-6 mb-30 mb-lg-0">
	<?if($arParams["DISPLAY_TOP_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?><br />
	<?endif;?>
	<div>
		<?foreach($arResult["ITEMS"] as $key => $arItem):?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
					<span class="news-date-time"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
				<?endif?>
				<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
					<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
						<a
							class="d-block ff-dinpro fz-16 fz-md-20 fz-xl-25 fw-700 py-15 py-md-20 py-xl-30 border-bottom border-red js-collapse-lock-self"
							data-toggle="collapse"
							href="javascript:void(0)"
							data-target=".collapse-home-<?=$key?>"
							aria-expanded="true"
							id="heading-home-<?=$key?>"
						><?echo $arItem["NAME"]?>
						</a>
					<?else:?>
						<div><?echo $arItem["NAME"]?></div>
					<?endif;?>
				<?endif;?>
				<div class="collapse collapse-home-<?=$key?> <?=($key == 0 ? 'show' : '')?>" data-parent="#home-accordion">
					<div class="bg-grey-light py-15 py-lg-35 pl-1 pr-10">
						<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
							<div class="text-grey-dark mb-35 px-20"><?echo $arItem["PREVIEW_TEXT"];?></div>
						<?endif;?>
						<?foreach($arItem["FIELDS"] as $code=>$value):?>
							<small>
							<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
							</small><br />
						<?endforeach;?>
						<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
							<small>
							<?=$arProperty["NAME"]?>:&nbsp;
							<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
								<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
							<?else:?>
								<?=$arProperty["DISPLAY_VALUE"];?>
							<?endif?>
							</small><br />
						<?endforeach;?>
						<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
							<div class="text-dark fw-700 pl-20">
								<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">Подробнее</a>
							</div>
						<?endif;?>
					</div>
				</div>
			</div>
		<?endforeach;?>
	</div>
</div>
<div class="col-lg-6">
	<?if($arParams["DISPLAY_PICTURE"]!="N"):?>
		<?
		/**
		 * Старая версия аккордиона
		 */
		?>
		<?/*?>
		<?foreach($arResult["ITEMS"] as $key => $arItem):?>
			<div class="collapse collapse-home-<?=$key?> <?=($key == 0 ? 'show' : '')?>" data-parent="#home-accordion">
				<?if(is_array($arItem["PREVIEW_PICTURE"])):?>
					<div class="aspect-ratio aspect-ratio_70">
						<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
							<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
								<img
									class="lazyload"
									src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
									width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
									height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
									alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
									title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
								/>
							</a>
						<?else:?>
							<img
								class="lazyload"
								src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
								width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
								height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
								alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
								title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
							/>
						<?endif;?>
					</div>
				<?endif;?>
			</div>
		<?endforeach;?>
		<?*/?>
		<?
		/**
		 * Новая версия акордиона
		 */
		?>
		<div class="home-accordion-images">
			<?foreach($arResult["ITEMS"] as $key => $arItem):?>
				<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a class="home-accordion-images__item aspect-ratio" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
					<img class="lazyload" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
				</a>
				<?else:?>
				<div class="home-accordion-images__item aspect-ratio" href="#">
					<img class="lazyload" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
				</div>
				<?endif;?>
			<?endforeach;?>
		</div>
	<?endif?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
