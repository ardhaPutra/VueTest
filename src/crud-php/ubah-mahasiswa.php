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

$title = 'Ubah Mahasiswa';

include 'layout/header.php';

// mengambil id_mahasiswa dari url
$id_mahasiswa = (int)$_GET['id_mahasiswa'];

// query ambil data mahasiswa
$mahasiswa = select("SELECT * FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa")[0];

// cek apakah tombol ubah ditekan
if (isset($_POST['ubah'])) {
    if (update_mahasiswa($_POST) > 0) {
        echo "<script>
            alert('Data mahasiswa Berhasil Diubah');
            document.location.href='mahasiswa.php';
        </script>";
    } else {
        echo "<script>
            alert('Data mahasiswa Gagal Diubah');
            document.location.href='mahasiswa.php';
        </script>";
    }
}

?>
    
<div class="container mt-5">
    <h1>Ubah Mahasiswa</h1>
    <hr>

    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_mahasiswa" value="<?= $mahasiswa['id_mahasiswa']; ?>">
        <input type="hidden" name="fotoLama" value="<?= $mahasiswa['foto']; ?>">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Mahasiswa</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $mahasiswa['nama']; ?>" placeholder="Nama mahasiswa..." required>
        </div>
        <div class="row">
            <div class="mb-3 col-6">
                <div class="mb-3">
                    <label for="prodi" class="form-label">Program Studio</label>
                    <select name="prodi" id="prodi" class="form-control" required>
                        <?php $prodi = $mahasiswa['prodi']; ?>
                        <option value="Teknik Informatika"  <?= $prodi == 'Teknik Informatika' ? 'selected' : null ?>>Teknik Informatika</option>
                        <option value="Sistem Informasi" <?= $prodi == 'Sistem Informasi' ? 'selected' : null ?>>Sistem Informasi</option>
                        <option value="Manajemen" <?= $prodi == 'Manajemen' ? 'selected' : null ?>>Manajemen</option>
                    </select>
                </div>
            </div>
            
            <div class="mb-3 col-6">
                <div class="mb-3">
                    <label for="jk" class="form-label">Jenis Kelamin</label>
                    <select name="jk" id="jk" class="form-control" required>
                        <?php $jk = $mahasiswa['jk']; ?>
                        <option value="Laki-laki" <?= $prodi == 'Laki-laki' ? 'selected' : null ?>>Laki-laki</option>
                        <option value="Perempuan" <?= $prodi == 'Perempuan' ? 'selected' : null ?>>Perempuan</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="telepon" class="form-label">Telepon</label>
            <input type="number" class="form-control" id="telepon" name="telepon" value="<?= $mahasiswa['telepon']; ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $mahasiswa['email']; ?>" placeholder="Nama email..." required>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto" 
            placeholder="Foto..." onchange="previewImg()" required>
            <img src="assets/img/<?= $mahasiswa['foto']; ?>" class="img-thumbnail img-preview mt-2" width="100px" alt="">
        </div>
        

        <button type="submit" name="ubah" class="btn btn-primary" style="float:right;">Ubah</button>
    </form>
</div>

<script>
    function previewImg() {
        const foto          = document.querySelector('#foto');
        const imgPreview    = document.querySelector('.img-preview');

        const fileFoto = new FileReader();
        fileFoto.readAsDataURL(foto.files[0]);

        fileFoto.onLoad = function(e) {
            imgPreview.src = e.target.result;
        } 
    }
</script>

<?php include 'layout/footer.php'?>
