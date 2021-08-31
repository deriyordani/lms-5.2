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
    max-height: 400px;
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
<!-- User declared javascript for chat app -->
    <script type="text/javascript">
      var chat_id = "<?php echo $uc_classroom; ?>";
      var user_id = "<?php echo $uc_user; ?>";
    </script>

    <script type="text/javascript">
      var base_url = "<?php echo base_url(); ?>";
    </script>

  <script type="text/javascript" src="<?php echo base_url() . 'chat_assets/js/'; ?>chat.js"></script>


<?php $this->load->view('classroom/info_class');?>

<div class="container-fluid">

    <div class="row mt-5 mb-5">
       
        <div class="col-md-3">

             <?php $this->load->view('classroom/menu_activity');?>
           
       </div>

        <div class="col-md-9">

        	<div class="row">
                <div class="col-md-12">
                    <h1 class="mb-0 mt-3">Chat Group</h1>
                    <hr class="mt-2 mb-4">
                </div>
            </div>

            <div class="row mt-4 mb-4">
            	<div class="col-md-12">

            		<div class="card ">
            		<div class="position-relative">
						<div class="chat-messages p-4">

							<div id="chat_viewport">
	      					</div>

						</div>
						<div class="flex-grow-0 py-3 px-4 border-top">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Type your message" name="chat_message" id="chat_message">
								<button class="btn btn-primary" id="submit_message">Send</button>
							</div>
						</div>
					</div>
				</div>
            		<!-- <div class="card ">
            			<div class="card-body" style="height: 500px;overflow: auto;">
            				<div id="chat_viewport">
	      					</div>
            			</div>
            			<div class="card-footer">
            				<div class="row">
            					<div class="col-md-9">
	            					a
	            				</div>
	            				<div class="col-md-3">
	            					a
	            				</div>
            				</div>
            				
            			</div>
	            		
	            	</div> -->
            	</div>
            	
            	
            </div>

        </div>
    </div>
</div>