<?php
require_once 'koneksi.php';

// Query untuk mengambil data pengunjung
$sql = "SELECT * FROM pengunjung ORDER BY tanggal_daftar DESC";
$result = mysqli_query($conn, $sql);

// Hitung total pengunjung
$total_pengunjung = mysqli_num_rows($result);

// Hitung statistik
$sql_stats = "SELECT 
    COUNT(*) as total,
    SUM(jenis_kelamin = 'L') as laki_laki,
    SUM(jenis_kelamin = 'P') as perempuan,
    SUM(jenis_pengunjung = 'siswa') as siswa,
    SUM(jenis_pengunjung = 'guru') as guru,
    SUM(jenis_pengunjung = 'umum') as umum,
    SUM(jenis_pengunjung = 'alumni') as alumni,
    SUM(waktu_kunjungan = 'pagi') as pagi,
    SUM(waktu_kunjungan = 'siang') as siang,
    SUM(waktu_kunjungan = 'sore') as sore
    FROM pengunjung";
$result_stats = mysqli_query($conn, $sql_stats);
$stats = mysqli_fetch_assoc($result_stats);

// Hitung distribusi usia
$sql_usia = "SELECT 
    SUM(usia < 18) as anak_remaja,
    SUM(usia BETWEEN 18 AND 35) as dewasa_muda,
    SUM(usia BETWEEN 36 AND 55) as dewasa,
    SUM(usia > 55) as lansia
    FROM pengunjung";
