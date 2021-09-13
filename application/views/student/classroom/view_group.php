<?php $this->load->view('classroom/info_class');?>

<div class="container-fluid">

    <div class="row mt-5 mb-5">
       
        <div class="col-md-3">

             <?php $this->load->view('student/classroom/menu_activity');?>
           
       </div>

       <div class="col-md-9">

            <div class="row">
                <div class="col-md-12">
                    <h1 class="mb-0 mt-3">Forum Diskusi : <?=$group[0]->group_name?></h1>
                    <hr class="mt-2 mb-4">
                </div>
            </div>

            <div class="row">
            	<div class="col-md-4">
            		<h3 class="text-primary">Anggota Kelompok</h3>
            		<div class="card">

            			<div class="card-body">

            				<?php if(isset($group)):?>
            					<?php foreach($group as $gr):?>
            						<div class="d-flex align-items-center justify-content-between mb-4">
		                                <div class="d-flex align-items-center flex-shrink-0 mr-3">
		                                    <div class="avatar avatar-xl mr-3 bg-gray-200">

		                                    	

		                                    	<?php 
		                                    		if($gr->photo != NULL){
		                                    			$url_img = base_url('uploads/photo/'.$gr->photo);
		                                    		}else{
		                                    			$url_img = base_url('assets/img/illustrations/profiles/profile-1.png');
		                                    		}

		                                    	?>

		                                    	<img class="avatar-img img-fluid" src="<?=$url_img?>" alt="">

		                                    </div>
		                                    <div class="d-flex flex-column font-weight-bold">
		                                        <label class="text-dark line-height-normal mb-1" ><?=$gr->full_name?></label>
		                                        <div class="small text-muted line-height-normal">Anggota Kelompok</div>
		                                    </div>
		                                </div>
		                                
		                            </div>
            					<?php endforeach;?>
            				
                            <?php else:?>
                            	<div class="col-md-12">
						            <div class="alert alert-warning alert-solid text-center" role="alert">Tidak Ada Anggota !</div>
						        </div>
                            <?php endif;?>

            			</div>
            			
            		</div>
            	</div>
            	<div class="col-md-8">
            		<h3 class="text-primary">Diskusi Kelompok</h3>
            		<div class="row mt-3">
            			<div class="col-md-12">
            				<div class="card card-icon mb-3">
		                        <div class="row no-gutters">
		                            <div class="col-auto card-icon-aside bg-primary"><i class="text-white-50" data-feather="book"></i></div>
		                            <div class="col">
		                                <div class="card-body py-5">
		                                      <h3 class="card-title text-teal mb-2"><?=$row->topic?></h3>
		                                    <p class="card-text mb-1">
		                                        <?=$row->topic_description?>


		                                        <div class="small text-muted">Posting : <?=time_format($row->create_time,'d M Y H:i')?></div>

		                                    </p>
		                                    
		                                    

		                                    <?php if($row->file_attach != NULL):?>
		                             

		                                        <a class="btn btn-success" href="<?=base_url('uploads/materi/'.$row->file_attach)?>">
		                                            <i class="fa fa-3x fa-file"></i> &nbsp; Download Lampiran
		                                        </a>

		                                    <?php else:?>
		                                              <a class="btn btn-warning" href="#">
		                                                <i class="fa fa-3x fa-file"></i> &nbsp; File Tidak Tersedia
		                                            </a>
		                                    <?php endif;?>


		                                  
		                                </div>
		                            </div>
		                        </div>
		                    </div>
            			</div>
	            		
	                </div>

	          

	                <div class="row mb-3 ">
	                	 <button data-toggle="modal" data-target="#modals-view-form" type="button" class="btn btn-komentar btn-success  mb-3 ml-3" uc="<?=$row->uc?>" ucfgroup="<?=$group[0]->uc_fgroup?>"><i class="ion ion-md-create"></i>&nbsp; Beri Komentar</button> 
	                </div>
                    


                    <div class="row mt-3">
                    	<div class="col-md-12">
                    		<div class="load-comment">
				               <?php $this->load->view('classroom/forum/load_comment'); ?>

				               
				            </div>
                    	</div>
                    	
                    </div>
                     
            	</div>
            </div>

        </div>


    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        var base_url = $("#base-url").html();

        $('.btn-edit-group').click(function(){

            var uc_classroom = $(this).attr('uc-classroom');
            var uc_diklat_class = $(this).attr('uc-diklat-class');
            var uc_forum = $(this).attr('uc-forum');
            var uc_group = $(this).attr('uc-group');

            $('.load-form-view').load(base_url+'classroom/edit_group_forum',{js_uc_classroom : uc_classroom, js_uc_diklat_class : uc_diklat_class, js_uc_forum : uc_forum, js_uc_group : uc_group});
            
        });

        $('.btn-komentar').click(function(){

            var uc_content = $(this).attr('uc');
            var uc_fgroup = $(this).attr('ucfgroup');

           $('.load-form-view').load(base_url+'classroom/form_comment_forum',{js_uc_content : uc_content, js_uc_fgroup : uc_fgroup});
        });

        
    });
</script>

<div class="modal fade" id="modals-view-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content load-form-view">
           
        </div>
    </div>
</div>