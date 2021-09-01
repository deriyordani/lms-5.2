<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon">
                            <i class="fa fa-desktop"></i>
                        </div>
                        Dashboard
                    </h1>
                </div>
                
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="row">

        <div class="col-xxl-4 col-xl-12 mb-4">
            <div class="card h-100 card-waves">
                <div class="card-body h-100 d-flex flex-column justify-content-center py-5 py-xl-4 card-angles">
                    <div class="mr-4 mb-3 mb-sm-0">
                    <div class="small">
                        <span class="font-weight-500 text-primary"><?=time_format(current_time(), 'l')?></span>
                        · <?=time_format(current_time(), 'd F Y')?> · <label id="time"></label>
                    </div>
                </div>
                    <div class="row align-items-center">
                        <div class="col-xl-8 col-xxl-12">
                            <div class="text-center text-xl-left text-xxl-center px-4 mb-4 mb-xl-0 mb-xxl-4">
                                <h1 class="text-primary">Selamat Datang di E-Learning!</h1>

                                <p class="text-gray-700 mb-0 mt-1">
                                   <h4 class="text-gray-700">Hello <?=$this->session->userdata('log_full_name')?></h4>
                                
                                   Anda terdaftar sebagai <?php 

                                    $session_category = $this->session->userdata('log_category');

                                    if ($session_category == 1) {
                                        
                                        echo "Administrator";

                                    }elseif ($session_category == 2) {
                                        
                                        echo "Instructor";
                                    }
                                    elseif ($session_category == 3) {
                                        echo "Peserta Diklat";
                                    }
                                    elseif ($session_category == 4) {
                                        echo "Operator Prodi";
                                    }elseif ($session_category == 5) {
                                        echo "Operator DKP";
                                    }

                                ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-xxl-12 text-center"><img class="img-fluid" src="<?=base_url('assets/img/illustrations/statistics.svg')?>" style="max-width: 26rem"></div>
                    </div>
                    
                </div>
            </div>
        </div>
           
           
    </div>

    <div class="row">
        <div class="col-xxl-12 col-xl-12 mb-4">
                <div class="card card-header-actions h-100">
                    <div class="card-header">
                        Recent Activity
                    </div>
                    <div class="card-body">
                        <div class="timeline timeline-xs">
                            <?php if(isset($log)):?>
                                <?php foreach($log as $lg):?>
                            <div class="timeline-item">
                                <div class="timeline-item-marker">
                                    <div class="timeline-item-marker-text" style="width:10rem;"><?=time_format($lg->log_time, 'd M Y H:i')?></div>
                                    <div class="timeline-item-marker-indicator bg-green"></div>
                                </div>
                                <div class="timeline-item-content">
                                    <?=$lg->log_aksi?> "<?=$lg->log_item?>"
                                </div>
                            </div>
                        <?php endforeach;?>
                        <?php else:?>
                             <div class="col-md-12">
                                <div class="alert alert-red alert-solid text-center" role="alert">Empty..</div>
                            </div>
                        <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>