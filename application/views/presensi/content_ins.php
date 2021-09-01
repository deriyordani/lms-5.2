<script type="text/javascript">
	$(document).ready(function(){
		var base_url = $("#base-url").html();

		$('.check-absen').click(function(){
			var uc_student = $(this).attr('uc-student');
			var status = $(this).val();
			var uc_classroom = $('input[name=f_uc_classroom]').val();
			var uc_kehadiran = $(this).attr('uc');

			$.ajax({
	              url: base_url+'presensi/set_status',
	              type: 'post',
	              data: {js_uc_student : uc_student , js_status : status, js_uc_classroom : uc_classroom, js_kehadiran : uc_kehadiran},             
	              success: function(data) {
	              	alert("Data Berhasil Diperbaharui !");
	              //location.reload();               
	              // // document.getElementById("formMhs").reset();
	              // // $('#status').html(data);
	              //   $('#modals-view-form').modal('toggle');

	              //   $('.load-comment').load(base_url+'student/classroom/load_comment',{js_uc_content : uc_content});           
	              }
	        });

		});
	});
</script>
<?php if(isset($result)):?>

	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				Presensi Tgl : <?=time_format(current_time(),'d M Y')?>
			</div>
			<div class="card-body">
				<div class="table-responsive">
		            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
		                <thead>
		                    <tr class="btn-light">
		                        <td class="text-primary text-center" width="5%">No</td>
		                        <td class="text-primary text-center">No. Peserta</td>
		                        <td class="text-primary text-center">Nama Lengkap</td>
		                        <td class="text-primary text-center">Status</td>
		                        <td class="text-primary text-center">Jam Kehadiran</td>
		                    </tr>
		                </thead>

		                <tbody>
		                    <?php $no = $numbering;?>
		                    <?php foreach($result as $row):?>
		                        <tr>
		                            <td><?=$no?></td>
		                            <td><?=$row->no_peserta?></td>
		                            <td><?=$row->full_name?></td>
		                            <td>
		                            	<div class="form-check form-check-inline">
										  <input class="form-check-input check-absen" type="radio" name="f_status_<?=$row->id?>" uc-student="<?=$row->uc?>" uc="<?=$row->uc_kehadiran?>"  id="inlineRadio1" value="1" <?=radio_set($row->status, 1)?>>
										  <label class="form-check-label" for="inlineRadio1">Hadir</label>
										</div>

										<div class="form-check form-check-inline">
										  <input class="form-check-input check-absen" type="radio" name="f_status_<?=$row->id?>" uc-student="<?=$row->uc?>" uc="<?=$row->uc_kehadiran?>"  id="inlineRadio2" value="2" <?=radio_set($row->status, 2)?>>
										  <label class="form-check-label" for="inlineRadio2">Izin</label>
										</div>
										<div class="form-check form-check-inline">
										  <input class="form-check-input check-absen" type="radio" name="f_status_<?=$row->id?>" uc-student="<?=$row->uc?>"  uc="<?=$row->uc_kehadiran?>" id="inlineRadio2" value="3" <?=radio_set($row->status, 3)?>>
										  <label class="form-check-label" for="inlineRadio2">Sakit</label>
										</div>
		                            </td>
		                            <td>
		                            	<?=($row->date_time != NULL ? time_format($row->date_time,'H:i') : '-')?>
		                            </td>
		                        </tr>

		                          <?php $no++;?>
		                   	<?php endforeach;?>

		                </tbody>

		            </table>
		        </div>
			</div>
		</div>
        
   	</div>

	<div class="col-md-12 mt-2 page-subject">
        <?php if (isset($pagination)) : ?>
            <?=$pagination?>
        <?php endif; ?>
    </div>

<?php else:?>
    <div class="col-md-12">
        <div class="alert alert-red alert-solid text-center" role="alert">Empty..</div>
    </div>
<?php endif;?>