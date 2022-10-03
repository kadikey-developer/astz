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
$arViewModeList = $arResult['VIEW_MODE_LIST'];

$arViewStyles = array(
	'LIST' => array(
		'CONT' => 'bx_sitemap',
		'TITLE' => 'bx_sitemap_title',
		'LIST' => 'catalog-section-list-list',
	),
	'LINE' => array(
		'TITLE' => 'catalog-section-list-item-title',
		'LIST' =>  'catalog-section-list-line-list mb-4',
		'EMPTY_IMG' => $this->GetFolder().'/images/line-empty.png'
	),
	'TEXT' => array(
		'TITLE' => 'catalog-section-list-item-title',
		'LIST' =>  'catalog-section-list-text-list row mb-4'
	),
	'TILE' => array(
		'TITLE' => 'catalog-section-list-item-title',
		'LIST' =>  'catalog-section-list-tile-list row mb-4',
		'EMPTY_IMG' => $this->GetFolder().'/images/tile-empty.png'
	)
);
$arCurView = $arViewStyles[$arParams['VIEW_MODE']];

switch ($arParams['LIST_COLUMNS_COUNT'])
{
	case "1":
		$listColumsClass = "col-12";
		break;
	case "2":
		$listColumsClass = "col-6";
		break;
	case "3":
		$listColumsClass = "col-sm-4 col-6";
		break;
	case "4":
		$listColumsClass = "col-md-3 col-sm-4 col-6";
		break;
	case "6":
		$listColumsClass = "col-lg-2 col-md-3 col-sm-4 col-6";
		break;
	case "12":
		$listColumsClass = "col-lg-1 col-md-3 col-sm-4 col-6";
		break;
}

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

?>
<?
/**
 * Можно перетащить в section_horizontal
 */
?>
<div class="container">
	<div class="text-center mb-30 mb-lg-60">
		<!-- Section header -->
		<? if ('Y' == $arParams['SHOW_PARENT_NAME'] && 0 < $arResult['SECTION']['ID'])
		{
			$this->AddEditAction($arResult['SECTION']['ID'], $arResult['SECTION']['EDIT_LINK'], $strSectionEdit);
			$this->AddDeleteAction($arResult['SECTION']['ID'], $arResult['SECTION']['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
	
			?><h1 class="fz-20 fz-lg-36 ff-dinpro fw-700 text-uppercase mb-0" id="<? echo $this->GetEditAreaId($arResult['SECTION']['ID']); ?>" ><?
			echo (
			isset($arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]) && $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] != ""
				? $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]
				: $arResult['SECTION']['NAME']
			);
			?></h1><?
		}
		?>
	</div>
