-- Insert dummy users into tbl_user (fix for duplicate ID)
-- Admin user
INSERT INTO `tbl_user` (`nama_user`, `username`, `password`, `role`) VALUES
('Admin User', 'admin', 'admin123', 'admin');

-- Regular user
INSERT INTO `tbl_user` (`nama_user`, `username`, `password`, `role`) VALUES
('Regular User', 'user', 'user123', 'user');
