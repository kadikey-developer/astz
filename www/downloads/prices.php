<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Прайс-Листы");
$APPLICATION->AddChainItem($APPLICATION->GetTitle());
?>
<div class="container typography">
	<div class="page-wrapper">
		<div class="container">
			<!-- BREADCRUMBS START -->
			<div class="container">
				<div class="production-header">
					<img src="/img/price.png" alt=""><img alt="price.png" src="/upload/medialibrary/ca2/x7bgt3au4crpia64vuwi5f117y466gu8.png" title="price.png">
					<div class="title">
						<h2>Прайс-листы</h2>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="block">
					<div class="inner">
						<p>
							В данном разделе представлены цены на продукты Ardatov™ на определенную дату. Цены указаны в российских рублях с НДС. Базис цены EXW Ардатов. В регионах цены у дилеров могут отличаться.
						</p>
						<p>
							Светодиодные светильники имеют пометку LED. В производстве LED светильников используются качественные светодиоды лучших мировых производителей. В описании светодиодных светильников приведены нормируемые параметры: мощность, Вт, световой поток в лм, световая отдача в лм/Вт, индекс цветопередачи Ra, коррелированная цветовая температура CCT. Световой поток LED приведен в лм при T<sub>j</sub>=25°C. Указано рабочее напряжение, возможность работы в сети переменного (АС) и постоянного (DC) тока и коэффициент мощности RF. Приведены габаритные размеры, IP, материал корпуса и рассеивателя, особенности светового прибора.
						</p>
						<p>
							В разделе приведены также цены на ЗИП (запасные части) к люминесцентным светильникам и светильникам с газоразрядными лампами высокого давления (ГЛВД).
						</p>
						<ul>
							В прайс-листе определены сроки изготовления светильников:<br>
							<li>группа А: 0-7 рабочих дней;</li>
							<li>группа В: 7-14 рабочих дней;</li>
							<li>группа С: по согласованию;</li>
							<li>группа D: изготавливается по специальному заказу, срок изготовления по согласованию.</li>
						</ul>
						<p>
							Предыдущие прайс-листы выведены в архив.
						</p>
						<p>
						</p>
						<p>
							Прайс-лист на бюджетные светильники можно найти на сайте <noindex><a rel="nofollow" class="more hide" href="http://zsp-lighting.ru/"><span class="dotted-link">ООО "Завод Световых Приборов"</span></a></noindex>
						</p>
					</div>
				</div>
			</div>
			<? $section = array_shift($sections); ?>
			<div class="clearfix">
				<div class="main-content size-3of4">
					<? foreach ($section['ELEMENTS'] as $element) { ?> <? $file = CFile::GetPath($element['PROPERTY_FILE_VALUE']); ?> <? $extension = explode('.', $file); ?> <? $extension = array_pop($extension); ?> <? $size = CFile::GetByID($element['PROPERTY_FILE_VALUE']); ?> <? $size = ceil($size->arResult[0]['FILE_SIZE'] / 1024) / 1000; ?>
						<div class="container">
							<div class="information block">
								<div class="title inner">
									<h3><?= $element['NAME'] ?> <span class="price-list-date">(<?= $element['PROPERTY_SUBHEADING_VALUE'] ?>)</span></h3>
								</div>
								<div class="clearfix">
									<?= $element['PREVIEW_TEXT'] ?>
								</div>
							</div>
						</div>
					<? } ?>
					<!--<div class="container">
					<div class="archive block clearfix">
						<div class="size-3of4">
							<div class="title container">
								 Архив
							</div>
						</div>
						<div class="size-1of4">
							<div class="container">
								<div class="selectbox">
									<div>
										 Выберите год
									</div>
									<ul>
										<? foreach ($sections as $section) { ?>
											<li onclick="showYear(<?= $section['ID'] ?>)"><?= $section['NAME'] ?></li>
										<? } ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>--> <? foreach ($sections as $section) { ?>
						<div class="clearfix container-year" id="year-<span id=" title="Код PHP: &lt;?=$section['ID']?&gt;">
							<?= $section['ID'] ?><span class="bxhtmled-surrogate-inner"><span class="bxhtmled-right-side-item-icon"></span><span class="bxhtmled-comp-lable" unselectable="on" spellcheck="false">Код PHP</span></span>" style="display: none;"&gt; <? foreach ($section['ELEMENTS'] as $element) { ?> <? $file = CFile::GetPath($element['PROPERTY_FILE_VALUE']); ?> <? $extension = explode('.', $file); ?> <? $extension = array_pop($extension); ?> <? $size = CFile::GetByID($element['PROPERTY_FILE_VALUE']); ?> <? $size = ceil($size->arResult[0]['FILE_SIZE'] / 1024) / 1000; ?>
								<div class="container">
									<div class="information block">
										<div class="title inner">
											<h3><?= $element['NAME'] ?> <span class="price-list-date">(<?= $element['PROPERTY_SUBHEADING_VALUE'] ?>)</span></h3>
										</div>
										<div class="clearfix">
											<?= $element['PREVIEW_TEXT'] ?>
										</div>
									</div>
								</div>
							<? } ?>
						</div>
					<? } ?>
				</div>
				<div class="information block">
					<div class="title inner">
						<h3>Прайс лист от 01.06.2022 <span class="price-list-date">(светильники)</span></h3>
					</div>
					<div class="clearfix">
						<div class="size-1of2">
							<div class="inner">
								<p class="downloadable">
									<a onclick="ga('send', 'event', 'downloadPrice', 'clicked');yaCounter30724348.reachGoal('downloadPrice');" class="more" href="http://astz.ru/upload/files/price/ASTZ_01062022.xlsx"> <img src="/upload/medialibrary/ee0/6n1p5f532oqkwnsnkqotd5gz6cb16f2g.png" alt=""> <span class="download-icon-small"></span>&nbsp;<span class="dotted-link">Скачать</span> <span class="size">(xlsx, 0.385MB)</span> </a>
								</p>
							</div>
						</div>
						<br>
					</div>
				</div>
				<hr>
				<div class="information block">
					<div class="title inner">
						<h3>Прайс лист от 13.04.2022 <span class="price-list-date">(светильники)</span></h3>
					</div>
					<div class="clearfix">
						<div class="size-1of2">
							<div class="inner">
								<p class="downloadable">
									<a onclick="ga('send', 'event', 'downloadPrice', 'clicked');yaCounter30724348.reachGoal('downloadPrice');" class="more" href="http://astz.ru/upload/files/price/ASTZ_13042022.xlsx"> <img src="/upload/medialibrary/ee0/6n1p5f532oqkwnsnkqotd5gz6cb16f2g.png" alt=""> <span class="download-icon-small"></span>&nbsp;<span class="dotted-link">Скачать</span> <span class="size">(xlsx, 0.371MB)</span> </a>
								</p>
							</div>
						</div>
						<br>
					</div>
				</div>
				<hr>
				<div class="information block">
					<div class="title inner">
						<h3>Прайс лист от 11.03.2022 <span class="price-list-date">(светильники)</span></h3>
					</div>
					<div class="clearfix">
						<div class="size-1of2">
							<div class="inner">
								<p class="downloadable">
									<a onclick="ga('send', 'event', 'downloadPrice', 'clicked');yaCounter30724348.reachGoal('downloadPrice');" class="more" href="http://astz.ru/upload/files/price/ASTZ_11032022.xlsx"> <img src="/upload/medialibrary/ee0/6n1p5f532oqkwnsnkqotd5gz6cb16f2g.png" alt=""> <span class="download-icon-small"></span>&nbsp;<span class="dotted-link">Скачать</span> <span class="size">(xlsx, 0.358MB)</span> </a>
								</p>
							</div>
						</div>
						<br>
					</div>
				</div>
				<hr>
				<div class="information block">
					<div class="title inner">
						<h3>Прайс-лист ЗИП АСТЗ от 09.03.2022 г. <span class="price-list-date">(ГЛВД, рассеиватели)</span></h3>
					</div>
					<div class="clearfix">
						<div class="size-1of2">
							<div class="inner">
								<p class="downloadable">
									<a onclick="ga('send', 'event', 'downloadPrice', 'clicked');yaCounter30724348.reachGoal('downloadPrice');" class="more" href="http://astz.ru/upload/files/price/ASTZ_ZIP_09032022.xlsx"> <img src="/upload/medialibrary/ee0/6n1p5f532oqkwnsnkqotd5gz6cb16f2g.png" alt=""> <span class="download-icon-small"></span>&nbsp;<span class="dotted-link">Скачать</span> <span class="size">(xlsx, 0.104 Мб)</span> </a>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<br>
			<div id="dc_vk_code" style="display:none">
			</div>
			<br>
		</div>
	</div>
	<br>
</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>