<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content />
    <meta name="author" content />
    <title>Assessment - LMS Poltek Pel Sorong</title>
    <link href="<?=base_url('assets/css/styles-student.css')?>" rel="stylesheet" />
    <link href="<?=base_url('assets/css/attempt.css')?>" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="<?=base_url('assets/img/favicon.png')?>" />

    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/third_party/jquery-confirm-v3.3.4/css/jquery-confirm.css')?>">
    <script type="text/javascript" src="<?=base_url('assets/js/jquery-1.11.1.min.js');?>"></script>

    <script type="text/javascript" src="<?=base_url('assets/js/jquery.jCounter-0.1.4.js')?>"></script>
    <script src="<?=base_url('assets/js/jquery.slidereveal.min.js')?>"></script>
   
   
    
    <script type="text/javascript" src="<?=base_url('assets/js/assessment.js')?>"></script>
     <script src="<?=base_url('assets/third_party/tinymce/tinymce.min.js')?>" ></script>
    <script type="text/javascript" src="<?=base_url('assets/js/tinymce.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/third_party/jquery-confirm-v3.3.4/js/jquery-confirm.js')?>"></script>

    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            setInterval(function() {
                    var time_running = parseInt($('input[name=f_time_running]').val());
                    $('input[name=f_time_running]').val(time_running + 1);
                }, 1000);
            


            // var time_running = parseInt($('input[name=f_time_running]').val());

            // setInterval(countup(time_running), 2500);

            // function countup(time) {
            //     $('input[name=f_time_running]').val(time + 1);

            // }

            
            

            $('#questions').slideReveal({
                trigger: $("#quetrigger"),
                position : "right",
                push : false,
                width : 300

            });

            $('#close-questions').click(function(){
                $('#questions').slideReveal("hide");
            });
        });
    </script>
</head>




    
<div id="base-url" style="display: none"><?=base_url()?></div>
<body style="padding-top: 125px">

<?=form_open('assessment/finish',array('class' => 'form-attempt'))?>
<input type="hidden" name="f_in_attempt" value="<?=$this->session->userdata('in_attempt')?>" />
<input type="hidden" name="f_curr_no" value="1" />
<input type="hidden" name="f_max_no" value="<?=$max_question?>"  /> 
<input type="hidden" name="f_att_code" value="<?=$att_code?>" />
<input type="hidden" name="f_uc_exam" value="<?=$uc_exam?>" />
<input type="hidden" name="f_duration" value="<?=($duration == 0 ? "" : $duration)?>" />
<input type="hidden" name="f_duration_reminder" value="<?=$duration?>" />

<?php $this->load->helper('text'); ?>
<div class="container-fluid">
    
    <div class="row fixed-top">
        <div class="col-md-12">
            <div class="row bg-primary py-3">
                <table width="88%" align="center">
                    <tr>
                        <td width="80%"><h4 class="text-uppercase text-white pt-1" style="font-size: 0.8em"><?=character_limiter($result[0]->content_title, 30)?> </h4></td>
                        <td width="20%" align="right"><a href="#" id="quetrigger"><i class="fa fa-th text-white"></i></a></td>
                    </tr>
                </table>
            </div>
            <div class="row bg-dark py-3">
                <table width="88%" align="center">
                    <tr>
                        <td width="15%" align="center">

                            <div class="prev-pane" >
                                <a href="#" onclick="show_prev()"  class="btn-prev" ><i class="fa fa-chevron-circle-left text-warning" style="font-size: 1.8em"></i></a>
                            </div>  

                            
                        </td>
                        <td width="70%" align="center">
                            <div id="countdown">
                                <div class="digit hours">00</div>
                                <div>:</div>
                                <div class="digit minutes">00</div>
                                <div>:</div>
                                <div class="digit seconds">00</div>
                            </div>
                        </td>
                        <td width="14%" align="center">

                            <div class="next-pane" style="">
                              <a href="#" onclick="show_next()" class="btn-next"><i class="fa fa-chevron-circle-right text-warning" style="font-size: 1.8em"></i></a> &nbsp;
                            </div>  

                            
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

   

    <?php if (isset($result)): ?>

        <div class="quest-1 question-each">
            <input type="hidden" name="f_question_type" value="<?=$result[0]->question_type?>" />
            <input type="hidden" name="f_max_option" value="<?=count($result)?>" />
            <input type="hidden" name="f_uc_assque" value="<?=$result[0]->uc?>">
            <input type="hidden" name="f_uc_ess_answer" value="<?=@$essay->uc?>">

            <div class="row mt-3 p-2 ">
               
                <div class="col-md-1 mt-2">
                    <h3>1 of <?=$max_question?>.</h3>
                </div>

                <div class="col-md-11">
                    <?php if($result[0]->question_att_file != NULL):?>
                        <div class="row mt-2">
                            <img src="<?=base_url('uploads/question/'.$result[0]->question_att_file)?>" class="img-thumbnail img-fluid mx-auto d-block">
                        </div>
                    <?php endif;?>

                    <div class="row mt-2">
                        <?=$question_text?>
                    </div>

                    <?php if ($result[0]->question_type == 1) : ?>
                        <?php foreach ($result as $res): ?>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="f_answer" value="<?=$res->option_uc?>"  /> <?=read_text(htmlspecialchars_decode(stripslashes($res->option_text)))?>

                                    <?php if($result[0]->option_att_file != NULL):?>
                                        <img src="<?=base_url('uploads/question/'.$result[0]->question_att_file)?>" class="img-thumbnail img-fluid mx-auto d-block">
                                    <?php endif;?>
                                </label>
                            </div>

                        <?php endforeach;?>
                    <?php elseif ($result[0]->question_type == 3) : ?>
                        <textarea class="form-control" id="txarea-<?=$result[0]->uc?>" name="f_essay_answer">
                            <?=@$essay->answer?>
                        </textarea>

                    <?php else:?>
                        <div class="form-check py-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="f_answer" value="1"> True
                                </label>
                            </div>

                            <div class="form-check py-2">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="f_answer" value="0"> False
                                </label>
                            </div>

                    <?php endif;?>

                </div>

            </div>
        </div>

    <?php endif;?>
    
   

       

    
    <div class="row" style="padding-bottom: 70px">
        <div class="col-md-12">&nbsp</div>
    </div>

    <div class="row mt-2 fixed-bottom" style="background-color: #C1C1C1">
        <div class="col-md-12 text-center py-2" >
            
            <button type="button" class="btn btn-danger save-finish">
                 <i class="fa fa-save"></i> &nbsp; Save and Finish
            </button>
           <!--  <a href="#" data-toggle="modal" data-target="#modals-finish"  class="btn btn-danger">
               
            </a> -->
        </div>
    </div>
    
</div>




<div class="container-fluid bg-dark fixed-right" id="questions" style="margin-top: 65px; z-index: 10000">


    <div class="row mt-3">
        <div class="col-md-12">
            <h3 class="text-warning text-center">Question Numbers</h3>
        </div>
    </div>  

    <div id="att-qnumber-list" style="width:100%; margin-top: 20px; margin-left : 20px">

        <?php for ($i=1; $i<=$max_question; $i++) : ?>
            <?php $answered = ($answers[$i-1] != "NULL" && $answers[$i-1] != "undefined" ? "answered" : ""); ?>
            
            <a href="#" class="qnumber-each <?=$answered?> " onclick="show_question(<?=$i?>)" id="qpageno-<?=$i?>" style="text-decoration: none"><div><?=$i?></div></a>
        <?php endfor; ?>


    </div>  
</div>

<?=form_close()?>

</body>



</html>