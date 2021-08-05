-- pos
DROP DATABASE IF EXISTS pos;
CREATE DATABASE IF NOT EXISTS pos;
USE pos;

-- umkm
CREATE TABLE IF NOT EXISTS umkm(
  id_umkm MEDIUMINT(8)
    UNSIGNED
    NOT NULL,
  email VARCHAR(254)
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci
    NOT NULL,
  password CHAR(60)
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
    UNSIGNED
    NOT NULL,
  id_umkm MEDIUMINT(8)
    UNSIGNED
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
    UNSIGNED
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

INSERT INTO umkm VALUES
(1825131, 'user', '$2y$10$iQt8UGwr0ic635y0JSRXhuiNvlVBJ4HUpnElIf3YT15fnsx.lH6E6', 'User', '08001100111', 'Jl. Haji Raya No. 20, Bandung, 40111'),
(10572391, 'admin', '$2y$10$cpG9O.D9vs9gBnheEXl1j.Od5nrWg2krA9sFmK6t/HuXmVkbfUqP.', 'Admin', '08001100000', 'Jl. Haji Raya No. 20, Bandung, 40000');

INSERT INTO barang VALUES
(10572391, 'Jamur Penyembuh', '120000', 0, 7),
(10572391, 'Kulit Kelinci', '55000', 3, 3),
(10572391, 'Masker KF94', '2990', 250, 4),
(10572391, 'Masker KN95', '4999', 1298, 100),
(10572391, 'Pensil 2B', '7000', 120, 1),
(10572391, 'Windows 10 Pro', '3500000', 900, 17),
(10572391, 'Xiaomi Ear Buds 4.0', '395000', 17, 0);

INSERT INTO transaksi VALUES
(18456678776, 10572391, 0, 'Oryzomys dimidiatus, also known as the Nicaraguan oryzomys, Thomas\'s rice rat, or the Nicaraguan rice rat, is a rodent in the genus Oryzomys of the family Cricetidae. It is known from only three specimens, all collected in southeastern Nicaragua (range pictured) since 1904.', '2021-07-25 12:58:32'),
(632277696543, 10572391, 1, 'The Castle of St John the Baptist, also called the Black Castle, is a circular fort in Santa Cruz de Tenerife in the Canary Islands. It is located in the heart of the city, near the Parque Marítimo César Manrique and behind the Auditorio de Tenerife. Construction began in 1641 and was completed in 1644.', '2021-07-25 10:53:10');

INSERT INTO penjualan VALUES
(18456678776, 'Pensil 2B', '7000', 3),
(18456678776, 'Kulit Kelinci', '55000', 2),
(632277696543, 'Windows 10 Pro', '3500000', 46),
(632277696543, 'Xiaomi Ear Buds 4.0', '395000', 46);
