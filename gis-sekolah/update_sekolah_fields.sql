-- SQL script to add new fields to the sekolah table
-- Run this script in your MySQL database to add the required columns

USE gis_sekolah;

-- Add new columns to sekolah table
ALTER TABLE sekolah 
ADD COLUMN jumlah_guru_mapel INT(11) DEFAULT 0 AFTER longitude,
ADD COLUMN jumlah_guru INT(11) DEFAULT 0 AFTER jumlah_guru_mapel,
ADD COLUMN jumlah_siswa INT(11) DEFAULT 0 AFTER jumlah_guru,
ADD COLUMN kepala_sekolah VARCHAR(100) DEFAULT NULL AFTER jumlah_siswa,
ADD COLUMN status_sekolah ENUM('Negeri', 'Swasta') DEFAULT 'Negeri' AFTER kepala_sekolah;

-- Update existing records with default values
UPDATE sekolah SET 
jumlah_guru_mapel = 0,
jumlah_guru = 0,
jumlah_siswa = 0,
kepala_sekolah = 'Belum Diisi',
status_sekolah = 'Negeri'
WHERE jumlah_guru_mapel IS NULL;

-- Verify the changes
DESCRIBE sekolah;

-- Sample data update for testing
-- UPDATE sekolah SET 
-- jumlah_guru_mapel = 15,
-- jumlah_guru = 25,
-- jumlah_siswa = 300,
-- kepala_sekolah = 'Dr. Ahmad Santoso',
-- status_sekolah = 'Negeri'
-- WHERE id_sekolah = 1;
