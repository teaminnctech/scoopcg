scoopcg
=======

scoppgallery

Create new data base First

CREATE DATABASE IF NOT EXISTS `paste_image` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `paste_image`;

CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(100) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `datetime` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(100) NOT NULL,
  `image` mediumblob NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


