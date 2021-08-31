<?php if(isset($result)):?>
	<option value="">--- Pilih ----</option>
	<?php foreach($result as $row):?>
		<option value="<?=$row->uc?>"><?=$row->class_label?></option>
	<?php endforeach;?>
<?php endif;?>