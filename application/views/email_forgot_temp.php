<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<div class="wp">
	<p>
		<h4>Dear <?=$username?>, </h4>
	</p>
	<p>
		Anda atau seseorang telah mengajukan perubahan password akun Learning Management System Politeknik Pelayaran Sorong <br/>
		
	</p>
	<p>
		Untuk mengubah Password, silahkan klik pada link berikut : <a href="<?=base_url('auth/change_password/'.$uc.'/'.$time)?>">Link Reset Password</a>
	</p>
	<p>
		Link tersebut valid selama 1 Jam. Disarankan segera melakukan perubahan Password segera setelah menerima email ini.
	</p>

	<p>
		Terimakasih.<br/>

		Best Regard Poltekpel Sorong
	</p>

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