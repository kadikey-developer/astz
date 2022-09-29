</main>
<footer class="footer bg-blue-dark text-white pt-55 pb-30">
	<div class="container">
		<div class="mb-35">
			<div class="row">
				<div class="col-lg-3 col-xl-2 offset-xl-1">
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
				<div class="col-lg-3 col-xl-2 offset-xl-1">
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
				<div class="col-lg-3 col-xl-2 offset-xl-1">
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
				<div class="col-lg-3 col-xl-2 offset-xl-1">
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
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3 col-xl-2 order-lg-1">
				<div class="footer-social d-flex align-items-center mb-15 mb-md-0 pt-lg-10 ml-lg-n10">
					<? $APPLICATION->IncludeFile(
						SITE_DIR . "include/footer-social-icons.php",
						array(),
						array("MODE" => "html")
					); ?>
				</div>
			</div>
			<div class="col-lg-9 col-xl-9 offset-xl-1">
				<div class="fz-14">
					<? $APPLICATION->IncludeFile(
						SITE_DIR . "include/copyright.php",
						array(),
						array("MODE" => "html")
					); ?>
				</div>
			</div>
		</div>
	</div>
</footer>
<!-- {literal} -->
<script type='text/javascript'>
    window['l'+'i'+'v'+'eT'+'e'+'x'] = true,
    window['liv'+'e'+'T'+'exI'+'D'] = 13255,
    window['liv'+'e'+'T'+'ex'+'_o'+'bject'] = true;
    (function() {
        var t = document['c'+'reat'+'eEle'+'me'+'n'+'t']('script');
        t.type ='text/javascript';
        t.async = true;
        t.src = '//cs15.l'+'ive'+'tex.ru/'+'js/clie'+'n'+'t.js';
        var c = document['get'+'Ele'+'ment'+'sBy'+'TagName']('script')[0];
        if ( c ) c['par'+'ent'+'No'+'de']['ins'+'ertBef'+'ore'](t, c);
        else document['docu'+'m'+'entE'+'lem'+'en'+'t']['firs'+'tC'+'h'+'il'+'d']['ap'+'p'+'e'+'nd'+'Chi'+'ld'](t);
    })();
</script>
<!-- {/literal} -->
</body>

</html>