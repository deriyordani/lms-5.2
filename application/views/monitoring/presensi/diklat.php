<script type="text/javascript">
    $(document).ready(function() {
        var base_url = $('#base-url').html();
        var uc_program    = $('select[name=f_program]').val();

        $('input[name=f_program').val(uc_program);

        // $('select[name=f_diklat]').change(function(){
        //     var uc = $(this).val();
            
        //     $('select[name=f_program]').load(base_url+'monitoring/presensi/list_program', {js_uc_diklat : uc});
            
        // });
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

                    <!--
                    <?php if ($this->session->userdata('log_uc_prodi')) : ?>
                    <?php else : ?>
                    <?php endif; ?>    
                    -->
                    
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
                                        <div class="col-md-3 py-2">
                                            <h5 class="plot-label"><small>Subject</small></h5>
                                            <span><?=$res->subject_title?></span>
                                        </div>
                                        <div class="col-md-4 py-2">
                                            <h5 class="plot-label"><small>Classroom</small></h5>
                                            <span>[<?=$res->classroom_code?>] <br /><?=$res->classroom_title?></span>
                                        </div>
                                        <div class="col-md-3 py-2">
                                            <h5 class="plot-label"><small>Instructor</small></h5>
                                            <span><?=$res->full_name?></span>
                                        </div>
                                        <div class="col-md-1 py-2">
                                            <h5 class="plot-label"><small></small></h5>
                                            <span><a href=""><i class="fa fa-grip-horizontal"></i></a></span>
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