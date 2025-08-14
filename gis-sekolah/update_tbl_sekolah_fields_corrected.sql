-- SQL script to add new fields to the tbl_sekolah table
-- Run this script in your MySQL database to add the required columns

USE `gis-sekolah`;

-- Add new columns to tbl_sekolah table
ALTER TABLE tbl_sekolah 
ADD COLUMN jumlah_guru_mapel INT(11) DEFAULT 0 AFTER longitude,
ADD COLUMN jumlah_guru INT(11) DEFAULT 0 AFTER jumlah_guru_mapel,
ADD COLUMN jumlah_siswa INT(11) DEFAULT 0 AFTER jumlah_guru,
ADD COLUMN kepala_sekolah VARCHAR(100) DEFAULT NULL AFTER jumlah_siswa,
ADD COLUMN status_sekolah ENUM('Negeri', 'Swasta') DEFAULT 'Negeri' AFTER kepala_sekolah;

-- Update existing records with default values
UPDATE tbl_sekolah SET 
jumlah_guru_mapel = 0,
jumlah_guru = 0,
jumlah_siswa = 0,
kepala_sekolah = 'Belum Diisi',
status_sekolah = 'Negeri'
WHERE jumlah_guru_mapel IS NULL;

-- Verify the changes
DESCRIBE tbl_sekolah;

-- Create tbl_jurusan table if it doesn't exist
CREATE TABLE IF NOT EXISTS tbl_jurusan (
    id_jurusan INT AUTO_INCREMENT PRIMARY KEY,
    id_sekolah INT NOT NULL,
    nama_jurusan VARCHAR(100) NOT NULL,
    FOREIGN KEY (id_sekolah) REFERENCES tbl_sekolah(id_sekolah) ON DELETE CASCADE
);

-- Create tbl_guru_mapel table if it doesn't exist
CREATE TABLE IF NOT EXISTS tbl_guru_mapel (
    id_guru_mapel INT AUTO_INCREMENT PRIMARY KEY,
    id_sekolah INT NOT NULL,
    nama_guru VARCHAR(100) NOT NULL,
    mata_pelajaran VARCHAR(100) NOT NULL,
    FOREIGN KEY (id_sekolah) REFERENCES tbl_sekolah(id_sekolah) ON DELETE CASCADE
);

-- Sample data for testing
INSERT INTO tbl_sekolah (nama_sekolah, alamat, latitude, longitude, jumlah_guru_mapel, jumlah_guru, jumlah_siswa, kepala_sekolah, status_sekolah) VALUES
('SMA Negeri 1 Jakarta', 'Jl. Sudirman No. 1, Jakarta', -6.2088, 106.8456, 15, 25, 300, 'Dr. Ahmad Santoso', 'Negeri'),
('SMA Swasta Bina Bangsa', 'Jl. Thamrin No. 10, Jakarta', -6.2000, 106.8167, 12, 20, 250, 'Dra. Siti Nurhaliza', 'Swasta'),
('SMK Negeri 2 Bandung', 'Jl. Asia Afrika No. 5, Bandung', -6.9175, 107.6191, 18, 30, 400, 'H. Ujang Suherman', 'Negeri');

-- Sample jurusan data
INSERT INTO tbl_jurusan (id_sekolah, nama_jurusan) VALUES
(1, 'IPA'),
(1, 'IPS'),
(2, 'IPA'),
(2, 'IPS'),
(2, 'Bahasa'),
(3, 'Teknik Komputer'),
(3, 'Akuntansi'),
(3, 'Administrasi Perkantoran');

-- Sample guru mapel data
INSERT INTO tbl_guru_mapel (id_sekolah, nama_guru, mata_pelajaran) VALUES
(1, 'Budi Santoso', 'Matematika'),
(1, 'Siti Aminah', 'Bahasa Indonesia'),
(1, 'Ahmad Fauzi', 'Bahasa Inggris'),
(2, 'Ratna Sari', 'Matematika'),
(2, 'Dedi Kurniawan', 'IPA'),
(3, 'Ujang Suhendar', 'Teknik Komputer'),
(3, 'Nina Marlina', 'Akuntansi');
