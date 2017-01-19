-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: 2017-01-19 11:04:00
-- 服务器版本： 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpbean`
--

-- --------------------------------------------------------

--
-- 表的结构 `sys_admin`
--

DROP TABLE IF EXISTS `sys_admin`;
CREATE TABLE `sys_admin` (
  `id` int(10) unsigned NOT NULL COMMENT '主键',
  `account` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '帐号',
  `password` varchar(40) COLLATE utf8_bin NOT NULL COMMENT '密码',
  `operator_create` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT 'system' COMMENT '创建者',
  `datetime_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `operator_modify` varchar(10) COLLATE utf8_bin DEFAULT NULL COMMENT '修改者',
  `datetime_modify` timestamp NULL DEFAULT NULL COMMENT '修改时间'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='用户表';

--
-- 转存表中的数据 `sys_admin`
--

INSERT INTO `sys_admin` (`id`, `account`, `password`, `operator_create`, `datetime_create`, `operator_modify`, `datetime_modify`) VALUES
(1, 'root', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'system', '2017-01-19 09:25:55', NULL, NULL),
(2, 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'system', '2017-01-19 09:24:59', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `sys_admin_role`
--

DROP TABLE IF EXISTS `sys_admin_role`;
CREATE TABLE `sys_admin_role` (
  `id` int(10) unsigned NOT NULL COMMENT '主键',
  `admin_id` int(10) unsigned NOT NULL COMMENT '用户ID',
  `role_id` int(10) unsigned NOT NULL COMMENT '角色ID',
  `datetime_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建日期'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='用户角色关联表';

--
-- 转存表中的数据 `sys_admin_role`
--

INSERT INTO `sys_admin_role` (`id`, `admin_id`, `role_id`, `datetime_create`) VALUES
(1, 1, 1, '2017-01-19 09:24:53'),
(2, 2, 2, '2017-01-19 09:24:59');

-- --------------------------------------------------------

--
-- 表的结构 `sys_global_config`
--

DROP TABLE IF EXISTS `sys_global_config`;
CREATE TABLE `sys_global_config` (
  `id` int(10) unsigned NOT NULL COMMENT '主键',
  `code` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '编码',
  `name` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '名称',
  `memo` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '说明',
  `operator_create` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT 'system' COMMENT '创建者',
  `datetime_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `operator_modify` varchar(10) COLLATE utf8_bin DEFAULT NULL COMMENT '修改者',
  `datetime_modify` timestamp NULL DEFAULT NULL COMMENT '修改时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='系统配置表';

-- --------------------------------------------------------

--
-- 表的结构 `sys_module`
--

DROP TABLE IF EXISTS `sys_module`;
CREATE TABLE `sys_module` (
  `id` int(10) unsigned NOT NULL COMMENT '主键',
  `code` varchar(30) COLLATE utf8_bin NOT NULL COMMENT '模块code',
  `name` varchar(30) COLLATE utf8_bin NOT NULL COMMENT '模块名',
  `datetime_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建日期'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='系统模块表';

-- --------------------------------------------------------

--
-- 表的结构 `sys_role`
--

DROP TABLE IF EXISTS `sys_role`;
CREATE TABLE `sys_role` (
  `id` int(10) unsigned NOT NULL COMMENT '主键',
  `code` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '角色code',
  `name` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '角色名',
  `operator_create` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT 'system' COMMENT '创建者',
  `datetime_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建日期',
  `operator_modify` varchar(10) COLLATE utf8_bin DEFAULT NULL COMMENT '修改者',
  `datetime_modify` timestamp NULL DEFAULT NULL COMMENT '修改日期'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='角色表';

--
-- 转存表中的数据 `sys_role`
--

INSERT INTO `sys_role` (`id`, `code`, `name`, `operator_create`, `datetime_create`, `operator_modify`, `datetime_modify`) VALUES
(1, 'root', '超级管理员', 'system', '2017-01-19 09:16:41', NULL, NULL),
(2, 'admin', '管理员', 'system', '2016-08-07 13:28:18', NULL, NULL),
(3, 'normal', '普通用户', 'system', '2016-08-07 13:28:02', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `sys_role_permission`
--

DROP TABLE IF EXISTS `sys_role_permission`;
CREATE TABLE `sys_role_permission` (
  `id` int(10) unsigned NOT NULL COMMENT '主键',
  `role_id` int(10) unsigned NOT NULL COMMENT '角色ID',
  `permission_id` int(10) unsigned NOT NULL COMMENT '权限ID',
  `datetime_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建日期'
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='角色权限关联表';

--
-- 转存表中的数据 `sys_role_permission`
--

INSERT INTO `sys_role_permission` (`id`, `role_id`, `permission_id`, `datetime_create`) VALUES
(1, 1, 1, '2017-01-19 09:20:33'),
(2, 1, 2, '2017-01-19 09:20:33'),
(3, 1, 21, '2017-01-19 09:20:33'),
(4, 1, 211, '2017-01-19 09:20:33'),
(5, 1, 212, '2017-01-19 09:20:33'),
(6, 1, 213, '2017-01-19 09:20:33'),
(7, 1, 214, '2017-01-19 09:20:33'),
(8, 1, 22, '2017-01-19 09:20:33'),
(9, 1, 221, '2017-01-19 09:20:33'),
(10, 1, 222, '2017-01-19 09:20:33'),
(11, 1, 223, '2017-01-19 09:20:33'),
(12, 1, 224, '2017-01-19 09:20:33'),
(13, 2, 2, '2017-01-19 09:20:50'),
(14, 2, 21, '2017-01-19 09:20:50'),
(15, 2, 211, '2017-01-19 09:20:50'),
(16, 2, 212, '2017-01-19 09:20:50'),
(17, 2, 213, '2017-01-19 09:20:50'),
(18, 2, 214, '2017-01-19 09:20:50'),
(19, 2, 22, '2017-01-19 09:20:50'),
(20, 2, 221, '2017-01-19 09:20:50'),
(21, 2, 222, '2017-01-19 09:20:50'),
(22, 2, 223, '2017-01-19 09:20:50'),
(23, 2, 224, '2017-01-19 09:20:50'),
(24, 3, 0, '2017-01-19 09:20:53');

-- --------------------------------------------------------

--
-- 表的结构 `tmp_permission`
--

DROP TABLE IF EXISTS `tmp_permission`;
CREATE TABLE `tmp_permission` (
  `id` int(10) unsigned NOT NULL COMMENT '主键',
  `code` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '权限编码',
  `name` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '权限名称',
  `operator_create` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT 'system' COMMENT '创建者',
  `datetime_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建日期',
  `operator_modify` varchar(10) COLLATE utf8_bin DEFAULT NULL COMMENT '修改者',
  `datetime_modify` timestamp NULL DEFAULT NULL COMMENT '修改日期'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='权限表';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sys_admin`
--
ALTER TABLE `sys_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_admin_role`
--
ALTER TABLE `sys_admin_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_global_config`
--
ALTER TABLE `sys_global_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_module`
--
ALTER TABLE `sys_module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_role`
--
ALTER TABLE `sys_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_role_permission`
--
ALTER TABLE `sys_role_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmp_permission`
--
ALTER TABLE `tmp_permission`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sys_admin`
--
ALTER TABLE `sys_admin`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sys_admin_role`
--
ALTER TABLE `sys_admin_role`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sys_global_config`
--
ALTER TABLE `sys_global_config`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键';
--
-- AUTO_INCREMENT for table `sys_module`
--
ALTER TABLE `sys_module`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键';
--
-- AUTO_INCREMENT for table `sys_role`
--
ALTER TABLE `sys_role`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sys_role_permission`
--
ALTER TABLE `sys_role_permission`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `tmp_permission`
--
ALTER TABLE `tmp_permission`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
