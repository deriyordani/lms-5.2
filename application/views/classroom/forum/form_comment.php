<script type="text/javascript" src="<?=base_url('assets/js/tinymce.js')?>"></script>
 <script type="text/javascript">
  $(document).ready(function() { 
    var base_url = $("#base-url").html();
      $("#formComment").submit(function(e) {

        var uc_content = $('input[name=f_uc_content]').val();
        var uc_fgroup = $('input[name=f_uc_fgroup]').val();
          e.preventDefault();
          $.ajax({
              url: base_url+'classroom/store_comment_forum',
              type: 'post',
              data: $(this).serialize(),             
              success: function(data) {               
              // document.getElementById("formMhs").reset();
              // $('#status').html(data);
                $('#modals-view-form').modal('toggle');

                $('.load-comment').load(base_url+'classroom/load_comment_forum',{js_uc_content : uc_content, js_uc_fgroup : uc_fgroup});           
              }
          });
      });
  })
 </script>
<form id="formComment">
    <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Beri Komentar</h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">
    <input type="hidden" name="f_uc_content" value="<?=$uc_content?>">
    <input type="hidden" name="f_uc_fgroup" value="<?=$uc_fgroup?>">
    <div class="form-group">
        <label>Deskripsi </label>
        <textarea id="editor" class="form-control " style="height: 230px;" name="f_comment"></textarea>
    </div>
</div>
<div class="modal-footer">
    <input type="submit" name="f_save" class="btn btn-primary" value="Kirim">
</div>
</form>

