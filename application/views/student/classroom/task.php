   

<?php $this->load->view('classroom/info_class');?>

<div class="container-fluid">

    <div class="row mt-5 mb-5">
       
        <div class="col-md-3">

             <?php $this->load->view('student/classroom/menu_activity');?>
           
       </div>

        <div class="col-md-9">

            <div class="row">
                <div class="col-md-12">
                    <h1 class="mb-0 mt-3">Aktivitas Kelas</h1>
                    <hr class="mt-2 mb-4">
                </div>
            </div>



            
                <?php if (isset($section)): ?>
                    <?php for ($i=0; $i < count($section) ; $i++) : ?>

                        <input type="hidden" name="f_uc_section" value="<?=$section[$i]['uc']?>">
                        <input type="hidden" name="f_uc_classroom" value="<?=$uc_classroom?>">


                        <div class="row mt-3 mb-3">
                            <div class="col-md-12">
                                <div class="card card-collapsable">
                                   
                                        <a  href="#section<?=$section[$i]['uc']?>" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample1" class="text-white card-header bg-dark">
                                            <?=$section[$i]['section_label']?>
                                        </a>
                                   

                                    <div class="collapse show" id="section<?=$section[$i]['uc']?>">

                                        <div class="card-body">

                                            <?php if($content != ""):?>

                                                <?php for ($j=0; $j < count($content[$i]) ; $j++) : ?>

                                                    <?php

                                                        if ($content[$i][$j]['category'] == 1) {
                                                            $icon = 'package';

                                                            $category = 'CBT By Techno Multi Utama';

                                                            $download_masteri = FALSE;
                                                            $essay = FALSE;

                                                            $form_edit = 'edit_cbt';
                                                            $detail = 'view_cbt';
                                                            $link_tugas_terkumpul = NULL;


                                                        }elseif ($content[$i][$j]['category'] == 2 || $content[$i][$j]['category'] == 3 || $content[$i][$j]['category'] == 4) {

                                                            $icon = 'book';

                                                            $category = 'Materi Pembelajaran';

                                                            $download_masteri = TRUE;
                                                            $essay = FALSE;

                                                            $form_edit = 'edit_materi';
                                                            $detail = 'view_materi';
                                                             $link_tugas_terkumpul = NULL;

                                                        }elseif ($content[$i][$j]['category'] == 5  ) {
                                                            $icon = 'clipboard';

                                                            $category = 'Tugas/Assignment';

                                                            $download_masteri = TRUE;
                                                            $essay = TRUE;

                                                            $form_edit = 'edit_assigment';
                                                            $detail = 'view_assignment';
                                                            $link_tugas_terkumpul = 'view_assignment_siswa';

                                                        }elseif($content[$i][$j]['category'] == 6){

                                                            $icon = 'youtube';

                                                            $category = 'Assessment';

                                                            $download_masteri = FALSE;
                                                            $essay = FALSE;

                                                            $form_edit = 'edit_assessment';
                                                            $detail = 'view_assessment';
                                                            $link_tugas_terkumpul = NULL;

                                                        } elseif ($content[$i][$j]['category'] == 7 ) {
                                                            $icon = 'external-link';

                                                            $category = 'Link External';
                                                            $download_masteri = FALSE;
                                                            $essay = FALSE;

                                                            $form_edit = 'edit_link';
                                                            $detail = 'view_link';
                                                            $link_tugas_terkumpul = NULL;

                                                        }

                                                        
                                                    ?>

                                                    <?php if($content[$i][$j]['seq_content'] != NULL):?>
                                                    
                                                        <div class="card card-header-actions mb-3">
                                                            <div class="card-header">
                                                                <i class="mr-1 mt-1" data-feather="<?=$icon?>"></i>  <?=$content[$i][$j]['content_title']?>
                                                                <div class="dropdown no-caret">
                                                                    <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i data-feather="more-vertical"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-right animated--fade-in-up" aria-labelledby="dropdownMenuButton">
                                                                       
                                                                        <a class="dropdown-item" href="<?=base_url('student/classroom/content/'.$detail.'/'.$uc_classroom.'/'.$uc_diklat_class.'/'.$content[$i][$j]['uc_content'])?>">Lihat</a>

                                                                       
                                                                    </div>
                                                                </div>
                                                            </div>
                                                             <div class="card-body">
                                                            <div class="form-group">
                                                                <label><b>Deskripsi</b></label><br/>
                                                                <p><?=($content[$i][$j]['content_description'] != NULL ? $content[$i][$j]['content_description'] : '-')?></p>
                                                            </div>

                                                      

                                                            <?php if($essay):?>
                                                                <div class="form-group">
                                                                    <label><b>Passing Grade</b></label><br/>
                                                                    <p><?=$content[$i][$j]['assignment_point']?></p>
                                                                </div>

                                                                
                                                                <div class="form-group">
                                                                    <label><b>Waktu Pengerjaan</b></label><br/>
                                                                </div>
                                                                <div class="row mb-3">
           
                                                                <div class="col-4">
                                                                    <label>Dari</label>
                                                                    <p><?=time_format($content[$i][$j]['time_open'],'d M Y H:i')?></p>
                                                                </div>
                                                                <div class="col-4">
                                                                    <label>Sampai</label>
                                                                    <p><?=time_format($content[$i][$j]['time_close'],'d M Y H:i')?></p>
                                                                </div>
                                                                    
                                                                </div>
                                                                
                                                            <?php endif;?>

                                                            <div class="form-group">
                                                                <label><b>Category</b></label><br/>
                                                                <p><?=$category?></p>
                                                            </div>

                                                            <div class="form-group">
                                                                <label><b>Lampiran File</b></label><br/>
                                                            </div>

                                                            <?php if($download_masteri):?>
                                                               <div class="row">
                                                                    <!-- <label><b>Lampiran File</b></label> -->

                                                                    <?php $lampiran_file = list_content_not_file($content[$i][$j]['uc_content'])?>

                                                                    <?php if(isset($lampiran_file)):?>
                                                                        <?php foreach($lampiran_file as $lf):?>
                                                                            <div class="col-md-3 btn btn-success ml-3 mt-2">
                                                                                <a  class=" w-100 text-white" href="<?=base_url('uploads/materi/'.$lf->file_attach)?>">
                                                                               <?=$lf->file_attach?>
                                                                                </a>
                                                                           </div>
                                                                        <?php endforeach;?>
                                                                    <?php else:?>
                                                                        <div class="col-md-12">
                                                                            <div class="alert alert-danger alert-solid text-center" role="alert">File Tidak Tersedia</div>
                                                                        </div>
                                                                    <?php endif;?>
                                                                  
                                                               </div>
                                                            <?php endif;?>
                                                            <br/>
                                                             <div class="form-group">
                                                                <label><b>Lampiran Link</b></label><br/>
                                                                <br/>
                                                                 <?php $lampiran_link = list_content_file(array('uc_content' => $content[$i][$j]['uc_content'], 'type' => 'link'))?>

                                                                    <?php if(isset($lampiran_link)):?>
                                                                        <?php foreach($lampiran_link as $ll):?>
                                                                            <a href="<?=$ll->file_attach?>"><?=$ll->file_attach?></a> <br/>
                                                                        <?php endforeach;?>
                                                                    <?php else:?>
                                                                        Tidak Tersedia
                                                                    <?php endif;?>
                                                            </div>

                                                            
                                                        </div>
                                                        </div>

                                                    <?php else:?>
                                                        <div class="col-md-12">
                                                            <div class="alert alert-warning alert-solid text-center" role="alert">Tidak Tersedia Konten</div>
                                                        </div>

                                                    <?php endif;?>

                                                <?php endfor;?>

                                            <?php endif;?>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endfor;?>


                <?php else:?>
                    <div class="row mt-3 mb-3">
                        <div class="col-md-12">
                            <div class="alert alert-warning alert-solid text-center" role="alert">Pertemuan Belum Diaktifkan, Hubungi Dosen/Instruktur !</div>
                        </div>
                    </div>
                <?php endif;?>


        </div>
       
    </div>

</div>