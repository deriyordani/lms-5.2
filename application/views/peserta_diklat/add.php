<script type="text/javascript">
    $(document).ready(function(){

        var base_url = $('#base-url').html();


        $('select[name=f_diklat]').change(function(){
            
            var uc = $(this).val();

            //alert(uc);

            // $.ajax({
            //      type    : 'post',
            //      dataType: 'json',
            //      data    : { 
            //                  js_uc : uc
                                

            //              },
            //      url     : base_url + 'master/check_diklat',
            //      success : function(output)
            //      {

            //         if (output['type_course'] == 1) {

            //             $('.long-show').css({'display' : 'block'});
            //             $('.short-show').css({'display' : 'none'});

            //             $('.prodi-show').css({'display' : 'block'});
            //             $('.dkp-show').css({'display' : 'none'});

            //         }else{
            //             $('.short-show').css({'display' : 'block'});
            //             $('.long-show').css({'display' : 'none'});

            //             $('.dkp-show').css({'display' : 'block'});
            //             $('.prodi-show').css({'display' : 'none'});
            //         }    


            //      }
            // });

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

            //alert(uc);

            // $.ajax({
            //      type    : 'post',
            //      dataType: 'json',
            //      data    : { 
            //                  js_uc : uc
                                

            //              },
            //      url     : base_url + 'master/get_diklat_info',
            //      success : function(output)
            //      {

            //         if (output['type_course'] == 1) {

            //             $('.long-show').css({'display' : 'block'});
            //             $('.short-show').css({'display' : 'none'});

            //             $('.prodi-show').css({'display' : 'block'});
            //             $('.dkp-show').css({'display' : 'none'});

            //             $('.lbl-diklat').text(output['diklat']);
            //             $('.lbl-prodi').text(output['prodi']);
            //             $('.lbl-tahun').text(output['tahun']);

            //         }else{
            //             $('.short-show').css({'display' : 'block'});
            //             $('.long-show').css({'display' : 'none'});

            //             $('.dkp-show').css({'display' : 'block'});
            //             $('.prodi-show').css({'display' : 'none'});

            //             $('.lbl-dkp').text(output['label_dkp']);
            //             $('.lbl-mulai').text(output['periode_mulai']);
            //             $('.lbl-selesai').text(output['periode_selesai']);
            //         }

            //         $('select[name=f_kelas]').load(base_url+'master/load_kelas_by_period', {js_uc_period : uc});


            //      }
            // });
 
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

<?=form_open_multipart('peserta_diklat/store')?>
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Upload Peserta Diklat</h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">

    <div class="form-group">
        <label>Periode Diklat</label>
        <select name="f_diklat" class="form-control form-control-lg">
            <?php 
                $list_diklat = list_diklat();
                if(isset($list_diklat)):
            ?>
            <option value="">---Pilih---</option>
            <?php foreach($list_diklat as $ld):?>
                <option value="<?=$ld->uc?>"><?=$ld->diklat?></option>
            <?php endforeach;?>
        <?php endif;?>
        </select>
    </div>

   
    <div class="form-group prodi-show" style="display: none;">
        <label>Prodi</label>
        <select name="f_prodi" class="form-control form-control-lg">
            <?php 
                $list_prodi = list_prodi();
                if(isset($list_prodi)):
            ?>
            <option value="">---Pilih---</option>
            <?php foreach($list_prodi as $lp):?>
                <option value="<?=$lp->uc?>"><?=$lp->prodi?></option>
            <?php endforeach;?>
        <?php endif;?>
        </select>
    </div>

    <div class="form-group dkp-show" style="display: none;">
        <label>Daftar Diklat DKP</label>
        <select name="f_diklat_dkp" class="form-control form-control-lg">
            <?php 
                $list_dkp = list_dkp();
                if(isset($list_dkp)):
            ?>
            <option value="">---Pilih---</option>
            <?php foreach($list_dkp as $lp):?>
                <option value="<?=$lp->uc?>"><?=$lp->label_dkp?></option>
            <?php endforeach;?>
        <?php endif;?>
        </select>
    </div>

    <div class="form-group">
        <label>Tahun/Periode</label>
        <select name="f_uc_diklat_periode" class="form-control form-control-lg">
             <option> --- Pilih ---</option>
        </select>
    </div>

    <div class="form-group">
        <label>Kelas</label>
        <select name="f_kelas" class="form-control form-control-lg">
            <option> --- Pilih ---</option>
        </select>
    </div>



    <div class="form-group">
        <label>Upload File</label>
        <input type="file" name="f_file" class="form-control">
    </div>
    <div class="form-group">
        <label>Template File Excel</label>
        <br/>
        <a href="<?=base_url('assets/file/temp_peserta_diklat.xls')?>">Download</a>
    </div>
   
    
</div>
<div class="modal-footer">
    <input type="submit" name="f_save" class="btn btn-primary" value="Upload">
</div>

<?=form_close();?>