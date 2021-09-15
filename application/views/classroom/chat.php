<style type="text/css">
	body{margin-top:20px;}

.chat-online {
    color: #34ce57
}

.chat-offline {
    color: #e4606d
}

.chat-messages {
    display: flex;
    flex-direction: column;
    max-height: 500px;
    overflow-y: scroll
}

.chat-message-left,
.chat-message-right {
    display: flex;
    flex-shrink: 0
}

.chat-message-left {
    margin-right: auto
}

.chat-message-right {
    flex-direction: row-reverse;
    margin-left: auto
}
.py-3 {
    padding-top: 1rem!important;
    padding-bottom: 1rem!important;
}
.px-4 {
    padding-right: 1.5rem!important;
    padding-left: 1.5rem!important;
}
.flex-grow-0 {
    flex-grow: 0!important;
}
.border-top {
    border-top: 1px solid #dee2e6!important;
}
</style>



<?php $this->load->view('classroom/info_class');?>

<div class="container-fluid">

    <div class="row mt-5 mb-5">
       
        <div class="col-md-3">

             <?php $this->load->view('classroom/menu_activity');?>
           
       </div>

        <div class="col-md-9">

        	<div class="row">
                <div class="col-md-12">
                    <h1 class="mb-0 mt-3">Chatroom</h1>
                    <hr class="mt-2 mb-4">
                </div>
            </div>

            <div class="row mt-2 mb-4">
            	<div class="col-md-12">

            		<div class="card ">
                		<div class="position-relative">
    						<div class="chat-messages p-4">
                                <input type="hidden" name="uc_user" value="<?=$this->session->userdata('log_uc')?>">
                                <input type="hidden" name="f_uc_class" value="<?=$uc_class?>">
                                <input type="hidden" name="f_uc_diklat_class" value="<?=$uc_diklat_class?>">
    							<div class="chat-view">
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
    	      					</div>

    						</div>
    						<div class="flex-grow-0 py-3 px-4 border-top">
    							<div class="input-group">
    								<input type="text" class="form-control" placeholder="Type your message" name="message" id="chat_message">
    								<button class="btn btn-primary btn-send">Send</button>
    							</div>
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

        var uc_classroom = $('input[name=f_uc_class]').val();
        var uc_diklat_class = $('input[name=f_uc_diklat_class]').val();

        $('.btn-send').click(function(){
            var text = $('input[name=message]').val();
            var uc_classroom = $('input[name=f_uc_class]').val();
            var uc_diklat_class = $('input[name=f_uc_diklat_class]').val();

            $.ajax({
                type        : 'post',
                dataType    : 'json',
                data        : { js_text : text , js_uc_classroom : uc_classroom, js_uc_diklat_class : uc_diklat_class},
                url         : base_url + 'classroom/store_chat',
                success     : function(output) {

                                $('input[name=message]').val("");

                                $('.chat-view').load(base_url+'classroom/get_chatroom',{js_uc_classroom : uc_classroom, js_uc_diklat_class : uc_diklat_class})

                }
            });

        });

        setInterval(get_chats_messages, 2500);

        function get_chats_messages(){
            
            $('.chat-view').load(base_url+'classroom/get_chatroom',{js_uc_classroom : uc_classroom, js_uc_diklat_class : uc_diklat_class});

            $('div.chat-view').scrollTop($('div.chat-view')[0].scrollHeight);
        }

    });
</script>