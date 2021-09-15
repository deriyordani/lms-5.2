$(document).ready(function() { 

    setInterval(get_chats_messages, 500);

    function get_chats_messages(){
        $.post(base_url + "student/classroom/ajax_get_chats_messages", { chat_id: chat_id }, function(data) {

            /* Condition */

            //alert("hello");
            if (data.status == 'ok') {
                //console.log(current_content);
                var current_content = $("div#chat_viewport").html();

                $("div#chat_viewport").html(current_content + data.content);
                
                if (!data.content == '') {
                    var notification = new Notification('Notification title', {
                      icon: '',
                      body: "Ada pesan masuk, silahkan cek!!",
                    });

                    notification.onclick = function () {
                      window.open("http://stackoverflow.com/a/13328397/1269037");      
                    };

                    /* Scroll each time you get new message */
                    $('div#chat_viewport').scrollTop($('div#chat_viewport')[0].scrollHeight);
                } else {
                    
                }
                

            } else {
                /* Error here */
            }

        }, "JSON");

    }


    $("#submit_message").click(function(e) {
        e.preventDefault();

        var content = $("input#chat_message").val();

        var userfile = $("input#userfile").val();

        if (content == "") return false;

        $.post(base_url + "student/classroom/ajax_add_chat_message", { content: content, chat_id: chat_id, user_id: user_id }, function(data) {

            /* Condition */
            if (data.status == 'ok') {

                var current_content = $("div#chat_viewport").html();

                $("div#chat_viewport").html(current_content + data.content);

                /* Scroll each time you submit new message */
                $('div#chat_viewport').scrollTop($('div#chat_viewport')[0].scrollHeight);

            } else {
                /* Error here */
            }

        }, "JSON");

        $("input#chat_message").val("");

        return false;
    });


});
