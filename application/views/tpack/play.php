<script type="text/javascript">
    $("video").attr("controlsList","nodownload");
</script>
<link href="https://vjs.zencdn.net/7.10.2/video-js.css" rel="stylesheet" />
<script src="https://vjs.zencdn.net/7.10.2/video.min.js"></script>
<style type="text/css">
    video::-internal-media-controls-download-button {
    display:none;
}

video::-webkit-media-controls-enclosure {
    overflow:hidden;
}

video::-webkit-media-controls-panel {
    width: calc(100% + 30px); /* Adjust as needed */
}
</style>
<header class="page-header page-header-dark bg-gradient-primary-to-secondary mb-4">
    <div class="container">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="file"></i></div>
                        Budaya Keselamatan, Keamanan dan Pelayanan
                    </h1>
                    <div class="page-header-subtitle">Kode Kelas : AGM96372</div>
                    <div class="page-header-subtitle">Ahli Teknika Tingkat - III (ATT - III)<br/>
                            8 Semester</div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">

            <a href="<?=base_url('classroom_student/view')?>" class="btn btn-outline-primary btn-sm rounded-0 shadow-sm px-4 py-3  mr-2 my-1">
                 <i class="mr-1" data-feather="activity"></i> Aktivitas Class
            </a>

            <a href="<?=base_url('classroom_student/forum')?>" class="btn btn-outline-primary btn-sm rounded-0 shadow-sm px-4 py-3  mr-2 my-1">
                 <i class="mr-1" data-feather="message-circle"></i> Forum
            </a>

            <a href="<?=base_url('classroom_student/task')?>" class="btn btn-primary btn-sm rounded-0 shadow-sm px-4 py-3  mr-2 my-1">
                 <i class="mr-1" data-feather="file-text"></i> Tugas Kelas
            </a>

            <a href="<?=base_url('classroom_student/participant')?>" class="btn btn-outline-primary btn-sm rounded-0 shadow-sm px-4 py-3  mr-2 my-1">
                 <i class="mr-1" data-feather="users"></i> Anggota Kelas
            </a>

        </div>
    </div>

    <div class="row mt-4">
        <div class="text-left mt-5">
            <div class="display-4  text-primary">CBT Package</div>
            <div class="display-4  text-gray">Package</div>
        </div>

    </div>

     <div class="row mt-4 mb-4">

           <div class="col-md-12">
               

               <div class="row">
                <div class="col-md-10 mx-auto">
                    <video
                    id="my-video"
                    class="video-js"
                    controls
                    preload="auto"
                    width="900"
                    height="500"
                    poster="<?=base_url()?>assets/img/cover-cbt.jpg"
                    data-setup="{}"
                  >

                    <source src="<?=base_url('uploads/tpack/p01/'.$section.'/'.$video.'.mp4')?>" type="video/mp4" />
                </div>
                
               </div>

               <div class="row mt-4 ">
                <div class="col-md-10 mx-auto">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination ">
                            <!--
                            <li class="page-item">
                              <a class="page-link" href="<?=base_url('dev/section/'.$uc_tpack.'/'.$uc_tpack_section.'/'.$section.'/'.($video - 1))?>">Prev</a>
                            </li>
                            -->
                                <?php foreach ($page as $pg) : ?>
                                    <li class="page-item"><a class="page-link" href="<?=base_url('dev/section/'.$uc_tpack.'/'.$uc_tpack_section.'/'.$section.'/'.$pg->page)?>"><?=$pg->page?></a>
                            </li>
                            <?php endforeach; ?>
                            <!--
                            <li>Next</li>
                            -->
                        </ul>
                    </nav>
                </div>
                    
               </div>

           </div>


          

    
        </div>

</div>


<div class="modal fade" id="exampleModalLg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Post Comment</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <textarea class="form-control" style="margin-top: 0px; margin-bottom: 0px; height: 206px;"></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" >Post</button>
            </div>
        </div>
    </div>
</div>