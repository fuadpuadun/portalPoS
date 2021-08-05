-- pos
CREATE DATABASE IF NOT EXISTS pos;
USE pos;

-- umkm
CREATE TABLE IF NOT EXISTS umkm(
  id_umkm MEDIUMINT(8)
    UNSIGNED
    ZEROFILL
    NOT NULL,
  email VARCHAR(254)
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci
    NOT NULL,
  password VARCHAR(60)
    CHARACTER SET ascii
    COLLATE ascii_bin
    NOT NULL,
  nama_umkm VARCHAR(120)
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci
    NOT NULL,
  notelp VARCHAR(15)
    CHARACTER SET ascii
    COLLATE ascii_bin
    NOT NULL,
  alamat TEXT
    CHARACTER SET ascii
    COLLATE ascii_bin
    NOT NULL,
  PRIMARY KEY(id_umkm)
) ENGINE = InnoDB;

-- umkm(email) index
CREATE OR REPLACE UNIQUE INDEX umkm_email_index
ON umkm(email);

-- umkm(notelp) index
CREATE OR REPLACE INDEX umkm_notelp_index
ON umkm(notelp);

-- barang
CREATE TABLE IF NOT EXISTS barang(
  id_umkm MEDIUMINT(8)
    UNSIGNED
    ZEROFILL
    NOT NULL,
  nama_barang VARCHAR(120)
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci
    NOT NULL,
  harga_barang DECIMAL(11)
    UNSIGNED
    NULL,
  stok_barang SMALLINT
    UNSIGNED
    NULL,
  stok_minimal SMALLINT
    UNSIGNED
    NULL,
  CONSTRAINT barang_umkm_fk
    FOREIGN KEY(id_umkm)
    REFERENCES umkm(id_umkm)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  PRIMARY KEY(id_umkm, nama_barang)
) ENGINE = InnoDB;

-- transaksi
CREATE TABLE IF NOT EXISTS transaksi(
  id_transaksi BIGINT(20)
    ZEROFILL
    NOT NULL,
  id_umkm MEDIUMINT(8)
    UNSIGNED
    ZEROFILL
    NOT NULL,
  status_pembayaran BOOLEAN
    NULL,
  keterangan TEXT
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci
    NULL,
  tanggal_waktu_transaksi TIMESTAMP
    DEFAULT CURRENT_TIMESTAMP
    NOT NULL,
  CONSTRAINT transaksi_barang_fk
    FOREIGN KEY(id_umkm)
    REFERENCES barang(id_umkm)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  PRIMARY KEY(id_transaksi)
) ENGINE = InnoDB;

-- transaksi(id_umkm) index
CREATE OR REPLACE INDEX transaksi_id_umkm_index
ON transaksi(id_umkm);

-- transaksi(tanggal_waktu_transaksi) index
CREATE OR REPLACE INDEX transaksi_tanggal_waktu_transaksi_index
ON transaksi(tanggal_waktu_transaksi);

-- penjualan
CREATE TABLE IF NOT EXISTS penjualan(
  id_transaksi BIGINT(20)
    ZEROFILL
    NOT NULL,
  nama_barang VARCHAR(120)
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci
    NOT NULL,
  harga_barang DECIMAL(11)
    UNSIGNED
    NULL,
  jumlah_barang SMALLINT
    UNSIGNED
    NULL,
  CONSTRAINT penjualan_transaksi_fk
    FOREIGN KEY(id_transaksi)
    REFERENCES transaksi(id_transaksi)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  PRIMARY KEY(id_transaksi, nama_barang)
) ENGINE = InnoDB;

# dummy

INSERT INTO `umkm` (`id_umkm`, `email`, `password`, `nama_umkm`, `notelp`, `alamat`)
VALUES
(03508763, 'admin', '$2y$10$MKHpq5mJEHqFOKmludJI.OxbnR3RRE5IQGeWdTrzGdPPqYw1ArlMW', 'Toko Admin', '08001100999', 'Jl. Haji Raya No. 20, Bandung, 40999'),
(05246073, 'ikan', '$2y$10$2MaR/cajmVD/5b66kDSbeeiVzDLOVDdXns0SaRb37WGt9PLxsyRTS', 'Toko Ikan', '08001100888', 'Jl. Haji Raya No. 20, Bandung, 40888');

INSERT INTO `barang` (`id_umkm`, `nama_barang`, `harga_barang`, `stok_barang`, `stok_minimal`)
VALUES
(03508763, 'Jamur Penyembuh', '120000', 0, 7),
(03508763, 'Kulit Kelinci', '55000', 3, 3),
(03508763, 'Masker KF94', '2990', 25, 4),
(03508763, 'Masker KN95', '4999', 1298, 100),
(03508763, 'Pensil 2B', '7000', 120, 1),
(03508763, 'Windows 10 Pro', '3500000', 900, 17),
(03508763, 'Xiaomi Ear Buds 4.0', '395000', 17, 0);

INSERT INTO `transaksi` (`id_transaksi`, `id_umkm`, `status_pembayaran`, `keterangan`, `tanggal_waktu_transaksi`)
VALUES
(00000000000000639563, 03508763, 0, 'Oryzomys dimidiatus, also known as the Nicaraguan oryzomys, Thomas\'s rice rat, or the Nicaraguan rice rat, is a rodent in the genus Oryzomys of the family Cricetidae. It is known from only three specimens, all collected in southeastern Nicaragua (range pictured) since 1904.', '2021-07-25 10:53:10'),
(00000000000000639566, 03508763, 1, 'The Castle of St John the Baptist, also called the Black Castle, is a circular fort in Santa Cruz de Tenerife in the Canary Islands. It is located in the heart of the city, near the Parque Marítimo César Manrique and behind the Auditorio de Tenerife. Construction began in 1641 and was completed in 1644.', '2021-07-25 10:53:10');

INSERT INTO `penjualan` (`id_transaksi`, `nama_barang`, `harga_barang`, `jumlah_barang`)
VALUES
(00000000000000639563, 'Pensil 2B', '7000', 3),
(00000000000000639563, 'Kulit Kelinci', '55000', 2),
(00000000000000639566, 'Windows 10 Pro', '3500000', 46),
(00000000000000639566, 'Xiaomi Ear Buds 4.0', '395000', 46);