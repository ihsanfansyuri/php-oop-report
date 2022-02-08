<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <title>Update Data</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Update Data Pegawi</a>
            </div>
        </nav>

        <?php
        include('database.php');
        $db = new Database();
        
        session_start();

        if (empty($_SESSION['username'])) {
            header("location:login.php");
        }

        
        ?>

        <div class="container">
            <div class="card">

            <?php 
            $nip = $_GET['id'];

            if ($nip !="") {
                $data = $db->get_by_id($nip);
                $pengguna = $db->pengguna();
                $jabatan = $db->jabatan();
                $unit = $db->unit_kerja();
            } else {
                header("location: tampil.php");
            }
            
            ?>

                <h2>Update Data</h2>
                <form action="proses.php?action=update&id=<?php echo $nip ?>" method="post" enctype="multipart/form-data">

                    <div class="mb-3">
                    <label for="pengguna" class="form-label">id_pengguna</label>

                    <select class="form-select" name="pengguna" id="pengguna">

                        <?php foreach ($pengguna as $row) { ?>
                            <option value = "<?php echo $row['id_pengguna'] ?>" 
                            <?php echo ($data['id_pengguna'] == $row ['id_pengguna']) ? "selected" : "" ?>>
                            <?php echo $row['id_pengguna'] ?>
                            </option>
                        <?php } ?>
                        
                    </select>
                    </div>

                    <div class="mb-3">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" class="form-control" value="<?php echo $data['nip']; ?>" name="nip" id="nip">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" value="<?php echo $data['nama_pegawai']; ?>" name="nama_pegawai" id="nama_pegawai" >
                    </div>
                    <div class="mb-3">
                    <label for="jabatan" class="form-label">Jabatan</label>

                    <select class="form-select" name="jabatan" id="jabatan">

                        <?php foreach ($jabatan as $row) { ?>
                            <option value = "<?php echo $row['id_jabatan'] ?>" 
                            <?php echo ($data['id_jabatan'] == $row['id_jabatan']) ? "selected" : "" ?>>
                            <?php echo $row['nama_jabatan'] ?>
                            </option>
                        <?php } ?>
                        
                    </select>
                    </div>

                    <div class="mb-3">
                    <label for="unit" class="form-label">Unit Kerja</label>
                        
                    <select class="form-select" name="unit_kerja" id="unit_kerja">
                        
                        <?php foreach($unit as $row) { ?>
                            <option value="<?php echo $row['id_unitkerja'] ?>"
                            <?php echo ($data['id_unitkerja'] == $row['id_unitkerja'] ? "selected" : "") ?>>
                            <?php echo $row['nama_unitkerja'] ?>
                            </option>
                        <?php } ?>

                    </select>
                    </div>

                    <div class="mb-3">
                        <label for="tempat" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="<?php echo $data['tempat_lahir'];?>"  >
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal Lahir (YYYY-MM-DD)</label>
                        <input type="text" class="form-control" name="tanggal_lahir" id="tanggal-lahir" value="<?php echo $data['tanggal_lahir']; ?>"  >
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Upload Foto</label>
                        <input type="file" name="berkas" size="100">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a class="btn btn-primary tombol" href="tampil.php" role="button">Kembali</a>
                </form>
            </div>
        </div>
    </body>
</html>