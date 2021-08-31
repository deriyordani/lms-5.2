 $(document).ready(function(){

    var idleTime = 0;

    var base_url = $("#base-url").html();
    var sess_category = $("#category-sess").html();

    if (sess_category == 3) {
        setInterval(timerIncrement, 30000);
    }


    function leave(){
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: base_url + 'presensi/leave_section',
            success: function(result) {

                //window.location.reload();
                
                //alert(base_url + "student/classroom");
                window.location.href = base_url + "student/classroom";

                
            }
        });
    }
    

    function timerIncrement(){
        idleTime = idleTime + 1;

        if (idleTime > 1) { // 20 minutes
    
            leave();

        }

    }

    $(this).mousemove(function (e) {
        idleTime = 0;
    });

    $(this).keypress(function (e) {
        idleTime = 0;
    });
});