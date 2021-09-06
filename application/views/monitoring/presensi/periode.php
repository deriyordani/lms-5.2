<?php if (isset($result)) : ?>
    <?php $i = 1; ?>
    <?php foreach ($result as $res) : ?>    
        <div class="card card-body bg-white my-1">
            <div class="row small">
                <div class="col-md-1 py-2">
                    <h5 class="plot-label"><small>No.</small></h5>
                    <span><?=$i?></span>
                </div>
                <div class="col-md-4 py-2">
                    <h5 class="plot-label"><small>Nama</small></h5>
                    <span><?=$res->label_periode?></span>
                </div>
                <div class="col-md-4 py-2">
                    <h5 class="plot-label"><small>Periode</small></h5>
                    <span>
                        <?php 
                            if ($res->category == 1) {
                                $periode = $res->tahun;
                            }
                            else {
                                $per_start = ($res->periode_mulai != NULL ? time_format($res->periode_mulai, "d M Y") : "-");
                                $per_end = ($res->periode_selesai != NULL ? time_format($res->periode_selesai, "d M Y") : "-");

                                $periode = $per_start." s/d ".$per_end;
                            }
                        ?>
                        <?=$periode?>
                    </span>
                </div>
                <div class="col-md-1 py-2">
                    <h5 class="plot-label"><small>Kelas</small></h5>
                    <span><?=$res->class_label?></span>
                </div>
                <div class="col-md-2 py-2">
                    <h5 class="plot-label"><small>Classroom</small></h5>
                    <a href="<?=base_url('monitoring/presensi/subject/'.$uc_diklat.'/'.$uc_program.'/'.$res->uc)?>" title="Subject"><i class="fa fa-list-ul"></i></a>
                </div>    
            </div>
        </div>
        <?php $i++; ?>
    <?php endforeach; ?>

<?php else : ?>
    Kosong
<?php endif; ?>