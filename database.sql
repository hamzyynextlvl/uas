-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2024 at 03:56 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `universitas`
--

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `nim` varchar(20) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `prodi` varchar(50) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`nim`, `nama`, `tgl_lahir`, `alamat`, `prodi`, `phone`) VALUES
('14022100027', 'Robiatuladawiyah', '2024-06-03', 'Seranggggaaaaa', 'Sistem Informasi', '089765356180'),
('5505', 'mahasiswa55', '2024-06-02', 'Serang Banten', 'Ilmu Komputer', '08987524413'),
('admin001', 'Admin User', '1980-01-01', 'Admin Address', 'Admin Prodi', '081234567890');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','mahasiswa') NOT NULL,
  `nim` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `nim`) VALUES
(2, 'admin', 'admin@example.com', '$2y$10$e0MYzXyjpJS7Pd0RVvHwHeFiVJbBz2cJVaF3HQE7PdrDCh6eK4dqa', 'admin', 'admin001'),
(55, 'admin45', 'admin45@gmail.com', 'admin45', 'admin', 'admin45'),
(58, 'mahasiswa55', 'mahasiswa55@gmail.com', '55', 'mahasiswa', '5505'),
(59, 'robiatuladawiyah', 'robiatuladawiyah@gmail.com', '1', 'mahasiswa', '14022100027');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `profil`
--
ALTER TABLE `profil`
  ADD CONSTRAINT `profil_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `users` (`nim`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
