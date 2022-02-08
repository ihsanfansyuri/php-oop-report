<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <title>List Pegawai</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    
        <nav class="navbar navbar-light bg-light ">
            <div class="container-fluid">
                <a class="navbar-brand">Data Pegawai</a>
                <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="cari">
                <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </nav>


        <div class="container">
            <div class="card">
                <h3>List Pegawai</h3>
                <?php
                session_start();

                if (empty($_SESSION['username'])) {
                    header("location:login.php");
                }


                $cari = ""; 
                if (isset($_GET['cari'])) { 
                    $cari = $_GET['cari']; 
                    echo "<p>Hasil Pencarian : <b>" . $cari . "</b></p>"; 
                } ?>

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
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include('database.php');
                            $db = new Database();

                            $limit = 4;
                            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                            $start = $limit * ($page - 1);
                            $get = mysqli_fetch_array(mysqli_query($db->koneksi, "SELECT COUNT(*) total FROM pegawai inner join jabatan on pegawai.id_jabatan = jabatan.id_jabatan inner join unit_kerja on pegawai.id_unitkerja = unit_kerja.id_unitkerja inner join pengguna on pegawai.id_pengguna = pengguna.id_pengguna"));
                            $total = $get['total'];
                            $pages = ceil($total / $limit);

                            $sql = "SELECT * from pegawai inner join jabatan on pegawai.id_jabatan = jabatan.id_jabatan inner join unit_kerja on pegawai.id_unitkerja = unit_kerja.id_unitkerja inner join pengguna on pegawai.id_pengguna = pengguna.id_pengguna LIMIT $start, $limit"; 
                            $no = $start + 1;

                            if ($cari != "") {
                                $sql = "SELECT * from pegawai inner join jabatan on pegawai.id_jabatan = jabatan.id_jabatan inner join unit_kerja on pegawai.id_unitkerja = unit_kerja.id_unitkerja inner join pengguna on pegawai.id_pengguna = pengguna.id_pengguna WHERE nama_pegawai like '%" . $cari . "%' LIMIT $start, $limit ";
                            } else {
                                $sql = "SELECT * from pegawai inner join jabatan on pegawai.id_jabatan = jabatan.id_jabatan inner join unit_kerja on pegawai.id_unitkerja = unit_kerja.id_unitkerja inner join pengguna on pegawai.id_pengguna = pengguna.id_pengguna LIMIT $start, $limit ";
                            }

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
                                        <td>
                                        <a href='form-update.php?id=$row[nip]'>Edit</a> |
                                        <a href='proses.php?action=delete&id=$row[nip]'>Delete</a>
                                        </td>
                                    </tr>";
                                    $no++;
                                }
                            } else {
                                echo "<tr><td colspan='7'>Data Tidak Ditemukan</td></tr>";
                            }
                            
                        ?>
                    </tbody>
                </table>
                
                <div class="d-grid gap-2 d-md-block">
                    <a class="btn btn-primary tombol" href="form-input.php" role="button">Isi Data</a>
                    <a class="btn btn-primary tombol" href="logout.php" role="button">Logout</a>
                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Cetak Data
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="cetakpdf.php" target="_blank">PDF</a></li>
                        <li><a class="dropdown-item" href="cetakexcel.php" target="_blank">Excel</a></li>
                        <li><a class="dropdown-item" href="cetakword.php" target="_blank">Word</a></li>
                    </ul>
                </div>
                


                <nav aria-label="Page navigation example">
                <ul class="pagination">
                <li class="page-item">
                        <a class="page-link" href="?page=<?= $page-1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    <?php
                    for($i = 1; $i <= $pages; $i++) :
                        if ($i == $page) : 
                    ?>
                            <li class="page-item active"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php
                        else :
                    ?>
                            <li class="page-item"><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php endif; 
                    endfor; 
                    ?>
                    
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page+1 ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
                </nav>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
    </body>
</html>