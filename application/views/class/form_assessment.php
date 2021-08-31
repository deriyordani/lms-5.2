
<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="file"></i></div>
                        Form Add - Assessment
                    </h1>
                </div>
                 <div class="col-12 col-xl-auto mb-3">
                    <a href="<?=base_url('classroom/task')?>" class="btn btn-sm btn-light text-primary active mr-2">
                        <i data-feather="arrow-left"></i> Back
                    </a>
                </div>

            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="row">

        <div class=" col-md-9 mx-auto ">
            <div class="form-group">
                <label>Type Assessment</label>
                
            </div>

            <div class="form-group">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="f_type" id="inlineRadio1" value="1">
                    <label class="form-check-label" for="inlineRadio1">Exercise / Latihan</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="f_type" id="inlineRadio2" value="2">
                    <label class="form-check-label" for="inlineRadio2">Quiz</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="f_type" id="inlineRadio3" value="3">
                    <label class="form-check-label" for="inlineRadio3">Examination</label>
                </div>
                
            </div>

            <div class="exercise" style="display: none;">
               <?php $this->load->view('class/form_exercise')?>
            </div>

            <div class="quiz" style="display: none;">
                <?php $this->load->view('class/form_quiz')?>
            </div>

            <div class="exam" style="display: none;">
               <?php $this->load->view('class/form_exam')?>
            </div>

           

            <input type="submit" class="btn btn-success" value="Kirim" name="">
        </div>
        
    </div>
</div>

