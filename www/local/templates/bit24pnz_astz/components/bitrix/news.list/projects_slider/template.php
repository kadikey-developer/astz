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
?>
<div class="slider">
	<? if ($arParams["DISPLAY_TOP_PAGER"]) : ?>
		<?= $arResult["NAV_STRING"] ?><br />
	<? endif; ?>
	<div class="slider__navigation d-lg-none">
		<a href="javascript:void(0)" class="slider__prev js-slider-navigation-prev" role="button" aria-label="Предыдущий слайд">
			<span class="icon-chevron-slider rotate-180"></span>
		</a>
	</div>
	<div class="slider__body">
		<div class="swiper js-three-columns-slider">
			<div class="swiper-wrapper">
				<? foreach ($arResult["ITEMS"] as $arItem) : ?>
					<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
					<div class="swiper-slide border" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
						<? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])) : ?>
							<? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])) : ?>
								<a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="d-block aspect-ratio aspect-ratio_60">
									<img class="swiper-lazy" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" data-src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>" height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>" title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>" style="float:left" />
								</a>
							<? else : ?>
								<img class="swiper-lazy" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" data-src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>" height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>" title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>" style="float:left" />
							<? endif; ?>
						<? endif ?>
						<? if ($arParams["DISPLAY_DATE"] != "N" && $arItem["DISPLAY_ACTIVE_FROM"]) : ?>
							<span class="news-date-time"><? echo $arItem["DISPLAY_ACTIVE_FROM"] ?></span>
						<? endif ?>
						<? if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]) : ?>
							<? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])) : ?>
								<div class="text-left py-10 pt-xl-30 pb-xl-20 px-30">
									<a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>" class="text-truncate-2 text-uppercase ff-dinpro fw-700 fz-14 fz-md-18 mb-5 mb-lg-25"><? echo $arItem["NAME"] ?></a>
									<a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>" class="fw-700 fz-15">Подробнее</a>
								</div>
							<? else : ?>
								<div class="text-left py-10 pt-xl-30 pb-xl-20 px-30">
									<div class="text-truncate-2 text-uppercase ff-dinpro fw-700 fz-14 fz-md-18 mb-5 mb-lg-25"><? echo $arItem["NAME"] ?></div>
								</div>
							<? endif; ?>
						<? endif; ?>
						<? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]) : ?>
							<? echo $arItem["PREVIEW_TEXT"]; ?>
						<? endif; ?>
						<? foreach ($arItem["FIELDS"] as $code => $value) : ?>
							<small>
								<?= GetMessage("IBLOCK_FIELD_" . $code) ?>:&nbsp;<?= $value; ?>
							</small><br />
						<? endforeach; ?>
						<? foreach ($arItem["DISPLAY_PROPERTIES"] as $pid => $arProperty) : ?>
							<small>
								<?= $arProperty["NAME"] ?>:&nbsp;
								<? if (is_array($arProperty["DISPLAY_VALUE"])) : ?>
									<?= implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]); ?>
								<? else : ?>
									<?= $arProperty["DISPLAY_VALUE"]; ?>
								<? endif ?>
							</small><br />
						<? endforeach; ?>
					</div>
				<? endforeach; ?>
			</div>
			<div class="swiper-pagination"></div>
			<div class="swiper-button-prev"></div>
			<div class="swiper-button-next"></div>
		</div>
	</div>
	<div class="slider__navigation d-lg-none">
		<a href="javascript:void(0)" class="slider__next js-slider-navigation-next" role="button" aria-label="Следующий слайд">
			<span class="icon-chevron-slider"></span>
		</a>
	</div>
	<? if ($arParams["DISPLAY_BOTTOM_PAGER"]) : ?>
		<br /><?= $arResult["NAV_STRING"] ?>
	<? endif; ?>
</div>