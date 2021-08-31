<?=form_open('period/update')?>
<input type="hidden" name="f_uc" value="<?=$row->uc?>">
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Periode Diklat Add</h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">

    <div class="form-group">
        <label>Label</label>
        <input type="text" class="form-control" name="f_label" value="<?=$row->label_periode?>">
    </div>

    <div class="form-group">
        <label>Prodi</label>
        <select name="f_prodi" class="form-control form-control-lg">
            <?php 
                $list_prodi = list_prodi();
                if(isset($list_prodi)):
            ?>
            <option value="">---Pilih---</option>
            <?php foreach($list_prodi as $lp):?>
                <option value="<?=$lp->uc?>" <?=select_set($lp->uc,$row->uc_prodi)?>><?=$lp->prodi?></option>
            <?php endforeach;?>
        <?php endif;?>
        </select>
    </div>

    <div class="form-group">
        <label>Diklat</label>
        <select name="f_diklat" class="form-control form-control-lg">
            <?php 
                $list_diklat = list_diklat();
                if(isset($list_diklat)):
            ?>
            <option value="">---Pilih---</option>
            <?php foreach($list_diklat as $ld):?>
                <option value="<?=$ld->uc?>" <?=select_set($ld->uc,$row->uc_diklat)?>><?=$ld->diklat?></option>
            <?php endforeach;?>
        <?php endif;?>
        </select>
    </div>

    <div class="form-group">
        <label>Tahun</label>
        <input type="number" class="form-control" name="f_tahun" value="<?=$row->tahun?>">
    </div>
    <div class="row">
        <div class="col-md-6">
             <div class="form-group">
                <label>Periode Mulai</label>
                <input type="date" class="form-control" name="f_periode_mulai" value="<?=$row->periode_mulai?>">
            </div>
        </div>
         <div class="col-md-6">
            <div class="form-group">
                <label>Periode Selesai</label>
                <input type="date" class="form-control" name="f_periode_selesai" value="<?=$row->periode_selesai?>">
            </div>
        </div>
    </div>
    
</div>
<div class="modal-footer">
    <input type="submit" name="f_save" class="btn btn-primary" value="Save">
</div>

<?=form_close();?>