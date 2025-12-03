<?php
require_once 'koneksi.php';

// Query untuk mengambil data pengunjung
$sql = "SELECT * FROM pengunjung ORDER BY tanggal_daftar DESC";
$result = mysqli_query($conn, $sql);

// Set header untuk file Excel
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="data_pengunjung_gerka_2025.xls"');
header('Pragma: no-cache');
header('Expires: 0');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <table border="1">
        <tr>
            <th colspan="11" style="background-color: #4F81BD; color: white; font-size: 18px; padding: 10px;">
                DATA PENGGUNA GERKA 2025 - SMKN 8 BONE
            </th>
        </tr>
        <tr>
            <th>No</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Usia</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>Asal Instansi</th>
            <th>Jenis Pengunjung</th>
            <th>Waktu Kunjungan</th>
            <th>Tanggal Daftar</th>
        </tr>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)):
            $jenis_kelamin = $row['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan';
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo htmlspecialchars($row['nik']); ?></td>
            <td><?php echo htmlspecialchars($row['nama']); ?></td>
            <td><?php echo $jenis_kelamin; ?></td>
            <td><?php echo $row['usia']; ?></td>
            <td><?php echo htmlspecialchars($row['no_telepon']); ?></td>
            <td><?php echo htmlspecialchars($row['alamat']); ?></td>
            <td><?php echo htmlspecialchars($row['asal_instansi']); ?></td>
            <td><?php echo ucfirst($row['jenis_pengunjung']); ?></td>
            <td><?php echo ucfirst($row['waktu_kunjungan']); ?></td>
            <td><?php echo date('d-m-Y H:i', strtotime($row['tanggal_daftar'])); ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
<?php
mysqli_close($conn);
exit();
?>