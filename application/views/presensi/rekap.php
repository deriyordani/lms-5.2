<?php $this->load->view('classroom/info_class');?>

<div class="container-fluid">

    <div class="row mt-5 mb-5">
       
        <div class="col-md-3">

             <?php $this->load->view('classroom/menu_activity');?>
           
       </div>

        <div class="col-md-9">

            <div class="row">
                <div class="col-md-9">
                    <h1 class="mb-0 mt-3">Rekap Kehadiran</h1>
                    <hr class="mt-2 mb-4">
                </div>

            </div>

            <div class="row mt-4 mb-4">
                <div class="col-md-12">
                    
                    <div class="card">
                        <div class="card-header">
                            <a class="btn btn-success" href="<?=base_url('presensi/export_rekap/'.$info->uc.'/'.$info->uc_diklat_class)?>">
                                <i class="fa fa-1x fa-file-pdf"></i> &nbsp; Export to Pdf
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr class="bg-dark text-white">
                                        <th>No Peserta</th>
                                        <th>Nama Siswa</th>
                                        <?php
                                        // Create tabel header
                                        foreach($section as $sect_row){
                                            echo "<th>".$sect_row->sequence."</th>";
                                        }
                                        ?>
                                        <th>Hadir</th>
                                        <th>Ijin</th>
                                        <th>Sakit</th>
                                        <th>Alpa</th>
                                    </tr>
                                    <?php
                                    foreach($student as $student_info){
                                        $presence_hadir = 0;
                                        $presence_ijin = 0;
                                        $presence_sakit = 0;
                                        $presence_alpa = 0;
                                    ?>
                                    <tr>
                                        <td><?=$student_info->no_peserta;?></td>
                                        <td><?=$student_info->full_name;?></td>

                                    <?php
                                        // loop check presence
                                        foreach($section as $sect_row){
                                            $sign = "-";
                                            $presence_alpa++;
                                            foreach($kehadiran as $presence){
                                                if ($presence->uc_section == $sect_row->uc && $presence->uc_diklat_participant == $student_info->uc){
                                                    if($presence->status == 1){
                                                        $sign = "&#10004;";
                                                        $presence_hadir++;
                                                        $presence_alpa--;
                                                    } elseif($presence->status == 2){
                                                        $presence_sakit++;
                                                        $presence_alpa--;
                                                    } elseif($presence->status == 3){
                                                        $presence_ijin++;
                                                        $presence_alpa--;
                                                    }
                                                    break;
                                                }
                                            }
                                            echo "<td>$sign</td>";
                                        }

                                        // presence status
                                        echo "<td>$presence_hadir</td>";
                                        echo "<td>$presence_ijin</td>";
                                        echo "<td>$presence_sakit</td>";
                                        echo "<td>$presence_alpa</td>";
                                    ?>
                                    <tr>
                                    <?php
                                    }
                                    ?>
                                
                                </table>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
               

        
            </div>

           
        </div>
       
    </div>

</div>