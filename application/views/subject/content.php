
    <?php if(isset($result)):?>
       
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                        <thead>
                            <tr class="btn-light">
                                <td class="text-primary text-center" width="5%">No</td>
                                <td class="text-primary text-center">Subject</td>
                                <td class="text-primary text-center">Diklat</td>
                                <td class="text-primary text-center">Prodi/Diklat DKP</td>
                                <td class="text-primary text-center">Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = $numbering;?>
                            <?php foreach($result as $row):?>
                                <tr>
                                    <td><?=$no?></td>
                                    <td>   
                                        <?=$row->subject_code." - ".$row->subject_title?></b>
                                    </td>
                                    <td>

                                        <?php
                                            if (!is_null($row->cat_diklat)) {
                                                echo $row->diklat;      
                                            }
                                            else {
                                                echo "-";
                                            }
                                        ?>
                                        </td>

                                    <!--
                                    <td><?=$row->cat_diklat?></td>
                                    -->
                                    <td><?=($row->prodi != NULL ? $row->prodi : $row->label_dkp)?></td>
                                    
                                    
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
                                                        <a href="<?=base_url('subject/delete/'.$row->uc)?>" class="btn btn-danger">
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

        
        
            <div class="col-md-12 page-subject">
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

           $('.load-form').load(base_url+'subject/add');
        });

        $('.btn-edit').click(function(){

            var uc = $(this).attr('uc');

           $('.load-form').load(base_url+'subject/edit', {js_uc : uc});
        });

        $('.btn-search').click(function(){
            var page = 1;
            var prodi = $('select[name=f_prodi] option:selected').val();
            var diklat = $('select[name=f_diklat] option:selected').val();

            $('.load-data').load(base_url+'subject/page', {js_page : page, js_prodi : prodi, js_diklat : diklat});
        });

        $('.page-subject a.pagination-ajax').click(function(){         
            var page    = $(this).attr('title');

            var prodi = $('select[name=f_prodi] option:selected').val();
            var diklat = $('select[name=f_diklat] option:selected').val();

            $('.load-data').load(base_url+'subject/page', {js_page : page, js_prodi : prodi, js_diklat : diklat});

            return false;
        });
    });
</script>