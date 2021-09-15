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
            <?=form_open_multipart('question/update_tf',array('autocomplete' => 'off'))?>
            <input type="hidden" name="f_uc" value="<?=$row->uc?>">
            <input type="hidden" name="f_uc_subject" value="<?=$row->uc_subject?>">
            <input type="hidden" name="f_att_file_old" value="<?=$row->att_file?>">
            
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
            
            <div class="display-tf">
                Jawaban
                <div class="form-group">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="f_tf" id="inlineRadio1" value="1" <?=radio_set(1, $row->truefalse_answer)?>>
                      <label class="form-check-label" for="inlineRadio1">True</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="f_tf" id="inlineRadio2" value="0" <?=radio_set(0, $row->truefalse_answer)?>>
                      <label class="form-check-label" for="inlineRadio2">False</label>
                    </div>
                </div>
            </div>
            

            <input type="submit" name="f_store" class="btn btn-primary" value="Save" />
            

            <?=form_close()?>
        </div>
        
    </div>
</div>