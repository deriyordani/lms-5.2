<div class="tab-content" id="cardPillContent">
   <div class="tab-pane fade show active" id="overviewPill" role="tabpanel" aria-labelledby="overview-pill">
        <div class="row">
            <div class="col-md-4">
                <a href="#" class="btn btn-primary mb-3 btn-sm" data-toggle="modal" data-target="#add-form-ins"> 
                    <i class="fa fa-plus"></i> &nbsp; Add Instruktur
                </a>

                <a href="#" class="btn btn-success mb-3 btn-sm" data-toggle="modal" data-target="#upload-ins"> 
                    <i class="fa fa-file-excel"></i> &nbsp; Import Data
                </a>
            </div>
            
        </div>

        <div class="row">
            <div class="col-md-4 offset-md-6">
                <input type="text" name="f_search" class="form-control" placeholder="NIP/Nama">
            </div>
            <div class="col-md-2">
                <button class="btn btn-success btn-search">
                     <i class="fa fa-search"></i> &nbsp; Ok
                </button>
            </div>
        </div>
   		   

   	
        <?php if(isset($result)):?>
        <div class="row ml-1 mt-4">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead>
                        <tr class="bg-light">
                            <td class="text-primary text-center" width="5%">No</td>
                            	<td class="text-primary text-center" width="20%">Nama Lengkap &amp; NIK</td>

                            	<td class="text-primary text-center" width="20%">Username</td>
                            	<!-- <td class="text-primary text-center" width="5%">Status</td> -->
                            <td class="text-primary text-center">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = $numbering;?>
                        <?php foreach($result as $row):?>
                            <tr>
                                <td width=""><?=$no?></td>
                            	<td>
                                    <div class="text-dark"><?=$row->full_name?> </div>
                                    <div class="small mt-2"><?=$row->id_number?> </div>
                                </td>
                            	<!-- <td class="text-primary text-center">
                                    <?=$row->username?>   
                                </td> -->
                            	<td class="text-primary text-center">
                            		<?php if($row->is_claim == 0):?>

                                        <span class="badge badge-warning text-center">Not Admitted</span>
                                        <?php $check = "disabled=''"?>
                                        <?php $label = "Change Password"?>
                                    <?php else:?>
                                        <?=$row->username?>
                                        <?php $check = ""?>
                                        <?php $label = "Change Password"?>
                                    <?php endif;?>
                            	</td>
                                <td width="31%">

                                     <button <?=$check?> class="btn btn-dark btn-sm btn-change-password " uc="<?=$row->uc?>" data-toggle="modal" data-target="#modal-change">
                                        <i class="mr-1 fa fa-key" ></i>
                                    </button>

                                    <button class="btn btn-info btn-sm btn-edit" uc="<?=$row->uc?>" data-toggle="modal" data-target="#modal-change">
                                        <i class="mr-1 fa fa-pen-square" ></i> Edit
                                    </button>

                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modals-delete-<?=$row->id?>">
                                        <i class="mr-1 fa fa-trash-alt" ></i> Delete Instruktur
                                    </button>



                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modals-delete-user-<?=$row->id?>">
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
                                                    <p class="text-center"><i class="fa fa-info-circle" ></i> Apakah yakin menghapus data instruktur ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="<?=base_url('users/delete_ins/'.$row->uc)?>" class="btn btn-danger">
                                                        Delete
                                                    </a>

                                                    <button class="btn btn-light" type="button" data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="modal fade" id="modals-delete-user-<?=$row->id?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                        <div class="modal-dialog " role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Warning</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="text-center"><i class="fa fa-info-circle" ></i> Apakah yakin menghapus data user ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="<?=base_url('users/delete_user/'.$row->uc)?>" class="btn btn-danger">
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
        
        <div class="row ml-1 page-user">
            <?php if (isset($pagination)) : ?>
                <?=$pagination?>
            <?php endif; ?>
        </div>

    <?php else:?>
        <div class="alert alert-red alert-solid text-center" role="alert">Empty..</div>
    <?php endif;?>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        var base_url = $("#base-url").html();

        
        // $('.btn-add').click(function(){

        //    $('.load-form').load(base_url+'subject/add');
        // });

        $('.btn-edit').click(function(){

            var uc = $(this).attr('uc');

           $('.load-form-change').load(base_url+'users/edit_ins', {js_uc : uc});
        });

         $('.btn-change-password').click(function(){

            var uc = $(this).attr('uc');

           $('.load-form-change').load(base_url+'users/changepassword', {js_uc : uc,'js_category' : 'instruktur'});
        });

        // $('.btn-search').click(function(){
        //     var page = 1;
        //     var prodi = $('select[name=f_prodi] option:selected').val();
        //     var diklat = $('select[name=f_diklat] option:selected').val();

        //     $('.load-data').load(base_url+'subject/page', {js_page : page, js_prodi : prodi, js_diklat : diklat});
        // });


        $('.btn-search').click(function(){

            var category = $('input[name=js_category]').val();    
            var page    = 1;
            var akses = $('input[name=js_akses]').val();
            var search = $('input[name=f_search]').val();
            
            $('.load-data').load(base_url+'users/page', 
                                {
                                    js_page : page,
                                    js_search : search,
                                    js_category : category, 
                                    js_akses : akses
                                }
                            );

        });

        $('.page-user a.pagination-ajax').click(function(){ 
            var category = $('input[name=js_category]').val();    
            var page    = $(this).attr('title');
            var akses = $('input[name=js_akses]').val();
            
            $('.load-data').load(base_url+'users/page', 
                                {
                                    js_page : page, 
                                    js_category : category, 
                                    js_akses : akses
                                }
                            );

            // var prodi = $('select[name=f_prodi] option:selected').val();
            // var diklat = $('select[name=f_diklat] option:selected').val();

            //$('.load-data').load(base_url+'subject/page', {js_page : page, js_prodi : prodi, js_diklat : diklat});

            //return false;
        });
    });
</script>

