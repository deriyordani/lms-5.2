
<?php if(isset($result)):?>

        <?php foreach($result as $row):?>

            <div class="col-xl-5 col-md-6 mb-3 mt-3">
                
                <div class="card border-top-0 border-bottom-0 border-right-0 border-left-lg border-success h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div ><h2 class="medium h-2 font-weight-bold text-success mb-1"><?=$row->subject_title?></h2></div>
                                <div class="medium font-weight-bold text-dark mb-1"><?=$row->full_name?></div>
                                <div class="text-xs font-weight-bold text-muted d-inline-flex align-items-center">
                                    [<?=$row->class_label?>] <?=$row->classroom_code?>
                                </div>
                                <BR/>
                                <div class="text-xs font-weight-bold d-inline-flex align-items-center">

                                    <a href="<?=base_url('monitoring/classroom/task/'.$row->uc.'/'.$row->uc_diklat_class)?>" class="btn btn-sm  mt-2 btn-transparent-dark">
                                       <i class="mr-1" data-feather="activity"></i> Monitoring
                                       
                                    </a>
                                    
                                    <a href="<?=base_url('classroom/participant/'.$row->uc.'/'.$row->uc_diklat_class)?>" class="btn btn-sm  mt-2 btn-transparent-dark">
                                        <i class="mr-1" data-feather="users"></i> Participant
                                    </a>
                                    
                                </div>
                            </div>
                            <div class="ml-2"><i class="fas fa-tag fa-2x text-gray-200"></i></div>
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

        $('.page-classroom a.pagination-ajax').click(function(){         
            var page    = $(this).attr('title');

            var kategori = $('select[name=f_kategori] option:selected').val();

            $('.load-data').load(base_url+'classroom/page', {js_page : page, js_kategori : kategori});

            return false;
        });
    });
</script>