<div class="nav accordion" id="accordionSidenav">
    
    

   

     <?php

        $category = $this->session->userdata('log_category');

    ?>


    <?php if($category == 1):?>

        <?php $this->load->view('envi/menu_admin') ?>

    <?php elseif($category == 2):?>

        <?php $this->load->view('envi/menu_instructor') ?>

    <?php elseif($category == 3):?>

        <?php $this->load->view('envi/menu_peserta') ?>

    <?php elseif($category == 4 || $category == 5):?>

        <?php $this->load->view('envi/menu_prodi') ?>

    <?php endif;?>

</div>