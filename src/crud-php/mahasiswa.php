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
if ($_SESSION["level"] != 1 and $_SESSION["level"] != 3) {
    echo "<script>
            alert('Anda tidak memiliki akses untuk melihat halaman ini');
            document.location.href='crud-modal.php';
        </script>";
    exit;
}

$title = 'Daftar Mahasiswa';

include 'layout/header.php';

// menampilkan data mahasiswa
$data_mahasiswa = select("SELECT * FROM mahasiswa ORDER BY id_mahasiswa DESC");

?>

<div class="container mt-5">
    <h1><i class="fas fa-clipboard-list"></i> Data Mahasiswa</h1>
    <hr>
    
    <a href="tambah-mahasiswa.php" class="btn btn-primary mb-2"><i class="fas fa-plus-circle"></i> Tambah Data</a>

    <a href="download-excel-mahasiswa.php" class="btn btn-dark mb-2"><i class="fas fa-file-excel"></i> Download Excel</a>
    
    <table class="table table-bordered table-striped mt-3" id="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th>Jenis Kelamin</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = 1;?>
            <?php foreach ($data_mahasiswa as $mahasiswa) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $mahasiswa['nama']; ?></td>
                    <td><?= $mahasiswa['prodi']; ?></td>
                    <td><?= $mahasiswa['jk']; ?></td>
                    <td><?= $mahasiswa['telepon']; ?></td>
                    <td class="text-center" width="25%">
                        <a href="detail-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-info-circle"></i> Detail</a>
                        
                        <a href="ubah-mahasiswa.php?id_mahasiswa=<?=$mahasiswa['id_mahasiswa'];?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Ubah</a>
                        
                        <a href="hapus-mahasiswa.php?id_mahasiswa=<?=$mahasiswa['id_mahasiswa']; ?>" class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin Menghapus Data Mahasiswa ini?')"><i class="fas fa-trash"></i> Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'layout/footer.php' ?>