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
$this->addExternalCss($templateFolder . "/icons/style.css");?>
<div class="header-search header-stretch">
	<div id="js-migrate-search-desctop" class="migrate-search-desctop">
		<div id="js-migrate-search-target">
			<div id="js-header-search-wrapper" class="lh-1">
				<form action="<?=$arResult["FORM_ACTION"]?>">
						<?if($arParams["USE_SUGGEST"] === "Y"):?><?$APPLICATION->IncludeComponent(
							"bitrix:search.suggest.input",
							"",
							array(
								"NAME" => "q",
								"VALUE" => "",
								"INPUT_SIZE" => 15,
								"DROPDOWN_SIZE" => 10,
							),
							$component, array("HIDE_ICONS" => "Y")
						);?>
						<?else:?>
							<!-- <input type="text" name="q" value="" size="15" maxlength="50" /> -->
						<div class="header-search__input-group" id="js-header-search-target">
							<div class="input-group">
								<input class="header-search__input form-control" id="site-search" type="search" name="q" placeholder="Поиск по сайту" aria-label="Поиск по сайту">
								<div class="input-group-append">
									<input class="header-search__button btn btn-red" type="submit" value="<?=GetMessage("BSF_T_SEARCH_BUTTON");?>">
								</div>
							</div>
						</div>
						<a href="javascript:void(0)" class="header-search__label m-0" id="js-header-search-action">
							<span class="header-search__action header-search__action_open icon-search fz-20 lh-1 align-middle" id="js-header-search-open"></span>
							<span class="header-search__action header-search__action_close icon-cross-thin fz-20 lh-1 align-middle" id="js-header-search-close"></span>
						</a>
						<?endif;?>
						<!-- <input name="s" type="submit" value="<?=GetMessage("BSF_T_SEARCH_BUTTON");?>" /> -->
				</form>
			</div>
		</div>
	</div>
</div>