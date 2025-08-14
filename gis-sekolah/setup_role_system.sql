-- Tambahkan kolom role ke tabel tbl_user
ALTER TABLE `tbl_user` ADD `role` ENUM('admin','operator','user') NOT NULL DEFAULT 'user' AFTER `password`;

-- Insert data dummy users dengan role berbeda
INSERT INTO `tbl_user` (`nama_user`, `username`, `password`, `role`) VALUES
('Administrator', 'admin', 'admin123', 'admin'),
('Operator GIS', 'operator', 'operator123', 'operator'),
('User Biasa', 'user', 'user123', 'user');
