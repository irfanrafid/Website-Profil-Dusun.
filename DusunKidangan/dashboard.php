<?php
// Ganti dengan informasi koneksi ke database Anda
include "koneksi.php";
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect ke halaman login jika belum login
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>DATA WARGA KIDANGAN </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Tambahkan ini di dalam tag <head> di index.php -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>

<div class="container mt-5">
    <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addModal">Tambah Data</button>
    <table class="table">
        <!-- ... Tabel data ... -->
    </table>
</div>

<table class="table">
    <thead>
        <tr>
            <th>NO KK</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php
    include 'koneksi.php';
    $query = "SELECT DISTINCT no_kk FROM datwarkidangan"; // Mengambil nomor KK yang unik
    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$row['no_kk']."</td>";
        echo "<td>
                <button class='btn btn-info' data-toggle='modal' data-target='#viewModal".$row['no_kk']."'>Lihat Detail</button>
              </td>";
        echo "</tr>";

        // View Modal
        echo '<div class="modal fade" id="viewModal'.$row['no_kk'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo '<div class="modal-dialog" role="document">';
        echo '<div class="modal-content">';
        echo '<div class="modal-header">';
        echo '<h5 class="modal-title" id="exampleModalLabel">Detail Data KK: '.$row['no_kk'].'</h5>';
        echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
        echo '<span aria-hidden="true">&times;</span>';
        echo '</button>';
        echo '</div>';
        echo '<div class="modal-body">';
    
       // Ambil dan tampilkan semua data yang terkait dengan nomor KK
       $detailQuery = "SELECT * FROM datwarkidangan WHERE no_kk='".$row['no_kk']."'";
       $detailResult = mysqli_query($conn, $detailQuery);

       while($detailRow = mysqli_fetch_assoc($detailResult)) {
           echo '<p>No: '.$detailRow['no'].'</p>';
           echo '<p>Nama: '.$detailRow['nama_lengkap'].'</p>';
           echo '<p>NIK: '.$detailRow['nik'].'</p>';
           echo '<p>Alamat: '.$detailRow['alamat'].'</p>';
           echo '<p>Tanggal Lahir: '.$detailRow['tanggal_lahir'].'</p>';
           // Tampilkan informasi lainnya ...\
           // Edit Modal
            echo '<div class="modal fade" id="editModal'.$detailRow['no'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog" role="document">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>';
            echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            echo '<span aria-hidden="true">&times;</span>';
            echo '</button>';
            echo '</div>';
            echo '<div class="modal-body">';
            // Isi konten modal untuk edit, misalnya formulir
            echo '<form action="edit.php" method="post">';
            echo '<input type="hidden" name="id" value="'.$detailRow['no'].'">';
            echo '<label for="nama">Nama:</label>';
            echo '<input type="text" name="nama" class="form-control" value="'.$detailRow['nama_lengkap'].'">';
            echo '<label for="nik">NIK:</label>';
            echo '<input type="text" name="nik" class="form-control" value="'.$detailRow['nik'].'">';
            echo '<label for="alamat">Alamat:</label>';
            echo '<input type="text" name="alamat" class="form-control" value="'.$detailRow['alamat'].'">';
            echo '<button type="submit" class="btn btn-primary mt-2">Simpan</button>';
            echo '</form>';
            echo '</div>';
            echo '<div class="modal-footer">';
            echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

        
            echo '<div class="modal fade" id="deleteModal'.$detailRow['no'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
            echo '<div class="modal-dialog" role="document">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>';
            echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            echo '<span aria-hidden="true">&times;</span>';
            echo '</button>';
            echo '</div>';
            echo '<div class="modal-body">';
            // Isi konten modal untuk konfirmasi hapus
            echo '<p>Apakah Anda yakin ingin menghapus data ini?</p>';
            echo '<a href="delete.php?id='.$detailRow['no'].'" class="btn btn-danger">Hapus</a>';
            echo '<button type="button" class="btn btn-secondary ml-2" data-dismiss="modal">Batal</button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
       

        echo '<button class="btn btn-primary" data-toggle="modal" data-target="#editModal'.$detailRow['no'].'">Edit</button>';
        echo '<button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal'.$detailRow['no'].'">Hapus</button>';
    }
        echo '</div>';
    
        echo '<div class="modal-footer">';
        echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

       
    }

    ?>
</tbody>
</table>


     <!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Isi konten modal untuk menambahkan data baru -->
                <form action="add.php" method="post">
                    <label for="nama">Nama:</label>
                    <input type="text" name="nama" class="form-control">
                    <label for="nik">NIK:</label>
                    <input type="text" name="nik" class="form-control">
                    <label for="jenis_kelamin">Jenis Kelamin:</label>
                    <select name="jenis_kelamin" class="form-control">
                        <option value="LK">Laki-laki</option>
                        <option value="PR">Perempuan</option>
                    </select>
                    <label for="nama">No KK:</label>
                    <input type="text" name="no_kk" class="form-control">
                    <label for="nama">Alamat:</label>
                    <input type="text" name="alamat" class="form-control">
                    <label for="nama">Rt:</label>
                    <input type="text" name="rt" class="form-control">
                    <label for="nama">Rw:</label>
                    <input type="text" name="rw" class="form-control">
                    <label for="nama">Tempat Lahir:</label>
                    <input type="text" name="tempat_lahir" class="form-control">
                    <label for="nama">Tanggal Lahir:</label>
                    <input type="text" name="tanggal_lahir" class="form-control">
                    <label for="nama">Status</label>
                    <input type="text" name="status" class="form-control">
                    <label for="nama">Pendidikan</label>
                    <input type="text" name="pendidikan" class="form-control">
                    <label for="nama">Agama</label>
                    <input type="text" name="agama" class="form-control">
                    <button type="submit" class="btn btn-primary mt-2">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Isi konten modal untuk edit data -->
                <form action="edit.php" method="post">
                    <!-- ... Isi form dengan data yang sesuai ... -->
                    <button type="submit" class="btn btn-primary mt-2">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus data ini?</p> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
<?php
$conn->close();
?>
