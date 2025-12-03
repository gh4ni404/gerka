<?php
session_start();

// Konfigurasi database
$host = "localhost";
$username = "smknbone_gerka"; // Ganti dengan username database Anda
$password = "Muh4mm4d123!@"; // Ganti dengan password database Anda
$database = "smknbone_gerka";

// Membuat koneksi
$conn = mysqli_connect($host, $username, $password, $database);

// Cek koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Set charset
mysqli_set_charset($conn, "utf8");

// Fungsi untuk membersihkan input
function bersihkan_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>