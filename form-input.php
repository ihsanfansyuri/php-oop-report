<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <title>Tambah Data Pegawai</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Tambah Data Pegawai</a>
            </div>
        </nav>
        
        <div class="container">
            <div class="card">

                <?php
                include('database.php');
                $db = new Database();
                $pengguna = $db->pengguna();
                $jabatan = $db->jabatan();
                $unit = $db->unit_kerja();

                session_start();

                if (empty($_SESSION['username'])) {
                    header("location:login.php");
                }
                ?>
            
                <h2>Isi Data</h2>
                <form action="proses.php?action=add" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                <label for="pengguna" class="form-label">Id</label>
                <select class="form-select" name="pengguna" id="pengguna">
                    <option selected>Id Pengguna</option>
                    <?php
                    $id_pengguna = mysqli_query($koneksi, "SELECT * from pengguna");
                    foreach ($pengguna as $row) {
                        ?>
                            <option value="<?php echo $row['id_pengguna']?>">
                            <?php echo $row['id_pengguna'] ?>
                        </option>
                    <?php } ?>
                </select>
                </div>

                <div class="mb-3">
                    <label for="nip" class="form-label">NIP</label>
                    <input type="text" class="form-control" name="nip" id="nip" >
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama_pegawai" id="nama_pegawai" >
                </div>
                <div class="mb-3">
                <label for="jabatan" class="form-label">Jabatan</label>

                <select class="form-select" name="jabatan" id="jabatan">
                    <option selected>Pilih Jabatan</option>
                    <?php
                    $id_jabatan = mysqli_query($koneksi, "SELECT * from jabatan");
                    foreach ($jabatan as $row) {
                        ?>
                            <option value="<?php echo $row['id_jabatan']?>">
                            <?php echo $row['nama_jabatan'] ?>
                        </option>
                    <?php } ?>
                </select>

                </div>
                <div class="mb-3">
                <label for="unit_kerja" class="form-label">Unit Kerja</label>

                <select class="form-select" name="unit_kerja" id="unit_kerja">
                    <option selected>Pilih Unit Kerja</option>
                    <?php
                    $id_unitkerja = mysqli_query($koneksi, "SELECT * from unit_kerja");
                    foreach ($unit as $row) {
                        ?>
                            <option value="<?php echo $row['id_unitkerja']?>">
                            <?php echo $row['nama_unitkerja'] ?>
                        </option>
                    <?php } ?>
                </select>
                
                </div>
                <div class="mb-3">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" >
                </div>
                <div class="mb-3">
                    <label for="tgl_lahir" class="form-label">Tanggal Lahir (YYYY-MM-DD)</label>
                    <input type="text" class="form-control" name="tanggal_lahir" id="tanggal-lahir" >
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Upload Foto</label>
                    <input type="file" name="berkas" size="100">
                </div>
                <button type="submit" class="btn btn-primary" >Submit</button>
                <a class="btn btn-primary tombol" href="tampil.php" role="button">Kembali</a>
                </form>
            </div>
        </div>
    </body>
</html>