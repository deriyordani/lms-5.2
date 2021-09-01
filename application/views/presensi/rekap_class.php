<table border="1">
	<tr>
		<td>UC STUDENT</td>

		<?php foreach($section as $sec):?>
			<td><?=$sec->section_label?></td>
		<?php endforeach;?>
	</tr>

	<?php foreach($participant as $par):?>
		<tr>
			<td><?=$par->no_peserta.' - '.$par->full_name?></td>

			<?php $query = $this->db->query("SELECT kh.*, se.section_label
				FROM `lms_kehadiran` kh
				 JOIN lms_classroom cl ON kh.uc_classroom = cl.uc
				 JOIN lms_section se ON kh.uc_section = se.uc

				WHERE  kh.uc_student IS NOT NULL AND kh.uc_classroom = '606bcfaae0454' AND kh.uc_student = '".$par->uc_student."'
			");?>

			<?php foreach($query->result() as $kh):?>
				<td>a</td>
			<?php endforeach;?>
		</tr>
	<?php endforeach;?>

</table>