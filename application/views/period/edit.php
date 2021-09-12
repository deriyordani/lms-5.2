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
                        $('input[name=f_tahun]').removeAttr("disabled");
                        $('input[name=f_periode_mulai]').prop('disabled', true);
                        $('input[name=f_periode_selesai').prop('disabled', true);

                    }else{
                        $('input[name=f_tahun]').prop('disabled', true);
                        $('input[name=f_periode_mulai]').removeAttr("disabled");
                        $('input[name=f_periode_selesai]').removeAttr("disabled");
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
    });
</script>

<?=form_open('period/update')?>
<input type="hidden" name="f_uc" value="<?=$row->uc?>">
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Periode Diklat</h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">

    <div class="form-group">
        <label>Label</label>
        <input type="text" class="form-control" name="f_label" value="<?=$row->label_periode?>">
    </div>

    <div class="form-group">
        <label>Prodi</label>
        <select name="f_prodi" class="form-control form-control-lg">
            <?php 
                $list_prodi = list_prodi();
                if(isset($list_prodi)):
            ?>
            <option value="">---Pilih---</option>
            <?php foreach($list_prodi as $lp):?>
                <option value="<?=$lp->uc?>" <?=select_set($lp->uc,$row->uc_prodi)?>><?=$lp->prodi?></option>
            <?php endforeach;?>
        <?php endif;?>
        </select>
    </div>

    <div class="form-group">
        <label>Diklat</label>
        <select name="f_diklat" class="form-control form-control-lg">
            <?php 
                $list_diklat = list_diklat();
                if(isset($list_diklat)):
            ?>
            <option value="">---Pilih---</option>
            <?php foreach($list_diklat as $ld):?>
                <option value="<?=$ld->uc?>" <?=select_set($ld->uc,$row->uc_diklat)?>><?=$ld->diklat?></option>
            <?php endforeach;?>
        <?php endif;?>
        </select>
    </div>

    <?php 
    if ($row->category == 1) {
        $dis_long = "";
        $dis_short = "disabled";
    }
    else {
        $dis_long = "disabled";
        $dis_short = "";   
    }
    ?>

    <div class="form-group long-show">
        <label>Tahun</label>
        <input type="number" class="form-control" name="f_tahun" value="<?=$row->tahun?>" <?=$dis_long?> >
    </div>

    <div class="short-show">
        <div class="row">
            <div class="col-md-6">
                 <div class="form-group">
                    <label>Periode Mulai</label>
                    <input type="date" class="form-control" name="f_periode_mulai" value="<?=$row->periode_mulai?>" <?=$dis_short?> >
                </div>
            </div>
             <div class="col-md-6">
                <div class="form-group">
                    <label>Periode Selesai</label>
                    <input type="date" class="form-control" name="f_periode_selesai" value="<?=$row->periode_selesai?>" <?=$dis_short?> >
                </div>
            </div>
        </div>
    </div>


    <!--
    <?php 
        $display_short = "none"; 
        $display_long  = "none";

    ?>

    <?php if ($row->category == 1) : ?>
        
        <div class="form-group long-show" disabled>
            <label>Tahun</label>
            <input type="number" class="form-control" name="f_tahun" value="<?=$row->tahun?>">
        </div>
    <?php else : ?>
        
        <div class="short-show">
            <div class="row">
                <div class="col-md-6">
                     <div class="form-group">
                        <label>Periode Mulai</label>
                        <input type="date" class="form-control" name="f_periode_mulai" value="<?=$row->periode_mulai?>">
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <label>Periode Selesai</label>
                        <input type="date" class="form-control" name="f_periode_selesai" value="<?=$row->periode_selesai?>">
                    </div>
                </div>
            </div>
        </div>   
    <?php endif; ?>
    -->
</div>
<div class="modal-footer">
    <input type="submit" name="f_save" class="btn btn-primary" value="Save">
</div>

<?=form_close();?>