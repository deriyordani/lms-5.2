
<script type="text/javascript" src="<?=base_url('assets/js/tinymce.js')?>"></script>

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="file"></i></div>
                        Form Add - Link Video Conference
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
             <input type="hidden" name="f_category" value="7">
            <input type="hidden" name="f_uc" value="<?=$row->uc?>">

            <div class="form-group">
                <label>Judul</label>
                <input type="text" class="form-control" name="f_judul" value="<?=$row->content_title?>">
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea class="form-control" style="height: 230px;" name="f_deskripsi"><?=$row->content_description?></textarea>
            </div>

            <div class="form-group">
                <label>Sertakan Link Video Conference</label>
                <input type="text" class="form-control" name="f_link" required="" value="<?=$row->link?>">
            </div>

             <div class="form-group">
                <label>Section</label>
                <?php $list_section = list_section(array('uc_classroom' => $uc_classroom),'label_section','ASC');?>

                <select name="f_section" class="form-control form-control-lg" required="">
                    <option value="">--- Pilih ---</option>
                    <?php if(isset($list_section)):?>
                        <?php foreach($list_section as $ls):?>
                            <option value="<?=$ls->uc?>" <?=select_set($ls->uc,$row->uc_section)?>><?=$ls->section_label?></option>
                        <?php endforeach;?>
                    <?php endif;?>
                </select>
                
            </div>

            

            <input type="submit" class="btn btn-success" value="Kirim" name="f_store">
            <?=form_close()?>
        </div>
        
    </div>
</div>