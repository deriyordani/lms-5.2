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

   <script type="text/javascript" src="<?=base_url('assets/js/jquery-1.11.1.min.js');?>"></script>

    <script type="text/javascript" src="<?=base_url('assets/js/jquery.jCounter-0.1.4.js')?>"></script>
    <script src="<?=base_url('assets/js/jquery.slidereveal.min.js')?>"></script>
   
   
    
    <script type="text/javascript" src="<?=base_url('assets/js/assessment.js')?>"></script>

      <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            setInterval(function() {
                    var time_running = parseInt($('input[name=f_time_running]').val());
                    countup(time_running);
                }, 1000);
        function countup(time) {
        $('input[name=f_time_running]').val(time + 1);

        }


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

 
<input type="hidden" name="f_in_attempt" value="<?=$this->session->userdata('in_attempt')?>" />
<input type="hidden" name="f_curr_no" value="1" />
<input type="hidden" name="f_max_no" value="<?=$max_question?>"  /> 
<input type="hidden" name="f_att_code" value="<?=$att_code?>" />
<input type="hidden" name="f_uc_exam" value="<?=$uc_exam?>" />
<input type="hidden" name="f_duration" value="<?=($duration == 0 ? "" : $duration)?>" />
<input type="hidden" name="f_duration_reminder" value="<?=$duration?>" />
<input type="hidden" name="f_time_running" value="<?=$time_running?>">

<?php $this->load->helper('text'); ?>
<div class="container-fluid">
    
    <div class="row fixed-top">
        <div class="col-md-12">
            <div class="row bg-primary py-3">
                <table width="88%" align="center">
                    <tr>
                        <td width="80%"><h4 class="text-uppercase text-white pt-1" style="font-size: 0.8em"><?=character_limiter($result[0]->content_title, 30)?> [Continue Mode]</h4></td>
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

   


        <div class="quest-1 question-each">
            <input type="hidden" name="f_question_type" value="<?=$result[0]->question_type?>" />
            <input type="hidden" name="f_max_option" value="<?=count($result)?>" />

            <div class="row mt-3 p-2 ">
               
                

            </div>
        </div>
    
   

       

    
    <div class="row" style="padding-bottom: 70px">
        <div class="col-md-12">&nbsp</div>
    </div>

    <div class="row mt-2 fixed-bottom" style="background-color: #C1C1C1">
        <div class="col-md-12 text-center py-2">
            <a href=""  class="btn btn-dark">
                <i class="fa fa-save"></i> &nbsp; Kembali Ke Elearning
            </a>
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
        <?php for ($i=1; $i<=100; $i++) : ?>
                
                <?php if (($i == 5) || ($i == 12)) : ?>
                    <a href="#" class="qnumber-each answered">
                        <?=$i?>
                    </a>
                <?php else : ?>    
                    <a href="#" class="qnumber-each">
                        <?=$i?>
                    </a> 
                <?php endif; ?>
           
            
        <?php endfor; ?>
    </div>  


</div>

</body>



</html>