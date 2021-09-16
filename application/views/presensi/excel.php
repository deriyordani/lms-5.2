<?php
require_once APPPATH."/third_party/PHPExcel.php"; 
$objPHPExcel = new PHPExcel();

$title = array(
			'font'    => array(
				'bold'	=> true,
				'size'	=> 16
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
			)
		);

// Style Table
$style = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
			),

			'borders' => array(
				'outline' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				)
			),

			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => 'd1d1d1')
			)
		);

// Isi
$isi_center = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
			),
			
			'borders' => array(
				'outline' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				)
			)
		);

$isi_left = array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT
			),
			
			'borders' => array(
				'outline' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				)
			)
		);

$isi_right= array(
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
			),
			
			'borders' => array(
				'outline' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				)
			)
		);

//$objPHPExcel->getActiveSheet()->mergeCells('A1:R1');

$objPHPExcel->getActiveSheet()->getStyle('A1:R3')->applyFromArray($title);

$objPHPExcel->getActiveSheet()->setCellValue('A1', 'REKAP KEHADIRAN');
$sub_title = "[".$info->classroom_code."] - ".$info->classroom_title;
$objPHPExcel->getActiveSheet()->setCellValue('A2',$sub_title);
$instructor = $info->full_name;
$objPHPExcel->getActiveSheet()->setCellValue('A3',$instructor);

$objPHPExcel->getActiveSheet()->setCellValue('A5','No.');
$objPHPExcel->getActiveSheet()->getStyle('A5')->applyFromArray($style);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$objPHPExcel->getActiveSheet()->setCellValue('B5','Nomor Peserta');
$objPHPExcel->getActiveSheet()->getStyle('B5')->applyFromArray($style);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
$objPHPExcel->getActiveSheet()->setCellValue('C5','Nama Siswa');
$objPHPExcel->getActiveSheet()->getStyle('C5')->applyFromArray($style);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);


$col = "D";
foreach($section as $sec){
	$objPHPExcel->getActiveSheet()->getStyle($col.'5')->applyFromArray($style);
	$objPHPExcel->getActiveSheet()->setCellValue($col.'5',$sec->sequence);

	//$last_content = $col;
    
    $col++;
}

$objPHPExcel->getActiveSheet()->getStyle($col.'5')->applyFromArray($style);
$objPHPExcel->getActiveSheet()->setCellValue($col.'5','Hadir');
$objPHPExcel->getActiveSheet()->getStyle($col++.'5')->applyFromArray($style);
$objPHPExcel->getActiveSheet()->setCellValue($col.'5','Ijin');
$objPHPExcel->getActiveSheet()->getStyle($col++.'5')->applyFromArray($style);
$objPHPExcel->getActiveSheet()->setCellValue($col.'5','Sakit');
$objPHPExcel->getActiveSheet()->getStyle($col++.'5')->applyFromArray($style);
$objPHPExcel->getActiveSheet()->setCellValue($col.'5','Alpa');
$objPHPExcel->getActiveSheet()->getStyle($col++.'5')->applyFromArray($style);


$row = 6;
$no = 1;
foreach ($student as $student_info) {
	$presence_hadir = 0;
	$presence_ijin = 0;
	$presence_sakit = 0;
	$presence_alpa = 0;

	$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $no);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($isi_right);

	$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $student_info->no_peserta);
	$objPHPExcel->getActiveSheet()->getStyle('B'.$row)->applyFromArray($isi_left);

	$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $student_info->full_name);
	$objPHPExcel->getActiveSheet()->getStyle('C'.$row)->applyFromArray($isi_left);

	
	$col = "D";
	foreach ($section as $sect_row) {
		$sign = "-";
		$presence_alpa++;

		foreach($kehadiran as $presence){

	        if ($presence->uc_section == $sect_row->uc && $presence->uc_diklat_participant == $student_info->uc){
                if($presence->status == 1){
                    $sign = "✓";
                    $presence_hadir++;
                    $presence_alpa--;
                } elseif($presence->status == 2){
                    $sign = "S";
                    $presence_sakit++;
                    $presence_alpa--;
                } elseif($presence->status == 3){
                    $sign = "I";
                    $presence_ijin++;
                    $presence_alpa--;
                }
                break;
            }
        }

        $objPHPExcel->getActiveSheet()->setCellValue($col.$row, $sign);
		$objPHPExcel->getActiveSheet()->getStyle($col.$row)->applyFromArray($isi_center);

		$col++;
	}

	$objPHPExcel->getActiveSheet()->getStyle($col.$row)->applyFromArray($isi_center);
	$objPHPExcel->getActiveSheet()->setCellValue($col++.$row, $presence_hadir);
	$objPHPExcel->getActiveSheet()->getStyle($col.$row)->applyFromArray($isi_center);
	$objPHPExcel->getActiveSheet()->setCellValue($col++.$row, $presence_ijin);
	$objPHPExcel->getActiveSheet()->getStyle($col.$row)->applyFromArray($isi_center);
	$objPHPExcel->getActiveSheet()->setCellValue($col++.$row, $presence_sakit);
	$objPHPExcel->getActiveSheet()->getStyle($col.$row)->applyFromArray($isi_center);
	$objPHPExcel->getActiveSheet()->setCellValue($col++.$row, $presence_alpa);

	$row++;
	$no++;
}

$filename = "Rekap Presensi.xls";  //save our workbook as this file name

ob_end_clean();
header( "Content-type: application/vnd.ms-excel" );
header('Content-Disposition: attachment;filename="'.$filename.'"'); 
header("Pragma: no-cache");
header("Expires: 0");
ob_end_clean();
            
//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
//if you want to save it as .XLSX Excel 2007 format
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
//force user to download the Excel file without writing it to server's HD
$objWriter->save('php://output');
?>