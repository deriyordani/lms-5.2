<?=form_open('users/update_ins')?>
<input type="hidden" name="f_uc" value="<?=$row->uc?>">
<input type="hidden" name="f_uc_prodi" value="<?=$row->uc_prodi?>">
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Ubah Instruktur</h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">
    <div class="form-group">
        <label>NIK/NIP</label>
        <input type="text" class="form-control" name="f_nip" value="<?=$row->id_number?>" >
    </div>
    <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" class="form-control" name="f_full_name" value="<?=$row->full_name?>" >
    </div>
    <div class="form-group">
        <select name="f_prodi" class="form-control form-control-lg">
            <?php 
                $list_prodi = list_prodi();
                if(isset($list_prodi)):
                    ?>
                    <option value="">---Pilih Prodi---</option>
                        <?php foreach($list_prodi as $lp):?>
                            <option value="<?=$lp->uc?>" <?=select_set($lp->uc, $row->uc_prodi)?>><?=$lp->prodi?></option>
                        <?php endforeach;?>
            <?php endif;?>
        </select>

    </div>
    
</div>
<div class="modal-footer">
    <input type="submit" name="f_save" class="btn btn-primary" value="Save">
</div>

<?=form_close();?>