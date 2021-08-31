<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">View Question</h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">
    <!-- <div class="form-group">
        <label><b>Title Question</b></label><br/>
        <p>
            <?=read_text($row->question_title)?>
        </p>
    </div> -->
    <div class="form-group">
        <label><b>Text Question</b></label><br/>
        <p>
            <?=read_text($row->question_text)?>
        </p>
        <?php if($row->att_file != NULL):?>
           
            <img class="img-responsive" src="<?=base_url('uploads/question/'.$row->att_file)?>" width="500">
        <?php endif;?>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php if($row->question_type == 1):?>

                <ol type="a">
                <?php foreach($option as $opt):?>

                    <?php if($opt->is_correct == 1):?>
                      <li class="text-success">
                        <?=read_text($opt->option_text)?>

                        <?php if($opt->att_file != NULL):?>
           
                            <img class="img-responsive" src="<?=base_url('uploads/question/'.$opt->att_file)?>" width="500">
                        <?php endif;?>
                            
                    </li>
                    <?php else:?>
                        <li><?=read_text($opt->option_text)?>
                            
                            <?php if($opt->att_file != NULL):?>
           
                            <img class="img-responsive" src="<?=base_url('uploads/question/'.$opt->att_file)?>" width="500">
                        <?php endif;?>
                        </li>
                    <?php endif;?>

                    
                <?php endforeach;?>
                </ol>
            <?php else:?>
                <div class="form-group">
                    Answer <br/>
                    <b>                             
                        <?php if ($row->truefalse_answer != NULL): ?>
                            <?=($row->truefalse_answer == 1 ? "True" : "False")?>
                        <?php else: ?>
                        -
                        <?php endif; ?>
                    </b>
                </div>
            <?php endif;?>
        </div>
    </div>
    <!-- <div class="form-group">
        <label>Option</label>
        
    </div> -->
    
</div>