<?=form_open('peserta_diklat/update_password', array('name' => 'passwordmatch'))?>
<input type="hidden" name="f_uc" value="<?=$row->uc?>">
<input type="hidden" name="f_uc_prodi" value="<?=@$prodi->uc_prodi?>">
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">

    <div class="form-group">
        <label>New Password</label>
        <input type="password" class="form-control" name="f_password" id="pass" required="">
    </div>

    <div class="form-group">
        <label>Re - Password</label>
        <input type="password" class="form-control" name="f_re_password" id="pass" required="">
    </div>
    
</div>
<div class="modal-footer">
 
    <input type="submit" name="f_save" class="btn btn-primary " value="Save">
</div>

<?=form_close();?>
