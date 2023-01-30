<?php

// render halaman menjadi json
header('Content-Type: application/json');

require '../config/app.php';

// menerima input
$nama   = $_POST['nama'];
$jumlah = $_POST['jumlah'];
$harga  = $_POST['harga'];

// validasi data
if ($nama == null) {
    echo json_encode(['pesan' => 'Nama barang Tidak Boleh Kosong']);
    exit;
}

// query tambah data
$query = "INSERT INTO barang VALUES (null, '$nama', '$jumlah', '$harga', CURRENT_TIMESTAMP())";
mysqli_query($db, $query);

if ($query) {
    echo json_encode(['pesan' => 'Data barang Berhasil Ditambahkan']);
} else {    
    echo json_encode(['pesan' => 'Data barang Gagal Ditambahkan']);
}
