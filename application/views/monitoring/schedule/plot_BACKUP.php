<style type="text/css">
.plot-label {
    color: #38B0E3;
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
                    <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#form-add-plot"><i class="fa fa-plus-circle mr-2"></i>Add</a>
                </small>
            </h2>
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
   
    <div class="row mt-2">
        <div class="col-md-12">
            <?php if (isset($plot)) : ?>
                <?php foreach ($plot as $po) : ?>
                    <div class="card card-body bg-white my-1">
                        <div class="row small">
                            <div class="col-md-2 py-2">
                                <h5 class="plot-label"><small>Jam</small></h5>
                                <div>Ke-<?=$po->jam_ke?> &nbsp; [<?=$po->jam_mulai?> - <?=$po->jam_selesai?>]</div>
                            </div>
                            <div class="col-md-5 py-2">
                                <h5 class="plot-label"><small>Mata Pelajaran</small></h5>
                                <div><?=$po->subject_title?></div>
                            </div>
                            <div class="col-md-3 py-2">
                                <h5 class="plot-label"><small>Pengajar</small></h5>
                                <div><?=$po->full_name?></div>
                            </div>
                            <div class="col-md-2 py-2">
                               <!--  <a href="<?=base_url('monitoring/schedule/plot')?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></a> -->
                                <a href="<?=base_url('monitoring/schedule/plot')?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>    
            <?php else : ?>
                <span class="badge badge-danger mx-auto p-2">Empty</span>
            <?php endif; ?> 
        </div>  

        <!--
        <?php for ($i=1; $i<=3; $i++) : ?>

            <div class="card card-body bg-light my-1">
                <div class="row small">
                    <div class="col-md-2 py-2">
                        <h5 class="plot-label"><small>Jam</small></h5>
                        <span>Ke-<?=$i?> &nbsp; [07.00 - 08.00]</span>
                    </div>
                    <div class="col-md-5 py-2">
                        <h5 class="plot-label"><small>Mata Pelajaran</small></h5>
                        <span>Budaya Keselamatan, Keamanan dan Pelayanan (T)</span>
                    </div>
                    <div class="col-md-3 py-2">
                        <h5 class="plot-label"><small>Pengajar</small></h5>
                        <span>NURJAMAN TINO ENDASAH, S.ST.Pel</span>
                    </div>
                    <div class="col-md-2 py-2">
                        <a href="<?=base_url('schedule/plot')?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></a>
                        <a href="<?=base_url('schedule/plot')?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i></a>
                    </div>
                </div>
            </div>

        <?php endfor; ?>
    -->
    </div>



</div>

<div class="modal fade" id="form-add-plot">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <?=form_open_multipart('monitoring/schedule/insert_plot')?>
            <input type="hidden" name="f_uc_schedule" value="<?=$uc_schedule?>">
            <input type="hidden" name="f_uc_sched_week" value="<?=$uc_sched_week?>">
            <input type="hidden" name="f_uc_diklat" value="<?=$uc_diklat?>">
            <input type="hidden" name="f_uc_prodi" value="<?=$uc_prodi?>">

            <div class="modal-header">
                <h4 class="modal-title">Tambah Jadwal Mapel</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body px-4">
                <div class="row">
                    <div class="col-md-7">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Jam</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i=1; $i<=3; $i++) : ?>
                                    <tr>
                                        <td>
                                            <div class="form-inline">
                                                <input type="checkbox" class="form-check-input mr-4" name="f_jam_ke[]" value="<?=$i?>"> <h3 class="text-danger"><?=$i?> </h3>
                                                &nbsp; &nbsp;
                                                [ &nbsp;
                                                    <input type="text" size="8" class="form-control" name="f_jam_mulai[<?=$i?>]" value="<?=sprintf("%02d", (6+$i)); ?>.00"> &nbsp; - &nbsp;
                                                    <input type="text" size="8" class="form-control" name="f_jam_selesai[<?=$i?>]" value="<?=sprintf("%02d", (7+$i)); ?>.00">
                                                  &nbsp;  
                                                ]
                                            </div>
                                        </td>    
                                    </tr> 
                                <?php endfor; ?>
                                <?php for ($i=4; $i<=5; $i++) : ?>
                                    <tr>
                                        <td>
                                            <div class="form-inline">
                                                <input type="checkbox" class="form-check-input mr-4" name="f_jam_ke[]" value="<?=$i?>"> <h3 class="text-danger"><?=$i?> </h3>
                                                &nbsp; &nbsp;
                                                    [ &nbsp;
                                                        <input type="text" size="8" class="form-control" name="f_jam_mulai[<?=$i?>]" value="<?=sprintf("%02d", (6+$i)); ?>.30"> &nbsp; - &nbsp;
                                                        <input type="text" size="8" class="form-control" name="f_jam_selesai[<?=$i?>]" value="<?=sprintf("%02d", (7+$i)); ?>.30">
                                                      &nbsp;  
                                                    ]
                                            </div>        
                                        </td>    
                                    </tr> 
                                <?php endfor; ?>
                                <?php for ($i=6; $i<=7; $i++) : ?>
                                    <tr>
                                        <td>
                                            <div class="form-inline">
                                                <input type="checkbox" class="form-check-input mr-4" name="f_jam_ke[]" value="<?=$i?>"> <h3 class="text-danger"><?=$i?> </h3>
                                                &nbsp; &nbsp;
                                                    [ &nbsp;
                                                        <input type="text" size="8" class="form-control" name="f_jam_mulai[<?=$i?>]" value="<?=sprintf("%02d", (7+$i)); ?>.30"> &nbsp; - &nbsp;
                                                        <input type="text" size="8" class="form-control" name="f_jam_selesai[<?=$i?>]" value="<?=sprintf("%02d", (8+$i)); ?>.30">
                                                      &nbsp;  
                                                    ]
                                            </div>        
                                        </td>    
                                    </tr> 
                                <?php endfor; ?>
                                <?php for ($i=8; $i<=10; $i++) : ?>
                                    <tr>
                                        <td>
                                            <div class="form-inline">
                                                <input type="checkbox" class="form-check-input mr-4" name="f_jam_ke[]" value="<?=$i?>"> <h3 class="text-danger"><?=$i?> </h3>
                                                &nbsp; &nbsp;
                                                    [ &nbsp;
                                                        <input type="text" size="8" class="form-control" name="f_jam_mulai[<?=$i?>]" value="<?=sprintf("%02d", (7+$i)); ?>.45"> &nbsp; - &nbsp;
                                                        <input type="text" size="8" class="form-control" name="f_jam_selesai[<?=$i?>]" value="<?=sprintf("%02d", (8+$i)); ?>.45">
                                                      &nbsp;  
                                                    ]
                                            </div>        
                                        </td>    
                                    </tr> 
                                <?php endfor; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group mt-4"> 
                           <label for="email"><b>Mata Pelajaran</b></label>
                           <select class="form-control form-control-lg" name="f_uc_subject">
                                <option value="">-- choose --</option>
                                <?php if (isset($subject)) : ?>
                                    <?php foreach ($subject as $sub) : ?>
                                        <option value="<?=$sub->uc?>"><?=$sub->subject_title?></option>
                                    <?php endforeach; ?>    
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="form-group"> 
                           <label for="email"><b>Pengajar</b></label>
                           <select class="form-control form-control-lg" name="f_uc_instructor">
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
                
                
            </div>

            <div class="modal-footer">
                <input type="submit" name="f_save" value="Tambah" class="btn btn-primary">
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
    });
</script>