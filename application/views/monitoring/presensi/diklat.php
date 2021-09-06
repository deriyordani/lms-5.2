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
                    <form class="form-row" method="post" action="<?=base_url('monitoring/presensi/periode')?>" >
                    -->
                    <div class="row">
                        <input type="hidden" name="f_log_category" value="<?=$this->session->userdata('log_category')?>" />
                        <?php if ($this->session->userdata('log_category') != 5) : ?>
                            <div class="col-md-3">

                                <select name="f_diklat" class="form-control form-control-lg select-diklat">
                                    <?php 
                                        $list_diklat = list_diklat();
                                        if(isset($list_diklat)):
                                            ?>
                                            <option value="">---Pilih Program Diklat---</option>
                                            
                                            <?php foreach($list_diklat as $ld):?>
                                                <?php if ($ld->uc != 'DKP') : ?>
                                                    <option value="<?=$ld->uc?>"><?=$ld->diklat?></option>
                                                <?php else : ?>
                                                    <?php if ($this->session->userdata('log_category') == 1) :  ?>
                                                        <option value="<?=$ld->uc?>"><?=$ld->diklat?></option>
                                                    <?php endif; ?>    
                                                <?php endif; ?>
                                            <?php endforeach;?>
                                    <?php endif;?>
                                </select>

                            </div>
                        <?php else : ?>
                            <input type="hidden" name="f_diklat" value="DKP">
                        <?php endif; ?>

                        <div class="col-md-5 select-program">
                            <?php if ($this->session->userdata('log_category') == 4) : ?>
                                <input type="hidden" name="f_prodi" value="<?=$this->session->userdata('log_uc_prodi')?>">
                                <select class="form-control form-control-lg" disabled="">
                                    <?php 
                                        $list_prodi = list_prodi();
                                        if(isset($list_prodi)):
                                            ?>
                                            <option value="">---Pilih Prodi---</option>
                                                <?php foreach($list_prodi as $lp):?>
                                                    <option value="<?=$lp->uc?>" <?=select_set($lp->uc, $this->session->userdata('log_uc_prodi'))?>><?=$lp->prodi?></option>
                                                <?php endforeach;?>
                                    <?php endif;?>
                                </select>
                            <?php elseif ($this->session->userdata('log_category') == 5): ?>
                                <select name="f_diklat_dkp" class="form-control form-control-lg">
                                    <?php 
                                        $list_prodi = list_dkp();
                                        if(isset($list_prodi)):
                                            ?>
                                            <option value="">---Pilih Program---</option>
                                                <?php foreach($list_prodi as $lp):?>
                                                    <option value="<?=$lp->uc?>"><?=$lp->label_dkp?></option>
                                                <?php endforeach;?>
                                    <?php endif;?>
                                </select>
                            <?php else : ?>
                                <select name="f_prodi" class="form-control form-control-lg">
                                    <?php 
                                        $list_prodi = list_prodi();
                                        if(isset($list_prodi)):
                                            ?>
                                            <option value="">---Pilih Prodi---</option>
                                                <?php foreach($list_prodi as $lp):?>
                                                    <option value="<?=$lp->uc?>"><?=$lp->prodi?></option>
                                                <?php endforeach;?>
                                    <?php endif;?>
                                </select>
                            <?php endif; ?>
                       </div>
                    
                       <div class="col-md-2">
                            <button class="btn btn-info btn-ok-presensi">OK</button>
                       </div>
                    </div>  
                        <!--
                    </form> 
                    -->   
                </div>
                <div class="card-body content-presensi">

                </div>
            </div>
            
        </div>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function(){
        var base_url = $("#base-url").html();

        $('.btn-ok-presensi').click(function(){         
            var log_category = $('input[name=f_log_category]').val();

            if (log_category != 5) {
                var diklat = $('select[name=f_diklat] option:selected').val();

                if (log_category == 4) {
                    var prodi = $('input[name=f_prodi]').val();
                }
                else {
                    var prodi = $('select[name=f_prodi] option:selected').val();
                }
                
            }
            else {
                var diklat = $('input[name=f_diklat]').val();
            }
            
            var program = $('select[name=f_diklat_dkp] option:selected').val();

            $('.content-presensi').load(base_url+'monitoring/presensi/periode_ajax', {js_prodi : prodi, js_diklat : diklat, js_program : program});

            return false;
        });
    });
</script>