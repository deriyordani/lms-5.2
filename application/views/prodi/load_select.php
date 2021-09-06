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