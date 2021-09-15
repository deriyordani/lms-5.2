
 <div class="row">
     <div class="col-md-12 mx-auto">
          <h3 class="text-dark">Komentar</h3>
     </div>
 </div>
 <?php if(isset($comment)):?>
        <?php foreach($comment as $cm):?>
            <div class="row mt-3 mb-2">
                <div class=" col-md-12 mx-auto ">

                    <div class="card mb-2">
                        <div class="card-header">

                            <?php

                                if ($cm->photo != NULL) {
                                    
                                    $link_photo = base_url('uploads/photo/'.$this->session->userdata('log_photo'));

                                }else{

                                    $link_photo = base_url().'assets/img/illustrations/profiles/profile-2.png';

                                }

                            ?>
                            
                             <div class="media flex-wrap w-100 align-items-center"> <img src="<?=$link_photo?>" class="d-block ui-w-40 rounded-circle" alt="" style="width: 64px;height: 64px">
                                 <div class="media-body ml-3"> <a href="javascript:void(0)" data-abc="true"><?=$cm->full_name?></a>
                                     <div class="text-muted small"><?=time_format($cm->create_time,'d M Y H:i')?></div>
                                 </div>
                                 
                             </div>
                        </div>
                        <div class="card-body">
                             <p><?=$cm->comment?></p>
                            
                         </div>
                        
                    </div>
                </div>

            </div>
        <?php endforeach;?>
    <?php endif;?>