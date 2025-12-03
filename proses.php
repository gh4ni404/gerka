<?php
require_once 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil dan bersihkan data input
    $nama = bersihkan_input($_POST['nama']);
    $jenis_kelamin = bersihkan_input($_POST['jenis_kelamin']);
    $usia = bersihkan_input($_POST['usia']);
    $no_telepon = bersihkan_input($_POST['no_telepon']);
    $alamat = bersihkan_input($_POST['alamat']);
    $asal_instansi = bersihkan_input($_POST['asal_instansi']);
    $jenis_pengunjung = bersihkan_input($_POST['jenis_pengunjung']);
    $waktu_kunjungan = bersihkan_input($_POST['waktu_kunjungan']);
    
    // Validasi data
    $errors = [];
    
    // Validasi nama (minimal 3 karakter)
    if (strlen($nama) < 3) {
        $errors[] = "Nama harus minimal 3 karakter";
    }
    
    // Validasi usia (5-100 tahun)
    if ($usia < 5 || $usia > 100) {
        $errors[] = "Usia harus antara 5-100 tahun";
    }
    
    // Validasi nomor telepon (hanya angka, 10-15 digit)
    if (!preg_match('/^[0-9]{10,15}$/', $no_telepon)) {
        $errors[] = "Nomor telepon harus 10-15 digit angka";
    }
    
    // Validasi alamat
    if (strlen($alamat) < 3) {
        $errors[] = "Alamat harus minimal 10 karakter";
    }
    
    // Validasi asal instansi
    if (strlen($asal_instansi) < 3) {
        $errors[] = "Asal instansi harus minimal 3 karakter";
    }
    
    // Jika tidak ada error, simpan ke database
    if (empty($errors)) {
        $sql = "INSERT INTO pengunjung (nama, jenis_kelamin, usia, no_telepon, alamat, asal_instansi, jenis_pengunjung, waktu_kunjungan) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssisssss", $nama, $jenis_kelamin, $usia, $no_telepon, $alamat, $asal_instansi, $jenis_pengunjung, $waktu_kunjungan);
        
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['sukses'] = "Registrasi berhasil! Terima kasih <strong>$nama</strong> telah mendaftar sebagai pengunjung GERKA 2025. Silakan datang sesuai waktu kunjungan yang Anda pilih.";
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