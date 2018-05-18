DROP TABLE IF EXISTS `books`;

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `isbn` varchar(12) NOT NULL,
  `publisher` varchar(40) NOT NULL,
  `year` int(11) NOT NULL,
  `price` decimal(6,2) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO `books` (`id`, `title`, `firstName`, `lastName`, `isbn`, `publisher`, `year`, `price`) VALUES
(1, 'Java Programming', 'Joseph', 'Bloggs', '123456789012', 'Java Press', 2011, '21.98'),
(2, 'PHP Programming', 'Harry', 'Hughes', '234567890123', 'PHP Press', 2009, '19.99'),
(3, 'JavaScript Programming', 'Jane', 'Jones', '345678901234', 'JS Press', 2010, '23.00'),
(4, 'Game Programming', 'Kevin', 'Kelly', '456789012345', 'Game Press', 2006, '33.99'),
(5, 'Android Game Programming', 'Jessie', 'Jones', '098765432109', 'Big Game Books', 2012, '12.99'),
(6, 'iOS Game Programming', 'Kieran', 'Kavanagh', '098765432109', 'Garage Software', 2012, '56.99');