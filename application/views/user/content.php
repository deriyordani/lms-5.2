<div class="tab-content" id="cardPillContent">
   <div class="tab-pane fade show active" id="overviewPill" role="tabpanel" aria-labelledby="overview-pill">

   	    <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#add-user-prodi"> 
            <i class="fa fa-plus"></i> &nbsp; Add
        </a>

        <?php if(isset($result)):?>
        <div class="row ml-1">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead>
                        <tr class="bg-light">
                            <td class="text-primary text-center" width="5%">No</td>
                           
                            	
                            <td class="text-primary text-center">Username</td>
                            
                            
                           
                            <td class="text-primary text-center">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = $numbering;?>
                        <?php foreach($result as $row):?>
                            <tr>
                                <td><?=$no?></td>
                                <td><?=$row->username?></td>
                                
                                <td width="35%">

                                    <button class="btn btn-dark btn-sm btn-change-password" uc="<?=$row->uc?>" data-toggle="modal" data-target="#modal-change">
                                        <i class="mr-1 fa fa-key" ></i> Change Password
                                    </button>

                                    <button class="btn btn-info btn-sm btn-edit" uc="<?=$row->uc?>" data-toggle="modal" data-target="#modal-change">
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
                                                    <a href="<?=base_url('users/delete/'.$row->uc)?>" class="btn btn-danger">
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

         $('.btn-edit').click(function(){

            var uc = $(this).attr('uc');

           $('.load-form-change').load(base_url+'users/edit_user', {js_uc : uc});
        });

    
         $('.btn-change-password').click(function(){

            var uc = $(this).attr('uc');

           $('.load-form-change').load(base_url+'users/changepassword', {js_uc : uc,'js_category' : 'all'});
        });

        
    });
</script>

