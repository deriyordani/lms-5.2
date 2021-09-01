
<script type="text/javascript" src="<?=base_url('assets/js/tinymce.js')?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('input[name=f_type]').click(function(){
            var value = $(this).val();

            if (value == 1) {

                $('.display-mc').css({'display' : 'block'});
                $('.display-tf').css({'display' : 'none'});

            }

            if (value == 2){

                $('.display-mc').css({'display' : 'none'});
                $('.display-tf').css({'display' : 'block'});
            }

            if (value == 3){

                $('.display-mc').css({'display' : 'none'});
                $('.display-tf').css({'display' : 'none'});
            }

        });
    });
</script>

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="file"></i></div>
                        Form Add Question
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
            <?=form_open_multipart('question/store',array('autocomplete' => 'off'))?>
      
            <input type="hidden" name="f_uc_subject" value="<?=$uc_subject?>">

            <div class="form-group">
                <label>Judul</label>
                <input type="text" class="form-control" name="f_judul" required="" >
            </div>

            <div class="form-group">
                <label>Isi Pertanyaan</label>
                <textarea id="editor" class="form-control " style="height: 230px;" name="f_deskripsi"></textarea>
            </div>


            <div class="form-group">
                <label>*)jpg, png</label>
                <input type="file" class="form-control" name="f_lampiran" accept="image/*">
            </div>

            <div class="form-group">
                <label>Tipe Soal</label>
            </div>

            <div class="form-group">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="f_type" id="inlineRadio1" value="1" required="">
                  <label class="form-check-label" for="inlineRadio1">Multiple Choice</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="f_type" id="inlineRadio2" value="2" required="" required="">
                  <label class="form-check-label" for="inlineRadio2">True False</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="f_type" id="inlineRadio2" value="3" required="">
                  <label class="form-check-label" for="inlineRadio2">Essay</label>
                </div>
            </div>

            <hr/>

            <div class="display-tf" style="display: none;">
                Jawaban
                <div class="form-group">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="f_tf" id="inlineRadio1" value="1">
                      <label class="form-check-label" for="inlineRadio1">True</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="f_tf" id="inlineRadio2" value="0">
                      <label class="form-check-label" for="inlineRadio2">False</label>
                    </div>
                </div>
            </div>

            <div class="display-mc"  style="display: none;">
                Jawaban
                <?php for ($i=1; $i <= 5  ; $i++):?>
                <div class="form-group">
                    <label><b>Option <?=$i?></b></label>
                    <textarea id="editor" class="form-control " style="height: 230px;" name="f_option_<?=$i?>"></textarea>
                </div>

                <div class="form-group">
                    <label>*)jpg, png</label>
                    <input type="file" class="form-control" name="f_lampiran_op_<?=$i?>" accept="image/*">
                </div>

                <div class="form-group mb-3">
                    <input type="radio" name="f_key" value="<?=$i?>"> Jawaban Benar
                </div>

                <hr/>
            <?php endfor;?>
            </div>
            

            
            <div class="row mt-3 mb-3 mx-auto">
                <?php if ($entry_mode == 1) : ?>
                <input type="submit" name="f_save_single" class="btn btn-primary" value="Save" />
            <?php else : ?>
                <a href="<?=base_url('question')?>" class="btn btn-warning"> Finish </a>
                <input type="submit" name="f_save_group" class="btn btn-primary ml-2" value="Save and Add Next Question" />
            <?php endif; ?> 
            </div>
            

            <?=form_close()?>
        </div>
        
    </div>
</div>