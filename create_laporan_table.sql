CREATE TABLE IF NOT EXISTS tbl_laporan_wisata (
  id_laporan INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  judul_laporan VARCHAR(200) NOT NULL,
  keterangan_laporan LONGTEXT NULL,
  foto_laporan VARCHAR(255) NULL,
  status_laporan ENUM('VALID', 'VOID') NOT NULL DEFAULT 'VALID',
  picu_laporan INT NULL,
  created_at_laporan DATETIME NULL,
  updated_at_laporan DATETIME NULL
) DEFAULT CHARACTER SET utf8mb4 COLLATE 'utf8mb4_unicode_ci';
