<?php $this->load->view('classroom/info_class');?>

<div class="container-fluid">

    <div class="row mt-5 mb-5">
       
        <div class="col-md-3">

             <?php $this->load->view('student/classroom/menu_activity');?>
           
       </div>

        <div class="col-md-9">

            <div class="row">
                <div class="col-md-12">
                    <h1 class="mb-0 mt-3">Forum Diskusi</h1>
                    <hr class="mt-2 mb-4">
                </div>
            </div>

            <div class="row mt-4 mb-4">

                <div class=" col-md-10 mx-auto ">

                    <div class="card card-icon lift lift-sm mb-4">
                        <div class="row no-gutters">
                            <div class="col-auto card-icon-aside bg-teal"><i class="text-white-50" data-feather="book"></i></div>
                            <div class="col">
                                <div class="card-body py-4">
                                    <h5 class="card-title text-teal mb-2"><?=$row->topic?></h5>
                                    <p class="card-text mb-1">
                                        <?=$row->topic_description?>
                                    </p>
                                    <div class="small text-muted">Posting : <?=time_format($row->create_time,'d M Y H:i')?></div>

                                  
                                    <br/>
                                     <?php if($row->file_attach != NULL):?>
                                    <a href="<?=base_url('uploads/materi/'.$row->file_attach)?>">
                                     <span class="badge badge-success">Download Lampiran</span>
                                    </a>

                                    <?php else:?>
                                        <span class="badge badge-warning">Lampiran Tidak Tersedia</span>
                                    <?php endif;?>

                                    
                                </div>

                            </div>
                        </div>
                    </div>

                    <button data-toggle="modal" data-target="#modals-view-form" type="button" class="btn btn-komentar btn-success float-right mb-3" uc="<?=$row->uc?>"><i class="ion ion-md-create"></i>&nbsp; Beri Komentar</button> 

                   


                </div>

        
            </div>

            <div class="load-comment">
               <?php $this->load->view('classroom/forum/load_comment'); ?>

               
            </div>

           
        </div>
       
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function(){
        var base_url = $("#base-url").html();

        
        $('.btn-komentar').click(function(){

            var uc_content = $(this).attr('uc');

           $('.load-form-view').load(base_url+'classroom/form_comment_forum',{js_uc_content : uc_content});
        });

        
    });
</script>

<div class="modal fade" id="modals-view-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content load-form-view">
           
        </div>
    </div>
</div>