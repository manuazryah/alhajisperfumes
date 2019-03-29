<?php
foreach ($brands as $brand) {
	?>
	<li id="brand_checkboxes">
		<label class="input-style-box">
			<?php $brand_id = str_replace(' ', '_', $brand->brand); ?>
			<input class="check_brand" type="checkbox"  id="<?= strtolower($brand_id) ?>" name="brand[]" value="<?= $brand->brand ?>" />
		       <!--<input name="" type="checkbox" value="">-->
			<span class="checkmark"></span> <?= $brand->brand ?> </label>
	</li>
<?php } ?>
