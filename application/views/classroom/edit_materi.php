
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

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="file"></i></div>
                        Form Edit - Materi Pembelajaran
                    </h1>
                </div>
                 <div class="col-12 col-xl-auto mb-3">
                    <a href="<?=base_url('classroom/task/'.$uc_classroom.'/'.$uc_diklat_class)?>" class="btn btn-sm btn-light text-primary active mr-2">
                        <i data-feather="arrow-left"></i> Back
                    </a>
                </div>

            </div>
        </div>
    </div>
</header>

<div class="container">
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

        
        <div class=" col-md-8 mx-auto ">
            <?=form_open_multipart('classroom/update_content')?>
            <input type="hidden" name="f_uc_class" value="<?=$uc_classroom?>">
            <input type="hidden" name="f_uc_diklat_class" value="<?=$uc_diklat_class?>">
            <input type="hidden" name="f_uc" value="<?=$row->uc?>">
            <input type="hidden" name="f_lampiran_old" value="<?=$row->file_attach?>">
            <input type="hidden" name="f_category" value="2">
            <div class="form-group">
                <label>Judul</label>
                <input type="text" class="form-control" name="f_judul" value="<?=$row->content_title?>">
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea class="form-control" style="height: 230px;" name="f_deskripsi"><?=$row->content_description?></textarea>
            </div>

            <div class="form-group">
                <label>Lampiran File</label>
                
                <div class="row">
                    <?php $lampiran_file = list_content_not_file($row->uc)?>
                    <?php if(isset($lampiran_file)):?>
                        <?php foreach($lampiran_file as $lf):?>
                        <div class="col-md-4 ">
                            <div class="card bg-primary h-100">
                                <div class="card-body text-white text-center">
                                     <?=$lf->file_attach?>
                                </div>
                                <div class="card-footer">
                                    <a href="<?=base_url('uploads/materi/'.$lf->file_attach)?>" class="btn btn-light" title="Lihat Lampiran">
                                        <i data-feather="eye"></i>
                                    </a>
                                    
                                    <a href="#" class="btn btn-light btn-edit-lampiran" uc="<?=$lf->uc?>" data-toggle="modal" data-target="#modals-edit-lampiran" title="Edit Lampiran">
                                        <i data-feather="edit"></i>
                                    </a>

                                    <button class="btn btn-light " data-toggle="modal" data-target="#modals-delete-<?=$lf->id?>">
                                            <i data-feather="trash"></i>
                                        </button>

                                        <div class="modal fade" id="modals-delete-<?=$lf->id?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
                                                        <a href="<?=base_url('classroom/delete_lampiran_file/'.$lf->uc.'/'.$uc_classroom.'/'.$uc_diklat_class.'/'.$row->uc)?>" lass="btn btn-danger">
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
                    <?php else:?>
                        <div class="col-md-12">
                            <div class="alert alert-danger alert-solid text-center" role="alert">File Tidak Tersedia</div>
                        </div>
                    <?php endif;?>
                </div>
            </div>

           
            <div class="form-group">
                <label>Add Lampiran</label>

                <input type="file" name="files[]" id="filer_input" multiple="multiple" >

                <span class="text-danger">Perhatian : Jika ingin menambahkan, silahkan pilih lampiran kembali</span>
            </div>

            <div class="form-group">
                <label>Lampiran Link</label>
                
                <div class="row">
                    <?php $lampiran_link = list_content_file(array('uc_content' => $row->uc, 'type' => 'link'))?>
                    <?php if(isset($lampiran_link)):?>
                        <?php foreach($lampiran_link as $ll):?>
                        <div class="col-md-4 ">
                            <div class="card bg-warning h-100">
                                <div class="card-body text-white text-center">
                                     <?=$ll->file_attach?>
                                </div>
                                <div class="card-footer">
                                    <a href="<?=$ll->file_attach?>" class="btn btn-light" title="Lihat Lampiran">
                                        <i data-feather="eye"></i>
                                    </a>
                                    
                                    <a href="#" class="btn btn-light btn-edit-link" uc="<?=$ll->uc?>" data-toggle="modal" data-target="#modals-edit-link" title="Edit Lampiran Link">
                                        <i data-feather="edit"></i>
                                    </a>

                                    <button class="btn btn-light " data-toggle="modal" data-target="#modals-delete-<?=$ll->id?>">
                                            <i data-feather="trash"></i>
                                        </button>

                                        <div class="modal fade" id="modals-delete-<?=$ll->id?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
                                                        <a href="<?=base_url('classroom/delete_lampiran_file/'.$ll->uc.'/'.$uc_classroom.'/'.$uc_diklat_class.'/'.$row->uc)?>" lass="btn btn-danger">
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
                    <?php else:?>
                        <div class="col-md-12">
                            <div class="alert alert-danger alert-solid text-center" role="alert">File Tidak Tersedia</div>
                        </div>
                    <?php endif;?>
                </div>
            </div>

            <div class="form-group">
                <label>Lampiran Link</label>
                <button id="add" class="btn btn-dark mt-2">Add</button>
            </div>



            <div class="form-group">
                <label>Section</label>
                <?php $list_section = list_section(array('uc_classroom' => $uc_classroom),'label_section','ASC');?>

                <select name="f_section" class="form-control form-control-lg" required="">
                    <option value="">--- Pilih ---</option>
                    <?php if(isset($list_section)):?>
                        <?php foreach($list_section as $ls):?>
                            <option value="<?=$ls->uc?>" <?=select_set($ls->uc,$row->uc_section)?>><?=$ls->section_label?></option>
                        <?php endforeach;?>
                    <?php endif;?>
                </select>
                
            </div>

            <input type="submit" class="btn btn-success" value="Kirim" name="f_store">
            <?=form_close()?>
        </div>
        
    </div>
</div>

 <div class="modal fade" id="modals-edit-lampiran" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog update-lampiran" role="document">
        
    </div>
</div>

 <div class="modal fade" id="modals-edit-link" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog update-link" role="document">
        
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        var base_url = $("#base-url").html();


        $('.btn-edit-lampiran').click(function(){

            var uc = $(this).attr('uc');

            var uc_class = $('input[name=f_uc_class]').val();
            var uc_diklat_class = $('input[name=f_uc_diklat_class]').val();
            var uc_content = $('input[name=f_uc]').val();

           $('.update-lampiran').load(base_url+'classroom/form_update_lampiran', {js_uc : uc, js_uc_class : uc_class, js_uc_diklat_class : uc_diklat_class, js_uc_content : uc_content});
        });

        $('.btn-edit-link').click(function(){

            var uc = $(this).attr('uc');

            var uc_class = $('input[name=f_uc_class]').val();
            var uc_diklat_class = $('input[name=f_uc_diklat_class]').val();
            var uc_content = $('input[name=f_uc]').val();

             $('.update-link').load(base_url+'classroom/form_update_link', {js_uc : uc, js_uc_class : uc_class, js_uc_diklat_class : uc_diklat_class, js_uc_content : uc_content});
        });


        


    });
</script>