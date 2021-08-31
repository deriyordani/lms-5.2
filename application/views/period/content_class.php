
<div class="data-content">
    <?php if(isset($result)):?>
        <div class="row ml-1">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead>
                        <tr class="bg-light">
                            <td class="text-primary text-center" width="5%">No</td>
                            <td class="text-primary text-center">Nama Kelas</td>
                            <td class="text-primary text-center">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = $numbering;?>
                        <?php foreach($result as $row):?>
                            <tr>
                                <td><?=$no?></td>
                                <td><?=$row->class_label?></td>
                                <td width="17%">

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
                                                    <a href="<?=base_url('period/delete_class/'.$row->uc.'/'.$row->uc_diklat_period)?>" class="btn btn-danger">
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
        
        <div class="row ml-1 page-class">
            <?php if (isset($pagination)) : ?>
                <?=$pagination?>
            <?php endif; ?>
        </div>

    <?php else:?>
        <div class="alert alert-red alert-solid text-center" role="alert">Empty..</div>
    <?php endif;?>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        var base_url = $("#base-url").html();

        
        $('.btn-add').click(function(){

            var uc_period_diklat = $(this).attr('uc');

           $('.load-form').load(base_url+'period/add_class',{js_uc_period_diklat : uc_period_diklat});
        });

        $('.btn-edit').click(function(){

            var uc = $(this).attr('uc');

           $('.load-form').load(base_url+'period/edit_class', {js_uc : uc});
        });

        $('.page-class a.pagination-ajax').click(function(){         
            var page    = $(this).attr('title');

            $('.load-data').load(base_url+'period/page_class', {js_page : page});

            return false;
        });
    });
</script>