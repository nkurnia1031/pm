-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 26, 2020 at 11:28 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2020_june_pm`
--

-- --------------------------------------------------------

--
-- Table structure for table `bobot`
--

CREATE TABLE `bobot` (
  `idbobot` int(11) NOT NULL,
  `bobot` varchar(15) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bobot`
--

INSERT INTO `bobot` (`idbobot`, `bobot`, `nilai`) VALUES
(1, 'Kurang', 1),
(2, 'Cukup', 2),
(3, 'Baik', 3),
(4, 'Sangat Baik', 4);

-- --------------------------------------------------------

--
-- Table structure for table `faktor`
--

CREATE TABLE `faktor` (
  `idfaktor` int(11) NOT NULL,
  `faktor` varchar(10) NOT NULL,
  `persen` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faktor`
--

INSERT INTO `faktor` (`idfaktor`, `faktor`, `persen`) VALUES
(9, 'Core', 70),
(10, 'Secondary', 30);

-- --------------------------------------------------------

--
-- Table structure for table `gap`
--

CREATE TABLE `gap` (
  `idgap` int(11) NOT NULL,
  `gap` int(11) DEFAULT NULL,
  `bobot` float DEFAULT NULL,
  `ket` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gap`
--

INSERT INTO `gap` (`idgap`, `gap`, `bobot`, `ket`) VALUES
(2, 0, 5, 'Sesuai kebutuhan'),
(3, 1, 4.5, 'Kelebihan 1 Tingkat'),
(4, -1, 4, 'Kekurangan 1 Tingkat'),
(5, 2, 3.5, 'Kelebihan 2 Tingkat'),
(6, -2, 3, 'Kekurangan 2 Tingkat'),
(7, 3, 2.5, 'Kelebihan 3 Tingkat'),
(8, -3, 2, 'Kekurangan 3 Tingkat'),
(9, 4, 1.5, 'Kelebihan 4 Tingkat'),
(10, -4, 1, 'Kekurangan 4 Tingkat');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `idguru` int(11) NOT NULL COMMENT 'ID Guru',
  `nama` varchar(25) NOT NULL,
  `nip` varchar(15) DEFAULT NULL COMMENT 'NIP',
  `alamat` varchar(100) DEFAULT NULL COMMENT 'Alamat',
  `ttl` varchar(40) DEFAULT NULL COMMENT 'Tempat, Tanggal Lahir',
  `agama` varchar(15) DEFAULT NULL COMMENT 'Agama',
  `jk` varchar(10) DEFAULT NULL COMMENT 'Jenis Kelamin',
  `jabatan` varchar(50) DEFAULT NULL COMMENT 'Jabatan',
  `tgl_awal` date DEFAULT NULL COMMENT 'Tanggal Awal Mengajar',
  `nosk` varchar(25) DEFAULT NULL COMMENT 'No SK Mengajar'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`idguru`, `nama`, `nip`, `alamat`, `ttl`, `agama`, `jk`, `jabatan`, `tgl_awal`, `nosk`) VALUES
(1, 'AZURA', NULL, NULL, NULL, 'Islam', 'Perempuan', NULL, NULL, NULL),
(2, 'FAJAR NURYONO', NULL, NULL, NULL, 'Islam', 'Laki-Laki', NULL, NULL, NULL),
(3, 'MARIA ULFA', NULL, NULL, NULL, 'Islam', 'Laki-Laki', NULL, NULL, NULL),
(4, 'MUHAMMAD SALIM', NULL, NULL, NULL, 'Islam', 'Laki-Laki', NULL, NULL, NULL),
(5, 'SELVI DIANA', NULL, NULL, NULL, 'Islam', 'Laki-Laki', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `idhasil` int(11) NOT NULL,
  `thn` varchar(15) DEFAULT NULL,
  `hasiljson` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`idhasil`, `thn`, `hasiljson`) VALUES
