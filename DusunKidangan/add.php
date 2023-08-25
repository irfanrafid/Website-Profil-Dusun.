<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari formulir
    $nama = $_POST['nama'];
    $nik = $_POST['nik'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $no_kk = $_POST['no_kk'];
    $alamat = $_POST['alamat'];
    $rt = $_POST['rt'];
    $rw = $_POST['rw'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $status = $_POST['status'];
    $pendidikan = $_POST['pendidikan'];
    $agama = $_POST['agama'];

    // Lakukan validasi atau manipulasi data lainnya jika diperlukan

    // Lakukan insert data baru ke database
    include 'koneksi.php';
    $query = "INSERT INTO datwarkidangan(nama_lengkap,nik,jenis_kelamin,mo_kk,alamat,rt,rw,tempat_lahir,tanggal_lahir,status,pendidikan,agama) VALUES ('$nama',$nik,$jenis_kelamin,$no_kk,$alamat,$rt,$rw, $tempat_lahir,$tanggal_lahir,$status,$pendidikan,$agama)";

    if (mysqli_query($conn, $query)) {
        header("Location: dashboard.php"); // Alihkan kembali ke halaman utama setelah berhasil ditambahkan
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>
