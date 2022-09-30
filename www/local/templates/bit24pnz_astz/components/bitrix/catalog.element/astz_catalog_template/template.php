<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
* @global CMain $APPLICATION
* @var array $arParams
* @var array $arResult
* @var CatalogSectionComponent $component
* @var CBitrixComponentTemplate $this
* @var string $templateName
* @var string $componentPath
* @var string $templateFolder
*/

$this->setFrameMode(true);
$this->addExternalJS($templateFolder . "/calculator.js"); // включаем скрипт калькулятора
$this->addExternalJS(SITE_TEMPLATE_PATH . "/js/FileSaver.js"); // включаем скрипт сохранения файлов
$this->addExternalJS(SITE_TEMPLATE_PATH . "/js/jszip.min.js"); // включаем скрипт архиватора
$this->addExternalJS(SITE_TEMPLATE_PATH . "/js/zippdfsave.js"); // включаем скрипт архиватора
// $this->addExternalJS($templateFolder . "/jspdf.js"); // включаем скрипт архиватора
// $this->addExternalJS("https://html2canvas.hertzen.com/dist/html2canvas.js");
// $this->addExternalJS("https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js");
$this->addExternalJS('https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.js');


$templateLibrary = array('popup', 'fx');
$currencyList = '';
if (!empty($arResult['CURRENCIES']))
{
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
	'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList,
	'ITEM' => array(
		'ID' => $arResult['ID'],
		'IBLOCK_ID' => $arResult['IBLOCK_ID'],
		'OFFERS_SELECTED' => $arResult['OFFERS_SELECTED'],
		'JS_OFFERS' => $arResult['JS_OFFERS']
	)
);
unset($currencyList, $templateLibrary);

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
	'ID' => $mainId,
	'DISCOUNT_PERCENT_ID' => $mainId.'_dsc_pict',
	'STICKER_ID' => $mainId.'_sticker',
	'BIG_SLIDER_ID' => $mainId.'_big_slider',
	'BIG_IMG_CONT_ID' => $mainId.'_bigimg_cont',
	'SLIDER_CONT_ID' => $mainId.'_slider_cont',
	'OLD_PRICE_ID' => $mainId.'_old_price',
	'PRICE_ID' => $mainId.'_price',
	'DISCOUNT_PRICE_ID' => $mainId.'_price_discount',
	'PRICE_TOTAL' => $mainId.'_price_total',
	'SLIDER_CONT_OF_ID' => $mainId.'_slider_cont_',
	'QUANTITY_ID' => $mainId.'_quantity',
	'QUANTITY_DOWN_ID' => $mainId.'_quant_down',
	'QUANTITY_UP_ID' => $mainId.'_quant_up',
	'QUANTITY_MEASURE' => $mainId.'_quant_measure',
	'QUANTITY_LIMIT' => $mainId.'_quant_limit',
	'BUY_LINK' => $mainId.'_buy_link',
	'ADD_BASKET_LINK' => $mainId.'_add_basket_link',
	'BASKET_ACTIONS_ID' => $mainId.'_basket_actions',
	'NOT_AVAILABLE_MESS' => $mainId.'_not_avail',
	'COMPARE_LINK' => $mainId.'_compare_link',
	'TREE_ID' => $mainId.'_skudiv',
	'DISPLAY_PROP_DIV' => $mainId.'_sku_prop',
	'DESCRIPTION_ID' => $mainId.'_description',
	'DISPLAY_MAIN_PROP_DIV' => $mainId.'_main_sku_prop',
	'OFFER_GROUP' => $mainId.'_set_group_',
	'BASKET_PROP_DIV' => $mainId.'_basket_prop',
	'SUBSCRIBE_LINK' => $mainId.'_subscribe',
	'TABS_ID' => $mainId.'_tabs',
	'TAB_CONTAINERS_ID' => $mainId.'_tab_containers',
	'SMALL_CARD_PANEL_ID' => $mainId.'_small_card_panel',
	'TABS_PANEL_ID' => $mainId.'_tabs_panel'
);
$obName = $templateData['JS_OBJ'] = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $mainId);
$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
	: $arResult['NAME'];
$title = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']
	: $arResult['NAME'];
$alt = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']
	: $arResult['NAME'];

$haveOffers = !empty($arResult['OFFERS']);
if ($haveOffers)
{
	$actualItem = $arResult['OFFERS'][$arResult['OFFERS_SELECTED']] ?? reset($arResult['OFFERS']);
	$showSliderControls = false;

	foreach ($arResult['OFFERS'] as $offer)
	{
		if ($offer['MORE_PHOTO_COUNT'] > 1)
		{
			$showSliderControls = true;
			break;
		}
	}
}
else
{
	$actualItem = $arResult;
	$showSliderControls = $arResult['MORE_PHOTO_COUNT'] > 0;
}

