<select class="form-control form-control-lg" name="f_diklat_dkp">
    <?php 
    	$result = list_dkp();
        if(isset($result)):
            ?>
            <option value="">---Pilih Program---</option>
                <?php foreach($result as $res):?>
                    <option value="<?=$res->uc?>"><?=$res->label_dkp?></option>
                <?php endforeach;?>
    <?php endif;?>
</select>