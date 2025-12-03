<?php
require_once 'koneksi.php';

// Query untuk mengambil data pengunjung
$sql = "SELECT * FROM pengunjung ORDER BY tanggal_daftar DESC";
$result = mysqli_query($conn, $sql);

// Hitung total pengunjung
$total_pengunjung = mysqli_num_rows($result);
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
            
            <div class="flex justify-between items-center max-w-6xl mx-auto mb-6">
                <a href="index.php" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Form Registrasi
                </a>
                
                <div class="bg-blue-100 text-blue-800 px-4 py-2 rounded-lg font-bold">
                    <i class="fas fa-user-friends mr-2"></i> Total: <?php echo $total_pengunjung; ?> Pengunjung
                </div>
            </div>
        </header>
        
        <!-- Tabel Pengunjung -->
        <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
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
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telepon</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Asal Instansi</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Daftar</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php 
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($result)): 
                                // Tentukan warna badge berdasarkan jenis pengunjung
                                $badge_color = [
                                    'siswa' => 'bg-green-100 text-green-800',
                                    'guru' => 'bg-blue-100 text-blue-800',
                                    'umum' => 'bg-yellow-100 text-yellow-800',
                                    'alumni' => 'bg-purple-100 text-purple-800'
                                ][$row['jenis_pengunjung']];
                                
                                // Format tanggal
                                $tanggal = date('d-m-Y H:i', strtotime($row['tanggal_daftar']));
                            ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo $no++; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo htmlspecialchars($row['nama']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($row['email']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($row['no_telepon']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($row['asal_instansi']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-medium rounded-full <?php echo $badge_color; ?>">
                                        <?php echo ucfirst($row['jenis_pengunjung']); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $tanggal; ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Statistik -->
                <div class="p-6 bg-gray-50 border-t border-gray-200">
                    <h4 class="text-lg font-bold text-gray-800 mb-4">Statistik Pengunjung</h4>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <?php
                        // Query untuk statistik
                        $sql_stats = "SELECT jenis_pengunjung, COUNT(*) as jumlah FROM pengunjung GROUP BY jenis_pengunjung";
                        $result_stats = mysqli_query($conn, $sql_stats);
                        
                        $stats = [];
                        while ($row_stats = mysqli_fetch_assoc($result_stats)) {
                            $stats[$row_stats['jenis_pengunjung']] = $row_stats['jumlah'];
                        }
                        
                        $jenis_list = ['siswa', 'guru', 'umum', 'alumni'];
                        $colors = [
                            'siswa' => 'bg-green-500',
                            'guru' => 'bg-blue-500',
                            'umum' => 'bg-yellow-500',
                            'alumni' => 'bg-purple-500'
                        ];
                        
                        foreach ($jenis_list as $jenis):
                            $jumlah = isset($stats[$jenis]) ? $stats[$jenis] : 0;
                            $persentase = $total_pengunjung > 0 ? round(($jumlah / $total_pengunjung) * 100, 1) : 0;
                        ?>
                        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                            <div class="flex items-center justify-between mb-2">
                                <div class="text-sm font-medium text-gray-600"><?php echo ucfirst($jenis); ?></div>
                                <div class="w-3 h-3 rounded-full <?php echo $colors[$jenis]; ?>"></div>
                            </div>
                            <div class="text-2xl font-bold text-gray-800"><?php echo $jumlah; ?></div>
                            <div class="text-sm text-gray-500"><?php echo $persentase; ?>% dari total</div>
                        </div>
                        <?php endforeach; ?>
                    </div>
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
        
        <!-- Tombol Export (opsional untuk pengembangan) -->
        <?php if ($total_pengunjung > 0): ?>
        <div class="max-w-6xl mx-auto mt-6 text-right">
            <a href="#" onclick="window.print()" class="inline-flex items-center px-5 py-2.5 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition mr-3">
                <i class="fas fa-print mr-2"></i> Cetak
            </a>
            <a href="export.php" class="inline-flex items-center px-5 py-2.5 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition">
                <i class="fas fa-file-excel mr-2"></i> Export Excel
            </a>
        </div>
        <?php endif; ?>
        
        <!-- Footer -->
        <footer class="mt-12 text-center text-gray-600 text-sm">
            <p class="mb-2">© 2025 GERKA - Gelar Karya SMKN 8 Bone. Data diperbarui secara real-time.</p>
            <p>Sistem Registrasi Pengunjung v1.0</p>
        </footer>
    </div>
</body>
</html>
<?php
// Tutup koneksi database
mysqli_close($conn);
?>