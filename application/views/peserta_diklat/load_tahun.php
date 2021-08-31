<?php if(isset($result)):?>
	<option value="">--- Pilih ----</option>
	<?php foreach($result as $row):?>
		<?php if($row->category == 1):?>
			<option value="<?=$row->uc?>"><?=$row->tahun?></option>
		<?php else:?>
			<option value="<?=$row->uc?>"><?=time_format($row->periode_mulai, 'd M Y').'<br/> s/d <br/>'.time_format($row->periode_selesai, 'd M Y')?></option>
		<?php endif;?>
	<?php endforeach;?>
<?php endif;?>