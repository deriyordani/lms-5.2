<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tinymce{
	function __construct(){
		?>
		<script type="text/javascript" src="<?=base_url()?>assets/third_party/tiny_mce/tiny_mce.js"></script>
		
		<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/third_party/tiny_mce/tiny_mce.js"></script>
		<script language="javascript" type="text/javascript" src="<?=base_url()?>assets/third_party/general.js"></script>
		
		<script language="javascript" type="text/javascript">
			tinyMCE.init({
				mode : "textareas",			
				editor_selector :"rte",
				theme : "advanced",
				plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",
				
				// Theme options
				theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
				theme_advanced_buttons2 : "cut,copy,paste,|,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,|,forecolor,backcolor",
				theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,|,ltr,rtl",	
				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "left",
				theme_advanced_statusbar_location : "bottom",				
								
				extended_valid_elements : "hr[class|width|size|noshade]",
				file_browser_callback : "ajaxfilemanager",
				paste_use_dialog : false,
				theme_advanced_resizing : true,
				theme_advanced_resize_horizontal : true,
				apply_source_formatting : true,
				force_br_newlines : true,
				force_p_newlines : false,	
				relative_urls : true
			});
	
			function ajaxfilemanager(field_name, url, type, win) {
				var ajaxfilemanagerurl = "<?=base_url()?>assets/third_party/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php";
				var view = 'detail';
				switch (type) {
					case "image":
					view = 'thumbnail';
						break;
					case "media":
						break;
					case "flash": 
						break;
					case "file":
						break;
					default:
						return false;
				}
	            tinyMCE.activeEditor.windowManager.open({
	                url: "<?=base_url()?>assets/third_party/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php?view=" + view,
	                width: 782,
	                height: 440,
	                inline : "yes",
	                close_previous : "no"
	            },{
	                window : win,
	                input : field_name
	            });

			}
		</script>		
		<?php
	}
	
	function generate($params = NULL){
		$cols = ( isset($params['cols']) ? $params['cols'] : 80);
		$rows = ( isset($params['rows']) ? $params['rows'] : 15);
		
		?>
		<textarea name="<?=$params['name']?>" id="ajaxfilemanager" class="rte" cols="<?=$cols?>" rows="<?=$rows?>">
			<?php 
				if(isset($params['value'])){
					echo $params['value'];
				}
			?>
		</textarea>
		<?php
	}
	
	function path_adjustment($str = NULL){
		//	remove '../'
		$to_replace = "../";
		$by_this = "";
		$replace = str_replace($to_replace, $by_this, $str);
		
		//	add base URL
		$to_replace = "uploads/tinymce";
		$by_this = base_url()."uploads/tinymce";
		$replace = str_replace($to_replace, $by_this, $replace);
		
		return $replace;
	}
}