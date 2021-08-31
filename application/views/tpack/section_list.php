<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>


<?php if (isset($section)) : ?>
	<ul>
	<?php foreach ($section as $sec) : ?>
		<li><a href="<?=base_url('dev/section/'.$sec->uc_tpack.'/'.$sec->uc)?>">Bab. <?=$sec->sequence?>. <?=$sec->section_title?></a></li>
	<?php endforeach; ?>
	</ul>
<?php else : ?>	
	Empty
<?php endif; ?>	

</body>
</html>