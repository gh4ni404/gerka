-- Buat database
CREATE DATABASE IF NOT EXISTS smknbone_gerka;
USE smknbone_gerka;

-- Buat tabel pengunjung
CREATE TABLE IF NOT EXISTS pengunjung (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('L', 'P') NOT NULL,
    usia INT NOT NULL,
    alamat TEXT NOT NULL,
    no_telepon VARCHAR(15) NOT NULL,
    tujuan_kunjungan TEXT NOT NULL,
    hari_tanggal DATE NOT NULL,
    waktu_masuk TIME NOT NULL,
    setuju TINYINT(1) NOT NULL DEFAULT 0,
    tanggal_daftar TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tambahkan indeks untuk pencarian
CREATE INDEX idx_nama ON pengunjung(nama);
CREATE INDEX idx_no_telepon ON pengunjung(no_telepon);

-- Contoh data dummy
INSERT INTO pengunjung (nama, jenis_kelamin, usia, alamat, no_telepon, tujuan_kunjungan, hari_tanggal, waktu_masuk, setuju) VALUES
('Ahmad Fauzi', 'L', 17, 'Jl. Merdeka No. 1, Bone', '081234567890', 'Melihat pameran, Membeli produk/karya', '2025-05-15', '09:00:00', 1),
('Budi Santoso', 'L', 35, 'Jl. Sudirman No. 45, Bone', '081298765432', 'Riset/penelitian', '2025-05-16', '10:30:00', 1);