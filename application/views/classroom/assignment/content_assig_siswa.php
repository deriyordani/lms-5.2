 <?php if(isset($result)):?>

<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead>
                        <tr class="bg-light">
                            <th width="5%">No.</th>
                            <th width="15%">No. Peserta</th>
                            <th width="22%">Nama Lengkap</th>
                            <th width="15%">Waktu Pengiriman</th>
                            <th width="15%">File</th>
                            <th width="5%">Nilai</th>
                            <th width="13%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php $no = $numbering;?>
                        <?php foreach($result as $row):?>
                            <tr>
                                <td><?=$no?></td>
                                <td><?=$row->no_peserta?></td>
                                <td><?=$row->full_name?></td>
                                <td><?=time_format($row->submit_time,'d M Y H:i')?></td>
                                <td>
                                    <?php if($row->file_attach != NULL):?>
                                    <a href="<?=base_url('uploads/assignment/'.$row->file_attach)?>">
                                     <span class="badge badge-success">Lihat Tugas</span>
                                    </a>

                                    <?php else:?>
                                        <span class="badge badge-warning">Jawaban Tidak Tersedia</span>
                                    <?php endif;?>
                                </td>
                                <td><?=($row->score != NULL ? $row->score : '-')?></td>
                                <td>
                                     <button class="btn btn-info btn-sm btn-nilai" uc="<?=$row->uc?>" data-toggle="modal" data-target="#exampleModal">
                                        <i class="mr-1 fa fa-pen-square" ></i> Beri Nilai
                                    </button>
                                </td>
                            </tr>
                            <?php $no++;?>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>

<div class="col-md-12 page-assigment-siswa mt-3">
    <?php if (isset($pagination)) : ?>
        <?=$pagination?>
    <?php endif; ?>
</div>

<?php else:?>
    <div class="col-md-12">
        <div class="alert alert-red alert-solid text-center" role="alert">Empty..</div>
    </div>
<?php endif;?>

<script type="text/javascript">
    $(document).ready(function(){
        var base_url = $("#base-url").html();



        $('.btn-nilai').click(function(){

            var uc = $(this).attr('uc');
            var classroom = $('input[name=f_classroom]').val();
            var diklat_class = $('input[name=f_uc_diklat_class]').val();

           $('.load-form').load(base_url+'classroom/nilai_assignment', {js_uc : uc,js_classroom : classroom, js_diklat_class : diklat_class});
        });

        $('.page-assigment-siswa a.pagination-ajax').click(function(){         
            var page    = $(this).attr('title');

            $('.load-data').load(base_url+'classroom/page_assig_siswa', {js_page : page});

            return false;
        });
    });
</script>