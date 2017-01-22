<?php
class EnumErrorMsg{
	const SQL_EXECUTE = '绑定预处理SQL语句并执行时出错，建议检查属性类型是否合法，另外如果没有开启自动属性校正，建议检查实体对象中是否包含了数据表列字段之外的额外属性';

	const ATTR_TYPE_ARRARY = '映射列字段的实体属性值类型不能为数组';
	const ATTR_TYPE_OBJECT = '映射列字段的实体属性值类型不能为对象';
}
?>