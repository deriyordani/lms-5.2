<script type="text/javascript">
    $(document).ready(function() {
        // $('.form-bobot-essay').find('input[name=f_bobot]').each(function(){
        //     alert('test');
        // });


        function count_bobot() {
            var t_bobot = 0;
            var sisa_bobot;
            var each_bobot_non_essay;
            var t_non_essay = parseFloat($('.t-non-essay').html());

            $('.ebobot').each(function(){
                var val = parseFloat($(this).val());
                t_bobot = t_bobot + val;
            })

            //alert(t_bobot);

            sisa_bobot = 100 - t_bobot;
            each_bobot_non_essay = sisa_bobot/t_non_essay;

            //alert('sisa : '+sisa_bobot);

            $('.t-bobot-essay').html(t_bobot.toFixed(2));
            $('.sisa-bobot').html(sisa_bobot.toFixed(2));
            $('.bobot-non-easay-each').html(each_bobot_non_essay.toFixed(2));
            $('input[name=f_bnee]').val(each_bobot_non_essay.toFixed(2));

            if (t_bobot >= 100) {
                $('.t-bobot-essay').addClass('text-danger');
                $('.sisa-bobot').addClass('text-danger');
                $('.bobot-non-easay-each').addClass('text-danger');
            }
        }

        count_bobot();

        $('.ebobot').keyup(function(){
            count_bobot();
        });
       
    });
</script>

<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="file"></i></div>
                        Set Bobot Questions
                    </h1>
                </div>
                 <div class="col-12 col-xl-auto mb-3">
                    
                </div>

            </div>
        </div>
    </div>
</header>


<div class="container-fluid mt-2 small">
    <?=form_open('classroom/update_bobot')?>
        <input type="hidden" name="f_uc_assessment" value="<?=$uc_assessment?>">
        <input type="hidden" name="f_bnee" value="" >
        
        <div class="row">

            <div class="col-md-6">
                <h5 class="text-primary">Set Bobot Essay</h5>

                <table class="table table-striped form-bobot-essay">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>Question</th>
                            <th>Bobot</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($q_essay as $ea) : ?>
                            <tr>
                                <td><?=$ea->question_title?></td>
                                <td><input type="text" class="form-control ebobot" name="f_bobot[<?=$ea->uc?>]" value="<?=$ea->bobot?>"></td>
                            </tr>    
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <h5 class="text-danger">Bobot Akhir</h5>

                <table class="table">
                    <tr>
                        <td>Total Question</td>
                        <td class="text-right"><?=$amt_all?></td>
                    </tr>
                    <tr>
                        <td>Question Essay</td>
                        <td class="text-right"><?=$amt_essay?></td>
                    </tr>
                    <tr>
                        <td>Question Non Essay</td>
                        <td class="text-right t-non-essay"><?=$amt_not_essay?></td>
                    </tr>
                    <tr>
                        <td>Total Bobot Essay</td>
                        <td class="text-right t-bobot-essay"></td>
                    </tr>
                    <tr>
                        <td>Sisa Bobot Non Essay</td>
                        <td class="text-right sisa-bobot"></td>
                    </tr>
                    <tr>
                        <td>Bobot Non Essay @</td>
                        <td class="text-right bobot-non-easay-each"></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="text-right mt-3">
            <input type="submit" name="f_save" value="Save" class="btn btn-primary"> 
        </div>
    <?=form_close()?>        
</div>