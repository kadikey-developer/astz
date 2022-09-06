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
$this->addExternalCss("/bitrix/css/main/bootstrap.css");
?>
<div class="filter mb-30 mb-lg-60">
	<a class="collapse-action text-uppercase ff-dinpro fw-700 fz-16 fz-lg-18" data-toggle="collapse" href="#collapse-params" role="button" aria-expanded="true" aria-controls="collapse-params">
		<span class="mr-20">Параметры</span><span class="collapse-caret icon-chevron-bold"></span> 
	</a>
	<div class="collapse show" id="collapse-params">
		<div class="pt-30 pt-lg-60">
			<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get">
				<div class="bx-filter-section container-fluid">
					<?/*<div class="row"><div class="col-lg-12 bx-filter-title"><?=GetMessage("CT_BCF_FILTER_TITLE")?></div></div>*/?>
					<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 mb-30">
						<?foreach($arResult["ITEMS"] as $arItem):?>
							<?if(array_key_exists("HIDDEN", $arItem)):?>
								<?=$arItem["INPUT"]?>
							<?elseif ($arItem["TYPE"] == "RANGE"):?>
								<div class="col-sm-6 col-md-4 bx-filter-parameters-box active">
									<div class="bx-filter-parameters-box-title"><span><?=$arItem["NAME"]?></span></div>
									<div class="bx-filter-block">
										<div class="row bx-filter-parameters-box-container">
											<div class="col-xs-6 bx-filter-parameters-box-container-block  bx-left">
												<div class="bx-filter-input-container">
													<input
														type="text"
														value="<?=$arItem["INPUT_VALUES"][0]?>"
														name="<?=$arItem["INPUT_NAMES"][0]?>"
														placeholder="<?=GetMessage("CT_BCF_FROM")?>"
													/>
												</div>
											</div>
											<div class="col-xs-6 bx-filter-parameters-box-container-block  bx-right">
												<div class="bx-filter-input-container">
													<input
														type="text"
														value="<?=$arItem["INPUT_VALUES"][1]?>"
														name="<?=$arItem["INPUT_NAMES"][1]?>"
														placeholder="<?=GetMessage("CT_BCF_TO")?>"
													/>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?elseif ($arItem["TYPE"] == "DATE_RANGE"):?>
								<div class="col-sm-6 col-md-4 bx-filter-parameters-box active">
									<div class="bx-filter-parameters-box-title"><span><?=$arItem["NAME"]?></span></div>
									<div class="bx-filter-block">
										<div class="row bx-filter-parameters-box-container">
											<div class="col-xs-6 bx-filter-parameters-box-container-block  bx-left"><div class="bx-filter-input-container bx-filter-calendar-container">
													<?$APPLICATION->IncludeComponent(
														'bitrix:main.calendar',
														'',
														array(
															'FORM_NAME' => $arResult["FILTER_NAME"]."_form",
															'SHOW_INPUT' => 'Y',
															'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="'.FormatDate("SHORT", $arItem["VALUES"]["MIN"]["VALUE"]).'"',
															'INPUT_NAME' => $arItem["INPUT_NAMES"][0],
															'INPUT_VALUE' => $arItem["INPUT_VALUES"][0],
															'SHOW_TIME' => 'N',
															'HIDE_TIMEBAR' => 'Y',
														),
														null,
														array('HIDE_ICONS' => 'Y')
													);?>
											</div></div>
											<div class="col-xs-6 bx-filter-parameters-box-container-block  bx-right"><div class="bx-filter-input-container bx-filter-calendar-container">
													<?$APPLICATION->IncludeComponent(
														'bitrix:main.calendar',
														'',
														array(
															'FORM_NAME' => $arResult["FILTER_NAME"]."_form",
															'SHOW_INPUT' => 'Y',
															'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="'.FormatDate("SHORT", $arItem["VALUES"]["MAX"]["VALUE"]).'"',
															'INPUT_NAME' => $arItem["INPUT_NAMES"][1],
															'INPUT_VALUE' => $arItem["INPUT_VALUES"][1],
															'SHOW_TIME' => 'N',
															'HIDE_TIMEBAR' => 'Y',
														),
														null,
														array('HIDE_ICONS' => 'Y')
													);?>
											</div></div>
										</div>
									</div>
								</div>
							<?elseif ($arItem["TYPE"] == "SELECT"):
								?>
								<div class="col mb-20 mb-lg-60 active">
									<label class="ff-dinpro fw-500" for="<?=$arItem["INPUT_NAME"]?>"><?=$arItem["NAME"]?></label>
									
									<div class="lib-select lib-select-sm">
										<select id="<?=$arItem["INPUT_NAME"]?>" class="js-lib-select" name="<?=$arItem["INPUT_NAME"].($arItem["MULTIPLE"] == "Y" ? "[]" : "")?>">
											<?foreach ($arItem["LIST"] as $key => $value):?>
												<option
													value="<?=htmlspecialcharsBx($key)?>"
													<?if ($key == $arItem["INPUT_VALUE"]) echo 'selected="selected"'?>
												><?=htmlspecialcharsEx($value)?></option>
											<?endforeach?>
										</select>
									</div>

								</div>
							<?elseif ($arItem["TYPE"] == "CHECKBOX"):
								?>
								<div class="col-sm-6 col-md-4 bx-filter-parameters-box active">
									<div class="bx-filter-parameters-box-title"><span><?=$arItem["NAME"]?></span></div>
									<div class="bx-filter-block">
										<div class="row bx-filter-parameters-box-container">
											<div class="col-xs-12 bx-filter-parameters-box-container-block">
											<?
											$arListValue = (is_array($arItem["~INPUT_VALUE"]) ? $arItem["~INPUT_VALUE"] : array($arItem["~INPUT_VALUE"]));
											foreach ($arItem["LIST"] as $key => $value):?>
											<div class="checkbox">
												<label class="bx-filter-param-label">
													<input
														type="checkbox"
														value="<?=htmlspecialcharsBx($key)?>"
														name="<?echo $arItem["INPUT_NAME"]?>[]"
														<?if (in_array($key, $arListValue)) echo 'checked="checked"'?>
													>
													<span class="bx-filter-param-text"><?=htmlspecialcharsEx($value)?></span>
												</label>
											</div>
											<?endforeach?>
											</div>
										</div>
									</div>
								</div>
							<?elseif ($arItem["TYPE"] == "RADIO"):
								?>
								<div class="col-sm-6 col-md-4 bx-filter-parameters-box active">
									<div class="bx-filter-parameters-box-title"><span><?=$arItem["NAME"]?></span></div>
									<div class="bx-filter-block">
										<div class="row bx-filter-parameters-box-container">
											<div class="col-xs-12 bx-filter-parameters-box-container-block">
												<?
												$arListValue = (is_array($arItem["~INPUT_VALUE"]) ? $arItem["~INPUT_VALUE"] : array($arItem["~INPUT_VALUE"]));
												foreach ($arItem["LIST"] as $key => $value):?>
												<div class="radio">
													<label class="bx-filter-param-label">
														<input
															type="radio"
															value="<?=htmlspecialcharsBx($key)?>"
															name="<?echo $arItem["INPUT_NAME"]?>"
															<?if (in_array($key, $arListValue)) echo 'checked="checked"'?>
														>
														<span class="bx-filter-param-text"><?=htmlspecialcharsEx($value)?></span>
													</label>
												</div>
												<?endforeach?>
											</div>
										</div>
									</div>
								</div>
							<?else:?>
								<div class="col-sm-6 col-md-4 bx-filter-parameters-box active">
									<div class="bx-filter-parameters-box-title"><span><?=$arItem["NAME"]?></span></div>
									<div class="bx-filter-block">
										<div class="row bx-filter-parameters-box-container">
											<div class="col-xs-12 bx-filter-parameters-box-container-block">
												<div class="bx-filter-input-container">
													<?=$arItem["INPUT"]?>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?endif?>
						<?endforeach;?>
					</div>
					<div class="row mb-60">
						<input class="btn btn-blue-dark" type="submit" name="set_filter" value="<?=GetMessage("CT_BCF_SET_FILTER")?>" class="btn btn-primary" />
						<input type="hidden" name="set_filter" value="Y" />
					</div>
					<?
					/** 
					 * Выношу установленные параметры фильтрации
					 */
					$selectedFilters = array();
					foreach ( $arResult['ITEMS'] as $id => $item ) {
						if ( !$item["INPUT_VALUE"] == "" ) {
							$selectedFilters["ACTIVE_PROPS"][$id] = array(
								"NAME" => $item["NAME"],
								"VALUE" => $item["LIST"][$item["INPUT_VALUE"]]
							);
							$selectedFilters["FILTERED_PROPERTIES"][$id] = $item["INPUT_VALUE"];
						}
					}
					?>
					<?
					if (!empty($selectedFilters)) {
						?>
						<div class="row mb-60">
							<div class="d-flex flex-column flex-sm-row align-items-sm-center mb-20">
								<div class="mr-20 mb-10 mb-sm-0">
									найдено : <?= CIBlockElement::GetList(
										array('SORT' => 'ASC'),
										array(
											'IBLOCK_ID' => $arParams['IBLOCK_ID'],
											'SECTION_ID' => $arParams['SECTION_ID'],
											'INCLUDE_SUBSECTIONS' => 'Y',
											'ACTIVE' => 'Y',
											$selectedFilters['FILTERED_PROPERTIES']
										),
										array()
									); ?>
								</div>
								<div>
									<input class="btn btn-outline-blue-dark h-auto py-5 px-20" type="submit" name="del_filter" value="<?=GetMessage("CT_BCF_DEL_FILTER")?>" class="btn btn-link" />
								</div>
							</div>
						</div>
						<div>
							<?
							foreach ($selectedFilters['ACTIVE_PROPS'] as $prop) {
								?>
								<div class="d-inline-flex align-items-center mr-30 mb-10">
									<div class="ff-dinpro border-bottom border-blue-dark mr-5 pr-10 pb-4">
										<?=$prop['NAME']?>: 
										<? if (is_array($prop['VALUE'])) {
											if(!empty($prop['VALUE']['MIN'])) echo ' от ' . $prop['VALUE']['MIN'];
											if(!empty($prop['VALUE']['MAX'])) echo ' до ' . $prop['VALUE']['MAX'];
										} else {
											echo $prop['VALUE'];
										}
										?>
									</div>
									<div>
										<a href="#" class="text-red"><span class="icon-cross-thin d-inline-block fz-12"></span></a>
									</div>
								</div>
								<?
							}
							?>
						</div>
						<?
					}
					?>
					<!--  -->
					<div class="clb"></div>
				</div>
			</form>
		</div>
	</div>
</div>