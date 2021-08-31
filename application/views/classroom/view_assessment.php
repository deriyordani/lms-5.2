<?php $this->load->view('classroom/info_class');?>

<div class="container-fluid">

    <div class="row mt-5 mb-5">
       
        <div class="col-md-3">

             <?php $this->load->view('classroom/menu_activity');?>
           
       </div>


       <div class="col-md-9">

            <div class="row">
                <div class="col-md-12">
                    <h1 class="mb-0 mt-3">Informasi Assessment</h1>
                   
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
                                  
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            	
            </div>

             <div class="row">
                <div class="col-md-12">
                    <h1 class="mb-0 mt-3">Peraihan Nilai</h1>
                   
                    <hr class="mt-2 mb-4">
                </div>

                <div class="col-md-12">
                    <?php if (isset($attpart)) : ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. Peserta</th>
                                <th>Nama</th>
                                <th>Score</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($attpart as $ap) : ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?=$ap->no_peserta?></td>
                                    <td><?=$ap->full_name?></td>
                                    <td>
                                        <?php $score = $ap->is_done == 1 ? $ap->score : "UF"; ?>
                                        <?=$score?>
                                    </td>
                                    <td>
                                        <a href="<?=base_url('classroom/adjust_score/'.$ap->uc.'/'.$ap->uc_assessment.'/'.$uc_classroom.'/'.$uc_diklat_class.'/'.$uc_content)?>" class="btn btn-secondary btn-sm"><i class="fa fa-pencil-alt"></i>&nbsp; Edit Essay Score</a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>    
                        </tbody>
                    </table>
                    <?php else : ?>
                        Empty
                    <?php endif; ?>    
                </div>
            </div>
        </div>


    </div>
</div>