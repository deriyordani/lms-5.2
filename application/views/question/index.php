<script type="text/javascript">
    $(document).ready(function(){

        var base_url = $('#base-url').html();

        $('select[name=f_prodi_filter]').change(function(){
            
            var uc_prodi = $(this).val();
            var uc_diklat = $('select[name=f_diklat_filter] option:selected').val();

            $('select[name=f_subject_filter]').load(base_url+'master/subject_by_prody', {js_uc_prodi : uc_prodi, js_uc_diklat : uc_diklat});
 
        });

        $('select[name=f_prodi]').change(function(){
            
            var uc_prodi = $(this).val();
            var uc_diklat = $('select[name=f_diklat] option:selected').val();

            $('select[name=f_subject]').load(base_url+'master/subject_by_prody', {js_uc_prodi : uc_prodi, js_uc_diklat : uc_diklat});
 
        });

    });
</script>
<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon">
                            <i class="fa fa-file"></i>
                        </div>
                        Question Bank
                    </h1>
                </div>
                 <div class="col-12 col-xl-auto mb-3">
                    <button class="btn btn-primary btn-sm  mt-2 btn-add" data-toggle="modal" data-target="#add-question">
                        <i class="mr-1" data-feather="file-plus"></i>  Add Question
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="row">

        <div class="col-3">
            <select name="f_diklat" class="form-control form-control-lg">
                <option value=""> --- Diklat---</option>
                <?php $diklat = list_diklat();?>

                <?php if(isset($diklat)):?>
                    <?php foreach($diklat as $pr):?>
                        <option value="<?=$pr->uc?>"><?=$pr->diklat?></option>
                    <?php endforeach;?>
                <?php endif;?>
            </select>
        </div>
        
        <div class="col-3">
            <select name="f_prodi" class="form-control form-control-lg">
                <option value=""> --- Prodi ---</option>
                <?php $prodi = list_prodi();?>

                <?php if(isset($prodi)):?>
                    <?php foreach($prodi as $pr):?>
                        <option value="<?=$pr->uc?>"><?=$pr->prodi?></option>
                    <?php endforeach;?>
                <?php endif;?>
            </select>
        </div>
        
        <div class="col-3">
            <select name="f_subject" class="form-control form-control-lg">
                <option value=""> --- Subject ---</option>
                <!-- <?php $subject = list_subject();?>

                <?php if(isset($subject)):?>
                    <?php foreach($subject as $pr):?>
                        <option value="<?=$pr->uc?>"><?=$pr->subject_title?></option>
                    <?php endforeach;?>
                <?php endif;?> -->
            </select>
        </div>
        <div class="col-3">
            <button class="btn btn-success mt-1 btn-search">
                <i class="fa fa-search"></i> &nbsp; Search
            </button>
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

            $this->load->view('question/content', $data);
        ?>

    </div>
</div>

<div class="modal fade" id="add-question" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <?=form_open('question/add')?>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Question Setting</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Diklat</label>
                     <select name="f_diklat_filter" class="form-control form-control-lg">
                        <option value=""> --- Diklat---</option>
                        <?php $diklat = list_diklat();?>

                        <?php if(isset($diklat)):?>
                            <?php foreach($diklat as $pr):?>
                                <option value="<?=$pr->uc?>"><?=$pr->diklat?></option>
                            <?php endforeach;?>
                        <?php endif;?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Prodi</label>
                    <select name="f_prodi_filter" class="form-control form-control-lg">
                        <option value=""> --- Prodi ---</option>
                        <?php $prodi = list_prodi();?>

                        <?php if(isset($prodi)):?>
                            <?php foreach($prodi as $pr):?>
                                <option value="<?=$pr->uc?>"><?=$pr->prodi?></option>
                            <?php endforeach;?>
                        <?php endif;?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Subject</label>
                    <select name="f_subject_filter" class="form-control form-control-lg">
                        <option value=""> --- Subject ---</option>
                        <!-- <?php $subject = list_subject();?>

                        <?php if(isset($subject)):?>
                            <?php foreach($subject as $pr):?>
                                <option value="<?=$pr->uc?>"><?=$pr->subject_title?></option>
                            <?php endforeach;?>
                        <?php endif;?> -->
                    </select>
                </div>

                <div class="form-group">
                    <label>Mode Entry</label>
                    
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="f_mode" id="inlineRadio1" value="1">
                    <label class="form-check-label" for="inlineRadio1">Single</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="f_mode" id="inlineRadio2" value="2">
                    <label class="form-check-label" for="inlineRadio2">Group</label>
                </div>

            </div>
            <div class="modal-footer">
                <input type="submit" name="f_proses" class="btn btn-success" value="Proses">
            </div>
        </div>
        <?=form_close()?>
    </div>
</div>
