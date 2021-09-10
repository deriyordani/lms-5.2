<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="file"></i></div>
                        Master - User Management
                    </h1>
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
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">

                    <?php

                        $active_ins = 'active';
                        $active_prodi = '';
                        $active_admin = '';
                        if ( $this->uri->segment('3') == 'instruktur') {
                            $active_ins = 'active bg-dark';
                            $active_prodi = '';
                            $active_admin = '';
                        }elseif ($this->uri->segment('3') == 'prodi') {
                            $active_prodi = 'active bg-dark';
                            $active_ins = '';
                            $active_admin = '';
                        }elseif ($this->uri->segment('3') == 'admin') {
                            $active_admin = 'active bg-dark';
                            $active_prodi = '';
                            $active_ins = '';
                        }

                    ?>

                    <ul class="nav nav-pills card-header-pills" id="cardPill" role="tablist">
                        <li class="nav-item"><a class="nav-link  <?=$active_ins?>" id="overview-pill" href="<?=base_url('users/lists/instruktur/2')?>" >Instruktur</a></li>
                        <?php if($this->session->userdata('log_uc_prodi') == NULL):?>
                        <li class="nav-item"><a class="nav-link <?=$active_prodi?>" id="example-pill" href="<?=base_url('users/lists/prodi/4')?>" >Operator</a></li>
                        <li class="nav-item"><a class="nav-link <?=$active_admin?>" id="example-pill" href="<?=base_url('users/lists/admin/1')?>" >Administrator</a></li>
                    <?php endif;?>
                        
                    </ul>
                </div>

                <input type="hidden" name="js_category" value="<?=$category?>">
                <input type="hidden" name="js_akses" value="<?=$akses?>">

                <div class="card-body load-data">

                    <?php 

                        $data = NULL;
                        if (isset($result)) {
                            $data['result']         = $result;
                            $data['total_record']   = $total_record;
                            $data['pagination']     = $pagination;
                            $data['akses']          = $akses;
                        }

                        if ($akses != 'instruktur') {
                            $this->load->view('user/content', $data);
                        }else{
                             $this->load->view('user/instruktur', $data);
                        }
                        
                    ?>
                </div>
            </div>

           
        </div>
        
    </div>
</div>

<div class="modal fade" id="upload-ins" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content load-form">
           <?=form_open_multipart('users/upload_ins')?>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Data Instruktur</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>File</label>
                        <input type="file" class="form-control" name="f_file">
                    </div>
                    <div class="form-group">
                        <label>Prodi</label>
                        <?php $list_prodi = list_prodi();?>
                        <?php if(isset($list_prodi)):?>
                            <select name="f_uc_prodi" class="form-control form-control-lg">
                                <option value=""> --- Pilih ---</option>
                                <?php foreach($list_prodi as $lp):?>
                                    <option value="<?=$lp->uc?>" <?=select_set($lp->uc, $this->session->userdata('log_uc_prodi'))?>><?=$lp->prodi?></option>
                                <?php endforeach;?>
                            </select>
                        <?php endif;?>
                    </div>
                    <div class="form-group">
                        <label>Template File Excel</label>
                        <br/>
                        <a href="<?=base_url('assets/file/temp_instruktur.xls')?>">Download</a>
                    </div>
                    <hr/>
                    <div class="form-group">

                        <p>
                            <h4 class="text-danger">Perhatian !!!</h4>

                            <p class="text-danger">Untuk pengisian ID Number atau NIK/NIP mohon tidak ada "SPASI" atau dengan angka "NOL" (0)</p>
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="f_upload" class="btn btn-primary" value="Proses">
                </div>
           <?=form_close()?>
        </div>
    </div>
</div>

<div class="modal fade" id="add-user-prodi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content load-form">
           <?=form_open_multipart('users/store_user_prodi')?>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User Operator</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="f_username" required="">
                    </div>
                    <div class="form-group">
                        <label>E-Mail</label>
                        <input type="email" class="form-control" name="f_email" required="">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="f_password" required="">
                    </div>

                    <div class="form-group">
                        <label>Type</label>
                        
                    </div>

                    <div class="form-group">
                        <input type="radio" name="f_type" value="1" > Prodi
                        <input type="radio" name="f_type" value="2"> DKP
                    </div>

                    <div class="form-group show-prodi" style="display:none;">
                        <label>Prodi</label>
                        <?php $list_prodi = list_prodi();?>
                        <?php if(isset($list_prodi)):?>
                            <select name="f_prodi" class="form-control form-control-lg" >
                                <option value=""> --- Pilih ---</option>
                                <?php foreach($list_prodi as $lp):?>
                                    <option value="<?=$lp->uc?>"><?=$lp->prodi?></option>
                                <?php endforeach;?>
                            </select>
                        <?php endif;?>
                    </div>

                    
                </div>
                <div class="modal-footer">
                    <input type="submit" name="f_save" class="btn btn-primary" value="Save">
                </div>
           <?=form_close()?>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-change" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content load-form-change">
           
        </div>
    </div>
