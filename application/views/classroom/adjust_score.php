<script type="text/javascript">
    $(document).ready(function() {
        // $('.form-bobot-essay').find('input[name=f_bobot]').each(function(){
        //     alert('test');
        // });


        function count_score() {
            var temp_score = parseFloat($('input[name=f_temp_score]').val());
            var new_score = 0;
            var t_score_essay = 0;

            $('.escore').each(function(){
                var val = parseFloat($(this).val());
                var max = $(this).attr('max');

                if (val > max) {
                    $(this).val(max);
                }

                t_score_essay = t_score_essay + val;
            })

            
            new_score = temp_score + t_score_essay;

            $('#e-score').html(t_score_essay);
            $('#f-score').html(new_score);
            $('input[name=f_new_score]').val(new_score);
        }

        count_score();

        $('.escore').keyup(function(){
            count_score();
        });
       
    });
</script>

<div class="container-fluid">

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card card-icon mb-2">
            <div class="row no-gutters">
                <div class="col-auto card-icon-aside bg-warning"><i class="text-white-50" data-feather="clipboard"></i></div>
                
                    <div class="card-body py-2">
                        <h5 class="card-title"><h3><?=$row->content_title?></h3></h5>
                        <p class="card-text">
                            <table class="table">
                                <tr>
                                    <td width="20%">Kategori Ujian</td>
                                    <td width="3%">:</td>
                                    <td> <?=($assessment->category == 1 ? 'Latihan / Exercise' : 'Ujian / Examination')?></td>
                                </tr>
                                <tr>
                                    <td>Maksimal Mengulang</td>
                                    <td>:</td>
                                    <td> <?=($assessment->maximum_attempt != 0 ?  $assessment->maximum_attempt.'x' : '-')?></td>
                                </tr>
                                <tr>
                                    <td>Durasi Ujian</td>
                                    <td>:</td>
                                    <td><?=($assessment->duration == NULL ? "&infin;" : thousand_separator($assessment->duration/60))?> <span>minute(s)</td>
                                </tr>
                                <tr>
                                    <td>Passing Grade</td>
                                    <td>:</td>
                                    <td><?=($assessment->passing_grade == NULL ? "&infin;" : $assessment->passing_grade)?> </td>
                                </tr>
                            </table>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12 px-4">
        
        <?=form_open('classroom/update_final_score')?>
            <input type="hidden" name="f_uc_attempt" value="<?=$attempt->uc?>" />
            <input type="hidden" name="f_temp_score" value="<?=$attempt->non_essay_score?>" />
            <input type="hidden" name="f_new_score" value="<?=$attempt->score?>" />
            <input type="hidden" name="f_uc_classroom" value="<?=$uc_classroom?>" />
            <input type="hidden" name="f_uc_diklat_class" value="<?=$uc_diklat_class?>" />
            <input type="hidden" name="f_uc_content" value="<?=$uc_content?>" />

            <div class="card">    
                <div class="card-header"><h3>Essay Questions</h3></div>            
                <div class="card-body">
                
                    <?php foreach ($ques as $que) : ?>
                        <?php if ($que->question_type == 3) : ?>
                            <div class="row mb-4 p-4">
                                <h3>Pertanyaan <span class="badge badge-primary ml-3 p-2">Bobot : <?=$que->bobot?></span></h3>
                                <div class="col-md-12">
                                    <?=read_text(htmlspecialchars_decode(stripslashes($que->question_text)))?>
                                </div>
                                <h3>Jawaban</h3>
                                <div class="col-md-12">
                                    <?php if ($que->answer != NULL) : ?>
                                        <?=read_text(htmlspecialchars_decode(stripslashes($que->answer)))?>
                                    <?php else : ?>
                                        -
                                    <?php endif; ?>    
                                </div>
                                <h3>Score</h3>
                                <div class="col-md-12">
                                    <?php $escore = ($que->score != NULL ? $que->score : 0); ?>
                                    <input type="text" class="form-control escore" name="f_score[<?=$que->uc_answer?>]" max="<?=$que->bobot?>" value="<?=$escore?>" >
                                </div>
                            </div>
                            <hr style="border-color: #1a1a1a" class="mb-4" /> 
                        <?php endif; ?>
                    <?php endforeach; ?>

                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Temp. Score (Multiple Choice + True False)</h3>
                            <h2 class="text-primary" id="t-score"><?=$attempt->non_essay_score?></h2>        
                        </div>
                        <div class="col-md-3">
                            <h3>Essay Score</h3>
                            <h2 class="text-success" id="e-score">0</h2>        
                        </div>
                        <div class="col-md-3">
                            <h3>Final Score</h3>
                            <h1 class="text-danger" id="f-score"><?=$attempt->score?></h1>        
                        </div>
                    </div>
                    
                </div>
        </div>

        <input type="submit" class="form-control btn-success my-4" name="f_save" value="Save">

        <?=form_close()?>
    </div>
</div>

   
</div>