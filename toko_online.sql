-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2021 at 08:06 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_administrasi`
--

CREATE TABLE `tb_administrasi` (
  `id` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `ktp` varchar(255) NOT NULL,
  `mou` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_administrasi`
--

INSERT INTO `tb_administrasi` (`id`, `id_invoice`, `ktp`, `mou`) VALUES
(1, 1, '1200px-Telkom_University_Logo_svg.png', ''),
(2, 2, 'resize-pas_1.jpg', 'Pedoman_Pelaksanaan_Magang_2016.pdf'),
(3, 3, 'resize-pas_11.jpg', '21_Surat_Pernyataan_Tidak_Bekerja_FGA_DTS2021-ditandatangani.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_brg` int(11) NOT NULL,
  `id_vendor` int(11) NOT NULL,
  `nama_brg` varchar(120) NOT NULL,
  `keterangan` varchar(225) NOT NULL,
  `kategori` varchar(60) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(4) NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id_brg`, `id_vendor`, `nama_brg`, `keterangan`, `kategori`, `harga`, `stok`, `gambar`) VALUES
(1, 1, 'Sound System', 'Ukuran Besar', 'Suara', 40000, 14, 'sound.jpg'),
(2, 1, 'Handy Talkie', 'HT Panitia', 'Suara', 10000, 38, 'ht.jpg'),
(4, 1, 'Microphone', 'Wireles', 'Suara', 5000, 14, 'mic.jpg'),
(5, 1, 'Lightning', 'Lightning RGB', 'Cahaya', 15000, 17, 'lightning.jpg'),
(7, 1, 'Proyektor', 'Proyektor', 'proyektor', 10000, 15, 'proyektor.jpg'),
(8, 1, 'Layar Proyektor', 'Layar Proyektor', 'proyektor', 8000, 17, 'layar.jpg'),
(9, 1, 'Sound System', 'Ukuran Sedang', 'Suara', 12000, 10, 'sound1.jpg'),
(10, 1, 'Panggung', 'Custom Panggung (harga per meter)', 'Panggung & Dekorasi', 12000, 99, 'panggung-besar-untuk-reuni-akbar-alumni-212_20171201_185555.jpg'),
(11, 1, 'Bunga Dekorasi', 'Harga per pot', 'Panggung & Dekorasi', 5000, 97, 'Ini-Dia-8-Toko-Tanaman-Lokal-untuk-Pecinta-Tanaman-Hias-3_49_20200625185232fCtoiT.jpg'),
(13, 1, 'Custom Dekorasi Panggung', 'Harga per proyek', 'Panggung & Dekorasi', 500000, 97, 'e9dae1b3109917e8277dea4d9d3f801a.jpg'),
(14, 1, 'Balon', 'ditiup dulu', 'Panggung & Dekorasi', 12000, 100, '1200px-Telkom_University_Logo_svg2.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_invoice`
--

CREATE TABLE `tb_invoice` (
  `id` int(11) NOT NULL,
  `nama` varchar(56) NOT NULL,
  `id_member` int(11) NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `tgl_pengiriman` date NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `tgl_pesan` datetime NOT NULL,
  `batas_bayar` datetime NOT NULL,
  `status` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_invoice`
--

INSERT INTO `tb_invoice` (`id`, `nama`, `id_member`, `alamat`, `tgl_pengiriman`, `tgl_pengembalian`, `tgl_pesan`, `batas_bayar`, `status`) VALUES
(1, 'Barong Sai', 2, 'Jl. Situmelingkar', '2021-06-23', '2021-06-25', '2021-06-23 17:18:36', '2021-06-24 17:18:36', 'Belum dikonfirmasi'),
(2, 'Haitsam', 1, 'Jl. Situmelingkar', '2021-09-23', '2021-09-25', '2021-07-13 11:32:52', '2021-07-14 11:32:52', 'Tersewa'),
(3, 'Eva Sofia', 1, 'Jl. Situmelingkar', '2021-07-13', '2021-07-23', '2021-07-13 12:53:58', '2021-07-14 12:53:58', 'Belum dikonfirmasi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_member`
--

CREATE TABLE `tb_member` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kartu_identitas` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_member`
--

INSERT INTO `tb_member` (`id`, `id_user`, `kartu_identitas`) VALUES
(1, 2, '1200px-Telkom_University_Logo_svg.png'),
(2, 19, '1200px-Telkom_University_Logo_svg1.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `id_rekening_tujuan` int(11) NOT NULL,
  `rekening_pengirim` varchar(128) NOT NULL,
  `bank_pengirim` varchar(100) NOT NULL,
  `nama_pengirim` varchar(128) NOT NULL,
  `waktu_transfer` datetime NOT NULL,
  `nominal_transfer` float(14,2) NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id`, `id_invoice`, `id_rekening_tujuan`, `rekening_pengirim`, `bank_pengirim`, `nama_pengirim`, `waktu_transfer`, `nominal_transfer`, `bukti_pembayaran`, `catatan`, `status`) VALUES
(7, 0, 2, '1203129039213', 'BNI', 'Hariadi Arfah', '2021-06-26 17:41:00', 190000.00, '1200px-Telkom_University_Logo_svg.png', 'thank you\r\n', 'Belum dikonfirmasi'),
(8, 2, 1, '1203129039213', 'BNI', 'Hariadi Arfah', '2021-07-13 11:38:00', 200000000.00, 'resize-pas_1.jpg', '1', 'Belum dikonfirmasi'),
(9, 3, 1, '1203129039213', 'BNI', 'Olga Paurenta', '2021-07-13 14:54:00', 9000000.00, 'Bukti_Pendaftaran.pdf', 'thank you', 'Belum dikonfirmasi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pesanan`
--

CREATE TABLE `tb_pesanan` (
  `id` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `id_brg` int(11) NOT NULL,
  `nama_brg` varchar(50) NOT NULL,
  `jumlah` int(3) NOT NULL,
  `harga` int(10) NOT NULL,
  `pilihan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pesanan`
--

INSERT INTO `tb_pesanan` (`id`, `id_invoice`, `id_brg`, `nama_brg`, `jumlah`, `harga`, `pilihan`) VALUES
(1, 1, 9, 'Sound System', 3, 12000, ''),
(2, 1, 4, 'Microphone', 1, 5000, ''),
(3, 2, 4, 'Microphone', 1, 5000, ''),
(4, 3, 4, 'Microphone', 3, 5000, ''),
(5, 3, 11, 'Bunga Dekorasi', 1, 5000, '');

--
-- Triggers `tb_pesanan`
--
DELIMITER $$
CREATE TRIGGER `pesanan_penyewaan` AFTER INSERT ON `tb_pesanan` FOR EACH ROW BEGIN
	UPDATE tb_barang SET stok = stok-NEW.jumlah
    WHERE id_brg = NEW.id_brg;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_rekening`
--

CREATE TABLE `tb_rekening` (
  `id` int(11) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `no_rekening` varchar(255) NOT NULL,
  `atas_nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_rekening`
--

INSERT INTO `tb_rekening` (`id`, `bank`, `no_rekening`, `atas_nama`, `email`) VALUES
(1, 'Mandiri', '1234567890', 'Muhammad Shibghotul \'Adalah', 'shibghotul7@gmail.com'),
(2, 'BNI', '0987654321', 'Ghena Patriani Salnia', 'ghenaps@gmail.com'),
(3, 'BCA', '123120491023', 'Olga Paurenta Simanimunkar', 'paurentasimainimunkar@gmail.com'),
(4, 'BRI', '0128102380912', 'Dora The Explorer', 'dorathe@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role_id` tinyint(1) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `username`, `alamat`, `password`, `role_id`, `is_active`) VALUES
(1, 'admin', 'admin', ':)', '123', 1, 1),
(2, 'member', 'member', ':)', '123', 2, 1),
(3, 'vendor', 'vendor', ':D', '123', 3, 1),
(18, 'Rondalowangdowang', 'bagongsay', 'Jl. Ketut Pertama Sari', '123', 2, 0),
(19, 'barongsai', 'barongsai', '123', '123', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_vendor`
--

CREATE TABLE `tb_vendor` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `bukti_surat_usaha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_vendor`
--

INSERT INTO `tb_vendor` (`id`, `id_user`, `bukti_surat_usaha`) VALUES
(1, 3, '1200px-Telkom_University_Logo_svg5.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_administrasi`
--
ALTER TABLE `tb_administrasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_brg`);

--
-- Indexes for table `tb_invoice`
--
ALTER TABLE `tb_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_member`
--
ALTER TABLE `tb_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_rekening`
--
ALTER TABLE `tb_rekening`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tb_vendor`
--
ALTER TABLE `tb_vendor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_administrasi`
--
ALTER TABLE `tb_administrasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_brg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_invoice`
--
ALTER TABLE `tb_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_member`
--
ALTER TABLE `tb_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_rekening`
--
ALTER TABLE `tb_rekening`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_vendor`
--
ALTER TABLE `tb_vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
