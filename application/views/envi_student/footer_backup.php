</main>
            </div>
        </div>
        <!-- <script data-cfasync="false" src="cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> -->
       
        <script src="<?=base_url('assets/js/bootstrap.bundle.min.js')?>" crossorigin="anonymous"></script>
        <script src="<?=base_url('assets/js/scripts.js')?>"></script>
        <script src="<?=base_url('assets/third_party/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" crossorigin="anonymous"></script> -->
        <!-- <script src="<?=base_url('assets/demo/chart-area-demo.js')?>"></script>
        <script src="<?=base_url('assets/demo/chart-bar-demo.js')?>"></script>
        <script src="<?=base_url('assets/demo/chart-pie-demo.js')?>"></script> -->
       <!--  <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" crossorigin="anonymous"></script>
        <script src="<?=base_url('assets/demo/date-range-picker-demo.js')?>"></script>

        <script src="<?=base_url('assets/js/sb-customizer.js')?>"></script> -->

        <!--  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script> -->
        <!-- <sb-customizer project="sb-admin-pro"></sb-customizer> -->



        <script type="text/javascript">
            $(document).ready(function(){

                 $('.datepicker').datepicker();

      $('.timepicker').timepicker();
      $('.datetimepicker').datetimepicker({
        format: 'hh:ii',
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 1,
        minView: 0,
        maxView: 1,
        forceParse: 0
    });

                $('input[name=f_type]').click(function(){

                    var id = $(this).val();

                    if (id == 1) {
                        $('.exercise').show();
                        $('.quiz').hide();
                        $('.exam').hide();
                    }

                    if (id == 2) {
                        $('.exercise').hide();
                        $('.quiz').show();
                        $('.exam').hide();
                    }

                    if (id == 3) {
                        $('.exercise').hide();
                        $('.quiz').hide();
                        $('.exam').show();
                    }
                });
            });
        </script>

        
    </body>
</html>