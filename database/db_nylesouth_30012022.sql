/*
 Navicat Premium Data Transfer

 Source Server         : localhost mysql
 Source Server Type    : MySQL
 Source Server Version : 100137
 Source Host           : localhost:3306
 Source Schema         : db_nylesouth

 Target Server Type    : MySQL
 Target Server Version : 100137
 File Encoding         : 65001

 Date: 30/01/2022 22:35:12
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for data_admin
-- ----------------------------
DROP TABLE IF EXISTS `data_admin`;
CREATE TABLE `data_admin`  (
  `kode_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_lengkap` char(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email_admin` char(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password_admin` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status_admin` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`kode_admin`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for data_ekspedisi
-- ----------------------------
DROP TABLE IF EXISTS `data_ekspedisi`;
CREATE TABLE `data_ekspedisi`  (
  `kode_ekspedisi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_ekspedisi` char(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`kode_ekspedisi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for data_pembayaran
-- ----------------------------
DROP TABLE IF EXISTS `data_pembayaran`;
CREATE TABLE `data_pembayaran`  (
  `kode_pembayaran` int(11) NOT NULL AUTO_INCREMENT,
  `kode_trx_pemesanan` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode_pelanggan` int(11) NOT NULL,
  `transfer_atas_nama` char(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `status_bayar` char(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pembayaran_foto_folder_path` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`kode_pembayaran`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for data_pemesanan
-- ----------------------------
DROP TABLE IF EXISTS `data_pemesanan`;
CREATE TABLE `data_pemesanan`  (
  `kode_trx_pemesanan` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode_pelanggan` int(11) NOT NULL,
  `kode_produk` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_pesan` datetime(0) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` double NOT NULL,
  `status_pemesanan` char(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `notes` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `kurir` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `sub_total` double NULL DEFAULT NULL,
  `biaya_kirim` double NULL DEFAULT NULL,
  `id_detail_produk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `status_retur` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for data_pengiriman
-- ----------------------------
DROP TABLE IF EXISTS `data_pengiriman`;
CREATE TABLE `data_pengiriman`  (
  `kode_pengiriman` bigint(30) NOT NULL AUTO_INCREMENT,
  `kode_trx_pemesanan` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode_provinsi` int(11) NULL DEFAULT NULL,
  `kurir` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nomor_resi` char(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_penerima` char(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_hp_penerima` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat_kirim` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `biaya_kirim` double NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `status_pengiriman` smallint(6) NULL DEFAULT NULL,
  `tanggal_kirim` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`kode_pengiriman`) USING BTREE,
  INDEX `kode_trx_pemesanan`(`kode_trx_pemesanan`) USING BTREE,
  INDEX `kode_ekspedisi`(`kurir`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for data_retur
-- ----------------------------
DROP TABLE IF EXISTS `data_retur`;
CREATE TABLE `data_retur`  (
  `kode_retur` int(11) NOT NULL AUTO_INCREMENT,
  `kode_trx_pemesanan` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kode_pelanggan` int(11) NOT NULL,
  `alasan_retur` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status_retur` char(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `retur_foto_folder_path` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `kode_produk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kode_warna` int(11) NULL DEFAULT NULL,
  `kode_ukuran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jumlah` int(11) NULL DEFAULT NULL,
  `tanggal_retur` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`kode_retur`) USING BTREE,
  INDEX `kode_trx_pemesanan`(`kode_trx_pemesanan`) USING BTREE,
  INDEX `kode_pelanggan`(`kode_pelanggan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for keranjang_belanja
-- ----------------------------
DROP TABLE IF EXISTS `keranjang_belanja`;
CREATE TABLE `keranjang_belanja`  (
  `kode_keranjang` int(11) NOT NULL AUTO_INCREMENT,
  `kode_produk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode_ukuran` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kode_pelanggan` int(11) NOT NULL,
  `kode_warna` int(11) NULL DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `berat_barang` decimal(11, 2) NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `status_checkout` int(1) NULL DEFAULT NULL,
  PRIMARY KEY (`kode_keranjang`) USING BTREE,
  INDEX `kode_produk`(`kode_produk`(191)) USING BTREE,
  INDEX `kode_pelanggan`(`kode_pelanggan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for master_kab_kota
-- ----------------------------
DROP TABLE IF EXISTS `master_kab_kota`;
CREATE TABLE `master_kab_kota`  (
  `id` int(11) NOT NULL,
  `id_provinsi` int(11) NULL DEFAULT NULL,
  `kab_kota` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `deleted_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL,
  `status_active` int(11) NULL DEFAULT NULL,
  `kode_pos` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_api` int(11) NULL DEFAULT NULL,
  `id_provinsi_api` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for master_kategori
-- ----------------------------
DROP TABLE IF EXISTS `master_kategori`;
CREATE TABLE `master_kategori`  (
  `kode_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` char(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`kode_kategori`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for master_kode_warna
-- ----------------------------
DROP TABLE IF EXISTS `master_kode_warna`;
CREATE TABLE `master_kode_warna`  (
  `kode_warna` int(11) NOT NULL AUTO_INCREMENT,
  `nama_warna` char(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`kode_warna`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for master_produk
-- ----------------------------
DROP TABLE IF EXISTS `master_produk`;
CREATE TABLE `master_produk`  (
  `initial_produk` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `kode_kategori` int(11) NOT NULL,
  `kode_admin` int(11) NULL DEFAULT NULL COMMENT '?',
  `nama_produk` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `harga_produk` decimal(12, 2) NOT NULL,
  `status_produk` int(11) NOT NULL DEFAULT 1,
  `created_by` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `updated_by` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `deskripsi_produk` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `berat_produk` decimal(20, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`initial_produk`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for master_produk_detail
-- ----------------------------
DROP TABLE IF EXISTS `master_produk_detail`;
CREATE TABLE `master_produk_detail`  (
  `id_detail_produk` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `initial_produk` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ukuran` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `warna` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_detail_produk`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for master_produk_inventori
-- ----------------------------
DROP TABLE IF EXISTS `master_produk_inventori`;
CREATE TABLE `master_produk_inventori`  (
  `id_produk_inventori` int(11) NOT NULL AUTO_INCREMENT,
  `initial_produk` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `in` decimal(6, 0) NULL DEFAULT NULL,
  `out` decimal(6, 0) NULL DEFAULT NULL,
  `stock` decimal(6, 0) NULL DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL,
  `deleted_at` timestamp(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id_produk_inventori`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for master_produk_picture
-- ----------------------------
DROP TABLE IF EXISTS `master_produk_picture`;
CREATE TABLE `master_produk_picture`  (
  `id_produk_picture` int(11) NOT NULL AUTO_INCREMENT,
  `initial_produk` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `path_file` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `nama_file` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL,
  `deleted_at` timestamp(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id_produk_picture`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for master_promo
-- ----------------------------
DROP TABLE IF EXISTS `master_promo`;
CREATE TABLE `master_promo`  (
  `id_promo` int(11) NOT NULL AUTO_INCREMENT,
  `potongan_harga` decimal(20, 2) NULL DEFAULT NULL,
  `kode_promo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL,
  `deleted_at` timestamp(6) NULL DEFAULT NULL,
  `tgl_mulai` date NULL DEFAULT NULL,
  `tgl_berakhir` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_promo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for master_provinsi
-- ----------------------------
DROP TABLE IF EXISTS `master_provinsi`;
CREATE TABLE `master_provinsi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_prov` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kode_provinsi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL,
  `deleted_at` timestamp(6) NULL DEFAULT NULL,
  `status_active` int(11) NULL DEFAULT NULL,
  `id_api` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 36 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for master_ukuran
-- ----------------------------
DROP TABLE IF EXISTS `master_ukuran`;
CREATE TABLE `master_ukuran`  (
  `kode_ukuran` int(11) NOT NULL AUTO_INCREMENT,
  `nama_ukuran` char(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`kode_ukuran`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `tipe_user` int(11) NULL DEFAULT NULL,
  `active` int(11) NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `no_hp` varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for users_pelanggan_detail
-- ----------------------------
DROP TABLE IF EXISTS `users_pelanggan_detail`;
CREATE TABLE `users_pelanggan_detail`  (
  `kode_pelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nama_lengkap_pelanggan` char(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `jenis_kelamin` int(11) NOT NULL DEFAULT 1,
  `tempat_lahir` char(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tanggal_lahir` datetime(0) NOT NULL,
  `alamat` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `no_hp` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` char(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` char(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pelanggan_foto_folder_path` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `deteled_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`kode_pelanggan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
