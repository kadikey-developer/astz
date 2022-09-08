<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Метод коэффициента использования");
$APPLICATION->AddChainItem($APPLICATION->GetTitle());
?>
<div class="container typography text-grey fz-lg-18 fz-xl-20 px-xl-40">
	<h3>Метод коэффициента использования</h3>
	<img src="https://www.astz.ru/upload/iblock/728/K1.jpg" class="float-left mr-10">Применяется для расчета общего равномерного освещения горизонтальных поверхностей при светильниках любого типа. Суть метода заключается в вычислении коэффициента для каждого помещения, исходя из основных параметров помещения и светоотражающих свойств отделочных материалов. Таким методом производится расчет внутреннего освещения.<br>
	<p>
		Примечание: скачать коэффициенты использования (в виде таблиц в программе Microsoft Excel) и изображения кривых сил света можно по ссылкам ниже.<a href="https://www.astz.ru/upload/files/lightcalc/bd_astz_KI.zip"><img src="https://www.astz.ru/img/xls-icon.png">&nbsp;&nbsp;скачать&nbsp;(11.9 Мб, 04.03.2021)</a><br>
		Метод коэффициента использования являлся базовым методом ручного расчета освещения и широко применялся в проектной практике, позволяя быстро оценить предлагаемое решение.<br>
		Основными допущениями метода являются:
	</p>
	<ul>
		<li>однородность (т.е. равномерное распределение) светимости отражающих поверхностей (как вторичных излучателей), окружающих освещаемое помещение;</li>
		<li>диффузность (т.е. ламбертовский характер) светимости этих поверхностей;</li>
		<li>усреднение коэффициентов отражения по отражающим поверхностям.</li>
	</ul>
	<p>
		<img width="482" alt="k e.png" src="https://www.astz.ru/upload/medialibrary/704/k%20e.png" height="164" title="k e.png">
	</p>
	<h4>Исходные данные для расчета</h4>
	<p>
		Помещение: a - длина; b - ширина; h - высота; коэффициенты отражения потолка, стен и пола.<br>
		Светильники: коэффициент использования светильника; расчетная высота подвеса (расстояние между светильником и рабочей поверхностью).<br>
		Лампы: тип лампы; мощность.<br>
		Нормы: требуемая освещенность.
	</p>
	<h4>Материалы</h4>
	<ul>
		<li>таблица коэффициентов использования;</li>
		<li>таблица коэффициентов отражения;</li>
		<li>таблица рекомендуемых уровней освещенности;</li>
		<li>таблица номинального светового потока ламп.</li>
	</ul>
	<h4>Расчетные формулы</h4>
	<p>
		Определение площади помещения: S = a × b<br>
		Определение индекса помещения: i = S / (hp × (a + b))<br>
		hp - расчетная высота: hp = (h - (h1 + h2))<br>
		h - высота помещения;<br>
		h1 - высота подвеса светильника;<br>
		h2 - расстояние от пола до рабочей поверхности.<br>
		<br>
		Определение требуемого количества светильников:<br>
		N = (E × S × k × z × 100)/(n × Фламп × η)<br>
		<br>
		Е - освещенность, лк;<br>
		k - коэффициент запаса (k = 1,3 - 2,0);<br>
		z - коэффициент неравномерности освещения (z = Eср/Емин = 1,05 - 1,15);<br>
		n - число ламп в одном светильнике;<br>
		Фламп - световой поток лампы, лм;<br>
		η - коэффициент использования светильника.
	</p>
	<h4>Пример расчета</h4>
	<p>
		Помещение: бежевые стены; синий ковролин; a = 10 м; b = 6 м; h = 3 м; h 2 = 0.8 м.<br>
		Коэффициенты отражения потолка - 70, стен - 50, пола - 20.<br>
		Светильник: ЛПО46-2х36-604 Luxe - КПД - 80%; расчетная высота подвеса - 70 мм.<br>
		Лампы: люминесцентные лампы Т8 36 Вт Фламп = 2500 лм (в одном светильнике 2 лампы).<br>
		Нормы: освещенность для офиса на рабочей плоскости 400 лк.<br>
		<br>
		Площадь помещения: S = 10 × 6 = 60 м&nbsp;2<br>
		Расчетная высота: hp = 3 - (0,07 + 0,8) = 2,13 м<br>
		Индекс помещения: i = 60/(2,13 × (10 + 6) = 1,76 (2)<br>
		Определяем коэффициент использования, исходя из значений коэффициентов отражения и индекса помещения, для светильника ЛПО46-2х36-604 Luxe&nbsp;η = 46.<br>
		<br>
		Количество светильников: N = (400 × 60 × 1,4 × 1,1 × 100) / (46 × 2 × 2500) = 16.
	</p>
	<h4>Для данного помещения требуется 16 светильников, равномерно распределенных по поверхности потолка.</h4>
</div>
<br>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>