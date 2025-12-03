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
                    <div class="bg-green-100 text-green-800 px-4 py-2 rounded-lg">
                        <i class="fas fa-male mr-2"></i> Laki-laki: <?php echo $stats['laki_laki']; ?>
                    </div>
                    <div class="bg-pink-100 text-pink-800 px-4 py-2 rounded-lg">
                        <i class="fas fa-female mr-2"></i> Perempuan: <?php echo $stats['perempuan']; ?>
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Statistik -->
        <div class="max-w-6xl mx-auto mb-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-users text-blue-500 mr-2"></i> Jenis Pengunjung
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Siswa</span>
                        <span class="font-bold text-blue-600"><?php echo $stats['siswa']; ?> orang</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Guru</span>
                        <span class="font-bold text-green-600"><?php echo $stats['guru']; ?> orang</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Umum</span>
                        <span class="font-bold text-yellow-600"><?php echo $stats['umum']; ?> orang</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Alumni</span>
                        <span class="font-bold text-purple-600"><?php echo $stats['alumni']; ?> orang</span>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-clock text-blue-500 mr-2"></i> Waktu Kunjungan
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Pagi (08:00-11:00)</span>
                        <span class="font-bold text-yellow-600"><?php echo $stats['pagi']; ?> orang</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Siang (11:00-14:00)</span>
                        <span class="font-bold text-orange-600"><?php echo $stats['siang']; ?> orang</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Sore (14:00-17:00)</span>
                        <span class="font-bold text-red-600"><?php echo $stats['sore']; ?> orang</span>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-chart-pie text-blue-500 mr-2"></i> Distribusi Usia
                </h3>
                <?php
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
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Anak/Remaja (<18)</span>
                        <span class="font-bold text-green-600"><?php echo $usia_stats['anak_remaja']; ?> orang</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Dewasa Muda (18-35)</span>
                        <span class="font-bold text-blue-600"><?php echo $usia_stats['dewasa_muda']; ?> orang</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Dewasa (36-55)</span>
                        <span class="font-bold text-purple-600"><?php echo $usia_stats['dewasa']; ?> orang</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Lansia (>55)</span>
                        <span class="font-bold text-gray-600"><?php echo $usia_stats['lansia']; ?> orang</span>
                    </div>
                </div>
            </div>
        </div>
        
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
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIK</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">JK</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usia</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telepon</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Asal Instansi</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
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
                                
                                // Warna badge waktu kunjungan
                                $waktu_color = [
                                    'pagi' => 'bg-yellow-100 text-yellow-800',
                                    'siang' => 'bg-orange-100 text-orange-800',
                                    'sore' => 'bg-red-100 text-red-800'
                                ][$row['waktu_kunjungan']];
                                
                                // Format tanggal
                                $tanggal = date('d-m-Y H:i', strtotime($row['tanggal_daftar']));
                            ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo $no++; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-500"><?php echo htmlspecialchars($row['nik']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo htmlspecialchars($row['nama']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo $row['jenis_kelamin'] == 'L' ? 'L' : 'P'; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $row['usia']; ?> thn</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($row['no_telepon']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 max-w-xs truncate"><?php echo htmlspecialchars($row['asal_instansi']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-medium rounded-full <?php echo $badge_color; ?>">
                                        <?php echo ucfirst($row['jenis_pengunjung']); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-medium rounded-full <?php echo $waktu_color; ?>">
                                        <?php echo ucfirst($row['waktu_kunjungan']); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $tanggal; ?></td>
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
        <?php if ($total_pengunjung > 0): ?>
        <div class="max-w-6xl mx-auto mt-6 text-right">
            <a href="#" onclick="window.print()" class="inline-flex items-center px-5 py-2.5 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition mr-3">
                <i class="fas fa-print mr-2"></i> Cetak Laporan
            </a>
            <a href="export.php" class="inline-flex items-center px-5 py-2.5 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition">
                <i class="fas fa-file-excel mr-2"></i> Export Excel
            </a>
        </div>
        <?php endif; ?>
        
        <!-- Footer -->
        <footer class="mt-12 text-center text-gray-600 text-sm">
            <div class="bg-blue-50 p-4 rounded-lg mb-4 max-w-6xl mx-auto">
                <h4 class="font-bold text-blue-800 mb-2">Kebijakan Privasi Data</h4>
                <p class="text-blue-700 text-sm">
                    Data pengunjung yang dikumpulkan melalui form ini hanya digunakan untuk keperluan administrasi dan evaluasi acara GERKA 2025 SMKN 8 Bone. Data tidak akan disebarluaskan atau digunakan untuk keperluan komersial.
                </p>
            </div>
            <p>© 2025 GERKA - Gelar Karya SMKN 8 Bone. Data diperbarui secara real-time.</p>
            <p>Sistem Registrasi Pengunjung v2.0 | Validasi NIK untuk mencegah duplikasi</p>
        </footer>
    </div>
</body>
</html>
<?php
// Tutup koneksi database
mysqli_close($conn);
?>