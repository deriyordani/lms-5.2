
<script type="text/javascript" src="<?=base_url('assets/js/tinymce.js')?>"></script>

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="file"></i></div>
                        Form Edit - Assessment
                    </h1>
                </div>
                 <div class="col-12 col-xl-auto mb-3">
                    <a href="<?=base_url('classroom/task/'.$uc_classroom.'/'.$uc_diklat_class)?>" class="btn btn-sm btn-light text-primary active mr-2">
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
            <?=form_open_multipart('classroom/update_content')?>
            <input type="hidden" name="f_uc_class" value="<?=$uc_classroom?>">
            <input type="hidden" name="f_uc_diklat_class" value="<?=$uc_diklat_class?>">
            <input type="hidden" name="f_uc" value="<?=$row->uc?>">
             <input type="hidden" name="f_category" value="6">

             <fieldset>
                <legend>Pengaturan</legend>
                <table class="form-frame" width="100%" cellpadding="5">
                    <tr>
                        <td>Open Time</td>
                        <td>:</td>
                        <td><input type="text" name="f_open_time" class="datetimepicker form-control col-5" value="<?=time_format($row->time_open, 'm/d/Y H:i')?>"></td>
                    </tr>
                    <tr>
                        <td>Close Time</td>
                        <td>:</td>
                        <td><input type="text" name="f_close_time" class="datetimepicker form-control col-5" value="<?=time_format($row->time_close, 'm/d/Y H:i')?>"></td>
                    </tr>
                </table>
            </fieldset>
            <!-- <div class="form-group">
                <label>Judul</label>
                <input type="text" class="form-control" name="f_judul" required="">
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea id="editor" class="form-control " style="height: 230px;" name="f_deskripsi"></textarea>
            </div>

            <div class="form-group">
                <label>Sertakan Link Video Conference</label>
                <input type="text" class="form-control" name="f_link" required="">
            </div>

            <div class="form-group">
                <label>Section</label>
                <?php $list_section = list_section(array('uc_classroom' => $uc_classroom));?>

                <select name="f_section" class="form-control form-control-lg" required="">
                    <option value="">--- Pilih ---</option>
                    <?php if(isset($list_section)):?>
                        <?php foreach($list_section as $ls):?>
                            <option value="<?=$ls->uc?>"><?=$ls->section_label?></option>
                        <?php endforeach;?>
                    <?php endif;?>
                </select>
                
            </div> -->

            

            

            <input type="submit" class="btn btn-success" value="Kirim" name="f_store">
            <?=form_close()?>
        </div>
        
    </div>
</div>