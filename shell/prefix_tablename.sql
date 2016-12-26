CREATE TABLE IF NOT EXISTS `sys_example` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `code` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '编码',
  `name` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '名称',
  `operator_create` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT 'system' COMMENT '创建者',
  `datetime_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `operator_modify` varchar(10) COLLATE utf8_bin NULL DEFAULT NULL COMMENT '修改者',
  `datetime_modify` timestamp NULL DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='基础表';