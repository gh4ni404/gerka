-- Buat database
CREATE DATABASE IF NOT EXISTS smknbone_gerka;
USE smknbone_gerka;

-- Buat tabel pengunjung
CREATE TABLE IF NOT EXISTS pengunjung (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    no_telepon VARCHAR(15) NOT NULL,
    asal_instansi VARCHAR(150) NOT NULL,
    jenis_pengunjung ENUM('siswa', 'guru', 'umum', 'alumni') NOT NULL,
    tanggal_daftar TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tambahkan indeks untuk pencarian
CREATE INDEX idx_nama ON pengunjung(nama);
CREATE INDEX idx_email ON pengunjung(email);

-- Contoh data dummy (opsional)
INSERT INTO pengunjung (nama, email, no_telepon, asal_instansi, jenis_pengunjung) VALUES
('Ahmad Fauzi', 'ahmad@example.com', '081234567890', 'SMKN 1 Bone', 'siswa'),
('Budi Santoso', 'budi@example.com', '081298765432', 'SMAN 2 Bone', 'guru');