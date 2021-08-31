
<?php if(isset($result)):?>

	<?php foreach($result as $row):?>
		<div class=" col-md-10 mx-auto ">
                <div class="card mt-2 mb-2">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12">
                                <a  href="<?=base_url('student/classroom/view_forum/'.$uc_classroom.'/'.$uc_diklat_class.'/'.$row->uc)?>" > <i class="mr-1 mt-1" data-feather="message-square"> </i> 

                                    <?=$row->topic?>

                                </a>
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
	<div class="col-md-12">
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