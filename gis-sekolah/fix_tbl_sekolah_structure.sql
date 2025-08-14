-- SQL untuk memperbaiki struktur tabel tbl_sekolah
-- Menambahkan kolom-kolom yang diperlukan
-- Jalankan script ini di database gis-sekolah

USE `gis-sekolah`;

-- Tambahkan kolom-kolom baru ke tabel tbl_sekolah
ALTER TABLE `tbl_sekolah` 
ADD COLUMN IF NOT EXISTS `akreditasi` ENUM('A','B','C','Belum Terakreditasi') NULL AFTER `status_sekolah`,
ADD COLUMN IF NOT EXISTS `no_telepon` VARCHAR(20) NULL AFTER `akreditasi`,
ADD COLUMN IF NOT EXISTS `email` VARCHAR(100) NULL AFTER `no_telepon`,
ADD COLUMN IF NOT EXISTS `website` VARCHAR(255) NULL AFTER `email`,
ADD COLUMN IF NOT EXISTS `tahun_berdiri` YEAR NULL AFTER `website`,
ADD COLUMN IF NOT EXISTS `luas_tanah` DECIMAL(10,2) NULL AFTER `tahun_berdiri`,
ADD COLUMN IF NOT EXISTS `luas_bangunan` DECIMAL(10,2) NULL AFTER `luas_tanah`;

-- Hapus kolom id_jurusan jika masih ada (karena sekarang menggunakan relasi many-to-many)
ALTER TABLE `tbl_sekolah` DROP COLUMN IF EXISTS `id_jurusan`;

-- Tampilkan struktur tabel yang sudah diperbaiki
DESCRIBE `tbl_sekolah`;

SELECT 'Struktur tabel tbl_sekolah berhasil diperbaiki!' as status;
