
<script type="text/javascript" src="<?=base_url('assets/js/tinymce.js')?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('input[name=f_type]').click(function(){
            var value = $(this).val();

            if (value == 1) {

                $('.display-mc').css({'display' : 'block'});
                $('.display-tf').css({'display' : 'none'});

            }else{

                $('.display-mc').css({'display' : 'none'});
                $('.display-tf').css({'display' : 'block'});
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
                        Form Add - Question
                    </h1>
                </div>
                 <div class="col-12 col-xl-auto mb-3">
                    <a href="<?=base_url('question/list/'.$uc_classroom.'/'.$uc_diklat_class.'/'.$uc_subject)?>" class="btn btn-sm btn-light text-primary active mr-2">
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
            <input type="hidden" name="f_uc_class" value="<?=$uc_classroom?>">
            <input type="hidden" name="f_uc_diklat_class" value="<?=$uc_diklat_class?>">
             <input type="hidden" name="f_uc_subject" value="<?=$uc_subject?>">

            <div class="form-group">
                <label>Judul</label>
                <input type="text" class="form-control" name="f_judul" required="" >
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea id="editor" class="form-control " style="height: 230px;" name="f_deskripsi"></textarea>
            </div>


            <div class="form-group">
                <label>*)jpg, png</label>
                <input type="file" class="form-control" name="f_lampiran" accept="image/*">
            </div>

            <div class="form-group">
                <label>Type Soal</label>
                
            </div>

            <div class="form-group">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="f_type" id="inlineRadio1" value="1">
                  <label class="form-check-label" for="inlineRadio1">Multiple Choice</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="f_type" id="inlineRadio2" value="2">
                  <label class="form-check-label" for="inlineRadio2">True False</label>
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
                <?php for ($i=1; $i <= 4  ; $i++):?>
                <div class="form-group">
                    <label><b>Option <?=$i?></b></label>
                    <textarea id="editor" class="form-control " style="height: 230px;" name="f_option_<?=$i?>"></textarea>
                </div>

                <div class="form-group">
                    <label>*)jpg, png</label>
                    <input type="file" class="form-control" name="f_lampiran_op_<?=$i?>" accept="image/*">
                </div>

                <div class="form-group">
                    <input type="radio" name="f_key" value="<?=$i?>"> Kunci Jawaban
                </div>

            <?php endfor;?>
            </div>
            

            

            <input type="submit" class="btn btn-success" value="Kirim" name="f_store">
            <?=form_close()?>
        </div>
        
    </div>
</div>