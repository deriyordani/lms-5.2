<?php $this->load->view('classroom/info_class');?>

<div class="container-fluid">

    <div class="row mt-5 mb-5">
       
        <div class="col-md-3">

             <?php $this->load->view('classroom/menu_activity');?>
           
       </div>

        <div class="col-md-9">

            <div class="row">
                <div class="col-md-12">
                    <h1 class="mb-0 mt-3">Kehadiran</h1>
                    <hr class="mt-2 mb-4">
                </div>
            </div>

            <div class="row mt-4 mb-4">
                <input type="hidden" name="f_uc_classroom" value="<?=$uc_classroom?>">
                <?php 

                    $data = NULL;
                    if (isset($result)) {
                        $data['result']         = $result;
                        $data['total_record']   = $total_record;
                        $data['pagination']     = $pagination;
                    }

                    $this->load->view('presensi/content_ins', $data);
                ?>

        
            </div>

           
        </div>
       
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function(){
        var base_url = $("#base-url").html();

        
        $('.btn-komentar').click(function(){

            var uc_content = $(this).attr('uc');

           $('.load-form-view').load(base_url+'classroom/form_comment',{js_uc_content : uc_content});
        });

        
    });
</script>

<div class="modal fade" id="modals-view-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content load-form-view">
           
        </div>
    </div>
</div>