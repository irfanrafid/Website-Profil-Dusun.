<?php
include"koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Halaman Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Silakan Masuk</h2>
        <form action="" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            
            <label for="password">Password :</label>
            <input type="password" id="password" name="password" required><br><br>
            
            <input type="submit" name="submit" value="submit">
        </form>
    </div>

<!-- CSS -->
<style>
/* Style dasar untuk halaman login */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #000; /* Ubah warna latar belakang menjadi hitam */
}

.login-container {
    width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #1e824c; /* Ubah warna latar container menjadi hijau */
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* Tambahkan efek shadow yang lebih mencolok */
    text-align: center; /* Pusatkan konten dalam container */
}

h2 {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="password"] {
    width: 80%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

input[type="submit"] {
    width: 80%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

/* Style responsif */
@media screen and (max-width: 500px) {
    .login-container {
        width: 80%;
    }
}

</style>

</body>
</html>

<?php
// Mengambil data dari form login
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash password sebelum memeriksa di database (gunakan algoritma yang sesuai, seperti password_hash() jika memungkinkan)
    $hashedPassword = $password; // Ini hanya contoh, sebaiknya gunakan //edited algoritma hash yang lebih aman

    // Melakukan query untuk memeriksa data pengguna
    $query = "SELECT * FROM admin WHERE username='$username' AND password='$hashedPassword'";
    $result = $conn->query($query);

    // Memeriksa hasil query
    if ($result->num_rows == 1) {
        // Login berhasil, set session dan alihkan ke halaman baru
        session_start();
        $_SESSION['username'] = $username;
        header("Location: display.php"); // Ganti dengan nama halaman yang diinginkan
        exit(); // Penting untuk menghentikan eksekusi skrip setelah pengalihan
    } else {
        echo "Login gagal. Silakan periksa kembali username dan password Anda.";
    }
}

$conn->close();
?>
