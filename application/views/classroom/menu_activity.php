<div class="card card-collapsable mb-4 rounded">
    <a class="card-header bg-white" href="#menukelas" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="menukelas"> Mengelola Kelas
        <div class="card-collapsable-arrow">
            <i class="fas fa-chevron-down"></i>
        </div>
    </a>
    <div class="collapse show" id="menukelas">
            
            <?php 
                if($this->session->userdata('log_category') == 4){

                    $url = base_url('subject');
                }else{
                    $url = base_url('classroom');
                }
            ?>

            <div class="list-group list-group-flush ">
                <div class="list-group list-group-flush ">
                    <a class="list-group-item list-group-item-action" href="<?=$url?>">
                        <i class="fas fa-home fa-fw text-dark mr-2"></i>
                        Dashboard
                    </a>

                    <a class="list-group-item list-group-item-action" href="<?=base_url('classroom/task/'.$info->uc.'/'.$info->uc_diklat_class)?>">
                        <i class="fas fa-tasks fa-fw text-dark mr-2"></i>
                        Aktivitas Kelas
                    </a>

                    <a class="list-group-item list-group-item-action" href="<?=base_url('classroom/forum/'.$info->uc.'/'.$info->uc_diklat_class)?>">
                        <i class="fas fa-comments fa-fw text-dark mr-2"></i>
                       Forum
                    </a>

                    <a class="list-group-item list-group-item-action" href="<?=base_url('classroom/check_chat/'.$info->uc.'/'.$info->uc_diklat_class)?>">
                        <i class="fas fa-comments fa-fw text-dark mr-2"></i>
                       Chatting Group
                    </a>
<!-- 
                    <a class="list-group-item list-group-item-action" href="<?=base_url('question/lists/'.$info->uc.'/'.$info->uc_diklat_class.'/'.$info->uc_subject)?>">
                        <i class="fas fa-question fa-fw text-dark mr-2"></i>
                       Question Bank
                    </a> -->

                   <!--  <a class="list-group-item list-group-item-action" href="<?=base_url('presensi/view_ins/'.$info->uc.'/'.$info->uc_diklat_class.'/'.$info->uc_subject)?>">
                        <i class="fas fa-check fa-fw text-dark mr-2"></i>
                       Kehadiran
                    </a> -->

                </div>                
            </div>
       
    </div>
</div>

<div class="card card-collapsable mb-4">
    <a class="card-header bg-white" href="#laporan" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="laporan"> Laporan
        <div class="card-collapsable-arrow">
            <i class="fas fa-chevron-down"></i>
        </div>
    </a>
    <div class="collapse " id="laporan">
         <div class="list-group list-group-flush ">
            
                <!-- <a class="list-group-item list-group-item-action" href="<?=base_url('classroom')?>">
                    <i class="fas fa-clipboard-list fa-fw text-dark mr-2"></i>
                   Rekap Ujian
                </a> -->

               <!--  <a class="list-group-item list-group-item-action" href="<?=base_url('presensi/rekap/'.$info->uc.'/'.$info->uc_diklat_class)?>">
                    <i class="fas fa-clipboard-list fa-fw text-dark mr-2"></i>
                   Rekap Absensi
                </a> -->
                <a class="list-group-item list-group-item-action" href="<?=base_url('presensi/rekap_kelas/'.$info->uc.'/'.$info->uc_diklat_class)?>">
                    <i class="fas fa-clipboard-list fa-fw text-dark mr-2"></i>
                   Rekap Absensi
                </a>
        
        </div>
    </div>
</div>

<div class="card card-collapsable mb-4">
    <a class="card-header bg-white" href="#setting" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="setting"> Setting
        <div class="card-collapsable-arrow">
            <i class="fas fa-chevron-down"></i>
        </div>
    </a>
    <div class="collapse " id="setting">
        <div class="list-group list-group-flush ">
            
           <!--  <a class="list-group-item list-group-item-action" href="<?=base_url('classroom')?>">
                <i class="fas fa-info-circle fa-fw text-dark mr-2"></i>
               Informasi Classroom
            </a> -->

            <a class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modals-delete">
                <i class="fas fa-trash fa-fw text-dark mr-2"></i>
               Hapus Classroom
            </a>
        
        </div>
    </div>
</div>



