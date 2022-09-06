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
// $this->addExternalCss("/bitrix/css/main/bootstrap.css");
$this->addExternalCss("/bitrix/css/main/font-awesome.css");
$this->addExternalCss($this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css');
CUtil::InitJSCore(array('fx'));
?>
<div class="container">
	<div class="product" id="<?echo $this->GetEditAreaId($arResult['ID'])?>">

	<div class="row">
		<div class="col-md-6">
			<?if($arParams["DISPLAY_PICTURE"]!="N"):?>
				<?if ($arResult["VIDEO"]):?>
					<div class="bx-newsdetail-youtube embed-responsive embed-responsive-16by9" style="display: block;">
						<iframe src="<?echo $arResult["VIDEO"]?>" frameborder="0" allowfullscreen=""></iframe>
					</div>
				<?elseif ($arResult["SOUND_CLOUD"]):?>
					<div class="bx-newsdetail-audio">
						<iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=<?echo urlencode($arResult["SOUND_CLOUD"])?>&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>
					</div>
				<?elseif ($arResult["SLIDER"] && count($arResult["SLIDER"]) > 1):?>
					<div class="product-slider">
						<div class="swiper product-slider__top js-product-slider-top">
							<div class="swiper-wrapper">
								<?foreach ($arResult["SLIDER"] as $file):?>
									<div class="swiper-slide">
										<div class="swiper-slide-container">
											<div class="aspect-ratio aspect-ratio_85">
												<img src="<?=$file["SRC"]?>" alt="<?=$file["DESCRIPTION"]?>">
											</div>
										</div>
									</div>
								<?endforeach?>
							</div>
						</div>
						<div class="slider d-flex justify-content-center align-items-center">
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
							<div class="slider__body">
								<div class="swiper product-slider__thumbs js-product-slider-thumbs">
									<div class="swiper-wrapper">
										<?foreach ($arResult["SLIDER"] as $i => $file):?>
											<div class="swiper-slide">
												<div class="swiper-slide-container">
													<div class="aspect-ratio aspect-ratio_100">
														<img src="<?=$file["SRC"]?>" alt="<?=$file["DESCRIPTION"]?>">
														<a href="#" class="product-slider__open" data-toggle="modal" data-target="#modal-product-slider" aria-label="Посмотреть изображение полностью">
															<span class="icon-search"></span>
														</a>
													</div>
												</div>
											</div>
										<?endforeach?>
									</div>
									<!-- Add Arrows -->
									<div class="swiper-button-next"></div>
									<div class="swiper-button-prev"></div>
								</div>
							</div>
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
						</div>
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
												<a href="javascript:void(0)" class="slider__next js-modal-next" role="button" aria-label="Предыдущий слайд">
													<span class="icon-chevron-thin rotate-180"></span>
												</a>
											</div>
											<div class="slider__body">
												<div class="swiper js-product-slider-modal">
													<div class="swiper-wrapper">
														<?foreach ($arResult["SLIDER"] as $i => $file):?>
															<div class="swiper-slide">
																<a href="<?=$file["SRC"]?>">
																	<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?=$file["SRC"]?>" class="swiper-lazy" alt="<?=$file["DESCRIPTION"]?>">
																</a>
															</div>
														<?endforeach;?>
													</div>
													<div class="swiper-pagination"></div>
													<div class="swiper-button-prev"></div>
													<div class="swiper-button-next"></div>
												</div>
											</div>
											<div class="slider__navigation">
												<a href="javascript:void(0)" class="slider__prev js-modal-prev" role="button" aria-label="Следующий слайд">
													<span class="icon-chevron-thin"></span>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
				<?elseif ($arResult["SLIDER"]):?>
					<div class="aspect-ratio aspect-ratio_85">
						<img
							src="<?=$arResult["SLIDER"][0]["SRC"]?>"
							width="<?=$arResult["SLIDER"][0]["WIDTH"]?>"
							height="<?=$arResult["SLIDER"][0]["HEIGHT"]?>"
							alt="<?=$arResult["SLIDER"][0]["ALT"]?>"
							title="<?=$arResult["SLIDER"][0]["TITLE"]?>"
							/>
					</div>
				<?elseif (is_array($arResult["DETAIL_PICTURE"])):?>
					<div class="aspect-ratio aspect-ratio_85">
						<img
							src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
							width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
							height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
							alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
							title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
							/>
					</div>
				<?endif;?>
			<?endif?>
		</div>
		<div class="col-md-6 col-xl-5 pt-30 pt-md-0">
			<div class="border-left pl-0 pl-md-30 pb-xl-50">
				<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
					<h1 class="ff-dinpro fz-20 fz-xl-25 fw-700 pt-30 mb-30 pt-xl-65 mb-xl-40 px-xl-40"><?=$arResult["NAME"]?></h1>
				<?endif;?>
				<div class="border-bottom mb-20 mb-xl-35"></div>
				<?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
					<div class="mb-20 mb-xl-50 px-xl-40">
						<?
						if(is_array($arProperty["DISPLAY_VALUE"]))
							$value = implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
						else
							$value = $arProperty["DISPLAY_VALUE"];
						?>
						<?if($arProperty["CODE"] == "FORUM_MESSAGE_CNT"):?>
							<div class="bx-newsdetail-comments"><i class="fa fa-comments"></i> <?=$arProperty["NAME"]?>:
								<?=$value;?>
							</div>
						<?elseif ($value != ""):?>
							<div class="fz-lg-18 fz-xl-20">
								<span class="ff-dinpro fw-700"><?=$arProperty["NAME"]?>:</span>
								<?=$value;?>
							</div>
						<?endif;?>
					</div>
				<?endforeach;?>
				<div class="border-bottom mb-30 mb-xl-40"></div>
				<div class="bx-newsdetail-content">
					<?if($arResult["NAV_RESULT"]):?>
						<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
						<?echo $arResult["NAV_TEXT"];?>
						<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
					<?elseif($arResult["DETAIL_TEXT"] <> ''):?>
						<div class="text-grey fz-lg-18 fz-xl-20 px-xl-40"><?echo $arResult["DETAIL_TEXT"];?></div>
					<?else:?>
						<div class="text-grey fz-lg-18 fz-xl-20 px-xl-40"><?echo $arResult["PREVIEW_TEXT"];?></div>
					<?endif?>
				</div>
				<?foreach($arResult["FIELDS"] as $code=>$value):?>
					<?if($code == "SHOW_COUNTER"):?>
						<div class="bx-newsdetail-view"><i class="fa fa-eye"></i> <?=GetMessage("IBLOCK_FIELD_".$code)?>:
							<?=intval($value);?>
						</div>
					<?elseif($code == "SHOW_COUNTER_START" && $value):?>
						<?
						$value = CIBlockFormatProperties::DateFormat($arParams["ACTIVE_DATE_FORMAT"], MakeTimeStamp($value, CSite::GetDateFormat()));
						?>
						<div class="bx-newsdetail-date"><i class="fa fa-calendar-o"></i> <?=GetMessage("IBLOCK_FIELD_".$code)?>:
							<?=$value;?>
						</div>
					<?elseif($code == "TAGS" && $value):?>
						<div class="bx-newsdetail-tags"><i class="fa fa-tag"></i> <?=GetMessage("IBLOCK_FIELD_".$code)?>:
							<?=$value;?>
						</div>
					<?elseif($code == "CREATED_USER_NAME"):?>
						<div class="bx-newsdetail-author"><i class="fa fa-user"></i> <?=GetMessage("IBLOCK_FIELD_".$code)?>:
							<?=$value;?>
						</div>
					<?elseif ($value != ""):?>
						<div class="bx-newsdetail-other"><i class="fa"></i> <?=GetMessage("IBLOCK_FIELD_".$code)?>:
							<?=$value;?>
						</div>
					<?endif;?>
				<?endforeach;?>

				<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
					<div class="bx-newsdetail-date"><i class="fa fa-calendar-o"></i> <?echo $arResult["DISPLAY_ACTIVE_FROM"]?></div>
				<?endif?>
				<?if($arParams["USE_RATING"]=="Y"):?>
					<div class="bx-newsdetail-separator">|</div>
					<div class="bx-newsdetail-rating">
						<?$APPLICATION->IncludeComponent(
							"bitrix:iblock.vote",
							"flat",
							Array(
								"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
								"IBLOCK_ID" => $arParams["IBLOCK_ID"],
								"ELEMENT_ID" => $arResult["ID"],
								"MAX_VOTE" => $arParams["MAX_VOTE"],
								"VOTE_NAMES" => $arParams["VOTE_NAMES"],
								"CACHE_TYPE" => $arParams["CACHE_TYPE"],
								"CACHE_TIME" => $arParams["CACHE_TIME"],
								"DISPLAY_AS_RATING" => $arParams["DISPLAY_AS_RATING"],
								"SHOW_RATING" => "Y",
							),
							$component
						);?>
					</div>
				<?endif?>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-5">
			</div>
		<?
		if ($arParams["USE_SHARE"] == "Y")
		{
			?>
			<div class="col-xs-7 text-right">
				<noindex>
				<?
				$APPLICATION->IncludeComponent("bitrix:main.share", $arParams["SHARE_TEMPLATE"], array(
						"HANDLERS" => $arParams["SHARE_HANDLERS"],
						"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
						"PAGE_TITLE" => $arResult["~NAME"],
						"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
						"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
						"HIDE" => $arParams["SHARE_HIDE"],
					),
					$component,
					array("HIDE_ICONS" => "Y")
				);
				?>
				</noindex>
			</div>
			<?
		}
		?>
		</div>
	</div>
	</div>
</div>
<script type="text/javascript">
	BX.ready(function() {
		var slider = new JCNewsSlider('<?=CUtil::JSEscape($this->GetEditAreaId($arResult['ID']));?>', {
			imagesContainerClassName: 'bx-newsdetail-slider-container',
			leftArrowClassName: 'bx-newsdetail-slider-arrow-container-left',
			rightArrowClassName: 'bx-newsdetail-slider-arrow-container-right',
			controlContainerClassName: 'bx-newsdetail-slider-control'
		});
	});
</script>
