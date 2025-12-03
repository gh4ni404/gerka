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
        body { 
            font-family: 'Poppins', sans-serif; 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .card-shadow {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background: linear-gradient(to right, #667eea, #764ba2);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 14px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Header dengan background gradient -->
        <header class="text-center mb-10 bg-white rounded-2xl card-shadow p-8 max-w-4xl mx-auto">
            <div class="flex flex-col md:flex-row justify-center items-center mb-6">
                <div class="w-20 h-20 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center mr-0 md:mr-6 mb-4 md:mb-0">
                    <i class="fas fa-graduation-cap text-white text-3xl"></i>
                </div>
                <div class="text-center md:text-left">
                    <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">GERKA 2025</h1>
                    <p class="text-xl text-gray-700 mt-2">Gelar Karya SMKN 8 Bone</p>
                </div>
            </div>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">Registrasi Pengunjung</h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">Daftarkan diri Anda untuk menghadiri Gelar Karya 2025. Isi data diri dengan lengkap dan benar.</p>
        </header>

        <!-- Notifikasi -->
        <?php if(isset($_SESSION['sukses'])): ?>
            <div class="max-w-4xl mx-auto mb-6 bg-gradient-to-r from-green-100 to-emerald-100 border border-green-200 text-green-800 px-6 py-4 rounded-xl card-shadow">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-600 text-xl mr-3"></i>
                    <span class="font-medium"><?php echo $_SESSION['sukses']; unset($_SESSION['sukses']); ?></span>
                </div>
            </div>
        <?php endif; ?>
        
        <?php if(isset($_SESSION['error'])): ?>
            <div class="max-w-4xl mx-auto mb-6 bg-gradient-to-r from-red-100 to-pink-100 border border-red-200 text-red-800 px-6 py-4 rounded-xl card-shadow">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-600 text-xl mr-3"></i>
                    <span class="font-medium"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></span>
                </div>
            </div>
        <?php endif; ?>

        <!-- Form Registrasi -->
        <div class="max-w-4xl mx-auto bg-white rounded-2xl card-shadow overflow-hidden mb-10">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-8 py-6">
                <h3 class="text-2xl font-bold text-white">Form Pendaftaran</h3>
                <p class="text-blue-100 text-sm mt-1">Isi data diri dengan lengkap dan benar</p>
            </div>
            
            <form action="proses.php" method="POST" class="p-8" id="formRegistrasi">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Nama Lengkap -->
                    <div class="form-group">
                        <label for="nama" class="block text-gray-700 font-medium mb-3 text-lg">
                            <i class="fas fa-user text-blue-500 mr-2"></i> Nama Lengkap
                        </label>
                        <input type="text" id="nama" name="nama" required 
                               class="w-full px-5 py-4 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300"
                               placeholder="Masukkan nama lengkap Anda">
                    </div>
                    
                    <!-- Jenis Kelamin -->
                    <div class="form-group">
                        <label class="block text-gray-700 font-medium mb-3 text-lg">
                            <i class="fas fa-venus-mars text-blue-500 mr-2"></i> Jenis Kelamin
                        </label>
                        <div class="flex space-x-6">
                            <label class="flex items-center bg-gray-50 hover:bg-blue-50 px-5 py-3 rounded-xl cursor-pointer transition-colors duration-300">
                                <input type="radio" name="jenis_kelamin" value="L" required class="mr-3 h-5 w-5 text-blue-600 focus:ring-blue-500">
                                <span class="text-gray-700 font-medium">Laki-laki</span>
                            </label>
                            <label class="flex items-center bg-gray-50 hover:bg-pink-50 px-5 py-3 rounded-xl cursor-pointer transition-colors duration-300">
                                <input type="radio" name="jenis_kelamin" value="P" required class="mr-3 h-5 w-5 text-blue-600 focus:ring-blue-500">
                                <span class="text-gray-700 font-medium">Perempuan</span>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Usia -->
                    <div class="form-group">
                        <label for="usia" class="block text-gray-700 font-medium mb-3 text-lg">
                            <i class="fas fa-birthday-cake text-blue-500 mr-2"></i> Usia
                        </label>
                        <input type="number" id="usia" name="usia" required min="5" max="100"
                               class="w-full px-5 py-4 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300"
                               placeholder="Masukkan usia Anda">
                    </div>
                    
                    <!-- No Telepon -->
                    <div class="form-group">
                        <label for="no_telepon" class="block text-gray-700 font-medium mb-3 text-lg">
                            <i class="fas fa-phone text-blue-500 mr-2"></i> No. Telepon/WA
                        </label>
                        <input type="tel" id="no_telepon" name="no_telepon" required 
                               class="w-full px-5 py-4 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300"
                               placeholder="0812xxxxxxx">
                    </div>
                    
                    <!-- Alamat/Domisili -->
                    <div class="form-group md:col-span-2">
                        <label for="alamat" class="block text-gray-700 font-medium mb-3 text-lg">
                            <i class="fas fa-home text-blue-500 mr-2"></i> Alamat/Domisili
                        </label>
                        <textarea id="alamat" name="alamat" required rows="3"
                               class="w-full px-5 py-4 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300"
                               placeholder="Masukkan alamat lengkap Anda"></textarea>
                    </div>
                    
                    <!-- Asal Instansi -->
                    <div class="form-group">
                        <label for="asal_instansi" class="block text-gray-700 font-medium mb-3 text-lg">
                            <i class="fas fa-school text-blue-500 mr-2"></i> Asal Instansi/Sekolah
                        </label>
                        <input type="text" id="asal_instansi" name="asal_instansi" required 
                               class="w-full px-5 py-4 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300"
                               placeholder="Nama sekolah atau instansi">
                    </div>
                    
                    <!-- Waktu Kunjungan -->
                    <div class="form-group">
                        <label for="waktu_kunjungan" class="block text-gray-700 font-medium mb-3 text-lg">
                            <i class="fas fa-clock text-blue-500 mr-2"></i> Waktu Kunjungan
                        </label>
                        <select id="waktu_kunjungan" name="waktu_kunjungan" required 
                                class="w-full px-5 py-4 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300 appearance-none">
                            <option value="" disabled selected>Pilih waktu kunjungan</option>
                            <option value="pagi" class="py-2">Pagi (08:00 - 11:00)</option>
                            <option value="siang" class="py-2">Siang (11:00 - 14:00)</option>
                            <option value="sore" class="py-2">Sore (14:00 - 17:00)</option>
                        </select>
                    </div>
                    
                    <!-- Jenis Pengunjung -->
                    <div class="form-group md:col-span-2">
                        <label class="block text-gray-700 font-medium mb-3 text-lg">
                            <i class="fas fa-users text-blue-500 mr-2"></i> Jenis Pengunjung
                        </label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <label class="flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-blue-300 hover:bg-blue-50 transition-all duration-300">
                                <input type="radio" name="jenis_pengunjung" value="siswa" required class="mr-4 h-5 w-5 text-blue-600 focus:ring-blue-500">
                                <div>
                                    <div class="font-bold text-gray-800">Siswa</div>
                                    <div class="text-sm text-gray-500 mt-1">Pelajar/Mahasiswa</div>
                                </div>
                            </label>
                            
                            <label class="flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-green-300 hover:bg-green-50 transition-all duration-300">
                                <input type="radio" name="jenis_pengunjung" value="guru" required class="mr-4 h-5 w-5 text-blue-600 focus:ring-blue-500">
                                <div>
                                    <div class="font-bold text-gray-800">Guru</div>
                                    <div class="text-sm text-gray-500 mt-1">Tenaga Pendidik</div>
                                </div>
                            </label>
                            
                            <label class="flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-yellow-300 hover:bg-yellow-50 transition-all duration-300">
                                <input type="radio" name="jenis_pengunjung" value="umum" required class="mr-4 h-5 w-5 text-blue-600 focus:ring-blue-500">
                                <div>
                                    <div class="font-bold text-gray-800">Umum</div>
                                    <div class="text-sm text-gray-500 mt-1">Masyarakat Umum</div>
                                </div>
                            </label>
                            
                            <label class="flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-purple-300 hover:bg-purple-50 transition-all duration-300">
                                <input type="radio" name="jenis_pengunjung" value="alumni" required class="mr-4 h-5 w-5 text-blue-600 focus:ring-blue-500">
                                <div>
                                    <div class="font-bold text-gray-800">Alumni</div>
                                    <div class="text-sm text-gray-500 mt-1">Alumni SMKN 8 Bone</div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                
                <!-- Tombol Submit -->
                <div class="mt-10 pt-8 border-t border-gray-100 text-center">
                    <button type="submit" 
                            class="btn-primary text-white font-bold py-4 px-12 rounded-xl text-lg inline-flex items-center shadow-lg">
                        <i class="fas fa-paper-plane mr-3"></i> Daftar Sekarang
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Informasi Acara -->
        <div class="max-w-4xl mx-auto bg-white rounded-2xl card-shadow p-8 mb-10">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-2xl font-bold text-gray-800">
                    <i class="fas fa-info-circle text-blue-500 mr-3"></i> Informasi Acara
                </h3>
                <a href="list-pengunjung.php" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-bold rounded-xl shadow-md hover:shadow-lg transition duration-300">
                    <i class="fas fa-list mr-2"></i> Lihat Daftar Pengunjung
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="text-center p-6 bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl border border-blue-200">
                    <div class="text-4xl font-bold text-blue-600 mb-3">GERKA 2025</div>
                    <div class="text-gray-700 font-medium">Gelar Karya Siswa</div>
                    <div class="text-sm text-gray-500 mt-2">Pameran karya terbaik siswa SMKN 8 Bone</div>
                </div>
                <div class="text-center p-6 bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl border border-purple-200">
                    <div class="text-3xl font-bold text-purple-600 mb-3">SMKN 8 Bone</div>
                    <div class="text-gray-700 font-medium">Sekolah Menengah Kejuruan</div>
                    <div class="text-sm text-gray-500 mt-2">Mencetak generasi profesional dan kreatif</div>
                </div>
                <div class="text-center p-6 bg-gradient-to-br from-green-50 to-green-100 rounded-2xl border border-green-200">
                    <div class="text-2xl font-bold text-green-600 mb-3">Berkarya & Inovasi</div>
                    <div class="text-gray-700 font-medium">Membangun Generasi Kreatif</div>
                    <div class="text-sm text-gray-500 mt-2">Inovasi teknologi dan kewirausahaan</div>
                </div>
            </div>
            
            <!-- Detail Acara -->
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 p-6 rounded-2xl border border-gray-200">
                <h4 class="font-bold text-xl text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-calendar-alt text-blue-500 mr-3"></i> Detail Pelaksanaan
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-day text-blue-500 mr-3 w-6 text-center"></i>
                            <div>
                                <div class="font-medium text-gray-700">Tanggal</div>
                                <div class="text-gray-900 font-bold">25-27 Oktober 2025</div>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock text-blue-500 mr-3 w-6 text-center"></i>
                            <div>
                                <div class="font-medium text-gray-700">Waktu</div>
                                <div class="text-gray-900 font-bold">08:00 - 17:00 WITA</div>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt text-blue-500 mr-3 w-6 text-center"></i>
                            <div>
                                <div class="font-medium text-gray-700">Lokasi</div>
                                <div class="text-gray-900 font-bold">SMKN 8 Bone, Jl. Pendidikan No. 123</div>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-users text-blue-500 mr-3 w-6 text-center"></i>
                            <div>
                                <div class="font-medium text-gray-700">Peserta</div>
                                <div class="text-gray-900 font-bold">Terbuka untuk Umum</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <footer class="text-center text-gray-600">
            <div class="bg-white rounded-2xl card-shadow p-8 max-w-4xl mx-auto">
                <div class="mb-6">
                    <h4 class="text-2xl font-bold text-gray-800 mb-3">GERKA 2025</h4>
                    <p class="text-gray-700">Gelar Karya SMKN 8 Bone - Wadah apresiasi karya siswa berbasis teknologi dan kewirausahaan</p>
                </div>
                <div class="border-t border-gray-200 pt-6">
                    <p class="mb-2">© 2025 GERKA - Gelar Karya SMKN 8 Bone. All rights reserved.</p>
                    <p class="text-sm text-gray-500">Sistem Registrasi Pengunjung v3.0</p>
                </div>
            </div>
        </footer>
    </div>
    
    <!-- JavaScript untuk validasi form -->
    <script>
        document.getElementById('formRegistrasi').addEventListener('submit', function(e) {
            const nama = document.getElementById('nama').value.trim();
            const usia = document.getElementById('usia').value.trim();
            const telepon = document.getElementById('no_telepon').value.trim();
            const alamat = document.getElementById('alamat').value.trim();
            const asal = document.getElementById('asal_instansi').value.trim();
            const jenisKelamin = document.querySelector('input[name="jenis_kelamin"]:checked');
            const waktuKunjungan = document.getElementById('waktu_kunjungan').value;
            const jenisPengunjung = document.querySelector('input[name="jenis_pengunjung"]:checked');
            
            // Validasi semua field wajib
            if (!nama || !usia || !telepon || !alamat || !asal || !jenisKelamin || !waktuKunjungan || !jenisPengunjung) {
                e.preventDefault();
                showAlert('Harap isi semua field yang wajib diisi!', 'error');
                return false;
            }
            
            // Validasi usia (5-100 tahun)
            const usiaNum = parseInt(usia);
            if (usiaNum < 5 || usiaNum > 100) {
                e.preventDefault();
                showAlert('Usia harus antara 5-100 tahun!', 'error');
                return false;
            }
            
            // Validasi telepon (minimal 10 digit)
            const teleponPattern = /^[0-9]{10,15}$/;
            if (!teleponPattern.test(telepon.replace(/\D/g, ''))) {
                e.preventDefault();
                showAlert('Nomor telepon harus 10-15 digit angka!', 'error');
                return false;
            }
            
            // Validasi nama (minimal 3 karakter)
            if (nama.length < 3) {
                e.preventDefault();
                showAlert('Nama harus minimal 3 karakter!', 'error');
                return false;
            }
            
            // Validasi alamat (minimal 10 karakter)
            if (alamat.length < 10) {
                e.preventDefault();
                showAlert('Alamat harus minimal 10 karakter!', 'error');
                return false;
            }
            
            return true;
        });
        
        // Format telepon (hanya angka)
        document.getElementById('no_telepon').addEventListener('input', function(e) {
            this.value = this.value.replace(/\D/g, '');
        });
        
        // Fungsi untuk menampilkan alert kustom
        function showAlert(message, type) {
            // Hapus alert sebelumnya jika ada
            const existingAlert = document.querySelector('.custom-alert');
            if (existingAlert) {
                existingAlert.remove();
            }
            
            // Buat elemen alert
            const alertDiv = document.createElement('div');
            alertDiv.className = `custom-alert fixed top-6 right-6 px-6 py-4 rounded-xl shadow-lg z-50 flex items-center ${
                type === 'error' ? 'bg-gradient-to-r from-red-100 to-pink-100 border border-red-200 text-red-800' : 
                'bg-gradient-to-r from-green-100 to-emerald-100 border border-green-200 text-green-800'
            }`;
            
            const icon = type === 'error' ? 
                '<i class="fas fa-exclamation-circle text-xl mr-3"></i>' : 
                '<i class="fas fa-check-circle text-xl mr-3"></i>';
            
            alertDiv.innerHTML = `
                ${icon}
                <span class="font-medium">${message}</span>
                <button class="ml-6 text-gray-500 hover:text-gray-700" onclick="this.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            `;
            
            document.body.appendChild(alertDiv);
            
            // Hapus alert setelah 5 detik
            setTimeout(() => {
                if (alertDiv.parentElement) {
                    alertDiv.remove();
                }
            }, 5000);
        }
        
        // Animasi untuk form input focus
        const inputs = document.querySelectorAll('input, textarea, select');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-2', 'ring-blue-200');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-2', 'ring-blue-200');
            });
        });
    </script>
</body>
</html>