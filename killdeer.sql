-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 15, 2012 at 01:38 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `killdeer`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE IF NOT EXISTS `blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `date` varchar(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `layout` int(11) NOT NULL DEFAULT '0',
  `enabled` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `name`, `date`, `url`, `content`, `meta_title`, `meta_keywords`, `meta_description`, `layout`, `enabled`) VALUES
(1, 'Ut fermentum massa justo sit amet risus', '1327554000', 'ut-fermentum-massa-justo-sit-amet-risus', '<p>Ut fermentum massa justo sit amet risus. Vestibulum id ligula porta felis euismod semper. Donec id elit non mi porta gravida at eget metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dictum quam sed eros vestibulum et auctor turpis mattis. Praesent viverra semper lectus, sed facilisis mauris tincidunt non.</p><p>Sed sed tortor eget neque facilisis imperdiet. Integer tortor urna, dignissim vitae tempor eget, egestas ut velit. Suspendisse varius elit nec eros imperdiet vel viverra est tristique. Quisque lacus augue, gravida et pretium sed, imperdiet quis ipsum. Integer a suscipit tortor. Nullam sit amet neque est.</p>', '', '', '', 6, 1),
(2, 'Donec id elit non mi porta gravida at eget metus', '1329022800', 'donec-id-elit-non-mi-porta-gravida-at-eget-metus', '<p>Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Sed pellentesque fermentum rutrum.</p><p>Donec nec dui hendrerit libero imperdiet malesuada vel et dui. Aenean ut est a massa mollis lacinia. Cras metus quam, tincidunt vitae convallis a, ullamcorper a lorem. Aenean ante ipsum, porta quis sodales nec, tristique ac nunc. Pellentesque id ligula quam, in commodo nisi.</p>', '', '', '', 6, 1),
(3, 'Sed posuere consectetur est at lobortis', '1330059600', 'sed-posuere-consectetur-est-at-lobortis', '<p>Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh. Fusce malesuada congue quam mollis ullamcorper. Nulla est purus, consequat vitae rutrum quis, iaculis id augue. Mauris a vehicula enim.</p><p>Pellentesque quis turpis mi, eget lobortis nisl. Maecenas congue, dolor eu adipiscing egestas, felis ipsum commodo est, commodo hendrerit eros est vulputate lacus. Donec iaculis, nisl pretium interdum ornare, lacus odio luctus mi, et venenatis elit elit eget mi.</p>', '', '', '', 0, 1),
(4, 'Sociis natoque penatibus et magnis dis parturient montes', '1331182800', 'sociis-natoque-penatibus-et-magnis-dis-oarturient', '<p>Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Fusce dui justo, sollicitudin a auctor a, pulvinar eget lectus. Etiam tincidunt varius facilisis.</p><p>In vestibulum, leo eu malesuada mattis, odio quam elementum diam, at facilisis enim lacus sit amet erat. Maecenas nisi arcu, rhoncus eu lacinia in, lobortis in nunc. Nullam ac sem id enim viverra vestibulum ullamcorper at metus. Pellentesque laoreet mattis cursus.</p>', '', '', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `layouts`
--

CREATE TABLE IF NOT EXISTS `layouts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `controller` varchar(255) NOT NULL,
  `skin` varchar(255) NOT NULL,
  `cells` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `layouts`
--

INSERT INTO `layouts` (`id`, `name`, `controller`, `skin`, `cells`) VALUES
(1, 'Home', '', 'home', '[["[content]"],["[blocks:2]","[blocks:6]"],["[blogs:4]"],["[forms:2]"],["[blogs:recent]"],["[blogs:recent.green]"],["[blogs:4.full]"]]'),
(2, 'Skin 1', '', 'skin1', '[["[content]"],["[blocks:1]","[blocks:2]"],["<h3>HTML Block<\\/h3><p>This is written directly into the layout of this page without being added to the Blocks module.<\\/p><p>Mauris varius accumsan orci, eu venenatis eros venenatis nec. Curabitur eu ipsum mauris. Lorem ipsum dolor sit amet, consectetur adipiscing elit.<\\/p>"],["<h3>Another HTML Block<\\/h3><p>Cras quam nisl, mattis eu vestibulum sed, commodo a tellus. Integer nunc nisl, fringilla sed fermentum sit amet, commodo at sapien. Ut nibh orci, volutpat eget ultrices at, aliquet porttitor lectus. Aliquam egestas gravida egestas<\\/p>"]]'),
(3, 'Blogs Landing', 'blogs', '', '[["[content]"],["[blocks:1]","[blogs:subscribe]","[blocks:3]","[blogs:categories]","[blogs:recent]"]]'),
(4, 'Default Page Layout 1', '', '', '[["[content]","[forms:1]"],["[blocks:6]","[forms:2]","[forms:2]"]]'),
(5, 'Default Page Layout 2', '', '', '[["[content]"],["[blocks:6]"]]'),
(6, 'Blogs Post', 'blogs', 'post', '[["[blocks:7]"],["[content]"],["[blogs:subscribe]","[blogs:recent]","[blocks:1]","[blogs:categories]"]]');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `layout` int(11) NOT NULL DEFAULT '0',
  `enabled` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `url`, `content`, `meta_title`, `meta_keywords`, `meta_description`, `layout`, `enabled`) VALUES
(1, 'Home', 'index', '<h2>Welcome</h2><p>Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Vestibulum id ligula porta felis euismod semper. Donec id elit non mi porta gravida at eget metus.</p><p>Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>', 'Home Page', 'sed, posuere, consectetur est, at lobortis', 'Sed posuere consectetur est at lobortis. Fusce dapibus tellus ac cursus.', 1, 1),
(2, 'Page not found', 'error', '<h2>Page Not Found</h2><p>The page you were looking for was not found.</p>', 'Page not found', '', '', 5, 1),
(3, 'About Us', 'about', '<h2>About Us</h2><p>Praesent sagittis lacus in elementum sodales lacus justo porttitor lacus vel dictum nisi dui nec turpis. Etiam at nisl nisl, sed porttitor dui. Proin eu laoreet mauris. Proin et massa et nulla pellentesque tempus et sed ligula. Ut congue feugiat enim.</p>', 'About Us', '', 'Praesent sagittis lacus in elementum sodales lacus justo porttitor.', 2, 1),
(4, 'Blog', 'blog', '<h2>Blog</h2><p>Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Vestibulum id ligula porta felis euismod semper. Donec id elit non mi porta gravida at eget metus.</p>', '', '', '', 3, 1),
(5, 'Contact Us', 'contact', '<h2>Contact Us</h2><p>Etiam at nisl nisl sed porttitor dui. Proin eu laoreet mauris. Proin et massa et nulla pellentesque tempus et sed ligula. Ut congue feugiat enim.</p>', '', '', '', 4, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
