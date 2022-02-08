<?php 
    include( 'database.php');
    $db = new Database();

    $action = $_GET['action'];
    if ($action == "add") {
        $foto = $_FILES['berkas']['name'];
        $temp = $_FILES['berkas']['tmp_name'];
    
        $folder = "file/";
        move_uploaded_file($temp, $folder.$foto);

        $data = array(
            'nip' => $_POST['nip'],
            'id_unitkerja' => $_POST['unit_kerja'],
            'id_jabatan' => $_POST['jabatan'],
            'id_pengguna' => $_POST['pengguna'],
            'nama_pegawai' => $_POST['nama_pegawai'],
            'tempat_lahir' => $_POST['tempat_lahir'],
            'tanggal_lahir' => $_POST['tanggal_lahir'],
            'foto' => $foto
        );

        $db->tambah_data($data);
        header("Location:tampil.php");

    } elseif ($action == "update") {
        $foto = $_FILES['berkas']['name'];
        $temp = $_FILES['berkas']['tmp_name'];
        $folder = "file/";
        move_uploaded_file($temp, $folder.$foto);

        $data = array(
            'nip' => $_POST['nip'],
            'id_unitkerja' => $_POST['unit_kerja'],
            'id_jabatan' => $_POST['jabatan'],
            'id_pengguna' => $_POST['pengguna'],
            'nama_pegawai' => $_POST['nama_pegawai'],
            'tempat_lahir' => $_POST['tempat_lahir'],
            'tanggal_lahir' => $_POST['tanggal_lahir'],
        );
        if($foto != "") $data['berkas'] = $foto;

        $nip = $_GET['id'];
        $db->update_data($nip, $data);
        header('location:tampil.php');

    } elseif ($action == "delete") {
        $nip = $_GET['id'];
        $db->delete_data($nip);
        header('location: tampil.php');
    }
?>