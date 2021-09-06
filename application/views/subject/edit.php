<script type="text/javascript">
    $(document).ready(function(){

        $('select[name=f_diklat]').change(function(){
            
            var uc = $(this).val();

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

<?=form_open('subject/update')?>
<input type="hidden" name="f_uc" value="<?=$row->uc?>">
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Subject Edit</h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
</div>
<div class="modal-body">

    <div class="form-group">
        <label>Program Diklat</label>
        <select name="f_diklat" class="form-control form-control-lg">
            <?php 
                $list_diklat = list_diklat();
                if(isset($list_diklat)):
            ?>
            <option value="">---Pilih---</option>
            <?php foreach($list_diklat as $ld):?>
                <option value="<?=$ld->uc?>" <?=select_set($ld->uc, $row->uc_diklat)?>><?=$ld->diklat?></option>
            <?php endforeach;?>
        <?php endif;?>
        </select>
    </div>

    <?php if($row->uc_diklat_dkp != NULL):?>
        <div class="form-group dkp-show" >
            <label>Diklat DKP</label>
            <select name="f_diklat_dkp" class="form-control form-control-lg">
                <?php 
                    $list_dkp = list_dkp();
                    if(isset($list_dkp)):
                ?>
                <option value="">---Pilih---</option>
                <?php foreach($list_dkp as $lp):?>
                    <option value="<?=$lp->uc?>" <?=select_set($lp->uc, $row->uc_diklat_dkp)?>><?=$lp->label_dkp?></option>
                <?php endforeach;?>
            <?php endif;?>
            </select>
        </div>

    <?php else:?>
        <div class="form-group prodi-show" >
            <label>Prodi</label>
            <select name="f_prodi" class="form-control form-control-lg">
                <?php 
                    $list_prodi = list_prodi();
                    if(isset($list_prodi)):
                ?>
                <option value="">---Pilih---</option>
                <?php foreach($list_prodi as $lp):?>
                    <option value="<?=$lp->uc?>" <?=select_set($lp->uc, $row->uc_prodi)?>><?=$lp->prodi?></option>
                <?php endforeach;?>
            <?php endif;?>
            </select>
        </div>

    <?php endif;?>

    <div class="form-group">
        <label>Code Subject</label>
        <input type="text" class="form-control" name="f_subject_code" value="<?=$row->subject_code?>">
    </div>
    <div class="form-group">
        <label>Label Subject</label>
        <input type="text" class="form-control" name="f_subject_title" value="<?=$row->subject_title?>">
    </div>

    <div class="form-group">
        <label>Category</label>
        
    </div>
    <div class="form-group">
    	<div class="form-check form-check-inline">
		  <input class="form-check-input" type="radio" name="f_category" id="inlineRadio1" value="1" <?=check_set('1', $row->category)?>>
		  <label class="form-check-label" for="inlineRadio1">Teori (T)</label>
		</div>
		<div class="form-check form-check-inline">
		  <input class="form-check-input" type="radio" name="f_category" id="inlineRadio2" value="2" <?=check_set('2', $row->category)?>>
		  <label class="form-check-label" for="inlineRadio2">Praktik (P)</label>
		</div>
    </div>
</div>
<div class="modal-footer">
    <input type="submit" name="f_save" class="btn btn-primary" value="Save">
</div>

<?=form_close();?>