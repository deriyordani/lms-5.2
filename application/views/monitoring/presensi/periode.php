<link rel="stylesheet" type="text/css" href="<?=base_url('assets/third_party/fontawesome-5.13.0/css/all.css')?>">

<script type="text/javascript">
    $(document).ready(function() {
        /*
        var base_url = $('#base-url').html();

        $('select[name=f_diklat]').change(function(){
            var uc = $(this).val();
            
            $('select[name=f_program]').load(base_url+'monitoring/presensi/list_program', {js_uc_diklat : uc});
            
        });
        */
    });
</script>

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
                        <div class="page-header-icon">
                            <i class="fa fa-boxes"></i>
                        </div>
                        Presensi
                    </h1>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    
                    <form class="form-row" method="post" action="<?=base_url('monitoring/presensi/periode')?>" >
                        <input type="hidden" name="f_program" />
                        <div class="col">
                            <select name="f_diklat" class="form-control">
                                <?php $list_diklat = list_diklat() ?>
                                    <option>-- Diklat --</option>
                                    <?php if (isset($list_diklat)): ?>
                                        <?php foreach ($list_diklat as $ld): ?>
                                            <option value="<?=$ld->uc?>" <?=select_set($ld->uc, @$uc_diklat)?> ><?=$ld->diklat?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                            </select>
                        </div>
                        <div class="col" id="pro">
                            <?php $prodi = list_prodi(); ?>
                            <select class="form-control form-control" name="f_program" disabled="disabled">
                                <option value="" selected>-- Program --</option>
                                <?php foreach ($prodi as $pd) : ?>
                                    <?php if ($this->session->userdata('log_category') != 1) : ?>
                                        <option value="<?=$pd->uc?>" <?=select_set($pd->uc, $this->session->userdata('log_uc_prodi'))?>><?=$pd->prodi?></option>
                                    <?php else : ?>
                                        <option value="<?=$pd->uc?>"><?=$pd->prodi?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col">
                            <button type="submit" class="btn btn-primary">OK</button>
                        </div>
                    </form>

                </div>
                <div class="card-body">
                    <?php if (isset($submit)) : ?>
                        <?php if (isset($result)) : ?>
                            <?php $i = 1; ?>
                            <?php foreach ($result as $res) : ?>    
                                <div class="card card-body bg-white my-1">
                                    <div class="row small">
                                        <div class="col-md-1 py-2">
                                            <h5 class="plot-label"><small>No.</small></h5>
                                            <span><?=$i?></span>
                                        </div>
                                        <div class="col-md-4 py-2">
                                            <h5 class="plot-label"><small>Nama</small></h5>
                                            <span><?=$res->label_periode?></span>
                                        </div>
                                        <div class="col-md-4 py-2">
                                            <h5 class="plot-label"><small>Periode</small></h5>
                                            <span>
                                                <?php 
                                                    if ($res->category == 1) {
                                                        $periode = $res->tahun;
                                                    }
                                                    else {
                                                        $periode = time_format($res->periode_mulai, "d M Y")." - ".time_format($res->periode_selesai, "d M Y");
                                                    }
                                                ?>
                                                <?=$periode?>
                                            </span>
                                        </div>
                                        <div class="col-md-1 py-2">
                                            <h5 class="plot-label"><small>Kelas</small></h5>
                                            <span><?=$res->class_label?></span>
                                        </div>
                                        <div class="col-md-2 py-2">
                                            <h5 class="plot-label"><small>Classroom</small></h5>
                                            <a href="<?=base_url('monitoring/presensi/subject/'.$uc_diklat.'/'.$uc_program.'/'.$res->uc)?>" title="Subject"><i class="fa fa-list-ul"></i></a>
                                        </div>    
                                    </div>
                                </div>
                                <?php $i++; ?>
                            <?php endforeach; ?>

                        <?php else : ?>
                            Kosong
                        <?php endif; ?>    
                    <?php endif; ?>

                </div>
            </div>
            
        </div>
    </div>

</div>