<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<div class="wp">
	<h3>Pendaftaran Berhasil!</h3>
	<p>
		<h4>Hallo <?=$full_name?></h4>
	</p>
	<p>
		Terima kasih telah melakukan registrasi akun Learning Management System Politeknik Pelayaran Sorong, </br>
		berikut adalah informasi akun anda : 
	</p>
	<p>
		<b>Email</b> : <?=$email?><br>
		<b>Username</b> : <?=$username?><br>
		<b>Password</b> : <?=$password?><br>

		untuk dapat mengakses laman Learning Management System Politeknik Pelayaran Sorong, </br>
		silahkan aktivasi akun dengan klik tombol "AKTIFKAN AKUN" di bawah ini :
	</p>
	
	<a href="<?=base_url('auth/activation/'.$uc)?>" target="_BLANK">AKTIFKAN AKUN</a>

	<table>
		<tr>
			<td rowspan="2" width="150" align="center">
				<img src="<?=base_url('assets/img/favicon.png')?>" width="90" class="ml-5 mt-5">
			</td>
			<td >
				<h3>Politeknik Pelayaran Sorong</h3>
				Badan Pengembangan Sumber Daya Manusia <br/>
				Kementerian Perhubungan
			</td>
			
		</tr>

		
	</table>
	</div>

</body>
</html>