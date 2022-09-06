<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/*global $USER;*/
if ( $APPLICATION->GetFileAccessPermission("/downloads/list.php") >= "D" ) {
    $arResult["USER_HAVE_ACCESS"] = 1;
}