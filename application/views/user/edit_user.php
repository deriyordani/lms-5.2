<?=form_open('users/update_user')?>
<input type="hidden" name="f_uc" value="<?=$row->uc?>">
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Ubah User</h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">

    <div class="form-group">
        <label>Username</label>
        <input type="text" class="form-control" name="f_username" required="" value="<?=$row->username?>">
    </div>
    <div class="form-group">
        <label>E-Mail</label>
        <input type="email" class="form-control" name="f_email" required="" value="<?=$row->email?>">
    </div>


    <!-- div class="form-group">
        <label>Username</label>
        <input type="text" class="form-control" name="f_nip" value="<?=$row->id_number?>" >
    </div>
    <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" class="form-control" name="f_full_name" value="<?=$row->full_name?>" >
    </div> -->
    
</div>
<div class="modal-footer">
    <input type="submit" name="f_save" class="btn btn-primary" value="Save">
</div>

<?=form_close();?>