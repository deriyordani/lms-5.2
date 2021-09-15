<link rel="stylesheet" type="text/css" href="<?=base_url('assets/third_party/fontawesome-5.13.0/css/all.css')?>">

<?php $this->load->view('classroom/info_class');?>

<div class="container-fluid">

    <div class="row mt-5 mb-5">
       
        <div class="col-md-3">

             <?php $this->load->view('classroom/menu_activity');?>
           
       </div>

        <div class="col-md-9">

            <div class="row">
                <div class="col-md-12">
                    <h1 class="mb-0 mt-3">Rekap Kehadiran</h1>
                    <hr class="mt-2 mb-4">
                </div>
            </div>
            <div class="row">
                <!--
                <div class="col-12">
                    <a href="<?=base_url('presensi/rekap_kelas/'.$uc_classroom.'/'.$uc_diklat_class.'/excel')?>" class="btn btn-sm btn-success">
                        <i class="fa fa-file-import"></i> &nbsp; Export Report
                    </a>
                </div>
            -->
            </div>
            <div class="row mt-4 mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" cellspacing="0">
                                    <thead class="bg-dark text-white">
                                        <tr>
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
                                    </thead>
                                    <tbody>
                                        <?php foreach($student as $student_info) : ?>
                                            <?php
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
                                                    foreach($section as $sect_row) :?>
                                                        <?php
                                                            $sign = "-";
                                                            $presence_alpa++;
                                                            foreach($kehadiran as $presence){
                                                                if ($presence->uc_section == $sect_row->uc && $presence->uc_diklat_participant == $student_info->uc){
                                                                    if($presence->status == 1){
                                                                        $sign = "&#10004;";
                                                                        $presence_hadir++;
                                                                        $presence_alpa--;
                                                                    } elseif($presence->status == 2){
                                                                        $sign = "S";
                                                                        $presence_sakit++;
                                                                        $presence_alpa--;
                                                                    } elseif($presence->status == 3){
                                                                        $sign = "I";
                                                                        $presence_ijin++;
                                                                        $presence_alpa--;
                                                                    }
                                                                    break;
                                                                }
                                                            }
                                                        ?>
                                                        <td align="center">
                                                            <?=$sign?>
                                                            
                                                            <?php if ($sign != "&#10004;") : ?>
                                                               
                                                                <a href="" class="edit-presence" data-toggle="modal" data-target="#form-set-presence" uc-dikpar="<?=$student_info->uc?>" uc-section="<?=$sect_row->uc?>" uc-classroom="<?=$uc_classroom ?>" student-name="<?=$student_info->full_name?>" uc-dikclass="<?=$uc_diklat_class?>">
                                                                    <i class="fa fa-pencil-alt small ml-2"></i>
                                                                </a>
                                                            <?php endif; ?>    
                                                        </td>
                                                    <?php endforeach; ?>

                                                    <td align="center"><?=$presence_hadir?></td>
                                                    <td align="center"><?=$presence_ijin?></td>
                                                    <td align="center"><?=$presence_sakit?></td>
                                                    <td align="center"><?=$presence_alpa?></td>
                                             </tr>
                                        <?php endforeach ;?>
                                            
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

<script type="text/javascript">
    $(document).ready(function(){
        var base_url = $("#base-url").html();

        
        $('.btn-komentar').click(function(){

            var uc_content = $(this).attr('uc');

           $('.load-form-view').load(base_url+'classroom/form_comment',{js_uc_content : uc_content});
        });

        $('.edit-presence').click(function(){
            var uc_dikpar = $(this).attr('uc-dikpar');
            var uc_section = $(this).attr('uc-section');
            var uc_classroom = $(this).attr('uc-classroom');
            var uc_dikclass = $(this).attr('uc-dikclass');
            var student_name = $(this).attr('student-name');

            $('input[name=f_uc_dikpar]').val(uc_dikpar);
            $('input[name=f_uc_section]').val(uc_section);
            $('input[name=f_uc_classroom]').val(uc_classroom);
            $('input[name=f_uc_dikclass]').val(uc_dikclass);
            $('.f_student_name').html(student_name);
        });
        
    });
</script>

<div class="modal fade" id="form-set-presence">
    <div class="modal-dialog">
        <div class="modal-content">

            <?=form_open_multipart('presensi/set')?>
            <input type="hidden" name="f_uc_dikpar">
            <input type="hidden" name="f_uc_section">
            <input type="hidden" name="f_uc_classroom">
            <input type="hidden" name="f_uc_dikclass">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Set Kehadiran</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body px-4">
                <h4 class="f_student_name"></h4>
                <div class="form-check-inline mt-2">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="f_presence" value="2" checked="checked">Sakit
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="f_presence" value="3">Ijin
                    </label>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <input type="submit" name="f_save" value="Save" class="btn btn-primary">
            </div>
            <?=form_close()?>
        </div>
    </div>
</div>
<!--
<div class="modal fade" id="modals-view-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content load-form-view">
           
        </div>
    </div>
</div>
-->