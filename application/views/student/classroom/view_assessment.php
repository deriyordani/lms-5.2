<?php $this->load->view('classroom/info_class');?>

<div class="container-fluid">

    <div class="row mt-5 mb-5">
       
        <div class="col-md-3">

             <?php $this->load->view('student/classroom/menu_activity');?>
           
       </div>


        <div class="col-md-9">

            <div class="row">
                <div class="col-md-12">
                    <h1 class="mb-0 mt-3">Informasi Ujian</h1>
                    <hr class="mt-2 mb-4">
                </div>
            </div>

            <div class="row mt-4 mb-4">
            	<div class="col-md-12">
            		<div class="card card-icon mb-4">
                        <div class="row no-gutters">
                            <div class="col-auto card-icon-aside bg-warning"><i class="text-white-50" data-feather="clipboard"></i></div>
                            <div class="col">
                                <div class="card-body py-5">
                                    <h5 class="card-title"><?=$row->content_title?></h5>
                                    <p class="card-text">
                                    	<table>
                                    		<tr>
                                    			<td>Kategori Ujian</td>
                                    			<td>:</td>
                                    			<td> <?=($assessment->category == 1 ? 'Latihan / Exercise' : 'Ujian / Examination')?></td>
                                    		</tr>
                                    		<tr>
                                    			<td>Maksimal Mengulang</td>
                                    			<td>:</td>
                                    			<td> <?=($assessment->maximum_attempt != 0 ?  $assessment->maximum_attempt.'x' : '-')?></td>
                                    		</tr>
                                    		<tr>
                                    			<td>Durasi Ujian</td>
                                    			<td>:</td>
                                    			<td><?=($assessment->duration == NULL ? "&infin;" : thousand_separator($assessment->duration/60))?> <span>minute(s)</td>
                                    		</tr>
                                    		<tr>
                                    			<td>Passing Grade</td>
                                    			<td>:</td>
                                    			<td><?=($assessment->passing_grade == NULL ? "&infin;" : $assessment->passing_grade)?> </td>
                                    		</tr>
                                    		<tr>
                                    			<td>Waktu Ujian</td>
                                    			<td>:</td>
                                    			<td>
                                    				<?=($assessment->time_open != NULL ? time_format($assessment->time_open ,'d M Y H:i') : '-')?> s/d <?=($assessment->time_close != NULL ? time_format($assessment->time_close ,'d M Y H:i') : '-')?>
                                    			</td>
                                    		</tr>
                                    	</table>
                                    </p>
                                    <?=form_open('assessment/attempt')?>
                                		<input type="hidden" name="f_id" value="<?=$assessment->id?>" />
										<input type="hidden" name="f_unique" value="<?=$assessment->uc?>" />
										<input type="hidden" name="f_uc_classroom" value="<?=$uc_classroom?>">
										<input type="hidden" name="f_uc_diklat_class" value="<?=$uc_diklat_class?>">
										<input type="hidden" name="f_uc_content" value="<?=$uc_content?>">

                                    	<?php $attempted = ($assessment->uc_student != NULL ? $assessment->attempted : 0); ?>
                                    	<?php
												$attempt_status = "disabled";
												$access_status 	= FALSE;
												$current_time 	= current_time();

                                                // CHECK ACCESS TIME
												if (($assessment->time_open != NULL) && ($assessment->time_close != NULL)) {
													//	If Open Time != NULL && Close Time != NULL	
													if (($current_time > $assessment->time_open) && ($current_time < $assessment->time_close)) {
														//	If Current Time > Open Time && Current Time < Close Time
														//$attempt_status = "";
														$access_status = TRUE;
													}
												}else if (($assessment->time_open == NULL) && ($assessment->time_close != NULL)) {
													if (($current_time > $assessment->time_open) && ($current_time < $assessment->time_close)) {
														//	If Current Time > Open Time && Current Time < Close Time
														//$attempt_status = "";
														$access_status = TRUE;
													}
												}
												else if (($assessment->time_open != NULL) && ($assessment->time_close == NULL)){
													//	Else If Open Time != NULL && Close Time == NULL
													if ($current_time > $assessment->time_open) {
														//	If Current Time > Open Time 
														//$attempt_status = "";
														$access_status = TRUE;

													}
												}
												else if (($assessment->time_open == NULL) && ($assessment->time_close != NULL)) {
													//	Else If Open Time == NULL && Close Time != NULL
													if ($current_time < $assessment->time_open) {
														//	If Current Time < Close Time
														//$attempt_status = "";
														$access_status = TRUE;
													}
												}
												else if (($assessment->time_open == NULL) && ($assessment->time_close == NULL)) {
													$access_status = TRUE;	
												}

                                                if ($access_status) {
													//	CHECK ATTEMPTED
													// if (($attempted < $row->maximum_attempt) || ($row->maximum_attempt == NULL)){
													// 	//	CHECK SCORE
														
													// }

													if ($assessment->final_score <	 $assessment->passing_grade) {
                                                        if (($attempted < $assessment->maximum_attempt) || ($assessment->maximum_attempt == NULL)){
															$attempt_status = "enable";
														}
														else{
															$attempt_status = "disabled";
														}
													}
												}
											?>
                                   
                                    	<?php if ($attempt_status == "enable") : ?>
											<input type="submit" class="btn btn-success " name="f_submit" onclick="return confirm('Are you sure want to attempt this assessment?')" value="Ikuti Ujian Sekarang" />
										<?php else : ?>
											<input type="submit" class="btn btn-dark " disabled value="Ujian Telah Diikuti"  />
										<?php endif; ?>


                                    	
                                    <?=form_close()?>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
            	</div>
           	</div>
            
           	<div class="row mt-4 mb-4">
            	<div class="col-md-12">
            		<h1>Riwayat Ujian</h1>

            		<div class="card">
            			<div class="card-body">
            				<?php $history = list_score(array('uc_assessment' => $assessment->uc, 'uc_student' => $this->session->userdata('log_uc_person')));?>

            				<?php if(isset($history)):?>
            				<div class="table-responsive">
            					 <table class="table">
            					 	<tr>
            					 	
            					 		<th>Mulai Ujian</th>
            					 		<th>Selesai Ujian</th>
            					 		<th>Score</th>
            					 	</tr>

            					 	<?php foreach($history as $hs):?>
            					 		<tr>
            					 			<td><?=time_format($hs->time_start, 'd M Y H:i');?></td>
            					 			<td><?=time_format($hs->time_finish, 'd M Y H:i');?></td>
            					 			<td>
                                                <?php 
                                                    if ($hs->is_done == 1) {
                                                        $thescore = $hs->score;
                                                    }
                                                    else {
                                                        $thescore = "UF";
                                                    }
                                                ?>
                                                <?=$thescore;?>
                                            </td>
            					 		</tr>
            					 	<?php endforeach;?>
            					 </table>
            				</div>
            				<?php else:?>
            					<div class="alert alert-red alert-solid text-center" role="alert">Empty..</div>
            				<?php endif;?>
            			</div>
            		</div>
            	</div>
           	</div>
            
        </div>


    </div>
</div>