(11, '2019', '[{\"idguru\":1,\"nama\":\"AZURA\",\"nip\":null,\"alamat\":null,\"ttl\":null,\"agama\":\"Islam\",\"jk\":\"Perempuan\",\"jabatan\":null,\"tgl_awal\":null,\"nosk\":null,\"kuisoner\":[],\"kuisoner2\":{\"idguru\":1},\"ncf\":2,\"nsf\":2,\"PEDAGOGIK\":2,\"KEPRIBADIAN\":2,\"SOSIAL\":2,\"PROFESIONAL\":2,\"nt\":2},{\"idguru\":2,\"nama\":\"FAJAR NURYONO\",\"nip\":null,\"alamat\":null,\"ttl\":null,\"agama\":\"Islam\",\"jk\":\"Laki-Laki\",\"jabatan\":null,\"tgl_awal\":null,\"nosk\":null,\"kuisoner\":[],\"kuisoner2\":{\"idguru\":2},\"ncf\":2,\"nsf\":2,\"PEDAGOGIK\":2,\"KEPRIBADIAN\":2,\"SOSIAL\":2,\"PROFESIONAL\":2,\"nt\":2},{\"idguru\":3,\"nama\":\"MARIA ULFA\",\"nip\":null,\"alamat\":null,\"ttl\":null,\"agama\":\"Islam\",\"jk\":\"Laki-Laki\",\"jabatan\":null,\"tgl_awal\":null,\"nosk\":null,\"kuisoner\":[],\"kuisoner2\":{\"idguru\":3},\"ncf\":2,\"nsf\":2,\"PEDAGOGIK\":2,\"KEPRIBADIAN\":2,\"SOSIAL\":2,\"PROFESIONAL\":2,\"nt\":2},{\"idguru\":4,\"nama\":\"MUHAMMAD SALIM\",\"nip\":null,\"alamat\":null,\"ttl\":null,\"agama\":\"Islam\",\"jk\":\"Laki-Laki\",\"jabatan\":null,\"tgl_awal\":null,\"nosk\":null,\"kuisoner\":[],\"kuisoner2\":{\"idguru\":4},\"ncf\":2,\"nsf\":2,\"PEDAGOGIK\":2,\"KEPRIBADIAN\":2,\"SOSIAL\":2,\"PROFESIONAL\":2,\"nt\":2},{\"idguru\":5,\"nama\":\"SELVI DIANA\",\"nip\":null,\"alamat\":null,\"ttl\":null,\"agama\":\"Islam\",\"jk\":\"Laki-Laki\",\"jabatan\":null,\"tgl_awal\":null,\"nosk\":null,\"kuisoner\":[],\"kuisoner2\":{\"idguru\":5},\"ncf\":2,\"nsf\":2,\"PEDAGOGIK\":2,\"KEPRIBADIAN\":2,\"SOSIAL\":2,\"PROFESIONAL\":2,\"nt\":2}]'),
(13, NULL, '[{\"idguru\":1,\"nama\":\"AZURA\",\"nip\":null,\"alamat\":null,\"ttl\":null,\"agama\":\"Islam\",\"jk\":\"Perempuan\",\"jabatan\":null,\"tgl_awal\":null,\"nosk\":null,\"kuisoner\":[],\"kuisoner2\":{\"idguru\":1},\"ncf\":2,\"nsf\":2,\"PEDAGOGIK\":2,\"KEPRIBADIAN\":2,\"SOSIAL\":2,\"PROFESIONAL\":2,\"nt\":2},{\"idguru\":2,\"nama\":\"FAJAR NURYONO\",\"nip\":null,\"alamat\":null,\"ttl\":null,\"agama\":\"Islam\",\"jk\":\"Laki-Laki\",\"jabatan\":null,\"tgl_awal\":null,\"nosk\":null,\"kuisoner\":[],\"kuisoner2\":{\"idguru\":2},\"ncf\":2,\"nsf\":2,\"PEDAGOGIK\":2,\"KEPRIBADIAN\":2,\"SOSIAL\":2,\"PROFESIONAL\":2,\"nt\":2},{\"idguru\":3,\"nama\":\"MARIA ULFA\",\"nip\":null,\"alamat\":null,\"ttl\":null,\"agama\":\"Islam\",\"jk\":\"Laki-Laki\",\"jabatan\":null,\"tgl_awal\":null,\"nosk\":null,\"kuisoner\":[],\"kuisoner2\":{\"idguru\":3},\"ncf\":2,\"nsf\":2,\"PEDAGOGIK\":2,\"KEPRIBADIAN\":2,\"SOSIAL\":2,\"PROFESIONAL\":2,\"nt\":2},{\"idguru\":4,\"nama\":\"MUHAMMAD SALIM\",\"nip\":null,\"alamat\":null,\"ttl\":null,\"agama\":\"Islam\",\"jk\":\"Laki-Laki\",\"jabatan\":null,\"tgl_awal\":null,\"nosk\":null,\"kuisoner\":[],\"kuisoner2\":{\"idguru\":4},\"ncf\":2,\"nsf\":2,\"PEDAGOGIK\":2,\"KEPRIBADIAN\":2,\"SOSIAL\":2,\"PROFESIONAL\":2,\"nt\":2},{\"idguru\":5,\"nama\":\"SELVI DIANA\",\"nip\":null,\"alamat\":null,\"ttl\":null,\"agama\":\"Islam\",\"jk\":\"Laki-Laki\",\"jabatan\":null,\"tgl_awal\":null,\"nosk\":null,\"kuisoner\":[],\"kuisoner2\":{\"idguru\":5},\"ncf\":2,\"nsf\":2,\"PEDAGOGIK\":2,\"KEPRIBADIAN\":2,\"SOSIAL\":2,\"PROFESIONAL\":2,\"nt\":2}]'),
(17, '2020', '[{\"idguru\":1,\"nama\":\"AZURA\",\"nip\":null,\"alamat\":null,\"ttl\":null,\"agama\":\"Islam\",\"jk\":\"Perempuan\",\"jabatan\":null,\"tgl_awal\":null,\"nosk\":null,\"kuisoner\":[{\"idkuisoner\":9,\"idguru\":1,\"nilai\":3,\"idkompetensi\":1,\"thn\":\"2020\"},{\"idkuisoner\":10,\"idguru\":1,\"nilai\":4,\"idkompetensi\":2,\"thn\":\"2020\"},{\"idkuisoner\":11,\"idguru\":1,\"nilai\":4,\"idkompetensi\":3,\"thn\":\"2020\"},{\"idkuisoner\":12,\"idguru\":1,\"nilai\":4,\"idkompetensi\":4,\"thn\":\"2020\"}],\"kuisoner2\":{\"idguru\":1},\"ncf\":4.75,\"nsf\":4.5,\"PEDAGOGIK\":5,\"KEPRIBADIAN\":4.5,\"SOSIAL\":4.5,\"PROFESIONAL\":4.5,\"nt\":4.675},{\"idguru\":2,\"nama\":\"FAJAR NURYONO\",\"nip\":null,\"alamat\":null,\"ttl\":null,\"agama\":\"Islam\",\"jk\":\"Laki-Laki\",\"jabatan\":null,\"tgl_awal\":null,\"nosk\":null,\"kuisoner\":{\"4\":{\"idkuisoner\":13,\"idguru\":2,\"nilai\":3,\"idkompetensi\":1,\"thn\":\"2020\"},\"5\":{\"idkuisoner\":14,\"idguru\":2,\"nilai\":3,\"idkompetensi\":2,\"thn\":\"2020\"},\"6\":{\"idkuisoner\":15,\"idguru\":2,\"nilai\":4,\"idkompetensi\":3,\"thn\":\"2020\"},\"7\":{\"idkuisoner\":16,\"idguru\":2,\"nilai\":3,\"idkompetensi\":4,\"thn\":\"2020\"}},\"kuisoner2\":{\"idguru\":2},\"ncf\":5,\"nsf\":4.75,\"PEDAGOGIK\":5,\"KEPRIBADIAN\":5,\"SOSIAL\":4.5,\"PROFESIONAL\":5,\"nt\":4.925},{\"idguru\":3,\"nama\":\"MARIA ULFA\",\"nip\":null,\"alamat\":null,\"ttl\":null,\"agama\":\"Islam\",\"jk\":\"Laki-Laki\",\"jabatan\":null,\"tgl_awal\":null,\"nosk\":null,\"kuisoner\":{\"8\":{\"idkuisoner\":17,\"idguru\":3,\"nilai\":4,\"idkompetensi\":1,\"thn\":\"2020\"},\"9\":{\"idkuisoner\":18,\"idguru\":3,\"nilai\":4,\"idkompetensi\":2,\"thn\":\"2020\"},\"10\":{\"idkuisoner\":19,\"idguru\":3,\"nilai\":4,\"idkompetensi\":3,\"thn\":\"2020\"},\"11\":{\"idkuisoner\":20,\"idguru\":3,\"nilai\":4,\"idkompetensi\":4,\"thn\":\"2020\"}},\"kuisoner2\":{\"idguru\":3},\"ncf\":4.5,\"nsf\":4.5,\"PEDAGOGIK\":4.5,\"KEPRIBADIAN\":4.5,\"SOSIAL\":4.5,\"PROFESIONAL\":4.5,\"nt\":4.5},{\"idguru\":4,\"nama\":\"MUHAMMAD SALIM\",\"nip\":null,\"alamat\":null,\"ttl\":null,\"agama\":\"Islam\",\"jk\":\"Laki-Laki\",\"jabatan\":null,\"tgl_awal\":null,\"nosk\":null,\"kuisoner\":{\"12\":{\"idkuisoner\":21,\"idguru\":4,\"nilai\":3,\"idkompetensi\":1,\"thn\":\"2020\"},\"13\":{\"idkuisoner\":22,\"idguru\":4,\"nilai\":3,\"idkompetensi\":2,\"thn\":\"2020\"},\"14\":{\"idkuisoner\":23,\"idguru\":4,\"nilai\":3,\"idkompetensi\":3,\"thn\":\"2020\"},\"15\":{\"idkuisoner\":24,\"idguru\":4,\"nilai\":4,\"idkompetensi\":4,\"thn\":\"2020\"}},\"kuisoner2\":{\"idguru\":4},\"ncf\":5,\"nsf\":4.75,\"PEDAGOGIK\":5,\"KEPRIBADIAN\":5,\"SOSIAL\":5,\"PROFESIONAL\":4.5,\"nt\":4.925},{\"idguru\":5,\"nama\":\"SELVI DIANA\",\"nip\":null,\"alamat\":null,\"ttl\":null,\"agama\":\"Islam\",\"jk\":\"Laki-Laki\",\"jabatan\":null,\"tgl_awal\":null,\"nosk\":null,\"kuisoner\":{\"16\":{\"idkuisoner\":25,\"idguru\":5,\"nilai\":3,\"idkompetensi\":1,\"thn\":\"2020\"},\"17\":{\"idkuisoner\":26,\"idguru\":5,\"nilai\":3,\"idkompetensi\":2,\"thn\":\"2020\"},\"18\":{\"idkuisoner\":27,\"idguru\":5,\"nilai\":3,\"idkompetensi\":3,\"thn\":\"2020\"},\"19\":{\"idkuisoner\":28,\"idguru\":5,\"nilai\":3,\"idkompetensi\":4,\"thn\":\"2020\"}},\"kuisoner2\":{\"idguru\":5},\"ncf\":5,\"nsf\":5,\"PEDAGOGIK\":5,\"KEPRIBADIAN\":5,\"SOSIAL\":5,\"PROFESIONAL\":5,\"nt\":5}]');

