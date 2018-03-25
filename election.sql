-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2018 at 03:23 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `election`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `position` text NOT NULL,
  `details` text NOT NULL,
  `party` text NOT NULL,
  `votes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`id`, `user`, `position`, `details`, `party`, `votes`) VALUES
(1, 5, 'President', 'Yey cool shit', 'Party A', 0),
(4, 7, 'President', 'e9fp9guwep9huioghwoeih', 'Party B', 0),
(5, 9, 'President', 'oighorihoihio', 'Party A', 0),
(6, 11, 'President', 'rghbtjesaeag trh srh trsnb', 'Party B', 0),
(7, 12, 'Vice President', 'wew', 'Party A', 0),
(8, 13, 'Vice President', 'wew', 'Party B', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `name` text NOT NULL,
  `section` text NOT NULL,
  `priv` text NOT NULL,
  `voted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `section`, `priv`, `voted`) VALUES
(2, 'wew', '6ab016eae79b6a14980adf361b551bfbff90d38f7490987e60a9590f2ffb37bc', 'wew', 'rosal', 'ROOT,CANDIDATE,VOTE', 1),
(5, 'jromero', '2cf24dba5fb0a30e26e83b2ac5b9e29e1b161e5c1fa7425e73043362938b9824', 'Justine Che T. Romero', 'physics12', 'ROOT,CANDIDATE,VOTE', 0),
(7, 'xthan18', '9db7f463979f6f1570a35ad56105dfe18dc122cf68573d3376658b4048072a06', 'Chryz Than Wolf G. Chavez', 'physics12', 'ROOT,CANDIDATE,VOTE', 0),
(8, 'renciso', '6ab016eae79b6a14980adf361b551bfbff90d38f7490987e60a9590f2ffb37bc', 'Rupert Jethro B. Enciso', 'physics12', 'CANDIDATE,VOTE', 0),
(9, 'kbrazan', '6ab016eae79b6a14980adf361b551bfbff90d38f7490987e60a9590f2ffb37bc', 'Kenn Oliver C. Brazan', 'physics12', 'CANDIDATE,VOTE', 0),
(10, 'cmoreno', '6ab016eae79b6a14980adf361b551bfbff90d38f7490987e60a9590f2ffb37bc', 'Chris John Paul H. Moreno', 'physics12', 'CANDIDATE,VOTE', 0),
(11, 'chermida', '6ab016eae79b6a14980adf361b551bfbff90d38f7490987e60a9590f2ffb37bc', 'Christian Cedric Hermida', 'physics12', 'CANDIDATE,VOTE', 0),
(12, 'jdamo', '6ab016eae79b6a14980adf361b551bfbff90d38f7490987e60a9590f2ffb37bc', 'Julius Caesar Damo III', 'chemistry12', 'CANDIDATE,VOTE', 0),
(13, 'jvillafuerte', '6ab016eae79b6a14980adf361b551bfbff90d38f7490987e60a9590f2ffb37bc', 'Jethro Villafuerte', 'chemistry12', 'CANDIDATE,VOTE', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `candidate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id`),
  ADD KEY `candidate` (`candidate`),
  ADD KEY `user` (`user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidate`
--
ALTER TABLE `candidate`
  ADD CONSTRAINT `candidate_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`candidate`) REFERENCES `candidate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vote_ibfk_2` FOREIGN KEY (`user`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
