<?=form_open('level/store')?>
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Level Add</h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">
    <div class="form-group">
        <label>Label</label>
        <input type="text" class="form-control" name="f_label">
    </div>
    <div class="form-group">
        <label>Majors</label>
        <input type="text" class="form-control" name="f_majors">
    </div>
    <div class="form-group">
        <label>Level Majors</label>
        <input type="text" class="form-control" name="f_level_majors">
    </div>
</div>
<div class="modal-footer">
    <input type="submit" name="f_save" class="btn btn-primary" value="Save">
</div>

<?=form_close();?>