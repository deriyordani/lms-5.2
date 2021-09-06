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
                        Presensi Instruktur
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
                    <div class="row">
                        <div class="col-md-7">
                            <h5>Diklat</h5>
                            <h4 class="text-black">
                                <?=$info->diklat?> - <?=$info->prodi?>
                                
                            </h4>
                        </div>
                        <div class="col-md-3 ml-auto text-right">
                            <a href="<?=base_url('monitoring/presensi/diklat')?>" class="text-warning" style="font-size: 20pt">
                                <i class="fa fa-chevron-circle-left"></i>
                            </a>
                        </div>    
                    </div>
                </div>
                <div class="card-body">
                        
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
                                            <h5 class="plot-label"><small>Subject</small></h5>
                                            <span><?=$res->subject_title?></span>
                                        </div>
                                        <div class="col-md-4 py-2">
                                            <h5 class="plot-label"><small>Classroom</small></h5>
                                            <span>
                                                <?php 
                                                if ($res->classroom_title != NULL) {
                                                    $classroom_title = $res->classroom_title;
                                                }
                                                else {
                                                    $classroom_title = "-";
                                                }
                                                ?>
                                                <?=$classroom_title?>    
                                            </span>
                                        </div>
                                        <div class="col-md-2 py-2">
                                            <h5 class="plot-label"><small>Instructor</small></h5>
                                            <span>
                                                <?php 
                                                if ($res->full_name != NULL) {
                                                    $instructor_name = $res->full_name;
                                                }
                                                else {
                                                    $instructor_name = "-";
                                                }
                                                ?>
                                                <?=$instructor_name?>
                                            </span>
                                        </div>
                                        <div class="col-md-1 py-2">
                                            <?php if ($res->classroom_title != NULL) : ?>
                                                <h5 class="plot-label"><small></small></h5>
                                                <a href="<?=base_url('monitoring/presensi/rekap/'.$res->uc_classroom.'/'.$res->uc_diklat_class)?>" title="Presensi"><i class="fa fa-calendar-check text-success"></i></a>
                                            <?php endif; ?>     
                                        </div> 
                                    </div>
                                </div>
                                <?php $i++; ?>
                            <?php endforeach; ?>

                        <?php else : ?>
                            Kosong
                        <?php endif; ?> 

                </div>
            </div>
            
        </div>
    </div>

</div>