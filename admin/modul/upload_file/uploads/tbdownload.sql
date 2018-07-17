-- phpMyAdmin SQL Dump
-- version 2.10.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jan 04, 2013 at 04:21 AM
-- Server version: 5.0.45
-- PHP Version: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `uplod`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `tbdownload`
-- 

CREATE TABLE `tbdownload` (
  `iddownload` int(4) unsigned NOT NULL auto_increment,
  `deskripsi` varchar(100) NOT NULL,
  `namafile` varchar(100) NOT NULL,
  `klik` int(8) NOT NULL,
  PRIMARY KEY  (`iddownload`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `tbdownload`
-- 

INSERT INTO `tbdownload` VALUES (2, 'Header', 'Header.png', 1);
