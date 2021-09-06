<select class="form-control form-control-lg" name="f_diklat_dkp">
    <?php 
        if(isset($result)):
            ?>
            <option value="">---Pilih Diklat---</option>
                <?php foreach($result as $res):?>
                    <option value="<?=$res->uc?>"><?=$res->label_dkp?></option>
                <?php endforeach;?>
    <?php endif;?>
</select>