-- --------------------------------------------------------

--
-- Table structure for table `kompetensi`
--

CREATE TABLE `kompetensi` (
  `idkompetensi` int(11) NOT NULL,
  `kompetensi` varchar(25) DEFAULT NULL COMMENT 'Kompetensi',
  `nilai` int(11) NOT NULL COMMENT 'Nilai Standar',
  `kelompok` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kompetensi`
--

INSERT INTO `kompetensi` (`idkompetensi`, `kompetensi`, `nilai`, `kelompok`) VALUES
(1, 'PEDAGOGIK', 3, 'Core'),
(2, 'KEPRIBADIAN', 3, 'Core'),
(3, 'SOSIAL', 3, 'Secondary'),
(4, 'PROFESIONAL', 3, 'Secondary');

-- --------------------------------------------------------

--
-- Table structure for table `kuisoner`
--

CREATE TABLE `kuisoner` (
  `idkuisoner` int(11) NOT NULL,
  `idguru` int(11) DEFAULT NULL COMMENT 'ID Guru',
  `nilai` int(11) DEFAULT NULL COMMENT 'Nilai',
  `idkompetensi` int(11) DEFAULT NULL COMMENT 'Kompetensi',
  `thn` varchar(15) DEFAULT NULL COMMENT 'Tahun'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kuisoner`
--

INSERT INTO `kuisoner` (`idkuisoner`, `idguru`, `nilai`, `idkompetensi`, `thn`) VALUES
(9, 1, 3, 1, '2020'),
(10, 1, 4, 2, '2020'),
(11, 1, 4, 3, '2020'),
(12, 1, 4, 4, '2020'),
(13, 2, 3, 1, '2020'),
(14, 2, 3, 2, '2020'),
(15, 2, 4, 3, '2020'),
(16, 2, 3, 4, '2020'),
(17, 3, 4, 1, '2020'),
(18, 3, 4, 2, '2020'),
(19, 3, 4, 3, '2020'),
(20, 3, 4, 4, '2020'),
(21, 4, 3, 1, '2020'),
(22, 4, 3, 2, '2020'),
(23, 4, 3, 3, '2020'),
(24, 4, 4, 4, '2020'),
(25, 5, 3, 1, '2020'),
(26, 5, 3, 2, '2020'),
(27, 5, 3, 3, '2020'),
(28, 5, 3, 4, '2020');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user` varchar(10) NOT NULL COMMENT 'Username',
  `pass` varchar(10) DEFAULT NULL COMMENT 'Password',
  `nama` varchar(25) DEFAULT NULL COMMENT 'Nama Lengkap',
  `foto` text COMMENT 'Foto'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user`, `pass`, `nama`, `foto`) VALUES
