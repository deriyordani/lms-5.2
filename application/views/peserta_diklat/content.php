
    <?php if(isset($result)):?>
       
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                        <thead>
                            <tr class="btn-light">
                                <td class="text-primary text-center" width="5%">No</td>
                                <td class="text-primary text-center">No. &amp; Nama Peserta</td>
                                <td class="text-primary text-center">Diklat &amp; Kelas</td>
                                <td class="text-primary text-center">Tahun/Periode</td>
                                <td class="text-primary text-center">Status</td>
                                <td class="text-primary text-center">Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = $numbering;?>
                            <?php foreach($result as $row):?>
                                <tr>
                                    <td><?=$no?></td>
                                    <td>
                                        <?=$row->no_peserta?> <br />
                                        <?=$row->full_name?>
                                    </td>
                                    <td>   
                                        <?=$row->diklat?> <br/>
                                        <b><?=$row->prodi?><?=$row->label_dkp?> (<?=$row->class_label?>)</b>
                                    </td>
                                    <td class="text-center">
                                        <?php if($row->cat_diklat == 1):?>
                                            <?=$row->tahun?>
                                        <?php else:?>
                                            <?=time_format($row->periode_mulai, 'd M Y').'<br/> s/d <br/>'.time_format($row->periode_selesai, 'd M Y')?>
                                        <?php endif;?>
                                    </td>
                                    <td width="10%" class="text-center">
                                        <?php if($row->is_claim == 0):?>

                                            <span class="badge badge-warning text-center">Not Admitted</span>
                                            <?php $check = "disabled=''"?>
                                            <?php $label = "Change Password"?>
                                        <?php else:?>
                                            <span class="badge badge-success text-center">Admit</span>
                                            <?php $check = ""?>
                                            <?php $label = "Change Password"?>
                                        <?php endif;?>
                                    </td>
                                   
                                    <td width="38%">

                                        <button <?=$check?> class="btn btn-dark btn-sm btn-change-password-peserta " uc="<?=$row->uc_student?>" data-toggle="modal" data-target="#modal-change" title="<?=$label?>">
                                            <i class="mr-1 fa fa-key" ></i>
                                        </button>

                                        <button class="btn btn-info btn-sm btn-edit" uc="<?=$row->uc_student?>" data-toggle="modal" data-target="#exampleModal" title="Edit Peserta Diklat">
                                            <i class="mr-1 fa fa-pen-square" ></i>
                                        </button>

                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modals-delete-<?=$row->id?>">
                                            <i class="mr-1 fa fa-trash-alt" ></i> Delete Peserta
                                        </button>

                                         <button <?=$check?> class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modals-delete-user<?=$row->id?>">
                                            <i class="mr-1 fa fa-trash-alt" ></i> Delete User
                                        </button>

                                        <div class="modal fade" id="modals-delete-<?=$row->id?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <div class="modal-dialog " role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Warning</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-center"><i class="fa fa-info-circle" ></i> Apakah yakin untuk menghapus data peserta ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="<?=base_url('peserta_diklat/delete/'.$row->uc.'/'.$row->uc_student)?>" class="btn btn-danger">
                                                            Delete
                                                        </a>

                                                        <button class="btn btn-light" type="button" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="modals-delete-user<?=$row->id?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <div class="modal-dialog " role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Warning</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-center"><i class="fa fa-info-circle" ></i> Apakah yakin untuk menghapus data user ?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="<?=base_url('peserta_diklat/delete_user/'.$row->uc.'/'.$row->uc_student)?>" class="btn btn-danger">
                                                            Delete
                                                        </a>

                                                        <button class="btn btn-light" type="button" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </td>
                                </tr>
                                <?php $no++;?>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                    
                </div>
            </div>

        
        
            <div class="col-md-12 page-peserta-diklat">
                <?php if (isset($pagination)) : ?>
                    <?=$pagination?>
                <?php endif; ?>
            </div>
        

    <?php else:?>
        <div class="col-md-12">
            <div class="alert alert-red alert-solid text-center" role="alert">Empty..</div>
        </div>
    <?php endif;?>


<div class="modal fade" id="modal-change" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content load-form-change">
           
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        var base_url = $("#base-url").html();

         $('.btn-add-single').click(function(){

           $('.load-form').load(base_url+'peserta_diklat/add_single');
        });

        $('.btn-add').click(function(){

           $('.load-form').load(base_url+'peserta_diklat/add');
        });

        $('.btn-edit').click(function(){

            var uc = $(this).attr('uc');

           $('.load-form').load(base_url+'peserta_diklat/edit', {js_uc : uc,'js_category' : 'instruktur'});
        });

        $('.btn-change-password-peserta').click(function(){
            var uc = $(this).attr('uc');

           $('.load-form-change').load(base_url+'peserta_diklat/changepassword', {js_uc : uc,'js_category' : 'instruktur'});
        });

        $('.btn-search').click(function(){
            var page = 1;
            var prodi = $('select[name=f_prodi] option:selected').val();
            var diklat = $('select[name=f_diklat] option:selected').val();

            $('.load-data').load(base_url+'period/page', {js_page : page, js_prodi : prodi, js_diklat : diklat});
        });

        $('.page-peserta-diklat a.pagination-ajax').click(function(){         
            var page    = $(this).attr('title');

            var prodi = $('select[name=f_prodi] option:selected').val();
            var diklat = $('select[name=f_diklat] option:selected').val();

            $('.load-data').load(base_url+'peserta_diklat/page', {js_page : page, js_prodi : prodi, js_diklat : diklat});

            return false;
        });
    });
</script>