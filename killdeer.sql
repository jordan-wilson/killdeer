-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 21, 2012 at 04:44 AM
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
-- Table structure for table `blocks`
--

CREATE TABLE IF NOT EXISTS `blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `skin` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`id`, `name`, `skin`, `title`, `content`) VALUES
(1, 'Block 1 (green)', 'green', 'Block 1', '<p>Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p><p>Vestibulum id ligula porta felis euismod semper. Donec id elit non mi porta gravida at eget metus.</p>'),
(2, 'Block 2 (blue)', 'blue', 'Block 2', '<p>Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>'),
(3, 'Block 3', 'default', 'Block 3', '<p>Ut fermentum massa justo sit amet risus. Vestibulum id ligula porta felis euismod semper. Donec id elit non mi porta gravida at eget metus.</p>\r\n            \r\n            '),
(4, 'Block 4', '', 'Block 4', '<p>Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>'),
(5, 'Block 5', '', 'Block 5', '<p>Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>'),
(6, 'Block 6', '', 'Block 6', '<p>Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>'),
(7, 'Block 7', '', 'Block 7', '<p>Facebook Like</p><p>Twitter Retweet</p><p>Google Plus</p>'),
(8, '', 'html', '', '<h3>HTML Block</h3><p>This is written directly into the layout of this page without being added to the Blocks module.</p><p>Mauris varius accumsan orci, eu venenatis eros venenatis nec. Curabitur eu ipsum mauris. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>'),
(9, '', 'html', '', '<h3>Another HTML Block</h3><p>Cras quam nisl, mattis eu vestibulum sed, commodo a tellus. Integer nunc nisl, fringilla sed fermentum sit amet, commodo at sapien. Ut nibh orci, volutpat eget ultrices at, aliquet porttitor lectus. Aliquam egestas gravida egestas</p>');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE IF NOT EXISTS `blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `date` int(11) NOT NULL DEFAULT '0',
  `url` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `enabled` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `name`, `date`, `url`, `content`, `meta_title`, `meta_keywords`, `meta_description`, `enabled`) VALUES
