-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2020 at 01:27 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `rank`
--

CREATE TABLE `rank` (
  `id_rank` int(15) NOT NULL,
  `id_siswa` varchar(35) NOT NULL,
  `id_test` varchar(50) NOT NULL,
  `nilai_test` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `id_gelombang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rank`
--

INSERT INTO `rank` (`id_rank`, `id_siswa`, `id_test`, `nilai_test`, `tanggal`, `id_gelombang`) VALUES
(77, '2', '4', '79', '2020-03-17', '4'),
(78, '2', '5', '59', '2020-03-17', '4'),
(79, '2', '6', '90', '2020-03-17', '4'),
(80, '3', '4', '80', '2020-03-17', '4'),
(81, '3', '5', '34', '2020-03-17', '4'),
(82, '3', '6', '34', '2020-03-17', '4'),
(83, '5', '4', '90', '2020-03-18', '4'),
(84, '5', '5', '90', '2020-03-18', '4'),
(85, '5', '6', '98', '2020-03-18', '4'),
(86, '6', '4', '90', '2020-03-18', '4'),
(87, '6', '5', '80', '2020-03-18', '4'),
(88, '6', '6', '80', '2020-03-18', '4'),
(92, '8', '4', '95', '2020-03-20', '4'),
(93, '8', '5', '95', '2020-03-20', '4'),
(94, '8', '6', '95', '2020-03-20', '4'),
(95, '9', '4', '95', '2020-03-20', '4'),
(96, '9', '5', '90', '2020-03-20', '4'),
(97, '9', '6', '90', '2020-03-20', '4'),
(98, '10', '4', '100', '2020-03-23', '4'),
(99, '10', '5', '100', '2020-03-23', '4'),
(100, '10', '6', '100', '2020-03-23', '4'),
(101, '11', '4', '100', '2020-03-23', '4'),
(102, '11', '5', '100', '2020-03-23', '4'),
(103, '11', '6', '100', '2020-03-23', '4'),
(104, '12', '4', '70', '2020-04-28', '4'),
(105, '12', '5', '100', '2020-04-28', '4'),
(106, '12', '6', '100', '2020-04-28', '4'),
(107, '13', '4', '100', '2020-04-09', '4'),
(108, '13', '5', '100', '2020-04-09', '4'),
(109, '13', '6', '100', '2020-04-09', '4'),
(110, '14', '4', '100', '2020-04-12', '4'),
(111, '14', '5', '100', '2020-04-12', '4'),
(112, '14', '6', '100', '2020-04-12', '4'),
(113, '35', '4', '56', '2020-05-09', '4'),
(114, '35', '5', '56', '2020-05-09', '4'),
(115, '35', '6', '56', '2020-05-09', '4');

-- --------------------------------------------------------

--
-- Table structure for table `rn_admin`
--

CREATE TABLE `rn_admin` (
  `id_admin` int(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(110) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `level` enum('admin','operator') NOT NULL,
  `log` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rn_admin`
--

INSERT INTO `rn_admin` (`id_admin`, `username`, `password`, `email`, `nama`, `foto`, `level`, `log`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 'bakelok_jalan@gmail.com', 'ZAyed', 'foto_admin1584708765.jpg', 'admin', '2020-05-09 17:00:45'),
(2, 'user1', '202cb962ac59075b964b07152d234b70', 'goez@smpn1kwandang.sch.id', 'Zayed', 'foto_admin1534694266.jpg', 'operator', '2020-05-09 17:00:50');

-- --------------------------------------------------------

--
-- Table structure for table `rn_daftar`
--

CREATE TABLE `rn_daftar` (
  `id_pendaftaran` int(15) NOT NULL,
  `id_jurusan` varchar(30) NOT NULL,
  `no_pendaftaran` varchar(100) NOT NULL,
  `nama_pendaftar` varchar(100) NOT NULL,
  `jk` enum('P','L') NOT NULL,
  `nik` int(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `agama` varchar(100) NOT NULL,
  `nama_ayah` varchar(100) NOT NULL,
  `tahun_lahir_ayah` int(100) NOT NULL,
  `pekerjaan_ayah` varchar(100) NOT NULL,
  `pendidikan_ayah` varchar(100) NOT NULL,
  `penghasilan_ayah` varchar(100) NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `tahun_lahir_ibu` int(11) NOT NULL,
  `pekerjaan_ibu` varchar(100) NOT NULL,
  `pendidikan_ibu` varchar(100) NOT NULL,
  `penghasilan_ibu` varchar(100) NOT NULL,
  `nama_wali` varchar(100) NOT NULL,
  `tahun_lahir_wali` varchar(11) NOT NULL,
  `pekerjaan_wali` varchar(100) NOT NULL,
  `pendidikan_wali` varchar(100) NOT NULL,
  `penghasilan_wali` varchar(100) NOT NULL,
  `jenis_tinggal` varchar(100) NOT NULL,
  `rt` int(100) NOT NULL,
  `rw` int(100) NOT NULL,
  `desa_kelurahan` varchar(100) NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `kabupaten` varchar(100) NOT NULL,
  `provinsi` varchar(100) NOT NULL,
  `kode_pos` int(10) NOT NULL,
  `tinggi_badan` int(10) NOT NULL,
  `berat_badan` int(10) NOT NULL,
  `nomor_telp_rumah` int(10) NOT NULL,
  `no_telepon` varchar(17) NOT NULL,
  `jurusan` varchar(30) NOT NULL,
  `jarak_sekolah` int(10) NOT NULL,
  `alat_transportasi` varchar(100) NOT NULL,
  `prestasi` varchar(100) NOT NULL,
  `alamat_email` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `konfirmasi` enum('P','N','Y','') NOT NULL,
  `ta_akademik` varchar(110) NOT NULL,
  `sekolah_asal` varchar(100) NOT NULL,
  `alamat_sekolah_asal` text NOT NULL,
  `rapor_scan` varchar(100) NOT NULL,
  `ijazah_scan` varchar(100) NOT NULL,
  `kk_scan` varchar(100) NOT NULL,
  `akta_scan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rn_daftar`
--

INSERT INTO `rn_daftar` (`id_pendaftaran`, `id_jurusan`, `no_pendaftaran`, `nama_pendaftar`, `jk`, `nik`, `foto`, `tempat_lahir`, `tanggal_lahir`, `agama`, `nama_ayah`, `tahun_lahir_ayah`, `pekerjaan_ayah`, `pendidikan_ayah`, `penghasilan_ayah`, `nama_ibu`, `tahun_lahir_ibu`, `pekerjaan_ibu`, `pendidikan_ibu`, `penghasilan_ibu`, `nama_wali`, `tahun_lahir_wali`, `pekerjaan_wali`, `pendidikan_wali`, `penghasilan_wali`, `jenis_tinggal`, `rt`, `rw`, `desa_kelurahan`, `kecamatan`, `kabupaten`, `provinsi`, `kode_pos`, `tinggi_badan`, `berat_badan`, `nomor_telp_rumah`, `no_telepon`, `jurusan`, `jarak_sekolah`, `alat_transportasi`, `prestasi`, `alamat_email`, `tanggal`, `konfirmasi`, `ta_akademik`, `sekolah_asal`, `alamat_sekolah_asal`, `rapor_scan`, `ijazah_scan`, `kk_scan`, `akta_scan`) VALUES
(35, '3', 'PSB-09-1', 'sad', 'L', 0, '', 'dasda', '2020-05-20', 'Islam', 'adasdas', 2020, 'ad', 'asdad', 'adsasd', 'adadsasdsa', 1231, 'adsa', '1231', '1231', 'sada', 'ada', 'ds', 'dada', '23', '3', 1, 2, 'adadad', 'adasdsa', 'dasdsad', 'adasda', 2213, 0, 0, 0, 'sda', '', 0, 'adsa', 'ada', '', '2020-05-09', 'Y', '4', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `rn_informasi`
--

CREATE TABLE `rn_informasi` (
  `id_informasi` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `hits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rn_informasi`
--

INSERT INTO `rn_informasi` (`id_informasi`, `id_admin`, `judul`, `isi`, `gambar`, `tanggal`, `hits`) VALUES
(1, 1, 'adad', '<p>rem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur</p>\r\n\r\n<p> </p>\r\n\r\n<p>rem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur</p>\r\n\r\n<p>rem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur</p>\r\n', '1588959241.png', '2020-05-09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rn_jurusan`
--

CREATE TABLE `rn_jurusan` (
  `id_jurusan` int(14) NOT NULL,
  `nama_jurusan` varchar(100) DEFAULT NULL,
  `kode_jurusan` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rn_jurusan`
--

INSERT INTO `rn_jurusan` (`id_jurusan`, `nama_jurusan`, `kode_jurusan`) VALUES
(2, 'Teknik Informatikas', 'A341'),
(3, 'Pertanian', '324A');

-- --------------------------------------------------------

--
-- Table structure for table `rn_pdb`
--

CREATE TABLE `rn_pdb` (
  `id_gelombang` int(15) NOT NULL,
  `keterangan` enum('Y','N') NOT NULL,
  `ta_akademik` varchar(50) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `kuota` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rn_pdb`
--

INSERT INTO `rn_pdb` (`id_gelombang`, `keterangan`, `ta_akademik`, `tgl_mulai`, `tgl_selesai`, `kuota`) VALUES
(4, 'Y', '2020', '2020-03-02', '2020-05-31', '123');

-- --------------------------------------------------------

--
-- Table structure for table `rn_setting`
--

CREATE TABLE `rn_setting` (
  `parameter` varchar(100) NOT NULL,
  `nilai` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rn_setting`
--

INSERT INTO `rn_setting` (`parameter`, `nilai`) VALUES
('nama', '<p>SMPN 1 KWANDANG</p>\r\n'),
('judul', '<p>SMPN 1 KWANDANG</p>\r\n'),
('jalan', '<p>Jl. Siswa No.575, Cisadane, Kwandang, Gorontalo, 96252</p>\r\n'),
('description', '<p>Sekolah yang Terletak di Ibu Kota Kabupaten Gorontalo Utara</p>\r\n'),
('copyright', '<p>2019 - 2020</p>\r\n'),
('author', '<p>Operator Sekolah</p>\r\n'),
('favicon', '1584686425.png'),
('visi_misi', '<p>Kkkkk</p>\n'),
('telp', '044231019'),
('map_google', 'https://goo.gl/maps/ykGbtcufUDfmV2VX8'),
('cara_daftar', '<p>Langkah 2 Dalam Pendaftaran Siswa Baru  : </p>\r\n\r\n<p>1. Klik modul pendaftaran pada menu navbar  atau link http://ppdb.smpn1kwandang.sch.id/pendaftaran.jsp </p>\r\n\r\n<p>2. Isikan Biodata lengkap seperti yang ada pada form pendaftaran.</p>\r\n\r\n<p>3.Pastikan sebelum mensubmit form isian registrasi tidak ada salah satu isian yang kosong </p>\r\n\r\n<p>4.Apabila berhasil melakukan registrasi tahap awal silahkan menunggu konfirmasi penerimaan siswa baru dari pihak operator PSB</p>\r\n\r\n<p>5.Silahkan cek hasil pendaftaran pada modul cek kelulusan , apabila data PSB dengan nomor pendaftaran anda di terima     silahkan login untuk melengkapi file pas foto jika  tidak lulus silahkan mencoba mendaftar untuk lain waktu TIM IT   </p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `rn_slider`
--

CREATE TABLE `rn_slider` (
  `id_slider` int(11) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `id_admin` int(16) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rn_slider`
--

INSERT INTO `rn_slider` (`id_slider`, `gambar`, `keterangan`, `id_admin`, `tanggal`) VALUES
(3, 'slider1536910727.jpg', 'Kampus Ciyus', 1, '2018-10-09'),
(5, 'slider1536910753.png', 'What', 1, '2018-09-14'),
(6, 'slider1536911201.jpg', 'Universitas', 1, '2018-09-14'),
(10, 'slider1537118403.jpg', 'asdadad', 1, '2018-09-16'),
(11, 'slider1539195311.jpg', 'wa', 1, '2018-10-10');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id_test` int(15) NOT NULL,
  `nama_test` varchar(50) NOT NULL,
  `kkm` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `id_gelombang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id_test`, `nama_test`, `kkm`, `tanggal`, `id_gelombang`) VALUES
(1, 'B.indonesia', '70', '2019-07-19', '3'),
(2, 'Matematika', '70', '0000-00-00', '3'),
(3, 'B.Inggris', '70', '0000-00-00', '3'),
(4, 'Matematika', '75', '0000-00-00', '4'),
(5, 'Bahasa indonesia', '80', '0000-00-00', '4'),
(6, 'Ilmu Pengetahuan Alam', '80', '0000-00-00', '4');

-- --------------------------------------------------------

--
-- Table structure for table `tmverifikasi_rapor`
--

CREATE TABLE `tmverifikasi_rapor` (
  `id` int(10) NOT NULL,
  `mapel_uji` varchar(50) NOT NULL,
  `kkm` varchar(11) NOT NULL,
  `create_at` date NOT NULL,
  `user_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmverifikasi_rapor`
--

INSERT INTO `tmverifikasi_rapor` (`id`, `mapel_uji`, `kkm`, `create_at`, `user_id`) VALUES
(5, 'Matematika', '78', '2020-05-09', '1'),
(6, 'Sains', '78', '2020-05-09', '1'),
(7, 'java', '78', '2020-05-09', '1');

-- --------------------------------------------------------

--
-- Table structure for table `trverifikasirapor`
--

CREATE TABLE `trverifikasirapor` (
  `id` int(15) NOT NULL,
  `tmverifikasi_id` varchar(15) NOT NULL,
  `pendaftaran_id` varchar(10) NOT NULL,
  `nilai` varchar(15) NOT NULL,
  `date_create` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trverifikasirapor`
--

INSERT INTO `trverifikasirapor` (`id`, `tmverifikasi_id`, `pendaftaran_id`, `nilai`, `date_create`) VALUES
(34, '5', '35', '12', '0000-00-00'),
(35, '6', '35', '12', '0000-00-00'),
(36, '7', '35', '23', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rank`
--
ALTER TABLE `rank`
  ADD PRIMARY KEY (`id_rank`);

--
-- Indexes for table `rn_admin`
--
ALTER TABLE `rn_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `rn_daftar`
--
ALTER TABLE `rn_daftar`
  ADD PRIMARY KEY (`id_pendaftaran`);

--
-- Indexes for table `rn_informasi`
--
ALTER TABLE `rn_informasi`
  ADD PRIMARY KEY (`id_informasi`);

--
-- Indexes for table `rn_jurusan`
--
ALTER TABLE `rn_jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `rn_pdb`
--
ALTER TABLE `rn_pdb`
  ADD PRIMARY KEY (`id_gelombang`);

--
-- Indexes for table `rn_slider`
--
ALTER TABLE `rn_slider`
  ADD PRIMARY KEY (`id_slider`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id_test`);

--
-- Indexes for table `tmverifikasi_rapor`
--
ALTER TABLE `tmverifikasi_rapor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trverifikasirapor`
--
ALTER TABLE `trverifikasirapor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rank`
--
ALTER TABLE `rank`
  MODIFY `id_rank` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `rn_admin`
--
ALTER TABLE `rn_admin`
  MODIFY `id_admin` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rn_daftar`
--
ALTER TABLE `rn_daftar`
  MODIFY `id_pendaftaran` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `rn_informasi`
--
ALTER TABLE `rn_informasi`
  MODIFY `id_informasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rn_jurusan`
--
ALTER TABLE `rn_jurusan`
  MODIFY `id_jurusan` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rn_pdb`
--
ALTER TABLE `rn_pdb`
  MODIFY `id_gelombang` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rn_slider`
--
ALTER TABLE `rn_slider`
  MODIFY `id_slider` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id_test` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tmverifikasi_rapor`
--
ALTER TABLE `tmverifikasi_rapor`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `trverifikasirapor`
--
ALTER TABLE `trverifikasirapor`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
