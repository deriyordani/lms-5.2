<script type="text/javascript" src="<?=base_url('assets/js/tinymce.js')?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        
    });
</script>

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="file"></i></div>
                        Form Edit Question
                    </h1>
                </div>
                 <div class="col-12 col-xl-auto mb-3">
                    <a href="<?=base_url('question')?>" class="btn btn-sm btn-light text-primary active mr-2">
                        <i data-feather="arrow-left"></i> Back
                    </a>
                </div>

            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="row">

        
        <div class=" col-md-8 mx-auto ">
            <?=form_open_multipart('question/update_mc',array('autocomplete' => 'off'))?>
            <input type="hidden" name="f_uc" value="<?=$row->uc?>">
            <input type="hidden" name="f_uc_subject" value="<?=$row->uc_subject?>">
            <input type="hidden" name="f_att_file_old" value="<?=$row->att_file?>">
            <!--
            <?php if ($row->att_file != NULL) : ?>
                <input type="hidden" name="f_att_file_old" value="<?=$row->att_file?>">
            <?php endif; ?>
            -->

            <div class="form-group">
                <label>Judul</label>
                <input type="text" class="form-control" name="f_judul" value="<?=$row->question_title?>" required="" >
            </div>

            <div class="form-group">
                <label>Isi Pertanyaan</label>
                <textarea id="editor" class="form-control " style="height: 230px;" name="f_deskripsi">
                    <?=$row->question_text?>
                </textarea>
            </div>

            <?php if ($row->att_file != NULL) : ?>
                <div class="form-group">
                     <img class="img-responsive" src="<?=base_url('uploads/question/'.$row->att_file)?>" width="500">
                </div>

                <div class="form-group">
                    <label>Replace Image With</label>
                    <input type="file" class="form-control" name="f_lampiran" accept="image/*">
                </div>
            <?php else : ?>
                <div class="form-group">
                    <label>*)jpg, png</label>
                    <input type="file" class="form-control" name="f_lampiran" accept="image/*">
                </div>    
            <?php endif; ?>    

            <br />
            <hr/>
            
            <div class="display-mc">
                Jawaban
                <?php for ($i=1; $i <= 5  ; $i++):?>
                <div class="form-group">
                    <label><b>Option <?=$i?></b></label>
                    <textarea id="editor" class="form-control " style="height: 230px;" name="f_option_<?=$i?>"><?=@$option[$i-1]->option_text?></textarea>
                </div>

                <?php if (@$option[$i-1]->att_file != NULL) : ?>
                    <div class="form-group">
                         <img class="img-responsive" src="<?=base_url('uploads/question/'.$option[$i-1]->att_file)?>" width="500">
                    </div>

                    <div class="form-group">
                        <label>Replace Image With</label>
                        <input type="file" class="form-control" name="f_lampiran" accept="image/*">
                    </div>
                <?php else : ?>
                    <div class="form-group">
                        <label>*)jpg, png</label>
                        <input type="file" class="form-control" name="f_lampiran" accept="image/*">
                    </div>    
                <?php endif; ?> 

                
                <!--
                <div class="form-group">
                    <label>*)jpg, png</label>
                    <input type="file" class="form-control" name="f_lampiran_op_<?=$i?>" accept="image/*">
                </div>
                -->

                <div class="form-group mb-3">
                    <div class="form-group">
                        <input type="radio" name="f_key" value="<?=$i?>" <?=(@$option[$i-1]->is_correct == 1 ? "checked=\"checked\"" : "")?>> Jawaban Benar
                    </div>
                </div>

                <br />
                <hr/>
            <?php endfor;?>
            </div>
            

            <input type="submit" name="f_store" class="btn btn-primary" value="Save" />
            

            <?=form_close()?>
        </div>
        
    </div>
</div>