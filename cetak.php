<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <title>Document</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
            <div class="card">
                <h3 style="text-align:center">Data Pegawai</h3>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">NIP</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Unit Kerja</th>
                            <th scope="col">Tempat Lahir</th>
                            <th scope="col">Tanggal Lahir</th>
                            <th scope="col">Foto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include('database.php');
                            $db = new Database();
                            $sql = "SELECT * from pegawai inner join jabatan on pegawai.id_jabatan = jabatan.id_jabatan inner join unit_kerja on pegawai.id_unitkerja = unit_kerja.id_unitkerja inner join pengguna on pegawai.id_pengguna = pengguna.id_pengguna"; 
                            $data = $db->show_data($sql);

                            if ($data > 0) {
                                foreach ($data as $row) {
                                    echo "<tr>
                                        <td>". $row['nip'] ."</td>
                                        <td>". $row['nama_pegawai'] ."</td>
                                        <td>". $row['nama_jabatan'] ."</td>
                                        <td>". $row['nama_unitkerja'] ."</td>
                                        <td>". $row['tempat_lahir'] ."</td>
                                        <td>". $row['tanggal_lahir']." </td>
                                        <td><img src='file/".$row['foto']."' width='35'></td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7'>Data Tidak Ditemukan</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
    <script>window.print();</script>
</html>