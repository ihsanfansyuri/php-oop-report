<?php
class Database {
    private $host = "localhost";
    private $user  = "root";
    private $password = "";
    private $db = "pemwebdas_db";

    public $koneksi;

    function __construct() {
        $this->koneksi = mysqli_connect($this->host, $this->user, $this->password, $this->db);

        if (mysqli_connect_error()) {
            die("gagal terhubung engan database : " . mysqli_connect_error());
        }
    }

    function show_data($sql) {
        $query = mysqli_query($this->koneksi, $sql);

        if (mysqli_num_rows($query) == 0) return 0;

        $data = array();
        foreach ($query as $row) {
            $data[] = $row;
        }
        return $data;
    }

    function pengguna() {
        $query = mysqli_query($this->koneksi, "SELECT * from pengguna");
        foreach($query as $row) {
            $data[] = $row;
        }

        return $data;
    }

    function jabatan() {
        $query = mysqli_query($this->koneksi, "SELECT * from jabatan");
        foreach($query as $row) {
            $data[] = $row;
        }

        return $data;
    }

    function unit_kerja() {
        $query = mysqli_query($this->koneksi, "SELECT * from unit_kerja");
        foreach($query as $row) {
            $data[] = $row;
        }

        return $data;
    }

    function tambah_data($data) {
        $col = implode(',', array_keys($data));

        $val = "'" . implode("','", array_values($data)) . "'";
        mysqli_query($this->koneksi, "INSERT into pegawai($col) values($val)");
    }

    function get_by_id($nip) {
        $query = mysqli_query($this->koneksi, "SELECT * from pegawai where nip = '$nip'");
        return $query->fetch_array();
    }

    function update_data($nip, $data) {
        $dataset = "";
        foreach($data as $key => $val) {
            $dataset .= $key . '="'. $val . '",';
        }
        $dataset = rtrim($dataset, ',');
        mysqli_query($this->koneksi, "UPDATE pegawai set $dataset where nip = $nip");
    }

    function delete_data($nip) {
        mysqli_query($this->koneksi, "DELETE from pegawai where nip = '$nip'");
    }
}
