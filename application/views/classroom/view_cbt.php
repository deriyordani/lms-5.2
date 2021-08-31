<?php $this->load->view('classroom/info_class');?>

<div class="container-fluid">

    <div class="row mt-5 mb-5">
       
        <div class="col-md-3">

             <?php $this->load->view('classroom/menu_activity');?>
           
       </div>


       <div class="col-md-9">

            <div class="row">
                <div class="col-md-12">
                    <h1 class="mb-0 mt-3">Daftar isi CBT</h1>
                    <h1 class="mb-0 mt-3">Pesawat Bantu</h1>
                    <hr class="mt-2 mb-4">
                </div>
            </div>

            <div class="row mt-4 mb-4">

            	<?php if (isset($section)) : ?>
            		<?php foreach ($section as $sec) : ?>
	            	<div class="col-md-4">
	            		<div class="card mb-4">
		                    <div class="card-body text-center p-5">
		                        <img class="img-fluid mb-2" src="<?=base_url()?>assets/img/cover-cbt.jpg" />
		                        <h4>Bab. <?=$sec->sequence?> <br/><?=$sec->section_title?></h4>
		                        
		                        <a class="btn btn-primary p-3" href="<?=base_url('classroom/section/'.$uc_classroom.'/'.$uc_diklat_class.'/'.$uc_content.'/'.$sec->uc_tpack.'/'.$sec->uc.'/'.$sec->sequence)?>">Continue</a>
		                    </div>
		                </div>
	            	</div>
            	<?php endforeach; ?>
            	
            	<?php else : ?>	
					Empty
				<?php endif; ?>	
            	
            </div>
        </div>


    </div>
</div>