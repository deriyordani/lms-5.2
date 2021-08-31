<?php $this->load->view('classroom/info_class');?>

<div class="container-fluid">

    <div class="row mt-5 mb-5">
       
        <div class="col-md-3">

             <?php $this->load->view('classroom/menu_activity');?>
           
       </div>

        <div class="col-md-9">

            <div class="row">
                <div class="col-md-12">
                    <h1 class="mb-0 mt-3">Daftar Tugas Peserta</h1>
                    <hr class="mt-2 mb-4">
                </div>
            </div>

            <div class="row">
           <!--  <div class="col-md-12 text-center">



                <a href="<?=base_url('classroom/content/view_assigment/'.$uc_classroom.'/'.$uc_diklat_class.'/'.$uc_content)?>" class="btn btn-outline-primary btn-sm rounded-0 shadow-sm px-4 py-3  mr-2 my-1">
                     <i class="mr-1" data-feather="file-text"></i> Informasi Tugas
                </a>

                <a href="<?=base_url('classroom/tugas_terkumpul/'.$uc_classroom.'/'.$uc_diklat_class.'/'.$uc_content)?>" class="btn  btn-primary btn-sm rounded-0 shadow-sm px-4 py-3  mr-2 my-1">
                     <i class="mr-1" data-feather="users"></i> Tugas Terkumpul
                </a>

            </div> -->
        </div>

        <input type="hidden" name="f_classroom" value="<?=$uc_classroom?>">
        <input type="hidden" name="f_uc_diklat_class" value="<?=$uc_diklat_class?>">
        <input type="hidden" name="f_uc_content" value="<?=$uc_content?>">

        <div class="row mt-4 mb-4 load-data">

            <?php 

                $data = NULL;
                if (isset($result)) {
                    $data['result']         = $result;
                    $data['total_record']   = $total_record;
                    $data['pagination']     = $pagination;
                }

                $this->load->view('classroom/assignment/content_assig_siswa', $data);
            ?>
    
        </div>



           
        </div>
       
    </div>

</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content load-form">
           
        </div>
    </div>
</div>