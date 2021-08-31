<!DOCTYPE html>
<html>
<head>
	<title></title>

	    <script type="text/javascript" src="<?php echo base_url() . 'chat_assets/js/'; ?>jquery.min.js"></script>

    <!-- User declared javascript for chat app -->
    <script type="text/javascript">
      var chat_id = "<?php echo $uc_classroom; ?>";
      var user_id = "<?php echo $uc_user; ?>";
    </script>

    <script type="text/javascript" src="<?php echo base_url() . 'chat_assets/js/'; ?>chat.js"></script>
  
    <!-- Simple WebRTC JS -->
    <script src="<?php echo base_url() ?>chat_assets/js/latest-v2.js"></script>
    
    <!-- Camera CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>chat_assets/css/camera.css">
    
    <?php
    if ($this->session->userdata('role') == 1) {
        $link = 'chat_assets/css/chat.css';
      } else {
        $link = 'chat_assets/css/chat_admin.css';
      }
    ?>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . $link; ?>">

    <script type="text/javascript">
      var base_url = "<?php echo base_url(); ?>";
    </script>
    <!-- End declaration -->

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>chat_assets/css/bootstrap.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="<?php echo base_url(); ?>chat_assets/css/bootstrap-theme.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?php echo base_url(); ?>chat_assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>chat_assets/css/theme.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="<?php echo base_url(); ?>chat_assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo base_url(); ?>chat_assets/js/ie-emulation-modes-warning.js"></script>

</head>
<body>

	<h1>Grup Chat</h1>

<table border="1">
  <tr>
    <!-- td 1 -->
    <td>
      <div id="chat_viewport">
  
      </div>
    </td>
    <!-- End of td 1 -->

  </tr>
  <tr>
    <!-- td 1 -->
    <td>
      <div id="chat_input">
        <!-- <input type="text" name="chat_message" id="chat_message" value="" tabindex="1" /> -->
        <input type="text" name="chat_message" id="chat_message" />
        <?php echo anchor('#', 'Enter', array('title' => 'Send this chat message', 'id' => 'submit_message', 'class' => 'btn btn-default btn-sm')); ?>
        <div class="clearer"></div>
      </div>
    </td>
    <!-- end of td 1 -->
  </tr>
</table>

<script type="text/javascript" charset="utf-8" async defer>
  var webrtc = new SimpleWebRTC({
    // the id/element dom element that will hold 'our' video
    localVideoEl: 'localVideo',
    // the id/element dom element that will hold remote videos
    remoteVideosEl: '',
    // immediately ask for camera access
    autoRequestMedia: true,
    media: {
        
    }
  });

  // a peer video has been added
  webrtc.on('videoAdded', function (video, peer) {
      console.log('video added', peer);
      var remotes = document.getElementById('remotesVideos');
      if (remotes) {
          var container = document.createElement('div');
          container.className = 'videoContainer';
          container.id = 'container_' + webrtc.getDomId(peer);
          container.appendChild(video);

          // suppress contextmenu
          video.oncontextmenu = function () { return false; };

          remotes.appendChild(container);
      }
  });

  // a peer video was removed
  webrtc.on('videoRemoved', function (video, peer) {
      console.log('video removed ', peer);
      var remotes = document.getElementById('remotesVideos');
      var el = document.getElementById(peer ? 'container_' + webrtc.getDomId(peer) : 'localScreenContainer');
      if (remotes && el) {
          remotes.removeChild(el);
      }
  });

  // we have to wait until it's ready
  webrtc.on('readyToCall', function () {
    // you can name it anything
    webrtc.joinRoom('<?php echo $uc_classroom; ?>');
  });
</script>



    <script src="<?php echo base_url(); ?>chat_assets/js/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>chat_assets/js/jquery.min.js"><\/script>')</script>
    <script src="<?php echo base_url(); ?>chat_assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>chat_assets/js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url(); ?>chat_assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>