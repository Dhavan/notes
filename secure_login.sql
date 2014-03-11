-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2014 at 12:17 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `secure_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `user_id` int(11) NOT NULL,
  `time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`user_id`, `time`) VALUES
(1, '1385995353'),
(1, '1386011064');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `username`, `email`, `password`, `salt`) VALUES
(1, 'test_user', 'test@example.com', '00807432eae173f652f2064bdca1b61b290b52d40e429a7d295d76a71084aa96c0233b82f1feac45529e0726559645acaed6f3ae58a286b9f075916ebf66cacc', 'f9aab579fc1b41ed0c44fe4ecdbfcdb4cb99b9023abb241a6db833288f4eea3c02f76e0d35204a8695077dcf81932aa59006423976224be0390395bae152d4ef'),
(3, 'dhavan', 'dh@dh.com', '16bb5a1c4196590d501bbe9c01232bea76fc69a0e97e82e607504f329dd92f85d57bcaa8418791fa185bd2721b7d31d325a2590abfa0ea7efbac60685e9f4263', '8a3c94873380f29d34a1128c27638a8f918c4665f70572b8b85418b9baadf66be1005545fc8917959e081a47c7cd5e1c07f6c21b96006f2c9cc258bf3f43c446'),
(4, 'anon', 'anon@an.com', '7c7c3a4ba2cfd608dcd59b7994e9eef785dc4289f3ceff99fa80e3b44ff0c568b1e3a7899e90569d049f222141cba0fd51a0a067f282f6fd2f49e78afc12d6da', 'b02ac4ccf8f013b75fa376ebce7057df6b19b4bc08619b0982ad56493dd159beb5678d4c0eb1057a4750dbd98e0a70abe86b98e967fcae2b65d693502c242651'),
(5, 'vaidya', 'vd@vd.com', '87ee73e6373a8a36a0fe17149d6d2fb5e9b89b9e32adada6109f974de5b9751990f725260d68db8b62741a1578f4a0946ec272c08a4893580f57a2d9ba17d1f4', '0459ad4b15e01f2f19599e7ac026485dae1521dc8033d819a16b96af5ff447848f10adddfd2c7aa3354706218d7f3f15a94b877df7696ec4aa3932c67b3b11d0');

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE IF NOT EXISTS `note` (
  `id` int(11) NOT NULL,
  `note_id` int(11) NOT NULL AUTO_INCREMENT,
  `note` varchar(1024) NOT NULL,
  PRIMARY KEY (`note_id`),
  UNIQUE KEY `note_id` (`note_id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `note`
--

INSERT INTO `note` (`id`, `note_id`, `note`) VALUES
(3, 5, 'login page'),
(3, 6, 'coffee'),
(3, 7, 'Google AdSense API implementation'),
(3, 8, 'Improve CSS'),
(5, 10, 'one');

-- --------------------------------------------------------

--
-- Table structure for table `sentence`
--

CREATE TABLE IF NOT EXISTS `sentence` (
  `word_id` int(11) NOT NULL,
  `sent_id` int(11) NOT NULL AUTO_INCREMENT,
  `sentence` varchar(1024) NOT NULL,
  PRIMARY KEY (`sent_id`),
  KEY `word_id` (`word_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `sentence`
--

INSERT INTO `sentence` (`word_id`, `sent_id`, `sentence`) VALUES
(1, 1, 'You need to make an account on google before receiving emails'),
(1, 2, 'Your child is growing up! He needs an email address'),
(2, 3, 'You need to login before receiving emails.'),
(11, 4, 'You click on that link, which leads you to Google. There you see a link selling you coffee.'),
(3, 5, 'They simplify your work. There are people helping you out with their tools. They''re known as APIs.'),
(22, 6, 'The link''s appearance was so cluttered up!" Like black background with blue fonts on it.');

-- --------------------------------------------------------

--
-- Table structure for table `webdev_dictionary`
--

CREATE TABLE IF NOT EXISTS `webdev_dictionary` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `word` varchar(25) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `webdev_dictionary`
--

INSERT INTO `webdev_dictionary` (`ID`, `word`) VALUES
(1, 'Sign Up'),
(2, 'login'),
(3, 'API'),
(6, 'Test'),
(7, 'DB Integration'),
(8, 'Bug'),
(9, 'Design'),
(10, 'Meeting'),
(11, 'Coffee'),
(12, 'Documentation'),
(13, 'Blog'),
(14, 'Hacker News'),
(15, '9GAG'),
(16, 'Optimize'),
(17, 'efficiency'),
(18, 'add'),
(19, 'feature'),
(20, 'DB'),
(21, 'Security'),
(22, 'CSS'),
(23, 'version'),
(24, 'github'),
(25, 'server'),
(26, 'maintenance');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `note_ibfk_1` FOREIGN KEY (`id`) REFERENCES `members` (`id`);

--
-- Constraints for table `sentence`
--
ALTER TABLE `sentence`
  ADD CONSTRAINT `sentence_ibfk_1` FOREIGN KEY (`word_id`) REFERENCES `webdev_dictionary` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
