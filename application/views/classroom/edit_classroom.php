<?=form_open('classroom/update')?>
<input type="hidden" name="f_uc" value="<?=$uc?>" >
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Classroom</h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">
    <div class="form-group">
    	<label>Kode Classroom</label>
    	<input type="text" name="f_class_code" class="form-control" value="<?=$code?>" required="">
    </div>
    <div class="form-group">
    	<label>Label Classroom</label>
    	<input type="text" name="f_class_title" class="form-control" value="<?=$title?>" required="">
    </div>
</div>
<div class="modal-footer">
    <input type="submit" name="f_save" class="btn btn-primary" value="Save">
</div>

<?=form_close();?>