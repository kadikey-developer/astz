<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<div class="tabs">
	<ul class="nav nav-tabs">
<?foreach($arResult as $arItem):?>

	<?if ($arItem["PERMISSION"] > "D"):?>
		<li class="nav-item">
			<a
				href="<?=$arItem["LINK"]?>"
				class="nav-link <?=(!empty($arItem["SELECTED"]) ? "active" : "")?>"
				aria-selected="true"
			>
				<?=$arItem["TEXT"]?>
			</a>
	</li>
	<?endif?>

<?endforeach?>

	</ul>
</div>
<?endif?>