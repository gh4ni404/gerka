<?php
require_once 'koneksi.php';
$pesan_sukses = '';
$pesan_error = '';

// Cek jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Location: proses.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Pengunjung GERKA 2025 - SMKN 8 Bone</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-purple-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <header class="text-center mb-10">
            <div class="flex justify-center items-center mb-4">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mr-4">
                    <i class="fas fa-graduation-cap text-white text-2xl"></i>
                </div>
                <div class="text-left">
                    <h1 class="text-3xl md:text-4xl font-bold text-blue-800">GERKA 2025</h1>
                    <p class="text-lg text-gray-700">Gelar Karya SMKN 8 Bone</p>
                </div>
            </div>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Form Registrasi Pengunjung</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Daftarkan diri Anda untuk menghadiri Gelar Karya 2025 SMKN 8 Bone. Isi form berikut dengan data yang valid.</p>
        </header>

        <!-- Notifikasi -->
        <?php if(isset($_SESSION['sukses'])): ?>
            <div class="max-w-2xl mx-auto mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span><?php echo $_SESSION['sukses']; unset($_SESSION['sukses']); ?></span>
                </div>
            </div>
        <?php endif; ?>
        
        <?php if(isset($_SESSION['error'])): ?>
            <div class="max-w-2xl mx-auto mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <span><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></span>
                </div>
            </div>
        <?php endif; ?>

        <!-- Form Registrasi -->
        <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-6 py-4">
                <h3 class="text-xl font-bold text-white">Isi Data Diri Anda</h3>
                <p class="text-blue-100 text-sm">Semua field wajib diisi</p>
            </div>
            
            <form action="proses.php" method="POST" class="p-6 md:p-8" id="formRegistrasi">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Lengkap -->
                    <div class="form-group">
                        <label for="nama" class="block text-gray-700 font-medium mb-2">
                            <i class="fas fa-user text-blue-500 mr-1"></i> Nama Lengkap
                        </label>
                        <input type="text" id="nama" name="nama" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                               placeholder="Masukkan nama lengkap">
                    </div>
                    
                    <!-- Email -->
                    <div class="form-group">
                        <label for="email" class="block text-gray-700 font-medium mb-2">
                            <i class="fas fa-envelope text-blue-500 mr-1"></i> Email
                        </label>
                        <input type="email" id="email" name="email" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                               placeholder="contoh@email.com">
                    </div>
                    
                    <!-- No Telepon -->
                    <div class="form-group">
                        <label for="no_telepon" class="block text-gray-700 font-medium mb-2">
                            <i class="fas fa-phone text-blue-500 mr-1"></i> No. Telepon/WA
                        </label>
                        <input type="tel" id="no_telepon" name="no_telepon" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                               placeholder="0812xxxxxxx">
                    </div>
                    
                    <!-- Asal Instansi -->
                    <div class="form-group">
                        <label for="asal_instansi" class="block text-gray-700 font-medium mb-2">
                            <i class="fas fa-school text-blue-500 mr-1"></i> Asal Instansi/Sekolah
                        </label>
                        <input type="text" id="asal_instansi" name="asal_instansi" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                               placeholder="Nama sekolah atau instansi">
                    </div>
                    
                    <!-- Jenis Pengunjung -->
                    <div class="form-group md:col-span-2">
                        <label class="block text-gray-700 font-medium mb-2">
                            <i class="fas fa-users text-blue-500 mr-1"></i> Jenis Pengunjung
                        </label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-blue-50 transition">
                                <input type="radio" name="jenis_pengunjung" value="siswa" required class="mr-3 text-blue-600 focus:ring-blue-500">
                                <div>
                                    <div class="font-medium">Siswa</div>
                                    <div class="text-sm text-gray-500">Pelajar/Mahasiswa</div>
                                </div>
                            </label>
                            
                            <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-blue-50 transition">
                                <input type="radio" name="jenis_pengunjung" value="guru" required class="mr-3 text-blue-600 focus:ring-blue-500">
                                <div>
                                    <div class="font-medium">Guru</div>
                                    <div class="text-sm text-gray-500">Tenaga Pendidik</div>
                                </div>
                            </label>
                            
                            <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-blue-50 transition">
                                <input type="radio" name="jenis_pengunjung" value="umum" required class="mr-3 text-blue-600 focus:ring-blue-500">
                                <div>
                                    <div class="font-medium">Umum</div>
                                    <div class="text-sm text-gray-500">Masyarakat Umum</div>
                                </div>
                            </label>
                            
                            <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-blue-50 transition">
                                <input type="radio" name="jenis_pengunjung" value="alumni" required class="mr-3 text-blue-600 focus:ring-blue-500">
                                <div>
                                    <div class="font-medium">Alumni</div>
                                    <div class="text-sm text-gray-500">Alumni SMKN 8 Bone</div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                
                <!-- Tombol Submit -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex flex-col md:flex-row justify-between items-center">
                        <div class="mb-4 md:mb-0">
                            <a href="list-pengunjung.php" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
                                <i class="fas fa-list mr-2"></i> Lihat Daftar Pengunjung
                            </a>
                        </div>
                        <button type="submit" 
                                class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold py-3 px-8 rounded-lg shadow-md hover:shadow-lg transition duration-300 flex items-center">
                            <i class="fas fa-paper-plane mr-2"></i> Daftar Sekarang
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Informasi Acara -->
        <div class="max-w-2xl mx-auto mt-10 bg-white rounded-xl shadow-md p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-info-circle text-blue-500 mr-2"></i> Informasi Acara
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center p-4 bg-blue-50 rounded-lg">
                    <div class="text-3xl font-bold text-blue-600 mb-2">GERKA 2025</div>
                    <div class="text-gray-700">Gelar Karya Siswa</div>
                </div>
                <div class="text-center p-4 bg-purple-50 rounded-lg">
                    <div class="text-2xl font-bold text-purple-600 mb-2">SMKN 8 Bone</div>
                    <div class="text-gray-700">Sekolah Menengah Kejuruan Negeri 8 Bone</div>
                </div>
                <div class="text-center p-4 bg-green-50 rounded-lg">
                    <div class="text-xl font-bold text-green-600 mb-2">Berkarya & Inovasi</div>
                    <div class="text-gray-700">Membangun Generasi Kreatif</div>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <footer class="mt-12 text-center text-gray-600 text-sm">
            <p class="mb-2">© 2025 GERKA - Gelar Karya SMKN 8 Bone. All rights reserved.</p>
            <p>Dikembangkan untuk mendukung acara Gelar Karya 2025</p>
        </footer>
    </div>
    
    <!-- JavaScript untuk validasi form -->
    <script>
        document.getElementById('formRegistrasi').addEventListener('submit', function(e) {
            const nama = document.getElementById('nama').value.trim();
            const email = document.getElementById('email').value.trim();
            const telepon = document.getElementById('no_telepon').value.trim();
            const asal = document.getElementById('asal_instansi').value.trim();
            
            // Validasi sederhana
            if (!nama || !email || !telepon || !asal) {
                e.preventDefault();
                alert('Harap isi semua field yang wajib diisi!');
                return false;
            }
            
            // Validasi email
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                e.preventDefault();
                alert('Format email tidak valid!');
                return false;
            }
            
            // Validasi telepon (minimal 10 digit)
            const teleponPattern = /^[0-9]{10,15}$/;
            if (!teleponPattern.test(telepon.replace(/\D/g, ''))) {
                e.preventDefault();
                alert('Nomor telepon harus antara 10-15 digit angka!');
                return false;
            }
            
            return true;
        });
    </script>
</body>
</html>