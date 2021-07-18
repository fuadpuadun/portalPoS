-- pos
CREATE DATABASE IF NOT EXISTS pos;
USE pos;

-- umkm
CREATE TABLE IF NOT EXISTS umkm(
  id_umkm MEDIUMINT(8)
    UNSIGNED
    ZEROFILL
    NOT NULL,
  email_umkm VARCHAR(254)
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci
    NOT NULL,
  password_umkm BINARY(32)
    NOT NULL,
  nama_umkm VARCHAR(120)
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci
    NOT NULL,
  notelp_umkm VARCHAR(15)
    CHARACTER SET ascii
    COLLATE ascii_bin
    NOT NULL,
  alamat_umkm TEXT
    CHARACTER SET ascii
    COLLATE ascii_bin
    NOT NULL,
  PRIMARY KEY(id_umkm)
) ENGINE = InnoDB;

-- umkm(email_umkm) index
CREATE OR REPLACE UNIQUE INDEX umkm_email_umkm_index
ON umkm(email_umkm);

-- umkm(notelp_umkm) index
CREATE OR REPLACE INDEX umkm_notelp_umkm_index
ON umkm(notelp_umkm);

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
