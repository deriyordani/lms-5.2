<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Rekap Absensi</title>
</head>
<body>
<h3>Rekap Absensi</h3>
</br>
<table border=1>
	<tr>
		<th>No Peserta</th>
		<th>Nama Siswa</th>
		<?php
		// Create tabel header
		foreach($section as $sect_row){
			echo "<th>".$sect_row->sequence."</th>";
		}
		?>
		<th>Hadir</th>
		<th>Ijin</th>
		<th>Sakit</th>
		<th>Alpa</th>
	</tr>
	<?php
	foreach($student as $student_info){
		$presence_hadir = 0;
		$presence_ijin = 0;
		$presence_sakit = 0;
		$presence_alpa = 0;
	?>
	<tr>
		<td><?=$student_info->no_peserta;?></td>
		<td><?=$student_info->full_name;?></td>

	<?php
		// loop check presence
		foreach($section as $sect_row){
			$sign = "-";
			$presence_alpa++;
			foreach($kehadiran as $presence){
				if ($presence->uc_section == $sect_row->uc && $presence->uc_diklat_participant == $student_info->uc){
					if($presence->status == 1){
						$sign = "&#10004;";
						$presence_hadir++;
						$presence_alpa--;
					} elseif($presence->status == 2){
						$presence_sakit++;
						$presence_alpa--;
					} elseif($presence->status == 3){
						$presence_ijin++;
						$presence_alpa--;
					}
					break;
				}
			}
			echo "<td>$sign</td>";
		}

		// presence status
		echo "<td>$presence_hadir</td>";
		echo "<td>$presence_ijin</td>";
		echo "<td>$presence_sakit</td>";
		echo "<td>$presence_alpa</td>";
	?>
	<tr>
	<?php
	}
	?>
	
</table>
</body>
</html>