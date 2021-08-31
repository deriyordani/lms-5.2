<?php 

function label ($label) {
	$ci = &get_instance();

	$sentence = $ci->lang->line($label);

	if ($sentence) {

		return $sentence;

	} else 	{

		return $label;

	}
}

?>