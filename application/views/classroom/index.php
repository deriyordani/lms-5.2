<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon">
                            <i class="fa fa-boxes"></i>
                        </div>
                        Dashboard
                    </h1>
                </div>
                 <div class="col-12 col-xl-auto mb-3">
                    <button class="btn btn-primary btn-sm  mt-2 btn-add" data-toggle="modal" data-target="#exampleModal">
                        <i class="mr-1" data-feather="file-plus"></i>  Add Classroom
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>


<div class="container">

    <div class="row align-items-center justify-content-between pt-3">
        <div class="col-auto mb-2">
            <h1 class="page-header-title">
                <div class="page-header-icon">
                    <i class="fa fa-boxes"></i> Classrooom Yang Dikelola
                </div>

            </h1>
        </div>
        
    </div>

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

    <div class="row mt-3 load-data">
        
        <?php 

            $data = NULL;
            if (isset($result)) {
                $data['result']         = $result;
                $data['total_record']   = $total_record;
                $data['pagination']     = $pagination;
            }

            $this->load->view('classroom/content', $data);
        ?>
        
    </div>

</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content load-form">
           
        </div>
    </div>
</div>