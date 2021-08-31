<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon">
                            <i class="fa fa-boxes"></i>
                        </div>
                        Classroom
                    </h1>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container">

    <div class="row mt-3 load-data">
        
        <?php 

            $data = NULL;
            if (isset($result)) {
                $data['result']         = $result;
                $data['total_record']   = $total_record;
                $data['pagination']     = $pagination;
            }

            $this->load->view('monitoring/classroom/content', $data);
        ?>
        
    </div>

</div>