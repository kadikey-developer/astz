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
$this->setFrameMode(true); ?>

<div class="swiper home-slider js-simple-slider">
	<? if ($arParams["DISPLAY_TOP_PAGER"]) : ?>
		<?= $arResult["NAV_STRING"] ?><br />
	<? endif; ?>
	<div class="swiper-wrapper">
		<? foreach ($arResult["ITEMS"] as $arItem) : ?>
			<?
			$this->AddEditAction(
				$arItem['ID'],
				$arItem['EDIT_LINK'],
				CIBlock::GetArrayByID(
					$arItem["IBLOCK_ID"],
					"ELEMENT_EDIT"
				)
			);
			$this->AddDeleteAction(
				$arItem['ID'],
				$arItem['DELETE_LINK'],
				CIBlock::GetArrayByID(
					$arItem["IBLOCK_ID"],
					"ELEMENT_DELETE"
				),
				array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))
			);
			?>
			<div id="<?= $this->GetEditAreaId($arItem['ID']); ?>" class="swiper-slide">
				<? if ($arParams["DISPLAY_PICTURE"] != "N") : ?>
					<img class="swiper-lazy" src="<?= $arItem["PREVIEW_PICTURE"]["SAFE_SRC"] ?>" data-src="<?= $arItem["PREVIEW_PICTURE"]["SAFE_SRC"] ?> " alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>">
				<? endif; ?>
				<div class="home-slider-content">
					<div class="home-slider-content__inner">
						<div class="home-slider-content__limiter">
							<? if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]) : ?>
								<div class="home-slider-content__title">
									<?= $arItem["NAME"] ?>
								</div>
							<? endif; ?>
							<? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]) : ?>
								<div class="home-slider-content__subtitle">
									<?= $arItem["PREVIEW_TEXT"]; ?>
								</div>
							<? endif; ?>
							<? if (isset($arItem["DISPLAY_PROPERTIES"]["URL"]) && ($arItem["PROPERTIES"]["URL"])) : ?>
								<div>
									<a href="<?= $arItem["PROPERTIES"]["URL"]["~VALUE"] ?>" class="btn btn-outline-light px-45 text-uppercase">Перейти</a>
								</div>
							<? endif; ?>
						</div>
					</div>
				</div>
			</div>
		<? endforeach; ?>
	</div>
	<div class="swiper-pagination"></div>
	<a href="javascript:void(0)" class="swiper-button-prev" role="button" aria-label="Предыдущий слайд">
		<span class="icon-chevron-slider rotate-180"></span>
	</a>
	<a href="javascript:void(0)" class="swiper-button-next" role="button" aria-label="Следующий слайд">
		<span class="icon-chevron-slider"></span>
	</a>
</div>