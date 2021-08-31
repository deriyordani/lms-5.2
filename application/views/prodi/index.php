<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="file"></i></div>
                        Group - Prodi
                    </h1>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php if($this->session->flashdata('info')):?>
                <?php $warning = $this->session->flashdata('info')?>
                <div class="alert <?=$warning['class']?> alert-icon" role="alert">
                    <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div class="alert-icon-aside">
                        <i class="fa <?=$warning['icon']?>"></i>
                    </div>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Pemberitahuan</h6>
                        <?=$warning['message']?>
                    </div>
                </div>
            <?php endif;?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-header-actions">
            <div class="card-header">
                Daftar Prodi
                <button class="btn btn-primary btn-sm btn-add" data-toggle="modal" data-target="#exampleModal">Add</button>
            </div>
            <div class="card-body load-data">

                <?php 

                    $data = NULL;
                    if (isset($result)) {
                        $data['result']         = $result;
                        $data['total_record']   = $total_record;
                        $data['pagination']     = $pagination;
                    }

                    $this->load->view('prodi/content', $data);
                ?>
            </div>
        </div>
        </div>
        
    </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content load-form">
           
        </div>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function(){
        var base_url = $("#base-url").html();

        
        $('.btn-add').click(function(){

           $('.load-form').load(base_url+'prodi/add');
        });

        $('.page-prodi a.pagination-ajax').click(function(){         
            var page    = $(this).attr('title');

            $('.load-data').load(base_url+'prodi/page', {js_page : page});

            return false;
        });
    });
</script>