<?=form_open_multipart('classroom/update_lampiran')?>
<input type="hidden" name="f_old_file" value="<?=$row->file_attach?>">
<input type="hidden" name="f_uc" value="<?=$row->uc?>" >
<input type="hidden" name="f_uc_class" value="<?=$uc_class?>">
<input type="hidden" name="f_uc_diklat_class" value="<?=$uc_diklat_class?>">
<input type="hidden" name="f_uc_content" value="<?=$uc_content?>">
<div class="modal-content">
   <div class="modal-header">
        <h5 class="modal-title">Update Lampiran</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
    </div>
    <div class="modal-body">
       <div class="form-group">
           <label>Replace With</label>
           <input type="file" name="f_replace_file" class="form-control">
       </div>
    </div>
    <div class="modal-footer">
        <input type="submit" name="f_submit" value="Save" class="btn btn-primary">

        <button class="btn btn-light" type="button" data-dismiss="modal">Cancel</button>
    </div>
<?=form_close()?>
</div>