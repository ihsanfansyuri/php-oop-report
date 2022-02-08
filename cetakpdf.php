<?php
    require('fpdf/fpdf.php');
    $pdf = new FPDF('p', 'mm', 'A4');
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(190, 10, 'LAPORAN DATA PEGAWAI', 0, 1, 'C');

    $pdf->Cell(10, 7, '', 0, 1);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(20, 6, 'NIP', 1, 0);
    $pdf->Cell(40, 6, 'Nama Pegawai', 1, 0);
    $pdf->Cell(25, 6, 'Jabatan', 1, 0);
    $pdf->cell(28, 6, 'Unit Kerja', 1, 0);
    $pdf->Cell(28, 6, 'Tempat Lahir', 1, 0);
    $pdf->Cell(28, 6, 'Tanggal Lahir', 1, 0);
    $pdf->Cell(20, 6, 'Foto', 1, 1);

    $pdf->SetFont('Arial', '', 10);

    include('database.php');
    $db = new Database();
    
    $sql = "SELECT * from pegawai inner join jabatan on pegawai.id_jabatan = jabatan.id_jabatan inner join unit_kerja on pegawai.id_unitkerja = unit_kerja.id_unitkerja inner join pengguna on pegawai.id_pengguna = pengguna.id_pengguna";
    $data = $db->show_data($sql);
    // $i = 1;
    foreach($data as $d) {
        $pdf->Cell(20, 20, $d['nip'], 1, 0);
        $pdf->Cell(40, 20, $d['nama_pegawai'], 1, 0);
        $pdf->Cell(25, 20, $d['nama_jabatan'], 1, 0);
        $pdf->Cell(28, 20, $d['nama_unitkerja'], 1, 0);
        $pdf->Cell(28, 20, $d['tempat_lahir'], 1, 0);
        $pdf->Cell(28, 20, $d['tanggal_lahir'], 1, 0);

        $img = 'file/'.$d['foto'];
        $pdf->Cell(20, 20, $pdf->Image($img, $pdf->GetX(), $pdf->GetY(), 17), 1, 1);
    }

    $pdf->Output($dest='I', $name='data-pegawai.pdf');
?>