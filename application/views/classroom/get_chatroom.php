<?php if(isset($chatroom)):?>

    <?php foreach($chatroom as $ct):?>
    <?php 

        $user_current = ($this->session->userdata('log_uc') == $ct->uc_user) ? 'class="chat-message-right pb-4"' : 'class="chat-message-left pb-4"';

        if ($ct->photo != NULL) {

            $avatar = base_url().'uploads/photo/'.$ct->photo;

        }else{

            $avatar = base_url().'assets/img/illustrations/profiles/profile-2.png';

        }

    ?>
    <div <?=$user_current?> >
        <div>
            <img src="<?=$avatar?>" class="rounded-circle mr-1"  width="40" height="40">
            
        </div>
        <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
            <div class="font-weight-bold mb-1"><?=$ct->email?></div>
            <p><?=$ct->message?></p>
            <div class="text-muted small text-nowrap mt-2"><?=time_format($ct->current_time, 'd M Y H:i')?></div>
        </div>
    </div>
<?php endforeach;?>
<?php endif;?>