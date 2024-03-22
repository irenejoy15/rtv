
<?php 
    ini_set('memory_limit', '-1');
    ini_set('max_execution_time', 0);
    ini_set('sqlsrv.ClientBufferMaxKBSize','1000000'); // Setting to 512M
    ini_set('pdo_sqlsrv.client_buffer_max_kb_size','1000000');
    require FCPATH . '/vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
 
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $fileName = "monitoring.xlsx";
    $spreadsheet->getActiveSheet()->mergeCells('A1:P1');
    $sheet->setCellValue('A1', 'REPORTS FOR MONITORING');
    $sheet->setCellValue('A2', 'RTV DATE');
    $sheet->setCellValue('B2', 'POD DATE');
    $sheet->setCellValue('C2', 'RTV NUMBER');
    $sheet->setCellValue('D2', 'STORE CODE');
    $sheet->setCellValue('E2', 'STORE NAME');
    $sheet->setCellValue('F2', 'SALES ORDER');
    $sheet->setCellValue('G2', 'SKU CODE');
    $sheet->setCellValue('H2', 'DESCRIPTION');
    $sheet->setCellValue('I2', 'UOM');
    $sheet->setCellValue('J2', 'QTY');
    $sheet->setCellValue('K2', 'QTY RCV.');
    $sheet->setCellValue('L2', 'AMOUNT');
    $sheet->setCellValue('M2', 'REASON');
    $sheet->setCellValue('N2', 'CASE');
    $sheet->setCellValue('O2', 'REFERENCE NUMBER');
    $sheet->setCellValue('P2', 'MIGRATION STATUS');

    
    $sheet->getStyle('A')->getAlignment()->setHorizontal('center');
    $sheet->getColumnDimension('A')->setAutoSize(TRUE);
    $sheet->getColumnDimension('B')->setAutoSize(TRUE);
    $sheet->getColumnDimension('C')->setAutoSize(TRUE);
    $sheet->getColumnDimension('D')->setAutoSize(TRUE);
    $sheet->getColumnDimension('E')->setAutoSize(TRUE);
    $sheet->getColumnDimension('F')->setAutoSize(TRUE);
    $sheet->getColumnDimension('G')->setAutoSize(TRUE);
    $sheet->getColumnDimension('H')->setAutoSize(TRUE);
    $sheet->getColumnDimension('I')->setAutoSize(TRUE);
    $sheet->getColumnDimension('J')->setAutoSize(TRUE);
    $sheet->getColumnDimension('K')->setAutoSize(TRUE);
    $sheet->getColumnDimension('L')->setAutoSize(TRUE);
    $sheet->getColumnDimension('M')->setAutoSize(TRUE);
    $sheet->getColumnDimension('N')->setAutoSize(TRUE);
    $sheet->getColumnDimension('O')->setAutoSize(TRUE);
    $sheet->getColumnDimension('P')->setAutoSize(TRUE);
    $sheet->getStyle("A1:P1")->getFont()->setSize(16)->setBold( true );
    $sheet->getStyle("A2:P2")->getFont()->setSize(14)->setBold( true );
    $sheet->getStyle('P')->getAlignment()->setWrapText(true);
    
    $rows = 3;
    
    foreach($monitorings as $monitoring){
      
      if(!empty($monitoring)){
        $date_query = new DateTime( $monitoring->rtv_date );
		
        $date_converted_rtv =  $date_query->format("Y-m-d");
        if($monitoring->pod_date!=""){
            $date_query_2 = new DateTime( $monitoring->pod_date );
		
            $date_converted_pod =  $date_query_2->format("Y-m-d");

        }else{
            $date_converted_pod ="";
        }
        if(!empty($monitoring->sales_order)){
            $salesOrder = str_pad($monitoring->sales_order, 15, '0', STR_PAD_LEFT);

        }
        else{
            $salesOrder="";
        }
        
        $sheet->setCellValue('A' . $rows, $date_converted_rtv );
        $sheet->setCellValue('B' . $rows, $date_converted_pod);
        $sheet->setCellValue('C' . $rows, $monitoring->rtv_number);
        $sheet->setCellValue('D' . $rows, $monitoring->store_code);
        $sheet->setCellValue('E' . $rows, $monitoring->store_description);
        $sheet->setCellValue('F' . $rows, $monitoring->sales_order);
        $sheet->setCellValue('G' . $rows, $monitoring->sku_code);
        $sheet->setCellValue('H' . $rows, $monitoring->description);
        $sheet->setCellValue('I' . $rows, $monitoring->uom);
        $sheet->setCellValue('J' . $rows, $monitoring->qty);
        $sheet->setCellValue('K' . $rows, $monitoring->total_qty_received);
        $sheet->setCellValue('L' . $rows, $monitoring->amount);
        $sheet->setCellValue('M' . $rows, $monitoring->reason);
        $sheet->setCellValue('N' . $rows, round($monitoring->case_reference),2);
        $sheet->setCellValue('O' . $rows, $monitoring->reference_number);

         
        if($monitoring->migration_status=='1'){
            $type = "MIGRATED";
            $sheet->getStyle('P'.$rows)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('17a2b8');
            $sheet->getStyle('P'.$rows)->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
            $sheet->getStyle('P'.$rows)->getFont()->setBold( true );
            $sheet->getStyle('P'.$rows)->getAlignment()->setHorizontal('center');
            $sheet->setCellValue('P' . $rows,$type);
          
        }else{
            $type = "NOT MIGRATED";
            $sheet->getStyle('P'.$rows)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('dc3545');
            $sheet->getStyle('P'.$rows)->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
            $sheet->getStyle('P'.$rows)->getFont()->setBold( true );
            $sheet->getStyle('P'.$rows)->getAlignment()->setHorizontal('center');
            $sheet->setCellValue('P' . $rows,$type);
        }

        $rows++;
    }
}   
    $highestRow = $spreadsheet->getActiveSheet()->getHighestRow();
    $spreadsheet->getActiveSheet()->removeRow($highestRow+1);

    $styleArray2 = array(
        'borders' => array(
            'allBorders' => array(
                'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => array('argb' => 'FFFFFF'),
            ),
        ),
    );

    $styleArray = [
        'borders' => [
              'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN//fine border
              ],
            ],
        'alignment' => [
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],

    ];
    $sheet ->getStyle('A1:P'.$rows.'')->applyFromArray($styleArray);
    $sheet ->getStyle($highestRow+1)->applyFromArray($styleArray2);
    ob_clean();
    $writer = new Xlsx($spreadsheet);
    
   
    $writer->save("uploads/monitoring.xlsx");

?>

<?php redirect('monitoring/download');?>



