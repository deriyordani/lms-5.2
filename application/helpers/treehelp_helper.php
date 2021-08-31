<?php
	function into_tree($value, $field){
		$tree = array();

		foreach ($value as $val) {
			$tree[$val->uc_parent][] = array(
											'uc'				=> $val->uc,
											'uc_parent'			=> $val->uc_parent,
											'type'				=> $val->type,
											'label'				=> $val->label,
											$field				=> $val->$field,
											);
		}

		return $tree;
	}

	function tree_browse($tree, $uc_parent) {		
		for ($i = 0; $i < count($tree[$uc_parent]); $i++) {

			$tree_class = "treegrid-".$tree[$uc_parent][$i]['uc'];
			if ($tree[$uc_parent][$i]['uc_parent'] != 0) {
				$tree_class .= " treegrid-parent-".$tree[$uc_parent][$i]['uc_parent'];
			}

			$html = "<tr class='".$tree_class."'>";

					$html  .= "<td>";
						// $html .= "<img src='".base_url('assets/image/ico-structure.png')."' width='15' height='15' style='margin:0px 5px 0px 5px;' />";
						if ($tree[$uc_parent][$i]['type'] == 2) {
							$html .= "<a href='#' class='label-tree function-label' title='".$tree[$uc_parent][$i]['label']."' uc='".$tree[$uc_parent][$i]['uc']."'>";
								$html .= $tree[$uc_parent][$i]['label'];
							$html .= "</a>";
						} else {
							$html .= "<label class='label-tree'>";
								$html .= $tree[$uc_parent][$i]['label'];
							$html .= "<label>";
						}
						/*$html .= "<div style='float:right;'>";
							$html .= "<img class='add-ico add-child' src='".base_url('assets/image/ico-add.png')."' title='Add Child for (".$tree[$uc_parent][$i]['label'].")' uc='".$tree[$uc_parent][$i]['uc']."' />";
							$html .= "<img class='edit-ico edit' src='".base_url('assets/image/ico-edit.png')."' title='Edit folder (".$tree[$uc_parent][$i]['label'].")..??' uc='".$tree[$uc_parent][$i]['uc']."' />";
							$html .= "<img class='delete-ico delete' src='".base_url('assets/image/ico-delete.png')."' title='Delete folder (".$tree[$uc_parent][$i]['label'].")!!' uc='".$tree[$uc_parent][$i]['uc']."' />";
						$html .= "</div>";*/
					$html .= "</td>";

			$html .= "</tr>";

			echo $html;

			if (count(@$tree[$tree[$uc_parent][$i]['uc']]) > 0) {
				tree_browse($tree, $tree[$uc_parent][$i]['uc']);
			}
			
		}
	}

	/*function tree_courseware_browse_only($tree, $uc_parent) {		
		for ($i = 0; $i < count($tree[$uc_parent]); $i++) {

			$tree_class = "treegrid-".$tree[$uc_parent][$i]['uc'];
			if ($tree[$uc_parent][$i]['uc_parent'] != 0) {
				$tree_class .= " treegrid-parent-".$tree[$uc_parent][$i]['uc_parent'];
			}

			$html = "<tr class='".$tree_class."'>";
				$html  .= "<td width='275'>";

					if ($tree[$uc_parent][$i]['type'] != 3) {

						// $html .= "<img src='".base_url('assets/image/ico-structure.png')."' width='15' height='15' style='margin:0px 5px 0px 5px;' />";
						// $html .= "<a href='#' class='tree courseware-list label-folder' title='".$tree[$uc_parent][$i]['label']."' uc='".$tree[$uc_parent][$i]['uc']."' style='width:195px;'>";
							$html .= $tree[$uc_parent][$i]['label'];
						// $html .= "</a>";

					} else {

						// $html .= "<img src='".base_url('assets/image/ico-content.png')."' width='15' height='15' style='margin:0px 5px 0px 5px;' />";
						$html .= "<a href='#' class='tree courseware-list-content label-folder' title='".$tree[$uc_parent][$i]['label']."' uc='".$tree[$uc_parent][$i]['uc']."' style='width:195px;'>";
							$html .= $tree[$uc_parent][$i]['label'];
						$html .= "</a>";

					}

				$html .= "</td>";
			$html .= "</tr>";

			echo $html;

			if (count(@$tree[$tree[$uc_parent][$i]['uc']]) > 0) {
				tree_courseware_browse_only($tree, $tree[$uc_parent][$i]['uc']);
			}
			
		}
	}*/

	/*function tree_courseware_selecting($tree, $uc_parent) {
		for ($i = 0; $i < count($tree[$uc_parent]); $i++) {

			$tree_class = "treegrid-".$tree[$uc_parent][$i]['uc'];
			if ($tree[$uc_parent][$i]['uc_parent'] != 0) {
				$tree_class .= " treegrid-parent-".$tree[$uc_parent][$i]['uc_parent'];
			}

			$html = "<tr class='".$tree_class."'>";
				$html  .= "<td>";

					// if ($tree[$uc_parent][$i]['type'] == 0) {

						// $html .= "<img src='".base_url('assets/image/ico-structure.png')."' width='15' height='15' style='margin:0px 5px 0px 5px;' />";

					// } else
					
					 	if ($tree[$uc_parent][$i]['type'] == 3) {

						$html .= "<input type='radio' name='f_topic' label='".$tree[$uc_parent][$i]['label']."' uc-parent='".$tree[$uc_parent][$i]['uc_parent']."' value='".$tree[$uc_parent][$i]['uc']."' />";
						// $html .= "<img src='".base_url('assets/image/ico-content.png')."' width='15' height='15' style='margin:0px 5px 0px 5px;' />";

					}

					$html .= "<label style='margin:0px 10px 0px 5px;'>";
						$html .= $tree[$uc_parent][$i]['label'];
					$html .= "</label>";

				$html .= "</td>";
			$html .= "</tr>";

			echo $html;

			if (count(@$tree[$tree[$uc_parent][$i]['uc']]) > 0) {
				tree_courseware_selecting($tree, $tree[$uc_parent][$i]['uc']);
			}

		}
	}*/

	/*function tree_courseware_pick($tree, $uc_parent) {
		for ($i = 0; $i < count($tree[$uc_parent]); $i++) {

			$tree_class = "treegrid-".$tree[$uc_parent][$i]['uc'];
			if ($tree[$uc_parent][$i]['uc_parent'] != 0) {
				$tree_class .= " treegrid-parent-".$tree[$uc_parent][$i]['uc_parent'];
			}

			$html = "<tr class='".$tree_class."'>";
				$html  .= "<td>";

					// if ($tree[$uc_parent][$i]['type'] != 0) {

						// $html .= "<input type='checkbox' name='f_structure[]' class='check-structure' value='".$tree[$uc_parent][$i]['uc']."' uc-parent='".$tree[$uc_parent][$i]['uc_parent']."' />";
						// $html .= "<img src='".base_url('assets/image/ico-structure.png')."' width='15' height='15' style='margin:0px 5px 0px 5px;' />";

					// } else if ($tree[$uc_parent][$i]['type'] == 1) {

						$html .= "<input type='checkbox' name='f_content[]' value='".$tree[$uc_parent][$i]['uc']."' uc-parent='".$tree[$uc_parent][$i]['uc_parent']."' />";
						// $html .= "<img src='".base_url('assets/image/ico-content.png')."' width='15' height='15' style='margin:0px 5px 0px 5px;' />";

					// }

					$html .= $tree[$uc_parent][$i]['code']."-".$tree[$uc_parent][$i]['label'];

				$html .= "</td>";
			$html .= "</tr>";

			echo $html;

			if (count(@$tree[$tree[$uc_parent][$i]['uc']]) > 0) {
				tree_courseware_pick($tree, $tree[$uc_parent][$i]['uc']);
			}

		}
	}*/


?>