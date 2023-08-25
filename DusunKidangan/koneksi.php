<?php
//Logika PHP
// Mengganti dengan informasi koneksi ke database Anda
$host = "localhost";
$username = "root";
$password = "";
$database = "kidanganfix"; 

// Membuat koneksi ke database
$conn = new mysqli($host, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>