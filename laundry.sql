-- Tabel tb_outlet
CREATE TABLE tb_outlet (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    alamat TEXT NOT NULL,
    tlp VARCHAR(15) NOT NULL
);

-- Tabel tb_user
CREATE TABLE tb_user (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    username VARCHAR(30) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    id_outlet INT(11),
    role ENUM('admin', 'kasir', 'owner') NOT NULL,
    FOREIGN KEY (id_outlet) REFERENCES tb_outlet(id) ON DELETE SET NULL
);

-- Tabel tb_member
CREATE TABLE tb_member (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    alamat TEXT NOT NULL,
    jenis_kelamin ENUM('L', 'P') NOT NULL,
    tlp VARCHAR(15) NOT NULL
    no_ktp VARCHAR(30) DEFAULT NULL
);

-- Tabel tb_paket
CREATE TABLE tb_paket (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    id_outlet INT(11),
    jenis ENUM('kiloan', 'selimut', 'bed_cover', 'kaos', 'lain') NOT NULL,
    nama_paket VARCHAR(100) NOT NULL,
    harga INT(11) NOT NULL,
    FOREIGN KEY (id_outlet) REFERENCES tb_outlet(id) ON DELETE CASCADE
);

-- Tabel tb_transaksi
CREATE TABLE tb_transaksi (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    id_outlet INT(11),
    kode_invoice VARCHAR(100) NOT NULL UNIQUE,
    id_member INT(11),
    tgl DATETIME NOT NULL,
    batas_waktu DATETIME NOT NULL,
    tgl_bayar DATETIME,
    biaya_tambahan INT(11) DEFAULT 0,
    diskon DOUBLE DEFAULT 0,
    pajak INT(11) DEFAULT 0,
    status ENUM('baru', 'proses', 'selesai', 'diambil') NOT NULL,
    dibayar ENUM('dibayar', 'belum_dibayar') NOT NULL,
    id_user INT(11),
    FOREIGN KEY (id_outlet) REFERENCES tb_outlet(id) ON DELETE CASCADE,
    FOREIGN KEY (id_member) REFERENCES tb_member(id) ON DELETE CASCADE,
    FOREIGN KEY (id_user) REFERENCES tb_user(id) ON DELETE CASCADE
);

-- Tabel tb_detail_transaksi
CREATE TABLE tb_detail_transaksi (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    id_transaksi INT(11),
    id_paket INT(11),
    qty DOUBLE NOT NULL,
    keterangan TEXT,
    total_bayar INT(11) DEFAULT NULL,
    FOREIGN KEY (id_transaksi) REFERENCES tb_transaksi(id) ON DELETE CASCADE,
    FOREIGN KEY (id_paket) REFERENCES tb_paket(id) ON DELETE CASCADE
);


-- Data dummy untuk tb_outlet
INSERT INTO tb_outlet (nama, alamat, tlp) VALUES
('Outlet A', 'Jalan Merdeka No.1', '081234567890'),
('Outlet B', 'Jalan Sudirman No.2', '081234567891');

-- Data dummy untuk tb_user
INSERT INTO tb_user (nama, username, password, id_outlet, role) VALUES
('Admin A', 'adminA', '$2y$10$c0AhxxopdFHlokk0aDcSXuTomN7bCb49c0.cAzGErPx/7oJB04UOS', 1, 'admin'),
('Kasir B', 'kasirB', '$2y$10$c0AhxxopdFHlokk0aDcSXuTomN7bCb49c0.cAzGErPx/7oJB04UOS', 1, 'kasir'),
('Muhammad Nasril Nufa', 'nasril', '$2y$10$c0AhxxopdFHlokk0aDcSXuTomN7bCb49c0.cAzGErPx/7oJB04UOS', 1, 'owner'),
('Kasir C', 'kasirC', '$2y$10$c0AhxxopdFHlokk0aDcSXuTomN7bCb49c0.cAzGErPx/7oJB04UOS', 2, 'kasir');

-- Data dummy untuk tb_member
INSERT INTO tb_member (nama, alamat, jenis_kelamin, tlp, no_ktp) VALUES
('Budi', 'Jalan Mawar No.3', 'L', '081345678901', '31740213456789712'),
('Siti', 'Jalan Melati No.4', 'P', '081345678902', '31740213456789713'),
('Ali', 'Jalan Anggrek No.5', 'L', '081345678903', '31740213456789714');

-- Data dummy untuk tb_paket
INSERT INTO tb_paket (id_outlet, jenis, nama_paket, harga) VALUES
(1, 'kiloan', 'Cuci Kiloan', 7000),
(1, 'selimut', 'Cuci Selimut', 20000),
(2, 'kaos', 'Cuci Kaos', 5000),
(2, 'lain', 'Cuci Sepatu', 15000);

-- Data dummy untuk tb_transaksi
INSERT INTO tb_transaksi (id_outlet, kode_invoice, id_member, tgl, batas_waktu, tgl_bayar, biaya_tambahan, diskon, pajak, status, dibayar, id_user) VALUES
(1, 'INV001', 1, '2025-01-01 10:00:00', '2025-01-03 10:00:00', '2025-01-03 12:00:00', 5000, 10.0, 2000, 'selesai', 'dibayar', 2),
(1, 'INV002', 2, '2025-01-02 11:00:00', '2025-01-04 11:00:00', NULL, 3000, 5.0, 1000, 'proses', 'belum_dibayar', 2),
(2, 'INV003', 3, '2025-01-03 12:00:00', '2025-01-05 12:00:00', NULL, 2000, 0.0, 500, 'baru', 'belum_dibayar', 4);

-- Data dummy untuk tb_detail_transaksi
INSERT INTO tb_detail_transaksi (id_transaksi, id_paket, qty, keterangan, total_bayar) VALUES
(1, 1, 2.5, 'Cuci pakaian sehari-hari', 15000),
(1, 2, 1, 'Cuci selimut ukuran besar', 20000),
(2, 3, 3, 'Cuci kaos olahraga', 15000),
(3, 4, 2, 'Cuci sepatu hiking', 15000);
