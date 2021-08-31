<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Im_pagination{
	function __construct(){
		$this->CI =& get_instance();
	}
	
	function render($params, $filter = NULL, $like = NULL){
		/* ==============================================================
		$page_number = "page number";
		$each_number = "amount of record show in every page";
		$page_int 	 = "page interval, amount of page number show in pagination";
		$model 		 = "determine which model to access";
		$method 	 = "determine which function (query) to execute at model;"
		$segment 	 = "determine which function to access at controller based on URI";
		$total_record= "in case, not using standard query that already define in this library, you can just set the total record from the controller to the params";
		/* ============================================================== */

		$CI =& get_instance();
		
		//	Reassign to Local Variable
		$page_number	= $params['page_number'];
		$each_page		= (isset($params['each_page']) ? $params['each_page'] : 20);
		$page_int		= (isset($params['page_int']) ? $params['page_int'] : 10);
		$model			= $params['model'];
		$method			= (isset($params['method']) ? $params['method'] : NULL);
		$segment 		= $params['segment'];
		$total_record   = (isset($params['total_record']) ? $params['total_record'] : NULL);

		if ($total_record == NULL) {
			//	Get Total Record
			$this->CI->load->model($model);
			
			if ($method != NULL) {
				///	If Method in Model's defined
				if ($filter == NULL) {
					$all_rec = $this->CI->$model->$method();	
				}
				else {
					$all_rec = $this->CI->$model->$method($filter);
				}	
			}
			else {
				///	If Method in Model's not define
				if ($filter == NULL) {
					if ($like == NULL) {
						$all_rec = $this->CI->$model->get_all();					
					}
					else {
						$all_rec = $this->CI->$model->get_like_all($like);
					}
				}
				else {
					if ($like == NULL) {
						$all_rec = $this->CI->$model->get_filtered($filter);	
					}
					else {
						$all_rec = $this->CI->$model->get_like_filtered($like, $filter);
					}
				}	
			}
			
			$total_record = $all_rec->num_rows();	
		}
		
		//	Pagination Setting
		$prev_page	= $page_number - 1;		
		$total_page = ceil($total_record / $each_page);		  
		$next_page	= $page_number + 1;

		$range = floor($page_int/2);
		
		$first_page = $page_number - $range;
		$first_page = (($first_page < 1) ? 1 : $first_page);
		$last_page	= $page_number + ($page_int - $range - 1);
		$last_page = ($last_page > $total_page ? $total_page : $last_page);
		
		$page_long = ($last_page - $first_page) + 1;
		
		if ($page_long < $page_int) {
			$def_page = $page_int - $page_long;
			
			if (($last_page + $def_page) <= $total_page) {
				$last_page = $last_page + $def_page;	
			}
			
			if ($page_long < $page_int) {
				if (($first_page - $def_page) > 0) {
					$first_page = $first_page - $def_page;
				}
			}
		}
		
		if ($total_record > 0) {
			//	Generating
			$html = "";
			///	Generating Button "first"		
			if($page_number != 1){
				$html .= "<span class=\"page-nav\">";
				$html .= "<a href=\"".base_url($segment.'/1')."\">first</a>";
			}
			else{
				$html .= "<span class=\"nav-off\">";
				$html .= "first";
			}
			$html .= "</span>";
			
			///	Generating Button "prev"		
			if($prev_page >= 1){
				$html .= "<span class=\"page-nav\">";
				$html .= "<a href=\"".base_url($segment.'/'.$prev_page)."\" >prev</a>";
			}
			else{
				$html .= "<span class=\"nav-off\">";
				$html .= "prev";
			}
			$html .= "</span>";
			
			///	Generating Button "pages"
			for($i = $first_page; $i <= $last_page; $i++){
				if ($i == $page_number) {
					$html .= "<span class=\"page-number current-page\">";
					$html .= $i;
				}
				else {
					$html .= "<span class=\"page-number\">";
					$html .= "<a href=\"".base_url($segment.'/'.($i))."\">".($i)."</a>";
				}
				$html .= "</span>";
			}
			
			///	Generating Button "next"
			if($next_page <= $total_page){
				$html .= "<span class=\"page-nav\">";
				$html .= "<a href=\"".base_url($segment.'/'.$next_page)."\">next</a>";
			}
			else{
				$html .= "<span class=\"nav-off\">";
				$html .= "next";
			}
			$html .= "</span>";
			
			///	Generating Button "last"
			if($page_number != $total_page){
				$html .= "<span class=\"page-nav\">";
				$html .= "<a href=\"".base_url($segment.'/'.$total_page)."\">last</a>";
			}
			else{
				$html .= "<span class=\"nav-off\">";
				$html .= "last";
			}
			$html .= "</span>";
			
			return $html;
		}		
	}

	function render_ajax($params, $filter = NULL, $like = NULL){
		/* ==============================================================
		$page_number = "page number";
		$each_number = "amount of record show in every page";
		$page_int 	 = "page interval, amount of page number show in pagination";
		$model 		 = "determine which model to access";
		$method 	 = "determine which function (query) to execute at model;"
		$segment 	 = "determine which function to access at controller based on URI";
		$total_record= "in case, not using standard query that already define in this library, you can just set the total record from the controller to the params";
		/* ============================================================== */
		
		$CI =& get_instance();
		
		//	Reassign to Local Variable
		$page_number	= $params['page_number'];
		$each_page		= (isset($params['each_page']) ? $params['each_page'] : 20);
		$page_int		= (isset($params['page_int']) ? $params['page_int'] : 10);
		$model			= $params['model'];
		$method			= (isset($params['method']) ? $params['method'] : NULL);
		$segment 		= $params['segment'];
		$total_record   = (isset($params['total_record']) ? $params['total_record'] : NULL);

		if ($total_record == NULL) {
			//	Get Total Record
			$this->CI->load->model($model);
			
			if ($method != NULL) {
				///	If Method in Model's defined
				if ($filter == NULL) {
					$all_rec = $this->CI->$model->$method();	
				}
				else {
					$all_rec = $this->CI->$model->$method($filter);
				}	
			}
			else {
				///	If Method in Model's not define
				if ($filter == NULL) {
					if ($like == NULL) {
						$all_rec = $this->CI->$model->get_all();					
					}
					else {
						$all_rec = $this->CI->$model->get_like_all($like);
					}
				}
				else {
					if ($like == NULL) {
						$all_rec = $this->CI->$model->get_filtered($filter);	
					}
					else {
						$all_rec = $this->CI->$model->get_like_filtered($like, $filter);
					}
				}	
			}
			
			$total_record = $all_rec->num_rows();	
		}
		
		//	Pagination Setting
		$prev_page	= $page_number - 1;		
		$total_page = ceil($total_record / $each_page);		  
		$next_page	= $page_number + 1;

		$range = floor($page_int/2);
		
		$first_page = $page_number - $range;
		$first_page = (($first_page < 1) ? 1 : $first_page);
		$last_page	= $page_number + ($page_int - $range - 1);
		$last_page = ($last_page > $total_page ? $total_page : $last_page);
		
		$page_long = ($last_page - $first_page) + 1;
		
		if ($page_long < $page_int) {
			$def_page = $page_int - $page_long;
			
			if (($last_page + $def_page) <= $total_page) {
				$last_page = $last_page + $def_page;	
			}
			
			if ($page_long < $page_int) {
				if (($first_page - $def_page) > 0) {
					$first_page = $first_page - $def_page;
				}
			}
		}
		
		if ($total_record > 0) {
			//	Generating
			$html = "";



			
			///	Generating Button "first"		
			if($page_number != 1){
				$html .= "<span class=\"page-nav\">";
				$html .= "<a href=\"#\" title=\"1\" class=\"pagination-ajax\" >first</a>";
			}
			else{
				$html .= "<span class=\"nav-off\">";
				$html .= "first";
			}
			$html .= "</span>";
			
			///	Generating Button "prev"		
			if($prev_page >= 1){
				$html .= "<span class=\"page-nav\">";
				$html .= "<a href=\"#\" title=\"".($page_number - 1)."\" class=\"pagination-ajax\" >prev</a>";
			}
			else{
				$html .= "<span class=\"nav-off\">";
				$html .= "prev";
			}
			$html .= "</span>";
			
			///	Generating Button "pages"
			for($i = $first_page; $i <= $last_page; $i++){
				if ($i == $page_number) {
					$html .= "<span class=\"page-number current-page\">";
					$html .= $i;
				}
				else {
					$html .= "<span class=\"page-number\">";
					//$html .= "<a href=\"#\" title=\"".$i."\" class=\"pagination-ajax\" >".($i)."</a>";
					$html .= "<a href=\"#\" title=\"".$i."\" class=\"pagination-ajax\" >".($i)."</a>";
				}
				$html .= "</span>";
			}
			
			///	Generating Button "next"		
			if($next_page <= $total_page){
				$html .= "<span class=\"page-nav\">";
				$html .= "<a href=\"#\" title=\"".($page_number + 1)."\" class=\"pagination-ajax\" >next</a>";
			}
			else{
				$html .= "<span class=\"nav-off\">";
				$html .= "next";
			}
			$html .= "</span>";
			
			///	Generating Button "last"		
			if($page_number != $total_page){
				$html .= "<span class=\"page-nav\">";
				$html .= "<a href=\"#\" title=\"".$total_page."\" class=\"pagination-ajax\" >last</a>";
			}
			else{
				$html .= "<span class=\"nav-off\">";
				$html .= "last";
			}
			$html .= "</span>";
			
			return $html;	
		}		
	}
}
?>