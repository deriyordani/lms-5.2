<div class="tab-content" id="cardPillContent">
   <div class="tab-pane fade show active" id="overviewPill" role="tabpanel" aria-labelledby="overview-pill">

   		

   			<a href="#" class="btn btn-success mb-3" data-toggle="modal" data-target="#upload-ins"> 
   				<i class="fa fa-file-excel"></i> &nbsp; Import Data
   			</a>

   	
        <?php if(isset($result)):?>
        <div class="row ml-1">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead>
                        <tr class="bg-light">
                            <td class="text-primary text-center" width="5%">No</td>
                            	<td class="text-primary text-center">NIP</td>

                            	<td class="text-primary text-center">Nama Lengkap</td>
                            	<td class="text-primary text-center">Status</td>
                            <td class="text-primary text-center">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = $numbering;?>
                        <?php foreach($result as $row):?>
                            <tr>
                                <td><?=$no?></td>
                            	<td><?=$row->id_number?></td>
                            	<td class="text-primary text-center"><?=$row->full_name?></td>
                            	<td class="text-primary text-center">
                            		<?php if($row->is_claim == 0):?>

                                        <span class="badge badge-warning text-center">Not Admitted</span>
                                    <?php else:?>
                                        <span class="badge badge-success text-center">Admit</span>
                                    <?php endif;?>
                            	</td>
                                <td width="31%">

                                     <button class="btn btn-dark btn-sm btn-change-password" uc="<?=$row->uc?>" data-toggle="modal" data-target="#exampleModal">
                                        <i class="mr-1 fa fa-key" ></i> Change Password
                                    </button>

                                    <button class="btn btn-info btn-sm btn-edit" uc="<?=$row->uc?>" data-toggle="modal" data-target="#exampleModal">
                                        <i class="mr-1 fa fa-pen-square" ></i> Edit
                                    </button>

                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modals-delete-<?=$row->id?>">
                                        <i class="mr-1 fa fa-trash-alt" ></i> Delete
                                    </button>

                                    <div class="modal fade" id="modals-delete-<?=$row->id?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                        <div class="modal-dialog " role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Warning</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="text-center"><i class="fa fa-info-circle" ></i> Do you really want to delete this record ?</p>
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

           $('.load-form').load(base_url+'users/edit_ins', {js_uc : uc});
        });

         $('.btn-change-password').click(function(){

            var uc = $(this).attr('uc');

           $('.load-form').load(base_url+'users/changepassword', {js_uc : uc,'js_category' : 'instruktur'});
        });

        // $('.btn-search').click(function(){
        //     var page = 1;
        //     var prodi = $('select[name=f_prodi] option:selected').val();
        //     var diklat = $('select[name=f_diklat] option:selected').val();

        //     $('.load-data').load(base_url+'subject/page', {js_page : page, js_prodi : prodi, js_diklat : diklat});
        // });

        $('.page-user a.pagination-ajax').click(function(){         
            var page    = $(this).attr('title');

            var category = $('input[name=js_category]').val();
            var akses = $('input[name=js_akses]').val();

            $('.load-data').load(base_url+'users/page', {js_page : page, js_category : category, js_akses : akses});

            // var prodi = $('select[name=f_prodi] option:selected').val();
            // var diklat = $('select[name=f_diklat] option:selected').val();

            // $('.load-data').load(base_url+'subject/page', {js_page : page, js_prodi : prodi, js_diklat : diklat});

            return false;
        });
    });
</script>
