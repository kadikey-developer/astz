<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

use \Bitrix\Main\Loader;
use \Bitrix\Highloadblock as HL;

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

/**
 * Добавляем списки типа справочник в $arResult. Сделано пока на один справочник, потом можно будет переделать на динамично все.
 */
$propertyCode = 'B_PIKTOGRAMY';
$arHighloadProperty = $arResult["PROPERTIES"][$propertyCode];
$sTableName = $arHighloadProperty['USER_TYPE_SETTINGS']['TABLE_NAME'];

/**
 * Работаем только при условии, что
 *    - модуль highloadblock подключен
 *    - в описании присутствует таблица
 *    - есть заполненные значения 
 */
if (Loader::IncludeModule('highloadblock') && !empty($sTableName) && !empty($arHighloadProperty["VALUE"]))
{
    $hlblock = HL\HighloadBlockTable::getRow([
        'filter' => [
            '=TABLE_NAME' => $sTableName
        ],
    ]);
    if ($hlblock) {
        /**
         * Магия highload-блоков компилируем сущность, чтобы мы смогли с ней работать
         * 
         */
        $entity      = HL\HighloadBlockTable::compileEntity($hlblock);
        $entityClass = $entity->getDataClass();

        $arRecords = $entityClass::getList([
            'filter' => [
                'UF_XML_ID' => $arHighloadProperty["VALUE"],
            ],
            'order' => [
                'UF_SORT' => 'ASC'
            ]
        ]);
        foreach ($arRecords as $record)
        {	
            /**
             * Тут любые преобразования с записью, полученной из таблицы.
             * Я транслировал почти все напрямую. 
             * 
             * Нужно помнить, что например в UF_FILE возвращается ID файла,
             * а не полный массив описывающий файл
             */
            $arRecord = [
                'ID'                  => $record['ID'],
                'UF_NAME'             => $record['UF_NAME'],
                'UF_SORT'             => $record['UF_SORT'],
                'UF_XML_ID'           => $record['UF_XML_ID'],
                'UF_LINK'             => $record['UF_LINK'],
                'UF_DESCRIPTION'      => $record['UF_DESCRIPTION'],
                'UF_FULL_DESCRIPTION' => $record['UF_FULL_DESCRIPTION'],
                'UF_DEF'              => $record['UF_DEF'],
                'UF_FILE'             => [],
                '~UF_FILE'            => $record['UF_FILE'],
            ];
            /**
             * Не очень быстрое решение - сколько записей в инфоблоке, столько файлов и получим
             * Хорошо было бы вынести под код и там за 1 запрос все получить, а не плодить
             * по дополнительному запросу на каждый файл
             */
            if ( !empty($arRecord['~UF_FILE']) )
            {
                $arRecord['UF_FILE'] = \CFile::getById($arRecord['~UF_FILE'])->fetch();
            }

            $arHighloadProperty['EXTRA_VALUE'][] = $arRecord;
        }
    }
}
$arResult["DISPLAY_PROPERTIES"][$propertyCode]["DISPLAY_VALUE"] = $arHighloadProperty['EXTRA_VALUE'];
/*?><pre><? print_r($arResult["DISPLAY_PROPERTIES"][$propertyCode]); ?></pre><?
?><pre><?// print_r( $arResult["DISPLAY_PROPERTIES"][$propertyCode]["DISPLAY_VALUE"]); ?></pre><?
    ?><pre><?// print_r( $arHighloadProperty['EXTRA_VALUE']); ?></pre><?
foreach ($arHighloadProperty['EXTRA_VALUE'] as $arProp) { // если XML_ID будут уникальны, то можно убрать этот цикл
    ?><pre><?// print_r( $arProp); ?></pre><?
    //if ( in_array($arResult["DISPLAY_PROPERTIES"][$propertyCode]["DISPLAY_VALUE"], $arProp) ) {
    if ( in_array(array('085', '093'), $arProp) ) {
        echo 'есть';
        $arResult["DISPLAY_PROPERTIES"][$propertyCode]["PICTURES"] = $arProp;
    }
}*/

/**
 * Получаем список привязанных файлов
 */
$arFilter = array(
    "IBLOCK_TYPE" => "Files",
    "PROPERTY_B_IDDLYAFAYLA" => $arResult["XML_ID"]
);
$obFiles = CIBlockElement::GetList(
    array(),
    $arFilter,
);

while ( $arFile = $obFiles->GetNextElement() ) {
    $fileElement = $arFile->getProperties();
    foreach ($fileElement["FILES"]["VALUE"] as $file) {
        $fileArray = CFile::GetFileArray($file);
        $iblockName = GetIBlock($fileElement["FILES"]["IBLOCK_ID"]);
        $fileArray["FILE_TYPE"] = $iblockName["CODE"]; // попробовать через GetIBlockElement() может быстрее работать будет
        $arResult["FILES"][] = $fileArray;
    }
}