-- Buat database
CREATE DATABASE IF NOT EXISTS gerka_2025;
USE gerka_2025;

-- Buat tabel pengunjung
CREATE TABLE IF NOT EXISTS pengunjung (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nik VARCHAR(20) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('L', 'P') NOT NULL,
    usia INT NOT NULL,
    no_telepon VARCHAR(15) NOT NULL,
    alamat TEXT NOT NULL,
    asal_instansi VARCHAR(150) NOT NULL,
    jenis_pengunjung ENUM('siswa', 'guru', 'umum', 'alumni') NOT NULL,
    waktu_kunjungan ENUM('pagi', 'siang', 'sore') NOT NULL,
    setuju_data BOOLEAN DEFAULT FALSE,
    tanggal_daftar TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tambahkan indeks untuk pencarian
CREATE INDEX idx_nik ON pengunjung(nik);
CREATE INDEX idx_nama ON pengunjung(nama);
CREATE INDEX idx_no_telepon ON pengunjung(no_telepon);

-- Contoh data dummy (opsional)
INSERT INTO pengunjung (nik, nama, jenis_kelamin, usia, no_telepon, alamat, asal_instansi, jenis_pengunjung, waktu_kunjungan, setuju_data) VALUES
('7371123456789001', 'Ahmad Fauzi', 'L', 17, '081234567890', 'Jl. Pendidikan No. 12, Bone', 'SMKN 1 Bone', 'siswa', 'pagi', TRUE),
('7371987654321002', 'Siti Rahma', 'P', 35, '081298765432', 'Jl. Merdeka No. 45, Bone', 'SMPN 3 Bone', 'guru', 'siang', TRUE);