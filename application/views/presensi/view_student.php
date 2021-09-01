<?php $this->load->view('classroom/info_class');?>

<div class="container-fluid">

    <div class="row mt-5 mb-5">
       
        <div class="col-md-3">

             <?php $this->load->view('student/classroom/menu_activity');?>
           
       	</div>

       	 <div class="col-md-9">

            <div class="row">
                <div class="col-md-12">
                    <h1 class="mb-0 mt-3">Kehadiran di Kelas</h1>
                    <hr class="mt-2 mb-4">
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

		            $this->load->view('presensi/content_student', $data);
		        ?>
		        
		    </div>

        </div>

    </div>
</div>
