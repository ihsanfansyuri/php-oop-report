<?php
    require_once 'vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;

    $spreadsheet = new Spreadsheet();

    $spreadsheet->setActiveSheetIndex(0)->setCellValue('A2', 'LAPORAN DATA PEGAWAI');
    $spreadsheet->getActiveSheet()->getStyle('A2')->getFont()->setSize(13);
    $spreadsheet->getACtiveSheet()->mergeCells('A2:H2');
    $spreadsheet->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal('center');
    $spreadsheet->getActiveSheet()->getStyle('A2')->getAlignment()->setVertical('center');

    $spreadsheet->getACtiveSheet()
        ->setCellValue('A4', 'No.')
        ->setCellValue('B4', 'NIP')
        ->setCellValue('C4', 'Nama Pegawai')
        ->setCellValue('D4', 'Jabatan')
        ->setCellValue('E4', 'Unit Kerja')
        ->setCellValue('F4', 'Tempat Lahir')
        ->setCellValue('G4', 'Tanggal Lahir')
        ->setCellValue('H4', 'Foto');


    $spreadsheet->getActiveSheet()->getStyle('A1:H4')->getFont()->setBold(true);

    include('database.php');
    $db = new Database();

    $sql = "SELECT * from pegawai inner join jabatan on pegawai.id_jabatan = jabatan.id_jabatan inner join unit_kerja on pegawai.id_unitkerja = unit_kerja.id_unitkerja inner join pengguna on pegawai.id_pengguna = pengguna.id_pengguna";
    $data = $db->show_data($sql);

    $rowID = 5;
    $i = 1;

    foreach($data as $d) {
        $spreadsheet->getActiveSheet()
            ->setCellValue('A' . $rowID, $i++)
            ->setCellValue('B' . $rowID, $d['nip'])
            ->setCellValue('C' . $rowID, $d['nama_pegawai'])
            ->setCellValue('D' . $rowID, $d['nama_jabatan'])
            ->setCellValue('E' . $rowID, $d['nama_unitkerja'])
            ->setCellValue('F' . $rowID, $d['tempat_lahir'])
            ->setCellValue('G' . $rowID, $d['tanggal_lahir']);
        //menambahkan foto
        $objDrawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $objDrawing->setPath('file/'. $d['foto']);
        $objDrawing->setCoordinates('H' . $rowID);
        $objDrawing->setOffsetX(5);
        $objDrawing->setOffsetY(5);
        $objDrawing->setWidth(50);
        $objDrawing->setHeight(50);
        $objDrawing->setWorksheet($spreadsheet->getActiveSheet());
        //mengatur row height
        $spreadsheet->getActiveSheet()->getRowDimension($rowID)->setRowHeight(50);
        $rowID++;
    }

    //mengatur autofit column width
    foreach(range('A','G') as $columnID) {
        $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
    }

    //mengatur style border
    $border = array(
        'allBorders' => array(
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
        )
    );
    $spreadsheet->getActiveSheet()->getStyle('A4' . ':H' . ($rowID-1))->getBorders()->applyFromArray($border);

    //mengatur style alignment
    $alignment = array(
        'alignment' => array(
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        )
    );
    $spreadsheet->getActiveSheet()->getStyle('A4' . ':H' . ($rowID-1))->applyFromArray($alignment);

    $filename = 'datapegawai-excel.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename .'"');
    header('Cache-Control: max-age=0');

    $objWriter = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $objWriter->save('php://output');
    exit;
?>