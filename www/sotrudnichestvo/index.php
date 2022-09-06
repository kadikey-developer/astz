<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?>
<div class="container">
	<?$APPLICATION->IncludeComponent(
		"bitrix:map.yandex.view",
		"astz_map",
		array(
			"API_KEY" => "",
			"COMPONENT_TEMPLATE" => "astz_map",
			"CONTROLS" => array(
			),
			"INIT_MAP_TYPE" => "MAP",
			"MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:54.846248999994934;s:10:\"yandex_lon\";d:46.339262;s:12:\"yandex_scale\";i:16;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:46.339262;s:3:\"LAT\";d:54.846249;s:4:\"TEXT\";s:0:\"\";}}}",
			"MAP_HEIGHT" => "400",
			"MAP_ID" => "",
			"MAP_WIDTH" => "100%",
			"OPTIONS" => array(
				0 => "ENABLE_SCROLL_ZOOM",
				1 => "ENABLE_DRAGGING",
			)
		),
		false
	);?>
</div>
<style>
	/*.ymaps-layers-pane {
		filter: hue-rotate(180deg);
		-ms-filter: hue-rotate(180deg);
		-webkit-filter: hue-rotate(180deg);
		-moz-filter: hue-rotate(180deg);
		-o-filter: hue-rotate(180deg);
	}*/
</style>
<div class="py-25 py-lg-75"></div>
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h2>Контакты</h2>
			<h5>Адрес:</h5>
			<p>431890, Республика Мордовия, Ардатовский район,р.п. Тургенево, ул. Заводская, 73</p>
			<div class="row">
				<div class="col-md-6">
					<h5>E-mail:</h5>
					<p><a href="mailto:mirsveta@astz.ru">mirsveta@astz.ru</a></p>
				</div>
				<div class="col-md-6">
					<h5>Сайт:</h5>
					<p><a href="astz.ru">www.astz.ru</a></p>
				</div>
				<div class="col-md-6">
					<h5>Единый справочный телефон:</h5>
					<p>8 800 550 9112</p>
				</div>
				<div class="col-md-6">
					<h5>Телефон приемной:</h5>
					<p>+7 (83431) 2-10-09 (2 10 10)</p>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<h2>Реквизиты</h2>
			<h5>Полное наименование предприятия:</h5>
			<p>Акционерное Общество “Ардатовский светотехнический завод” Сокращенное наименование АО “АСТЗ”, код 3710</p>
			<h5>Сокращенное наименование:</h5>
			<p>АО "АСТЗ", код 3710</p>
			<table class="table table-sm table-borderless">
				<tbody>
					<tr>
						<th scope="row">ИНН</th>
						<td>1301011495</td>
						<th scope="row">ОКАТО</th>
						<td>89203555000</td>
						<th scope="row">ОКФС</th>
						<td>16</td>
					</tr>
					<tr>
						<th scope="row">КПП</th>
						<td>130101001</td>
						<th scope="row">ОКТМО</th>
						<td>89603155051</td>
						<th scope="row">ОКОПФ</th>
						<td>12247</td>
					</tr>
					<tr>
						<th scope="row">ОКПО</th>
						<td>05014337</td>
						<th scope="row">ОКОГУ</th>
						<td>4210008</td>
						<th scope="row">ОКВЭД</th>
						<td>27.40</td>
					</tr>
				</tbody>
			</table>
			<h5>Банковские реквизиты: АО “АСТЗ”</h5>
			<p>
				р/сч 40702810400700001168 в ПАО "АК БАРС" БАНК г. Казань<br>
				к/сч. 30101810000000000805<br>
				БИК 049205805
			</p>
		</div>
	</div>
</div>
<div class="py-25 py-lg-75"></div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>