<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="file"></i></div>
                        Periode Diklat
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
            <div class="card card-header-actions">
            <div class="card-header">
                Daftar Periode Diklat
                <button class="btn btn-primary btn-sm btn-add" data-toggle="modal" data-target="#exampleModal">Add</button>
            </div>
            <div class="card-body ">

                <div class="row">

                    <div class="col-md-3">
                        <select name="f_diklat" class="form-control form-control-lg">
                            <?php 
                                $list_diklat = list_diklat();
                                if(isset($list_diklat)):
                            ?>
                            <option value="">---Pilih Program Diklat---</option>
                            <?php foreach($list_diklat as $ld):?>
                                <option value="<?=$ld->uc?>"><?=$ld->diklat?></option>
                            <?php endforeach;?>
                        <?php endif;?>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <?php if ($this->session->userdata('log_category') == 4) : ?>
                            <input type="hidden" name="f_prodi" value="<?=$this->session->userdata('log_uc_prodi')?>">
                            <select class="form-control form-control-lg" disabled="">
                                <?php 
                                    $list_prodi = list_prodi();
                                    if(isset($list_prodi)):
                                        ?>
                                        <option value="">---Pilih Prodi---</option>
                                            <?php foreach($list_prodi as $lp):?>
                                                <option value="<?=$lp->uc?>" <?=select_set($lp->uc, $this->session->userdata('log_uc_prodi'))?>><?=$lp->prodi?></option>
                                            <?php endforeach;?>
                                <?php endif;?>
                            </select> 
                        <?php else : ?>
                            <select name="f_prodi" class="form-control form-control-lg">
                                <?php 
                                    $list_prodi = list_prodi();
                                    if(isset($list_prodi)):
                                        ?>
                                        <option value="">---Pilih Prodi---</option>
                                            <?php foreach($list_prodi as $lp):?>
                                                <option value="<?=$lp->uc?>"><?=$lp->prodi?></option>
                                            <?php endforeach;?>
                                <?php endif;?>
                            </select>
                        <?php endif; ?>
                   </div>
                
                   <div class="col-md-2">
                        <button class="btn btn-info btn-search-period"><i class="fa fa-search"></i> &nbsp;Search</button>
                   </div>
                </div>
                
                <div class="row load-data mt-4">
                    
                    <?php 

                    $data = NULL;
                    if (isset($result)) {
                        $data['result']         = $result;
                        $data['total_record']   = $total_record;
                        $data['pagination']     = $pagination;
                    }

                    $this->load->view('period/content', $data);
                    ?>
                    
                </div>
            </div>
        </div>
        </div>
        
    </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content load-form">
           
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        var base_url = $("#base-url").html();

        $('.btn-search-period').click(function(){         
            var page    = 1;

            var prodi = $('select[name=f_prodi] option:selected').val();
            var diklat = $('select[name=f_diklat] option:selected').val();

            $('.load-data').load(base_url+'period/page', {js_page : page, js_prodi : prodi, js_diklat : diklat});

            return false;
        });
    });
</script>