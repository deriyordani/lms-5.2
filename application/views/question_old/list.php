<?php $this->load->view('classroom/info_class');?>

<div class="container-fluid">

    <div class="row mt-5 mb-5">
       
        <div class="col-md-3">

             <?php $this->load->view('classroom/menu_activity');?>
           
       </div>

        <div class="col-md-9">

            <div class="row">
                <div class="col-md-12">
                    <h1 class="mb-0 mt-3">Daftar Soal</h1>
                    <hr class="mt-2 mb-4">
                </div>
            </div>

            <div class="row">
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

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-header-actions">
                    <div class="card-header">
                        
                        <a href="<?=base_url('question/add/'.$uc_classroom.'/'.$uc_diklat_class.'/'.$uc_subject)?>" class="btn btn-primary btn-sm">Add</a>
                    </div>
                    <div class="card-body ">

                        <!-- <div class="row">
                           <div class="col-md-3">
                                <select name="f_kategori" class="form-control">
                                    <option value="">---Pilih---</option>
                                    <option value="1">Pembentukan</option>
                                    <option value="2">Peningkatan</option>
                                    <option value="3">Short Course</option>
                                </select>
                           </div>
                           <div class="col-md-2">
                                <button class="btn btn-info btn-search"><i class="fa fa-search"></i> &nbsp;Search</button>
                           </div>
                        </div> -->
                        
                        <div class="row load-data mt-4">
                            
                                <?php 

                                $data = NULL;
                                if (isset($result)) {
                                    $data['result']         = $result;
                                    $data['total_record']   = $total_record;
                                    $data['pagination']     = $pagination;
                                }

                                $this->load->view('question/content', $data);
                            ?>
                            
                        </div>
                            
                            
                      
                        
                    </div>
                </div>
                </div>
                
            </div>



        </div>
       
    </div>

</div>


<div class="modal fade" id="modals-view-question" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content load-form-view">
           
        </div>
    </div>
</div>