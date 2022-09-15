<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var array $arParams
 * @var array $templateData
 * @var string $templateFolder
 * @var CatalogSectionComponent $component
 */

global $APPLICATION;

/**
 * Принудительно устанавливаем заголовок страницы.
 * -- он перезаписывается, если в компоненте устанавливается другой, так что всё нормально.
 */
if ($arParamsp["SET_TITLE"] === "Y") {
    $APPLICATION->SetPageProperty("title", $arResult["SECTION"]["IPROPERTY_VALUES"]["SECTION_META_TITLE"]);
}
?>