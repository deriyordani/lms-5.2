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
                    <div class="row">
                        <div class="col col-md-12">
                            <h2 class="text-primary">PRESENSI INSTRUKTUR </h2>
                        </div>
                    </div>
                    <div class="row mb-3 mt-2">
                        <div class="col-md-7">
                            <h5>Instruktur</h5>
                            <span>(<?=$id_number?>) <?=$full_name?></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-7">
                            <h5>Periode</h5>
                            <span>
                                <?php 
                                    if ($info->category == 1) {
                                        $label_periode = $info->label_periode." (".$info->tahun.")";
                                    }
                                    else {
                                        $label_periode = $info->label_periode." (".time_format($info->periode_mulai,"d M Y")." - ".time_format($info->periode_selesai,"d M Y").")";
                                    }
                                ?>
                                <?=$label_periode?>
                            </span>
                        </div>
                        <div class="col-md-4">
                            <h5>Kelas</h5>
                            <span><?=$info->class_label?></span>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                                <table class="table table-bordered table-hover" cellspacing="0">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <?php foreach($section as $sect_row) : ?>
                                                <th align="center"><?=$sect_row->sequence?></th>
                                            <?php endforeach; ?>
                                            <th align="center">Hadir</th>
                                            <th align="center">Ijin</th>
                                            <th align="center">Sakit</th>
                                            <th align="center">Alpa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <tr>
                                            <?php
                                                $presence_hadir = 0;
                                                $presence_ijin = 0;
                                                $presence_sakit = 0;
                                                $presence_alpa = 0;
                                            ?>
                                            <?php foreach ($section as $sec) : ?>
                                                <?php
                                                    $sign = "-";
                                                    $presence_alpa++;
                                                    $uc_section = $sec->uc;

                                                    if (@$kehadiran[$uc_section]['status']) {
                                                        $status = $kehadiran[$uc_section]['status'];
                                                        if($status == 1){
                                                            $sign = "✓";
                                                            $presence_hadir++;
                                                            $presence_alpa--;
                                                        } elseif($status == 2){
                                                            $sign = "S";
                                                            $presence_sakit++;
                                                            $presence_alpa--;
                                                        } elseif($status == 3){
                                                            $sign = "I";
                                                            $presence_ijin++;
                                                            $presence_alpa--;
                                                        }
                                                    }
                                                    else {
                                                        $sign = "-";
                                                    }    
                                                ?>
                                                <td align="center">
                                                    <?=$sign?>
                                                </td>
                                            <?php endforeach; ?>
                                            <td align="center"><?=$presence_hadir?></td>
                                            <td align="center"><?=$presence_ijin?></td>
                                            <td align="center"><?=$presence_sakit?></td>
                                            <td align="center"><?=$presence_alpa?></td>   
                                        </tr>
                                            
                                    </tbody>
                                    
                                </table>
                                
                            </div>        

                </div>
            </div>
            
        </div>
    </div>

</div>