('admin', 'admin', 'Nama Admin 2', '65S1cv6MwdE1fvrfD91TDFU8uaaUNL1KzzPndlOz.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bobot`
--
ALTER TABLE `bobot`
  ADD PRIMARY KEY (`idbobot`);

--
-- Indexes for table `faktor`
--
ALTER TABLE `faktor`
  ADD PRIMARY KEY (`idfaktor`);

--
-- Indexes for table `gap`
--
ALTER TABLE `gap`
  ADD PRIMARY KEY (`idgap`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`idguru`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`idhasil`);

--
-- Indexes for table `kompetensi`
--
ALTER TABLE `kompetensi`
  ADD PRIMARY KEY (`idkompetensi`);

--
-- Indexes for table `kuisoner`
--
ALTER TABLE `kuisoner`
  ADD PRIMARY KEY (`idkuisoner`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bobot`
--
ALTER TABLE `bobot`
  MODIFY `idbobot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `faktor`
--
ALTER TABLE `faktor`
  MODIFY `idfaktor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `gap`
--
ALTER TABLE `gap`
  MODIFY `idgap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `idguru` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID Guru', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `idhasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `kompetensi`
--
ALTER TABLE `kompetensi`
  MODIFY `idkompetensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kuisoner`
--
ALTER TABLE `kuisoner`
  MODIFY `idkuisoner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
