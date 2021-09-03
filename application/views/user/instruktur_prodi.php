<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="file"></i></div>
                        Daftar Instruktur
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
                <div class="card-body load-data">

                    <?php 

                        $data = NULL;
                        if (isset($result)) {
                            $data['result']         = $result;
                            $data['total_record']   = $total_record;
                            $data['pagination']     = $pagination;
                        }

                        
                             $this->load->view('user/instruktur', $data);
                        
                        
                    ?>
                </div>
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
                                    <option value="<?=$lp->uc?>"><?=$lp->prodi?></option>
                                <?php endforeach;?>
                            </select>
                        <?php endif;?>
                    </div>
                    <div class="form-group">
                        <label>Template File Excel</label>
                        <br/>
                        <a href="<?=base_url('assets/file/temp_instruktur.xls')?>">Download</a>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="f_upload" class="btn btn-primary" value="Proses">
                </div>
           <?=form_close()?>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content load-form-edit">
           
        </div>
    </div>
</div>