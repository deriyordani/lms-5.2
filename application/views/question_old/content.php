
<?php if(isset($result)):?>
         <input type="hidden" name="f_uc_class" value="<?=$uc_classroom?>">
        <input type="hidden" name="f_uc_diklat_class" value="<?=$uc_diklat_class?>">
         <input type="hidden" name="f_uc_subject" value="<?=$uc_subject?>">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead>
                        <tr class="btn-light">
                            <td class="text-primary text-center" width="5%">No</td>
                            <td class="text-primary text-center">Soal</td>
                            <td class="text-primary text-center"  width="15%">Type Soal</td>
                            <td class="text-primary text-center">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = $numbering;?>
                        <?php foreach($result as $row):?>
                            <tr>
                                <td><?=$no?></td>
                                <td><?=$row->question_title?></td>
                                <td><?=($row->question_type == 1 ? 'Multiple Choice' : 'True False')?></td>
                                
                                <td width="25%">

                                    <button class="btn btn-warning btn-sm btn-view" uc="<?=$row->uc?>" data-toggle="modal" data-target="#modals-view-question">
                                        <i class="mr-1 fa fa-search" ></i> View
                                    </button>

                                    <a href="<?=base_url('question/edit/'.$row->uc.'/'.$uc_classroom.'/'.$uc_diklat_class.'/'.$uc_subject.'/'.$row->question_type)?>">
                                         <button class="btn btn-info btn-sm btn-edit" uc="<?=$row->uc?>" >
                                            <i class="mr-1 fa fa-pen-square" ></i> Edit
                                        </button>
                                    </a>
                                   

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
                                                    <a href="<?=base_url('question/delete/'.$row->uc.'/'.$uc_classroom.'/'.$uc_diklat_class.'/'.$uc_subject)?>" lass="btn btn-danger">
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

    
    
        <div class="col-md-12 page-question">
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

        
        $('.btn-add').click(function(){

           $('.load-form').load(base_url+'question/add');
        });

        $('.btn-edit').click(function(){

            var uc = $(this).attr('uc');

           $('.load-form').load(base_url+'question/edit', {js_uc : uc});
        });

        $('.btn-view').click(function(){

            var uc = $(this).attr('uc');

           $('.load-form-view').load(base_url+'question/view', {js_uc_question : uc});
        });

     

        $('.page-question a.pagination-ajax').click(function(){         
            var page    = $(this).attr('title');

            var uc_classroom = $('input[name=f_uc_class]').val();
            var uc_diklat_class = $('input[name=f_uc_diklat_class]').val();
             var uc_subject = $('input[name=f_uc_subject]').val();

            $('.load-data').load(base_url+'question/page', {js_page : page, js_classroom : uc_classroom, js_diklat_class : uc_diklat_class, js_subject : uc_subject});

            return false;
        });
    });
</script>