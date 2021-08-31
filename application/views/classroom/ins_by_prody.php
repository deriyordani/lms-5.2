<?php if(isset($result)):?>
	<option value="">--- Pilih ----</option>
	<?php foreach($result as $row):?>
		<option value="<?=$row->uc?>"><?=$row->id_number.' - '.$row->full_name?></option>
	<?php endforeach;?>
<?php endif;?>