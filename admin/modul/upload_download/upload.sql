-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 08. Juni 2011 jam 06:25
-- Versi Server: 5.5.8
-- Versi PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `upload`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_data`
--

CREATE TABLE IF NOT EXISTS `tabel_data` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nama_file` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `ukuran` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `url` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `tgl_upload` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `keterangan` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=10 ;

--
-- Dumping data untuk tabel `tabel_data`
--

INSERT INTO `tabel_data` (`id`, `nama_file`, `ukuran`, `url`, `tgl_upload`, `keterangan`) VALUES
(9, 'dirpok-tux-rapper-22', '80664', './files/dirpok-tux-rapper-2206.png', '2011-06-08', 'Icon'),
(8, 'favicon.ico', '2490', './files/favicon.ico', '2011-06-08', 'Tonkpo');
