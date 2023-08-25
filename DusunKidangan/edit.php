<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari formulir
    $id= $_POST['id'];
    $nama= $_POST['nama'];

    // Lakukan validasi atau manipulasi data lainnya jika diperlukan

    // Lakukan update data ke database
    include 'koneksi.php';
    $query = "UPDATE datwarkidangan SET nama_lengkap = '$nama' WHERE no = $id";

    if (mysqli_query($conn, $query)) {
        header("Location: dashboard.php"); // Alihkan kembali ke halaman utama setelah berhasil diupdate
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>
