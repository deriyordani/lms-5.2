<style type="text/css">
.plot-label {
    color: #38B0E3;
}

.card-active{
    background-color: #fff;
    border: 1px solid #3D9ED1;
}

.card-inactive {
    background-color: #E7E7E7;
}
</style>

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg></div>
                        Schedule
                    </h1>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2 class="text-grey">KELOLA JADWAL
                <small class="ml-3">
                    <?php if (isset($splot)) : ?>
                        <a href="<?=base_url('monitoring/schedule/edit_plot/'.$uc_schedule.'/'.$uc_sched_week.'/'.$uc_diklat.'/'.$uc_prodi)?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt mr-2"></i>Edit</a>
                    <?php else : ?>
                        <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#form-add-plot"><i class="fa fa-plus-circle mr-2"></i>Add</a>
                    <?php endif; ?>
                </small>
            </h2>
        </div> 
        <div class="col-md-4 ml-auto text-right">
            <a href="<?=base_url('monitoring/schedule/manage/'.$uc_schedule)?>"><i class="fa fa-chevron-circle-left text-warning" style="font-size: 1.5em"></i></a>
        </div> 
    </div>

    <div class="row mt-4">
        <div class="col-md-8 small">
            <span>Diklat - Program Studi</span> <br />
            <h4>
                <?=$row->diklat?> -
                <?=$row->prodi?>
            </h4>
        </div>
        <div class="col-md-4 small">
            <span>Periode / Kelas</span> <br />

            <?php
                if ($row->category == 1) {
                    $periode_tahun = $row->tahun;
                }
                else {
                    $periode_tahun = time_format($row->periode_mulai, "d M Y")." - ".time_format($row->periode_selesai, "d M Y");
                }
            ?>
            <h4>
                <?=$periode_tahun?> / 
                <?=$row->class_label?>    
            </h4>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-12">
            <h3 class="text-warning">
                <span>Minggu ke - <?=$week->minggu_ke?> </span> 
                <span class="ml-3">[<?=time_format($week->tanggal_mulai, "d M Y")?> - <?=time_format($week->tanggal_akhir, "d M Y")?>]</span>
            </h3>
        </div>
    </div>
   
    <div class="row mt-2 mb-3 pb-3">
        <div class="col-md-12">
            <?php if (isset($splot)) : ?>
                <?php for ($i=1; $i<=10; $i++) : ?>
                    <?php if (@$splot[$i]['subject_title'] != NULL) : ?>
                        <div class="card card-body bg-white card-active">
                            <div class="row small">
                                <div class="col-md-2 py-2">
                                    <h5 class="plot-label"><small>Jam</small></h5>
                                    <div>
                                        <span class="text-danger" style="font-size: 1.5em"><?=$i?> </span>
                                        &nbsp; &nbsp;
                                        [
                                            <?=(@$splot[$i]['jam_mulai'] != NULL ? @$splot[$i]['jam_mulai'] : "-")?>
                                            -
                                            <?=(@$splot[$i]['jam_selesai'] != NULL ? @$splot[$i]['jam_selesai'] : "-")?>
                                        ]   
                                    </div>
                                </div>
                                <div class="col-md-5 py-2">
                                    <h5 class="plot-label"><small>Mata Pelajaran</small></h5>
                                    <div>
                                        <?=(@$splot[$i]['subject_title'] != NULL ? @$splot[$i]['subject_title'] : "-")?>
                                    </div>
                                </div>
                                <div class="col-md-3 py-2">
                                    <h5 class="plot-label"><small>Pengajar</small></h5>
                                    <div><?=(@$splot[$i]['instructor'] != NULL ? @$splot[$i]['instructor'] : "-")?></div>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="card card-body my-1 card-inactive">
                            <div class="row small">
                                <div class="col-md-2 py-2">
                                    <h5 class="plot-label"><small>Jam</small></h5>
                                    <div>
                                        <?=$i?>
                                        &nbsp; &nbsp;
                                        -    
                                    </div>
                                </div>
                            </div>
                        </div>    
                    <?php endif;?>  
                    
                        
                <?php endfor; ?>

            <?php else : ?>
                <span class="badge badge-danger mx-auto p-2">Empty</span>
            <?php endif; ?> 
        </div>  

    </div>



