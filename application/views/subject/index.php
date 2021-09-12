<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="file"></i></div>
                        Group - Subject
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
                Daftar Subject
                <button class="btn btn-primary btn-sm btn-add" data-toggle="modal" data-target="#exampleModal">Add</button>
            </div>
            <div class="card-body ">
  <div class="row">
                    <input type="hidden" name="f_log_category" value="<?=$this->session->userdata('log_category')?>" />
                    <?php if ($this->session->userdata('log_category') != 5) : ?>
                        <div class="col-md-3">

                            <select name="f_diklat" class="form-control form-control-lg select-diklat">
                                <?php 
                                    $list_diklat = list_diklat();
                                    if(isset($list_diklat)):
                                        ?>
                                        <option value="">---Pilih Program Diklat---</option>
                                        
                                        <?php foreach($list_diklat as $ld):?>
                                            <?php if ($ld->uc != 'DKP') : ?>
                                                <option value="<?=$ld->uc?>"><?=$ld->diklat?></option>
                                            <?php else : ?>
                                                <?php if ($this->session->userdata('log_category') == 1) :  ?>
                                                    <option value="<?=$ld->uc?>"><?=$ld->diklat?></option>
                                                <?php endif; ?>    
                                            <?php endif; ?>
                                        <?php endforeach;?>
                                <?php endif;?>
                            </select>

                        </div>
                    <?php else : ?>
                        <input type="hidden" name="f_diklat" value="DKP">
                    <?php endif; ?>

                    <div class="col-md-5 select-program">
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
                        <?php elseif ($this->session->userdata('log_category') == 5): ?>
                            <select name="f_diklat_dkp" class="form-control form-control-lg">
                                <?php 
                                    $list_prodi = list_dkp();
                                    if(isset($list_prodi)):
                                        ?>
                                        <option value="">---Pilih Program---</option>
                                            <?php foreach($list_prodi as $lp):?>
                                                <option value="<?=$lp->uc?>"><?=$lp->label_dkp?></option>
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

                        $this->load->view('subject/content', $data);
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

        $('select[name=f_diklat]').change(function(){
            var diklat = $('select[name=f_diklat] option:selected').val();

            if (diklat == 'DKP') {
                $('.select-program').load(base_url+'dkp/load_select', {js_diklat_dkp : diklat});
            }
            else {
                 $('.select-program').load(base_url+'prodi/load_select');
            }
        });

        $('.btn-search-period').click(function(){         
            var page    = 1;

            var log_category = $('input[name=f_log_category]').val();

            if (log_category != 5) {
                var diklat = $('select[name=f_diklat] option:selected').val();

                if (log_category == 4) {
                    var prodi = $('input[name=f_prodi]').val();
                }
                else {
                    var prodi = $('select[name=f_prodi] option:selected').val();
                }
                
            }
            else {
                var diklat = $('input[name=f_diklat]').val();
            }
            
            var program = $('select[name=f_diklat_dkp] option:selected').val();

            $('.load-data').load(base_url+'subject/page', {js_page : page, js_prodi : prodi, js_diklat : diklat, js_program : program});

            return false;
        });

        $('.page-subject a.pagination-ajax').click(function(){         
            var page    = $(this).attr('title');

           var log_category = $('input[name=f_log_category]').val();

            if (log_category != 5) {
                var diklat = $('select[name=f_diklat] option:selected').val();

                if (log_category == 4) {
                    var prodi = $('input[name=f_prodi]').val();
                }
                else {
                    var prodi = $('select[name=f_prodi] option:selected').val();
                }
                
            }
            else {
                var diklat = $('input[name=f_diklat]').val();
            }
            
            var program = $('select[name=f_diklat_dkp] option:selected').val();

            $('.load-data').load(base_url+'subject/page', {js_page : page, js_prodi : prodi, js_diklat : diklat, js_program : program});

            return false;
        });
    });
</script>