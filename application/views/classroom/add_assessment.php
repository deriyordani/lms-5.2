<script type="text/javascript">
    $(document).ready(function() {

        function count_remain_question(){
            var remain = $('#remain-question').text();          
            var amount  = parseInt($('input[name=f_amount]').val());
            var easy    = parseInt($('input[name=f_easy]').val());
            var medium  = parseInt($('input[name=f_medium]').val());
            var hard    = parseInt($('input[name=f_hard]').val());

            var remain = amount - (easy + medium + hard);

            if (remain < 0) {
                $('#remain-question').css('color', 'red');
            }
            else {
                $('#remain-question').css('color', '#000000');
            }

            return remain;
        }

        $('input[name=f_easy], input[name=f_medium], input[name=f_hard]').keyup(function(){
            //  Count remaining question
            var remain = count_remain_question();           

            $('#remain-question').html(remain);
        });


        $('input[name=f_composition]').change(function(){
            var mode = $('input[name=f_composition]:checked').val();

            if (mode == 1) {
                $('.grade-composition input').attr('disabled','disabled');
                $('#remain-info').addClass('disable-form');
            }
            else {
                var remain = count_remain_question();           
                $('#remain-question').html(remain);

                $('.grade-composition input').removeAttr('disabled');
                $('#remain-info').removeClass('disable-form');
            }
        });

        $('input[name=f_limit]').change(function(){
            var value = $(this).val();
            $('input[name=f_duration]').attr('disabled', 'disabled');
            
            if (value == 1) {
                $('input[name=f_duration]').removeAttr('disabled');
            }
        });

        $('input[name=f_max]').change(function(){
            var value = $(this).val();
            $('input[name=f_time]').attr('disabled', 'disabled');
            
            if (value == 1) {
                $('input[name=f_time]').removeAttr('disabled');
            }
        }); 

        // LOAD MULTI/SINGLE COURSE
        $('.radio-type').click(function(){
            var val = $(this).val();

            if (val == 2) {
                $('.load-type-multi').show();
                $('.load-type-sigle').css('display','none');
            }

            if (val == 1) {
                $('.load-type-multi').css('display','none');
                $('.load-type-sigle').show();
            }
        });

        $('input[name=f_qmode]').change(function() {
            var qmode    = $('input[name=f_qmode]:checked').val();
            
            if (qmode == 0) {
                $('input[name="f_jml"]').attr("readonly", false);
            } else  {
                $('input[name="f_jml"]').attr("readonly", true);
            }
        });
        // END LOAD MULTI/SINGLE COURSE

    });
</script>
<script type="text/javascript" src="<?=base_url('assets/js/tinymce.js')?>"></script>

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
                    <a href="<?=base_url('classroom/task/'.$uc_classroom.'/'.$uc_diklat_class)?>" class="btn btn-sm btn-light text-primary active mr-2">
                        <i data-feather="arrow-left"></i> Back
                    </a>
                </div>

            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="row">

        
        <div class=" col-md-8 mx-auto ">
            <?=form_open_multipart('classroom/store_assessment')?>
            <input type="hidden" name="f_uc_class" value="<?=$uc_classroom?>">
            <input type="hidden" name="f_uc_diklat_class" value="<?=$uc_diklat_class?>">
            <input type="hidden" name="f_category" value="6">

            <div class="form-group">
                <label>Judul Ujian</label>
                <input type="text" class="form-control" name="f_judul" required="">
            </div>

            <div class="form-group">
                 <label>Type Ujian</label>
            </div>

            
            <div class="form-group">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="f_type"  value="1">
                  <label class="form-check-label" >Exercise</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="f_type"  value="2" checked="checked">
                  <label class="form-check-label" >Examination</label>
                </div>
            </div>

            <fieldset>
                <legend>Pengaturan</legend>
                <table class="form-frame" width="100%" cellpadding="5">
                    <tr>
                        <td>Pemilihan Soal</td>
                        <td>:</td>
                        <td>
                            <input type="radio" name="f_qmode" value="0" checked="checked">&nbsp; Random &nbsp; &nbsp; &nbsp;
                            <input type="radio" name="f_qmode" value="1">&nbsp; Manual
                        </td>
                    </tr>
                    <tr>
                        <td>Jumlah Soal</td>
                        <td>:</td>
                        <td>
                            <input type="text" class="form-control col-5" name="f_jml" required="">
                        </td>
                    </tr>
                    <tr>
                        <td width="25%">Durasi</td>
                        <td width="2%">:</td>
                        <td>
                            <input type="radio" name="f_limit" value="0" checked="checked">&nbsp; Unlimited &nbsp; &nbsp; &nbsp;
                            <input type="radio" name="f_limit" value="1">&nbsp; Limited
                            <input type="text" name="f_duration" value="60" disabled size="5"> Menit
                        </td>
                    </tr>
                    <tr>
                        <td>Review Answer</td>
                        <td>:</td>
                        <td>
                            <input type="radio" name="f_review" value="0" checked> Tidak &nbsp; &nbsp; &nbsp;
                            <input type="radio" name="f_review" value="1"> Ya
                        </td>
                    </tr>
                    <tr>
                        <td>Max. Attempt</td>
                        <td>:</td>
                        <td>
                            <input type="radio" name="f_max" value="1" checked="checked"> Limited
                            <input type="text" name="f_time" style="text-align:right;" size="2" value="4"> Time <br/>
                            <input type="radio" name="f_max" value="0"> Unlimited
                        </td>
                    </tr>
                    <tr>
                        <td>Open Time</td>
                        <td>:</td>
                        <td><input type="text" name="f_open_time" class="datetimepicker form-control col-5" ></td>
                    </tr>
                    <tr>
                        <td>Close Time</td>
                        <td>:</td>
                        <td><input type="text" name="f_close_time" class="datetimepicker form-control col-5" ></td>
                    </tr>
                    <tr>
                        <td>Passing Grade</td>
                        <td>:</td>
                        <td><input type="text" name="f_passing_grade" class="form-control col-5" size="10" value="70" style="text-align:right;"></td>
                    </tr>
                    
                </table>
            </fieldset>

             <div class="form-group">
                <label>Section</label>
                <?php $list_section = list_section(array('uc_classroom' => $uc_classroom),'label_section','ASC');?>

                <select name="f_section" class="form-control form-control-lg" required="">
                    <option value="">--- Pilih ---</option>
                    <?php if(isset($list_section)):?>
                        <?php foreach($list_section as $ls):?>
                            <option value="<?=$ls->uc?>"><?=$ls->section_label?></option>
                        <?php endforeach;?>
                    <?php endif;?>
                </select>
                
            </div>

            

            

            <input type="submit" class="btn btn-success" value="Kirim" name="f_store">
            <?=form_close()?>
        </div>
        
    </div>
</div>