</div>


<div class="modal fade" id="form-add-plot">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <?=form_open('monitoring/schedule/insert_plot')?>
            <input type="hidden" name="f_uc_schedule" value="<?=$uc_schedule?>">
            <input type="hidden" name="f_uc_sched_week" value="<?=$uc_sched_week?>">
            <input type="hidden" name="f_uc_diklat" value="<?=$uc_diklat?>">
            <input type="hidden" name="f_uc_prodi" value="<?=$uc_prodi?>">

            <div class="modal-header">
                <h4 class="modal-title">Tambah Jadwal Mapel</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body px-4">
                <?php for ($i=1; $i<=10; $i++) : ?>
                      <div class="card card-body bg-white my-1">
                        <div class="row small">
                            <div class="col-md-4 py-2">
                                <h5 class="plot-label"><small>Jam</small></h5>
                                <div class="form-inline">
                                    <h3 class="text-danger"><?=$i?> </h3>
                                    &nbsp; &nbsp;
                                        <input type="text" size="8" class="form-control jam-mulai jam-mulai-<?=$i?>" data-i="<?=$i?>" name="f_jam_mulai[<?=$i?>]" value="<?=sprintf("%02d", (6+$i)); ?>.00"> &nbsp; - &nbsp;
                                        <input type="text" size="8" class="form-control jam-selesai jam-selesai-<?=$i?>" data-i="<?=$i?>" name="f_jam_selesai[<?=$i?>]" value="<?=sprintf("%02d", (7+$i)); ?>.00">
                                      &nbsp;
                                </div>
                            </div>
                            <div class="col-md-5 py-2">
                                <h5 class="plot-label"><small>Mata Pelajaran</small></h5>
                                <select class="form-control form-control-lg" name="f_uc_subject[<?=$i?>]">
                                    <option value="">-- choose --</option>
                                    <?php if (isset($subject)) : ?>
                                        <?php foreach ($subject as $sub) : ?>
                                            <option value="<?=$sub->uc?>"><?=$sub->subject_title?></option>
                                        <?php endforeach; ?>    
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-md-3 py-2">
                                <h5 class="plot-label"><small>Pengajar</small></h5>
                                <select class="form-control form-control-lg uc-instructor uc-instructor-<?=$i?>" data-i="<?=$i?>"" name="f_uc_instructor[<?=$i?>]">
                                    <option value="">-- choose --</option>
                                    <?php if (isset($instructor)) : ?>
                                        <?php foreach ($instructor as $ins) : ?>
                                            <option value="<?=$ins->uc?>"><?=$ins->full_name?></option>
                                        <?php endforeach; ?>    
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
                <!--
                <div class="card card-body" style="background-color: #E7E7E7">
                    <div class="row small">
                        <div class="col-md-12 text-center">
                            [ 10.00 - 10.30 ] &nbsp; ISTIRAHAT
                        </div>    
                    </div>
                </div>
                -->

            </div>    

            <div class="modal-footer">
                <input type="submit" name="f_save" value="Save" class="btn btn-primary">
            </div>
            <?=form_close()?>
            
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        var base_url = $('#base-url').html();
        
        $('.datepicker').datepicker({
            format: "dd M yyyy"
        });


        $('.uc-instructor').change(function(e){
            var i = $(this).attr('data-i');
            var uc_instructor = $('.uc-instructor-'+i).val();
            var instructor_name = $('.uc-instructor-'+i+' option:selected').text();
            var jam_mulai = $('.jam-mulai-'+i+'').val();
            var jam_selesai = $('.jam-selesai-'+i+'').val();
            var uc_week     = $('input[name=f_uc_sched_week]').val();

            //alert(uc_instructor+' - '+jam_mulai+' - '+jam_selesai+' - '+uc_week);

            $('select.uc-instructor-'+i).removeClass('is-invalid');

            $.ajax(
                {
                    type        : 'post',
                    dataType    : 'json',
                    data        : { js_uc_instructor : uc_instructor, js_uc_week : uc_week, js_jam_mulai : jam_mulai, js_jam_selesai : jam_selesai},
                    url         : base_url + 'monitoring/schedule/is_intersecting',
                    success     : function(output) {
                        //window.location.replace(base_url + "period/manage/" + uc_period+'/'+uc_peg_ukp);
                        if (output == true) {
                            $('select.uc-instructor-'+i).addClass('is-invalid');
                            alert("Instruktur "+instructor_name+", telah dijadwalkan untuk waktu yang sama di jadwal lain!");
                        }
                    }
                });
        });

        $('.uc-instructor').focusout(function(e){
            var i = $(this).attr('data-i');
            var uc_instructor = $('.uc-instructor-'+i).val();
            var instructor_name = $('.uc-instructor-'+i+' option:selected').text();
            var jam_mulai = $('.jam-mulai-'+i+'').val();
            var jam_selesai = $('.jam-selesai-'+i+'').val();
            var uc_week     = $('input[name=f_uc_sched_week]').val();

            //alert(uc_instructor+' - '+jam_mulai+' - '+jam_selesai+' - '+uc_week);

            $.ajax(
                {
                    type        : 'post',
                    dataType    : 'json',
                    data        : { js_uc_instructor : uc_instructor, js_uc_week : uc_week, js_jam_mulai : jam_mulai, js_jam_selesai : jam_selesai},
                    url         : base_url + 'monitoring/schedule/is_intersecting',
                    success     : function(output) {
                        //window.location.replace(base_url + "period/manage/" + uc_period+'/'+uc_peg_ukp);
                        if (output == true) {
                            $(this).addClass('is-invalid');
                            //$(this).addC
                            //alert("Instruktur "+instructor_name+", telah dijadwalkan untuk waktu yang sama di jadwal lain!");
                        }
                    }
                });
        });

        /*
        $('.jam-mulai').focusout(function(){
            var i = $(this).attr('data-i');
            var uc_instructor = $('.uc-instructor-'+i).val();
            var instructor_name = $('.uc-instructor-'+i+' option:selected').text();
            var jam_mulai = $('.jam-mulai-'+i+'').val();
            var jam_selesai = $('.jam-selesai-'+i+'').val();
            var uc_week     = $('input[name=f_uc_sched_week]').val();

            $.ajax(
                {
                    type        : 'post',
                    dataType    : 'json',
                    data        : { js_uc_instructor : uc_instructor, js_uc_week : uc_week, js_jam_mulai : jam_mulai, js_jam_selesai : jam_selesai},
                    url         : base_url + 'monitoring/schedule/is_intersecting',
                    success     : function(output) {
                        //window.location.replace(base_url + "period/manage/" + uc_period+'/'+uc_peg_ukp);
                        if (output == true) {
                            alert("Instruktur "+instructor_name+", telah dijadwalkan untuk waktu yang sama di jadwal lain!");
                        }
                    }
                });
        });

        $('.jam-selesai').focusout(function(){
            var i = $(this).attr('data-i');
            var uc_instructor = $('.uc-instructor-'+i).val();
            var instructor_name = $('.uc-instructor-'+i+' option:selected').text();
            var jam_mulai = $('.jam-mulai-'+i+'').val();
            var jam_selesai = $('.jam-selesai-'+i+'').val();
            var uc_week     = $('input[name=f_uc_sched_week]').val();

            //alert(uc_instructor+' - '+jam_mulai+' - '+jam_selesai+' - '+uc_week);
            //alert(uc_instructor+' - '+jam_mulai+' - '+jam_selesai+' - '+uc_week);

            $.ajax(
                {
                    type        : 'post',
                    dataType    : 'json',
                    data        : { js_uc_instructor : uc_instructor, js_uc_week : uc_week, js_jam_mulai : jam_mulai, js_jam_selesai : jam_selesai},
                    url         : base_url + 'monitoring/schedule/is_intersecting',
                    success     : function(output) {
                        //window.location.replace(base_url + "period/manage/" + uc_period+'/'+uc_peg_ukp);
                        if (output == true) {
                            alert("Instruktur "+instructor_name+", telah dijadwalkan untuk waktu yang sama di jadwal lain!");
                        }
                    }
                });
        });
        */
    });

</script>