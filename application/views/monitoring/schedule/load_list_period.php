<?php if (isset($result)): ?>
	<option>-- choose --</option>
	<?php foreach ($result as $row): ?>
		<option value="<?=$row->uc?>"><?=$row->label_periode?></option>
	<?php endforeach ?>
<?php endif ?>