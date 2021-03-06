
<?php if(isset($result)):?>

        <?php foreach($result as $row):?>

            <div class="col-xl-6 col-md-12 mb-3 mt-3">
                
                <div class="card border-top-0 border-bottom-0 border-right-0 border-left-lg border-success h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div>
                                    <h2 class="medium h-2 font-weight-bold text-success mb-1">
                                        <span>[<?=$row->classroom_code?>]</span> <br />
                                        <span><?=$row->classroom_title?></span>
                                    </h2>
                                </div>
                                
                                <div class="text-xs font-weight-bold text-dark align-items-center">
                                    <?=$row->diklat?> - 
                                    <?php 
                                        if ($row->uc_diklat == "DKP") {
                                            echo $row->label_dkp;
                                        }
                                        else {
                                            echo $row->prodi;
                                        }
                                    ?>
                                </div>
                                <div class="text-xs font-weight-bold text-muted align-items-center">
                                    <?=$row->label_periode?>

                                    <?php if ($row->cat_diklat == 1) : ?>
                                        
                                    <?php else : ?>

                                    <?php endif; ?>

                                </div>    

                                <div class="medium font-weight-bold text-dark mb-1 mt-3"><?=$row->full_name?></div>
                                <div class="text-sm font-weight-bold text-primary d-inline-flex align-items-center">
                                   Kelas : [<?=$row->class_label?>] <br/>Subject : <?=$row->subject_title?>
                                </div>
                                
                                <div class="row ml-2">
                                   <div class="text-xs font-weight-bold d-inline-flex align-items-center mt-4">

                                    <a href="<?=base_url('classroom/task/'.$row->uc.'/'.$row->uc_diklat_class)?>" class="btn btn-sm  btn-primary">
                                       <i class="mr-1" data-feather="activity"></i> Manage
                                    </a>
                                    
                                    <a href="<?=base_url('classroom/participant/'.$row->uc.'/'.$row->uc_diklat_class)?>" class="ml-2 btn btn-sm  btn-secondary">
                                        <i class="mr-1" data-feather="users"></i> Participant
                                    </a>
                                    
                                    <a href="#" class="ml-4 btn-edit-classroom"  data-toggle="modal" data-target="#exampleModal" cr-code="<?=$row->classroom_code?>" cr-title="<?=$row->classroom_title?>" cr-uc="<?=$row->uc?>">
                                        <i class="fa fa-pencil-alt text-warning" style="font-size: 1.5em"></i>
                                    </a>

                                    <a href="#" class="ml-4" data-toggle="modal" data-target="#modals-delete-<?=$row->id?>">
                                        <i class="fa fa-trash-alt text-danger" style="font-size: 1.5em"></i>
                                    </a>


                                    <div class="modal fade" id="modals-delete-<?=$row->id?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                        <div class="modal-dialog " role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Warning</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">??</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="text-center"><i class="fa fa-info-circle" ></i> Do you really want to delete this record ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="<?=base_url('classroom/delete/'.$row->uc)?>">
                                                        <button class="btn btn-danger" type="button">Delete Classroom</button>
                                                    </a>

                                                    <button class="btn btn-light" type="button" data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                </div>
                                
                            </div>
                            <!--
                            <div class="ml-2"><i class="fas fa-tag fa-2x text-gray-200"></i></div>-->
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach;?>

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

<script type="text/javascript">
    $(document).ready(function(){
        var base_url = $("#base-url").html();

        
        $('.btn-add').click(function(){

           $('.load-form').load(base_url+'classroom/add');
        });

        $('.btn-edit').click(function(){

            var uc = $(this).attr('uc');

           $('.load-form').load(base_url+'classroom/edit', {js_uc : uc});
        });

        $('.btn-search').click(function(){
            var page = 1;
            var kategori = $('select[name=f_kategori] option:selected').val();

            $('.load-data').load(base_url+'diklat/page', {js_page : page, js_kategori : kategori});
        });

        $('.btn-edit-classroom').click(function(){
            var uc = $(this).attr('cr-uc');
            var code = $(this).attr('cr-code');
            var title = $(this).attr('cr-title');

            $('.load-form').load(base_url+'classroom/load_form_edit', {js_uc : uc, js_code : code, js_title : title});
        });

        $('.page-classroom a.pagination-ajax').click(function(){         
            var page    = $(this).attr('title');

            var kategori = $('select[name=f_kategori] option:selected').val();

            $('.load-data').load(base_url+'classroom/page', {js_page : page, js_kategori : kategori});

            return false;
        });
    });
</script>