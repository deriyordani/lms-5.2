<script type="text/javascript">
    $(document).ready(function() {

       
    });
</script>

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="file"></i></div>
                        Form Pick Questions
                    </h1>
                </div>
                 <div class="col-12 col-xl-auto mb-3">
                    
                </div>

            </div>
        </div>
    </div>
</header>


<div class="container-fluid mt-2 small">
    <div class="row">
        <div class="col-6">
            <?=form_open('classroom/add_picked')?>
                <input type="hidden" name="f_uc_assessment" value="<?=$uc_assessment?>">
                <input type="hidden" name="f_uc_subject" value="<?=$uc_subject?>">

                <div class="row mb-1">
                    <div class="col-5">
                        <h5 class="text-danger">Question Bank</h5>
                    </div>
                    <div class="col-7 text-right">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" name="f_key_qbank" placeholder="Search">
                            <div class="input-group-append">
                                <a href="#" class="btn btn-primary btn-sm" id="qbank-search">
                                    <i class="fa fa-search small"></i>
                                </a>
                                <a href="#" class="btn btn-primary btn-sm" id="qbank-clear">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                    </div>                  
                </div>
                <div class="d-flex justify-content-center">
                    <div class="col-12" id="bank-list">
                        <?php
                            $data['q_res'] = isset($q_bank) ? $q_bank : NULL;
                            $data['q_amt'] = $qb_amt;
                            $data['q_typ'] = "bank";
                        ?>
                        <?php $this->load->view('classroom/question_list_content', $data); ?>
                    </div>
                </div>
            <?=form_close()?>
        </div>
        
        <div class="col-6">
            <?=form_open('classroom/remove_picked')?>
                <input type="hidden" name="f_uc_assessment" value="<?=$uc_assessment?>">
                <input type="hidden" name="f_uc_subject" value="<?=$uc_subject?>">

                <div class="row mb-1">
                    <div class="col-5">
                        <h5 class="text-danger">Picked Question</h5>
                    </div>
                    <div class="col-7 text-right">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" name="f_key_qpick" placeholder="Search">
                            <div class="input-group-append">
                                <a href="#" class="btn btn-success btn-sm" id="qpick-search">
                                    <i class="fa fa-search small"></i>
                                </a>
                                <a href="#" class="btn btn-success btn-sm" id="qpick-clear">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                    </div>                  
                </div>
                <div class="d-flex justify-content-center">
                    <div class="col-12" id="pick-list">
                        <?php
                            $data['q_res'] = isset($q_pick) ? $q_pick : NULL;
                            $data['q_amt'] = $qp_amt;
                            $data['q_typ'] = "pick";
                            $data['uc_assessment'] = $uc_assessment;
                        ?>
                        <?php $this->load->view('classroom/question_list_content', $data); ?>   
                    </div>
                </div>
            <?=form_close()?>    
        </div>
    </div>
</div>