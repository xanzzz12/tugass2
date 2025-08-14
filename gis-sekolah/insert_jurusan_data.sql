-- SQL untuk menambahkan data jurusan ke tabel tbl_jurusan
-- Jalankan script ini di database gis-sekolah

USE `gis-sekolah`;

-- Hapus data jurusan lama jika ada
TRUNCATE TABLE tbl_jurusan;

-- Ubah struktur tabel jurusan agar tidak terikat dengan id_sekolah
ALTER TABLE tbl_jurusan DROP FOREIGN KEY IF EXISTS tbl_jurusan_ibfk_1;
ALTER TABLE tbl_jurusan DROP COLUMN IF EXISTS id_sekolah;

-- Tambahkan data jurusan
INSERT INTO tbl_jurusan (nama_jurusan) VALUES
('Akuntansi dan Keuangan Lembaga'),
('Otomatisasi dan Tata Kelola Perkantoran'),
('Bisnis Daring dan Pemasaran'),
('Usaha Perjalanan Wisata'),
('Multimedia'),
('Teknik Komputer dan Jaringan'),
('Rekayasa Perangkat Lunak'),
('Desain Pemodelan dan Informasi Bangunan'),
('Bisnis Konstruksi dan Properti'),
('Teknik Geomatika'),
('Teknik Audio Video'),
('Teknik Instalasi Tenaga Listrik'),
('Teknik Pendinginan dan Tata Udara'),
('Teknik Pemesinan'),
('Teknik Mekanik Industri'),
('Teknik Pengelasan'),
('Teknik Kendaraan Ringan Otomotif'),
('Teknik Alat Berat'),
('Teknik Bisnis Sepeda Motor'),
('Tata Boga'),
('Tata Busana'),
('Tata Kecantikan Kulit dan Rambut'),
('Produksi dan Siaran Program Televisi'),
('Produksi Film'),
('Teknik Bodi Otomotif'),
('Teknik dan Bisnis Sepeda Motor'),
('Nautika Kapal Penangkap Ikan'),
('Teknika Kapal Penangkap Ikan'),
('Agribisnis Pengolahan Hasil Perikanan'),
('Kriya Kreatif Kayu & Rotan'),
('Kriya Kreatif Batik & Tekstil'),
('Seni Tari'),
('Desain Komunikasi Visual'),
('Seni Karawitan'),
('Animasi'),
('Agribisnis Pengolahan Hasil Pertanian'),
('Perhotelan');

-- Buat tabel relasi many-to-many antara sekolah dan jurusan
CREATE TABLE IF NOT EXISTS tbl_sekolah_jurusan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_sekolah INT NOT NULL,
    id_jurusan INT NOT NULL,
    FOREIGN KEY (id_sekolah) REFERENCES tbl_sekolah(id_sekolah) ON DELETE CASCADE,
    FOREIGN KEY (id_jurusan) REFERENCES tbl_jurusan(id_jurusan) ON DELETE CASCADE,
    UNIQUE KEY unique_sekolah_jurusan (id_sekolah, id_jurusan)
);

-- Hapus kolom id_jurusan dari tbl_sekolah karena sekarang menggunakan relasi many-to-many
ALTER TABLE tbl_sekolah DROP COLUMN IF EXISTS id_jurusan;

SELECT 'Data jurusan berhasil ditambahkan!' as status;
