<?php
require_once 'koneksi.php';

// Query untuk mengambil data pengunjung
$sql = "SELECT * FROM pengunjung ORDER BY hari_tanggal DESC, waktu_masuk DESC";
$result = mysqli_query($conn, $sql);

// Hitung total pengunjung
$total_pengunjung = mysqli_num_rows($result);

// Query untuk statistik
$sql_stats = "SELECT 
                COUNT(*) as total,
                SUM(CASE WHEN jenis_kelamin = 'L' THEN 1 ELSE 0 END) as laki_laki,
                SUM(CASE WHEN jenis_kelamin = 'P' THEN 1 ELSE 0 END) as perempuan,
                AVG(usia) as rata_usia,
                COUNT(DISTINCT DATE(hari_tanggal)) as hari_berbeda
              FROM pengunjung";
$result_stats = mysqli_query($conn, $sql_stats);
$stats = mysqli_fetch_assoc($result_stats);
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
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <header class="text-center mb-10">
            <div class="flex justify-center items-center mb-4">
                <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mr-4">
                    <i class="fas fa-users text-white text-2xl"></i>
                </div>
                <div class="text-left">
                    <h1 class="text-3xl font-bold text-blue-800">Daftar Pengunjung</h1>
                    <p class="text-lg text-gray-700">GERKA 2025 - SMKN 8 Bone</p>
                </div>
            </div>
            
            <div class="flex flex-col md:flex-row justify-between items-center max-w-6xl mx-auto mb-6 gap-4">
                <a href="index.php" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Form Registrasi
                </a>
                
                <div class="flex flex-wrap gap-4">
                    <div class="bg-blue-100 text-blue-800 px-4 py-2 rounded-lg font-bold">
                        <i class="fas fa-user-friends mr-2"></i> Total: <?php echo $total_pengunjung; ?> Pengunjung
                    </div>
                    <div class="bg-green-100 text-green-800 px-4 py-2 rounded-lg font-bold">
                        <i class="fas fa-calendar-alt mr-2"></i> <?php echo $stats['hari_berbeda']; ?> Hari
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Statistik -->
        <div class="max-w-6xl mx-auto mb-8 grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-male text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-800"><?php echo $stats['laki_laki']; ?></div>
                        <div class="text-gray-600 text-sm">Laki-laki</div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-pink-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-female text-pink-600 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-800"><?php echo $stats['perempuan']; ?></div>
                        <div class="text-gray-600 text-sm">Perempuan</div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-chart-line text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-800"><?php echo round($stats['rata_usia'], 1); ?></div>
                        <div class="text-gray-600 text-sm">Rata-rata Usia</div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-calendar-day text-purple-600 text-xl"></i>
                    </div>
                    <div>
                        <?php
                        $sql_today = "SELECT COUNT(*) as total_hari_ini FROM pengunjung WHERE hari_tanggal = CURDATE()";
                        $result_today = mysqli_query($conn, $sql_today);
                        $today = mysqli_fetch_assoc($result_today);
                        ?>
                        <div class="text-2xl font-bold text-gray-800"><?php echo $today['total_hari_ini']; ?></div>
                        <div class="text-gray-600 text-sm">Pengunjung Hari Ini</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Tabel Pengunjung -->
        <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-6 py-4">
                <h3 class="text-xl font-bold text-white">Data Pengunjung Terdaftar</h3>
                <p class="text-blue-100 text-sm">Data akan diperbarui secara real-time</p>
            </div>
            
            <?php if ($total_pengunjung > 0): ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Kelamin</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usia</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telepon</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tujuan Kunjungan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hari/Tanggal</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu Masuk</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php 
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($result)): 
                                // Tentukan label jenis kelamin
                                $jenis_kelamin = $row['jenis_kelamin'] == 'L' ? 
                                    '<span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">Laki-laki</span>' : 
                                    '<span class="px-2 py-1 text-xs font-medium rounded-full bg-pink-100 text-pink-800">Perempuan</span>';
                                
                                // Format tanggal
                                $hari_tanggal = date('d-m-Y', strtotime($row['hari_tanggal']));
                                $waktu_masuk = date('H:i', strtotime($row['waktu_masuk']));
                            ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo $no++; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo htmlspecialchars($row['nama']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo $jenis_kelamin; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($row['usia']); ?> thn</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($row['no_telepon']); ?></td>
                                <td class="px-6 py-4 text-sm text-gray-500 max-w-xs">
                                    <?php 
                                    $tujuan_array = explode(', ', $row['tujuan_kunjungan']);
                                    foreach ($tujuan_array as $tujuan) {
                                        echo '<span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded mr-1 mb-1">' . htmlspecialchars($tujuan) . '</span>';
                                    }
                                    ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $hari_tanggal; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $waktu_masuk; ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="p-12 text-center">
                    <div class="text-5xl text-gray-300 mb-4">
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-500 mb-2">Belum ada pengunjung terdaftar</h3>
                    <p class="text-gray-400 mb-6">Pengunjung yang mendaftar akan muncul di sini</p>
                    <a href="index.php" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-plus mr-2"></i> Daftarkan Pengunjung Pertama
                    </a>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Tombol Export -->
        <div class="max-w-6xl mx-auto text-right mb-8">
            <a href="#" onclick="window.print()" class="inline-flex items-center px-5 py-2.5 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition mr-3">
                <i class="fas fa-print mr-2"></i> Cetak
            </a>
            <a href="export.php" class="inline-flex items-center px-5 py-2.5 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition">
                <i class="fas fa-file-excel mr-2"></i> Export Excel
            </a>
        </div>
        
        <!-- Footer -->
        <footer class="mt-8 text-center text-gray-600 text-sm">
            <p class="mb-2">© 2025 GERKA - Gelar Karya SMKN 8 Bone. Data diperbarui secara real-time.</p>
            <p>Sistem Registrasi Pengunjung v2.0</p>
        </footer>
    </div>
</body>
</html>
<?php
// Tutup koneksi database
mysqli_close($conn);
?>