<style type="text/css">
.plot-label {
    color: #38B0E3;
}
</style>

<script type="text/javascript">
    $(document).ready(function() {
        var base_url = $('#base-url').html();

        $('select[name=f_diklat]').change(function(){
            var uc_diklat   = $(this).val();
            var uc_prodi    = $('select[name=f_prodi]').val();

            $('select[name=f_period]').load(base_url + 'monitoring/schedule/load_list_period', {js_diklat : uc_diklat, js_prodi : uc_prodi});
        });

        $('select[name=f_prodi]').change(function(){
            var uc_prodi   = $(this).val();
            var uc_diklat    = $('select[name=f_diklat]').val();

            $('select[name=f_period]').load(base_url + 'monitoring/schedule/load_list_period', {js_diklat : uc_diklat, js_prodi : uc_prodi});
        });

        $('select[name=f_period]').change(function(){
            var uc_period   = $(this).val();

            $('select[name=f_class]').load(base_url + 'monitoring/schedule/load_list_class', {js_period : uc_period});
        });
    });
</script>

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
        <h2 class="text-grey">
        	JADWAL KBM
        	<small class="ml-3">
                <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#form-add-schedule">Tambah Jadwal</a>
        	</small>
        </h2>

        <div class="col-md-12">
            
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <?php if (isset($result)) : ?>
                <?php $i = 1; ?>
                <?php foreach ($result as $res) : ?>

                	<div class="card card-body bg-white my-1">
                        <div class="row small">
                            <div class="col-md-1 py-2">
                                <h5 class="plot-label"><small>No.</small></h5>
                                <span><?=$i?></span>
                            </div>
                            <div class="col-md-3 py-2">
                                <h5 class="plot-label"><small>Diklat</small></h5>
                                <span><?=$res->diklat?></span>
                            </div>
                            <div class="col-md-3 py-2">
                                <h5 class="plot-label"><small>Program Studi</small></h5>
                                <span><?=$res->prodi?></span>
                            </div>
                            <div class="col-md-3 py-2">
                                <h5 class="plot-label"><small>Periode/Tahun - Kelas</small></h5>
                                <?php
                                    if ($res->category == 1) {
                                        $periode_tahun = $res->tahun;
                                    }
                                    else {
                                        $periode_tahun = time_format($res->periode_mulai, "d M Y")." - ".$res->periode_selesai;
                                    }
                                ?>
                                <span><?=$periode_tahun?></span> <br />
                                <span><?=$res->class_label?></span>
                            </div>
                            <div class="col-md-2 py-2">
                                <a href="<?=base_url('monitoring/schedule/manage/'.$res->uc)?>" class="btn btn-warning btn-sm"><i class="fa fa-grip-horizontal"></i></a>
                                <a href="<?=base_url('monitoring/schedule/delete/'.$res->uc)?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                    </div>

                    <?php $i++; ?>
                <?php endforeach; ?>    
            <?php else : ?> 
                Empty   
            <?php endif; ?>  
        </div>
        <!--  
        <div class="card card-body bg-light my-1">
            <div class="row small">
                <div class="col-md-1 py-2">
                    <h5 class="plot-label"><small>No.</small></h5>
                    <span>2</span>
                </div>
                <div class="col-md-2 py-2">
                    <h5 class="plot-label"><small>Diklat</small></h5>
                    <span>DP III Pembentukan</span>
                </div>
                <div class="col-md-3 py-2">
                    <h4 class="plot-label"><small>Program Studi</small></h4>
                    <span>Manajemen Transportasi Laut</span>
                </div>
                <div class="col-md-3 py-2">
                    <h4 class="plot-label"><small>Periode/Tahun</small></h4>
                    <span>12 Jan 2021 - 30 Mar 2021</span>
                </div>
                <div class="col-md-2 py-2">
                    <h4 class="plot-label"><small>Kelas</small></h4>
                    <span>MTL III A</span>
                </div>
                <div class="col-md-1 py-2">
                    <a href="<?=base_url('schedule/manage')?>" class="btn btn-warning btn-sm"><i class="fa fa-grip-horizontal"></i></a>
                </div>
            </div>
        </div>
        -->
    </div>
</div>

<div class="modal fade" id="form-add-schedule">
    <div class="modal-dialog">
        <div class="modal-content">

            <?=form_open_multipart('monitoring/schedule/insert_schedule')?>
            <div class="modal-header">
                <h4 class="modal-title">Tambah Jadwal</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body px-4">
                <div class="form-group">
                    <label for="sel1">Diklat</label>
                    <?php $diklat = list_diklat(); ?>
                    <select class="form-control form-control-lg" name="f_diklat">
                        <option value="" selected>-- choose --</option>
                        <?php foreach ($diklat as $dik) : ?>
                            <option value="<?=$dik->uc?>"><?=$dik->diklat?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sel1">Program Studi</label>
                    <?php $prodi = list_prodi(); 

                    ?>

                    <select class="form-control form-control-lg" name="f_prodi" disabled="disabled">
                        <option value="" selected>-- choose --</option>
                        <?php foreach ($prodi as $pd) : ?>
                            <?php if ($this->session->userdata('log_category') != 1) : ?>
                                <option value="<?=$pd->uc?>" <?=select_set($pd->uc, $this->session->userdata('log_uc_prodi'))?>><?=$pd->prodi?></option>
                            <?php else : ?>
                                <option value="<?=$pd->uc?>"><?=$pd->prodi?></option>
                            <?php endif; ?>    
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sel1">Periode/Tahun</label>
                    <select class="form-control form-control-lg" name="f_period">
                        <option>-- choose --</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sel1">Kelas</label>
                    <select class="form-control form-control-lg" name="f_class">
                       <option>-- choose --</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="f_save">Simpan</button>
            </div>
            <?=form_close()?>
        </div>
    </div>
</div>
