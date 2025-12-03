<?php
require_once 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil dan bersihkan data input
    $nama = bersihkan_input($_POST['nama']);
    $email = bersihkan_input($_POST['email']);
    $no_telepon = bersihkan_input($_POST['no_telepon']);
    $asal_instansi = bersihkan_input($_POST['asal_instansi']);
    $jenis_pengunjung = bersihkan_input($_POST['jenis_pengunjung']);
    
    // Validasi data
    $errors = [];
    
    // Validasi nama (minimal 3 karakter)
    if (strlen($nama) < 3) {
        $errors[] = "Nama harus minimal 3 karakter";
    }
    
    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid";
    }
    
    // Validasi nomor telepon (hanya angka, 10-15 digit)
    if (!preg_match('/^[0-9]{10,15}$/', $no_telepon)) {
        $errors[] = "Nomor telepon harus 10-15 digit angka";
    }
    
    // Validasi asal instansi
    if (strlen($asal_instansi) < 3) {
        $errors[] = "Asal instansi harus minimal 3 karakter";
    }
    
    // Cek apakah email sudah terdaftar
    $sql_cek = "SELECT id FROM pengunjung WHERE email = ?";
    $stmt_cek = mysqli_prepare($conn, $sql_cek);
    mysqli_stmt_bind_param($stmt_cek, "s", $email);
    mysqli_stmt_execute($stmt_cek);
    mysqli_stmt_store_result($stmt_cek);
    
    if (mysqli_stmt_num_rows($stmt_cek) > 0) {
        $errors[] = "Email sudah terdaftar";
    }
    mysqli_stmt_close($stmt_cek);
    
    // Jika tidak ada error, simpan ke database
    if (empty($errors)) {
        $sql = "INSERT INTO pengunjung (nama, email, no_telepon, asal_instansi, jenis_pengunjung) 
                VALUES (?, ?, ?, ?, ?)";
        
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $nama, $email, $no_telepon, $asal_instansi, $jenis_pengunjung);
        
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['sukses'] = "Registrasi berhasil! Terima kasih $nama telah mendaftar sebagai pengunjung GERKA 2025.";
            mysqli_stmt_close($stmt);
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['error'] = "Terjadi kesalahan: " . mysqli_error($conn);
            header("Location: index.php");
            exit();
        }
    } else {
        // Jika ada error, simpan pesan error dan redirect
        $_SESSION['error'] = implode("<br>", $errors);
        header("Location: index.php");
        exit();
    }
} else {
    // Jika bukan metode POST, redirect ke halaman form
    header("Location: index.php");
    exit();
}
?>