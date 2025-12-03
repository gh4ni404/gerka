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
            <th colspan="10" style="background: linear-gradient(to right, #ec268f, #f65566); color: white; font-size: 18px; padding: 12px;">
                DATA PENGGUNA GERKA 2025 - SMKN 8 BONE
            </th>
        </tr>
        <tr>
            <th style="background-color: #f9f9f9; padding: 8px;">No</th>
            <th style="background-color: #f9f9f9; padding: 8px;">Nama</th>
            <th style="background-color: #f9f9f9; padding: 8px;">Jenis Kelamin</th>
            <th style="background-color: #f9f9f9; padding: 8px;">Usia</th>
            <th style="background-color: #f9f9f9; padding: 8px;">Telepon</th>
            <th style="background-color: #f9f9f9; padding: 8px;">Alamat</th>
            <th style="background-color: #f9f9f9; padding: 8px;">Asal Instansi</th>
            <th style="background-color: #f9f9f9; padding: 8px;">Jenis Pengunjung</th>
            <th style="background-color: #f9f9f9; padding: 8px;">Waktu Kunjungan</th>
            <th style="background-color: #f9f9f9; padding: 8px;">Tanggal Daftar</th>
        </tr>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)):
            $jenis_kelamin = $row['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan';
        ?>
        <tr>
            <td style="padding: 6px;"><?php echo $no++; ?></td>
            <td style="padding: 6px;"><?php echo htmlspecialchars($row['nama']); ?></td>
            <td style="padding: 6px;"><?php echo $jenis_kelamin; ?></td>
            <td style="padding: 6px;"><?php echo $row['usia']; ?></td>
            <td style="padding: 6px;"><?php echo htmlspecialchars($row['no_telepon']); ?></td>
            <td style="padding: 6px;"><?php echo htmlspecialchars($row['alamat']); ?></td>
            <td style="padding: 6px;"><?php echo htmlspecialchars($row['asal_instansi']); ?></td>
            <td style="padding: 6px;"><?php echo ucfirst($row['jenis_pengunjung']); ?></td>
            <td style="padding: 6px;"><?php echo ucfirst($row['waktu_kunjungan']); ?></td>
            <td style="padding: 6px;"><?php echo date('d-m-Y H:i', strtotime($row['tanggal_daftar'])); ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
<?php
mysqli_close($conn);
exit();
?>