<script type="text/javascript" src="<?=base_url('assets/js/tinymce.js')?>"></script>

<?php $this->load->view('classroom/info_class');?>

<div class="container-fluid">

    <div class="row mt-5 mb-5">
       
        <div class="col-md-3">

             <?php $this->load->view('classroom/menu_activity');?>
           
       </div>

        <div class="col-md-9">

            <div class="row">
                <div class="col-md-12">
                    <h1 class="mb-0 mt-3">Daftar Forum</h1>
                    <hr class="mt-2 mb-4">
                </div>
            </div>


            <div class="row mt-3">
                 <div class=" col-md-10 mx-auto ">
                    <div class="card card-collapsable">
                        <a class="card-header" href="#collapseCardExample" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <div class="avatar avatar-xl">
                                <img class="avatar-img img-fluid" src="<?=base_url('assets/img/illustrations/profiles/profile-1.png')?>">
                            </div>
                            Buat Topik Forum !
                            <div class="card-collapsable-arrow">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </a>
                        <div class="collapse" id="collapseCardExample">
                            <?=form_open_multipart('classroom/posting_forum')?>
                            <input type="hidden" name="f_uc_classroom" value="<?=$uc_classroom?>">
                            <input type="hidden" name="f_uc_diklat_class" value="<?=$uc_diklat_class?>">

                            <div class="card-body">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Topik Pembahasan" name="f_topic" required="">
                                </div>
                                <div class="form-group">
                                   <textarea id="editor" class="form-control " style="height: 230px;" name="f_topic_des" ></textarea>
                                </div>

                                <div class="form-group">
                                    <input type="file" class="form-control"  name="f_file_attach">
                                    <label>*)Pdf, Word, Excel, Powerpoint</label>
                                </div>

                                <input type="submit" name="f_posting" class="btn btn-success float-right mb-3" value="Posting">
                                
                            </div>
                           <?=form_close()?>
                        </div>
                    </div>
                </div>


            </div>
        
           <div class="row mt-3 load-data">
                <?php 

                    $data = NULL;
                    if (isset($result)) {
                        $data['result']         = $result;
                        $data['total_record']   = $total_record;
                        $data['pagination']     = $pagination;
                    }

                    $this->load->view('classroom/forum/content', $data);
                ?>
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