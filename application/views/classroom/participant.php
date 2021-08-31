<header class="page-header page-header-dark bg-gradient-primary-to-secondary mb-1" >
    <div class="container" style="min-height: 90px">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-2">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="tag"></i></div>
                        [<?=$info->class_label?>] <?=$info->subject_title?>
                    </h1>
                    <div class="page-header-subtitle"><?=$info->full_name?></div>
                    <div class="page-header-subtitle">
                        <?=$info->diklat?>

                        | Tahun/Periode : <?php if($info->cat_diklat == 1):?>
                            <?=$info->tahun?>
                        <?php else:?>
                            <?=time_format($info->periode_mulai, 'd M Y').'<br/> s/d <br/>'.time_format($info->periode_selesai, 'd M Y')?>
                        <?php endif;?>
                         <br/>
                        <b><?=$info->prodi?><?=$info->label_dkp?></b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="row mt-4">
        <h1>Daftar Peserta Diklat</h1>
    </div>

    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                     <div class="row load-data mt-4">
                    
                            <?php 

                            $data = NULL;
                            if (isset($result)) {
                                $data['result']         = $result;
                                $data['total_record']   = $total_record;
                                $data['pagination']     = $pagination;
                            }

                            $this->load->view('classroom/content_participant', $data);
                        ?>
                        
                    </div>
                </div>
            </div>
        </div>
       
    </div>

</div>