(1, 'Ut fermentum massa justo sit amet risus', 1327554000, 'ut-fermentum-massa-justo-sit-amet-risus', '<p>Ut fermentum massa justo sit amet risus. Vestibulum id ligula porta felis euismod semper. Donec id elit non mi porta gravida at eget metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dictum quam sed eros vestibulum et auctor turpis mattis. Praesent viverra semper lectus, sed facilisis mauris tincidunt non.</p><p>Sed sed tortor eget neque facilisis imperdiet. Integer tortor urna, dignissim vitae tempor eget, egestas ut velit. Suspendisse varius elit nec eros imperdiet vel viverra est tristique. Quisque lacus augue, gravida et pretium sed, imperdiet quis ipsum. Integer a suscipit tortor. Nullam sit amet neque est.</p>', '', '', '', 1),
(2, 'Donec id elit non mi porta gravida at eget metus', 1329022800, 'donec-id-elit-non-mi-porta-gravida-at-eget-metus', '<p>Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Sed pellentesque fermentum rutrum.</p><p>Donec nec dui hendrerit libero imperdiet malesuada vel et dui. Aenean ut est a massa mollis lacinia. Cras metus quam, tincidunt vitae convallis a, ullamcorper a lorem. Aenean ante ipsum, porta quis sodales nec, tristique ac nunc. Pellentesque id ligula quam, in commodo nisi.</p>', '', '', '', 1),
(3, 'Sed posuere consectetur est at lobortis', 1330059600, 'sed-posuere-consectetur-est-at-lobortis', '<p>Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh. Fusce malesuada congue quam mollis ullamcorper. Nulla est purus, consequat vitae rutrum quis, iaculis id augue. Mauris a vehicula enim.</p><p>Pellentesque quis turpis mi, eget lobortis nisl. Maecenas congue, dolor eu adipiscing egestas, felis ipsum commodo est, commodo hendrerit eros est vulputate lacus. Donec iaculis, nisl pretium interdum ornare, lacus odio luctus mi, et venenatis elit elit eget mi.</p>', '', '', '', 1),
(4, 'Sociis natoque penatibus et magnis dis parturient montes', 1331182800, 'sociis-natoque-penatibus-et-magnis-dis-oarturient', '<p>Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Fusce dui justo, sollicitudin a auctor a, pulvinar eget lectus. Etiam tincidunt varius facilisis.</p><p>In vestibulum, leo eu malesuada mattis, odio quam elementum diam, at facilisis enim lacus sit amet erat. Maecenas nisi arcu, rhoncus eu lacinia in, lobortis in nunc. Nullam ac sem id enim viverra vestibulum ullamcorper at metus. Pellentesque laoreet mattis cursus.</p>', '', '', '', 1),
(5, 'Cras sed tortor nec justo porta ultrices', 1332302400, 'cras-sed-tortor-nec-justo-porta-ultrices', '<p>Cras sed tortor nec justo porta ultrices eget in quam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Phasellus tempus dui ut felis aliquet porta.</p><p>Pellentesque nec quam sit amet odio mollis iaculis at eget ante. Suspendisse ultrices lorem a nisl bibendum dictum. Mauris condimentum diam non augue pulvinar ullamcorper. Cras imperdiet odio ut nibh auctor dapibus</p>', '', '', '', 1),
(6, 'Phasellus laoreet quam placerat eroa', 1334980800, 'phasellus-laoreet-quam-placerate-eroa', '<p>Phasellus laoreet quam placerat eros mattis porta. Praesent ipsum elit, condimentum at tincidunt gravida, fermentum at arcu. Suspendisse et quam placerat nunc porttitor dapibus. Donec ut hendrerit nisi. Phasellus a ipsum dolor. Maecenas molestie dictum ipsum vel adipiscing. Integer eget nisi massa, at condimentum erat. Mauris ultricies dictum risus, et faucibus quam convallis at.</p>', '', '', '', 1),
(7, 'Curabitur convallis ligula id ligula', 1336363200, 'curabitur-convallis-ligula-id-ligula', '<p>Curabitur convallis ligula id ligula consectetur a dignissim sem rhoncus. Aenean laoreet elit a velit dictum tempor. Praesent eget arcu id ligula ultricies dictum ullamcorper eu neque. Fusce id rutrum massa. Mauris risus sapien, malesuada a vehicula sit amet, ornare a augue</p>', '', '', '', 1),
(8, 'Integer ut urna sed massa eleifend venenatis', 1337313600, 'integer-ut-urna-sed-massa-eleifend-venenatis', '<p>Integer ut urna sed massa eleifend venenatis. Duis quis odio diam, quis tempor est. Aliquam erat volutpat. Nunc elementum, libero ultricies sollicitudin malesuada, nisi nulla lobortis dui, et tincidunt neque odio ac nunc. Nulla faucibus purus sed justo facilisis et egestas massa euismod. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi scelerisque ligula vitae lorem sagittis malesuada. Nam aliquet eleifend semper. Vivamus nec elit dolor. Aenean convallis viverra suscipit</p>', '', '', '', 1),
(9, 'Egestas at magna in at ligula eros', 1338782400, 'efestas-at-magna-in-at-ligula-eros', '<p>Egestas at magna in at ligula eros, non placerat mauris. Nunc nibh lorem, cursus sed lacinia a, ornare in dui. Cras eget massa ut metus bibendum consequat at quis turpis. Duis ac augue ac libero pretium mattis feugiat eu arcu. Integer enim nibh, dictum</p>', '', '', '', 1),
(10, 'Laoreet Hendrerit Nibh Augue Tempus', 1342324800, 'laoreet-hendrerit-nibh-augue-tempus', '<p>laoreet hendrerit nibh augue tempus risus, ac aliquam diam leo porttitor elit. Pellentesque dictum sem vel metus tincidunt cursus. Vestibulum vestibulum rutrum placerat. Donec faucibus sagittis nibh, nec euismod ante pharetra at. Ut sit amet libero magna, et tristique est</p>', 'Laoreet Hendrerit Nibh Augue Tempus', '', '', 1),
(11, 'Facilisis diam et facilisis sollicitudin', 1344744000, 'facilisis-diam-et-facilisis-sollicitudin', 'facilisis, diam et facilisis sollicitudin, mi metus porttitor augue, at dignissim lectus justo quis diam. Cras dolor purus, cursus id consectetur id, lobortis vel erat', '', '', '', 1),
(12, 'Placerat eros mattis', 1345694400, 'placerate-eros-mattis', '<p>placerat eros mattis porta. Praesent ipsum elit, condimentum at tincidunt gravida, fermentum at arcu. Suspendisse et quam placerat nunc porttitor dapibus. Donec ut hendrerit nisi. Phasellus a ipsum dolor. Maecenas molestie dictum ipsum vel adipiscing.</p>', '', '', '', 1),
(13, 'porttitor dapibus', 1346126400, 'porttitor-dapibus', '<p>porttitor dapibus. Donec ut hendrerit nisi. Phasellus a ipsum dolor. Maecenas molestie dictum ipsum vel adipiscing. Integer eget nisi massa, at condimentum erat. Mauris ultricies dictum risus, et faucibus quam convallis at.</p>', '', '', '', 1),
(14, 'Consectetur a dignissim sem rhoncus', 1346558400, 'consectetur-a-dignissim-sem-rhoncus', '<p>consectetur a dignissim sem rhoncus. Aenean laoreet elit a velit dictum tempor. Praesent eget arcu id ligula ultricies dictum ullamcorper eu neque. Fusce id rutrum massa. Mauris risus sapien, malesuada a vehicula sit amet, ornare a augue. Integer ut urna sed massa eleifend</p>', '', '', '', 1),
(15, 'Quis tempor est', 1348718400, 'quis-tempor-est', '<p>quis tempor est. Aliquam erat volutpat. Nunc elementum, libero ultricies sollicitudin malesuada, nisi nulla lobortis dui, et tincidunt neque odio ac nunc. Nulla faucibus purus sed justo facilisis et egestas massa euismod. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi scelerisque ligula vitae lorem sagittis malesuada. Nam aliquet eleifend semper</p>', '', '', '', 1),
(16, 'tincidunt neque odio ac nunc', 1352091600, 'tincidunt-neque-odio-ac-nunc', '<p>tincidunt neque odio ac nunc. Nulla faucibus purus sed justo facilisis et egestas massa euismod. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi scelerisque ligula vitae lorem sagittis malesuada. Nam aliquet eleifend semper. Vivamus nec elit dolor. Aenean convallis </p>', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE IF NOT EXISTS `blog_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `enabled` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `url`, `content`, `meta_title`, `meta_keywords`, `meta_description`, `enabled`) VALUES
(1, 'Tellus Et Varius', 'tellus-et-varius', '<h1>Tellus Et Varius</h1><p>Tellus et varius semper mauris metus viverra lectus et fermentum ligula metus vitae leo. Maecenas ultricies consequat nibh a pretium ipsum pellentesque dictum. Proin lorem purus pellentesque ac luctus vitae posuere ac enim</p>', 'Tellus Et Varius', '', '', 1),
(2, 'Maecenas Inmi', 'maecenas-inmi', '<h1>Maecenas inmi</h1><p>Eu magna consequat viverra a nec sapien. Nullam et ligula libero, sed faucibus velit. Integer quis aliquet ligula. Vivamus non congue justo. Integer ornare ante a sapien sollicitudin et sodales nulla adipiscing. Sed tincidunt aliquet sapien</p>', 'Maecenas Inmi', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `layouts`
--

CREATE TABLE IF NOT EXISTS `layouts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_id` int(11) NOT NULL DEFAULT '0',
  `table_name` varchar(255) NOT NULL,
  `controller` varchar(255) NOT NULL,
  `skin` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `layouts`
--

INSERT INTO `layouts` (`id`, `table_id`, `table_name`, `controller`, `skin`) VALUES
(1, 1, 'pages', 'pages', 'home'),
(2, 2, 'pages', '', ''),
(3, 3, 'pages', 'pages', 'skin1'),
(4, 5, 'pages', '', ''),
(5, 4, 'pages', 'blogs', ''),
(6, 10, 'blogs', 'blogs', ''),
(8, 2, 'blog_categories', 'blogs', '');

-- --------------------------------------------------------

--
-- Table structure for table `layout_cells`
--

CREATE TABLE IF NOT EXISTS `layout_cells` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `layout_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `blocks` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `layout_cells`
--

INSERT INTO `layout_cells` (`id`, `layout_id`, `name`, `blocks`) VALUES
(1, 1, 'home1', '["[blocks:1]"]'),
(2, 1, 'home2', '["[blocks:2]","[blocks:6]"]'),
(3, 1, 'home3', '["[blogs:4]"]'),
(4, 1, 'home4', '["[forms:2]"]'),
(5, 1, 'home5', '["[blogs:recent]"]\r\n'),
(6, 1, 'home6', '["[blogs:recent.green]"]'),
(7, 1, 'home7', '["[blogs:4.full]"]'),
(8, 2, 'append_content', '["[blocks:2]"]'),
(9, 2, 'right_column_callouts', '["[blocks:3]","[blocks:6]"]'),
(10, 3, 'append_content', '["[blogs:4.full]"]'),
(11, 3, 'right_column_callouts', '["[blocks:4]","[forms:2]"]'),
(12, 3, 'content_callout_1', '["[blocks:8]"]'),
(13, 3, 'content_callout_2', '["[blocks:9]"]'),
(14, 4, 'append_content', '["[forms:1]"]'),
(15, 4, 'right_column_callouts', '["[blocks:2]","[forms:2]","[blocks:4]"]'),
(16, 5, 'append_content', '["[blocks:1]"]'),
(17, 5, 'right_column_callouts', '["[blocks:5]","[blocks:6]"]'),
(18, 6, 'append_blog_content', '["[blocks:2]"]'),
(19, 6, 'right_column_blog_callouts', '["[forms:2]"]'),
(20, 8, 'right_column_blog_category_callouts', '["[blocks:3]"]');

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
  `enabled` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `url`, `content`, `meta_title`, `meta_keywords`, `meta_description`, `enabled`) VALUES
