<script type="text/javascript" src="<?=base_url('assets/js/tinymce.js')?>"></script>

    <link href="<?=base_url('assets/css/jquery.filer.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/css/themes/jquery.filer-dragdropbox-theme.css')?>" rel="stylesheet">

    <!-- Jvascript -->
   <!--  <script src="http://code.jquery.com/jquery-3.1.0.min.js" crossorigin="anonymous"></script> -->
    <script src="<?=base_url('assets/js/jquery.filer.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('assets/js/custom.js')?>" type="text/javascript"></script>
<script type="text/javascript">
        $(function() {
            $('#add').on('click', function( e ) {
                e.preventDefault();
                $('<div/>').addClass( 'new-text-div' )
                .html( $('<input type="textbox" name="f_multi_link[]"/>').addClass( 'form-control mt-3' ) )
                .append( $('<button/>').addClass( 'remove btn btn-danger' ).text( 'Remove' ) )
                .insertBefore( this );
            });
            $(document).on('click', 'button.remove', function( e ) {
                e.preventDefault();
                $(this).closest( 'div.new-text-div' ).remove();
            });
        });
</script>
<?php $this->load->view('classroom/info_class');?>

<div class="container-fluid">

    <div class="row mt-5 mb-5">
       
        <div class="col-md-3">

             <?php $this->load->view('classroom/menu_activity');?>
           
       </div>

        <div class="col-md-9">

            <div class="row">
                <div class="col-md-12">
                    <h1 class="mb-0 mt-3">Update Forum</h1>
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
                <div class=" col-md-12 mx-auto ">
                   <div class="card">
                       <div class="card-body">
                           <?=form_open_multipart('classroom/update_forum')?>
                           <input type="hidden" name="f_uc_class" value="<?=$uc_classroom?>">
                            <input type="hidden" name="f_uc_diklat_class" value="<?=$uc_diklat_class?>">
                            <input type="hidden" name="f_uc" value="<?=$row->uc?>">

                                <div class="form-group">
                                    <label>Topik Forum</label>
                                    <input type="text" class="form-control" name="f_topic" required="" value="<?=$row->topic?>">
                                </div>
                                <div class="form-group">
                                    <label>Pembahasan</label>
                                    <textarea id="editor" class="form-control " style="height: 230px;" name="f_topic_des"><?=$row->topic_description?></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Lampiran File</label>
                                    
                                    <div class="row">
                                        <?php $lampiran_file = list_forum_file(array('uc_forum' => $row->uc))?>
                                        <?php if(isset($lampiran_file)):?>
                                            <?php foreach($lampiran_file as $lf):?>
                                                <div class="col-md-3 ">
                                                    <div class="card bg-warning h-100">
                                                        <div class="card-body text-white text-center">
                                                            <a href="<?=base_url('uploads/materi/'.$lf->file_attach)?>"  title="Lihat Lampiran"><?=$lf->file_attach?></a>
                                                        </div>
                                                        <div class="card-footer">


                                                            <a href="#" class="btn btn-light btn-edit-lampiran" uc="<?=$lf->uc?>" data-toggle="modal" data-target="#modals-edit-lampiran" title="Edit Lampiran">
                                                                <i data-feather="edit"></i>
                                                            </a>

                                                            <a href="#" class="btn btn-light btn-edit-lampiran" uc="<?=$lf->uc?>" data-toggle="modal" data-target="#modals-delete-lampiran-<?=$lf->id?>" title="Hapus Lampiran">
                                                                <i data-feather="trash"></i>
                                                            </a>

                                                            <div class="modal fade" id="modals-delete-lampiran-<?=$lf->id?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

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

                                                                            <a href="<?=base_url('classroom/delete_lampiran_forum/'.$lf->uc.'/'.$uc_classroom."/".$uc_diklat_class.'/'.$uc_forum)?>" class="btn btn-danger">
                                            Delete
                                        </a>

                                                                            <button class="btn btn-light" type="button" data-dismiss="modal">Cancel</button>

                                                                        </div>

                                                                    </div>
                                                                </div>

                                                            </div>


                                                        </div>
                                                    </div>

                                                </div>



                                            <?php endforeach;?>
                                        <?php endif;?>
                                    </div>
                                    
                                </div>


                                <div class="form-group">
                                    <label>Add Lampiran</label>

                                    <input type="file" name="files[]" id="filer_input" multiple="multiple" >

                                    <span class="text-danger">Perhatian : Jika ingin menambahkan, silahkan pilih lampiran kembali</span>
                                </div>




                                <input type="submit" class="btn btn-success" value="Kirim" name="f_store">
                            <?=form_close()?>
                       </div>
                   </div>
                    
                </div>
                        
    
            </div>

        </div>
       
    </div>

</div>