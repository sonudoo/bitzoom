SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
CREATE DATABASE `bitzoom` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bitzoom`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phno` varchar(20) NOT NULL,
  `message` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;
CREATE TABLE IF NOT EXISTS `course` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `coursename` varchar(100) NOT NULL,
  `courseid` varchar(100) NOT NULL,
  `major` varchar(100) NOT NULL,
  `sem` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=438 ;
INSERT INTO `course` (`id`, `coursename`, `courseid`, `major`, `sem`) VALUES
(437, 'Fundamentals of Data Structures', 'CS2001', 'CSE', '1');
CREATE TABLE IF NOT EXISTS `loggedin_users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `cookie` varchar(1000) NOT NULL,
  `cookie2` varchar(110) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=734 ;
CREATE TABLE IF NOT EXISTS `registered_users` (
  `sno` int(255) NOT NULL AUTO_INCREMENT,
  `id` int(255) NOT NULL,
  `rollno` varchar(20) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `roomno` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sex` varchar(3) NOT NULL,
  `branch` varchar(10) NOT NULL,
  `sem` int(255) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `secques` int(100) NOT NULL,
  `secans` varchar(100) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `notify` varchar(1000) NOT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=340 ;
INSERT INTO `registered_users` (`sno`, `id`, `rollno`, `dob`, `roomno`, `name`, `sex`, `branch`, `sem`, `username`, `password`, `secques`, `secans`, `ip`, `notify`) VALUES
(338, 1, 'BE/00000/15', '3/5/1997', '456', 'Sample User', 'M', 'CSE', 1, 'sampleuser', '22d7fe8c185003c98f97e5d6ced420c7', 1, 'noanswer', 'XXX.XXX.XXX.XXX', '');
CREATE TABLE IF NOT EXISTS `uploads` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `subject` varchar(1000) NOT NULL,
  `folder` varchar(1000) NOT NULL,
  `major` varchar(100) NOT NULL,
  `sem` varchar(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;
CREATE TABLE IF NOT EXISTS `user_details` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `dob` varchar(15) NOT NULL,
  `rollno` varchar(20) NOT NULL,
  `roomno` varchar(20) NOT NULL,
  `sex` varchar(3) NOT NULL,
  `branch` varchar(10) NOT NULL,
  `sem` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2906 ;
INSERT INTO `user_details` (`id`, `name`, `dob`, `rollno`, `roomno`, `sex`, `branch`, `sem`) VALUES
(1, 'Sample User', '3/5/1997', 'BE/10XXX/15', '456', 'M', 'CSE', '1');

