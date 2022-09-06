<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?

use Bitrix\Main\Page\Asset; ?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<? echo LANG_CHARSET; ?>">
    <? $APPLICATION->ShowHead() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><? $APPLICATION->ShowTitle() ?></title>
    <? $APPLICATION->ShowMeta("keywords"); ?>
    <? $APPLICATION->ShowMeta("description"); ?>
    <? // Подключение необходимых библиотек стилей
    // Asset::getInstance()->addCss("/html/lib/bootstrap-4.6.1/dist/css/bootstrap.min.css");
    Asset::getInstance()->addCss("/html/lib/icomoon-v1.0/style.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/swiper-bundle.min.css");
    Asset::getInstance()->addCss("/html/lib/range-slider/css/rSlider.min.css");
    ?>
    <? // Подключение необходимых скриптов
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/lazysizes.min.js");
    CJSCore::Init(array("jquery3")); // Подключить свайпер к общему, но сделать пометку, что можно разбить по компонентам
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/bootstrap.bundle.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/swiper-bundle.min.js");
    // Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/rSlider.min.js");
    //Asset::getInstance()->addJs("/html/lib/range-slider/js/rSlider.min.js"); // сделал только чтобы вывести его в консоль разработчика. Верхний вариант рабочий. Этот потом удалить.
    Asset::getInstance()->addJs("/html/lib/select/select.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/script.js");
    ?>
</head>

<body>
    <? include_once(__DIR__ . '/page_blocks/header.php'); ?>
    <main class="main <?if ( $APPLICATION->GetCurPage(false) === "/" ) echo "main-page";?>">
        <?/* $APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "astz",
            array(),
            false
        ); */?>