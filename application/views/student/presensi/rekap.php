   

<?php $this->load->view('classroom/info_class');?>

<div class="container-fluid">

    <div class="row mt-5 mb-5">
       
        <div class="col-md-3">

             <?php $this->load->view('student/classroom/menu_activity');?>
           
       </div>

        <div class="col-md-9">

            <div class="row">
                <div class="col-md-12">
                    <h1 class="mb-0 mt-3">Presensi</h1>
                    <hr class="mt-2 mb-4">
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col col-md-8">
                                    <h2 class="text-primary">[<?=$info->id_number?>] <?=$info->full_name?> </h2>
                                </div>
                                <div class="col-md-3 ml-auto text-right">
                                    <a href="<?=base_url('monitoring/presensi/subject/'.$info->uc_diklat.'/'.$info->uc_prodi.'/'.$uc_diklat_class)?>" class="text-warning" style="font-size: 20pt">
                                        <i class="fa fa-chevron-circle-left"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3 mt-2">
                                <div class="col-md-7">
                                    <h5>Diklat</h5>
                                    <span><?=$info->diklat?></span>
                                </div>
                                <div class="col-md-4">
                                    <h5>Program Studi</h5>
                                    <span><?=$info->prodi?></span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-7">
                                    <h5>Periode</h5>
                                    <span>
                                        <?php 
                                            if ($info->category == 1) {
                                                $label_periode = $info->label_periode." (".$info->tahun.")";
                                            }
                                            else {
                                                $label_periode = $info->label_periode." (".time_format($info->periode_mulai,"d M Y")." - ".time_format($info->periode_selesai,"d M Y").")";
                                            }
                                        ?>
                                        <?=$label_periode?>
                                    </span>
                                </div>
                                <div class="col-md-4">
                                    <h5>Kelas</h5>
                                    <span><?=$info->class_label?></span>
                                </div>
                            </div>
                            
                            <div class="table-responsive">
                                        <table class="table table-bordered table-hover" cellspacing="0">
                                            <thead class="bg-dark text-white">
                                                <tr>
                                                    <?php foreach($section as $sect_row) : ?>
                                                        <th align="center"><?=$sect_row->sequence?></th>
                                                    <?php endforeach; ?>
                                                    <th align="center">Hadir</th>
                                                    <th align="center">Ijin</th>
                                                    <th align="center">Sakit</th>
                                                    <th align="center">Alpa</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 <tr>
                                                    <?php
                                                        $presence_hadir = 0;
                                                        $presence_ijin = 0;
                                                        $presence_sakit = 0;
                                                        $presence_alpa = 0;
                                                    ?>
                                                    <?php foreach ($section as $sec) : ?>
                                                        <?php
                                                            $sign = "-";
                                                            $presence_alpa++;
                                                            $uc_section = $sec->uc;

                                                            if (@$kehadiran[$uc_section]['status']) {
                                                                $status = $kehadiran[$uc_section]['status'];
                                                                if($status == 1){
                                                                    $sign = "✓";
                                                                    $presence_hadir++;
                                                                    $presence_alpa--;
                                                                } elseif($status == 2){
                                                                    $sign = "S";
                                                                    $presence_sakit++;
                                                                    $presence_alpa--;
                                                                } elseif($status == 3){
                                                                    $sign = "I";
                                                                    $presence_ijin++;
                                                                    $presence_alpa--;
                                                                }
                                                            }
                                                            else {
                                                                $sign = "-";
                                                            }    
                                                        ?>
                                                        <td align="center">
                                                            <?=$sign?>
                                                        </td>
                                                    <?php endforeach; ?>
                                                    <td align="center"><?=$presence_hadir?></td>
                                                    <td align="center"><?=$presence_ijin?></td>
                                                    <td align="center"><?=$presence_sakit?></td>
                                                    <td align="center"><?=$presence_alpa?></td>   
                                                </tr>
                                                    
                                            </tbody>
                                            
                                        </table>
                                        
                                    </div>        

                        </div>
                    </div>
                    
                </div>
            </div>
                    



        </div>
       
    </div>

</div>