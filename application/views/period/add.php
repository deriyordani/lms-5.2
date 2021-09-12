<script type="text/javascript">
    $(document).ready(function(){

        var base_url = $('#base-url').html();

        // $('select[name=f_diklat]').change(function(){
            
        //     var uc = $(this).val();

        //     //alert(uc);

        //     $.ajax({
        //          type    : 'post',
        //          dataType: 'json',
        //          data    : { 
        //                      js_uc : uc
                                

        //                  },
        //          url     : base_url + 'master/check_diklat',
        //          success : function(output)
        //          {

        //             if (output['type_course'] == 1) {

        //                 $('.long-show').css({'display' : 'block'});
        //                 $('.short-show').css({'display' : 'none'});

        //                 $('.prodi-show').css({'display' : 'block'});
        //                 $('.dkp-show').css({'display' : 'none'});

        //             }else{
        //                 $('.short-show').css({'display' : 'block'});
        //                 $('.long-show').css({'display' : 'none'});

        //                 $('.dkp-show').css({'display' : 'block'});
        //                 $('.prodi-show').css({'display' : 'none'});
        //             }    


        //          }
        //     });
 
        // });

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
    });
</script>

<?=form_open('period/store')?>
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Add Periode Diklat</h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">

    <div class="form-group">
        <label>Label</label>
        <input type="text" class="form-control" name="f_label">
    </div>

    <div class="form-group">
        <label>Program Diklat</label>
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
        <div class="select-program">
            <?php if ($this->session->userdata('log_category') == 4) : ?>
                <input type="hidden" name="f_prodi" value="<?=$this->session->userdata('log_uc_prodi')?>">
                <select class="form-control form-control-lg" disabled="">
                    <?php 
                        $list_prodi = list_prodi();
                        if(isset($list_prodi)):
                            ?>
                            <option value="">---Pilih Prodi---</option>
                                <?php foreach($list_prodi as $lp):?>
                                    <option value="<?=$lp->uc?>" <?=select_set($lp->uc, $this->session->userdata('log_uc_prodi'))?>><?=$lp->prodi?></option>
                                <?php endforeach;?>
                    <?php endif;?>
                </select>
            <?php else : ?>
                <select name="f_prodi" class="form-control form-control-lg">
                    <?php 
                        $list_prodi = list_prodi();
                        if(isset($list_prodi)):
                            ?>
                            <option value="">---Pilih Prodi---</option>
                                <?php foreach($list_prodi as $lp):?>
                                    <option value="<?=$lp->uc?>"><?=$lp->prodi?></option>
                                <?php endforeach;?>
                    <?php endif;?>
                </select>
            <?php endif; ?>
        </div>  
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

    <div>
        
    </div>

    <div class="form-group long-show" style="display: none">
        <label>Tahun</label>

        <select class="form-control" name="f_tahun">
            <?php $year_now = date("Y"); ?>
            <?php for ($i=$year_now-10; $i<=$year_now+1; $i++ ) : ?>
                <option><?=$i?></option>
            <?php endfor; ?>    
        </select>
    </div>
    <div class="short-show" style="display: none">
        <div class="row " >
            <div class="col-md-6">
                 <div class="form-group">
                    <label>Periode Mulai</label>
                    <input type="date" class="form-control" name="f_periode_mulai">
                </div>
            </div>
             <div class="col-md-6">
                <div class="form-group">
                    <label>Periode Selesai</label>
                    <input type="date" class="form-control" name="f_periode_selesai">
                </div>
            </div>
        </div>
    </div>
    
</div>
<div class="modal-footer">
    <input type="submit" name="f_save" class="btn btn-primary" value="Save">
</div>

<?=form_close();?>