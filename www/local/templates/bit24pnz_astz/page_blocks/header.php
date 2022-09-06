<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<header id="header" class="header">
    <div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
    <div class="container">
        <div class="header__inner">

            <div class="header__drop-action-mobile">
                <div class="header-stretch">
                    <a class="menu-icon" data-toggle="collapse" href="#collapse-drop-menu" role="button" aria-expanded="false" aria-controls="collapse-drop-menu" aria-label="Открыть форму поиска">
                        <span class="menu-icon__line"></span>
                        <span class="menu-icon__line"></span>
                        <span class="menu-icon__line"></span>
                        <span class="menu-icon__line"></span>
                    </a>
                </div>
            </div>


            <div class="header__logo">
                <a href="/" class="d-inline-block py-2" aria-label="АО Ардатовский светотехнический завод">
                    <? $APPLICATION->IncludeFile(
                        SITE_DIR . "include/logo.php",
                        array(),
                        array("MODE" => "html")
                    ); ?>
                </a>
            </div>

            <div class="header__menu">
                <nav class="header-menu header-stretch" aria-label="Главное меню">
                    <ul class="header-menu__list">
                        <? $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"main_menu", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"DELAY" => "N",
		"MAX_LEVEL" => "2",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "36000000",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "top",
		"USE_EXT" => "Y",
		"COMPONENT_TEMPLATE" => "main_menu"
	),
	false
); ?>
                    </ul>
                </nav>
            </div>

            <div class="header__search">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:search.form",
                    "header_search",
                    array(
                        "PAGE" => "#SITE_DIR#search/",    // Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
                    ),
                    false
                ); ?>
            </div>

            <div class="header__phone">
                <div class="header-stretch">
                    <span class="d-lg-none mr-10"></span>
                    <? $APPLICATION->IncludeFile(
                        SITE_DIR . "include/header_tel.php",
                        array(),
                        array("MODE" => "html")
                    ); ?>
                </div>
            </div>

            <div class="header__drop-action">
                <div class="header-stretch">
                    <a class="header-collapse-action" data-toggle="collapse" href="#collapse-drop-menu" role="button" aria-expanded="false" aria-controls="collapse-drop-menu" aria-label="Дополнительное меню">
                        <span class="icon-menu d-none d-lg-inline-block fz-25 lh-1 align-middle"></span>
                    </a>
                </div>
            </div>

            <div class="header__search-action-mobile">
                <div class="header-stretch">
                    <a class="header-collapse-action" data-toggle="collapse" href="#collapse-search" role="button" aria-expanded="false" aria-controls="collapse-search" aria-label="Открыть форму поиска">
                        <span class="icon-search fz-20 lh-1 align-middle"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="bg-grey-dark p-20">
        <?/*$APPLICATION->IncludeComponent(
            "bitrix:menu",
            "tabs_menu",
            array(
                "ALLOW_MULTI_SELECT" => "N",
                "CHILD_MENU_TYPE" => "left",
                "COMPONENT_TEMPLATE" => "store_v3_main",
                "DELAY" => "N",
                "MAX_LEVEL" => "1",
                "MENU_CACHE_GET_VARS" => array(),
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "ROOT_MENU_TYPE" => "left",
                "USE_EXT" => "N"
            )
        );*/?>
    </div> -->

    <div id="accordionSubmenu" class="header__drop">

        <div class="collapse hide" id="collapse-search">
            <div class="container">
                <div id="js-migrate-search-mobile">

                </div>
            </div>
        </div>

        <? $APPLICATION->IncludeComponent(
            "bitrix:menu",
            "main_submenu",
            array(
                "ALLOW_MULTI_SELECT" => "N",
                "CHILD_MENU_TYPE" => "left",
                "DELAY" => "N",
                "MAX_LEVEL" => "2",
                "MENU_CACHE_GET_VARS" => array(),
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "ROOT_MENU_TYPE" => "top",
                "USE_EXT" => "Y",
                "COMPONENT_TEMPLATE" => "main_submenu"
            ),
            false
        ); ?>

        <div class="collapse collapse-drop-menu" id="collapse-drop-menu" data-parent="#accordionSubmenu" aria-label="Меню пользователя">
            <div class="header-drop scrollbar">

                <a class="header-drop__close" data-toggle="collapse" href="#collapse-drop-menu" role="button" aria-expanded="false" aria-controls="collapse-drop-menu" aria-label="Закрыть дополнительное меню">
                    <span class="icon-close fz-30 lh-1 align-middle"></span>
                </a>

                <div class="header-drop__inner">

                    <div class="row mb-30">
                        <div class="col-md-3">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:menu",
                                "vertical_footer_menu",
                                array(
                                    "ALLOW_MULTI_SELECT" => "N",
                                    "CHILD_MENU_TYPE" => "left",
                                    "COMPONENT_TEMPLATE" => "vertical_footer_menu",
                                    "DELAY" => "N",
                                    "MAX_LEVEL" => "2",
                                    "MENU_CACHE_GET_VARS" => array(),
                                    "MENU_CACHE_TIME" => "3600",
                                    "MENU_CACHE_TYPE" => "N",
                                    "MENU_CACHE_USE_GROUPS" => "Y",
                                    "ROOT_MENU_TYPE" => "bottom",
                                    "USE_EXT" => "Y"
                                ),
                                false
                            ); ?>
                        </div>
                        <div class="col-md-3">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:menu",
                                "vertical_footer_menu",
                                array(
                                    "ALLOW_MULTI_SELECT" => "N",
                                    "CHILD_MENU_TYPE" => "left",
                                    "COMPONENT_TEMPLATE" => "vertical_footer_menu",
                                    "DELAY" => "N",
                                    "MAX_LEVEL" => "2",
                                    "MENU_CACHE_GET_VARS" => array(),
                                    "MENU_CACHE_TIME" => "3600",
                                    "MENU_CACHE_TYPE" => "N",
                                    "MENU_CACHE_USE_GROUPS" => "Y",
                                    "ROOT_MENU_TYPE" => "bottom2",
                                    "USE_EXT" => "Y"
                                ),
                                false
                            ); ?>
                        </div>
                        <div class="col-md-3">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:menu",
                                "vertical_footer_menu",
                                array(
                                    "ALLOW_MULTI_SELECT" => "N",
                                    "CHILD_MENU_TYPE" => "left",
                                    "COMPONENT_TEMPLATE" => "vertical_footer_menu",
                                    "DELAY" => "N",
                                    "MAX_LEVEL" => "2",
                                    "MENU_CACHE_GET_VARS" => array(),
                                    "MENU_CACHE_TIME" => "3600",
                                    "MENU_CACHE_TYPE" => "N",
                                    "MENU_CACHE_USE_GROUPS" => "Y",
                                    "ROOT_MENU_TYPE" => "bottom3",
                                    "USE_EXT" => "Y"
                                ),
                                false
                            ); ?>
                        </div>
                        <div class="col-md-3">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:menu",
                                "vertical_footer_menu",
                                array(
                                    "ALLOW_MULTI_SELECT" => "N",
                                    "CHILD_MENU_TYPE" => "left",
                                    "COMPONENT_TEMPLATE" => "vertical_footer_menu",
                                    "DELAY" => "N",
                                    "MAX_LEVEL" => "2",
                                    "MENU_CACHE_GET_VARS" => array(),
                                    "MENU_CACHE_TIME" => "3600",
                                    "MENU_CACHE_TYPE" => "N",
                                    "MENU_CACHE_USE_GROUPS" => "Y",
                                    "ROOT_MENU_TYPE" => "bottom4",
                                    "USE_EXT" => "Y"
                                ),
                                false
                            ); ?>
                        </div>
                        <div class="col-md-3">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:menu",
                                "vertical_footer_menu",
                                array(
                                    "ALLOW_MULTI_SELECT" => "N",
                                    "CHILD_MENU_TYPE" => "left",
                                    "COMPONENT_TEMPLATE" => "vertical_footer_menu",
                                    "DELAY" => "N",
                                    "MAX_LEVEL" => "2",
                                    "MENU_CACHE_GET_VARS" => array(),
                                    "MENU_CACHE_TIME" => "3600",
                                    "MENU_CACHE_TYPE" => "N",
                                    "MENU_CACHE_USE_GROUPS" => "Y",
                                    "ROOT_MENU_TYPE" => "bottom5",
                                    "USE_EXT" => "Y"
                                ),
                                false
                            ); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <?/*
                            <ul class="header-drop__menu">
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:menu",
                                    "header_drop_menu",
                                    array(
                                        "ALLOW_MULTI_SELECT" => "N",
                                        "CHILD_MENU_TYPE" => "left",
                                        "DELAY" => "N",
                                        "MAX_LEVEL" => "1",
                                        "MENU_CACHE_GET_VARS" => array(""),
                                        "MENU_CACHE_TIME" => "36000000",
                                        "MENU_CACHE_TYPE" => "A",
                                        "MENU_CACHE_USE_GROUPS" => "Y",
                                        "ROOT_MENU_TYPE" => "top",
                                        "USE_EXT" => "Y"
                                    )
                                );?>
                            </ul>
                            */?>
                            <div class="header-drop__company mb-30 mb-sm-0">
                                <div class="header-drop__company-title">
                                    <? $APPLICATION->IncludeFile(
                                        SITE_DIR . "include/company_name.php",
                                        array(),
                                        array("MODE" => "text")
                                    ); ?>
                                </div>
                                <div class="header-drop__company-address">
                                    <? $APPLICATION->IncludeFile(
                                        SITE_DIR . "include/address.php",
                                        array(),
                                        array("MODE" => "text")
                                    ); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">

                            <div class="mb-20 d-inline-block">
                                <a class="header-drop__button collapse-action" data-toggle="collapse" href="#collapse-lang" role="button" aria-expanded="false" aria-controls="collapse-lang">
                                    <div>
                                        <img class="mr-20" width="33" height="22" src="<?= SITE_TEMPLATE_PATH ?>/img/common/lang-ru.svg" alt="Русский язык"><strong class="mr-15">Русский</strong><span class="collapse-caret icon-chevron-bold"></span>
                                    </div>
                                </a>
                                <div class="collapse" id="collapse-lang">
                                    <a href="#" class="header-drop__button mt-5">
                                        <div>
                                            <img class="mr-20" width="33" height="22" src="<?= SITE_TEMPLATE_PATH ?>/img/common/lang-en.svg" alt="English language"><strong class="mr-20">English</strong>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="mb-35 mb-md-85">
                                <a href="#" class="">
                                    <div class="header-drop__button">
                                        <img class="mr-20" width="33" height="22" src="<?= SITE_TEMPLATE_PATH ?>/img/common/user.svg" alt="English language"><strong class="mr-20">Регистрация</strong>
                                    </div>
                                </a>
                            </div>

                            <div class="header-social d-flex align-items-center mb-25 mb-md-90">
                                <a class="header-social__item" href="#">
                                    <span class="icon-telegram"></span>
                                </a>
                                <a class="header-social__item" href="#">
                                    <span class="icon-vkontakte"></span>
                                </a>
                                <a class="header-social__item" href="#">
                                    <span class="icon-facebook"></span>
                                </a>
                                <a class="header-social__item" href="#">
                                    <span class="icon-instagram"></span>
                                </a>
                            </div>

                            <div class="mb-5">
                                <? $APPLICATION->IncludeFile(
                                    SITE_DIR . "include/header_email.php",
                                    array(),
                                    array("MODE" => "html")
                                ); ?>
                            </div>
                            <div>
                                <? $APPLICATION->IncludeFile(
                                    SITE_DIR . "include/header_collapse_tel.php",
                                    array(),
                                    array("MODE" => "html")
                                ); ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="text-grey-dark">
        <? $APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "astz",
            array(),
            false
        ); ?>
    </div>
</header>