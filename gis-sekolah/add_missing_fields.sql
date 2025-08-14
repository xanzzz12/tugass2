-- Add missing fields to tbl_sekolah
ALTER TABLE `tbl_sekolah` 
ADD COLUMN IF NOT EXISTS `status_sekolah` VARCHAR(255) DEFAULT NULL AFTER `alamat`,
ADD COLUMN IF NOT EXISTS `kepala_sekolah` VARCHAR(255) DEFAULT NULL AFTER `status_sekolah`,
ADD COLUMN IF NOT EXISTS `ket` TEXT DEFAULT NULL AFTER `longitude`,
ADD COLUMN IF NOT EXISTS `total_siswa` INT(11) NOT NULL DEFAULT 0 AFTER `ket`,
ADD COLUMN IF NOT EXISTS `jumlah_guru_mapel` INT(11) DEFAULT 0 AFTER `total_siswa`,
ADD COLUMN IF NOT EXISTS `jumlah_guru` INT(11) DEFAULT 0 AFTER `jumlah_guru_mapel`;

-- Update existing records with default values
UPDATE `tbl_sekolah` SET 
    `status_sekolah` = 'Negeri',
    `kepala_sekolah` = 'Belum Diisi',
    `ket` = 'Data sekolah',
    `total_siswa` = 0,
    `jumlah_guru_mapel` = 0,
    `jumlah_guru` = 0
WHERE `status_sekolah` IS NULL;
