var base_url = 'http://192.168.1.28:9090/lms-ng-rev4/';
//var base_url = 'http://elearning.poltekpel-sorong.ac.id/';


function show_question(no){

	//alert(no);
	// Show the loading
	// $('.loading-modal').css('display','block');

	//alert(base_url);

	save_answer();

	var uc_attempt 	= $('input[name=f_att_code]').val();

	//alert(base_url);
	//	Set Which Question to Show
	$('.question-each').load(base_url +'assessment/page_attempt', { js_attempt : uc_attempt, js_no : no-1 }, function(responseText, textStatus, XMLHttpRequest) {
		
		//alert(textStatus);

		$('input[name=f_curr_no]').val(no);
		// if (textStatus  == "success") {
		// 	var msg = "Sorry but there was an error: ";
		// 	$(this).html(msg + xhr.status + " " + xhr.statusText);
		// 	//	Set Current Question No, for Next & Prev navigation purpose
		// 	$('input[name=f_curr_no]').val(no);
		// 	// Hidden loading page
		// 	//$('.loading-modal').css('display','none');
		// }
	});

	//	Navigation Prevention for Next or Prev
	var max_no = $('input[name=f_max_no]').val();

	///	If The End of No
	if (no >= max_no) {
		$('.prev-pane').css('display','block');
		$('.next-pane').css('display','none');
		// $('.prev-pane').find('.btn-prev').css({
		// 	'margin-left':'58px',
		// 	'float':'left'
		// });
	}
	else if (no <= 1) {
		$('.next-pane').css('display','block');
		$('.prev-pane').css('display','none');
		// $('.next-pane').find('.btn-next').css({
		// 	'margin-left':'58px',
		// 	'float':'left'
		// });	
	}
	else {
		// For Next
		$('.next-pane').css('display','block');
		$('.prev-pane').css('display','block');
		// $('.next-pane').find('.btn-next').css({
		// 	'margin-left':'-3px',
		// 	'float':'left'
		// });
		// $('.prev-pane').find('.btn-prev').css({
		// 	'margin-left':'58px',
		// 	'float':'left'
		// });
		// Set question value to 0 again
		$('input[name=f_question_time]').val(0);
	}

	$('.answered').hover(function(){
		$(this).css('background-color','#2279c3');
	},function(){
		$(this).css('background-color','#0259a2');

	});
	
	return false;
}

function show_next(){
	//	Get Current No
	var curr_no = $('input[name=f_curr_no]').val();
	//	Add 1 the Current No
	var next_no = parseInt(curr_no) + 1;

	//	Get Queston to Show
	show_question(next_no);

	return false;
}

function show_prev(){
	//	Get Current No
	var curr_no = $('input[name=f_curr_no]').val();
	//	Sub 1 the Current No
	var prev_no = parseInt(curr_no) - 1;
	//	Get Queston to Show
	show_question(prev_no);

	return false;
}

function save_answer(){
	var curr_no = $('input[name=f_curr_no]').val();

	var q_index		= parseInt(curr_no) - 1;
	var att_code 	= $('input[name=f_att_code]').val();
	var q_type		= $('input[name=f_question_type]').val();
	// Update marking question
	var is_marks = parseInt($('input[name=f_is_marks]').val());
	//	Update Remaining Time
	var time_running = parseInt($('input[name=f_time_running]').val());

	if (att_code == "") {
		window.location.replace(base_url + "assessment/home");
	}

	/*if (q_type == 3) {
		// Update Answers for Question Type Matching - Ajax Proccess
		var max_opt		= $('input[name=f_max_option]').val();
		var answer 		= "";
		
		var answered = false;
		for (i=0; i<max_opt; i++) {
			ans = $('select[name=f_pair_answer_'+q_index+'_'+i+']').val();

			answer	+= ans+"-";

			if (ans != "NULL") {
				answered = true;
			}			
		}

		if (answered) {
			answer 	= answer.slice(0,-1);

			$.ajax({
				type		: 'post',
					dataType	: 'json',
					data 		: {js_att_code : att_code, js_q_index : q_index, js_answer : answer, js_marks : is_marks, js_time_running : time_running},
					url			: base_url+'examination_student/save_answer_ajax',
					success		: function(success) {
									if(success['answer'] != "NULL" && success['state'] === true){
										$('#qpageno-'+curr_no).addClass('answered');
									}
					}
			});

			$('#qpageno-'+curr_no).addClass('answered');
		}
	}
	else {*/
		//	Update Answers for Question Type Multiple Choice or True/False - Ajax Proccess
		var answer 			= $('input[name=f_answer]:radio:checked').val();

		if (!answer) {
			var answer = "NULL";
		}

		// if (answer) {

			$.ajax({
					type		: 'post',
					dataType	: 'json',
					data 		: {js_att_code : att_code, js_q_index : q_index, js_answer : answer, js_marks : is_marks, js_time_running : time_running},
					url			: base_url+'assessment/save_answer_ajax',
					success 	: function(success) {
									if(success['answer'] != "NULL" && success['state'] == true){
										$('#qpageno-'+curr_no).addClass('answered');
									}
								 }
			});
		// }
	// }
}

function save_answer_and_redirect(){
	var curr_no 	= $('input[name=f_curr_no]').val();

	var q_index		= parseInt(curr_no) - 1;	
	var att_code 	= $('input[name=f_att_code]').val();
	var q_type		= $('input[name=f_question_type_'+curr_no+']').val();
	// Update marking question
	//var is_marks = parseInt($('input[name=f_is_marks]').val());
	//	Update Remaining Time
	var time_running = parseInt($('input[name=f_time_running]').val());

	// if (q_type == 3) {
	// 	var max_opt			= $('input[name=f_max_option_'+curr_no+']').val();	
	// 	var match_key 		= "";
	// 	var match_answer 	= "";

	// 	for (i=0; i<max_opt; i++) {
	// 		//key = $('input[name=f_pair_quest_'+i+']').val();
	// 		ans = $('select[name=f_pair_answer_'+q_index+'_'+i+']').val();

	// 		//match_key 		+= key+"-";
	// 		match_answer	+= ans+"-";
	// 	}

	// 	match_key 		= match_key.slice(0,-1);

	// 	if (match_answer != "") {			
	// 		match_answer 	= match_answer.slice(0,-1);
	// 	}
		
	// 	window.open(base_url+'assessment/finish_by_time/'+att_code+'/'+q_index+'/'+match_answer+'/'+time_running, '_self');
	// }
	//else {
		var answer 	= $('input[name=f_answer]:radio:checked').val();

		window.open(base_url+'assessment/finish_by_time/'+att_code+'/'+q_index+'/'+answer+'/'+time_running, '_self');
	//}	
}

$(document).ready(function(){

	//third counter
	var duration = $('input[name=f_duration]').val();
	var base_url = $("#base-url").html();

	
	if (duration != "") {
		$("#countdown").jCounter({
			format: "dd:hh:mm:ss",
			twoDigits: 'on',
			customRange: duration+':0',
			callback: function(){
					save_answer_and_redirect();
			}
		});

		$("input[name=f_duration_reminder]").jCounter({
			format: "dd:hh:mm:ss",
			twoDigits: 'on',
			customRange: duration+':900',
			callback: function(){
					$('.reminder-remaining-time').fadeIn(300);
			}
		});
	}

});