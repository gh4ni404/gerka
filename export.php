<?php
require_once 'koneksi.php';

// Query untuk mengambil data pengunjung
$sql = "SELECT * FROM pengunjung ORDER BY hari_tanggal DESC, waktu_masuk DESC";
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
    <style>
        table { border-collapse: collapse; width: 100%; }
        th { background-color: #4F81BD; color: white; font-weight: bold; }
        td, th { border: 1px solid #ddd; padding: 8px; }
        tr:nth-child(even) { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <table>
        <tr>
            <th colspan="9" style="background-color: #4F81BD; color: white; font-size: 18px; padding: 10px;">
                DATA PENGGUNA GERKA 2025 - SMKN 8 BONE
            </th>
        </tr>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Usia</th>
            <th>Alamat</th>
            <th>Telepon</th>
            <th>Tujuan Kunjungan</th>
            <th>Hari/Tanggal</th>
            <th>Waktu Masuk</th>
        </tr>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)):
            $jenis_kelamin = $row['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan';
            $hari_tanggal = date('d-m-Y', strtotime($row['hari_tanggal']));
            $waktu_masuk = date('H:i', strtotime($row['waktu_masuk']));
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo htmlspecialchars($row['nama']); ?></td>
            <td><?php echo $jenis_kelamin; ?></td>
            <td><?php echo htmlspecialchars($row['usia']); ?></td>
            <td><?php echo htmlspecialchars($row['alamat']); ?></td>
            <td><?php echo htmlspecialchars($row['no_telepon']); ?></td>
            <td><?php echo htmlspecialchars($row['tujuan_kunjungan']); ?></td>
            <td><?php echo $hari_tanggal; ?></td>
            <td><?php echo $waktu_masuk; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
<?php
mysqli_close($conn);
exit();
?>