(1, 'Home', 'index', '<h2>Welcome</h2><p>Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Vestibulum id ligula porta felis euismod semper. Donec id elit non mi porta gravida at eget metus.</p><p>Donec id elit non mi porta gravida at eget metus. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>', 'Home Page', 'sed, posuere, consectetur est, at lobortis', 'Sed posuere consectetur est at lobortis. Fusce dapibus tellus ac cursus.', 1),
(2, 'Page not found', 'error', '<h2>Page Not Found</h2><p>The page you were looking for was not found.</p>', 'Page not found', '', '', 1),
(3, 'About Us', 'about', '<h2>About Us</h2><p>Praesent sagittis lacus in elementum sodales lacus justo porttitor lacus vel dictum nisi dui nec turpis. Etiam at nisl nisl, sed porttitor dui. Proin eu laoreet mauris. Proin et massa et nulla pellentesque tempus et sed ligula. Ut congue feugiat enim.</p>', 'About Us', '', 'Praesent sagittis lacus in elementum sodales lacus justo porttitor.', 1),
(4, 'Blog', 'blog', '<h2>Blog</h2><p>Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Vestibulum id ligula porta felis euismod semper. Donec id elit non mi porta gravida at eget metus.</p>', 'Blog', '', '', 1),
(5, 'Contact Us', 'contact', '<h2>Contact Us</h2><p>Etiam at nisl nisl sed porttitor dui. Proin eu laoreet mauris. Proin et massa et nulla pellentesque tempus et sed ligula. Ut congue feugiat enim.</p>', 'Contact', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `seo`
--

CREATE TABLE IF NOT EXISTS `seo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
