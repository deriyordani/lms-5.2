<?php if(isset($result)):?>
	<option value="">--- Pilih ----</option>
	<?php foreach($result as $row):?>
		<option value="<?=$row->uc?>" <?=select_set($row->uc, $this->session->userdata('log_uc_person'))?>><?=$row->id_number.' - '.$row->full_name?></option>
	<?php endforeach;?>
<?php endif;?>