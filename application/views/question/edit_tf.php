<script type="text/javascript" src="<?=base_url('assets/js/tinymce.js')?>"></script>

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="file"></i></div>
                        Form Edit - Question
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
            <?=form_open_multipart('question/update_tf')?>
            <input type="hidden" name="f_uc_class" value="<?=$uc_classroom?>">
            <input type="hidden" name="f_uc_diklat_class" value="<?=$uc_diklat_class?>">
             <input type="hidden" name="f_uc_subject" value="<?=$uc_subject?>">
             <input type="hidden" name="f_att_file_old" value="<?=$row->att_file?>">
             <input type="hidden" name="f_uc" value="<?=$row->uc?>">

            <div class="form-group">
                <label>Judul</label>
                <input type="text" class="form-control" name="f_judul" required="" value="<?=$row->question_title?>">
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea id="editor" class="form-control " style="height: 230px;" name="f_deskripsi"><?=$row->question_text?></textarea>
            </div>

            <div class="form-group">
                 <label>Image</label>
                 <img class="img-responsive" src="<?=base_url('uploads/question/'.$row->att_file)?>" width="500">
            </div>


            <div class="form-group">
                <label>Replace Image With</label>
                <input type="file" class="form-control" name="f_lampiran" accept="image/*">
            </div>


            <hr/>

            <div class="display-tf" >
                Jawaban
                <div class="form-group">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="f_tf" id="inlineRadio1" value="1" <?=radio_set(1,$row->truefalse_answer)?>>
                      <label class="form-check-label" for="inlineRadio1">True</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="f_tf" id="inlineRadio2" value="0" <?=radio_set(2,$row->truefalse_answer)?>>
                      <label class="form-check-label" for="inlineRadio2">False</label>
                    </div>
                </div>
            </div>


            <input type="submit" class="btn btn-success" value="Kirim" name="f_store">
            <?=form_close()?>
        </div>
        
    </div>
</div>