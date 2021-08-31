<?=form_open('diklat/store')?>
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Diklat Add</h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">
    <div class="form-group">
        <label>Nama Program Diklat</label>
        <input type="text" class="form-control" name="f_diklat">
    </div>
    <div class="form-group">
        <label>Category</label>
        
    </div>
    <div class="form-group">
    	<div class="form-check form-check-inline">
		  <input class="form-check-input" type="radio" name="f_category" id="inlineRadio1" value="1">
		  <label class="form-check-label" for="inlineRadio1">Long Course</label>
		</div>

		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="radio" name="f_category" id="inlineRadio2" value="2">
		  <label class="form-check-label" for="inlineRadio2">Short Course</label>
		</div>
    </div>
</div>
<div class="modal-footer">
    <input type="submit" name="f_save" class="btn btn-primary" value="Save">
</div>

<?=form_close();?>