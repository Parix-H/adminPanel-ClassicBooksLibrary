-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 17, 2018 at 01:14 PM
-- Server version: 5.7.21
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newbooksdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
CREATE TABLE IF NOT EXISTS `author` (
  `AuthorID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) NOT NULL,
  `Surname` varchar(30) NOT NULL,
  `Nationality` varchar(30) NOT NULL,
  `BirthYear` int(4) UNSIGNED NOT NULL,
  `DeathYear` int(4) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`AuthorID`),
  KEY `az` (`Name`),
  KEY `az1` (`Name`),
  KEY `az2` (`Name`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`AuthorID`, `Name`, `Surname`, `Nationality`, `BirthYear`, `DeathYear`) VALUES
(1, 'Miguel', 'de Cervantes Saavedra', 'Spanish', 1547, 1616),
(2, 'Charles', 'Dickens', 'British', 1812, 1870),
(3, 'J.R.R.', 'Tolkien', 'British', 1892, 1973),
(4, 'Antoine', 'de Saint-Exupery', 'French', 1900, 1944),
(5, 'J.K.', 'Rowling', 'British', 1965, NULL),
(6, 'Agatha', 'Christie', 'British', 1890, 1976),
(7, 'Cao', 'Xueqin', 'Chinese', 1715, 1763),
(8, 'Henry', ' Rider Haggard', 'British', 1856, 1925),
(9, 'C.S.', 'Lewis', 'British', 1898, 1963),
(51, 'new author', 'new surname', 'new', 1234, 1355);

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `BookID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `BookTitle` varchar(255) NOT NULL,
  `OriginalTitle` varchar(255) DEFAULT NULL,
  `YearofPublication` int(4) NOT NULL DEFAULT '0',
  `Genre` varchar(30) NOT NULL,
  `MillionsSold` int(10) UNSIGNED NOT NULL,
  `LanguageWritten` varchar(30) NOT NULL,
  `AuthorID` int(10) UNSIGNED NOT NULL,
  `coverImagePath` varchar(255) NOT NULL,
  PRIMARY KEY (`BookID`),
  KEY `fk_authorID` (`AuthorID`),
  KEY `indenxx` (`BookTitle`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`BookID`, `BookTitle`, `OriginalTitle`, `YearofPublication`, `Genre`, `MillionsSold`, `LanguageWritten`, `AuthorID`, `coverImagePath`) VALUES
(1, 'Don Quixote', 'El Ingenioso Hidalgo Don Quixote de la Mancha', 1605, 'Novel', 500, 'Spanish', 1, '../images/bookCovers/DonQuixote.jpg'),
(2, 'A Tale of Two Cities', 'A Tale of Two Cities', 1859, 'Historical Fiction', 200, 'English', 2, '../images/bookCovers/aTaleofTwoCities.jpg'),
(3, 'The Lord of the Rings', 'The Lord of the Rings', 1954, 'Fantasy/Adventure', 150, 'English', 3, '../images/bookCovers/default.png'),
(4, 'The Litle Prince', 'Le Petit Prince', 1943, 'Fable', 142, 'French', 4, '../images/bookCovers/theLittlePrince.jpg'),
(5, 'Harry Potter and the Sorcerer\'s Stone', 'Harry Potter and the Sorcerer\'s Stone', 1997, 'Fantasy Fiction', 107, 'English', 5, '../images/bookCovers/default.png'),
(6, 'And Then There Were None', 'Ten Little Niggers', 1939, 'Mystery', 100, 'English', 6, '../images/bookCovers/andThenThereWereNone.jpg'),
(7, 'The Dream of the Red Chamber', 'The Story of the Stone', 1792, 'Novel', 100, 'Chinese', 7, '../images/bookCovers/redChamber.jpg\r\n'),
(8, 'The Hobbit ', 'There and Back Again', 1937, 'High Fantasy', 100, 'English', 3, '../images/bookCovers/theHobbit.jpg'),
(9, 'She: A History of Adventure', 'She', 1886, 'FIction', 100, 'English', 8, '../images/bookCovers/She.jpg'),
(10, 'The Lion, the Witch and the Wardrobe', 'The Lion, the Witch and the Wardrobe', 1950, 'Fantasy', 85, 'English ', 9, '../images/bookCovers/default.png');

-- --------------------------------------------------------

--
-- Table structure for table `bookplot`
--

DROP TABLE IF EXISTS `bookplot`;
CREATE TABLE IF NOT EXISTS `bookplot` (
  `BookPlotID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Plot` blob NOT NULL,
  `PlotSource` varchar(255) NOT NULL,
  `BookID` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`BookPlotID`),
  KEY `fk_bookID2` (`BookID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookplot`
--

INSERT INTO `bookplot` (`BookPlotID`, `Plot`, `PlotSource`, `BookID`) VALUES
(2, 0x496e20412054616c65206f662054776f204369746965732c20436861726c6573204461726e617920747269657320746f20657363617065206869732068657269746167652061732061204672656e63682061726973746f6372617420696e20746865207965617273206c656164696e6720757020746f20746865204672656e6368205265766f6c7574696f6e2e200d0a4f6e2074686520657665206f6620746865205265766f6c7574696f6e2c20686527732063617074757265642c20627574205379646e657920436172746f6e2c2061206d616e2077686f206c6f6f6b73206c696b65204461726e61792c2074616b65732068697320706c61636520616e642064696573206f6e20746865206775696c6c6f74696e652e, 'https://www.enotes.com/topics/tale-of-two-cities', 2),
(3, 0x546865207469746c65206f6620746865206e6f76656c2072656665727320746f207468652073746f72792773206d61696e20616e7461676f6e6973742c20746865204461726b204c6f726420536175726f6e2c2077686f2068616420696e20616e206561726c69657220616765206372656174656420746865200d0a4f6e652052696e6720746f2072756c6520746865206f746865722052696e6773206f6620506f7765722061732074686520756c74696d61746520776561706f6e20696e206869732063616d706169676e20746f20636f6e7175657220616e642072756c6520616c6c206f66204d6964646c652d65617274682e20, 'https://en.wikipedia.org/wiki/The_Lord_of_the_Rings', 3),
(6, 0x416e64205468656e2054686572652057657265204e6f6e652069732061206465746563746976652066696374696f6e206e6f76656c206279204167617468612043687269737469652c206669727374207075626c697368656420696e2074686520556e69746564204b696e67646f6d2062792074686520436f6c6c696e73204372696d6520436c7562206f6e2036204e6f76656d626572203139333920756e64657220746865207469746c652054656e204c6974746c65204e69676765727320616e6420696e2074686520556e697465642053746174657320627920446f64642c204d65616420616e6420436f6d70616e7920696e204a616e75617279203139343020756e64657220746865207469746c6520416e64205468656e2054686572652057657265204e6f6e652e20496e20746865206e6f76656c2c2074656e2070656f706c652c2077686f20686176652070726576696f75736c79206265656e20636f6d706c6963697420696e2074686520646561746873206f66206f74686572732062757420686176652065736361706564206e6f7469636520616e642f6f722070756e6973686d656e742c2061726520747269636b656420696e746f20636f6d696e67206f6e746f20616e2069736c616e642e204576656e2074686f75676820746865206775657374732061726520746865206f6e6c792070656f706c65206f6e207468652069736c616e642c20746865792061726520616c6c206d7973746572696f75736c79206d75726465726564206f6e65206279206f6e652c20696e2061206d616e6e657220706172616c6c656c696e672c20696e65786f7261626c7920616e6420736f6d6574696d65732067726f7465737175656c792c20746865206f6c64206e757273657279207268796d652c202254656e204c6974746c6520496e6469616e73222e2054686520554b2065646974696f6e2072657461696c656420617420736576656e207368696c6c696e677320616e642073697870656e63652028372f362920616e64207468652055532065646974696f6e2061742024322e30302e20546865206e6f76656c2068617320616c736f206265656e207075626c697368656420616e642066696c6d656420756e64657220746865207469746c652054656e204c6974746c6520496e6469616e732e, 'http://agathachristie.wikia.com/wiki/And_Then_There_Were_None', 6),
(8, 0x54686520486f62626974206973207468652073746f7279206f662042696c626f2042616767696e732c206120686f626269742077686f206c6976657320696e20486f626269746f6e2e20486520656e6a6f7973206120706561636566756c20616e6420706173746f72616c206c6966652062757420686973206c69666520697320696e7465727275707465642062792061207375727072697365207669736974206279207468652077697a6172642047616e64616c662e200d0a4265666f72652042696c626f206973207265616c6c792061626c6520746f20696d70726f76652075706f6e2074686520736974756174696f6e2c2047616e64616c662068617320696e76697465642068696d73656c6620746f2074656120616e64207768656e20686520617272697665732c20686520636f6d65732077697468206120636f6d70616e79206f662064776172766573206c65642062792054686f72696e2e200d0a546865792061726520656d6261726b696e67206f6e2061206a6f75726e657920746f207265636f766572206c6f7374207472656173757265207468617420697320677561726465642062792074686520647261676f6e20536d6175672c20617420746865204c6f6e656c79204d6f756e7461696e2e20, 'http://www.gradesaver.com/the-hobbit/study-guide/summary', 8),
(9, 0x536865206973207468652073746f7279206f662043616d6272696467652070726f666573736f7220486f7261636520486f6c6c7920616e64206869732077617264204c656f2056696e6365792c20616e64207468656972206a6f75726e657920746f2061206c6f7374206b696e67646f6d20696e20746865204166726963616e20696e746572696f722e200d0a546865206a6f75726e6579206973207472696767657265642062792061206d7973746572696f7573207061636b616765206c65667420746f204c656f20627920686973206661746865722c20746f206265206f70656e6564206f6e2068697320323574682062697274686461792e0d0a5468652073746f727920657870726573736573206e756d65726f75732072616369616c20616e642065766f6c7574696f6e61727920636f6e63657074696f6e73206f6620746865206c61746520566963746f7269616e732c20657370656369616c6c79206e6f74696f6e73206f6620646567656e65726174696f6e20616e642072616369616c206465636c696e652070726f6d696e656e7420647572696e67207468652066696e206465207369e8636c652e, 'http://www.goodreads.com/book/show/682681.She', 9);

-- --------------------------------------------------------

--
-- Table structure for table `bookranking`
--

DROP TABLE IF EXISTS `bookranking`;
CREATE TABLE IF NOT EXISTS `bookranking` (
  `RankingID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `RankingScore` int(10) UNSIGNED NOT NULL,
  `BookID` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`RankingID`),
  KEY `fk_bookID` (`BookID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookranking`
--

INSERT INTO `bookranking` (`RankingID`, `RankingScore`, `BookID`) VALUES
(2, 2, 2),
(3, 3, 3),
(6, 6, 6),
(8, 8, 8),
(9, 9, 9);

-- --------------------------------------------------------

--
-- Table structure for table `changelog`
--

DROP TABLE IF EXISTS `changelog`;
CREATE TABLE IF NOT EXISTS `changelog` (
  `changeLogID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `dateChanged` varchar(200) NOT NULL,
  `dateCreated` varchar(200) NOT NULL,
  `BookID` int(10) UNSIGNED DEFAULT NULL,
  `userID` int(10) UNSIGNED NOT NULL,
  `changeType` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`changeLogID`),
  KEY `BookID` (`BookID`) USING BTREE,
  KEY `userID` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `changelog`
--

INSERT INTO `changelog` (`changeLogID`, `dateChanged`, `dateCreated`, `BookID`, `userID`, `changeType`) VALUES
(1, '27/05/2007', '14/12/1999', 2, 1, NULL),
(2, '24/06/2009', '16/04/2015', 2, 2, NULL),
(3, '11-11-18', '11-11-18', 33, 5, NULL),
(24, '12-11-18', '12-11-18', 5, 33, '32'),
(25, '12-11-18', '12-11-18', 5, 36, '35'),
(26, '12-11-18', '12-11-18', 6, 37, '36'),
(27, '12-11-18', '12-11-18', 5, 37, '36'),
(28, '12-11-18', '12-11-18', 49, 5, 'add'),
(29, '12-11-18', '12-11-18', 36, 6, 'update'),
(30, '12-11-18', '12-11-18', 50, 6, 'add'),
(31, '12-11-18', '12-11-18', 50, 6, 'update'),
(32, '12-11-18', '12-11-18', 37, 6, 'update'),
(33, '17-11-18', '17-11-18', 51, 6, 'add'),
(35, '17-11-18', '17-11-18', 51, 6, 'update');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `loginID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `accessRights` varchar(200) NOT NULL,
  PRIMARY KEY (`loginID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`loginID`, `username`, `password`, `accessRights`) VALUES
(1, 'joe', 'eoj', 'admin'),
(2, 'doge', 'much', 'admin'),
(3, 'p', '$2y$10$KyMTQ9jbpekVCDWIuhZ41uYHg4F.kYhFLBc6Ljnu8AvHvl2mHRtOm', 'admin'),
(4, 'a', '$2y$10$KlYegEKDRuhcp3Y0ofPvjuS1kvPAcQteLR7e9Ouu188iLBISwHKBm', 'editor'),
(5, 'n', '$2y$10$ZBkjF7Z.C49qTdqWtdbMn.3RuSbbolNK.LTFLxb2s4UqTnXuAXctm', 'n'),
(6, 'm', '$2y$10$VUqvrBNLljxLEw2dogUPUu/ZL.IHq8to5Zla11QuHRKtd93guUV22', 'm'),
(7, 'f', '$2y$10$cRwlSjM6EfVwki6itqlYqu4p13lhj8tq1e3Ap1x7j/P83PKGsiQma', 'f'),
(8, 'c', '$2y$10$e5PgwqmWuJNDyhH7TvCIDensfgIMEyGCYJlphlYNkc8Ql6oqrqlpe', 'c'),
(9, 'g', '$2y$10$yJitH.I3z9y3D79W/ag3iO0.8nRMbXyhNuSW.dNVepHU2bZpBEXgK', 'g'),
(10, 'x', '$2y$10$ftF.0k0TMo1ruNKbI5HFS.5fT67oYvcLI3HNxXJqUnc4mUROmozsW', 'x'),
(11, 'z', '$2y$10$AkyD7Hu0V8vzzfOOn2f6G.Nm8Qv3W4MY59uUxgX1Lqpig22mxc466', 'z'),
(12, 'l', '$2y$10$lkcFHq0X3JB6tc4mTRL.W.zoOoWXP8u0Yb2y/ozGh/9DxlXZJW20G', 'l'),
(13, 'ff', '$2y$10$GwFuov5Uiy/cawA1kWer.eY0y5qFc8/8vNE1hcDI5BWuRmnQvsgFS', 'fdfdfdf'),
(14, 'new user', '$2y$10$RBUc3qD2YrNBJJTSVs0byuQN6lysGuijUBmk7lTze47CV285NQd9C', 'user'),
(15, 'new2', '$2y$10$HK1vpJ83Hvxd715PxkUoMOXRCRFaXHQ2wKsoiIjIQ3Llbu9TtD2Ou', 'kjljkj'),
(16, 'new3', '$2y$10$e79nGSDXxnFVby5en1gcQO1ig84ew8AbbwQsNxE3oKUoPwwFGkEIO', 'lkjlkjlk'),
(17, 'new4', '$2y$10$BUCCOAv4GbtPjy3F9liwGOEztVUxy8s2kcXoi2uazPcrZE17YXT5W', 'uyiyiu'),
(18, 'admin', '$2y$10$ifyFk54.9r8ILd63Wy6lI.iz2gpQ3nmOYqyNarxRPCXN7UYkmf9Bi', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `firstName` varchar(200) NOT NULL,
  `lastName` varchar(200) NOT NULL,
  `loginID` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`userID`),
  KEY `loginID` (`loginID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `email`, `firstName`, `lastName`, `loginID`) VALUES
(1, 'joe@gmal.com', 'Joe', 'Al', 1),
(2, 'LLZ', 'Ralph', 'Johnes', 2),
(3, 'p@p.p', 'p', 'p', 3),
(4, 'a@a.a', 'a', 'a', 4),
(5, 'n', 'n', 'n', 5),
(6, 'm', 'm', 'm', 6),
(7, 'f', 'f', 'f', 7),
(8, 'c', 'c', 'c', 8),
(9, 'g', 'g', 'g', 9),
(10, 'x', 'x', 'x', 10),
(11, 'z', 'z', 'z', 11),
(12, 'l', 'l', 'l', 12),
(13, 'ff', 'ff', 'ff', 13),
(14, 'new email', 'new username', 'new family', 14),
(15, 'kjlkjlj', 'kjlkj', 'kjljj', 15),
(16, 'kjlkj', 'kjlj', 'kjlkj', 16),
(17, 'yiyuy', 'uyiy', 'yuiyi', 17),
(18, 'admin@admin.com', 'admin', 'admin', 18);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`AuthorID`) REFERENCES `author` (`AuthorID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bookplot`
--
ALTER TABLE `bookplot`
  ADD CONSTRAINT `fk_bookID2` FOREIGN KEY (`BookID`) REFERENCES `book` (`BookID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bookranking`
--
ALTER TABLE `bookranking`
  ADD CONSTRAINT `fk_bookID` FOREIGN KEY (`BookID`) REFERENCES `book` (`BookID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`loginID`) REFERENCES `login` (`loginID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
