<script type="text/javascript" src="<?=base_url('assets/js/tinymce.js')?>"></script>

    <link href="<?=base_url('assets/css/jquery.filer.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/css/themes/jquery.filer-dragdropbox-theme.css')?>" rel="stylesheet">

    <!-- Jvascript -->
   <!--  <script src="http://code.jquery.com/jquery-3.1.0.min.js" crossorigin="anonymous"></script> -->
    <script src="<?=base_url('assets/js/jquery.filer.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('assets/js/custom.js')?>" type="text/javascript"></script>


<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="file"></i></div>
                        Form Add - Assigment / Essay
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
            <?=form_open_multipart('classroom/store_content')?>
            <input type="hidden" name="f_uc_class" value="<?=$uc_classroom?>">
            <input type="hidden" name="f_uc_diklat_class" value="<?=$uc_diklat_class?>">
            <input type="hidden" name="f_category" value="5">
            <div class="form-group">
                <label>Judul</label>
                <input type="text" class="form-control" name="f_judul">
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea class="form-control" style="height: 230px;" name="f_deskripsi"></textarea>
            </div>

             <div class="form-group">
                <label>Batas Waktu Pengerjaan</label>
            
            </div>
            
            <div class="row mb-3">
               
                <div class="col-6">
                    <label>Dari</label>
                    
                    <input type="text" class="form-control datetimepicker" name="f_time_open">
                </div>                
                <div class="col-6">
                    <label>Sampai</label>
                    <input type="text" class="form-control datetimepicker" name="f_time_close">
                </div>
            </div>
            
            <div class="form-group">
                <label>Bobot Penilaian</label>
                <input type="text" class="form-control" name="f_point">
            </div>

            <div class="form-group">
                <label>Lampiran</label>
                <!-- <input type="file" class="form-control" name="f_lampiran"> -->

                <input type="file" name="files[]" id="filer_input" multiple="multiple" >

                <span class="text-danger">Perhatian : Jika ingin menambahkan, silahkan pilih lampiran kembali</span>
            </div>

           <!--  <div class="form-group">
                <label>Lampiran</label>
                <input type="file" class="form-control" name="f_lampiran">
            </div> -->

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
                
            </div>

            <input type="submit" class="btn btn-success" value="Kirim" name="f_store">
            <?=form_close()?>
        </div>
        
    </div>
</div>