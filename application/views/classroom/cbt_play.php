<script type="text/javascript">
    $("video").attr("controlsList","nodownload");
</script>
<link href="https://vjs.zencdn.net/7.10.2/video-js.css" rel="stylesheet" />
<script src="https://vjs.zencdn.net/7.10.2/video.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('select[name=f_playlist]').on('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
  })
</script>
<script type="text/javascript">
    videojs.autoSetup();

videojs("my_video_1").ready(function () {
  console.log(this.options()); //log all of the default videojs options

  // Store the video object
  var myPlayer = this,
    id = myPlayer.id();
  // Make up an aspect ratio
  var aspectRatio = 264 / 640;

  function resizeVideoJS() {
    var width = document.getElementById(id).parentElement.offsetWidth;
    myPlayer.width(width).height(width * aspectRatio);
  }

  // Initialize resizeVideoJS()
  resizeVideoJS();
  // Then on resize call resizeVideoJS()
  window.onresize = resizeVideoJS;
});

</script>


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

            <div class="row">
                <div class="col-md-12">
                    
                    <a href="<?=base_url('classroom/content/view_cbt/'.$uc_classroom.'/'.$uc_diklat_class.'/'.$uc_content)?>" class="btn btn-dark mb-4">< Kembali ke Daftar isi</a>

                    
                </div>  
                
            </div>

            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                    <label>Playlist</label>
                    <select class="form-control form-control-lg" name="f_playlist">
                      <option value=""> --- Pilih ---</option>
                      <?php foreach ($page as $pg) : ?>
                          <option value="<?=base_url('student/classroom/section/'.$uc_classroom.'/'.$uc_diklat_class.'/'.$uc_content.'/'.$uc_tpack.'/'.$uc_tpack_section.'/'.$section.'/'.$pg->page)?>">
                            <?=$pg->page?>
                          </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
              </div>
            </div>


            <div class="row">
                <div class="col-md-12 ">

                    <video id="my_video_1" class="video-js vjs-default-skin vjs-16-9" controls preload="auto" 
                      data-setup='{ }' poster="<?=base_url()?>assets/img/cover-cbt.jpg" width="640" height="264" >
                        <source src="<?=base_url('uploads/tpack/p01/'.$section.'/'.$video.'.mp4')?>" type='video/mp4'>
                    </video>
                    

                </div>

               
            </div>


        </div>
    </div>
</div>