$result_usia = mysqli_query($conn, $sql_usia);
$usia_stats = mysqli_fetch_assoc($result_usia);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengunjung GERKA 2025 - SMKN 8 Bone</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
        .stat-card {
            transition: transform 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .table-row:hover {
            background-color: rgba(102, 126, 234, 0.05);
        }
    </style>
</head>
<body class="min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <header class="text-center mb-10 bg-white rounded-2xl card-shadow p-8 max-w-6xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                <div class="flex items-center mb-4 md:mb-0">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <div class="text-left">
                        <h1 class="text-3xl font-bold text-gray-800">Daftar Pengunjung</h1>
                        <p class="text-gray-700">GERKA 2025 - SMKN 8 Bone</p>
                    </div>
                </div>
                
                <div class="flex flex-wrap gap-4">
                    <div class="bg-gradient-to-r from-blue-100 to-blue-50 text-blue-800 px-5 py-3 rounded-xl font-bold border border-blue-200">
                        <i class="fas fa-user-friends mr-2"></i> Total: <?php echo $total_pengunjung; ?> Pengunjung
                    </div>
                </div>
            </div>
            
            <div class="flex justify-center mt-6">
                <a href="index.php" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold rounded-xl shadow-md hover:shadow-lg transition duration-300">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Form Registrasi
                </a>
            </div>
        </header>
        
        <!-- Statistik Utama -->
        <div class="max-w-6xl mx-auto mb-10 grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white rounded-2xl card-shadow p-6 stat-card">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-100 to-blue-50 rounded-xl flex items-center justify-center mr-4">
                        <i class="fas fa-male text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-800"><?php echo $stats['laki_laki']; ?></div>
                        <div class="text-gray-600">Laki-laki</div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl card-shadow p-6 stat-card">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-r from-pink-100 to-pink-50 rounded-xl flex items-center justify-center mr-4">
                        <i class="fas fa-female text-pink-600 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-800"><?php echo $stats['perempuan']; ?></div>
                        <div class="text-gray-600">Perempuan</div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl card-shadow p-6 stat-card">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-r from-green-100 to-green-50 rounded-xl flex items-center justify-center mr-4">
                        <i class="fas fa-user-graduate text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-800"><?php echo $stats['siswa']; ?></div>
                        <div class="text-gray-600">Siswa</div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl card-shadow p-6 stat-card">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-r from-purple-100 to-purple-50 rounded-xl flex items-center justify-center mr-4">
                        <i class="fas fa-chalkboard-teacher text-purple-600 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-800"><?php echo $stats['guru']; ?></div>
                        <div class="text-gray-600">Guru</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Statistik Detail -->
        <div class="max-w-6xl mx-auto mb-10 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl card-shadow p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-users text-blue-500 mr-3"></i> Jenis Pengunjung
                </h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-blue-500 rounded-full mr-3"></div>
                            <span class="text-gray-700">Siswa</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-bold text-blue-600 mr-2"><?php echo $stats['siswa']; ?></span>
                            <span class="text-sm text-gray-500">orang</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                            <span class="text-gray-700">Guru</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-bold text-green-600 mr-2"><?php echo $stats['guru']; ?></span>
                            <span class="text-sm text-gray-500">orang</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-yellow-500 rounded-full mr-3"></div>
                            <span class="text-gray-700">Umum</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-bold text-yellow-600 mr-2"><?php echo $stats['umum']; ?></span>
                            <span class="text-sm text-gray-500">orang</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-purple-500 rounded-full mr-3"></div>
                            <span class="text-gray-700">Alumni</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-bold text-purple-600 mr-2"><?php echo $stats['alumni']; ?></span>
                            <span class="text-sm text-gray-500">orang</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl card-shadow p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-clock text-blue-500 mr-3"></i> Waktu Kunjungan
                </h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-yellow-500 rounded-full mr-3"></div>
                            <span class="text-gray-700">Pagi (08:00-11:00)</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-bold text-yellow-600 mr-2"><?php echo $stats['pagi']; ?></span>
                            <span class="text-sm text-gray-500">orang</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-orange-500 rounded-full mr-3"></div>
                            <span class="text-gray-700">Siang (11:00-14:00)</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-bold text-orange-600 mr-2"><?php echo $stats['siang']; ?></span>
                            <span class="text-sm text-gray-500">orang</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-red-500 rounded-full mr-3"></div>
                            <span class="text-gray-700">Sore (14:00-17:00)</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-bold text-red-600 mr-2"><?php echo $stats['sore']; ?></span>
                            <span class="text-sm text-gray-500">orang</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl card-shadow p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-chart-pie text-blue-500 mr-3"></i> Distribusi Usia
                </h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                            <span class="text-gray-700">Anak/Remaja (<18)</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-bold text-green-600 mr-2"><?php echo $usia_stats['anak_remaja']; ?></span>
                            <span class="text-sm text-gray-500">orang</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-blue-500 rounded-full mr-3"></div>
                            <span class="text-gray-700">Dewasa Muda (18-35)</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-bold text-blue-600 mr-2"><?php echo $usia_stats['dewasa_muda']; ?></span>
                            <span class="text-sm text-gray-500">orang</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-purple-500 rounded-full mr-3"></div>
                            <span class="text-gray-700">Dewasa (36-55)</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-bold text-purple-600 mr-2"><?php echo $usia_stats['dewasa']; ?></span>
                            <span class="text-sm text-gray-500">orang</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-gray-500 rounded-full mr-3"></div>
                            <span class="text-gray-700">Lansia (>55)</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-bold text-gray-600 mr-2"><?php echo $usia_stats['lansia']; ?></span>
                            <span class="text-sm text-gray-500">orang</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Tabel Pengunjung -->
        <div class="max-w-6xl mx-auto bg-white rounded-2xl card-shadow overflow-hidden mb-10">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-8 py-6">
                <h3 class="text-2xl font-bold text-white">Data Pengunjung Terdaftar</h3>
                <p class="text-blue-100 text-sm mt-1">Total <?php echo $total_pengunjung; ?> pengunjung telah mendaftar</p>
            </div>
            
            <?php if ($total_pengunjung > 0): ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-8 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">No</th>
                                <th scope="col" class="px-8 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Nama</th>
                                <th scope="col" class="px-8 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">JK</th>
                                <th scope="col" class="px-8 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Usia</th>
                                <th scope="col" class="px-8 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Telepon</th>
                                <th scope="col" class="px-8 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Asal Instansi</th>
                                <th scope="col" class="px-8 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Jenis</th>
                                <th scope="col" class="px-8 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Waktu</th>
                                <th scope="col" class="px-8 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Tanggal Daftar</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php 
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($result)): 
                                // Tentukan warna badge berdasarkan jenis pengunjung
                                $badge_color = [
                                    'siswa' => 'bg-blue-100 text-blue-800 border border-blue-200',
                                    'guru' => 'bg-green-100 text-green-800 border border-green-200',
                                    'umum' => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                                    'alumni' => 'bg-purple-100 text-purple-800 border border-purple-200'
                                ][$row['jenis_pengunjung']];
                                
                                // Warna badge waktu kunjungan
                                $waktu_color = [
                                    'pagi' => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                                    'siang' => 'bg-orange-100 text-orange-800 border border-orange-200',
                                    'sore' => 'bg-red-100 text-red-800 border border-red-200'
                                ][$row['waktu_kunjungan']];
                                
                                // Format tanggal
                                $tanggal = date('d-m-Y H:i', strtotime($row['tanggal_daftar']));
                            ?>
                            <tr class="table-row transition-colors duration-200">
                                <td class="px-8 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo $no++; ?></td>
                                <td class="px-8 py-4 whitespace-nowrap text-sm font-bold text-gray-900"><?php echo htmlspecialchars($row['nama']); ?></td>
                                <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-700">
                                    <?php if($row['jenis_kelamin'] == 'L'): ?>
                                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-800 text-xs font-medium">Laki-laki</span>
                                    <?php else: ?>
                                        <span class="px-3 py-1 rounded-full bg-pink-100 text-pink-800 text-xs font-medium">Perempuan</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-700 font-medium"><?php echo $row['usia']; ?> tahun</td>
                                <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-700"><?php echo htmlspecialchars($row['no_telepon']); ?></td>
                                <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-700 max-w-xs"><?php echo htmlspecialchars($row['asal_instansi']); ?></td>
                                <td class="px-8 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-bold rounded-full <?php echo $badge_color; ?>">
                                        <?php echo ucfirst($row['jenis_pengunjung']); ?>
                                    </span>
                                </td>
                                <td class="px-8 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-bold rounded-full <?php echo $waktu_color; ?>">
                                        <?php echo ucfirst($row['waktu_kunjungan']); ?>
                                    </span>
                                </td>
                                <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-600"><?php echo $tanggal; ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="p-16 text-center">
                    <div class="text-6xl text-gray-300 mb-6">
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-500 mb-4">Belum ada pengunjung terdaftar</h3>
                    <p class="text-gray-400 mb-8 max-w-md mx-auto">Pengunjung yang mendaftar akan muncul di sini. Jadilah yang pertama mendaftar!</p>
                    <a href="index.php" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                        <i class="fas fa-plus mr-3"></i> Daftarkan Pengunjung Pertama
                    </a>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Tombol Export -->
        <?php if ($total_pengunjung > 0): ?>
        <div class="max-w-6xl mx-auto mb-10 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="text-gray-600">
                <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                Data diperbarui secara real-time
            </div>
            <div class="flex gap-4">
                <a href="#" onclick="window.print()" class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition duration-300 shadow-md">
                    <i class="fas fa-print mr-2"></i> Cetak Laporan
                </a>
                <a href="export.php" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-bold rounded-xl shadow-md hover:shadow-lg transition duration-300">
                    <i class="fas fa-file-excel mr-2"></i> Export Excel
                </a>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Footer -->
        <footer class="text-center text-gray-600">
            <div class="bg-white rounded-2xl card-shadow p-8 max-w-6xl mx-auto">
                <div class="mb-6">
                    <h4 class="text-xl font-bold text-gray-800 mb-3">GERKA 2025 - SMKN 8 Bone</h4>
                    <p class="text-gray-700">Sistem Registrasi Pengunjung | Versi 3.0</p>
                </div>
                <div class="border-t border-gray-200 pt-6">
                    <p>© 2025 Gelar Karya SMKN 8 Bone. All rights reserved.</p>
                    <p class="text-sm text-gray-500 mt-2">Data digunakan untuk keperluan administrasi acara</p>
                </div>
            </div>
        </footer>
    </div>
    
    <script>
        // Animasi untuk stat cards
        const statCards = document.querySelectorAll('.stat-card');
        statCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
        
        // Highlight row on hover
        const tableRows = document.querySelectorAll('.table-row');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.backgroundColor = 'rgba(102, 126, 234, 0.05)';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '';
            });
        });
    </script>
</body>
</html>
<?php
// Tutup koneksi database
mysqli_close($conn);
?>