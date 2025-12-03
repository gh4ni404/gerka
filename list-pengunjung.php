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

    <link rel="shortcut icon" href="assets/images/logo32.png" />
    <link rel="icon" href="assets/images/logo192.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="assets/images/logo180.png" sizes="180x180" />

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fef0f5 0%, #fff5f0 100%);
            min-height: 100vh;
        }

        .card-shadow {
            box-shadow: 0 10px 30px rgba(236, 38, 143, 0.1);
        }

        .stat-card {
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .table-row:hover {
            background-color: rgba(236, 38, 143, 0.05);
        }

        .btn-primary {
            background: linear-gradient(to right, #ec268f, #f65566);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 14px rgba(236, 38, 143, 0.3);
        }

        .btn-secondary {
            background: linear-gradient(to right, #f58634, #f76a53);
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 14px rgba(245, 134, 52, 0.3);
        }

        .gradient-primary {
            background: linear-gradient(to right, #ec268f, #f65566);
        }

        .text-gradient-primary {
            background: linear-gradient(to right, #ec268f, #f65566);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>

<body class="min-h-screen">
    <!-- Navbar -->
    <nav class="bg-neutral-primary border-default">
        <div class="flex flex-wrap items-center justify-between max-w-screen-xl mx-auto p-4">
            <a href="https://flowbite.com" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="assets/images/logo540.png" class="h-7" alt="Gerka Logo" />
                <span class="self-center text-xl font-semibold whitespace-nowrap text-heading">GERKA 2025</span>
            </a>
            <div class="flex items-center md:order-2 space-x-1 md:space-x-2 rtl:space-x-reverse">
                <a href="#" class="px-3 py-2 text-sm rounded-xl font-bold border" style="background: rgba(236, 38, 143, 0.1); border-color: rgba(236, 38, 143, 0.2); color: #ec268f;">
                    <i class="fas fa-user-friends mr-2"></i> Total: <?php echo $total_pengunjung; ?> Visitor
                </a>
                <a href="index.php" class="btn-primary text-white text-sm font-bold px-3 py-2 rounded-xl shadow-md hover:shadow-lg transition duration-300 inline-flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </div>
    </nav>
    <div class="container mx-auto px-2 py-2">
        <!-- Header -->
        <header class="text-center mb-5 bg-white rounded-2xl card-shadow p-8 max-w-8xl">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center mb-4 md:mb-0">
                    <div class="w-16 h-16 gradient-primary rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <div class="text-left">
                        <h1 class="text-3xl font-bold text-gray-800">Daftar Pengunjung</h1>
                        <p class="text-gray-700">GERKA 2025 - SMKN 8 Bone</p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Statistik Detail -->
        <div class="max-w-8xl mx-auto mb-5 grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="bg-white rounded-2xl card-shadow p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-users mr-3" style="color: #ec268f;"></i> Jenis Pengunjung
                </h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-3 h-3 rounded-full mr-3" style="background-color: #ec268f;"></div>
                            <span class="text-gray-700">Siswa</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-bold mr-2" style="color: #ec268f;"><?php echo $stats['siswa']; ?></span>
                            <span class="text-sm text-gray-500">orang</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-3 h-3 rounded-full mr-3" style="background-color: #f58634;"></div>
                            <span class="text-gray-700">Guru</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-bold mr-2" style="color: #f58634;"><?php echo $stats['guru']; ?></span>
                            <span class="text-sm text-gray-500">orang</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-3 h-3 rounded-full mr-3" style="background-color: #f65566;"></div>
                            <span class="text-gray-700">Umum</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-bold mr-2" style="color: #f65566;"><?php echo $stats['umum']; ?></span>
                            <span class="text-sm text-gray-500">orang</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-3 h-3 rounded-full mr-3" style="background-color: #f43c7f;"></div>
                            <span class="text-gray-700">Alumni</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-bold mr-2" style="color: #f43c7f;"><?php echo $stats['alumni']; ?></span>
                            <span class="text-sm text-gray-500">orang</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl card-shadow p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-clock mr-3" style="color: #f58634;"></i> Waktu Kunjungan
                </h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-3 h-3 rounded-full mr-3" style="background-color: #f58634;"></div>
                            <span class="text-gray-700">Pagi (08:00-11:00)</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-bold mr-2" style="color: #f58634;"><?php echo $stats['pagi']; ?></span>
                            <span class="text-sm text-gray-500">orang</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-3 h-3 rounded-full mr-3" style="background-color: #f65566;"></div>
                            <span class="text-gray-700">Siang (11:00-14:00)</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-bold mr-2" style="color: #f65566;"><?php echo $stats['siang']; ?></span>
                            <span class="text-sm text-gray-500">orang</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-3 h-3 rounded-full mr-3" style="background-color: #f43c7f;"></div>
                            <span class="text-gray-700">Sore (14:00-17:00)</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-bold mr-2" style="color: #f43c7f;"><?php echo $stats['sore']; ?></span>
                            <span class="text-sm text-gray-500">orang</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl card-shadow p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-chart-pie mr-3" style="color: #f76a53;"></i> Distribusi Usia
                </h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-3 h-3 rounded-full mr-3" style="background-color: #ec268f;"></div>
                            <span class="text-gray-700">Anak/Remaja (<18)< /span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-bold mr-2" style="color: #ec268f;"><?php echo $usia_stats['anak_remaja']; ?></span>
                            <span class="text-sm text-gray-500">orang</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-3 h-3 rounded-full mr-3" style="background-color: #f58634;"></div>
                            <span class="text-gray-700">Dewasa Muda (18-35)</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-bold mr-2" style="color: #f58634;"><?php echo $usia_stats['dewasa_muda']; ?></span>
                            <span class="text-sm text-gray-500">orang</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-3 h-3 rounded-full mr-3" style="background-color: #f65566;"></div>
                            <span class="text-gray-700">Dewasa (36-55)</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-bold mr-2" style="color: #f65566;"><?php echo $usia_stats['dewasa']; ?></span>
                            <span class="text-sm text-gray-500">orang</span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-3 h-3 rounded-full mr-3" style="background-color: #f43c7f;"></div>
                            <span class="text-gray-700">Lansia (>55)</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-bold mr-2" style="color: #f43c7f;"><?php echo $usia_stats['lansia']; ?></span>
                            <span class="text-sm text-gray-500">orang</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Pengunjung -->
        <div class="max-w-8xl mx-auto bg-white rounded-2xl card-shadow overflow-hidden mb-5">
            <div class="gradient-primary px-8 py-6">
                <h3 class="text-2xl font-bold text-white">Data Pengunjung Terdaftar</h3>
                <p class="text-pink-100 text-sm mt-1">Total <?php echo $total_pengunjung; ?> pengunjung telah mendaftar</p>
            </div>

            <?php if ($total_pengunjung > 0): ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-2 text-center text-sm font-bold text-gray-700 uppercase tracking-wider">No</th>
                                <th scope="col" class="px-4 py-2 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Nama</th>
                                <!-- <th scope="col" class="px-4 py-2 text-center text-sm font-bold text-gray-700 uppercase tracking-wider">JK</th>
                                <th scope="col" class="px-4 py-2 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Usia</th>
                                <th scope="col" class="px-4 py-2 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Telepon</th> -->
                                <th scope="col" class="px-4 py-2 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Asal Instansi</th>
                                <th scope="col" class="px-4 py-2 text-center text-sm font-bold text-gray-700 uppercase tracking-wider">Jenis</th>
                                <th scope="col" class="px-4 py-2 text-center text-sm font-bold text-gray-700 uppercase tracking-wider">Waktu</th>
                                <th scope="col" class="px-4 py-2 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">Tanggal Daftar</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($result)):
                                // Tentukan warna badge berdasarkan jenis pengunjung
                                $badge_styles = [
                                    'siswa' => 'background-color: rgba(236, 38, 143, 0.1); color: #ec268f; border-color: rgba(236, 38, 143, 0.2);',
                                    'guru' => 'background-color: rgba(245, 134, 52, 0.1); color: #f58634; border-color: rgba(245, 134, 52, 0.2);',
                                    'umum' => 'background-color: rgba(246, 85, 102, 0.1); color: #f65566; border-color: rgba(246, 85, 102, 0.2);',
                                    'alumni' => 'background-color: rgba(244, 60, 127, 0.1); color: #f43c7f; border-color: rgba(244, 60, 127, 0.2);'
                                ][$row['jenis_pengunjung']];

                                // Warna badge waktu kunjungan
                                $waktu_styles = [
                                    'pagi' => 'background-color: rgba(245, 134, 52, 0.1); color: #f58634; border-color: rgba(245, 134, 52, 0.2);',
                                    'siang' => 'background-color: rgba(246, 85, 102, 0.1); color: #f65566; border-color: rgba(246, 85, 102, 0.2);',
                                    'sore' => 'background-color: rgba(244, 60, 127, 0.1); color: #f43c7f; border-color: rgba(244, 60, 127, 0.2);'
                                ][$row['waktu_kunjungan']];

                                // Format tanggal
                                $tanggal = date('d-m-Y H:i', strtotime($row['tanggal_daftar']));
                            ?>
                                <tr class="table-row transition-colors duration-200">
                                    <td class="px-4 py-2 text-center whitespace-nowrap text-sm font-medium text-gray-900"><?php echo $no++; ?></td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm font-bold text-gray-900"><?php echo htmlspecialchars($row['nama']); ?></td>
                                    <!-- <td class="px-4 py-2 text-center whitespace-nowrap text-sm text-gray-700">
                                        <?php if ($row['jenis_kelamin'] == 'L'): ?>
                                            <span class="px-3 py-1 rounded-full text-xs font-medium" style="background-color: rgba(236, 38, 143, 0.1); color: #ec268f; border: 1px solid rgba(236, 38, 143, 0.2);">Laki-laki</span>
                                        <?php else: ?>
                                            <span class="px-3 py-1 rounded-full text-xs font-medium" style="background-color: rgba(245, 134, 52, 0.1); color: #f58634; border: 1px solid rgba(245, 134, 52, 0.2);">Perempuan</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700 font-medium"><?php echo $row['usia']; ?> thn</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700"><?php echo htmlspecialchars($row['no_telepon']); ?></td> -->
                                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700 max-w-xs"><?php echo htmlspecialchars($row['asal_instansi']); ?></td>
                                    <td class="px-4 py-2 text-center whitespace-nowrap">
                                        <span class="px-3 py-1 text-xs font-bold rounded-full border" style="<?php echo $badge_styles; ?>">
                                            <?php echo ucfirst($row['jenis_pengunjung']); ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 text-center whitespace-nowrap">
                                        <span class="px-3 py-1 text-xs font-bold rounded-full border" style="<?php echo $waktu_styles; ?>">
                                            <?php echo ucfirst($row['waktu_kunjungan']); ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-600"><?php echo $tanggal; ?></td>
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
                    <a href="index.php" class="btn-primary text-white font-bold px-8 py-4 rounded-xl shadow-lg hover:shadow-xl transition duration-300 inline-flex items-center">
                        <i class="fas fa-plus mr-3"></i> Daftarkan Pengunjung Pertama
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <!-- Tombol Export -->
        <?php if ($total_pengunjung > 0): ?>
            <div class="max-w-6xl mx-auto mb-10 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="text-gray-600">
                    <i class="fas fa-info-circle mr-2" style="color: #ec268f;"></i>
                    Data diperbarui secara real-time
                </div>
                <div class="flex gap-4">
                    <a href="export.php" class="btn-secondary text-white font-bold px-6 py-3 rounded-xl shadow-md hover:shadow-lg transition duration-300 inline-flex items-center">
                        <i class="fas fa-file-excel mr-2"></i> Export Excel
                    </a>
                </div>
            </div>
        <?php endif; ?>

        <!-- Footer -->
        <footer class="text-center text-gray-600">
            <div class="bg-white rounded-2xl card-shadow p-8 max-w-6xl mx-auto">
                <div class="mb-6">
                    <h4 class="text-xl font-bold mb-3 text-gradient-primary">GERKA 2025 - SMKN 8 Bone</h4>
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
                this.style.boxShadow = '0 15px 30px rgba(236, 38, 143, 0.15)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '';
            });
        });

        // Highlight row on hover
        const tableRows = document.querySelectorAll('.table-row');
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.backgroundColor = 'rgba(236, 38, 143, 0.05)';
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