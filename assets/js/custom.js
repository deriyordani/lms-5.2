$(document).ready(function(){

	$('#filer_input').filer({
		showThumbs: true,
		addMore: true,
		allowDuplicates: false
	});


	$('#filer_input_edit').filer({
		showThumbs: true,
		addMore: true,
	     files: [
	         {
	            name: "VB Webinar.jpg",
	            size: 5453,
	            type: "image/jpg",
	            file: "./uploads/materi/VB Webinar.jpg"
	         }
	     ],
	     allowDuplicates: false
	});

});
