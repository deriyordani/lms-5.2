<?php if(isset($result)):?>
	<option value="">--- Pilih ----</option>
	<?php foreach($result as $row):?>
		<option value="<?=$row->uc?>"><?=$row->subject_code.' - '.$row->subject_title?></option>
	<?php endforeach;?>
<?php endif;?>