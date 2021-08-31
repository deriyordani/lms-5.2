<?php $this->load->view('classroom/info_class');?>

<div class="container-fluid">

    <div class="row mt-5 mb-5">
       
        <div class="col-md-3">

             <?php $this->load->view('classroom/menu_activity');?>
           
       </div>

        <div class="col-md-9">

            <div class="row">
                <div class="col-md-12">
                    <h1 class="mb-0 mt-3">Forum Diskusi</h1>
                    <hr class="mt-2 mb-4">
                </div>
            </div>

            <div class="row mt-4 mb-4">
                <div class="col-md-12">
                    <div class="card card-icon mb-3">
                        <div class="row no-gutters">
                            <div class="col-auto card-icon-aside bg-primary"><i class="text-white-50" data-feather="book"></i></div>
                            <div class="col">
                                <div class="card-body py-5">
                                      <h3 class="card-title text-teal mb-2"><?=$row->topic?></h3>
                                    <p class="card-text mb-1">
                                        <?=$row->topic_description?>


                                        <div class="small text-muted">Posting : <?=time_format($row->create_time,'d M Y H:i')?></div>

                                    </p>
                                    
                                    

                                    <?php if($row->file_attach != NULL):?>
                             

                                        <a class="btn btn-success" href="<?=base_url('uploads/materi/'.$row->file_attach)?>">
                                            <i class="fa fa-3x fa-file"></i> &nbsp; Download Lampiran
                                        </a>

                                    <?php else:?>
                                              <a class="btn btn-warning" href="#">
                                                <i class="fa fa-3x fa-file"></i> &nbsp; File Tidak Tersedia
                                            </a>
                                    <?php endif;?>


                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
               <div class="col-md-12">
                   <button data-toggle="modal" data-target="#modals-group" type="button" class="btn btn-group btn-success float-right mb-2" uc="<?=$row->uc?>"><i class="fa fa-users"></i>&nbsp; Buat Kelompok</button> 
               </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h1 class="mb-0 mt-3">Daftar Kelompok</h1>
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


            <div class="row mt-4 mb-4">

                <?php if (isset($kelompok)) : ?>
                    <?php foreach ($kelompok as $kl) : ?>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body text-center p-5">
                                <img class="img-fluid mb-5" src="<?=base_url()?>assets/img/illustrations/data-report.svg">
                                <h4><?=$kl->group_name?></h4>
                                
                                <br/>
                                <a href="<?=base_url('classroom/view_forum/'.$uc_classroom.'/'.$uc_diklat_class.'/'.$uc_forum.'/'.$kl->uc)?>" class="btn btn-info" title="Aktivitas Forum">
                                    <i class="fa fa-search"> </i>
                                </a>

                                <button class="btn btn-warning btn-edit-group" uc-classroom="<?=$uc_classroom?>"  uc-diklat-class="<?=$uc_diklat_class?>" uc-forum="<?=$kl->uc_forum?>" uc-group="<?=$kl->uc?>" title="Edit" data-toggle="modal" data-target="#modals-view-form">
                                    <i class="fa fa-pencil-alt"> </i>
                                </button>

                        

                                <button class="btn btn-danger " data-toggle="modal" data-target="#modals-delete-<?=$row->id?>">
                                    <i class="mr-1 fa fa-trash-alt" ></i>
                                </button>

                                <div class="modal fade" id="modals-delete-<?=$row->id?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Warning</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="text-center"><i class="fa fa-info-circle" ></i> Do you really want to delete this record ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="<?=base_url('classroom/delete_group_forum/'.$uc_classroom.'/'.$uc_diklat_class.'/'.$uc_forum.'/'.$row->uc)?>" lass="btn btn-danger">
                                                    Delete
                                                </a>

                                                <button class="btn btn-light" type="button" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               <!--  <a class="btn btn-primary p-3" href="<?=base_url('student/classroom/section/'.$uc_classroom.'/'.$uc_diklat_class.'/'.$uc_content.'/'.$sec->uc_tpack.'/'.$sec->uc.'/'.$sec->sequence)?>">Continue</a> -->
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                
                <?php else : ?> 
                    Empty
                <?php endif; ?> 
            </div>

        </div>
       
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function(){
        var base_url = $("#base-url").html();

        $('.btn-edit-group').click(function(){

            var uc_classroom = $(this).attr('uc-classroom');
            var uc_diklat_class = $(this).attr('uc-diklat-class');
            var uc_forum = $(this).attr('uc-forum');
            var uc_group = $(this).attr('uc-group');

            $('.load-form-view').load(base_url+'classroom/edit_group_forum',{js_uc_classroom : uc_classroom, js_uc_diklat_class : uc_diklat_class, js_uc_forum : uc_forum, js_uc_group : uc_group});
            
        });

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

<div class="modal fade" id="modals-group" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content load-form-group">
            <?=form_open('classroom/create_group', array('autocomplate' => 'off'))?>
            <input type="hidden" name="f_uc_forum" value="<?=$uc_forum?>">
            <input type="hidden" name="f_uc_classroom" value="<?=$uc_classroom?>">
            <input type="hidden" name="f_uc_diklat_class" value="<?=$uc_diklat_class?>">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buat Kelompok</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Kelompok</label>
                    <input type="text" name="f_group_name" class="form-control" required="">
                </div>
                <div class="form-group">
                    <label>Sertakan Anggota Kelompok :</label>
                    <?php if(isset($participant)):?>
                        <?php foreach($participant as $pa):?>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" id="customCheck<?=$pa->id?>" type="checkbox" value="<?=$pa->uc?>" name="f_participant[]">
                                <label class="custom-control-label" for="customCheck<?=$pa->id?>"><?=$pa->no_peserta?> - <?=$pa->full_name?></label>
                            </div>
                        <?php endforeach;?>
                    <?php endif;?>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" name="f_create_group" class="btn btn-primary" value="Save">
            </div>

            <?=form_close();?>
        </div>
    </div>
</div>