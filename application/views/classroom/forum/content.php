
<?php if(isset($result)):?>

	<?php foreach($result as $row):?>
		<div class=" col-md-10 mx-auto ">
           


            <div class="card card-header-actions mb-3">
                <div class="card-header">
                    <a href="<?=base_url('classroom/view_forum/'.$uc_classroom.'/'.$uc_diklat_class.'/'.$row->uc)?>">
                        <?=$row->topic?>
                    </a>
                    
                    <div class="dropdown no-caret">
                        <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="more-vertical"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right animated--fade-in-up" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="<?=base_url('classroom/edit_forum/'.$uc_classroom.'/'.$uc_diklat_class.'/'.$row->uc)?>">Edit</a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modals-delete-<?=$row->id?>">Delete</a>

                            

                        </div>
                    </div>
                </div>
            </div>

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
                            <a href="<?=base_url('classroom/delete_forum/'.$uc_classroom.'/'.$uc_diklat_class.'/'.$row->uc)?>" class="btn btn-danger">
                                Delete Forum
                            </a>

                            <button class="btn btn-light" type="button" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

                
           
        </div>
	<?php endforeach;?>

	<div class="col-md-10 mx-auto page-peserta-diklat">
        <?php if (isset($pagination)) : ?>
            <?=$pagination?>
        <?php endif; ?>
    </div>

<?php else:?>
	<div class="col-md-10 mx-auto">
	    <div class="alert alert-red alert-solid text-center" role="alert">Empty..</div>
	</div>
<?php endif;?>

<script type="text/javascript">
    $(document).ready(function(){
        var base_url = $("#base-url").html();

        
       

        $('.page-classroom a.pagination-ajax').click(function(){         
            var page    = $(this).attr('title');

            var kategori = $('select[name=f_kategori] option:selected').val();

            $('.load-data').load(base_url+'classroom/page', {js_page : page, js_kategori : kategori});

            return false;
        });
    });
</script>