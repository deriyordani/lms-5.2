
    <?php if(isset($result)):?>
       
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                        <thead>
                            <tr class="btn-light">
                                <td class="text-primary text-center" width="5%">No</td>
                                <td class="text-primary text-center">No. Peserta</td>
                                <td class="text-primary text-center">Nama Lengkap</td>
                                <td class="text-primary text-center">Last Login</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = $numbering;?>
                            <?php foreach($result as $row):?>
                                <tr>
                                    <td><?=$no?></td>
                                    <td><?=$row->no_peserta?></td>
                                    <td><?=$row->full_name?></td>
                                    <td> <?=time_format($row->last_login, 'd M Y H:i')?></td>
                                   
                                </tr>
                                <?php $no++;?>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                    
                </div>
            </div>

        
        
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

           $('.load-form').load(base_url+'peserta_diklat/add');
        });

        $('.btn-edit').click(function(){

            var uc = $(this).attr('uc');

           $('.load-form').load(base_url+'peserta_diklat/edit', {js_uc : uc});
        });

        $('.btn-search').click(function(){
            var page = 1;
            var prodi = $('select[name=f_prodi] option:selected').val();
            var diklat = $('select[name=f_diklat] option:selected').val();

            $('.load-data').load(base_url+'period/page', {js_page : page, js_prodi : prodi, js_diklat : diklat});
        });

        $('.page-peserta-diklat a.pagination-ajax').click(function(){         
            var page    = $(this).attr('title');

            var prodi = $('select[name=f_prodi] option:selected').val();
            var diklat = $('select[name=f_diklat] option:selected').val();

            $('.load-data').load(base_url+'peserta_diklat/page', {js_page : page, js_prodi : prodi, js_diklat : diklat});

            return false;
        });
    });
</script>