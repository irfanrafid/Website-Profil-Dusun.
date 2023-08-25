<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];

        // Lakukan validasi atau manipulasi data lainnya jika diperlukan

        // Lakukan penghapusan data dari database
        include 'koneksi.php';
        $query = "DELETE FROM datwarkidangan WHERE no = $id";

        if (mysqli_query($conn, $query)) {
            header("Location: dashboard.php"); // Alihkan kembali ke halaman utama setelah berhasil dihapus
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    } else {
        echo "Invalid ID.";
    }
}
?>
