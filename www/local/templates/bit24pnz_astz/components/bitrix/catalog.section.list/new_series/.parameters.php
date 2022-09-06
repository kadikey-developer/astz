<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arViewModeList = array(
	'LIST' => GetMessage('CPT_BCSL_VIEW_MODE_LIST'),
	'LINE' => GetMessage('CPT_BCSL_VIEW_MODE_LINE'),
	'TEXT' => GetMessage('CPT_BCSL_VIEW_MODE_TEXT'),
	'TILE' => GetMessage('CPT_BCSL_VIEW_MODE_TILE')
);

$arTemplateParameters = array(
	'VIEW_MODE' => array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage('CPT_BCSL_VIEW_MODE'),
		'TYPE' => 'LIST',
		'VALUES' => $arViewModeList,
		'MULTIPLE' => 'N',
		'DEFAULT' => 'LINE',
		'REFRESH' => 'Y'
	),
	'SHOW_PARENT_NAME' => array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage('CPT_BCSL_SHOW_PARENT_NAME'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y'
	),
	'FIND_BY_UF_NAME' => array(
		'PARENT' => 'ADDITIONAL_SETTINGS',
		'NAME' => GetMessage('FIND_BY_UF_NAME'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'N'
	),
	'SHOW_UF_SECTION_DESCR' => array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage('CPT_BCSL_SHOW_UF_SECTION_DESCR'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'N'
	),
);

if (isset($arCurrentValues['VIEW_MODE']) && 'TILE' == $arCurrentValues['VIEW_MODE'])
{
	$arTemplateParameters['HIDE_SECTION_NAME'] = array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage('CPT_BCSL_HIDE_SECTION_NAME'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'N'
	);
}

/**
 * Добавляем параметр для объединения и фильтра по пользовательскому полю
 */
if (isset($arCurrentValues['FIND_BY_UF_NAME']) && 'Y' == $arCurrentValues['FIND_BY_UF_NAME'])
{
	$arTemplateParameters['UF_NAME'] = array(
		'PARENT' => 'ADDITIONAL_SETTINGS',
		'NAME' => GetMessage('UF_NAME'),
		'TYPE' => 'STRING',
		'DEFAULT' => 'UF_NEW'
	);
}
?>