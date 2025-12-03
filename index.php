<?php
require_once 'koneksi.php';
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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
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
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Form Pendaftaran Pengunjung Pameran</h2>
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
                <!-- Nama Lengkap -->
                <div class="form-group mb-6">
                    <label for="nama" class="block text-gray-700 font-medium mb-2">
                        <i class="fas fa-user text-blue-500 mr-1"></i> Nama Lengkap
                    </label>
                    <input type="text" id="nama" name="nama" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                           placeholder="Masukkan nama lengkap">
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Jenis Kelamin -->
                    <div class="form-group">
                        <label class="block text-gray-700 font-medium mb-2">
                            <i class="fas fa-venus-mars text-blue-500 mr-1"></i> Jenis Kelamin
                        </label>
                        <div class="flex space-x-6">
                            <label class="flex items-center">
                                <input type="radio" name="jenis_kelamin" value="L" required class="mr-2 text-blue-600 focus:ring-blue-500">
                                <span>Laki-laki</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="jenis_kelamin" value="P" required class="mr-2 text-blue-600 focus:ring-blue-500">
                                <span>Perempuan</span>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Usia -->
                    <div class="form-group">
                        <label for="usia" class="block text-gray-700 font-medium mb-2">
                            <i class="fas fa-birthday-cake text-blue-500 mr-1"></i> Usia
                        </label>
                        <input type="number" id="usia" name="usia" required min="1" max="100"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                               placeholder="Contoh: 17">
                    </div>
                </div>
                
                <!-- Alamat / Domisili -->
                <div class="form-group mb-6">
                    <label for="alamat" class="block text-gray-700 font-medium mb-2">
                        <i class="fas fa-home text-blue-500 mr-1"></i> Alamat / Domisili
                    </label>
                    <textarea id="alamat" name="alamat" rows="3" required
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                              placeholder="Masukkan alamat lengkap"></textarea>
                </div>
                
                <!-- Nomor Telepon / WhatsApp -->
                <div class="form-group mb-6">
                    <label for="no_telepon" class="block text-gray-700 font-medium mb-2">
                        <i class="fas fa-phone text-blue-500 mr-1"></i> Nomor Telepon / WhatsApp
                    </label>
                    <input type="tel" id="no_telepon" name="no_telepon" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                           placeholder="0812xxxxxxx">
                </div>
                
                <!-- Tujuan Kunjungan -->
                <div class="form-group mb-6">
                    <label class="block text-gray-700 font-medium mb-2">
                        <i class="fas fa-bullseye text-blue-500 mr-1"></i> Tujuan Kunjungan (bisa pilih lebih dari satu)
                    </label>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" name="tujuan_kunjungan[]" value="Melihat pameran" class="mr-3 rounded text-blue-600 focus:ring-blue-500">
                            <span>Melihat pameran</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="tujuan_kunjungan[]" value="Membeli produk/karya" class="mr-3 rounded text-blue-600 focus:ring-blue-500">
                            <span>Membeli produk/karya</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="tujuan_kunjungan[]" value="Riset/penelitian" class="mr-3 rounded text-blue-600 focus:ring-blue-500">
                            <span>Riset/penelitian</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="tujuan_kunjungan[]" value="Mendampingi peserta" class="mr-3 rounded text-blue-600 focus:ring-blue-500">
                            <span>Mendampingi peserta</span>
                        </label>
                        <div class="flex items-center mt-2">
                            <input type="checkbox" id="lainnya_checkbox" class="mr-3 rounded text-blue-600 focus:ring-blue-500">
                            <span>Lainnya:</span>
                            <input type="text" id="lainnya_text" class="ml-2 px-3 py-2 border border-gray-300 rounded flex-grow" placeholder="Tulis tujuan lainnya" disabled>
                        </div>
                    </div>
                    <!-- Input tersembunyi untuk menangani nilai "Lainnya" -->
                    <input type="hidden" name="tujuan_kunjungan[]" id="lainnya_hidden">
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Hari/Tanggal Kunjungan -->
                    <div class="form-group">
                        <label for="hari_tanggal" class="block text-gray-700 font-medium mb-2">
                            <i class="fas fa-calendar-day text-blue-500 mr-1"></i> Hari/Tanggal Kunjungan
                        </label>
                        <input type="date" id="hari_tanggal" name="hari_tanggal" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>
                    
                    <!-- Waktu Masuk -->
                    <div class="form-group">
                        <label for="waktu_masuk" class="block text-gray-700 font-medium mb-2">
                            <i class="fas fa-clock text-blue-500 mr-1"></i> Waktu Masuk
                        </label>
                        <input type="time" id="waktu_masuk" name="waktu_masuk" required 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>
                </div>
                
                <!-- Persetujuan -->
                <div class="form-group mb-8">
                    <div class="flex items-start p-4 bg-blue-50 rounded-lg border border-blue-200">
                        <input type="checkbox" id="setuju" name="setuju" required 
                               class="mt-1 mr-3 rounded text-blue-600 focus:ring-blue-500">
                        <label for="setuju" class="text-gray-700">
                            Saya menyetujui bahwa data saya digunakan untuk keperluan administrasi dan evaluasi acara.
                        </label>
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
                <i class="fas fa-info-circle text-blue-500 mr-2"></i> Informasi Acara GERKA 2025
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h4 class="font-bold text-lg text-blue-700 mb-2">Lokasi</h4>
                    <p class="text-gray-700">SMKN 8 Bone</p>
                    <p class="text-gray-600 text-sm">Jl. Pendidikan No. 45, Bone, Sulawesi Selatan</p>
                </div>
                <div>
                    <h4 class="font-bold text-lg text-blue-700 mb-2">Waktu Pelaksanaan</h4>
                    <p class="text-gray-700">15-17 Mei 2025</p>
                    <p class="text-gray-600 text-sm">Pukul 08:00 - 16:00 WITA</p>
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
        // Menangani checkbox "Lainnya"
        const lainnyaCheckbox = document.getElementById('lainnya_checkbox');
        const lainnyaText = document.getElementById('lainnya_text');
        const lainnyaHidden = document.getElementById('lainnya_hidden');

        lainnyaCheckbox.addEventListener('change', function() {
            if (this.checked) {
                lainnyaText.disabled = false;
                lainnyaText.focus();
            } else {
                lainnyaText.disabled = true;
                lainnyaText.value = '';
            }
        });

        // Saat form disubmit
        document.getElementById('formRegistrasi').addEventListener('submit', function(e) {
            const nama = document.getElementById('nama').value.trim();
            const usia = document.getElementById('usia').value;
            const alamat = document.getElementById('alamat').value.trim();
            const telepon = document.getElementById('no_telepon').value.trim();
            const tanggal = document.getElementById('hari_tanggal').value;
            const waktu = document.getElementById('waktu_masuk').value;
            const setuju = document.getElementById('setuju').checked;
            
            // Validasi checkbox tujuan kunjungan
            const tujuanCheckboxes = document.querySelectorAll('input[name="tujuan_kunjungan[]"]:checked');
            const tujuanLainnya = document.getElementById('lainnya_text').value.trim();
            
            // Jika checkbox lainnya dicentang dan ada isinya, tambahkan ke hidden input
            if (lainnyaCheckbox.checked && tujuanLainnya !== '') {
                lainnyaHidden.value = tujuanLainnya;
            } else {
                lainnyaHidden.disabled = true;
            }
            
            // Validasi minimal satu tujuan kunjungan terpilih
            if (tujuanCheckboxes.length === 0 && !(lainnyaCheckbox.checked && tujuanLainnya !== '')) {
                e.preventDefault();
                alert('Pilih minimal satu tujuan kunjungan!');
                return false;
            }
            
            // Validasi sederhana lainnya
            if (!nama || !usia || !alamat || !telepon || !tanggal || !waktu) {
                e.preventDefault();
                alert('Harap isi semua field yang wajib diisi!');
                return false;
            }
            
            if (!setuju) {
                e.preventDefault();
                alert('Anda harus menyetujui penggunaan data!');
                return false;
            }
            
            // Validasi usia
            if (usia < 1 || usia > 100) {
                e.preventDefault();
                alert('Usia harus antara 1-100 tahun!');
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
        
        // Set tanggal minimal hari ini
        document.getElementById('hari_tanggal').min = new Date().toISOString().split("T")[0];
    </script>
</body>
</html>