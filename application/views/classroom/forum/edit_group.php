 <?=form_open('classroom/update_group_forum', array('autocomplate' => 'off'))?>
 <input type="hidden" name="f_uc_group" value="<?=$group->uc?>">
<input type="hidden" name="f_uc_forum" value="<?=$uc_forum?>">
<input type="hidden" name="f_uc_classroom" value="<?=$uc_classroom?>">
<input type="hidden" name="f_uc_diklat_class" value="<?=$uc_diklat_class?>">

<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Update Kelompok</h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">
    <div class="form-group">
        <label>Nama Kelompok</label>
        <input type="text" name="f_group_name" class="form-control" required="" value="<?=$group->group_name?>">
    </div>
    <div class="form-group">
        <label>Sertakan Anggota Kelompok :</label>
        <?php if(isset($participant)):?>
            <?php foreach($participant as $pa):?>
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" id="customCheck<?=$pa->id?>" type="checkbox" value="<?=$pa->uc?>" name="f_participant[]" <?=check_set($pa->uc, $pa->uc_diklat_participant)?>>
                    <label class="custom-control-label" for="customCheck<?=$pa->id?>"><?=$pa->no_peserta?> - <?=$pa->full_name?></label>
                </div>
            <?php endforeach;?>
        <?php endif;?>
    </div>
</div>
<div class="modal-footer">
    <input type="submit" name="f_update_group" class="btn btn-primary" value="Save">
</div>

<?=form_close();?>