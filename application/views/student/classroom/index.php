<script type="text/javascript">



</script>

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            
        </div>
    </div>
</header>


<div class="container">

    <div class="row">

        <div class="col-md-12 mb-4">
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
                                
                                   Anda terdaftar sebagai Peserta Diklat
                                </p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-xxl-12 text-center">
                    

                            <img class="img-fluid" src="<?=base_url('assets/img/illustrations/at-work.svg')?>" style="max-width: 26rem">
                        </div>
                    </div>
                </div>
            </div>
        </div>
           
           
     </div>


 
    <div class="row align-items-center justify-content-between pt-3">
        <div class="col-auto mb-2">
            <h1 class="page-header-title">
                <div class="page-header-icon">
                    <i class="fa fa-boxes"></i> Classrooom Yang Diikuti
                </div>

            </h1>
        </div>
        
    </div>

    <div class="row mb-3 mt-2">
        <div class="col-md-12">
            <?php if($this->session->flashdata('info')):?>

                <?php $warning = $this->session->flashdata('info')?>
                <div class="alert <?=$warning['class']?> alert-icon" role="alert">
                    <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div class="alert-icon-aside">
                        <i class="fa <?=$warning['icon']?>"></i>
                    </div>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Pemberitahuan</h6>
                        <?=$warning['message']?>
                    </div>
                </div>
            <?php endif;?>
        </div>
    </div>

   

    <div class="row mt-2 load-data">
        
        <?php 

            $data = NULL;
            if (isset($result)) {
                $data['result']         = $result;
                $data['total_record']   = $total_record;
                $data['pagination']     = $pagination;
            }

            $this->load->view('student/classroom/content', $data);
        ?>
        
    </div>

</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content load-form">
           
        </div>
    </div>
</div>