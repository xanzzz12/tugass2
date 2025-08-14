-- Insert dummy users into tbl_user
-- Admin user
INSERT INTO `tbl_user` (`id_user`, `nama_user`, `username`, `password`, `role`) VALUES
(1, 'Admin User', 'admin', 'admin123', 'admin');

-- Regular user
INSERT INTO `tbl_user` (`id_user`, `nama_user`, `username`, `password`, `role`) VALUES
(2, 'Regular User', 'user', 'user123', 'user');