</div>

<div class="modal fade" id="modal-change-pass-op" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content load-form-change-pass">
           
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content load-form-edit">
           
        </div>
    </div>
</div>

<div class="modal fade" id="add-form-ins" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content load-form-add">
            <?=form_open_multipart('users/store_ins')?>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Instruktur</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>

                <div class="modal-body">
                    
                    <?php if($this->session->userdata('info')):?>
                        <?php $warning = $this->session->flashdata('info')?>
                        <div class="alert <?=$warning['class']?> alert-icon" role="alert">
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <div class="alert-icon-aside">
                                <i class="far <?=$warning['icon']?>"></i>
                            </div>
                            <div class="alert-icon-content">
                                <h6 class="alert-heading">Pemberitahuan</h6>
                                 <?=$warning['message']?>
                            </div>
                        </div>
                    <?php endif;?>

                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" class="form-control" name="f_id_number" required="">
                        <label class="error text-danger" id="idnumber-exist" style="display:none;">
                                                  NIK, sudah ada yang menggunakan!
                                                </label>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" name="f_full_name" required="">
                    </div>
                    <div class="form-group">
                        <label>Prodi</label>
                        <?php $list_prodi = list_prodi();?>
                        <?php if(isset($list_prodi)):?>
                            <?php if ($this->session->userdata('log_category') == 1) : ?>
                                <select name="f_uc_prodi" class="form-control form-control-lg">
                                    <option value=""> --- Pilih ---</option>
                                    <?php foreach($list_prodi as $lp):?>
                                        <option value="<?=$lp->uc?>" <?=select_set($lp->uc, $this->session->userdata('log_uc_prodi'))?>><?=$lp->prodi?></option>
                                    <?php endforeach;?>
                                </select>
                            <?php else : ?>
                                <input type="hidden" name="f_uc_prodi" value="<?=$this->session->userdata('log_uc_prodi')?>">
                                <select name="" class="form-control form-control-lg" disabled="">
                                    <option value=""> --- Pilih ---</option>
                                    <?php foreach($list_prodi as $lp):?>
                                        <option value="<?=$lp->uc?>" <?=select_set($lp->uc, $this->session->userdata('log_uc_prodi'))?>><?=$lp->prodi?></option>
                                    <?php endforeach;?>
                                </select>
                            <?php endif; ?>    
                        <?php endif;?>
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <input type="submit" name="f_store" class="btn btn-primary" value="Proses">
                </div>
           <?=form_close()?>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        var base_url = $("#base-url").html();

        
        // $('.btn-add').click(function(){

        //    $('.load-form').load(base_url+'subject/add');
        // });

        $('input[name=f_type]').click(function(){
            var value = $(this).val();

            if(value == 1){
                $('.show-prodi').css('display' , 'block');
            }else{
                $('.show-prodi').css('display' , 'none');
            }
        })

        $('.btn-edit').click(function(){

            var uc = $(this).attr('uc');

           $('.load-form-edit').load(base_url+'users/edit_ins', {js_uc : uc});
        });

        // $('.btn-search').click(function(){
        //     var page = 1;
        //     var prodi = $('select[name=f_prodi] option:selected').val();
        //     var diklat = $('select[name=f_diklat] option:selected').val();

        //     $('.load-data').load(base_url+'subject/page', {js_page : page, js_prodi : prodi, js_diklat : diklat});
        // });

        $('input[name=f_id_number]').focusout(function(){
            var id_number = $(this).val();

            $.ajax({
                    type        : 'post',
                    dataType    : 'json',
                    data        : { js_id_number : id_number },
                    url         : base_url + 'users/is_exist_ins_ajax',
                    success     : function(output) {
                                    if (output == true) {
                                        $('#idnumber-exist').css({'display':'block', 'visibility':'visible'});
                                    }
                    }
                });
        });

        $('input[name=f_id_number]').keyup(function(){
                    $('#idnumber-exist').css({'display':'none', 'visibility':'hidden'});
                });

        $('.page-user a.pagination-ajax').click(function(){         
            var page    = $(this).attr('title');

            var category = $('input[name=js_category]').val();
            var akses = $('input[name=js_akses]').val();

            $('.load-data').load(base_url+'users/page', {js_page : page, js_category : category, js_akses : akses});

            // var prodi = $('select[name=f_prodi] option:selected').val();
            // var diklat = $('select[name=f_diklat] option:selected').val();

            // $('.load-data').load(base_url+'subject/page', {js_page : page, js_prodi : prodi, js_diklat : diklat});

            return false;
        });
    });
</script>