<?php
    require_once 'vendor/autoload.php';
    use PhpOffice\PhpWord\IOFactory;
    use PhpOffice\PhpWord\PhpWord;

    $phpWord = new PhpWord();
    $section = $phpWord->addSection();
    $title = array('size'=>16, 'bold'=>true);
    $section->addText("Laporan Data Pegawai", $title);
    $section->aadTextBreak(1);

    $styleTable = array('borderSize'=>6, 'borderColor'=>'006699', 'cellMargin'=>80);
    $styleCell = array('valign'=>'center');
    $fontHeader = array('bold'=>true);
    $noSpace = array('spaceAfter'=>0);
    $imgStyle = array('width'=>50, 'height'=>50);

    $phpWord->addTableStyle('mytable', $styleTable);

    $table = $section->addTable('mytable');
    $table->addRow();
    $table->addCell(500, $styleCell)->addTExt('No.', $fontHeader, $noSpace);
    $table->addCell(1000, $styleCell)->addText('NIP', $fontHeader, $noSpace);
    $table->addCell(2000, $styleCell)->addText('Nama Pegawai', $fontHeader, $noSpace);
    $table->addCell(2000, $styleCell)->addText('Jabatan', $fontHeader, $noSpace);
    $table->addCell(2000, $styleCell)->addText('Unit Kerja', $fontHeader, $noSpace);
    $table->addCell(2000, $styleCell)->addText('Tempat Lahir', $fontHeader, $noSpace);
    $table->addCell(2000, $styleCell)->addText('Tanggal Lahir', $fontHeader, $noSpace);
    $table->addCell(1000, $styleCell)->addText('Foto', $fontHeader, $noSpace);


    include('database.php');
    $db = new Database();

    $sql = "SELECT * from pegawai inner join jabatan on pegawai.id_jabatan = jabatan.id_jabatan inner join unit_kerja on pegawai.id_unitkerja = unit_kerja.id_unitkerja inner join pengguna on pegawai.id_pengguna = pengguna.id_pengguna";
    $data = $db->show_data($sql);

    $i = 1;
    foreach($data as $d) {
        $table->addRow();
        $table->addCell(500, $styleCell)->addText($i++, array(), $noSpace);
        $table->addCell(1000, $styleCell)->addText($d['nip'], array(), $noSpace);
        $table->addCell(2000, $styleCell)->addText($d['nama_pegawai'], array(), $noSpace);
        $table->addCell(2000, $styleCell)->addText($d['nama_jabatan'], array(), $noSpace);
        $table->addCell(2000, $styleCell)->addText($d['nama_unitkerja'], array(), $noSpace);
        $table->addCell(2000, $styleCell)->addText($d['tempat_lahir'], array(), $noSpace);
        $table->addCell(2000, $styleCell)->addText($d['tanggal_lahir'], array(), $noSpace);

        $table->addCell(1000, $styleCell)->addImage('file/' .  $d['foto'], $imgStyle);
    }

    $filename = "datapegawai-word.docx";
    header('Content-Type: application/msword');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save('php://output');
    exit;
?>