-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-03-30 05:42:35
-- 服务器版本： 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `canku`
--

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cid` int(6) NOT NULL,
  `name` varchar(20) NOT NULL,
  `shop_id` int(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`cid`, `name`, `shop_id`) VALUES
(2, '烧腊便当', 1),
(3, '港式烧腊,精致便当', 1),
(4, '流行美食篇', 1),
(5, '单点主食篇', 1),
(6, '宏港冷菜篇', 1),
(7, '烧卤外卖篇', 1),
(8, '单点菜式', 1),
(9, '饮料篇', 1);

-- --------------------------------------------------------

--
-- 表的结构 `food`
--

CREATE TABLE IF NOT EXISTS `food` (
`id` int(6) NOT NULL,
  `cid` int(6) NOT NULL,
  `name` varchar(20) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `shop_id` int(6) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `food`
--

INSERT INTO `food` (`id`, `cid`, `name`, `price`, `shop_id`) VALUES
(1, 2, '脆皮炸鸡腿饭', '20', 1),
(2, 2, '红烧大排饭', '16', 1),
(3, 2, '炸猪排饭', '18', 1),
(4, 2, '台式香肠饭', '16', 1),
(5, 2, '客家盐鸡饭', '17', 1),
(6, 2, '干煎鲳鱼饭', '17', 1),
(7, 2, '炸花枝丸饭', '16', 1),
(8, 2, '香煎鳕鱼饭', '22', 1),
(9, 2, '台式卤肉饭', '16', 1),
(10, 2, '咖喱牛腩饭', '20', 1),
(11, 2, '日式牛肉炒饭', '16', 1),
(12, 2, '台式香肠炒饭', '15', 1),
(13, 2, '脆皮烤鸭饭', '17', 1),
(14, 3, '烤鸭拼盐鸡饭', '18', 1),
(15, 3, '烧鹅盐鸡饭', '20', 1),
(16, 3, '油鸡拼排骨饭', '18', 1),
(17, 3, '客家盐鸡饭', '17', 1),
(18, 4, '宫爆鸡丁饭', '16', 1),
(19, 4, '咖喱牛腩饭', '20', 1),
(20, 4, '黑椒牛排饭', '25', 1),
(21, 4, '深井烧鹅饭', '28', 1),
(22, 5, '炸猪排一块', '8', 1),
(23, 5, '炸花枝丸3只', '6', 1),
(24, 5, '脆皮炸鸡腿一个', '12', 1),
(25, 5, '上海炒面', '12', 1),
(26, 5, '台式香肠炒饭', '16', 1),
(27, 5, '日式牛肉炒饭', '16', 1),
(28, 5, '白米饭', '2', 1),
(29, 5, '荷包蛋', '2', 1),
(30, 5, '环保餐盒', '1', 1),
(31, 6, '酸辣海带丝', '6', 1),
(32, 6, '香菜云丝', '6', 1),
(33, 6, '皮蛋豆腐', '8', 1),
(34, 6, '蒜泥黄瓜', '8', 1),
(35, 6, '丁香鱼金针茹', '14', 1),
(36, 6, '农家脆笋片', '8', 1),
(37, 6, '剁椒皮蛋', '14', 1),
(38, 7, '深井烧鹅一例', '42', 1),
(39, 7, '盐焗鸡一例', '26', 1),
(40, 7, '烧味拼盘', '42', 1),
(41, 7, '蜜汁排骨一例', '38', 1),
(42, 7, '脆皮烤鸭一例', '26', 1),
(43, 7, '脆皮烧肉一例', '30', 1),
(44, 7, '姜葱油鸡一例', '26', 1),
(45, 8, '家家小炒肉', '20', 1),
(46, 8, '米饭', '2', 1),
(47, 8, '蕃茄炒蛋', '14', 1),
(48, 8, '宫爆鸡丁', '20', 1),
(49, 8, '酱爆猪肝', '20', 1),
(50, 8, '红烧或糖醋带鱼', '20', 1),
(51, 8, '鱼香肉丝', '20', 1),
(52, 8, '红烧鲳鱼(3条)24', '24', 1),
(53, 8, '清炒时疏', '12', 1),
(54, 8, '咖喱牛腩', '32', 1),
(55, 9, '大可乐', '10', 1),
(56, 9, '大雪碧', '10', 1),
(57, 9, '冰红茶', '3', 1),
(58, 9, '加多宝', '5', 1);

-- --------------------------------------------------------

--
-- 表的结构 `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` char(32) NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `last_activity` char(10) NOT NULL,
  `user_data` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sessions`
--

INSERT INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('72183ca71ab7f2af131c7c07e299c889', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1979.0 Safari/537.36', '1427686809', 'a:8:{s:9:"user_data";s:0:"";s:7:"user_id";s:1:"1";s:8:"username";s:12:"王宋宏敏";s:5:"email";s:19:"wshm7366298@126.com";s:8:"password";s:32:"e10adc3949ba59abbe56e057f20f883e";s:8:"reg_time";s:10:"1427686735";s:8:"is_admin";s:1:"1";s:14:"canOperateShop";s:1:"1";}');

-- --------------------------------------------------------

--
-- 表的结构 `shop`
--

CREATE TABLE IF NOT EXISTS `shop` (
`shop_id` int(6) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(30) NOT NULL,
  `minprice` decimal(10,0) DEFAULT NULL,
  `shippingfee` decimal(10,0) DEFAULT NULL,
  `tel` varchar(11) NOT NULL,
  `logo` varchar(255) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `shop`
--

INSERT INTO `shop` (`shop_id`, `name`, `address`, `minprice`, `shippingfee`, `tel`, `logo`) VALUES
(1, '宏港烧腊便当', '平陆路288号', '35', '0', '', 'http://fuss10.elemecdn.com/f/2f/6656396408aaf1fec5bb9f2e6ce35jpeg.jpeg?w=66&h=66');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`user_id` int(6) NOT NULL,
  `username` varchar(8) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `reg_time` char(10) DEFAULT NULL,
  `is_admin` int(1) NOT NULL DEFAULT '0',
  `canOperateShop` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `reg_time`, `is_admin`, `canOperateShop`) VALUES
(1, '王宋宏敏', 'wshm7366298@126.com', 'e10adc3949ba59abbe56e057f20f883e', '1427686735', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `food`
--
ALTER TABLE `food`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
 ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
 ADD PRIMARY KEY (`shop_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
MODIFY `shop_id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
