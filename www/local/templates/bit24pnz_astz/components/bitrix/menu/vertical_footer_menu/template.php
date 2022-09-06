<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) : ?>
	<?
	$previousLevel = 0;
	foreach ($arResult as $arItem) : ?>

		<? // if ($arItem["IS_PARENT"]) : 
		?>
		<? if ($arItem["DEPTH_LEVEL"] == 1) : ?>

			<div>
				<div class="d-none d-lg-block ff-dinpro fz-18 fw-700 text-uppercase">
					<?= $arItem["TEXT"] ?>
				</div>

				<div class="footer-collapse-title d-block d-lg-none ff-dinpro fz-18 py-10 text-uppercase" data-toggle="collapse" data-target="#footer-collapse-1" aria-controls="footer-collapse-1" role="navigation">
					<?= $arItem["TEXT"] ?>
				</div>
			</div>

			<? if ($arItem["IS_PARENT"]) : ?>
				<div class="hide d-lg-block collapse" id="footer-collapse-1">
					<ul class="ul-clean pt-15 pt-lg-30 pr-xl-30">
			<? endif; ?>

		<? else : ?>

			<? if ($arItem["PERMISSION"] > "D") : ?>
				<li class="mb-5 pb-3">
					<a href="<?= $arItem["LINK"] ?>">
						<?= $arItem["TEXT"] ?>
					</a>
				</li>
			<? else : ?>
				<li class="mb-5 pb-3">
					<a href="">
						<?= $arItem["TEXT"] ?>
					</a>
				</li>
			<? endif; ?>

			<? $previousLevel = $arItem["DEPTH_LEVEL"]; ?>

		<? endif; ?>


	<? endforeach; ?>

			<? if ($previousLevel > 1) : //close last item tags
			?>
				<?= str_repeat("</ul></div>", ($previousLevel - 1)); ?>
			<? endif ?>

			<div class="d-lg-none border-bottom border-white"></div>

		<? endif; ?>