<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

/**
 * Объединить с шаблоном bootstrap_v4
 * Получаем ID родителей элементов и передаем их в виде массива.
 */
global $arFilterSections; // проверить что будет если убрать global
if ( !empty($arFilterSections) ) {
    $arElementIDs = array();
    foreach ($arResult['ITEMS'] as $item) {
        $arElementIDs[] = $item['ID'];
    }
    $arElements = CIBlockElement::GetList(
        array(),
        array(
            'BLOCK_TYPE' => $arParams['BLOCK_TYPE'],
            'IBLOCK_ID' => $arParams['IBLOCK_ID'],
            'ID' => $arElementIDs,
            'ACIVE' => 'Y',
        ),
        false,
        false,
        array('IBLOCK_SECTION_ID')
    );
    while ($element = $arElements->GetNext()) {
        if ( !in_array($element['IBLOCK_SECTION_ID'], $arFilterSections['ID']) )  {
            $arFilterSections['ID'][] = $element['IBLOCK_SECTION_ID'];
        } 
    }
}