</div>
<?
$arSection = $arResult['SECTION'];
if (!$arResult['SECTIONS_COUNT']) {
	//region Series Description
	?>
	<div class="container">
		<div class="product">
			<div class="row">
				<div class="col-md-6">
					<div class="position-relative">
						<?if( !empty($arSection['DETAIL_PICTURE']) ):?>
							<div class="aspect-ratio aspect-ratio_85">
								<img class="lazyload" src="<?=$arSection['DETAIL_PICTURE']['SRC']?>" alt="<?$arSection['DETAIL_PICTURE']['ALT']?>">
							</div>
							<div class="product__3d">
								<a href="#" class="text-red" aria-hidden="true">
									<span class="icon-3d"></span>
								</a>
							</div>
						<?else:?>
							<div class="aspect-ratio aspect-ratio_85">
								<img class="lazyload" src="<?$arSection['DEFAULT_PICTURE']['SRC']?>" alt=""> <!-- не выводится изображение -->
							</div>
						<?endif;?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="border-left pl-0 pl-md-30">
						<div class="ff-dinpro fz-22 fw-700 mb-15">
							<?=$arSection['NAME']?>
						</div>

						<div class="product-properties" id="properties-accordion">
							<div class="product-properties__labels">
								<?foreach ( $arResult["S_PROPERTIES"]["B_PIKTOGRAMY"]["DISPLAY_VALUE"] as $arPiktogram ):?>
									<div class="product-properties__label">
										<a href="#prop-<?=$arPiktogram['ID']?>" class="d-block aspect-ratio aspect-ratio_100"
											data-toggle="collapse"
											role="button"
											aria-expanded="false"
											aria-controls="prop-<?=$arPiktogram['ID']?>"
											id="heading-properties-1"
										>
											<span>
												<img class="lazyload" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="/upload/<?=$arPiktogram['UF_FILE']['SUBDIR']?>/<?=$arPiktogram['UF_FILE']['FILE_NAME']?>" alt="PROPERTY_NAME">
											</span>
										</a>
									</div>
								<?endforeach;?>
							</div>
							<div class="product-properties__descriptions">
								<?
								foreach ( $arResult["S_PROPERTIES"]["B_PIKTOGRAMY"]["DISPLAY_VALUE"] as $description ) {
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
						
						<div class="border-bottom mb-30 mb-lg-45"></div>
						<div>
							<div class="ff-dinpro fw-700 fz-18 mb-15 mb-lg-25">
								<?if (!empty($arResult["S_PROPERTIES"]["NORMATIVNYY_DOKUMENT"]["VALUE"])):?>
									Нормативный документ - <?=$arResult["S_PROPERTIES"]["NORMATIVNYY_DOKUMENT"]["VALUE"]?>
								<?endif?>
							</div>
							<?
							if (($arParams['HIDE_SECTION_DESCRIPTION'] !== 'Y') && !empty($arSection['DESCRIPTION'])) {
								?>
								<div>
									<?= $arSection['DESCRIPTION'] ?>
								</div>
								<?
							}
							if ( isset($arResult["S_DISPLAY_PROPERTIES"]) && !empty($arResult["S_DISPLAY_PROPERTIES"]) ) {
								foreach ( $arResult["S_DISPLAY_PROPERTIES"] as $property) {
								?>
								<div>
									<span class="ff-dinpro fw-500 fz-18"><?=$property['NAME']?>:</span>
									<?=(is_array($property['~VALUE'])
											? implode(' / ', $property['~VALUE'])
											: $property['~VALUE'] )?>
								</div>
								<?
								}
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="py-15 py-lg-30"></div>
	
	<?
	//endregion	
}
?>

		<?
		if (0 < $arResult["SECTIONS_COUNT"])
		{
		?><div class="container mb-60"><?

			switch ($arParams['VIEW_MODE'])
			{
				case 'LINE':
					foreach ($arResult['SECTIONS'] as &$arSection)
					{
						$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
						$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

						if (false === $arSection['PICTURE'])
							$arSection['PICTURE'] = array(
								'SRC' => $arCurView['EMPTY_IMG'],
								'ALT' => (
									'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
									? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
									: $arSection["NAME"]
								),
								'TITLE' => (
									'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
									? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
									: $arSection["NAME"]
								)
							);
							?>
							<li id="<? echo $this->GetEditAreaId($arSection['ID']); ?>" class="catalog-section-list-item">
								<div class="catalog-section-list-line-img-container">
									<a
										href="<? echo $arSection['SECTION_PAGE_URL']; ?>"
										class="catalog-section-list-item-img"
										style="background-image:url('<? echo $arSection['PICTURE']['SRC']; ?>');"
										title="<? echo $arSection['PICTURE']['TITLE']; ?>"
									></a>
								</div>
								<div class="catalog-section-list-item-inner">
									<h3 class="catalog-section-list-item-title">
										<a class="catalog-section-list-item-link" href="<? echo $arSection['SECTION_PAGE_URL']; ?>">
											<? echo $arSection['NAME']; ?>
										</a>
										<? if ($arParams["COUNT_ELEMENTS"] && $arSection['ELEMENT_CNT'] !== null)
										{
											?>
											<span class="catalog-section-list-item-counter">(<? echo $arSection['ELEMENT_CNT']; ?>)</span>
											<?
										}
										?>
									</h3>
									<? if ('' != $arSection['DESCRIPTION'])
									{
										?>
										<p class="catalog-section-list-item-description"><? echo $arSection['DESCRIPTION']; ?></p>
										<?
									}
									?>
								</div>

						</li><?
					}
					unset($arSection);
					break;

				case 'TEXT':
					foreach ($arResult['SECTIONS'] as &$arSection)
					{
						$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
						$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

						?>
						<li id="<? echo $this->GetEditAreaId($arSection['ID']); ?>" class="<?=$listColumsClass?> catalog-section-list-item">
							<div class="catalog-section-list-item-inner">
								<h3 class="catalog-section-list-item-title">
									<a class="catalog-section-list-item-link" href="<? echo $arSection['SECTION_PAGE_URL']; ?>">
										<? echo $arSection['NAME']; ?>
									</a>
									<? if ($arParams["COUNT_ELEMENTS"] && $arSection['ELEMENT_CNT'] !== null)
									{
										?>
										<span class="catalog-section-list-item-counter">(<? echo $arSection['ELEMENT_CNT']; ?>)</span>
										<?
									}
									?>
								</h3>
							</div>
						</li><?
					}
					unset($arSection);
					break;

				case 'TILE':
					?>
					<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 mb-30">
						<?
						foreach ($arResult['SECTIONS'] as &$arSection)
						{
							$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
							$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

							if (false === $arSection['PICTURE'])
								$arSection['PICTURE'] = array(
									'SRC' => $arCurView['EMPTY_IMG'],
									'ALT' => (
										'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
										? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
										: $arSection["NAME"]
									),
									'TITLE' => (
										'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
										? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
										: $arSection["NAME"]
									)
								);
								?>
								<div id="<?= $this->GetEditAreaId($arSection['ID']); ?>" class="col mb-20 mb-lg-80">
									<div class="border rounded h-100"> 
										<a
											href="<?= $arSection['SECTION_PAGE_URL']; ?>"
											class="d-block aspect-ratio aspect-ratio_100"
											>
											<img src="<?= $arSection['PICTURE']['SRC']; ?>" alt="<?= $arSection['PICTURE']['TITLE']; ?>">
										</a>
										<div class="text-left px-25 py-25">
											<? if ('Y' != $arParams['HIDE_SECTION_NAME'])
											{
												?>
												<a class="text-truncate-2 text-truncate-autoheight ff-dinpro fw-700 fz-20 fz-lg-22 mb-15" href="<?= $arSection['SECTION_PAGE_URL']; ?>">
													<?= $arSection['NAME']; ?>
												</a>
												<?
											}
											?>
											<? if ('Y' == $arParams['SECTIONS_SHOW_UF_DESCR'])
											{
												?>
												<div class="fz-16 mb-10">
													<? echo (strlen($arSection["UF_PROPS"]['~UF_SECTION_DESCR']) > 100) 
														? mb_substr($arSection["UF_PROPS"]['~UF_SECTION_DESCR'], 0 , 100) . '...'
														: $arSection["UF_PROPS"]['~UF_SECTION_DESCR']; ?>
												</div>
												<?
											}
											?>
												<? if ($arParams["COUNT_ELEMENTS"] && $arSection['ELEMENT_CNT'] !== null)
												{
													?>
													<a class="d-inline-block fz-18 fw-700"><?= $arSection['ELEMENT_CNT']; ?> товаров</a>
													<?
												}
												?>
										</div>
									</div>
								</div>
							<?
						}
						unset($arSection);
						?>
					</div>
					<?
					break;

				case 'LIST':
					$intCurrentDepth = 1;
					$boolFirst = true;
					foreach ($arResult['SECTIONS'] as &$arSection)
					{
						$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
						$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

						if ($intCurrentDepth < $arSection['RELATIVE_DEPTH_LEVEL'])
						{
							if (0 < $intCurrentDepth)
								echo "\n",str_repeat("\t", $arSection['RELATIVE_DEPTH_LEVEL']),'<ul>';
						}
						elseif ($intCurrentDepth == $arSection['RELATIVE_DEPTH_LEVEL'])
						{
							if (!$boolFirst)
								echo '</li>';
						}
						else
						{
							while ($intCurrentDepth > $arSection['RELATIVE_DEPTH_LEVEL'])
							{
								echo '</li>',"\n",str_repeat("\t", $intCurrentDepth),'</ul>',"\n",str_repeat("\t", $intCurrentDepth-1);
								$intCurrentDepth--;
							}
							echo str_repeat("\t", $intCurrentDepth-1),'</li>';
						}

						echo (!$boolFirst ? "\n" : ''),str_repeat("\t", $arSection['RELATIVE_DEPTH_LEVEL']);
						?>
						<li class="catalog-section-list-item" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
							<h3 class="catalog-section-list-list-title">
								<a class="catalog-section-list-list-link" href="<? echo $arSection["SECTION_PAGE_URL"]; ?>"><? echo $arSection["NAME"];?><?
									if ($arParams["COUNT_ELEMENTS"] && $arSection['ELEMENT_CNT'] !== null)
									{
										?> <span>(<? echo $arSection["ELEMENT_CNT"]; ?>)</span><?
									}
									?>
								</a>
							</h3>
						<?

						$intCurrentDepth = $arSection['RELATIVE_DEPTH_LEVEL'];
						$boolFirst = false;
					}
					unset($arSection);
					while ($intCurrentDepth > 1)
					{
						echo '</li>',"\n",str_repeat("\t", $intCurrentDepth),'</ul>',"\n",str_repeat("\t", $intCurrentDepth-1);
						$intCurrentDepth--;
					}
					if ($intCurrentDepth > 0)
					{
						echo '</li>',"\n";
					}
					break;
			}
			?></div><?
		}
		?>

<? // Расшифровка модификации ?>
<!-- Расширфрока модификации - start -->
<pre><?// print_r($arResult); ?></pre>
<div class="container">
	<div>
		<a class="collapse-action text-uppercase ff-dinpro fw-700 fz-16 fz-lg-18" data-toggle="collapse" href="#collapse-modification" role="button" aria-expanded="true" aria-controls="collapse-modification">
			<span class="mr-20">Расшифровка модификации</span><span class="collapse-caret icon-chevron-bold"></span>
		</a>
		<div class="collapse show" id="collapse-modification">
			<div class="pt-30 pt-lg-60">
	
				<div class="modification d-none d-lg-block">
					<div class="modification__title">
						<span><?=$arResult["SECTION"]["NAME"]?><?echo (!empty($arResult["S_PROPERTIES"]["PRIMER_MOSHCHNOST_ZAGOLOVOK"]["VALUE"]) ? "-".$arResult["S_PROPERTIES"]["PRIMER_MOSHCHNOST_ZAGOLOVOK"]["~VALUE"] : "");?></span>
						<?
						$cifri = $arResult["S_PROPERTIES"]["PRIMER_MOSHCHNOST_ZAGOLOVOK"]["~VALUE"] . $arResult["S_PROPERTIES"]["PRIMER_VTORAYA_TSIFRA_ZAGOLOVOK"]["~VALUE"] . $arResult["S_PROPERTIES"]["PRIMER_TRETYA_TSIFRA_ZAGOLOVOK"]["~VALUE"];
						if(!empty($cifri)) {
							?>
								-<span class="modification__key modification__key_1 active js-mod-key" id="js-mod-key-1" data-target="js-mod-val-1">
									<?=$arResult["S_PROPERTIES"]["PRIMER_PERVAYA_TSIFRA_ZAGOLOVOK"]["~VALUE"]?>
									<div class="modification__line"></div>
								</span>
								<span class="modification__key modification__key_2 js-mod-key" id="js-mod-key-2" data-target="js-mod-val-2">
									<?=$arResult["S_PROPERTIES"]["PRIMER_VTORAYA_TSIFRA_ZAGOLOVOK"]["~VALUE"]?>
									<div class="modification__line"></div>
								</span>
								<span class="modification__key modification__key_3 js-mod-key" id="js-mod-key-3" data-target="js-mod-val-3">
									<?=$arResult["S_PROPERTIES"]["PRIMER_TRETYA_TSIFRA_ZAGOLOVOK"]["~VALUE"]?>
									<div class="modification__line"></div>
								</span>
							<?
						}
						?>
						<span class="modification__key modification__key_4 js-mod-key" id="js-mod-key-4" data-target="js-mod-val-4">
							&nbsp; <?=$arResult["S_PROPERTIES"]["PRIMER_KOMMERCHESKIE_OBOZNACHENIYA_ZAGOLOVOK"]["~VALUE"]?>
							<div class="modification__line"></div>
						</span>
						&nbsp; <?=$arResult["S_PROPERTIES"]["PRIMER_KOD_ZAKAZA_ZAGOLOVOK"]["~VALUE"]?>
					</div>

					<div class="row">
						<div class="col-md-4 col-lg-3">
							<div class="modification__val modification__val_1 active js-mod-val" id="js-mod-val-1" data-target="js-mod-key-1">
								<?=$arResult["S_PROPERTIES"]["PERVAYA_TSIFRA"]["~VALUE"]?>
								<div class="modification__line"></div>
							</div>
						</div>
						<div class="col-md-4 col-lg-3">
							<div class="modification__val modification__val_2 js-mod-val" id="js-mod-val-2" data-target="js-mod-key-2">
								<?=$arResult["S_PROPERTIES"]["VTORAYA_TSIFRA"]["~VALUE"]?>
								<div class="modification__line"></div>
							</div>
						</div>
						<div class="col-md-4 col-lg-3">
							<div class="modification__val modification__val_3 js-mod-val" id="js-mod-val-3" data-target="js-mod-key-3">
								<?=$arResult["S_PROPERTIES"]["TRETYA_TSIFRA"]["~VALUE"]?>
								<div class="modification__line"></div>
							</div>
						</div>
						<div class="col-md-12 col-lg-3 pt-30 pt-lg-0">
							<div class="modification__val modification__val_4 js-mod-val" id="js-mod-val-4" data-target="js-mod-key-4">
								<?=$arResult["S_PROPERTIES"]["KOMMERCHESKIE_OBOZNACHENIYA"]["~VALUE"]?>
								<div class="modification__line"></div>
							</div>
						</div>
					</div>
				</div>

				<div class="modification-mobile d-lg-none" id="mod-accordion">
					<div class="text-grey fz-14 mb-10">
						Нажмите выделенную часть в наименовании модификации, для того чтобы узнать что она означает
					</div>

					<div class="d-flex align-items-center ff-dinpro fz-18 mb-15">
						<?=$arResult["SECTION"]["NAME"]?><?echo (!empty($arResult["S_PROPERTIES"]["PRIMER_MOSHCHNOST_ZAGOLOVOK"]["VALUE"]) ? "-".$arResult["S_PROPERTIES"]["PRIMER_MOSHCHNOST_ZAGOLOVOK"]["~VALUE"] : "");?>
						<?if(!empty($cifri)) {
							?>
							-<a href="#mod-1" class="modification-mobile__hilight" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="mod-1" id="heading-mod-1">
								<?=$arResult["S_PROPERTIES"]["PRIMER_PERVAYA_TSIFRA_ZAGOLOVOK"]["~VALUE"]?>
							</a>
							<a href="#mod-2" class="modification-mobile__hilight" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="mod-2" id="heading-mod-2">
								<?=$arResult["S_PROPERTIES"]["PRIMER_VTORAYA_TSIFRA_ZAGOLOVOK"]["~VALUE"]?>
							</a>
							<a href="#mod-3" class="modification-mobile__hilight" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="mod-3" id="heading-mod-3">
								<?=$arResult["S_PROPERTIES"]["PRIMER_TRETYA_TSIFRA_ZAGOLOVOK"]["~VALUE"]?>
							</a>
							&nbsp;
							<a href="#mod-4" class="modification-mobile__hilight" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="mod-4" id="heading-mod-4">
								<?=$arResult["S_PROPERTIES"]["PRIMER_KOMMERCHESKIE_OBOZNACHENIYA_ZAGOLOVOK"]["~VALUE"]?>
							</a>
							<span class="d-none d-sm-block">
								<?=$arResult["S_PROPERTIES"]["PRIMER_KOD_ZAKAZA_ZAGOLOVOK"]["~VALUE"]?>
							</span>
							<?
						}?>
					</div>

					<div>
						<div class="collapse" id="mod-1" data-parent="#mod-accordion" aria-labelledby="heading-mod-1">
							<div class="bg-grey-light py-10 px-20 ">
								<?=$arResult["S_PROPERTIES"]["PERVAYA_TSIFRA"]["~VALUE"]?>
							</div>
						</div>
						<div class="collapse" id="mod-2" data-parent="#mod-accordion" aria-labelledby="heading-mod-2">
							<div class="bg-grey-light py-10 px-20 ">
								<?=$arResult["S_PROPERTIES"]["VTORAYA_TSIFRA"]["~VALUE"]?>
							</div>
						</div>
						<div class="collapse" id="mod-3" data-parent="#mod-accordion" aria-labelledby="heading-mod-3">
							<div class="bg-grey-light py-10 px-20 ">
								<?=$arResult["S_PROPERTIES"]["TRETYA_TSIFRA"]["~VALUE"]?>
							</div>
						</div>
						<div class="collapse" id="mod-4" data-parent="#mod-accordion" aria-labelledby="heading-mod-4">
							<div class="bg-grey-light py-10 px-20 ">
								<?=$arResult["S_PROPERTIES"]["KOMMERCHESKIE_OBOZNACHENIYA"]["~VALUE"]?>
							</div>
						</div>
					</div>
				</div>
	
			</div>
		</div>
	</div>
</div>
<!-- Расширфрока модификации - end -->

<div class="py-25 py-lg-60"></div>