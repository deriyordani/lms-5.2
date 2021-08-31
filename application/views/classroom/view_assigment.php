<?php $this->load->view('classroom/info_class');?>

<div class="container-fluid">

    <div class="row mt-5 mb-5">
       
        <div class="col-md-3">

             <?php $this->load->view('classroom/menu_activity');?>
           
       </div>

        <div class="col-md-9">

            <div class="row">
                <div class="col-md-12">
                    <h1 class="mb-0 mt-3">Informasi Tugas</h1>
                    <hr class="mt-2 mb-4">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-center">



                    <a href="<?=base_url('classroom/content/view_assigment/'.$uc_classroom.'/'.$uc_diklat_class.'/'.$uc_content)?>" class="btn btn-primary btn-sm rounded-0 shadow-sm px-4 py-3  mr-2 my-1">
                         <i class="mr-1" data-feather="file-text"></i> Informasi Tugas
                    </a>

                    <a href="<?=base_url('classroom/tugas_terkumpul/'.$uc_classroom.'/'.$uc_diklat_class.'/'.$uc_content)?>" class="btn btn-outline-primary btn-sm rounded-0 shadow-sm px-4 py-3  mr-2 my-1">
                         <i class="mr-1" data-feather="users"></i> Tugas Terkumpul
                    </a>

                </div>
            </div>

            <div class="row mt-4 mb-4">

                <div class=" col-md-10 mx-auto ">
                    <div class="card lift lift-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title text-primary mb-2">
                                <i class="mr-2" data-feather="edit-2"></i> Deskripsi Tugas
                            </h5>
                            <p class="card-text mb-1">
                                
                               <?=$row->content_description?>

                               <br/>
                                <?php if($row->file_attach != NULL):?>
         

                                    <a class="btn btn-success" href="<?=base_url('uploads/materi/'.$row->file_attach)?>">
                                        <i class="fa fa-3x fa-file"></i> &nbsp; Download Lampiran
                                    </a>

                                <?php else:?>
                                        <a class="btn btn-warning" href="#">
                                            <i class="fa fa-3x fa-file"></i> &nbsp; File Tidak Tersedia
                                        </a>
                                <?php endif;?>
                            </p>



                            <button data-toggle="modal" data-target="#modals-view-form" type="button" class="btn btn-komentar btn-success float-right mb-2" uc="<?=$row->uc?>"><i class="ion ion-md-create"></i>&nbsp; Beri Komentar</button> 
                        </div>
                    </div>


                </div>


            </div>

             <div class="load-comment">
               <?php $this->load->view('classroom/load_comment'); ?>

               
            </div>

        
       

            

           
        </div>
       
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function(){
        var base_url = $("#base-url").html();

        
        $('.btn-komentar').click(function(){

            var uc_content = $(this).attr('uc');

           $('.load-form-view').load(base_url+'classroom/form_comment',{js_uc_content : uc_content});
        });

        
    });
</script>

<div class="modal fade" id="modals-view-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content load-form-view">
           
        </div>
    </div>
</div>