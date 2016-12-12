-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-08-12 12:09:41
-- 服务器版本： 5.7.9
-- PHP Version: 5.6.16

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
CREATE TABLE IF NOT EXISTS `sys_admin` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `account` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '帐号',
  `password` varchar(40) COLLATE utf8_bin NOT NULL COMMENT '密码',
  `operator_create` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT 'system' COMMENT '创建者',
  `datetime_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `operator_modify` varchar(10) COLLATE utf8_bin DEFAULT NULL COMMENT '修改者',
  `datetime_modify` timestamp NULL DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='用户表';

--
-- 转存表中的数据 `sys_admin`
--

INSERT INTO `sys_admin` (`id`, `account`, `password`, `operator_create`, `datetime_create`, `operator_modify`, `datetime_modify`) VALUES
(1, 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'system', '2016-08-07 13:28:21', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `sys_admin_role`
--

DROP TABLE IF EXISTS `sys_admin_role`;
CREATE TABLE IF NOT EXISTS `sys_admin_role` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `admin_id` int(10) UNSIGNED NOT NULL COMMENT '用户ID',
  `role_id` int(10) UNSIGNED NOT NULL COMMENT '角色ID',
  `datetime_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='用户角色关联表';

--
-- 转存表中的数据 `sys_admin_role`
--

INSERT INTO `sys_admin_role` (`id`, `admin_id`, `role_id`, `datetime_create`) VALUES
(1, 1, 1, '2016-08-07 13:28:48');

-- --------------------------------------------------------

--
-- 表的结构 `sys_example`
--

DROP TABLE IF EXISTS `sys_example`;
CREATE TABLE IF NOT EXISTS `sys_example` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `code` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '编码',
  `name` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '名称',
  `operator_create` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT 'system' COMMENT '创建者',
  `datetime_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `operator_modify` varchar(10) COLLATE utf8_bin DEFAULT NULL COMMENT '修改者',
  `datetime_modify` timestamp NULL DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='基础表';

-- --------------------------------------------------------

--
-- 表的结构 `sys_global_config`
--

DROP TABLE IF EXISTS `sys_global_config`;
CREATE TABLE IF NOT EXISTS `sys_global_config` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `code` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '编码',
  `name` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '名称',
  `memo` varchar(100) COLLATE utf8_bin NOT NULL COMMENT '说明',
  `operator_create` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT 'system' COMMENT '创建者',
  `datetime_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `operator_modify` varchar(10) COLLATE utf8_bin DEFAULT NULL COMMENT '修改者',
  `datetime_modify` timestamp NULL DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='系统配置表';

-- --------------------------------------------------------

--
-- 表的结构 `sys_module`
--

DROP TABLE IF EXISTS `sys_module`;
CREATE TABLE IF NOT EXISTS `sys_module` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `code` varchar(30) COLLATE utf8_bin NOT NULL COMMENT '模块code',
  `name` varchar(30) COLLATE utf8_bin NOT NULL COMMENT '模块名',
  `datetime_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='系统模块表';

-- --------------------------------------------------------

--
-- 表的结构 `sys_role`
--

DROP TABLE IF EXISTS `sys_role`;
CREATE TABLE IF NOT EXISTS `sys_role` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `code` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '角色code',
  `name` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '角色名',
  `operator_create` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT 'system' COMMENT '创建者',
  `datetime_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建日期',
  `operator_modify` varchar(10) COLLATE utf8_bin DEFAULT NULL COMMENT '修改者',
  `datetime_modify` timestamp NULL DEFAULT NULL COMMENT '修改日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='角色表';

--
-- 转存表中的数据 `sys_role`
--

INSERT INTO `sys_role` (`id`, `code`, `name`, `operator_create`, `datetime_create`, `operator_modify`, `datetime_modify`) VALUES
(1, 'admin', '管理员', 'system', '2016-08-07 13:28:18', NULL, NULL),
(2, 'normal', '普通用户', 'system', '2016-08-07 13:28:02', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `sys_role_permission`
--

DROP TABLE IF EXISTS `sys_role_permission`;
CREATE TABLE IF NOT EXISTS `sys_role_permission` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `role_id` int(10) UNSIGNED NOT NULL COMMENT '角色ID',
  `permission_id` int(10) UNSIGNED NOT NULL COMMENT '权限ID',
  `datetime_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='角色权限关联表';

-- --------------------------------------------------------

--
-- 表的结构 `tmp_permission`
--

DROP TABLE IF EXISTS `tmp_permission`;
CREATE TABLE IF NOT EXISTS `tmp_permission` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `code` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '权限编码',
  `name` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '权限名称',
  `operator_create` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT 'system' COMMENT '创建者',
  `datetime_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建日期',
  `operator_modify` varchar(10) COLLATE utf8_bin DEFAULT NULL COMMENT '修改者',
  `datetime_modify` timestamp NULL DEFAULT NULL COMMENT '修改日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='权限表';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
