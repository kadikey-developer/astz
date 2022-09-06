<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
?>
<div class="pre-footer__form" id="subscribe-form">
	<?
	$frame = $this->createFrame("subscribe-form", false)->begin();
	?>
	<form action="<?= $arResult["FORM_ACTION"] ?>">

		<? foreach ($arResult["RUBRICS"] as $itemID => $itemValue) : ?>
			<label for="sf_RUB_ID_<?= $itemValue["ID"] ?>">
				<input type="hidden" name="sf_RUB_ID[]" id="sf_RUB_ID_<?= $itemValue["ID"] ?>" value="<?= $itemValue["ID"] ?>" <? if ($itemValue["CHECKED"]) echo " checked" ?> /> <?= $itemValue["NAME"] ?>
			</label><br />
		<? endforeach; ?>
		<div class="pre-footer__limiter mb-15">
			<input type="text" class="form-control form-control-lg" id="subscribe-name" placeholder="Имя*" aria-label="Имя">
		</div>
		<div class="pre-footer__limiter mb-30">
			<input type="email" class="form-control form-control-lg" id="subscribe-email" placeholder="Электронный адрес*" aria-label="Электронный адрес" value="<?= $arResult["EMAIL"] ?>">
			<!-- <input type="email" class="form-control form-control-lg is-invalid" id="subscribe-email" placeholder="Электронный адрес*" aria-label="Электронный адрес"> -->
			<!-- <div class="invalid-feedback">
				Please choose a username.
			</div> -->
		</div>
		<div class="custom-control custom-control-red custom-checkbox mb-30">
			<input type="checkbox" class="custom-control-input" id="subscribe-areement">
			<label class="custom-control-label" for="subscribe-areement">
				Нажимая кнопку "<?= GetMessage("subscr_form_button") ?>" Вы даёте свое согласие на обработку введенной персональной <br>
				информации в соответствии с Федеральным Законом №152-ФЗ от 27.07.2006 "О персональных данных"
			</label>
		</div>
		<div class="custom-control custom-control-red custom-checkbox mb-25">
			<input type="checkbox" class="custom-control-input" id="subscribe-newsletter">
			<label class="custom-control-label" for="subscribe-newsletter">
				Согласие на получение рассылки
			</label>
		</div>
		<div class="mb-40 pl-25">
			* поля обязательные для заполнения
		</div>
		<div>
			<input type="submit" class="btn btn-lg btn-red fw-700" value="<?= GetMessage("subscr_form_button") ?>">
		</div>
	</form>
	<?
	$frame->beginStub();
	?>
	<form action="<?= $arResult["FORM_ACTION"] ?>">

		<? foreach ($arResult["RUBRICS"] as $itemID => $itemValue) : ?>
			<label for="sf_RUB_ID_<?= $itemValue["ID"] ?>">
				<input type="checkbox" name="sf_RUB_ID[]" id="sf_RUB_ID_<?= $itemValue["ID"] ?>" value="<?= $itemValue["ID"] ?>" /> <?= $itemValue["NAME"] ?>
			</label><br />
		<? endforeach; ?>

		<div class="pre-footer_limiter mb-15">
			<input type="text" class="form-control form-control-lg" id="subscribe-name" placeholder="Имя*" aria-label="Имя">
		</div>
		<div class="pre-footer__limiter mb-30">
			<input type="email" class="form-control form-control-lg" id="subscribe-email" placeholder="Электронный адрес*" aria-label="Электронный адрес" value="">
			<!-- <input type="email" class="form-control form-control-lg is-invalid" id="subscribe-email" placeholder="Электронный адрес*" aria-label="Электронный адрес"> -->
			<!-- <div class="invalid-feedback">
				Please choose a username.
			</div> -->
		</div>
		<div class="custom-control custom-control-red custom-checkbox mb-30">
			<input type="checkbox" class="custom-control-input" id="subscribe-areement">
			<label class="custom-control-label" for="subscribe-areement">
				Нажимая кнопку "<?= GetMessage("subscr_form_button") ?>" Вы даёте свое согласие на обработку введенной персональной <br>
				информации в соответствии с Федеральным Законом №152-ФЗ от 27.07.2006 "О персональных данных"
			</label>
		</div>
		<div class="custom-control custom-control-red custom-checkbox mb-25">
			<input type="checkbox" class="custom-control-input" id="subscribe-newsletter">
			<label class="custom-control-label" for="subscribe-newsletter">
				Согласие на получение рассылки
			</label>
		</div>
		<div class="mb-40 pl-25">
			* поля обязательные для заполнения
		</div>
		<div>
			<input type="submit" class="btn btn-lg btn-red fw-700" value="<?= GetMessage("subscr_form_button") ?>">
		</div>
	</form>
	<?
	$frame->end();
	?>
</div>