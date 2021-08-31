<script type="text/javascript">
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: "dd M yyyy",
        });
    });
</script>

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg></div>
                        Schedule
                    </h1>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <h2 class="text-grey">KELOLA JADWAL</h2>
        </div>
        <div class="col-md-3">
            <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#form-add-week">Tambah Pertemuan</a>
        </div>    
    </div>
    <div class="row mt-4">
        <div class="col-md-8 small">
            <span>Diklat - Program Studi</span> <br />
            <h4>
                <?=$row->diklat?> -
                <?=$row->prodi?>
            </h4>
        </div>
        <div class="col-md-4 small">
            <span>Periode / Kelas</span> <br />

            <?php
                if ($row->category == 1) {
                    $periode_tahun = $row->tahun;
                }
                else {
                    $periode_tahun = time_format($row->periode_mulai, "d M Y")." - ".time_format($row->periode_selesai, "d M Y");
                }
            ?>
            <h4>
                <?=$periode_tahun?> / 
                <?=$row->class_label?>    
            </h4>
        </div>
    </div>

    <div class="row mt-2">
        <?php if (isset($result)) : ?>
            <?php foreach ($result as $res) : ?>
                <div class="card card-body bg-white my-1">
                    <div class="row">
                        <div class="col-md-3 py-2">
                            <h4 class="text-danger">Minggu Ke-<?=$res->minggu_ke?></h4>
                        </div>
                        <div class="col-md-6 py-2">
                            <span><b>Periode</b> : 
                                <?=time_format($res->tanggal_mulai, "d M Y")?> -
                                <?=time_format($res->tanggal_akhir, "d M Y")?>
                            </span>
                        </div>
                        <div class="col-md-3 py-2">
                            <a href="<?=base_url('monitoring/schedule/plot/'.$uc."/".$res->uc."/".$row->uc_diklat."/".$row->uc_prodi)?>" class="btn btn-success btn-sm">
                                <i class="fa fa-list mr-2"></i>Jadwal
                            </a>
                            <a href="<?=base_url('monitoring/schedule/delete_week/'.$res->uc.'/'.$res->uc)?>" class="btn btn-warning btn-sm"><i class="fa fa-trash-alt mr-2"></i>Delete</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?> 
            Empty   
        <?php endif; ?>
    </div>
</div>

<div class="modal fade" id="form-add-week">
    <div class="modal-dialog">
        <div class="modal-content">

            <?=form_open_multipart('monitoring/schedule/insert_week')?>
            <input type="hidden" name="f_uc" value="<?=$uc?>">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Pertemuan</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body px-4">
                <div class="form-group">
                    <label for="email">Minggu Ke</label>
                    <input type="text" name="f_week" class="form-control">
                </div>
                <div class="form-group"> 
                   <label for="email">Tanggal Awal</label>
                   <input type="text" class="form-control datepicker" name="f_tanggal_awal">
                </div>
                <div class="form-group"> 
                   <label for="email">Tanggal Akhir</label>
                   <input type="text" class="form-control datepicker" name="f_tanggal_akhir">
                </div>
            </div>

            <div class="modal-footer">
                <input type="submit" name="f_save" value="Tambah" class="btn btn-primary">
            </div>
            <?=form_close()?>
        </div>
    </div>
</div>