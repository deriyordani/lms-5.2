<script src="<?=base_url('assets/third_party/tinymce/tinymce.min.js')?>" ></script>
<script type="text/javascript" src="<?=base_url('assets/js/tinymce.js')?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.save-finish').confirm({
                title: 'Confirmation',
                content: 'Are you sure want to finish assessment?',
                theme: 'supervan',
                buttons: {
                    confirm: function () {
                        //$.alert('Sudahku duga, mungkin kurang sedekah');
                        tinyMCE.triggerSave();
                        $('.form-attempt').submit();

                    },
                    cancel: function () {
                        //$.alert('Canceled!');
                    }
                }
            });
    });
</script>

            <input type="hidden" name="f_question_type" value="<?=$result[0]->question_type?>" />
            <input type="hidden" name="f_max_option" value="<?=count($result)?>" />
            <input type="hidden" name="f_uc_assque" value="<?=$result[0]->uc?>">
            <input type="hidden" name="f_uc_ess_answer" value="<?=@$essay->uc?>">

            <div class="row mt-3 p-2 ">
               
                <div class="col-md-1 mt-2">
                    <h3>x<?=$no?> of <?=$max_question?>.</h3>
                </div>

                <div class="col-md-11">
                    <?php if($result[0]->question_att_file != NULL):?>
                        <div class="row mt-2">
                            <img src="<?=base_url('uploads/question/'.$result[0]->question_att_file)?>" class="img-thumbnail img-fluid mx-auto d-block">
                        </div>
                    <?php endif;?>

                    <div class="row mt-2">
                        <?=$question_text?>
                    </div>

                    <?php if ($result[0]->question_type == 1) : ?>
                        <?php foreach ($result as $res): ?>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="f_answer" value="<?=$res->option_uc?>" <?=check_set($res->option_uc, $value)?> /> <?=read_text(htmlspecialchars_decode(stripslashes($res->option_text)))?>

                                    <?php if($result[0]->option_att_file != NULL):?>
                                        <img src="<?=base_url('uploads/question/'.$result[0]->question_att_file)?>" class="img-thumbnail img-fluid mx-auto d-block">
                                    <?php endif;?>
                                </label>
                            </div>
                        <?php endforeach;?>
                     <?php elseif ($result[0]->question_type == 3) : ?>
                        <textarea class="form-control" id="txarea-<?=$result[0]->uc?>" name="f_essay_answer">
                            <?=@$essay->answer?>
                        </textarea>
                    <?php else:?>
                        <?php if ($value == "NULL") : ?>

                            <div class="form-check py-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="f_answer" value="1"> True
                                </label>
                            </div>

                            <div class="form-check py-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="f_answer" value="0"> False
                                </label>
                            </div>

                        <?php else : ?>

                             <div class="form-check py-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="f_answer" value="1" <?=($value != "NULL" ? check_set("1", $value) : "");?>> True
                                </label>
                            </div>

                            <div class="form-check py-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="f_answer" value="0" <?=($value != "NULL" ? check_set("0", $value) : "");?>> False
                                </label>
                            </div>
        

                        <?php endif; ?>

                    <?php endif;?>

                </div>

            </div>