<?php $this->load->view('classroom/info_class');?>

<div class="container-fluid">
     <div class="row mt-5 mb-5">
       
        <div class="col-md-3">

             <?php $this->load->view('student/classroom/menu_activity');?>
           
       </div>

        <div class="col-md-9">

            <div class="row">
                <div class="col-md-12">
                    <h1 class="mb-0 mt-3">Informasi Tugas</h1>
                    <hr class="mt-2 mb-4">
                </div>
            </div>

            <div class="row mt-2">
               <div class="col-md-8">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card lift lift-sm mb-4">
                            <div class="card-body">
                                <h5 class="card-title text-primary mb-2">
                                    <i class="mr-2" data-feather="edit-2"></i> Deskripsi Tugas
                                </h5>
                                <p class="card-text mb-1">
                                    
                                   <?=$row->content_description?>


                                   <div class="row">
                                        <!-- <label><b>Lampiran File</b></label> -->

                                        <?php $lampiran_file = list_content_file(array('uc_content' => $uc_content))?>

                                        <?php if(isset($lampiran_file)):?>
                                            <?php foreach($lampiran_file as $lf):?>
                                                <div class="col-md-4 btn btn-warning ml-3">
                                                    <a  class=" w-100 text-white" href="<?=base_url('uploads/materi/'.$lf->file_attach)?>">
                                                   <?=$lf->file_attach?>
                                                    </a>
                                               </div>
                                            <?php endforeach;?>
                                        <?php else:?>
                                            <div class="col-md-12">
                                                <div class="alert alert-danger alert-solid text-center" role="alert">File Tidak Tersedia</div>
                                            </div>
                                        <?php endif;?>
                                      
                                   </div>
                                   <!-- <br/>
                                     <?php if($row->file_attach != NULL):?>
                                    <a href="<?=base_url('uploads/materi/'.$row->file_attach)?>">
                                     <span class="badge badge-success">Download Lampiran</span>
                                    </a>

                                    <?php else:?>
                                        <span class="badge badge-warning">Lampiran Tidak Tersedia</span>
                                    <?php endif;?> -->
                                </p>



                                <button data-toggle="modal" data-target="#modals-view-form" type="button" class="btn btn-komentar btn-success float-right mb-2" uc="<?=$row->uc?>"><i class="ion ion-md-create"></i>&nbsp; Beri Komentar</button> 
                            </div>
                        </div>


                    </div>
                </div>

                <hr/>



                <div class="load-comment">
                   <?php $this->load->view('student/classroom/load_comment'); ?>
                </div>
                   
               </div>
               <div class="col-md-4 mb-4">

                    <?php if(!$assignment_check):?>
                    <div class="card lift lift-sm mb-3">

                        <?=form_open_multipart('student/classroom/send_assignment_update')?>
                        <input type="hidden" name="f_uc_classroom" value="<?=$uc_classroom?>">
                        <input type="hidden" name="f_uc_diklat_class" value="<?=$uc_diklat_class?>">
                        <input type="hidden" name="f_uc_content" value="<?=$uc_content?>">
                        <input type="hidden" name="f_uc" value="<?=$row_assign->uc?>">
                        <input type="hidden" name="f_file_old" value="<?=$row_assign->file_attach?>">
                        <div class="card-body">
                            <h5 class="card-title text-primary mb-2">
                                <i class="mr-2" data-feather="monitor"></i> Status Tugas
                            </h5>

                             <p class="card-text mb-1">
                               
                               <hr>
                               <label><b>File</b></label>
                               <br>
                              <a href="<?=base_url('uploads/assignment/'.$row_assign->file_attach)?>">
                               <span class="badge badge-info">Lihat Tugas Saya</span>
                             </a>
                               <br>

                               <?php if($row_assign->score == NULL):?>
                                 <label><b>Replace File</b></label>
                                 <br>

                                  <input type="file" class="form-control"  name="f_file_attach_update" required="">

                                  <input type="submit" class="btn btn-dark mt-3 " value="Kirim Ulang Tugas" name="f_submit_replace">

                                 <p class="text-danger mt-2">
                                     Perhatian : Tugas masih dapat diganti (upload ulang) selama belum mendapatkan score/komentar dari Instruktur
                                 </p>

                             <?php endif;?>

                               <hr/>

                               <label><b>Tgl. Kirim</b></label>
                               <br>
                               <?=time_format($row_assign->submit_time,'d M Y H:i')?>
                               <br>
                               <label><b>Score</b></label>
                               <br>
                               <?=($row_assign->score == NULL ? '<span class="badge badge-warning">Belum Tersedia</span>' : $row_assign->score)?>
                               <br>
                               <label><b>Komentar</b></label>
                               <br>
                               <p><?=($row_assign->comment == NULL ? '-' : $row_assign->comment)?></p>

                            </p>
                        </div>

                        <?=form_close()?>
                    </div>
                    <?php endif;?>

                    <?php if($assignment_check):?>

                       <div class="card lift lift-sm mb-3" >

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

                                <?=form_open_multipart('student/classroom/send_assignment')?>
                                    <input type="hidden" name="f_uc_classroom" value="<?=$uc_classroom?>">
                                    <input type="hidden" name="f_uc_diklat_class" value="<?=$uc_diklat_class?>">
                                    <input type="hidden" name="f_uc_content" value="<?=$uc_content?>">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary mb-3">
                                            <i class="mr-2" data-feather="upload-cloud"></i>
                                           Upload Tugas
                                        </h5>
                                        
                                       
                                          <input type="file" class="form-control"  name="f_file_attach" required="">
                                        

                                        <p class="small text-muted mt-2">
                                            Format *) .pdf/.docx/.zip/.ppt<br/>
                                            <label class="text-danger">Max Size File 5 MB</label>
                                        </p>

                                         <p class="text-danger mt-2">
                                     Perhatian : Tugas masih dapat diganti (upload ulang) selama belum mendapatkan score/komentar dari Instruktur
                                 </p>

                                    </div>
                                    <div class="card-footer">
                                        <input type="submit" class="btn btn-dark " value="Kirim Tugas" name="f_submit">
                                    </div>
                                <?=form_close()?>
                        </div>

                    <?php endif;?>

                    
               </div>
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