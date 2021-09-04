<script type="text/javascript">
    $(document).ready(function(){

        var base_url = $('#base-url').html();


        $('select[name=f_diklat]').change(function(){
            
            var uc = $(this).val();

             $.ajax({
                 type    : 'post',
                 dataType: 'json',
                 data    : { 
                             js_uc : uc
                                

                         },
                 url     : base_url + 'master/check_diklat',
                 success : function(output)
                 {

                    if (output['type_course'] == 1) {

                        $('.long-show').css({'display' : 'block'});
                        $('.short-show').css({'display' : 'none'});

                        // $('.prodi-show').css({'display' : 'block'});
                        // $('.dkp-show').css({'display' : 'none'});

                    }else{
                        $('.short-show').css({'display' : 'block'});
                        $('.long-show').css({'display' : 'none'});

                        // $('.dkp-show').css({'display' : 'block'});
                        // $('.prodi-show').css({'display' : 'none'});
                    }    


                 }
            });


            if (uc == 'DKP') {
                $('.dkp-show').css({'display' : 'block'});
                $('.prodi-show').css({'display' : 'none'});
            }else{

                $('.prodi-show').css({'display' : 'block'});
                $('.dkp-show').css({'display' : 'none'});
            } 
 
        });


        $('select[name=f_prodi]').change(function(){
            
            var uc_prodi = $(this).val();
            var uc_diklat = $('select[name=f_diklat] option:selected').val();

            $('select[name=f_uc_diklat_periode]').load(base_url+'master/load_tahun_periode_by_diklat_periode', {js_uc_prodi : uc_prodi, js_uc_diklat : uc_diklat});

           
 
        });

        $('select[name=f_diklat_dkp]').change(function(){
            var uc_diklat_dkp = $(this).val();
            var uc_diklat = $('select[name=f_diklat] option:selected').val();


            $('select[name=f_uc_diklat_periode]').load(base_url+'master/load_tahun_periode_by_dkp', {js_uc_dkp : uc_diklat_dkp, js_uc_diklat : uc_diklat});

        });

        $('select[name=f_uc_diklat_periode]').change(function(){

            var uc = $(this).val();

            $('select[name=f_kelas]').load(base_url+'master/load_kelas_by_period', {js_uc_period : uc});
        });

    });
</script>

<?=form_open_multipart('peserta_diklat/update')?>
<input type="hidden" name="f_uc_diklat_participant" value="<?=$diklat->uc?>">
<input type="hidden" name="f_uc_student" value="<?=$row->uc?>">
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Ubah Peserta Diklat</h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">



    <div class="form-group">
        <label>Kelas</label>
        <select name="f_kelas" class="form-control form-control-lg">
            <?php 
                $list_diklat_class = list_diklat_class(array('uc_diklat_period' => $diklat->uc_diklat_period ));
                if(isset($list_diklat_class)):
            ?>
            <option value="">---Pilih---</option>
            <?php foreach($list_diklat_class as $lp):?>
                <option value="<?=$lp->uc?>" <?=select_set($lp->uc, $diklat->uc_diklat_class)?>><?=$lp->class_label?></option>
            <?php endforeach;?>
        <?php endif;?>
        </select>
    </div>

    <div class="form-group">
        <label>No. Peserta</label>
        <input type="text" name="f_id_number" class="form-control" value="<?=$row->no_peserta?>">
    </div>

     <div class="form-group">
        <label>Nama Peserta</label>
        <input type="text" name="f_full_name" class="form-control" value="<?=$row->full_name?>">
    </div>
   
   
    
</div>
<div class="modal-footer">
    <input type="submit" name="f_save" class="btn btn-primary" value="Save">
</div>

<?=form_close();?>