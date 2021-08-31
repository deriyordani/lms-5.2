<?=form_open('dkp/update')?>
<input type="hidden" name="f_uc" value="<?=$row->uc?>">
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">DKP Add</h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">
    <div class="form-group">
        <label>Label</label>
        <input type="text" class="form-control" name="f_label" value="<?=$row->label_dkp?>">
    </div>

</div>
<div class="modal-footer">
    <input type="submit" name="f_save" class="btn btn-primary" value="Save">
</div>

<?=form_close();?>