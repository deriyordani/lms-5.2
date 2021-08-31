<script type="text/javascript" src="<?=base_url('assets/js/tinymce.js')?>"></script>

<?=form_open('classroom/store_nilai_assignment')?>
<input type="hidden" name="f_uc" value="<?=$row->uc?>">
<input type="hidden" name="f_uc_classroom" value="<?=$uc_classroom?>">
<input type="hidden" name="f_uc_cdiklat_class" value="<?=$uc_diklat_class?>">
<input type="hidden" name="f_uc_content" value="<?=$row->uc_assignment?>">


<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Beri Nilai</h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">
    <div class="form-group">
        <label>Nilai</label>
        <input type="number" class="form-control" name="f_nilai" value="<?=$row->score?>">
    </div>
   	<div class="form-group">
        <label>Komentar</label>
        <textarea id="editor" class="form-control " style="height: 230px;" name="f_komentar"><?=$row->comment?></textarea>
    </div>
</div>
<div class="modal-footer">
    <input type="submit" name="f_save" class="btn btn-primary" value="Save">
</div>

<?=form_close();?>