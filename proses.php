<?php
require_once 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil dan bersihkan data input
    $nama = bersihkan_input($_POST['nama']);
    $jenis_kelamin = bersihkan_input($_POST['jenis_kelamin']);
    $usia = bersihkan_input($_POST['usia']);
    $alamat = bersihkan_input($_POST['alamat']);
    $no_telepon = bersihkan_input($_POST['no_telepon']);
    $hari_tanggal = bersihkan_input($_POST['hari_tanggal']);
    $waktu_masuk = bersihkan_input($_POST['waktu_masuk']);
    $setuju = isset($_POST['setuju']) ? 1 : 0;
    
    // Tujuan kunjungan: array dari checkbox
    $tujuan_kunjungan = [];
    if (isset($_POST['tujuan_kunjungan']) && is_array($_POST['tujuan_kunjungan'])) {
        foreach ($_POST['tujuan_kunjungan'] as $tujuan) {
            $tujuan = bersihkan_input($tujuan);
            if (!empty($tujuan)) {
                $tujuan_kunjungan[] = $tujuan;
            }
        }
    }
    // Gabungkan dengan koma
    $tujuan_kunjungan_str = implode(', ', $tujuan_kunjungan);
    
    // Validasi data
    $errors = [];
    
    // Validasi nama (minimal 3 karakter)
    if (strlen($nama) < 3) {
        $errors[] = "Nama harus minimal 3 karakter";
    }
    
    // Validasi usia (antara 1-100)
    if ($usia < 1 || $usia > 100) {
        $errors[] = "Usia harus antara 1 sampai 100 tahun";
    }
    
    // Validasi alamat
    if (strlen($alamat) < 5) {
        $errors[] = "Alamat harus minimal 5 karakter";
    }
    
    // Validasi nomor telepon (hanya angka, 10-15 digit)
    if (!preg_match('/^[0-9]{10,15}$/', $no_telepon)) {
        $errors[] = "Nomor telepon harus 10-15 digit angka";
    }
    
    // Validasi tujuan kunjungan (minimal satu)
    if (empty($tujuan_kunjungan)) {
        $errors[] = "Pilih minimal satu tujuan kunjungan";
    }
    
    // Validasi tanggal (tidak boleh di masa lalu)
    $today = date('Y-m-d');
    if ($hari_tanggal < $today) {
        $errors[] = "Tanggal kunjungan tidak boleh di masa lalu";
    }
    
    // Validasi persetujuan
    if (!$setuju) {
        $errors[] = "Anda harus menyetujui penggunaan data";
    }
    
    // Cek apakah nomor telepon sudah terdaftar pada tanggal yang sama?
    $sql_cek = "SELECT id FROM pengunjung WHERE no_telepon = ? AND hari_tanggal = ?";
    $stmt_cek = mysqli_prepare($conn, $sql_cek);
    mysqli_stmt_bind_param($stmt_cek, "ss", $no_telepon, $hari_tanggal);
    mysqli_stmt_execute($stmt_cek);
    mysqli_stmt_store_result($stmt_cek);
    
    if (mysqli_stmt_num_rows($stmt_cek) > 0) {
        $errors[] = "Nomor telepon ini sudah terdaftar untuk tanggal kunjungan yang sama";
    }
    mysqli_stmt_close($stmt_cek);
    
    // Jika tidak ada error, simpan ke database
    if (empty($errors)) {
        $sql = "INSERT INTO pengunjung (nama, jenis_kelamin, usia, alamat, no_telepon, tujuan_kunjungan, hari_tanggal, waktu_masuk, setuju) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssisssssi", $nama, $jenis_kelamin, $usia, $alamat, $no_telepon, $tujuan_kunjungan_str, $hari_tanggal, $waktu_masuk, $setuju);
        
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