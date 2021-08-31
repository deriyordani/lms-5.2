<script type="text/javascript">
    $(document).ready(function(){

        $('select[name=f_diklat]').change(function(){
            
            var uc = $(this).val();

            if (uc == '602f59cb3de54') {
                $('.dkp-show').css({'display' : 'block'});
                $('.prodi-show').css({'display' : 'none'});
            }else{
                $('.prodi-show').css({'display' : 'block'});
                $('.dkp-show').css({'display' : 'none'});
            }       
        });
    });
</script>

<?=form_open('subject/update')?>
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Subject Edit</h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">


    <div class="form-group">
        <label>Code Subject</label>
        <input type="text" class="form-control" name="f_subject_code">
    </div>
    <div class="form-group">
        <label>Label Subject</label>
        <input type="text" class="form-control" name="f_subject_title">
    </div>

    <div class="form-group">
        <label>Category</label>
        
    </div>
    <div class="form-group">
    	<div class="form-check form-check-inline">
		  <input class="form-check-input" type="radio" name="f_category" id="inlineRadio1" value="1">
		  <label class="form-check-label" for="inlineRadio1">Teori (T)</label>
		</div>
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="radio" name="f_category" id="inlineRadio2" value="2">
		  <label class="form-check-label" for="inlineRadio2">Praktik (P)</label>
		</div>
    </div>
</div>
<div class="modal-footer">
    <input type="submit" name="f_save" class="btn btn-primary" value="Save">
</div>

<?=form_close();?>