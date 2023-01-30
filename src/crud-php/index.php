<?php
session_start();

// membatasi halaman sebelum login
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Silkan lakukan login terlebih dahulu');
            document.location.href='login.php';
        </script>";
    exit;
}

// membatasi halaman sesuai user role
if ($_SESSION["level"] != 1 and $_SESSION["level"] != 2) {
    echo "<script>
            alert('Anda tidak memiliki akses untuk melihat halaman ini');
            document.location.href='crud-modal.php';
        </script>";
    exit;
}

$title = 'Daftar Barang';

include 'layout/header.php';

// menampilkan data barang
$data_barang = select("SELECT * FROM barang ORDER BY id_barang DESC");

?>
    
    <div class="container mt-5">
        <h1><i class="fas fa-clipboard-list"></i> Data Barang</h1>
        <hr>
        
        <a href="tambah-barang.php" class="btn btn-primary mb-2"><i class="fas fa-plus-circle"></i> Tambah Data</a>
        
        <table class="table table-bordered table-striped mt-3" id="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php $no = 1; ?>
                <?php foreach($data_barang as $barang) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $barang['nama']; ?></td>
                    <td><?= $barang['jumlah']; ?></td>
                    <td>Rp. <?= number_format($barang['harga'],0,'.'); ?></td>
                    <td><?= date('d/m/Y H:i:s', strtotime($barang['tanggal'])); ?></td>
                    <td width="20%" class="text-center">
                        <a href="ubah-barang.php?id_barang=<?=$barang['id_barang'];?>" class="btn btn-success"><i class="fas fa-edit"></i> Ubah</a>
                        <a href="hapus-barang.php?id_barang=<?=$barang['id_barang'];?>" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php include 'layout/footer.php' ?>