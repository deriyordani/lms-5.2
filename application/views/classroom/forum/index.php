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
                    <h1 class="mb-0 mt-3">Daftar Forum</h1>
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
                                    <label>Lampiran File</label>
                                    <!-- <input type="file" class="form-control" name="f_lampiran"> -->

                                    <input type="file" name="files[]" id="filer_input" multiple="multiple" >
                                    
                                    <span class="text-danger">Perhatian : Jika ingin menambahkan, silahkan pilih lampiran kembali</span>
                                </div>

                               <!--  <div class="form-group">
                                    <input type="file" class="form-control"  name="f_file_attach">
                                    <label>*)Pdf, Word, Excel, Powerpoint</label>
                                </div> -->

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