$skuProps = array();
$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
$measureRatio = $actualItem['ITEM_MEASURE_RATIOS'][$actualItem['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
$showDiscount = $price['PERCENT'] > 0;

if ($arParams['SHOW_SKU_DESCRIPTION'] === 'Y')
{
	$skuDescription = false;
	foreach ($arResult['OFFERS'] as $offer)
	{
		if ($offer['DETAIL_TEXT'] != '' || $offer['PREVIEW_TEXT'] != '')
		{
			$skuDescription = true;
			break;
		}
	}
	$showDescription = $skuDescription || !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
}
else
{
	$showDescription = !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
}
$showBuyBtn = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION']);
$buyButtonClassName = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-primary' : 'btn-link';
$showAddBtn = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']);
$showButtonClassName = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-primary' : 'btn-link';
$showSubscribe = $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' && ($arResult['PRODUCT']['SUBSCRIBE'] === 'Y' || $haveOffers);

$arParams['MESS_BTN_BUY'] = $arParams['MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCE_CATALOG_BUY');
$arParams['MESS_BTN_ADD_TO_BASKET'] = $arParams['MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCE_CATALOG_ADD');
$arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE'] ?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE');
$arParams['MESS_BTN_COMPARE'] = $arParams['MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCE_CATALOG_COMPARE');
$arParams['MESS_PRICE_RANGES_TITLE'] = $arParams['MESS_PRICE_RANGES_TITLE'] ?: Loc::getMessage('CT_BCE_CATALOG_PRICE_RANGES_TITLE');
$arParams['MESS_DESCRIPTION_TAB'] = $arParams['MESS_DESCRIPTION_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_DESCRIPTION_TAB');
$arParams['MESS_PROPERTIES_TAB'] = $arParams['MESS_PROPERTIES_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_PROPERTIES_TAB');
$arParams['MESS_COMMENTS_TAB'] = $arParams['MESS_COMMENTS_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_COMMENTS_TAB');
$arParams['MESS_SHOW_MAX_QUANTITY'] = $arParams['MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCE_CATALOG_SHOW_MAX_QUANTITY');
$arParams['MESS_RELATIVE_QUANTITY_MANY'] = $arParams['MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['MESS_RELATIVE_QUANTITY_FEW'] = $arParams['MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_FEW');

$positionClassMap = array(
	'left' => 'product-item-label-left',
	'center' => 'product-item-label-center',
	'right' => 'product-item-label-right',
	'bottom' => 'product-item-label-bottom',
	'middle' => 'product-item-label-middle',
	'top' => 'product-item-label-top'
);

$discountPositionClass = 'product-item-label-big';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION']))
{
	foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos)
	{
		$discountPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$labelPositionClass = 'product-item-label-big';
if (!empty($arParams['LABEL_PROP_POSITION']))
{
	foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos)
	{
		$labelPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$themeClass = isset($arParams['TEMPLATE_THEME']) ? ' bx-'.$arParams['TEMPLATE_THEME'] : '';
?>
<!-- <div class="bx-catalog-element<?=$themeClass?>" id="<?=$itemIds['ID']?>" itemscope itemtype="http://schema.org/Product"> -->
<div id="<?=$itemIds['ID']?>" itemscope itemtype="http://schema.org/Product">

	<div class="container">
		<div class="text-center mb-30 mb-lg-60">
			<h1 class="fz-20 fz-lg-36 ff-dinpro fw-700 text-uppercase mb-0"><?=$arResult['SECTION']['PATH'][0]['NAME']?></h1>
		</div>
	</div>
	<div class="container">
		<div id="printToPDF" class="product"> <!-- id можно удалить если используется html2pdf -->
			<div class="row pdfBreakAfter">
				<div class="col-md-6">
					<div class="product-slider" id="<?=$itemIds['BIG_SLIDER_ID']?>">
						<div class="product__3d">
							<a href="#" class="text-red" aria-hidden="true">
								<span class="icon-3d"></span>
							</a>
						</div>
						<?/*<span class="product-item-detail-slider-close" data-entity="close-popup"></span>
						<!-- <div class="product-item-detail-slider-block
						<?=($arParams['IMAGE_RESOLUTION'] === '1by1' ? 'product-item-detail-slider-block-square' : '')?>"
							data-entity="images-slider-block"> -->*/?>
							<?/*<div class="product-item-label-text <?=$labelPositionClass?>" id="<?=$itemIds['STICKER_ID']?>"
								<?=(!$arResult['LABEL'] ? 'style="display: none;"' : '' )?>>*/?>
								<?php
								if ($arResult['LABEL'] && !empty($arResult['LABEL_ARRAY_VALUE']))
								{
									foreach ($arResult['LABEL_ARRAY_VALUE'] as $code => $value)
									{
										?>
										<div <?=(!isset($arParams['LABEL_PROP_MOBILE'][$code]) ? ' class="hidden-xs"' : '')?>>
											<span title="<?=$value?>"><?=$value?></span>
										</div>
										<?php
									}
								}
								?>
							<?/*</div>*/?>
							<?php
							if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y')
							{
								if ($haveOffers)
								{
									?>
									<div class="product-item-label-ring <?=$discountPositionClass?>"
										id="<?=$itemIds['DISCOUNT_PERCENT_ID']?>"
										style="display: none;">
									</div>
									<?php
								}
								else
								{
									if ($price['DISCOUNT'] > 0)
									{
										?>
										<div class="product-item-label-ring <?=$discountPositionClass?>"
											id="<?=$itemIds['DISCOUNT_PERCENT_ID']?>"
											title="<?=-$price['PERCENT']?>%">
											<span><?=-$price['PERCENT']?>%</span>
										</div>
										<?php
									}
								}
							}
							?>
							<?php
							if (!empty($actualItem['MORE_PHOTO']))
							{
								?>
								<div class="swiper product-slider__top js-product-slider-top" <?/*data-entity="images-slider-block"*/?>>
									<div class="swiper-wrapper" <?/*data-entity="images-container"*/?>>
										<?
										foreach ($actualItem['MORE_PHOTO'] as $key => $photo)
										{
											?>
											<?/*<div class="product-item-detail-slider-image<?=($key == 0 ? ' active' : '')?>" data-entity="image" data-id="<?=$photo['ID']?>">*/?>
											<div class="swiper-slide" data-entity="image" data-id="<?=$photo['ID']?>">
												<div class="swiper-slide-container">
													<div class="aspect-ratio aspect-ratio_100 my-50">
														<img src="<?=$photo['SRC']?>" alt="<?=$alt?>" title="<?=$title?>"<?=($key == 0 ? ' itemprop="image"' : '')?>>
													</div>
												</div>
											</div>
											<?
										}
										?>
									</div>
								</div>
								<?
							}
							if ($arParams['SLIDER_PROGRESS'] === 'Y')
							{
								?>
								<div class="product-item-detail-slider-progress-bar" data-entity="slider-progress-bar" style="width: 0;"></div>
								<?
							}

						if ($showSliderControls)
						{
							if ($haveOffers)
							{
								foreach ($arResult['OFFERS'] as $keyOffer => $offer)
								{
									if (!isset($offer['MORE_PHOTO_COUNT']) || $offer['MORE_PHOTO_COUNT'] <= 0)
										continue;
									$strVisible = $arResult['OFFERS_SELECTED'] == $keyOffer ? '' : 'none';
									?>
									<div class="product-item-detail-slider-controls-block" id="<?=$itemIds['SLIDER_CONT_OF_ID'].$offer['ID']?>" style="display: <?=$strVisible?>;">
										<?php
										foreach ($offer['MORE_PHOTO'] as $keyPhoto => $photo)
										{
											?>
											<div class="product-item-detail-slider-controls-image<?=($keyPhoto == 0 ? ' active' : '')?>"
												data-entity="slider-control" data-value="<?=$offer['ID'].'_'.$photo['ID']?>">
												<img src="<?=$photo['SRC']?>">
											</div>
											<?php
										}
										?>
									</div>
									<?php
								}
							}
							else
							{
								?>
								<div class="slider d-flex justify-content-center align-items-center" id="<?=$itemIds['SLIDER_CONT_ID']?>">
									<?php
									if (!empty($actualItem['MORE_PHOTO']))
									{
										if ($showSliderControls > 1) {
										?>
											<div>
												<a
														href="javascript:void(0)"
														class="d-inline-block lh-1 p-10 mt-45 js-thumbs-prev"
														role="button"
														aria-label="Предыдущий слайд"
												>
													<span class="icon-chevron-bold fz-18 rotate-180"></span>
												</a>
											</div>
										<?
										}
										?>
										<div class="slider__body">
											<div class="swiper product-slider__thumbs js-product-slider-thumbs">
												<div class="swiper-wrapper">
													<?
													foreach ($actualItem['MORE_PHOTO'] as $key => $photo)
													{
														?>
														<div class="swiper-slide">
															<div class="swiper-slide-container">
																<div class="aspect-ratio aspect-ratio_100" <?/*data-entity="slider-control" data-value="<?=$photo['ID']?>"*/?>>
																	<img src="<?=$photo['SRC']?>" alt="">
																	<a href="#" class="product-slider__open" data-toggle="modal"
																		data-target="#modal-product-slider"
																		aria-label="Посмотреть изображение полностью">
																		<span class="icon-search"></span>
																	</a>
																</div>
															</div>
														</div>
														<?php
													}
													?>
												</div>
											</div>
										</div>
										<?
										if ($showSliderControls > 1)
										{
										?>
										<div>
											<a
													href="javascript:void(0)"
													class="d-inline-block lh-1 p-10 mt-45 js-thumbs-next"
													role="button"
													aria-label="Следующий слайд"
											>
												<span class="icon-chevron-bold fz-18"></span>
											</a>
										</div>
										<?
										}
									}
									?>
								</div>
								<?
								if (!empty($actualItem['MORE_PHOTO'])) {
									?>
									<!-- slider Modal -->
									<div class="modal fade" id="modal-product-slider" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-body">
													<button
															type="button"
															class="close"
															data-dismiss="modal"
															aria-label="Закрыть диалговое окно"
													>
														<span class="icon-close" aria-hidden="true"></span>
													</button>

													<div class="slider">
														<div class="slider__navigation">
															<a href="javascript:void(0)"
															class="slider__prev js-modal-prev" role="button"
															aria-label="Предыдущий слайд">
																<span class="icon-chevron-thin rotate-180"></span>
															</a>
														</div>
														<div class="slider__body">
															<div class="swiper js-product-slider-modal">
																<div class="swiper-wrapper">
																	<?
																	foreach ($actualItem['MORE_PHOTO'] as $key => $photo)
																	{
																		?>
																		<div class="swiper-slide">
																			<a href="<?=$photo['SRC']?>">
																				<img class="swiper-lazy"
																					src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
																					data-src="<?=$photo['SRC']?>" alt="">
																			</a>
																		</div>
																		<?
																	}
																	?>
																</div>
																<div class="swiper-pagination"></div>
															</div>
														</div>
														<div class="slider__navigation">
															<a href="javascript:void(0)"
															class="slider__next js-modal-next" role="button"
															aria-label="Следующий слайд">
																<span class="icon-chevron-thin"></span>
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<?
								}
							}
						}
						?>
				</div>
			</div>
			<div class="col-md-6 pt-30 pt-md-0">
				<?if ($arParams['DISPLAY_NAME'] === 'Y'):?>
					<div class="border-left pl-0 pl-md-30">
						<div class="ff-dinpro fz-22 fw-700 mb-10">
							<?=$name?>
						</div>
						<?if (!empty($actualItem['PROPERTIES']['CML2_ARTICLE']['VALUE'])):?>
						<div class="ff-dinpro fz-20 mb-25">
							Код: <?=$actualItem['PROPERTIES']['CML2_ARTICLE']['VALUE']?>
						</div>
						<?if ( !empty($actualItem["PROPERTIES"]["KOD_PROMYSHLENNOY_PRODUKTSII_PO_TN_VED_EAES"]["VALUE"]) ):?>
							<div class="ff-dinpro fz-20 mb-10">
								<?=$actualItem["PROPERTIES"]["KOD_PROMYSHLENNOY_PRODUKTSII_PO_TN_VED_EAES"]["NAME"]?>: <?=$actualItem["PROPERTIES"]["KOD_PROMYSHLENNOY_PRODUKTSII_PO_TN_VED_EAES"]["VALUE"]?>
							</div>
						<?endif;?>
						<?if ( !empty($actualItem["PROPERTIES"]["KOD_PROMYSHLENNOY_PRODUKTSII_PO_OK_034_2014_KPES_2"]["VALUE"]) ):?>
							<div class="ff-dinpro fz-20 mb-10">
								<?=$actualItem["PROPERTIES"]["KOD_PROMYSHLENNOY_PRODUKTSII_PO_OK_034_2014_KPES_2"]["NAME"]?>: <?=$actualItem["PROPERTIES"]["KOD_PROMYSHLENNOY_PRODUKTSII_PO_OK_034_2014_KPES_2"]["VALUE"]?>
							</div>
						<?endif;?>

						<?endif;?>
						<?
						if ( !empty($actualItem["DISPLAY_PROPERTIES"]["B_PIKTOGRAMY"]["DISPLAY_VALUE"]) && isset($actualItem["DISPLAY_PROPERTIES"]["B_PIKTOGRAMY"]) ) {
							?>
							<div class="product-properties" id="properties-accordion">
								<div class="product-properties__labels">
									<?
									foreach ( $actualItem["DISPLAY_PROPERTIES"]["B_PIKTOGRAMY"]["DISPLAY_VALUE"] as $piktogram ) {
										?>
										<div class="product-properties__label">
											<a href="#prop-<?=$piktogram['ID']?>" class="d-block aspect-ratio aspect-ratio_100"
												data-toggle="collapse" role="button" aria-expanded="false" aria-controls="prop-<?=$piktogram['ID']?>"
												id="heading-properties-<?=$piktogram['ID']?>"
											>
												<span>
													<img class="lazyload" data-src="/upload/<?=$piktogram['UF_FILE']['SUBDIR']?>/<?=$piktogram['UF_FILE']['FILE_NAME']?>" alt="PROPERTY_NAME">
												</span>
											</a>
										</div>
										<?
									}
									?>
								</div>
								<div class="product-properties__descriptions">
									<?
									foreach ( $actualItem["DISPLAY_PROPERTIES"]["B_PIKTOGRAMY"]["DISPLAY_VALUE"] as $description ) {
										if (empty($description["UF_FULL_DESCRIPTION"]))
											continue;
										?>
										<div class="product-properties__description collapse" id="prop-<?=$description['ID']?>" data-parent="#properties-accordion" aria-labelledby="heading-properties-<?=$description['ID']?>">
											<div class="properties-description">
												<div class="properties-description__img">
													<div class=" aspect-ratio aspect-ratio_100">
														<img class="lazyload" data-src="/upload/<?=$description['UF_FILE']['SUBDIR']?>/<?=$description['UF_FILE']['FILE_NAME']?>" alt="PROPERTY_NAME">
													</div>
												</div>
												<div class="properties-description__text">
													<?=$description["UF_FULL_DESCRIPTION"]?>
												</div>
											</div>
										</div>
										<?
									}
									?>
								</div>

							</div>
							<?
						}
						?>
						<div class="border-bottom mb-20 mb-lg-30"></div>
						<div class="ff-dinpro fw-700 fz-18 mb-5">
							Применение
						</div>
						<div class="mb-15 mb-lg-20">
							<?=($actualItem['PROPERTIES']['PRIMENENIE']['~VALUE'])?>
						</div>
						<?/*<div
							data-entity="tab-container"
							data-value="description"
							itemprop="description" id="<?=$itemIds['DESCRIPTION_ID']?>">
								<?php
								if ($actualItem['PREVIEW_TEXT'] != '' && ($arParams['DISPLAY_PREVIEW_TEXT_MODE'] === 'S' || ($arParams['DISPLAY_PREVIEW_TEXT_MODE'] === 'E' && $actualItem['DETAIL_TEXT'] == '')))
								{
									echo $actualItem['PREVIEW_TEXT_TYPE'] === 'html' ? $actualItem['PREVIEW_TEXT'] : '<p>'.$actualItem['PREVIEW_TEXT'].'</p>';
								}

								if (!empty($actualItem['PROPERTIES']['TOP_DESCR']['VALUE']))
								{
									echo $actualItem['PROPERTIES']['TOP_DESCR']['USER_TYPE'] === 'HTML' ? $actualItem['PROPERTIES']['TOP_DESCR']['~VALUE']['TEXT'] : '<p>' . $actualItem['PROPERTIES']['TOP_DESCR']['VALUE'] . '</p>';
								}
								?>
						</div>*/?>
						<?php
						$showOffersBlock = $haveOffers && !empty($arResult['OFFERS_PROP']);
						$mainBlockProperties = array_intersect_key($arResult['DISPLAY_PROPERTIES'], $arParams['MAIN_BLOCK_PROPERTY_CODE']);
						$showPropsBlock = !empty($mainBlockProperties) || $arResult['SHOW_OFFERS_PROPS'];
						$showBlockWithOffersAndProps = $showOffersBlock || $showPropsBlock;
						?>
						<div class="<?=($showBlockWithOffersAndProps ? "" : "col-md-4"); ?>">								
								<?php
								if ($showBlockWithOffersAndProps)
								{
									foreach ($arParams['PRODUCT_INFO_BLOCK_ORDER'] as $blockName)
									{
										switch ($blockName)
										{
											case 'sku':
												if ($showOffersBlock)
												{
													?>
													<div class="mb-3" id="<?=$itemIds['TREE_ID']?>">
														<?php
														foreach ($arResult['SKU_PROPS'] as $skuProperty)
														{
															if (!isset($arResult['OFFERS_PROP'][$skuProperty['CODE']]))
																continue;
															$propertyId = $skuProperty['ID'];
															$skuProps[] = array(
																'ID' => $propertyId,
																'SHOW_MODE' => $skuProperty['SHOW_MODE'],
																'VALUES' => $skuProperty['VALUES'],
																'VALUES_COUNT' => $skuProperty['VALUES_COUNT']
															);
															?>
															<div data-entity="sku-line-block" class="mb-3">
																<div class="product-item-scu-container-title"><?=htmlspecialcharsEx($skuProperty['NAME'])?></div>
																<div class="product-item-scu-container">
																	<div class="product-item-scu-block">
																		<div class="product-item-scu-list">
																			<ul class="product-item-scu-item-list">
																				<?php
																				foreach ($skuProperty['VALUES'] as &$value)
																				{
																					$value['NAME'] = htmlspecialcharsbx($value['NAME']);
																					if ($skuProperty['SHOW_MODE'] === 'PICT')
																					{
																						?>
																						<li class="product-item-scu-item-color-container" title="<?=$value['NAME']?>"
																							data-treevalue="<?=$propertyId?>_<?=$value['ID']?>"
																							data-onevalue="<?=$value['ID']?>">
																							<div class="product-item-scu-item-color-block">
																								<div class="product-item-scu-item-color" title="<?=$value['NAME']?>"
																									style="background-image: url('<?=$value['PICT']['SRC']?>');">
																								</div>
																							</div>
																						</li>
																						<?php
																					}
																					else
																					{
																						?>
																						<li class="product-item-scu-item-text-container" title="<?=$value['NAME']?>"
																							data-treevalue="<?=$propertyId?>_<?=$value['ID']?>"
																							data-onevalue="<?=$value['ID']?>">
																							<div class="product-item-scu-item-text-block">
																								<div class="product-item-scu-item-text"><?=$value['NAME']?></div>
																							</div>
																						</li>
																						<?php
																					}
																				}
																				?>
																			</ul>
																			<div style="clear: both;"></div>
																		</div>
																	</div>
																</div>
															</div>
															<?php
														}
														?>
													</div>
													<?php
												}
												break;
											case 'props':
												if ($showPropsBlock)
												{
													?>
													<div>
														<div class="mb-15 mb-lg-20">
															<?php
															if (!empty($mainBlockProperties))
															{
																foreach ($mainBlockProperties as $property)
																{
																	?>
																	<div>
																		<span class="ff-dinpro fw-500 fz-18"><?=$property['NAME']?>:</span>
																		<?/*<span class="product-item-detail-properties-dots"></span>*/?>
																		<?=(is_array($property['DISPLAY_VALUE'])
																				? implode(' / ', $property['DISPLAY_VALUE'])
																				: $property['DISPLAY_VALUE'])?>
																	</div>
																	<?
																}
															}
															if ($arResult['SHOW_OFFERS_PROPS'])
															{
																?>
																<ul class="product-item-detail-properties" id="<?=$itemIds['DISPLAY_MAIN_PROP_DIV']?>"></ul>
																<?php
															}
															?>
														</div>
													</div>
													<?php
												}
												break;
										}
									}
								}
								?>
								<!-- <div class="<?=($showBlockWithOffersAndProps ? "col-lg-7" : "col-lg"); ?>">
									<div class="product-item-detail-pay-block">
										<?php 
										foreach ($arParams['PRODUCT_PAY_BLOCK_ORDER'] as $blockName)
										{
											switch ($blockName)
											{
												case 'rating':
													if ($arParams['USE_VOTE_RATING'] === 'Y')
													{
														?>
														<div class="mb-3">
															<?php
															$APPLICATION->IncludeComponent(
																'bitrix:iblock.vote',
																'bootstrap_v4',
																array(
																	'CUSTOM_SITE_ID' => $arParams['CUSTOM_SITE_ID'] ?? null,
																	'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
																	'IBLOCK_ID' => $arParams['IBLOCK_ID'],
																	'ELEMENT_ID' => $arResult['ID'],
																	'ELEMENT_CODE' => '',
																	'MAX_VOTE' => '5',
																	'VOTE_NAMES' => array('1', '2', '3', '4', '5'),
																	'SET_STATUS_404' => 'N',
																	'DISPLAY_AS_RATING' => $arParams['VOTE_DISPLAY_AS_RATING'],
																	'CACHE_TYPE' => $arParams['CACHE_TYPE'],
																	'CACHE_TIME' => $arParams['CACHE_TIME']
																),
																$component,
																array('HIDE_ICONS' => 'Y')
															);
															?>
														</div>
														<?php
													}
													break;
												case 'price':
													?>
													<div class="mb-3">
														<?php
														if ($arParams['SHOW_OLD_PRICE'] === 'Y')
														{
															?>
															<div class="product-item-detail-price-old mb-1"
																id="<?=$itemIds['OLD_PRICE_ID']?>"
																<?=($showDiscount ? '' : 'style="display: none;"')?>><?=($showDiscount ? $price['PRINT_RATIO_BASE_PRICE'] : '')?></div>
															<?php
														}
														?>
														<div class="product-item-detail-price-current mb-1" id="<?=$itemIds['PRICE_ID']?>"><?=$price['PRINT_RATIO_PRICE']?></div>
														<?php
														if ($arParams['SHOW_OLD_PRICE'] === 'Y')
														{
															?>
															<div class="product-item-detail-economy-price mb-1"
																id="<?=$itemIds['DISCOUNT_PRICE_ID']?>"
																<?=($showDiscount ? '' : 'style="display: none;"')?>><?php
																if ($showDiscount)
																{
																	echo Loc::getMessage('CT_BCE_CATALOG_ECONOMY_INFO2', array('#ECONOMY#' => $price['PRINT_RATIO_DISCOUNT']));
																}
																?></div>
															<?php
														}
														?>
													</div>
													<?php
													break;
												case 'priceRanges':
													if ($arParams['USE_PRICE_COUNT'])
													{
														$showRanges = !$haveOffers && count($actualItem['ITEM_QUANTITY_RANGES']) > 1;
														$useRatio = $arParams['USE_RATIO_IN_RANGES'] === 'Y';
														?>
														<div class="mb-3"
															<?=$showRanges ? '' : 'style="display: none;"'?>
															data-entity="price-ranges-block">
															<?php
															if ($arParams['MESS_PRICE_RANGES_TITLE'])
															{
																?>
																<div class="product-item-detail-info-container-title text-center">
																	<?= $arParams['MESS_PRICE_RANGES_TITLE'] ?>
																	<span data-entity="price-ranges-ratio-header">
																(<?= (Loc::getMessage(
																			'CT_BCE_CATALOG_RATIO_PRICE',
																			array('#RATIO#' => ($useRatio ? $measureRatio : '1').' '.$actualItem['ITEM_MEASURE']['TITLE'])
																		)) ?>)
															</span>
																</div>
																<?php
															}
															?>
															<ul class="product-item-detail-properties" data-entity="price-ranges-body">
																<?php
																if ($showRanges)
																{
																	foreach ($actualItem['ITEM_QUANTITY_RANGES'] as $range)
																	{
																		if ($range['HASH'] !== 'ZERO-INF')
																		{
																			$itemPrice = false;
																			foreach ($arResult['ITEM_PRICES'] as $itemPrice)
																			{
																				if ($itemPrice['QUANTITY_HASH'] === $range['HASH'])
																				{
																					break;
																				}
																			}
																			if ($itemPrice)
																			{
																				?>
																				<li class="product-item-detail-properties-item">
																				<span class="product-item-detail-properties-name text-muted">
																					<?php
																					echo Loc::getMessage(
																							'CT_BCE_CATALOG_RANGE_FROM',
																							array('#FROM#' => $range['SORT_FROM'].' '.$actualItem['ITEM_MEASURE']['TITLE'])
																						).' ';
																					if (is_infinite($range['SORT_TO']))
																					{
																						echo Loc::getMessage('CT_BCE_CATALOG_RANGE_MORE');
																					}
																					else
																					{
																						echo Loc::getMessage(
																							'CT_BCE_CATALOG_RANGE_TO',
																							array('#TO#' => $range['SORT_TO'].' '.$actualItem['ITEM_MEASURE']['TITLE'])
																						);
																					}
																					?>
																				</span>
																					<span class="product-item-detail-properties-dots"></span>
																					<span class="product-item-detail-properties-value"><?=($useRatio ? $itemPrice['PRINT_RATIO_PRICE'] : $itemPrice['PRINT_PRICE'])?></span>
																				</li>
																				<?php
																			}
																		}
																	}
																}
																?>
															</ul>
														</div>
														<?php
														unset($showRanges, $useRatio, $itemPrice, $range);
													}
													break;
												case 'quantityLimit':
													if ($arParams['SHOW_MAX_QUANTITY'] !== 'N')
													{
														if ($haveOffers)
														{
															?>
															<div class="mb-3" id="<?=$itemIds['QUANTITY_LIMIT']?>" style="display: none;">
																<div class="product-item-detail-info-container-title text-center">
																	<?=$arParams['MESS_SHOW_MAX_QUANTITY']?>:
																</div>
																<span class="product-item-quantity" data-entity="quantity-limit-value"></span>
															</div>
															<?php
														}
														else
														{
															if (
																$measureRatio
																&& (float)$actualItem['PRODUCT']['QUANTITY'] > 0
																&& $actualItem['CHECK_QUANTITY']
															)
															{
																?>
																<div class="mb-3 text-center" id="<?=$itemIds['QUANTITY_LIMIT']?>">
																	<span class="product-item-detail-info-container-title"><?=$arParams['MESS_SHOW_MAX_QUANTITY']?>:</span>
																	<span class="product-item-quantity" data-entity="quantity-limit-value">
																	<?php
																	if ($arParams['SHOW_MAX_QUANTITY'] === 'M')
																	{
																		if ((float)$actualItem['PRODUCT']['QUANTITY'] / $measureRatio >= $arParams['RELATIVE_QUANTITY_FACTOR'])
																		{
																			echo $arParams['MESS_RELATIVE_QUANTITY_MANY'];
																		}
																		else
																		{
																			echo $arParams['MESS_RELATIVE_QUANTITY_FEW'];
																		}
																	}
																	else
																	{
																		echo $actualItem['PRODUCT']['QUANTITY'].' '.$actualItem['ITEM_MEASURE']['TITLE'];
																	}
																	?>
																</span>
																</div>
																<?php
															}
														}
													}
													break;
												case 'quantity':
													if ($arParams['USE_PRODUCT_QUANTITY'])
													{
														?>
														<div class="mb-3" <?= (!$actualItem['CAN_BUY'] ? ' style="display: none;"' : '') ?> data-entity="quantity-block">
															<?php
															if (Loc::getMessage('CATALOG_QUANTITY'))
															{
																?>
																<div class="product-item-detail-info-container-title text-center"><?= Loc::getMessage('CATALOG_QUANTITY') ?></div>
																<?php
															}
															?>
															<div class="product-item-amount">
																<div class="product-item-amount-field-container">
																	<span class="product-item-amount-field-btn-minus no-select" id="<?=$itemIds['QUANTITY_DOWN_ID']?>"></span>
																	<div class="product-item-amount-field-block">
																		<input class="product-item-amount-field" id="<?=$itemIds['QUANTITY_ID']?>" type="number" value="<?=$price['MIN_QUANTITY']?>">
																		<span class="product-item-amount-description-container">
																		<span id="<?=$itemIds['QUANTITY_MEASURE']?>"><?=$actualItem['ITEM_MEASURE']['TITLE']?></span>
																		<span id="<?=$itemIds['PRICE_TOTAL']?>"></span>
																	</span>
																	</div>
																	<span class="product-item-amount-field-btn-plus no-select" id="<?=$itemIds['QUANTITY_UP_ID']?>"></span>
																</div>
															</div>
														</div>
														<?php
													}
													break;
												case 'buttons':
													?>
													<div data-entity="main-button-container" class="mb-3">
														<div id="<?=$itemIds['BASKET_ACTIONS_ID']?>" style="display: <?=($actualItem['CAN_BUY'] ? '' : 'none')?>;">
															<?php
															if ($showAddBtn)
															{
																?>
																<div class="mb-3">
																	<a class="btn <?=$showButtonClassName?> product-item-detail-buy-button"
																		id="<?=$itemIds['ADD_BASKET_LINK']?>"
																		href="javascript:void(0);">
																		<?=$arParams['MESS_BTN_ADD_TO_BASKET']?>
																	</a>
																</div>
																<?php
															}
															if ($showBuyBtn)
															{
																?>
																<div class="mb-3">
																	<a class="btn <?=$buyButtonClassName?> product-item-detail-buy-button"
																		id="<?=$itemIds['BUY_LINK']?>"
																		href="javascript:void(0);">
																		<?=$arParams['MESS_BTN_BUY']?>
																	</a>
																</div>
																<?php
															}
															?>
														</div>
													</div>
													<?php
													if ($showSubscribe)
													{
														?>
														<div class="mb-3">
															<?php
															$APPLICATION->IncludeComponent(
																'bitrix:catalog.product.subscribe',
																'',
																array(
																	'CUSTOM_SITE_ID' => $arParams['CUSTOM_SITE_ID'] ?? null,
																	'PRODUCT_ID' => $arResult['ID'],
																	'BUTTON_ID' => $itemIds['SUBSCRIBE_LINK'],
																	'BUTTON_CLASS' => 'btn u-btn-outline-primary product-item-detail-buy-button',
																	'DEFAULT_DISPLAY' => !$actualItem['CAN_BUY'],
																	'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
																),
																$component,
																array('HIDE_ICONS' => 'Y')
															);
															?>
														</div>
														<?php
													}
													?>
													<div class="mb-3" id="<?=$itemIds['NOT_AVAILABLE_MESS']?>" style="display: <?=(!$actualItem['CAN_BUY'] ? '' : 'none')?>;">
														<a class="btn btn-primary product-item-detail-buy-button" href="javascript:void(0)" rel="nofollow"><?=$arParams['MESS_NOT_AVAILABLE']?></a>
													</div>
													<?php
													break;
											}
										}
										if ($arParams['DISPLAY_COMPARE'])
										{
											?>
											<div class="product-item-detail-compare-container">
												<div class="product-item-detail-compare">
													<div class="checkbox">
														<label class="m-0" id="<?=$itemIds['COMPARE_LINK']?>">
															<input type="checkbox" data-entity="compare-checkbox">
															<span data-entity="compare-title"><?=$arParams['MESS_BTN_COMPARE']?></span>
														</label>
													</div>
												</div>
											</div>
											<?php
										}
										?>
									</div>
								</div> -->
							
						</div>
						<div class="ff-dinpro fw-700 fz-20 mb-30 mb-lg-60">
							Базовая цена: <?=$actualItem['PROPERTIES']['B_TSENA']['VALUE']?> <?=$actualItem['PROPERTIES']['PRICECURRENCY']['VALUE']?>
							<?/*=$actualItem['PROPERTIES']['PRICE']['NAME']?>: <?=$actualItem['PROPERTIES']['PRICE']['VALUE']?> <?=$actualItem['PROPERTIES']['PRICECURRENCY']['VALUE']*/?>
						</div>
					</div>
				<?endif;?>
			</div>
		</div>
	</div>
</div>

<div class="py-25 py-lg-75"></div>

<div class="container">
	<div class="tabs" id="<?=$itemIds['TABS_ID']?>">
		<ul class="nav nav-tabs" id="series-tabs" role="tablist">
			<?php
			if (!empty($arResult['DISPLAY_PROPERTIES']) || $arResult['SHOW_OFFERS_PROPS'])
			{
				?>
				<li class="nav-item">
					<a 
						class="nav-link active"
						id="features-tab"
						data-toggle="tab"
						href="#features"
						role="tab"
						aria-controls="features"
						aria-selected="true">
						<?=$arParams['MESS_PROPERTIES_TAB']?>
					</a>
				</li>
				<?php
			}
			if ($showDescription)
			{
				?>
				<li class="nav-item">
					<a
						class="nav-link"
						id="description-tab"
						data-toggle="tab"
						href="#description"
						role="tab"
						aria-controls="description"
						aria-selected="false">
						<?=$arParams['MESS_DESCRIPTION_TAB']?>
					</a>
				</li>
				<?php
			}
			?>

			<li class="nav-item">
				<a
						class="nav-link"
						id="downloads-tab"
						data-toggle="tab"
						href="#downloads"
						role="tab"
						aria-controls="downloads"
						aria-selected="false"
				>
					Документы для скачивания
				</a>
			</li>

			<li class="nav-item">
				<a
					class="nav-link"
					id="accessories-tab"
					data-toggle="tab"
					href="#accessories"
					role="tab"
					aria-controls="accessories"
					aria-selected="false"
				>
					Аксессуары
				</a>
			</li>

			<li class="nav-item">
				<a
						class="nav-link"
						id="calculation-tab"
						data-toggle="tab"
						href="#calculation"
						role="tab"
						aria-controls="calculation"
						aria-selected="false"
				>
					Расчет освещенности
				</a>
			</li>

			<?
			if ($arParams['USE_COMMENTS'] === 'Y')
			{
				/*?>
				<li class="product-item-detail-tab" data-entity="tab" data-value="comments">
					<a href="javascript:void(0);" class="product-item-detail-tab-link">
						<span><?=$arParams['MESS_COMMENTS_TAB']?></span>
					</a>
				</li>
				<?php*/
			}
			?>
		</ul>
		<div id="<?=$itemIds['TAB_CONTAINERS_ID']?>">
			<div class="tab-content" id="series-tabs-content">
					<?php
					if (!empty($arResult['DISPLAY_PROPERTIES']) || $arResult['SHOW_OFFERS_PROPS'])
					{
						?>
						<div 
							class="tab-pane fade show active"
							id="features"
							role="tabpanel"
							aria-labelledby="features-tab">
							<?php
							if (!empty($arResult['DISPLAY_PROPERTIES']))
							{
								$arCardNamesRus = array(
									'ELECTRICAL_CHARS' => 'Электротехнические характеристики',
									'OPERATIONAL_CHARS' => 'Эксплуатационные характеристики',
									'LIGHTING_PARAMS' => 'Светотехнические параметры',
									'SYSTEM_LIGHT_CONTROL' => 'Система управлением освещением',
									'PACKING' => 'Упаковка, маркировка',
									'DIMENSIONS' => 'Габаритные характеристики',
									'DATCHIK' => 'Датчик',
									'LIGHT_SRC' => 'Источник света (параметры)',
									'EMERGENCY_LIGHT' => 'Аварийное освещение',
								);
								$arCardNames = array( // постараться реализовать через highload блоки
									'ELECTRICAL_CHARS' => array(
										0 => "P_PARAMETRY_PITANIYA_SVETOVOGO_PRIBORA",
										1 => "DLITELNOST_PUSKOVOGO_TOKA_MKS",
										2 => "KLASS_ENERGETICHESKOY_EFFEKTIVNOSTI_SVETILNIKA",
										3 => "KOLICHESTVO_SVETILNIKOV_NA_APPARAT_SHT",
										4 => "KOLICHESTVO_SVETILNIKOV_PODKLYUCHENNYKH_NA_ODNU_FA",
										5 => "KOEFFITSIENT_MOSHCHNOSTI_PF",
										6 => "MOSHCHNOST_SVETOVOGO_PRIBORA_VT",
										7 => "MOSHCHNOST_SVETOVOGO_PRIBORA_VT_1",
										8 => "NOMINALNOE_NAPRYAZHENIE_V",
										9 => "NORMIRUEMAYA_MAKSIMALNAYA_TEMPERATURA_OBMOTKI_S",
										10 => "PODKLYUCHAEMAYA_MOSHCHNOST_K_PRA_VT",
										11 => "PODKLYUCHAEMAYA_MOSHCHNOST_VT",
										12 => "POTERI_V_PRA_VT",
										13 => "PRA",
										14 => "PREVYSHENIE_TEMPERATURY_OBMOTKI_V_RABOCHEM_ANOMALN",
										15 => "PUSKOVOY_TOK_A",
										16 => "RABOCHIY_TOK_PRA_A",
										17 => "REKOMENDUEMOE_KOLICHESTVO_SVETILNIKOV_NA_AVTOMATIC",
										18 => "TIP_APPARATA_ZASHCHITY",
										19 => "TIP_NAPRYAZHENIYA",
										20 => "CHASTOTA_TOKA_PITAYUSHCHEY_SETI_GTS",
									),
									'OPERATIONAL_CHARS' => array(
										0 => "EX_MARKIROVKA_GAZ_",
										1 => "EX_MARKIROVKA_PYL",
										2 => "IP_STEPEN_ZASHCHITY",
										3 => "IP_STEPEN_ZASHCHITY_VNESHNEGO_PRA",
										4 => "IP_STEPEN_ZASHCHITY_OPTICHESKOY_CHASTI",
										5 => "KLASS_ZASHCHITY_OT_ELEKTRICHESKOGO_TOKA",
										6 => "KLASS_POZHAROOPASNOY_ZONY",
										7 => "KLIMATICHESKOE_ISPOLNENIE",
										8 => "MEKHANICHESKAYA_PROCHNOST",
										9 => "NERAVNOMERNOST_YARKOSTI_VYKHODNOGO_OTVERSTIYA_LMAX",
										10 => "RABOCHAYA_TEMPERATURA_MAX_C",
										11 => "RABOCHAYA_TEMPERATURA_MIN_C",
										12 => "STEPEN_ZASHCHITY_IK",
										13 => "KHIMOSTOYKOE_ISPOLNENIE",
									),
									'EMERGENCY_LIGHT' => array(
										0 => "AKKUMULYATORNAYA_BATAREYA",
										1 => "BAP_BLOK_AVARIYNOGO_PITANIYA",
										2 => "VREMYA_AKTIVATSII_SEK",
										3 => "VREMYA_ZADERZHKI_SEK",
										4 => "VREMYA_ZARYADKI_CH",
										5 => "VREMYA_PEREKHODA_SEK",
										6 => "VREMYA_RABOTY_CH",
										7 => "DISTANTSIYA_RASPOZNAVANIYA_M",
										8 => "INDIKATOR",
										9 => "MOSHCHNOST_V_REZHIME_",
										10 => "RAZMER_EVAKUATSIONNOGO_ZNAKA",
										11 => "REZHIM",
										12 => "REZHIM_RABOTY",
										13 => "SVETOVOY_POTOK_V_REZHIME_LM",
										14 => "TESTIROVANIE",
										15 => "ELEKTRONNAYA_ZASHCHITA_OT_POLNOY_RAZRYADKI_BATAREI",
									),
									'SYSTEM_LIGHT_CONTROL' => array(
										0 => "BREND",
										1 => "KNOPOCHNAYA_PANEL",
										2 => "KOLLICHESTVO_KANALOV_DIMMERA",
										3 => "KOLLICHESTVO_KANALOV_RELEYNOGO_MODULYA",
										4 => "MAKSIMALNAYA_DLINA_PROVODA_SHINY_DALI_SECHENIEM_V_",
										5 => "MAKSIMALNAYA_DLINA_PROVODA_SHINY_UPRAVLENIYA_1_10V",
										6 => "MAKSIMALNAYA_PODKLYUCHAEMAYA_MOSHCHNOST",
										7 => "MAKSIMALNYY_TOK_RELEYNOGO_MODULYA",
										8 => "MAKSIMALNYY_TOK_SHINY_DALI_BEZ_USILITELYA_SHINY_25",
										9 => "TIP_PRIBORA",
										10 => "TOK_POTREBLENIYA_USTROYSTVOM_OT_SHINY_UPRAVLENIYA",
										11 => "UPRAVLENIE",
										12 => "TSVET",
									),
									'PACKING' => array(
										0 => "P_GARANTIYA_ISKLYUCHENIYA",
										1 => "EAN13",
										2 => "ITF14",
										3 => "ITF14_1",
										4 => "VES_UPAKOVKI_KG_EAN13",
										5 => "VES_UPAKOVKI_KG_ITF14",
										6 => "VYSOTA_UPAKOVKI_M_EAN13",
										7 => "VYSOTA_UPAKOVKI_M_ITF14",
										8 => "GARANTIYA_LET",
										9 => "DLINA_UPAKOVKI_M_EAN13",
										10 => "DLINA_UPAKOVKI_M_ITF14",
										11 => "KOLICHESTVO_V_UPAKOVKE_SHT_EAN13",
										12 => "KOLICHESTVO_V_UPAKOVKE_SHT_ITF14",
										13 => "SROK_SLUZHBY_LET",
										14 => "SHIRINA_UPAKOVKI_M_EAN13",
										15 => "SHIRINA_UPAKOVKI_M_ITF14",
										16 => "EAN13",
17 => "ITF14", // здесь начинаются свойства аксессуаров
18 => "VES_BRUTTO_KG_EAN13",
19 => "VES_BRUTTO_KG_ITF14",
20 => "VES_NETTO_KG",
21 => "VYSOTA_UPAKOVKA_M_EAN13",
22 => "VYSOTA_UPAKOVKA_M_ITF14",
23 => "VYSOTA_M",
24 => "DLINA_TROSA_M",
25 => "DLINA_UPAKOVKA_M_EAN13",
26 => "DLINA_UPAKOVKA_M_ITF14",
27 => "DLINA_M",
28 => "KOLICHESTVO_V_KOMPLEKTE_SHT",
29 => "KOLICHESTVO_V_UPAKOVKE_SHT",
30 => "NEOBKHODIMOE_KOLICHESTVO",
31 => "POGONNYY_METRAZH_M",
32 => "SHIRINA_UPAKOVKA_M_EAN13",
33 => "SHIRINA_UPAKOVKA_M_ITF14",
34 => "SHIRINA_M",
									),
									'DIMENSIONS' => array(
										0 => "P_GABARITY_VNESHNEGO_ISTOCHNIKA_PITANIYA",
										1 => "VYSOTA_VNESHNEGO_PRA_MM",
										2 => "DLINA_VNESHNEGO_PRA_MM",
										3 => "DLINA_PROVODA_DO_PRA_MM",
										4 => "USTANOVOCHNAYA_DLINA_VNESHNEGO_PRA_MM",
										5 => "USTANOVOCHNAYA_SHIRINA_VNESHNEGO_PRA_MM",
										6 => "SHIRINA_VNESHNEGO_PRA_MM",
										7 => "VYSOTA_H_MM",
										8 => "VYSOTA_S_KREPLENIEM_H1_MM",
										9 => "GLUBINA_USTANOVKI_MM",
										10 => "DIAMETR_D_MM",
										11 => "DIAMETR_KONSOLI_OPORY_MM",
										12 => "DLINA_L_MM",
										13 => "DLINA_NISHI_MM",
										14 => "MASSA_KG",
										15 => "USTANOVOCHNAYA_DLINA_A_MM",
										16 => "USTANOVOCHNAYA_SHIRINA_A_MM",
										17 => "USTANOVOCHNYY_DIAMETR_D_MM",
										18 => "SHIRINA_B_MM",
										19 => "SHIRINA_NISHI_MM",
									),
									'DATCHIK' => array(
										0 => "VREMYA_RABOTY_POSLE_OBNARUZHENIYA_DVIZHENIYA_SEK",
										1 => "VREMYA_RABOTY_POSLE_OBNARUZHENIYA_SHUMA_SEK",
										2 => "VYSOTA_USTANOVKI_DATCHIKA_M",
										3 => "DATCHIK",
										4 => "ZADERZHKA_VKLYUCHENIYA_SEK",
										5 => "ZADERZHKA_VYKLYUCHENIYA_SEK",
										6 => "ZONA_VIDIMOSTI_M",
										7 => "MATERIAL_KORPUSA_DATCHIKA",
										8 => "NAIMENOVANIE_DATCHIKA",
										9 => "STANDART_PODKLYUCHENIYA",
										10 => "TIP_DATCHIKA",
										11 => "UGOL_OBNARUZHENIYA_OBEKTA_",
										12 => "UROVEN_OSVESHCHENNOSTI_NA_VKLYUCHENIE_LK",
										13 => "UROVEN_OSVESHCHENNOSTI_NA_VYKLYUCHENIE_LK",
										14 => "UROVEN_SHUMA_DB",
										15 => "VREMYA_RABOTY_POSLE_OBNARUZHENIYA_DVIZHENIYA_SEK",
16 => "VREMYA_RABOTY_POSLE_OBNARUZHENIYA_SHUMA_SEK", // здесь начинаются свойства аксессуаров
17 => "VYSOTA_USTANOVKI_M",
18 => "ZADERZHKA_VKLYUCHENIYA_SEK",
19 => "ZADERZHKA_VYKLYUCHENIYA_SEK",
20 => "ZONA_VIDIMOSTI_M",
21 => "MATERIAL_KORPUSA_DATCHIKA_1",
22 => "STANDART_PODKLYUCHENIYA",
23 => "TIP_DATCHIKA",
24 => "UGOL_OBNARUZHENIYA_OBEKTA_",
25 => "UROVEN_OSVESHCHENNOSTI_NA_VKLYUCHENIE_LK",
26 => "UROVEN_OSVESHCHENNOSTI_NA_VYKLYUCHENIE_LK",
27 => "UROVEN_SHUMA_DB",
									),
									'LIGHT_SRC' => array(
										0 => "ILCOS",
										1 => "V_KOMPLEKTE_SO_SVETOVYM_PRIBOROM",
										2 => "INDEKS_TSVETOPEREDACHI_IS",
										3 => "KLASS_ENERGETICHESKOY_EFFEKTIVNOSTI_ISTOCHNIKA_SVE",
										4 => "KOLICHESTVO_IS",
										5 => "LAMPA",
										6 => "MOSHCHNOST_LAMPY_VT",
										7 => "NAIMENOVANIE_LAMPY",
										8 => "PRIMECHANIYA_IS",
										9 => "SVETOVOY_POTOK_IS_LM",
										10 => "TSVETOVAYA_TEMPERATURA_IS_K",
										11 => "TSOKOL_IS",
									),
									'LIGHTING_PARAMS' => array(
										0 => "GABARITNAYA_YARKOST_KD_M2",
										1 => "IZMENENIE_SVETOVOGO_POTOKA_NE_BOLEE_",
										2 => "INDEKS_TSVETOPEREDACHI",
										3 => "KLASS_SVETORASPREDELENIYA",
										4 => "KOEFFITSIENT_PULSATSII_NE_BOLEE_",
										5 => "KPD_",
										6 => "KRIVAYA_SILY_SVETA_KSS",
										7 => "KRIVAYA_SILY_SVETA_KSS_1",
										8 => "MAKSIMALNAYA_SILA_SVETA_V_ZONE_SLEPIMOSTI_KD_KLM",
										9 => "OSEVAYA_SILA_SVETA_KD",
										10 => "OSEVAYA_SILA_SVETA_KD_1",
										11 => "SVETOVAYA_OTDACHA_LM_VT",
										12 => "SVETOVAYA_OTDACHA_LM_VT_1",
										13 => "LUMINOUS",
										14 => "LUMINOUS_1",
										15 => "TIP_SVETORASPREDELENIYA",
										16 => "TIP_USLOVNOY_EKVATORIALNOY_KSS",
										17 => "UGOL_RASSEYANIYA_",
										18 => "TSVETOVAYA_TEMPERATURA_K",
										19 => "KPD_WPE_IZLUCHENIYA_",
										20 => "POTOK_IZLUCHENIYA_VT",
										21 => "FOTOSINTETICHESKAYA_OTDACHA_AKTIVNAYA_MKMOL_DZH",
										22 => "FOTOSINTETICHESKAYA_OTDACHA_MKMOL_DZH",
									),
								);
								foreach ($arResult['DISPLAY_PROPERTIES'] as $property) {
									foreach ($arCardNames as $cardName => $arCardProps) { // ниже повторяются те же наименования. Постараться объединить или перенести в result_modifier.php
										if ( in_array($property['CODE'], $arCardProps) ) {
											$arCardNames['SORT'][$cardName][] = $property;
										}
									}
								}


								$filesInProperties = array(
									"LIGHTING_PARAMS" => "files_kcc",
									"ELECTRICAL_CHARS" => "files_shemi",
									"DIMENSIONS" => "files_chertej",
									"PACKING" => "files_acs_chertej",
								);
								foreach ($actualItem["FILES"] as $file) {
									if ( $cardNameKey = array_search($file["FILE_TYPE"], $filesInProperties)) {
										array_push($arCardNames['SORT'][$cardNameKey], $file); // Добавляем файлы в массив свойств
									};
								}
								?>
								<pre><?// print_r($actualItem["FILES"]); ?></pre>
								<div class="pt-30 pt-lg-50 pdfBreakAfter">
									<div class="card-columns">
										<?
										foreach ($arCardNames['SORT'] as $cardName => $cardProps) {
											?>
											<div class="card border-0 mb-40 mb-xl-80">
												<div>
													<div class="ff-dinpro fz-18 fw-500 border-bottom border-red pb-20 px-30">
														<?=$arCardNamesRus[$cardName]?>
													</div>
													<?php
													foreach ($cardProps as $property)
													{
														if (!isset($property["SRC"])) {
															?>
															<div class="product-feature-param d-flex justify-content-between align-items-center border-bottom">
																<div class="pr-10"><?=$property['NAME']?></div>
																<div class="pl-10"><?=(
																	is_array($property['DISPLAY_VALUE'])
																		? implode(' / ', $property['DISPLAY_VALUE'])
																		: $property['DISPLAY_VALUE']
																	)?>
																</div>
															</div>
															
															<?
														} else {
															?>
															<div class="text-center mt-30">
																<img class="img-fluid lazyload"
																	src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
																	data-src="<?=$property["SRC"]?>" alt="">
															</div>
															<?
														}
													}
													unset($property);
													?>
												</div>
											</div>
											<?
										}
										?>
									</div>
								</div>
								<?php
							}
							?>
						</div>
						<?php
					}
					?>
					<?php
					if ($showDescription)
					{
						?>
						<div 
							class="tab-pane fade"
							id="description"
							role="tabpanel"
							aria-labelledby="description-tab">
							<div class="pt-30 pt-lg-50">
								<?php
								// Стандартные функционал вывода описания
								if (
									$arResult['PREVIEW_TEXT'] != ''
									&& (
										$arParams['DISPLAY_PREVIEW_TEXT_MODE'] === 'S'
										|| ($arParams['DISPLAY_PREVIEW_TEXT_MODE'] === 'E' && $arResult['DETAIL_TEXT'] == '')
									)
								)
								{
									echo $arResult['PREVIEW_TEXT_TYPE'] === 'html' ? $arResult['PREVIEW_TEXT'] : '<p>'.$arResult['PREVIEW_TEXT'].'</p>';
								}
								if ($arResult['DETAIL_TEXT'] != '')
								{
									echo $arResult['DETAIL_TEXT_TYPE'] === 'html' ? $arResult['DETAIL_TEXT'] : '<p>'.$arResult['DETAIL_TEXT'].'</p>';
								}

								/**
								 * Вывод описания из свойства
								 */
								// echo '<p>'.$arResult["PROPERTIES"]['OPISANIE_SEMEYSTVA']["~VALUE"].'</p>';
								?>
							</div>
						</div>
						<?php
					}
					?>

					<div
						class="tab-pane fade"
						id="downloads"
						role="tabpanel"
						aria-labelledby="downloads-tab"
					>
						<div id="jsZip" class="pt-30 pt-lg-50">
							<div class="text-center fz-30 mt-30 mb-30 mb-xl-60">
								Документы для скачивания <strong class="ff-dinpro"><?=$actualItem['NAME']?></strong>
							</div>
							<div class="row mb-30 mb-xl-60">
									<div class="col-lg-4">
										<div class="custom-control custom-checkbox round-checkbox mb-10 mb-lg-40">
											<input type="checkbox" class="custom-control-input" id="generatePDF" data-targetpdf=".product, #calculation.tab-pane.show .printToPDF, #features.tab-pane, #description.tab-pane">
											<label class="custom-control-label" for="generatePDF">Описание</label>
											<a href="javascript:void(0)" class="m-0" onclick="generatePDF('.product, #calculation.tab-pane.show .printToPDF, #features.tab-pane, #description.tab-pane', 1)">
												<span class="icon-download fz-20 lh-1 align-middle ml-5"></span>
											</a>
										</div>
									</div>

									<?
									foreach ( $actualItem['FILES'] as $file ) {
										?>
										<div class="col-lg-4">
											<div class="custom-control custom-checkbox round-checkbox mb-10 mb-lg-40">
												<input type="checkbox" class="custom-control-input" id="download-docs-<?=$file["ID"]?>" value="<?=$file["SRC"]?>">
												<label class="custom-control-label" for="download-docs-<?=$file["ID"]?>"><?=$file['DESCRIPTION']?></label>
												<a href="<?=$file["SRC"]?>" class="m-0" download="">
													<span class="icon-download fz-20 lh-1 align-middle ml-5"></span>
												</a>
											</div>
										</div>
										<?
									}
									?>
							</div>
							<div id="downloadButtons" class="row justify-content-center text-center text-md-left">
								<div class="col-md-6 mb-md-15 text-md-right mb-15 mb-md-0">
									<button type="button" data-target="#jsZip" class="btn btn-mw btn-blue-dark">
										<span class="text-uppercase fz-18">Скачать выбранные</span>
									</button>
								</div>
								<div class="col-md-6">
									<button type="button" data-target="#jsZip" class="btn btn-mw btn-outline-blue-dark">
										<span class="icon-download fz-20 mr-20"></span><span class="text-uppercase fz-18">Скачать все</span>
									</button>
								</div>
							</div>
						</div>
					</div>
					
					<!-- Accessories -->
					<div
						class="tab-pane fade"
						id="accessories"
						role="tabpanel"
						aria-labelledby="accessories-tab"
					>
						<div class="pt-30 pt-lg-50">
							<div class="product-table table-responsive scrollbar mb-35">
								<?
								if ( !empty($arResult['PROPERTIES']['B_ANALOGI']['VALUE']) ) {
									global $accessoriesFilter;
									$arLinkElements = CIBlockElement::GetList(
										array('SORT' => 'ASC'),
										array('XML_ID' => $arResult['PROPERTIES']['B_ANALOGI']['VALUE'])
									);
									while ($linkedElement = $arLinkElements->getNext()) {
										$arrayLinks[] = $linkedElement['ID'];
									}
									$accessoriesFilter = array(
										'=ID' => $arrayLinks
									);
									$APPLICATION->IncludeComponent(
										"bitrix:catalog.section",
										"bootstrap_v4",
										Array(
											"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
											"ADD_PICT_PROP" => "-",
											"ADD_PROPERTIES_TO_BASKET" => "N",
											"ADD_SECTIONS_CHAIN" => "N",
											"ADD_TO_BASKET_ACTION" => "ADD",
											"AJAX_MODE" => "N",
											"AJAX_OPTION_ADDITIONAL" => "",
											"AJAX_OPTION_HISTORY" => "N",
											"AJAX_OPTION_JUMP" => "N",
											"AJAX_OPTION_STYLE" => "Y",
											"BACKGROUND_IMAGE" => (isset($arParams['SECTION_BACKGROUND_IMAGE'])?$arParams['SECTION_BACKGROUND_IMAGE']:''),
											"BASKET_URL" => $arParams["BASKET_URL"],
											"BRAND_PROPERTY" => (isset($arParams['BRAND_PROPERTY'])?$arParams['BRAND_PROPERTY']:''),
											"BROWSER_TITLE" => "-",
											"CACHE_FILTER" => "N",
											"CACHE_GROUPS" => "N",
											"CACHE_TIME" => $arParams["CACHE_TIME"],
											"CACHE_TYPE" => "A",
											"COMPARE_NAME" => $arParams['COMPARE_NAME'],
											"COMPARE_PATH" => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
											"COMPATIBLE_MODE" => "N",
											"CONVERT_CURRENCY" => "N",
											"CURRENCY_ID" => $arParams['CURRENCY_ID'],
											"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
											"DATA_LAYER_NAME" => (isset($arParams['DATA_LAYER_NAME'])?$arParams['DATA_LAYER_NAME']:''),
											"DETAIL_URL" => "",
											"DISABLE_INIT_JS_IN_COMPONENT" => "N",
											"DISCOUNT_PERCENT_POSITION" => $arParams['DISCOUNT_PERCENT_POSITION'],
											"DISPLAY_BOTTOM_PAGER" => "N",
											"DISPLAY_COMPARE" => "N",
											"DISPLAY_TOP_PAGER" => "N",
											"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
											"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
											"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
											"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
											"ENLARGE_PRODUCT" => "STRICT",
											"ENLARGE_PROP" => isset($arParams['LIST_ENLARGE_PROP'])?$arParams['LIST_ENLARGE_PROP']:'',
											"FILE_404" => $arParams["FILE_404"],
											"FILTER_NAME" => "accessoriesFilter",
											"HIDE_NOT_AVAILABLE" => "Y",
											"HIDE_NOT_AVAILABLE_OFFERS" => "Y",
											"IBLOCK_ID" => "11",
											"IBLOCK_TYPE" => "products",
											"INCLUDE_SUBSECTIONS" => "Y",
											"LABEL_PROP" => array(),
											"LABEL_PROP_MOBILE" => array(),
											"LABEL_PROP_POSITION" => $arParams['LABEL_PROP_POSITION'],
											"LAZY_LOAD" => "N",
											"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
											"LOAD_ON_SCROLL" => "N",
											"MESSAGE_404" => $arParams["~MESSAGE_404"],
											"MESS_BTN_ADD_TO_BASKET" => (isset($arParams['~MESS_BTN_ADD_TO_BASKET'])?$arParams['~MESS_BTN_ADD_TO_BASKET']:''),
											"MESS_BTN_BUY" => (isset($arParams['~MESS_BTN_BUY'])?$arParams['~MESS_BTN_BUY']:''),
											"MESS_BTN_COMPARE" => (isset($arParams['~MESS_BTN_COMPARE'])?$arParams['~MESS_BTN_COMPARE']:''),
											"MESS_BTN_DETAIL" => (isset($arParams['~MESS_BTN_DETAIL'])?$arParams['~MESS_BTN_DETAIL']:''),
											"MESS_BTN_LAZY_LOAD" => $arParams["~MESS_BTN_LAZY_LOAD"],
											"MESS_BTN_SUBSCRIBE" => (isset($arParams['~MESS_BTN_SUBSCRIBE'])?$arParams['~MESS_BTN_SUBSCRIBE']:''),
											"MESS_NOT_AVAILABLE" => (isset($arParams['~MESS_NOT_AVAILABLE'])?$arParams['~MESS_NOT_AVAILABLE']:''),
											"MESS_RELATIVE_QUANTITY_FEW" => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW'])?$arParams['~MESS_RELATIVE_QUANTITY_FEW']:''),
											"MESS_RELATIVE_QUANTITY_MANY" => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY'])?$arParams['~MESS_RELATIVE_QUANTITY_MANY']:''),
											"MESS_SHOW_MAX_QUANTITY" => (isset($arParams['~MESS_SHOW_MAX_QUANTITY'])?$arParams['~MESS_SHOW_MAX_QUANTITY']:''),
											"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
											"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
											"OFFERS_CART_PROPERTIES" => (isset($arParams["OFFERS_CART_PROPERTIES"])?$arParams["OFFERS_CART_PROPERTIES"]:[]),
											"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
											"OFFERS_LIMIT" => (isset($arParams["LIST_OFFERS_LIMIT"])?$arParams["LIST_OFFERS_LIMIT"]:0),
											"OFFERS_PROPERTY_CODE" => (isset($arParams["LIST_OFFERS_PROPERTY_CODE"])?$arParams["LIST_OFFERS_PROPERTY_CODE"]:[]),
											"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
											"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
											"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
											"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
											"OFFER_ADD_PICT_PROP" => $arParams['OFFER_ADD_PICT_PROP'],
											"OFFER_TREE_PROPS" => (isset($arParams['OFFER_TREE_PROPS'])?$arParams['OFFER_TREE_PROPS']:[]),
											"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
											"PAGER_BASE_LINK_ENABLE" => "N",
											"PAGER_DESC_NUMBERING" => "N",
											"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
											"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
											"PAGER_SHOW_ALL" => "N",
											"PAGER_SHOW_ALWAYS" => "N",
											"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
											"PAGER_TITLE" => $arParams["PAGER_TITLE"],
											"PAGE_ELEMENT_COUNT" => "115",
											"PARTIAL_PRODUCT_PROPERTIES" => "N",
											"PRICE_CODE" => array(),
											"PRICE_VAT_INCLUDE" => "N",
											"PRODUCT_BLOCKS_ORDER" => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
											"PRODUCT_DISPLAY_MODE" => $arParams['PRODUCT_DISPLAY_MODE'],
											"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
											"PRODUCT_PROPERTIES" => array(),
											"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
											"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
											"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'9','BIG_DATA':false},{'VARIANT':'9','BIG_DATA':false},{'VARIANT':'9','BIG_DATA':false},{'VARIANT':'9','BIG_DATA':false},{'VARIANT':'9','BIG_DATA':false},{'VARIANT':'9','BIG_DATA':false},{'VARIANT':'9','BIG_DATA':false},{'VARIANT':'9','BIG_DATA':false},{'VARIANT':'9','BIG_DATA':false},{'VARIANT':'9','BIG_DATA':false}]",
											"PRODUCT_SUBSCRIPTION" => "N",
											// "PROPERTY_CODE" => (isset($arParams["LIST_PROPERTY_CODE"]) ? $arParams["LIST_PROPERTY_CODE"] : []),
											"PROPERTY_CODE" => array(
												"DLINA_M",
												"SHIRINA_M",
												"VYSOTA_M",
											),
											"PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
											"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
											"RCM_TYPE" => "personal",
											"RELATIVE_QUANTITY_FACTOR" => (isset($arParams['RELATIVE_QUANTITY_FACTOR'])?$arParams['RELATIVE_QUANTITY_FACTOR']:''),
											"SECTION_CODE" => "",
											"SECTION_ID" => "",
											"SECTION_ID_VARIABLE" => "",
											"SECTION_URL" => "",
											"SECTION_USER_FIELDS" => array("",""),
											"SEF_MODE" => "N",
											"SET_BROWSER_TITLE" => "Y",
											"SET_LAST_MODIFIED" => "N",
											"SET_META_DESCRIPTION" => "Y",
											"SET_META_KEYWORDS" => "Y",
											"SET_STATUS_404" => "N",
											"SET_TITLE" => "N",
											"SHOW_404" => "N",
											"SHOW_ALL_WO_SECTION" => "N",
											"SHOW_CLOSE_POPUP" => "N",
											"SHOW_DISCOUNT_PERCENT" => "N",
											"SHOW_FROM_SECTION" => "N",
											"SHOW_MAX_QUANTITY" => "N",
											"SHOW_OLD_PRICE" => "N",
											"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
											"SHOW_SLIDER" => "N",
											"SLIDER_INTERVAL" => isset($arParams['LIST_SLIDER_INTERVAL'])?$arParams['LIST_SLIDER_INTERVAL']:'',
											"SLIDER_PROGRESS" => isset($arParams['LIST_SLIDER_PROGRESS'])?$arParams['LIST_SLIDER_PROGRESS']:'',
											"TEMPLATE_THEME" => (isset($arParams['TEMPLATE_THEME'])?$arParams['TEMPLATE_THEME']:''),
											"USE_COMPARE_LIST" => "Y",
											"USE_ENHANCED_ECOMMERCE" => "N",
											"USE_MAIN_ELEMENT_SECTION" => "N",
											"USE_PRICE_COUNT" => "N",
											"USE_PRODUCT_QUANTITY" => "N"
										),
									$component
									);
								}
								?>
							</div>
						</div>
					</div>

					<div
                    class="tab-pane fade"
                    id="calculation"
                    role="tabpanel"
                    aria-labelledby="calculation-tab"
					>
						<div class="pt-30 pt-lg-50">


							<div class="calculator fz-lg-18">

								<div class="text-lg-center fz-18 fz-xl-20 mb-60 mb-xl-80">
									Онлайн калькулятор позволяет легко рассчитать количество светильников или уровень
									освещенности. <br>
									Результаты программы расчета могут отличаться от результатов профессиональной программы.
								</div>

								<div class="row">
									<div class="col-xl-8 offset-xl-2 printToPDF">
										<div class="row mb-30 mb-xl-50 pdfBreakAfter">
											<div class="col-md-6">

												<div class="d-none">
													<a href="javascript:void(0)" id="switch-3" class="">Рабочая поверхность</a>
													<!-- Установите класс "checked", для того чтобы переключить калькулятор в режим расчета "Рабочая поверхность" -->
													<a href="javascript:void(0)" id="switch-4" class="checked">Пол</a>
													<!-- Установите класс "checked", для того чтобы переключить калькулятор в режим расчета "Пол" -->
												</div>

												<div class="filter mb-10 mb-xl-20">
													<div class="custom-control custom-radio mb-15">
														<input checked="" type="radio" id="switch-1" name="calc-type"
															class="custom-control-input"/>
														<label class="custom-control-label mb-0" for="switch-1">Расчет
															освещенности</label>
													</div>
													<div class="custom-control custom-radio mb-15">
														<input type="radio" id="switch-2" name="calc-type"
															class="custom-control-input"/>
														<label class="custom-control-label mb-0" for="switch-2">Расчет
															количества светильников</label>
													</div>
												</div>

												<div class="row align-items-center mb-10">
													<div class="col-4 col-lg-3">
														<input id="a1" value="12" class="form-control form-control-sm"
															type="text">
													</div>
													<div class="col-7 col-lg-9">
														<label for="a1" class="mb-0">
															Длина, м
														</label>
													</div>
												</div>
												<div class="row align-items-center mb-10">
													<div class="col-4 col-lg-3">
														<input id="b1" value="8" class="form-control form-control-sm"
															type="text">
													</div>
													<div class="col-7 col-lg-9">
														<label for="b1" class="mb-0">
															Ширина, м
														</label>
													</div>
												</div>
												<div class="row align-items-center mb-10">
													<div class="col-4 col-lg-3">
														<input id="h1" value="3.3" class="form-control form-control-sm"
															type="text">
													</div>
													<div class="col-7 col-lg-9">
														<label for="h1" class="mb-0">
															Высота, м
														</label>
													</div>
												</div>


												<div class="row align-items-center mb-10">
													<div class="col-4 col-lg-3">
														<input id="h11" value="0.5" class="form-control form-control-sm"
															type="text">
													</div>
													<div class="col-7 col-lg-9">
														<label for="h11" class="mb-0">
															Длина подвеса светильника, м
														</label>
													</div>
												</div>
												<div class="row align-items-center mb-10">
													<div class="col-4 col-lg-3">
														<input id="z1" value="1.5" min="1.1" max="2" step="0.1"
															class="form-control form-control-sm" type="number">
													</div>
													<div class="col-7 col-lg-9">
														<label for="z1" class="mb-0">
															Коэффициент запаса
														</label>
													</div>
												</div>
												<div class="row align-items-center mb-10">
													<div class="col-4 col-lg-3">
														<input id="k1" value="1.1" min="1" max="1.5" step="0.1"
															class="form-control form-control-sm" type="number">
													</div>
													<div class="col-7 col-lg-9">
														<label for="k1" class="mb-0">
															Коэффициент неравномерности освещения
														</label>
													</div>
												</div>


												<div id="switch-2-input" class="row align-items-center mb-10">
													<div class="col-4 col-lg-3">
														<input id="e1" value="400" class="form-control form-control-sm"
															type="text">
													</div>
													<div class="col-7 col-lg-9">
														<label for="e1" class="mb-0">
															Требуемая освещенность
														</label>
													</div>
												</div>
												<div id="switch-1-input" class="row align-items-center mb-10">
													<div class="col-4 col-lg-3">
														<input id="count1" value="10" class="form-control form-control-sm"
															type="text">
													</div>
													<div class="col-7 col-lg-9">
														<label for="count1" class="mb-0">
															Количество светильников
														</label>
													</div>
												</div>

												<div>
													Коэффициент отражения (потолок/стены/пол): <span class="text-nowrap">70 / 50 / 20</span>
												</div>


												<input type="hidden" id="original_lamp_count" value="4"/>
												<input type="hidden" id="f1" value="1250"/>
												<input type="hidden" id="h21" value="0"/>

												<input type="hidden" id="origin_lamp_count" value="4"/>
												<input type="hidden" id="id1" value="90928"/>

												<input type="hidden" id="ki0061" value="33"/>
												<input type="hidden" id="ki0081" value="39"/>
												<input type="hidden" id="ki0101" value="44"/>
												<input type="hidden" id="ki1251" value="49"/>
												<input type="hidden" id="ki1501" value="52"/>
												<input type="hidden" id="ki2001" value="57"/>
												<input type="hidden" id="ki2501" value="60"/>
												<input type="hidden" id="ki3001" value="62"/>
												<input type="hidden" id="ki4001" value="65"/>
												<input type="hidden" id="ki5001" value="67"/>


											</div>
											<div class="col-md-6">
												<div class="h-100 d-flex flex-column justify-content-center">
													<div class="calc-room-container text-center mt-auto mb-auto py-15">
														<img class="img-fluid" src="/img/calculator/table.jpg"
															alt="Схема помещения"/>
													</div>
													<div class="calculator__result d-flex align-items-end justify-content-center text-red">
														<div class="result-1"></div>
													</div>
												</div>
											</div>
										</div>


										<div class="row justify-content-center text-center text-md-left removePDF">
											<div class="col-md-6 mb-md-15 text-md-right mb-15 mb-md-0">
												<button class="calc-button calculate btn btn-sm btn-mw btn-blue-dark fz-18"
														onclick="calc10()">
													Рассчитать
												</button>
											</div>
											<div class="col-md-6">
												<button class="calc-button download btn btn-sm btn-mw btn-outline-blue-dark fz-18"
														id="pdf-check" onclick="generatePDF('.product, #calculation.tab-pane.show .printToPDF, #features.tab-pane', 1)" data-mod="90928"> <!-- для html2pdf onclick="generatePDF('.product, #calculation.tab-pane .printToPDF')"-->
													<span class="icon-download mr-10"></span> Скачать (Pdf)
												</button>
											</div>
										</div>


									</div>
								</div>


							</div>

						</div>
					</div>

					<?
					if ($arResult['SHOW_OFFERS_PROPS'])
					{
						?>
						<ul class="product-item-detail-properties" id="<?=$itemIds['DISPLAY_PROP_DIV']?>"></ul>
						<?php
					}

					if ($arParams['USE_COMMENTS'] === 'Y')
					{
						?>
						<div class="product-item-detail-tab-content" data-entity="tab-container" data-value="comments" style="display: none;">
							<?php
							$componentCommentsParams = array(
								'ELEMENT_ID' => $arResult['ID'],
								'ELEMENT_CODE' => '',
								'IBLOCK_ID' => $arParams['IBLOCK_ID'],
								'SHOW_DEACTIVATED' => $arParams['SHOW_DEACTIVATED'],
								'URL_TO_COMMENT' => '',
								'WIDTH' => '',
								'COMMENTS_COUNT' => '5',
								'BLOG_USE' => $arParams['BLOG_USE'],
								'FB_USE' => $arParams['FB_USE'],
								'FB_APP_ID' => $arParams['FB_APP_ID'],
								'VK_USE' => $arParams['VK_USE'],
								'VK_API_ID' => $arParams['VK_API_ID'],
								'CACHE_TYPE' => $arParams['CACHE_TYPE'],
								'CACHE_TIME' => $arParams['CACHE_TIME'],
								'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
								'BLOG_TITLE' => '',
								'BLOG_URL' => $arParams['BLOG_URL'],
								'PATH_TO_SMILE' => '',
								'EMAIL_NOTIFY' => $arParams['BLOG_EMAIL_NOTIFY'],
								'AJAX_POST' => 'Y',
								'SHOW_SPAM' => 'Y',
								'SHOW_RATING' => 'N',
								'FB_TITLE' => '',
								'FB_USER_ADMIN_ID' => '',
								'FB_COLORSCHEME' => 'light',
								'FB_ORDER_BY' => 'reverse_time',
								'VK_TITLE' => '',
								'TEMPLATE_THEME' => $arParams['~TEMPLATE_THEME']
							);
							if(isset($arParams["USER_CONSENT"]))
								$componentCommentsParams["USER_CONSENT"] = $arParams["USER_CONSENT"];
							if(isset($arParams["USER_CONSENT_ID"]))
								$componentCommentsParams["USER_CONSENT_ID"] = $arParams["USER_CONSENT_ID"];
							if(isset($arParams["USER_CONSENT_IS_CHECKED"]))
								$componentCommentsParams["USER_CONSENT_IS_CHECKED"] = $arParams["USER_CONSENT_IS_CHECKED"];
							if(isset($arParams["USER_CONSENT_IS_LOADED"]))
								$componentCommentsParams["USER_CONSENT_IS_LOADED"] = $arParams["USER_CONSENT_IS_LOADED"];
							$APPLICATION->IncludeComponent(
								'bitrix:catalog.comments',
								'',
								$componentCommentsParams,
								$component,
								array('HIDE_ICONS' => 'Y')
							);
							?>
						</div>
						<?php
					}
					?>
		</div>
	</div>
	
	<?php
	if ($arParams['BRAND_USE'] === 'Y')
	{
		?>
		<div class="col-sm-4 col-md-3">
			<?php $APPLICATION->IncludeComponent(
				'bitrix:catalog.brandblock',
				'bootstrap_v4',
				array(
					'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
					'IBLOCK_ID' => $arParams['IBLOCK_ID'],
					'ELEMENT_ID' => $arResult['ID'],
					'ELEMENT_CODE' => '',
					'PROP_CODE' => $arParams['BRAND_PROP_CODE'],
					'CACHE_TYPE' => $arParams['CACHE_TYPE'],
					'CACHE_TIME' => $arParams['CACHE_TIME'],
					'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
					'WIDTH' => '',
					'HEIGHT' => ''
				),
				$component,
				array('HIDE_ICONS' => 'Y')
			);
			?>
		</div>
		<?php
	}
	?>
</div>
<div class="py-25 py-lg-60"></div>

<? // Simillar region ?>
<?
$arParentSection = CIBlockSection::GetList(
	array("SORT" => "ASC"),
	array(
		"ID" => $arResult['IBLOCK_SECTION_ID'],
		"IBLOCK_ID" => $arResult["IBLOCK_ID"],
		"UF_SHOW_SIMILAR" => true
	),
	false,
	array(
		"UF_SHOW_SIMILAR"
	)
);
if ($section = $arParentSection->Fetch()) {
	if ($section["UF_SHOW_SIMILAR"]) {
		?>
		<div class="container">
			<div class="text-center mb-30 mb-lg-60">
				<h2 class="ff-dinpro fz-20 fz-lg-25 fw-700 text-uppercase mb-10">
					Подобная продукция
				</h2>
			</div>
			<? $APPLICATION->IncludeComponent(
				"bitrix:catalog.section.list",
				"new_series",
				array(
					"ADD_SECTIONS_CHAIN" => "N",
					"CACHE_FILTER" => "N",
					"CACHE_GROUPS" => "Y",
					"CACHE_TIME" => "36000000",
					"CACHE_TYPE" => "A",
					"COMPONENT_TEMPLATE" => "new_series",
					"COUNT_ELEMENTS" => "Y",
					"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
					"FILTER_NAME" => "",
					"FIND_BY_UF_NAME" => "Y",
					"HIDE_SECTION_NAME" => "N",
					"IBLOCK_ID" => "2",
					"IBLOCK_TYPE" => "products",
					"SECTION_CODE" => "",
					"SECTION_FIELDS" => array(0 => "", 1 => "",),
					"SECTION_ID" => $arResult['IBLOCK_SECTION_ID'],
					"SECTION_URL" => "",
					"SECTION_USER_FIELDS" => array(0 => "", 1 => "",),
					"SHOW_PARENT_NAME" => "N",
					"SHOW_UF_SECTION_DESCR" => "Y",
					"TOP_DEPTH" => "1",
					"UF_NAME" => "UF_SIMILAR",
					"VIEW_MODE" => "TILE"
				)
			); ?>
		</div>
		<div class="py-25 py-lg-60"></div>
		<?
	}
}
?>
<? // endregion?>

			</div>
		</div>
	</div>
	<?php
	if ($haveOffers)
	{
		if ($arResult['OFFER_GROUP'])
		{
			?>
			<div class="row">
				<div class="col">
					<?php
					foreach ($arResult['OFFER_GROUP_VALUES'] as $offerId)
					{
						?>
						<span id="<?=$itemIds['OFFER_GROUP'].$offerId?>" style="display: none;">
							<?php
							$APPLICATION->IncludeComponent(
								'bitrix:catalog.set.constructor',
								'bootstrap_v4',
								array(
									'CUSTOM_SITE_ID' => $arParams['CUSTOM_SITE_ID'] ?? null,
									'IBLOCK_ID' => $arResult['OFFERS_IBLOCK'],
									'ELEMENT_ID' => $offerId,
									'PRICE_CODE' => $arParams['PRICE_CODE'],
									'BASKET_URL' => $arParams['BASKET_URL'],
									'OFFERS_CART_PROPERTIES' => $arParams['OFFERS_CART_PROPERTIES'],
									'CACHE_TYPE' => $arParams['CACHE_TYPE'],
									'CACHE_TIME' => $arParams['CACHE_TIME'],
									'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
									'TEMPLATE_THEME' => $arParams['~TEMPLATE_THEME'],
									'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
									'CURRENCY_ID' => $arParams['CURRENCY_ID'],
									'DETAIL_URL' => $arParams['~DETAIL_URL']
								),
								$component,
								array('HIDE_ICONS' => 'Y')
							);
							?>
						</span>
						<?php
					}
					?>
				</div>
			</div>
			<?php
		}
	}
	else
	{
		if ($arResult['MODULES']['catalog'] && $arResult['OFFER_GROUP'])
		{
			?>
			<div class="row">
				<div class="col">
					<?php $APPLICATION->IncludeComponent(
						'bitrix:catalog.set.constructor',
						'bootstrap_v4',
						array(
							'CUSTOM_SITE_ID' => $arParams['CUSTOM_SITE_ID'] ?? null,
							'IBLOCK_ID' => $arParams['IBLOCK_ID'],
							'ELEMENT_ID' => $arResult['ID'],
							'PRICE_CODE' => $arParams['PRICE_CODE'],
							'BASKET_URL' => $arParams['BASKET_URL'],
							'CACHE_TYPE' => $arParams['CACHE_TYPE'],
							'CACHE_TIME' => $arParams['CACHE_TIME'],
							'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
							'TEMPLATE_THEME' => $arParams['~TEMPLATE_THEME'],
							'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
							'CURRENCY_ID' => $arParams['CURRENCY_ID']
						),
						$component,
						array('HIDE_ICONS' => 'Y')
					);
					?>
				</div>
			</div>
			<?php
		}
	}
	?>

	<?/*?><div class="row">
		<div class="col">
			<div class="row" id="<?=$itemIds['TABS_ID']?>">
				<div class="col">
					<div class="product-item-detail-tabs-container">
						<ul class="product-item-detail-tabs-list">
							<?php
							if ($showDescription)
							{
								?>
								<li class="product-item-detail-tab active" data-entity="tab" data-value="description">
									<a href="javascript:void(0);" class="product-item-detail-tab-link">
										<span><?=$arParams['MESS_DESCRIPTION_TAB']?></span>
									</a>
								</li>
								<?php
							}

							if (!empty($arResult['DISPLAY_PROPERTIES']) || $arResult['SHOW_OFFERS_PROPS'])
							{
								?>
								<li class="product-item-detail-tab" data-entity="tab" data-value="properties">
									<a href="javascript:void(0);" class="product-item-detail-tab-link">
										<span><?=$arParams['MESS_PROPERTIES_TAB']?></span>
									</a>
								</li>
								<?php
							}

							if ($arParams['USE_COMMENTS'] === 'Y')
							{
								?>
								<li class="product-item-detail-tab" data-entity="tab" data-value="comments">
									<a href="javascript:void(0);" class="product-item-detail-tab-link">
										<span><?=$arParams['MESS_COMMENTS_TAB']?></span>
									</a>
								</li>
								<?php
							}
							?>
						</ul>
					</div>
				</div>
			</div>
			<div class="row" id="<?=$itemIds['TAB_CONTAINERS_ID']?>">
				<div class="col">
					<?php
					if ($showDescription)
					{
						?>
						<div class="product-item-detail-tab-content active"
							data-entity="tab-container"
							data-value="description"
							itemprop="description" id="<?=$itemIds['DESCRIPTION_ID']?>">
							<?php
							if (
								$arResult['PREVIEW_TEXT'] != ''
								&& (
									$arParams['DISPLAY_PREVIEW_TEXT_MODE'] === 'S'
									|| ($arParams['DISPLAY_PREVIEW_TEXT_MODE'] === 'E' && $arResult['DETAIL_TEXT'] == '')
								)
							)
							{
								echo $arResult['PREVIEW_TEXT_TYPE'] === 'html' ? $arResult['PREVIEW_TEXT'] : '<p>'.$arResult['PREVIEW_TEXT'].'</p>';
							}

							if ($arResult['DETAIL_TEXT'] != '')
							{
								echo $arResult['DETAIL_TEXT_TYPE'] === 'html' ? $arResult['DETAIL_TEXT'] : '<p>'.$arResult['DETAIL_TEXT'].'</p>';
							}
							?>
						</div>
						<?php
					}

					if (!empty($arResult['DISPLAY_PROPERTIES']) || $arResult['SHOW_OFFERS_PROPS'])
					{
						?>
						<div class="product-item-detail-tab-content" data-entity="tab-container" data-value="properties">
							<?php
							if (!empty($arResult['DISPLAY_PROPERTIES']))
							{
								?>
								<ul class="product-item-detail-properties">
									<?php
									foreach ($arResult['DISPLAY_PROPERTIES'] as $property)
									{
										?>
										<li class="product-item-detail-properties-item">
											<span class="product-item-detail-properties-name"><?=$property['NAME']?></span>
											<span class="product-item-detail-properties-dots"></span>
											<span class="product-item-detail-properties-value"><?=(
												is_array($property['DISPLAY_VALUE'])
													? implode(' / ', $property['DISPLAY_VALUE'])
													: $property['DISPLAY_VALUE']
												)?>
										</span>
										</li>
										<?php
									}
									unset($property);
									?>
								</ul>
								<?php
							}

							if ($arResult['SHOW_OFFERS_PROPS'])
							{
								?>
								<ul class="product-item-detail-properties" id="<?=$itemIds['DISPLAY_PROP_DIV']?>"></ul>
								<?php
							}
							?>
						</div>
						<?php
					}

					if ($arParams['USE_COMMENTS'] === 'Y')
					{
						?>
						<div class="product-item-detail-tab-content" data-entity="tab-container" data-value="comments" style="display: none;">
							<?php
							$componentCommentsParams = array(
								'ELEMENT_ID' => $arResult['ID'],
								'ELEMENT_CODE' => '',
								'IBLOCK_ID' => $arParams['IBLOCK_ID'],
								'SHOW_DEACTIVATED' => $arParams['SHOW_DEACTIVATED'],
								'URL_TO_COMMENT' => '',
								'WIDTH' => '',
								'COMMENTS_COUNT' => '5',
								'BLOG_USE' => $arParams['BLOG_USE'],
								'FB_USE' => $arParams['FB_USE'],
								'FB_APP_ID' => $arParams['FB_APP_ID'],
								'VK_USE' => $arParams['VK_USE'],
								'VK_API_ID' => $arParams['VK_API_ID'],
								'CACHE_TYPE' => $arParams['CACHE_TYPE'],
								'CACHE_TIME' => $arParams['CACHE_TIME'],
								'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
								'BLOG_TITLE' => '',
								'BLOG_URL' => $arParams['BLOG_URL'],
								'PATH_TO_SMILE' => '',
								'EMAIL_NOTIFY' => $arParams['BLOG_EMAIL_NOTIFY'],
								'AJAX_POST' => 'Y',
								'SHOW_SPAM' => 'Y',
								'SHOW_RATING' => 'N',
								'FB_TITLE' => '',
								'FB_USER_ADMIN_ID' => '',
								'FB_COLORSCHEME' => 'light',
								'FB_ORDER_BY' => 'reverse_time',
								'VK_TITLE' => '',
								'TEMPLATE_THEME' => $arParams['~TEMPLATE_THEME']
							);
							if(isset($arParams["USER_CONSENT"]))
								$componentCommentsParams["USER_CONSENT"] = $arParams["USER_CONSENT"];
							if(isset($arParams["USER_CONSENT_ID"]))
								$componentCommentsParams["USER_CONSENT_ID"] = $arParams["USER_CONSENT_ID"];
							if(isset($arParams["USER_CONSENT_IS_CHECKED"]))
								$componentCommentsParams["USER_CONSENT_IS_CHECKED"] = $arParams["USER_CONSENT_IS_CHECKED"];
							if(isset($arParams["USER_CONSENT_IS_LOADED"]))
								$componentCommentsParams["USER_CONSENT_IS_LOADED"] = $arParams["USER_CONSENT_IS_LOADED"];
							$APPLICATION->IncludeComponent(
								'bitrix:catalog.comments',
								'',
								$componentCommentsParams,
								$component,
								array('HIDE_ICONS' => 'Y')
							);
							?>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>
		<?php
		if ($arParams['BRAND_USE'] === 'Y')
		{
			?>
			<div class="col-sm-4 col-md-3">
				<?php $APPLICATION->IncludeComponent(
					'bitrix:catalog.brandblock',
					'bootstrap_v4',
					array(
						'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
						'IBLOCK_ID' => $arParams['IBLOCK_ID'],
						'ELEMENT_ID' => $arResult['ID'],
						'ELEMENT_CODE' => '',
						'PROP_CODE' => $arParams['BRAND_PROP_CODE'],
						'CACHE_TYPE' => $arParams['CACHE_TYPE'],
						'CACHE_TIME' => $arParams['CACHE_TIME'],
						'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
						'WIDTH' => '',
						'HEIGHT' => ''
					),
					$component,
					array('HIDE_ICONS' => 'Y')
				);
				?>
			</div>
			<?php
		}
		?>
	</div><?*/?>

	<div class="row">
		<div class="col">
			<?php
			if ($arResult['CATALOG'] && $actualItem['CAN_BUY'] && \Bitrix\Main\ModuleManager::isModuleInstalled('sale'))
			{
				$APPLICATION->IncludeComponent(
					'bitrix:sale.prediction.product.detail',
					'',
					array(
						'CUSTOM_SITE_ID' => $arParams['CUSTOM_SITE_ID'] ?? null,
						'BUTTON_ID' => $showBuyBtn ? $itemIds['BUY_LINK'] : $itemIds['ADD_BASKET_LINK'],
						'POTENTIAL_PRODUCT_TO_BUY' => array(
							'ID' => $arResult['ID'] ?? null,
							'MODULE' => $arResult['MODULE'] ?? 'catalog',
							'PRODUCT_PROVIDER_CLASS' => $arResult['~PRODUCT_PROVIDER_CLASS'] ?? \Bitrix\Catalog\Product\Basket::getDefaultProviderName(),
							'QUANTITY' => $arResult['QUANTITY'] ?? null,
							'IBLOCK_ID' => $arResult['IBLOCK_ID'] ?? null,

							'PRIMARY_OFFER_ID' => $arResult['OFFERS'][0]['ID'] ?? null,
							'SECTION' => array(
								'ID' => $arResult['SECTION']['ID'] ?? null,
								'IBLOCK_ID' => $arResult['SECTION']['IBLOCK_ID'] ?? null,
								'LEFT_MARGIN' => $arResult['SECTION']['LEFT_MARGIN'] ?? null,
								'RIGHT_MARGIN' => $arResult['SECTION']['RIGHT_MARGIN'] ?? null,
							),
						)
					),
					$component,
					array('HIDE_ICONS' => 'Y')
				);
			}

			if ($arResult['CATALOG'] && $arParams['USE_GIFTS_DETAIL'] == 'Y' && \Bitrix\Main\ModuleManager::isModuleInstalled('sale'))
			{
				?>
				<div data-entity="parent-container">
					<?php
					if (!isset($arParams['GIFTS_DETAIL_HIDE_BLOCK_TITLE']) || $arParams['GIFTS_DETAIL_HIDE_BLOCK_TITLE'] !== 'Y')
					{
						?>
						<div class="catalog-block-header" data-entity="header" data-showed="false" style="display: none; opacity: 0;">
							<?=($arParams['GIFTS_DETAIL_BLOCK_TITLE'] ?: Loc::getMessage('CT_BCE_CATALOG_GIFT_BLOCK_TITLE_DEFAULT'))?>
						</div>
						<?php
					}

					CBitrixComponent::includeComponentClass('bitrix:sale.products.gift');
					$APPLICATION->IncludeComponent('bitrix:sale.products.gift', 'bootstrap_v4', array(
						'CUSTOM_SITE_ID' => $arParams['CUSTOM_SITE_ID'] ?? null,
						'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
						'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],

						'PRODUCT_ROW_VARIANTS' => "",
						'PAGE_ELEMENT_COUNT' => 0,
						'DEFERRED_PRODUCT_ROW_VARIANTS' => \Bitrix\Main\Web\Json::encode(
							SaleProductsGiftComponent::predictRowVariants(
								$arParams['GIFTS_DETAIL_PAGE_ELEMENT_COUNT'],
								$arParams['GIFTS_DETAIL_PAGE_ELEMENT_COUNT']
							)
						),
						'DEFERRED_PAGE_ELEMENT_COUNT' => $arParams['GIFTS_DETAIL_PAGE_ELEMENT_COUNT'],

						'SHOW_DISCOUNT_PERCENT' => $arParams['GIFTS_SHOW_DISCOUNT_PERCENT'],
						'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
						'SHOW_OLD_PRICE' => $arParams['GIFTS_SHOW_OLD_PRICE'],
						'PRODUCT_DISPLAY_MODE' => 'Y',
						'PRODUCT_BLOCKS_ORDER' => $arParams['GIFTS_PRODUCT_BLOCKS_ORDER'],
						'SHOW_SLIDER' => $arParams['GIFTS_SHOW_SLIDER'],
						'SLIDER_INTERVAL' => $arParams['GIFTS_SLIDER_INTERVAL'] ?? '',
						'SLIDER_PROGRESS' => $arParams['GIFTS_SLIDER_PROGRESS'] ?? '',

						'TEXT_LABEL_GIFT' => $arParams['GIFTS_DETAIL_TEXT_LABEL_GIFT'],

						'LABEL_PROP_'.$arParams['IBLOCK_ID'] => array(),
						'LABEL_PROP_MOBILE_'.$arParams['IBLOCK_ID'] => array(),
						'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],

						'ADD_TO_BASKET_ACTION' => ($arParams['ADD_TO_BASKET_ACTION'] ?? ''),
						'MESS_BTN_BUY' => $arParams['~GIFTS_MESS_BTN_BUY'],
						'MESS_BTN_ADD_TO_BASKET' => $arParams['~GIFTS_MESS_BTN_BUY'],
						'MESS_BTN_DETAIL' => $arParams['~MESS_BTN_DETAIL'],
						'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],

						'SHOW_PRODUCTS_'.$arParams['IBLOCK_ID'] => 'Y',
						'PROPERTY_CODE_'.$arParams['IBLOCK_ID'] => $arParams['LIST_PROPERTY_CODE'],
						'PROPERTY_CODE_MOBILE'.$arParams['IBLOCK_ID'] => $arParams['LIST_PROPERTY_CODE_MOBILE'],
						'PROPERTY_CODE_'.$arResult['OFFERS_IBLOCK'] => $arParams['OFFER_TREE_PROPS'],
						'OFFER_TREE_PROPS_'.$arResult['OFFERS_IBLOCK'] => $arParams['OFFER_TREE_PROPS'],
						'CART_PROPERTIES_'.$arResult['OFFERS_IBLOCK'] => $arParams['OFFERS_CART_PROPERTIES'],
						'ADDITIONAL_PICT_PROP_'.$arParams['IBLOCK_ID'] => ($arParams['ADD_PICT_PROP'] ?? ''),
						'ADDITIONAL_PICT_PROP_'.$arResult['OFFERS_IBLOCK'] => ($arParams['OFFER_ADD_PICT_PROP'] ?? ''),

						'HIDE_NOT_AVAILABLE' => 'Y',
						'HIDE_NOT_AVAILABLE_OFFERS' => 'Y',
						'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
						'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
						'PRICE_CODE' => $arParams['PRICE_CODE'],
						'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],
						'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
						'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
						'BASKET_URL' => $arParams['BASKET_URL'],
						'ADD_PROPERTIES_TO_BASKET' => $arParams['ADD_PROPERTIES_TO_BASKET'],
						'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
						'PARTIAL_PRODUCT_PROPERTIES' => $arParams['PARTIAL_PRODUCT_PROPERTIES'],
						'USE_PRODUCT_QUANTITY' => 'N',
						'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
						'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
						'POTENTIAL_PRODUCT_TO_BUY' => array(
							'ID' => $arResult['ID'] ?? null,
							'MODULE' => $arResult['MODULE'] ?? 'catalog',
							'PRODUCT_PROVIDER_CLASS' => $arResult['~PRODUCT_PROVIDER_CLASS'] ?? \Bitrix\Catalog\Product\Basket::getDefaultProviderName(),
							'QUANTITY' => $arResult['QUANTITY'] ?? null,
							'IBLOCK_ID' => $arResult['IBLOCK_ID'] ?? null,

							'PRIMARY_OFFER_ID' => $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]['ID'] ?? null,
							'SECTION' => array(
								'ID' => $arResult['SECTION']['ID'] ?? null,
								'IBLOCK_ID' => $arResult['SECTION']['IBLOCK_ID'] ?? null,
								'LEFT_MARGIN' => $arResult['SECTION']['LEFT_MARGIN'] ?? null,
								'RIGHT_MARGIN' => $arResult['SECTION']['RIGHT_MARGIN'] ?? null,
							),
						),

						'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
						'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
						'BRAND_PROPERTY' => $arParams['BRAND_PROPERTY']
					),
						$component,
						array('HIDE_ICONS' => 'Y')
					);
					?>
				</div>
				<?php
			}

			if ($arResult['CATALOG'] && $arParams['USE_GIFTS_MAIN_PR_SECTION_LIST'] == 'Y' && \Bitrix\Main\ModuleManager::isModuleInstalled('sale'))
			{
				?>
				<div data-entity="parent-container">
					<?php
					if (!isset($arParams['GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE']) || $arParams['GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE'] !== 'Y')
					{
						?>
						<div class="catalog-block-header" data-entity="header" data-showed="false" style="display: none; opacity: 0;">
							<?=($arParams['GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE'] ?: Loc::getMessage('CT_BCE_CATALOG_GIFTS_MAIN_BLOCK_TITLE_DEFAULT'))?>
						</div>
						<?php
					}

					$APPLICATION->IncludeComponent('bitrix:sale.gift.main.products', 'bootstrap_v4',
						array(
							'CUSTOM_SITE_ID' => $arParams['CUSTOM_SITE_ID'] ?? null,
							'PAGE_ELEMENT_COUNT' => $arParams['GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT'],
							'LINE_ELEMENT_COUNT' => $arParams['GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT'],
							'HIDE_BLOCK_TITLE' => 'Y',
							'BLOCK_TITLE' => $arParams['GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE'],

							'OFFERS_FIELD_CODE' => $arParams['OFFERS_FIELD_CODE'],
							'OFFERS_PROPERTY_CODE' => $arParams['OFFERS_PROPERTY_CODE'],

							'AJAX_MODE' => $arParams['AJAX_MODE'],
							'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
							'IBLOCK_ID' => $arParams['IBLOCK_ID'],

							'ELEMENT_SORT_FIELD' => 'ID',
							'ELEMENT_SORT_ORDER' => 'DESC',
							'FILTER_NAME' => 'searchFilter',
							'SECTION_URL' => $arParams['SECTION_URL'],
							'DETAIL_URL' => $arParams['DETAIL_URL'],
							'BASKET_URL' => $arParams['BASKET_URL'],
							'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
							'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
							'SECTION_ID_VARIABLE' => $arParams['SECTION_ID_VARIABLE'],

							'CACHE_TYPE' => $arParams['CACHE_TYPE'],
							'CACHE_TIME' => $arParams['CACHE_TIME'],

							'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
							'SET_TITLE' => $arParams['SET_TITLE'],
							'PROPERTY_CODE' => $arParams['PROPERTY_CODE'],
							'PRICE_CODE' => $arParams['PRICE_CODE'],
							'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
							'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],

							'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
							'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
							'CURRENCY_ID' => $arParams['CURRENCY_ID'],
							'HIDE_NOT_AVAILABLE' => 'Y',
							'HIDE_NOT_AVAILABLE_OFFERS' => 'Y',
							'TEMPLATE_THEME' => ($arParams['TEMPLATE_THEME'] ?? ''),
							'PRODUCT_BLOCKS_ORDER' => $arParams['GIFTS_PRODUCT_BLOCKS_ORDER'],

							'SHOW_SLIDER' => $arParams['GIFTS_SHOW_SLIDER'],
							'SLIDER_INTERVAL' => $arParams['GIFTS_SLIDER_INTERVAL'] ?? '',
							'SLIDER_PROGRESS' => $arParams['GIFTS_SLIDER_PROGRESS'] ?? '',

							'ADD_PICT_PROP' => ($arParams['ADD_PICT_PROP'] ?? ''),
							'LABEL_PROP' => ($arParams['LABEL_PROP'] ?? ''),
							'LABEL_PROP_MOBILE' => ($arParams['LABEL_PROP_MOBILE'] ?? ''),
							'LABEL_PROP_POSITION' => ($arParams['LABEL_PROP_POSITION'] ?? ''),
							'OFFER_ADD_PICT_PROP' => ($arParams['OFFER_ADD_PICT_PROP'] ?? ''),
							'OFFER_TREE_PROPS' => ($arParams['OFFER_TREE_PROPS'] ?? ''),
							'SHOW_DISCOUNT_PERCENT' => ($arParams['SHOW_DISCOUNT_PERCENT'] ?? ''),
							'DISCOUNT_PERCENT_POSITION' => ($arParams['DISCOUNT_PERCENT_POSITION'] ?? ''),
							'SHOW_OLD_PRICE' => ($arParams['SHOW_OLD_PRICE'] ?? ''),
							'MESS_BTN_BUY' => ($arParams['~MESS_BTN_BUY'] ?? ''),
							'MESS_BTN_ADD_TO_BASKET' => ($arParams['~MESS_BTN_ADD_TO_BASKET'] ?? ''),
							'MESS_BTN_DETAIL' => ($arParams['~MESS_BTN_DETAIL'] ?? ''),
							'MESS_NOT_AVAILABLE' => ($arParams['~MESS_NOT_AVAILABLE'] ?? ''),
							'ADD_TO_BASKET_ACTION' => ($arParams['ADD_TO_BASKET_ACTION'] ?? ''),
							'SHOW_CLOSE_POPUP' => ($arParams['SHOW_CLOSE_POPUP'] ?? ''),
							'DISPLAY_COMPARE' => ($arParams['DISPLAY_COMPARE'] ?? ''),
							'COMPARE_PATH' => ($arParams['COMPARE_PATH'] ?? ''),
						)
						+ array(
							'OFFER_ID' => empty($arResult['OFFERS'][$arResult['OFFERS_SELECTED']]['ID'])
								? $arResult['ID']
								: $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]['ID'],
							'SECTION_ID' => $arResult['SECTION']['ID'],
							'ELEMENT_ID' => $arResult['ID'],

							'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
							'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
							'BRAND_PROPERTY' => $arParams['BRAND_PROPERTY']
						),
						$component,
						array('HIDE_ICONS' => 'Y')
					);
					?>
				</div>
				<?php
			}
			?>
		</div>
	</div>

	<!--Small Card-->
	<?/*?><div class="p-2 product-item-detail-short-card-fixed d-none d-md-block" id="<?=$itemIds['SMALL_CARD_PANEL_ID']?>">
		<div class="product-item-detail-short-card-content-container">
			<div class="product-item-detail-short-card-image">
				<img src="" style="height: 65px;" data-entity="panel-picture">
			</div>
			<div class="product-item-detail-short-title-container" data-entity="panel-title">
				<div class="product-item-detail-short-title-text"><?=$name?></div>
				<?php
				if ($haveOffers)
				{
					?>
					<div>
						<div class="product-item-selected-scu-container" data-entity="panel-sku-container">
							<?php
							$i = 0;

							foreach ($arResult['SKU_PROPS'] as $skuProperty)
							{
								if (!isset($arResult['OFFERS_PROP'][$skuProperty['CODE']]))
								{
									continue;
								}

								$propertyId = $skuProperty['ID'];

								foreach ($skuProperty['VALUES'] as $value)
								{
									$value['NAME'] = htmlspecialcharsbx($value['NAME']);
									if ($skuProperty['SHOW_MODE'] === 'PICT')
									{
										?>
										<div class="product-item-selected-scu product-item-selected-scu-color selected"
											title="<?=$value['NAME']?>"
											style="background-image: url('<?=$value['PICT']['SRC']?>'); display: none;"
											data-sku-line="<?=$i?>"
											data-treevalue="<?=$propertyId?>_<?=$value['ID']?>"
											data-onevalue="<?=$value['ID']?>">
										</div>
										<?php
									}
									else
									{
										?>
										<div class="product-item-selected-scu product-item-selected-scu-text selected"
											title="<?=$value['NAME']?>"
											style="display: none;"
											data-sku-line="<?=$i?>"
											data-treevalue="<?=$propertyId?>_<?=$value['ID']?>"
											data-onevalue="<?=$value['ID']?>">
											<?=$value['NAME']?>
										</div>
										<?php
									}
								}

								$i++;
							}
							?>
						</div>
					</div>
					<?php
				}
				?>

			</div>
			<div class="product-item-detail-short-card-price">
				<?php
				if ($arParams['SHOW_OLD_PRICE'] === 'Y')
				{
					?>
					<div class="product-item-detail-price-old" style="display: <?=($showDiscount ? '' : 'none')?>;" data-entity="panel-old-price">
						<?=($showDiscount ? $price['PRINT_RATIO_BASE_PRICE'] : '')?>
					</div>
					<?php
				}
				?>
				<div class="product-item-detail-price-current" data-entity="panel-price"><?=$price['PRINT_RATIO_PRICE']?></div>
			</div>
			<?php
			if ($showAddBtn)
			{
				?>
				<div class="product-item-detail-short-card-btn"
					style="display: <?=($actualItem['CAN_BUY'] ? '' : 'none')?>;"
					data-entity="panel-add-button">
					<a class="btn <?=$showButtonClassName?> product-item-detail-buy-button"
						id="<?=$itemIds['ADD_BASKET_LINK']?>"
						href="javascript:void(0);">
						<?=$arParams['MESS_BTN_ADD_TO_BASKET']?>
					</a>
				</div>
				<?php
			}

			if ($showBuyBtn)
			{
				?>
				<div class="product-item-detail-short-card-btn"
					style="display: <?=($actualItem['CAN_BUY'] ? '' : 'none')?>;"
					data-entity="panel-buy-button">
					<a class="btn <?=$buyButtonClassName?> product-item-detail-buy-button"
						id="<?=$itemIds['BUY_LINK']?>"
						href="javascript:void(0);">
						<?=$arParams['MESS_BTN_BUY']?>
					</a>
				</div>
				<?php
			}
			?>
			<div class="product-item-detail-short-card-btn"
				style="display: <?=(!$actualItem['CAN_BUY'] ? '' : 'none')?>;"
				data-entity="panel-not-available-button">
				<a class="btn btn-link product-item-detail-buy-button" href="javascript:void(0)"
					rel="nofollow">
					<?=$arParams['MESS_NOT_AVAILABLE']?>
				</a>
			</div>
		</div>
	</div><?*/?>
	<!--Top tabs-->
	<?/*?><div class="pt-2 pb-0 product-item-detail-tabs-container-fixed d-none d-md-block" id="<?=$itemIds['TABS_PANEL_ID']?>">
		<ul class="product-item-detail-tabs-list">
			<?php
			if ($showDescription)
			{
				?>
				<li class="product-item-detail-tab active" data-entity="tab" data-value="description">
					<a href="javascript:void(0);" class="product-item-detail-tab-link">
						<span><?=$arParams['MESS_DESCRIPTION_TAB']?></span>
					</a>
				</li>
				<?php
			}

			if (!empty($arResult['DISPLAY_PROPERTIES']) || $arResult['SHOW_OFFERS_PROPS'])
			{
				?>
				<li class="product-item-detail-tab" data-entity="tab" data-value="properties">
					<a href="javascript:void(0);" class="product-item-detail-tab-link">
						<span><?=$arParams['MESS_PROPERTIES_TAB']?></span>
					</a>
				</li>
				<?php
			}

			if ($arParams['USE_COMMENTS'] === 'Y')
			{
				?>
				<li class="product-item-detail-tab" data-entity="tab" data-value="comments">
					<a href="javascript:void(0);" class="product-item-detail-tab-link">
						<span><?=$arParams['MESS_COMMENTS_TAB']?></span>
					</a>
				</li>
				<?php
			}
			?>
		</ul>
	</div><?*/?>

	<meta itemprop="name" content="<?=$name?>" />
	<meta itemprop="category" content="<?=$arResult['CATEGORY_PATH']?>" />
	<?php
	if ($haveOffers)
	{
		foreach ($arResult['JS_OFFERS'] as $offer)
		{
			$currentOffersList = array();

			if (!empty($offer['TREE']) && is_array($offer['TREE']))
			{
				foreach ($offer['TREE'] as $propName => $skuId)
				{
					$propId = (int)substr($propName, 5);

					foreach ($skuProps as $prop)
					{
						if ($prop['ID'] == $propId)
						{
							foreach ($prop['VALUES'] as $propId => $propValue)
							{
								if ($propId == $skuId)
								{
									$currentOffersList[] = $propValue['NAME'];
									break;
								}
							}
						}
					}
				}
			}

			$offerPrice = $offer['ITEM_PRICES'][$offer['ITEM_PRICE_SELECTED']];
			?>
			<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
			<meta itemprop="sku" content="<?=htmlspecialcharsbx(implode('/', $currentOffersList))?>" />
			<meta itemprop="price" content="<?=$offerPrice['RATIO_PRICE']?>" />
			<meta itemprop="priceCurrency" content="<?=$offerPrice['CURRENCY']?>" />
			<link itemprop="availability" href="http://schema.org/<?=($offer['CAN_BUY'] ? 'InStock' : 'OutOfStock')?>" />
		</span>
			<?php
		}

		unset($offerPrice, $currentOffersList);
	}
	else
	{
		?>
		<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
		<meta itemprop="price" content="<?=$price['RATIO_PRICE']?>" />
		<meta itemprop="priceCurrency" content="<?=$price['CURRENCY']?>" />
		<link itemprop="availability" href="http://schema.org/<?=($actualItem['CAN_BUY'] ? 'InStock' : 'OutOfStock')?>" />
	</span>
		<?php
	}
	?>
	<?php
	if ($haveOffers)
	{
		$offerIds = array();
		$offerCodes = array();

		$useRatio = $arParams['USE_RATIO_IN_RANGES'] === 'Y';

		foreach ($arResult['JS_OFFERS'] as $ind => &$jsOffer)
		{
			$offerIds[] = (int)$jsOffer['ID'];
			$offerCodes[] = $jsOffer['CODE'];

			$fullOffer = $arResult['OFFERS'][$ind];
			$measureName = $fullOffer['ITEM_MEASURE']['TITLE'];

			$strAllProps = '';
			$strMainProps = '';
			$strPriceRangesRatio = '';
			$strPriceRanges = '';

			if ($arResult['SHOW_OFFERS_PROPS'])
			{
				if (!empty($jsOffer['DISPLAY_PROPERTIES']))
				{
					foreach ($jsOffer['DISPLAY_PROPERTIES'] as $property)
					{
						$current = '<li class="product-item-detail-properties-item">
					<span class="product-item-detail-properties-name">'.$property['NAME'].'</span>
					<span class="product-item-detail-properties-dots"></span>
					<span class="product-item-detail-properties-value">'.(
							is_array($property['VALUE'])
								? implode(' / ', $property['VALUE'])
								: $property['VALUE']
							).'</span></li>';
						$strAllProps .= $current;

						if (isset($arParams['MAIN_BLOCK_OFFERS_PROPERTY_CODE'][$property['CODE']]))
						{
							$strMainProps .= $current;
						}
					}

					unset($current);
				}
			}

			if ($arParams['USE_PRICE_COUNT'] && count($jsOffer['ITEM_QUANTITY_RANGES']) > 1)
			{
				$strPriceRangesRatio = '('.Loc::getMessage(
						'CT_BCE_CATALOG_RATIO_PRICE',
						array('#RATIO#' => ($useRatio
								? $fullOffer['ITEM_MEASURE_RATIOS'][$fullOffer['ITEM_MEASURE_RATIO_SELECTED']]['RATIO']
								: '1'
							).' '.$measureName)
					).')';

				foreach ($jsOffer['ITEM_QUANTITY_RANGES'] as $range)
				{
					if ($range['HASH'] !== 'ZERO-INF')
					{
						$itemPrice = false;

						foreach ($jsOffer['ITEM_PRICES'] as $itemPrice)
						{
							if ($itemPrice['QUANTITY_HASH'] === $range['HASH'])
							{
								break;
							}
						}

						if ($itemPrice)
						{
							$strPriceRanges .= '<dt>'.Loc::getMessage(
									'CT_BCE_CATALOG_RANGE_FROM',
									array('#FROM#' => $range['SORT_FROM'].' '.$measureName)
								).' ';

							if (is_infinite($range['SORT_TO']))
							{
								$strPriceRanges .= Loc::getMessage('CT_BCE_CATALOG_RANGE_MORE');
							}
							else
							{
								$strPriceRanges .= Loc::getMessage(
									'CT_BCE_CATALOG_RANGE_TO',
									array('#TO#' => $range['SORT_TO'].' '.$measureName)
								);
							}

							$strPriceRanges .= '</dt><dd>'.($useRatio ? $itemPrice['PRINT_RATIO_PRICE'] : $itemPrice['PRINT_PRICE']).'</dd>';
						}
					}
				}

				unset($range, $itemPrice);
			}

			$jsOffer['DISPLAY_PROPERTIES'] = $strAllProps;
			$jsOffer['DISPLAY_PROPERTIES_MAIN_BLOCK'] = $strMainProps;
			$jsOffer['PRICE_RANGES_RATIO_HTML'] = $strPriceRangesRatio;
			$jsOffer['PRICE_RANGES_HTML'] = $strPriceRanges;
		}

		$templateData['OFFER_IDS'] = $offerIds;
		$templateData['OFFER_CODES'] = $offerCodes;
		unset($jsOffer, $strAllProps, $strMainProps, $strPriceRanges, $strPriceRangesRatio, $useRatio);

		$jsParams = array(
			'CONFIG' => array(
				'USE_CATALOG' => $arResult['CATALOG'],
				'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
				'SHOW_PRICE' => true,
				'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
				'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
				'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
				'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
				'SHOW_SKU_PROPS' => $arResult['SHOW_OFFERS_PROPS'],
				'OFFER_GROUP' => $arResult['OFFER_GROUP'],
				'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
				'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
				'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
				'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
				'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
				'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
				'USE_STICKERS' => true,
				'USE_SUBSCRIBE' => $showSubscribe,
				'SHOW_SLIDER' => $arParams['SHOW_SLIDER'],
				'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
				'ALT' => $alt,
				'TITLE' => $title,
				'MAGNIFIER_ZOOM_PERCENT' => 200,
				'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
				'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
				'BRAND_PROPERTY' => !empty($arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']])
					? $arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE']
					: null,
				'SHOW_SKU_DESCRIPTION' => $arParams['SHOW_SKU_DESCRIPTION'],
				'DISPLAY_PREVIEW_TEXT_MODE' => $arParams['DISPLAY_PREVIEW_TEXT_MODE']
			),
			'PRODUCT_TYPE' => $arResult['PRODUCT']['TYPE'],
			'VISUAL' => $itemIds,
			'DEFAULT_PICTURE' => array(
				'PREVIEW_PICTURE' => $arResult['DEFAULT_PICTURE'],
				'DETAIL_PICTURE' => $arResult['DEFAULT_PICTURE']
			),
			'PRODUCT' => array(
				'ID' => $arResult['ID'],
				'ACTIVE' => $arResult['ACTIVE'],
				'NAME' => $arResult['~NAME'],
				'CATEGORY' => $arResult['CATEGORY_PATH'],
				'DETAIL_TEXT' => $arResult['DETAIL_TEXT'],
				'DETAIL_TEXT_TYPE' => $arResult['DETAIL_TEXT_TYPE'],
				'PREVIEW_TEXT' => $arResult['PREVIEW_TEXT'],
				'PREVIEW_TEXT_TYPE' => $arResult['PREVIEW_TEXT_TYPE']
			),
			'BASKET' => array(
				'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
				'BASKET_URL' => $arParams['BASKET_URL'],
				'SKU_PROPS' => $arResult['OFFERS_PROP_CODES'],
				'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
				'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
			),
			'OFFERS' => $arResult['JS_OFFERS'],
			'OFFER_SELECTED' => $arResult['OFFERS_SELECTED'],
			'TREE_PROPS' => $skuProps
		);
	}
	else
	{
		$emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
		if ($arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y' && !$emptyProductProperties)
		{
			?>
			<div id="<?=$itemIds['BASKET_PROP_DIV']?>" style="display: none;">
				<?php
				if (!empty($arResult['PRODUCT_PROPERTIES_FILL']))
				{
					foreach ($arResult['PRODUCT_PROPERTIES_FILL'] as $propId => $propInfo)
					{
						?>
						<input type="hidden" name="<?=$arParams['PRODUCT_PROPS_VARIABLE']?>[<?=$propId?>]" value="<?=htmlspecialcharsbx($propInfo['ID'])?>">
						<?php
						unset($arResult['PRODUCT_PROPERTIES'][$propId]);
					}
				}

				$emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
				if (!$emptyProductProperties)
				{
					?>
					<table>
						<?php
						foreach ($arResult['PRODUCT_PROPERTIES'] as $propId => $propInfo)
						{
							?>
							<tr>
								<td><?=$arResult['PROPERTIES'][$propId]['NAME']?></td>
								<td>
									<?php
									if (
										$arResult['PROPERTIES'][$propId]['PROPERTY_TYPE'] === 'L'
										&& $arResult['PROPERTIES'][$propId]['LIST_TYPE'] === 'C'
									)
									{
										foreach ($propInfo['VALUES'] as $valueId => $value)
										{
											?>
											<label>
												<input type="radio" name="<?=$arParams['PRODUCT_PROPS_VARIABLE']?>[<?=$propId?>]"
													value="<?=$valueId?>" <?=($valueId == $propInfo['SELECTED'] ? '"checked"' : '')?>>
												<?=$value?>
											</label>
											<br>
											<?php
										}
									}
									else
									{
										?>
										<select name="<?=$arParams['PRODUCT_PROPS_VARIABLE']?>[<?=$propId?>]">
											<?php
											foreach ($propInfo['VALUES'] as $valueId => $value)
											{
												?>
												<option value="<?=$valueId?>" <?=($valueId == $propInfo['SELECTED'] ? '"selected"' : '')?>>
													<?=$value?>
												</option>
												<?php
											}
											?>
										</select>
										<?php
									}
									?>
								</td>
							</tr>
							<?php
						}
						?>
					</table>
					<?php
				}
				?>
			</div>
			<?php
		}

		$jsParams = array(
			'CONFIG' => array(
				'USE_CATALOG' => $arResult['CATALOG'],
				'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
				'SHOW_PRICE' => !empty($arResult['ITEM_PRICES']),
				'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
				'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
				'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
				'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
				'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
				'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
				'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
				'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
				'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
				'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
				'USE_STICKERS' => true,
				'USE_SUBSCRIBE' => $showSubscribe,
				'SHOW_SLIDER' => $arParams['SHOW_SLIDER'],
				'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
				'ALT' => $alt,
				'TITLE' => $title,
				'MAGNIFIER_ZOOM_PERCENT' => 200,
				'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
				'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
				'BRAND_PROPERTY' => !empty($arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']])
					? $arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE']
					: null
			),
			'VISUAL' => $itemIds,
			'PRODUCT_TYPE' => $arResult['PRODUCT']['TYPE'],
			'PRODUCT' => array(
				'ID' => $arResult['ID'],
				'ACTIVE' => $arResult['ACTIVE'],
				'PICT' => reset($arResult['MORE_PHOTO']),
				'NAME' => $arResult['~NAME'],
				'SUBSCRIPTION' => true,
				'ITEM_PRICE_MODE' => $arResult['ITEM_PRICE_MODE'],
				'ITEM_PRICES' => $arResult['ITEM_PRICES'],
				'ITEM_PRICE_SELECTED' => $arResult['ITEM_PRICE_SELECTED'],
				'ITEM_QUANTITY_RANGES' => $arResult['ITEM_QUANTITY_RANGES'],
				'ITEM_QUANTITY_RANGE_SELECTED' => $arResult['ITEM_QUANTITY_RANGE_SELECTED'],
				'ITEM_MEASURE_RATIOS' => $arResult['ITEM_MEASURE_RATIOS'],
				'ITEM_MEASURE_RATIO_SELECTED' => $arResult['ITEM_MEASURE_RATIO_SELECTED'],
				'SLIDER_COUNT' => $arResult['MORE_PHOTO_COUNT'],
				'SLIDER' => $arResult['MORE_PHOTO'],
				'CAN_BUY' => $arResult['CAN_BUY'],
				'CHECK_QUANTITY' => $arResult['CHECK_QUANTITY'],
				'QUANTITY_FLOAT' => is_float($arResult['ITEM_MEASURE_RATIOS'][$arResult['ITEM_MEASURE_RATIO_SELECTED']]['RATIO']),
				'MAX_QUANTITY' => $arResult['PRODUCT']['QUANTITY'],
				'STEP_QUANTITY' => $arResult['ITEM_MEASURE_RATIOS'][$arResult['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'],
				'CATEGORY' => $arResult['CATEGORY_PATH']
			),
			'BASKET' => array(
				'ADD_PROPS' => $arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y',
				'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
				'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
				'EMPTY_PROPS' => $emptyProductProperties,
				'BASKET_URL' => $arParams['BASKET_URL'],
				'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
				'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
			)
		);
		unset($emptyProductProperties);
	}

	if ($arParams['DISPLAY_COMPARE'])
	{
		$jsParams['COMPARE'] = array(
			'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
			'COMPARE_DELETE_URL_TEMPLATE' => $arResult['~COMPARE_DELETE_URL_TEMPLATE'],
			'COMPARE_PATH' => $arParams['COMPARE_PATH']
		);
	}
	?>
</div>
<script>
	BX.message({
		ECONOMY_INFO_MESSAGE: '<?=GetMessageJS('CT_BCE_CATALOG_ECONOMY_INFO2')?>',
		TITLE_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR')?>',
		TITLE_BASKET_PROPS: '<?=GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS')?>',
		BASKET_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR')?>',
		BTN_SEND_PROPS: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS')?>',
		BTN_MESSAGE_BASKET_REDIRECT: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_BASKET_REDIRECT')?>',
		BTN_MESSAGE_CLOSE: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE')?>',
		BTN_MESSAGE_CLOSE_POPUP: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE_POPUP')?>',
		TITLE_SUCCESSFUL: '<?=GetMessageJS('CT_BCE_CATALOG_ADD_TO_BASKET_OK')?>',
		COMPARE_MESSAGE_OK: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_OK')?>',
		COMPARE_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_UNKNOWN_ERROR')?>',
		COMPARE_TITLE: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_TITLE')?>',
		BTN_MESSAGE_COMPARE_REDIRECT: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT')?>',
		PRODUCT_GIFT_LABEL: '<?=GetMessageJS('CT_BCE_CATALOG_PRODUCT_GIFT_LABEL')?>',
		PRICE_TOTAL_PREFIX: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_PRICE_TOTAL_PREFIX')?>',
		RELATIVE_QUANTITY_MANY: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY'])?>',
		RELATIVE_QUANTITY_FEW: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW'])?>',
		SITE_ID: '<?=CUtil::JSEscape($component->getSiteId())?>'
	});

	var <?=$obName?> = new JCCatalogElement(<?=CUtil::PhpToJSObject($jsParams, false, true)?>);
</script>
<?php
unset($actualItem, $itemIds, $jsParams);
