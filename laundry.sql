-- Tabel outlet
CREATE TABLE outlet (
    id_outlet INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama_outlet VARCHAR(100) NOT NULL,
    alamat_outlet TEXT NOT NULL,
    telp_outlet VARCHAR(15) NOT NULL
);


-- Tabel user
CREATE TABLE user (
    id_user INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama_user VARCHAR(100) NOT NULL,
    username VARCHAR(30) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    outlet_id INT(11),
    role ENUM('admin', 'kasir', 'owner') NOT NULL,
    FOREIGN KEY (outlet_id) REFERENCES outlet(id_outlet) ON DELETE SET NULL
);



-- Tabel member
CREATE TABLE member (
    id_member INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama_member VARCHAR(100) NOT NULL,
    alamat_member TEXT NOT NULL,
    jenis_kelamin ENUM('L', 'P') NOT NULL,
    telp_member VARCHAR(15) NOT NULL,
    no_ktp VARCHAR(30) DEFAULT NULL
);



-- Tabel paket
CREATE TABLE paket (
    id_paket INT(11) AUTO_INCREMENT PRIMARY KEY,
    jenis_paket ENUM('kiloan', 'selimut', 'bed_cover', 'kaos', 'lain') NOT NULL,
    nama_paket VARCHAR(100) NOT NULL,
    harga INT(11) NOT NULL,
    outlet_id INT(11),
    FOREIGN KEY (outlet_id) REFERENCES outlet(id_outlet) ON DELETE CASCADE
);



-- Tabel transaksi
CREATE TABLE transaksi (
    id_transaksi INT(11) AUTO_INCREMENT PRIMARY KEY,
    outlet_id INT(11),
    kode_invoice VARCHAR(100) NOT NULL UNIQUE,
    member_id INT(11),
    tgl DATETIME NOT NULL,
    batas_waktu DATETIME NOT NULL,
    tgl_pembayaran DATETIME,
    biaya_tambahan INT(11) DEFAULT 0,
    diskon DOUBLE DEFAULT 0,
    pajak INT(11) DEFAULT 0,
    status ENUM('baru', 'proses', 'selesai', 'diambil') NOT NULL,
    status_bayar ENUM('dibayar', 'belum_dibayar') NOT NULL,
    user_id INT(11),
    FOREIGN KEY (outlet_id) REFERENCES outlet(id_outlet) ON DELETE CASCADE,
    FOREIGN KEY (member_id) REFERENCES member(id_member) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES user(id_user) ON DELETE CASCADE
);




-- Tabel detail_transaksi
CREATE TABLE detail_transaksi (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    transaksi_id INT(11),
    paket_id INT(11),
    qty DOUBLE NOT NULL,
    total_harga double DEFAULT NULL,
    keterangan TEXT,
    total_bayar INT(11) DEFAULT NULL,
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id_transaksi) ON DELETE CASCADE,
    FOREIGN KEY (paket_id) REFERENCES paket(id_paket) ON DELETE CASCADE
);

-- Data dummy untuk outlet
INSERT INTO outlet (nama_outlet, alamat_outlet, telp_outlet) VALUES
('Outlet A', 'Jalan Merdeka No.1', '081234567890'),
('Outlet B', 'Jalan Sudirman No.2', '081234567891');


-- Data dummy untuk user
INSERT INTO user (nama_user, username, password, outlet_id, role) VALUES
('Admin A', 'adminA', '21232f297a57a5a743894a0e4a801fc3', 1, 'admin'),
('Kasir B', 'kasirB', 'c7911af3adbd12a035b289556d96470a', 1, 'kasir'),
('Muhammad Nasril Nufa', 'nasril', '72122ce96bfec66e2396d2e25225d70a', 1, 'owner'),
('Kasir C', 'kasirC', 'c7911af3adbd12a035b289556d96470a', 2, 'kasir');

-- Data dummy untuk member
INSERT INTO member (nama_member, alamat_member, jenis_kelamin, telp_member, no_ktp) VALUES
('Budi', 'Jalan Mawar No.3', 'L', '081345678901', '31740213456789712'),
('Siti', 'Jalan Melati No.4', 'P', '081345678902', '31740213456789713'),
('Ali', 'Jalan Anggrek No.5', 'L', '081345678903', '31740213456789714');

-- Data dummy untuk paket
INSERT INTO paket (jenis_paket, nama_paket, harga, outlet_id) VALUES
( 'kiloan', 'Cuci Kiloan', 7000,1),
( 'selimut', 'Cuci Selimut', 20000,1),
( 'kaos', 'Cuci Kaos', 5000,2),
( 'lain', 'Cuci Sepatu', 15000,2);

-- Data dummy untuk transaksi
INSERT INTO transaksi (outlet_id, kode_invoice, member_id, tgl, batas_waktu, tgl_pembayaran, biaya_tambahan, diskon, pajak, status, status_bayar, user_id) VALUES
(1, 'INV001', 1, '2025-01-01 10:00:00', '2025-01-03 10:00:00', '2025-01-03 12:00:00', 5000, 10.0, 2000, 'selesai', 'dibayar', 2),
(1, 'INV002', 2, '2025-01-02 11:00:00', '2025-01-04 11:00:00', NULL, 3000, 5.0, 1000, 'proses', 'belum_dibayar', 2),
(2, 'INV003', 3, '2025-01-03 12:00:00', '2025-01-05 12:00:00', NULL, 2000, 0.0, 500, 'baru', 'belum_dibayar', 4);

-- Data dummy untuk detail_transaksi
INSERT INTO detail_transaksi (transaksi_id, paket_id, qty,total_harga, keterangan, total_bayar) VALUES
(1, 1, 2.5, 37500, 'Cuci pakaian sehari-hari', 15000),
(1, 2, 1,20000, 'Cuci selimut ukuran besar', 20000),
(2, 3, 3,45000, 'Cuci kaos olahraga', 15000),
(3, 4, 2,30000, 'Cuci sepatu hiking', 15000);
