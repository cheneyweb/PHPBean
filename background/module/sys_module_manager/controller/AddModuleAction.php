<?php
/* 定义基础路径和导入基础包，基础包内置Spring工厂的初始化，以及模块spring.xml文件的载入 */
define ( 'BASEURL', '../../../../' );
include_once BASEURL . 'background/frame/util/package.php';

// 根路径，模块名称，Action名称
import ( 'sys_module_manager', 'addModuleAction' );
class AddModuleAction {
	public $struts;
	public $moduleManagerValidate;
	public $moduleManagerService;
	public $tableToEntity;

	// 执行体
	public function execute() {
		// 入参数据
		$path = '../../'; // 功能模块根路径
		$exampleModulePrefix = 'sys'; // 模板模块前缀
		$exampleModuleName = 'example'; // 模板模块名称

		// 新模块数据
		$entity = $this->struts->genEntity (); // 新模块对象
		// 入参校验
		$checkResult = $this->moduleManagerValidate->checkEntity ( $entity );
		if ($checkResult['respMsg'] != 'Y') {
			echo json_encode ( $checkResult, JSON_UNESCAPED_UNICODE );
			return;
		}
		$tablePrefix = $entity->code; // 新模块前缀
		$tableName = $entity->name; // 新模块名

		// 创建新模块PHP代码
		self::createPHP ( $path, $exampleModulePrefix, $exampleModuleName, $tablePrefix, $tableName );
		// 生成HTML文件
		self::createHTML ( $path, $exampleModulePrefix, $exampleModuleName, $tablePrefix, $tableName );
		// 生成SQL文件
		self::createSQL ( $path, $exampleModulePrefix, $exampleModuleName, $tablePrefix, $tableName );
		// 生成模块菜单链接
		self::editUrlFile ( $path . '../../foreground/module/layout/common/left_module.html', $exampleModuleName, $tablePrefix, $tableName );
		// 保存模块
		$this->moduleManagerService->save ( $entity );

		echo json_encode ( $checkResult, JSON_UNESCAPED_UNICODE );
	}

	/**
	 * 创建新模块PHP代码
	 *
	 * @param unknown $path 功能模块根路径
	 * @param unknown $exampleModulePrefix 模板模块前缀
	 * @param unknown $exampleModuleName 模板模块名
	 * @param unknown $tablePrefix 新模块前缀
	 * @param unknown $tableName 新模块名
	 * @return boolean
	 */
	function createPHP($path, $exampleModulePrefix, $exampleModuleName, $tablePrefix, $tableName) {
		// 将模版模块复制成新模块
		$exampleModulePath = $path . $exampleModulePrefix . '_' . $exampleModuleName;	// 模板模块完整路径
		$newMoudlePath = $path . $tablePrefix . '_' . $tableName;						// 新模块完整路径
		recurse_copy ( $exampleModulePath, $newMoudlePath );
		// 根据模块名称编辑模块文件
		self::editModuleFile ( $newMoudlePath . '/config/spring.xml', $exampleModulePrefix, $exampleModuleName, $tablePrefix, $tableName);
		self::editModuleFile ( $newMoudlePath . '/config/plugin.xml', $exampleModulePrefix, $exampleModuleName, $tablePrefix, $tableName );
		self::editModuleFile ( $newMoudlePath . '/controller/AddExampleAction.php', $exampleModulePrefix, $exampleModuleName, $tablePrefix, $tableName );
		self::editModuleFile ( $newMoudlePath . '/controller/DeleteExampleAction.php', $exampleModulePrefix, $exampleModuleName, $tablePrefix, $tableName );
		self::editModuleFile ( $newMoudlePath . '/controller/UpdateExampleAction.php', $exampleModulePrefix, $exampleModuleName, $tablePrefix, $tableName );
		self::editModuleFile ( $newMoudlePath . '/view/ExampleView.php', $exampleModulePrefix, $exampleModuleName, $tablePrefix, $tableName );
		self::editModuleFile ( $newMoudlePath . '/view/AddExampleView.php', $exampleModulePrefix, $exampleModuleName, $tablePrefix, $tableName );
		self::editModuleFile ( $newMoudlePath . '/view/UpdateExampleView.php', $exampleModulePrefix, $exampleModuleName, $tablePrefix, $tableName );
		self::editModuleFile ( $newMoudlePath . '/view/ExampleDetailView.php', $exampleModulePrefix, $exampleModuleName, $tablePrefix, $tableName );
		self::editModuleFile ( $newMoudlePath . '/dao/ExampleDao_SQL.xml', $exampleModulePrefix, $exampleModuleName, $tablePrefix, $tableName );
		self::editModuleFile ( $newMoudlePath . '/dao/ExampleDao.php', $exampleModulePrefix, $exampleModuleName, $tablePrefix, $tableName );
		self::editModuleFile ( $newMoudlePath . '/entity/Example.php', $exampleModulePrefix, $exampleModuleName, $tablePrefix, $tableName );
		self::editModuleFile ( $newMoudlePath . '/plugin/ExamplePlugin.php', $exampleModulePrefix, $exampleModuleName, $tablePrefix, $tableName );
		self::editModuleFile ( $newMoudlePath . '/service/ExampleService.php', $exampleModulePrefix, $exampleModuleName, $tablePrefix, $tableName );
		self::editModuleFile ( $newMoudlePath . '/validate/ExampleValidate.php', $exampleModulePrefix, $exampleModuleName, $tablePrefix, $tableName );
	}

	/**
	 * 创建新模块HTML代码
	 *
	 * @param unknown $path 功能模块根路径
	 * @param unknown $exampleModulePrefix 模板模块前缀
	 * @param unknown $exampleModuleName 模板模块名
	 * @param unknown $tablePrefix 新模块前缀
	 * @param unknown $tableName 新模块名
	 * @return boolean 返回结果
	 */
	function createHTML($path, $exampleModulePrefix, $exampleModuleName, $tablePrefix, $tableName) {
		// 入参数据
		$indexPath = $path . $tablePrefix . '_' . $tableName;						// 功能模块根路径
		$exampleDir = $indexPath . '/' . $exampleModulePrefix . '_' . $exampleModuleName;	// 模板模块路径
		$newModuleDir = $indexPath . '/' . $tablePrefix . '_' . $tableName;				// 新模块路径
		// 创建新模块文件夹
		mkdir ( $newModuleDir );
		// 获取表字段信息
		$columnsInfo = $this->tableToEntity->getColumnsInfo ( $tablePrefix . '_' . $tableName );
		// 编辑HTML文件及重命名
		self::editHTMLFile ( $exampleDir . '/example.html', $exampleModulePrefix, $exampleModuleName, $tablePrefix, $tableName, $columnsInfo );
		self::editHTMLFile ( $exampleDir . '/example_detail.html', $exampleModulePrefix, $exampleModuleName, $tablePrefix, $tableName, $columnsInfo );
		self::editHTMLFile ( $exampleDir . '/example_add.html', $exampleModulePrefix, $exampleModuleName, $tablePrefix, $tableName, $columnsInfo );
		self::editHTMLFile ( $exampleDir . '/example_edit.html', $exampleModulePrefix, $exampleModuleName, $tablePrefix, $tableName, $columnsInfo );
		// 删除模板文件夹
		rmdir ( $exampleDir );
		// 将HTML文件模块移动到foreground
		recurse_copy ( $newModuleDir, $path . '../../foreground/module/' . $tablePrefix . '_' . $tableName );
		recurse_delete ( $newModuleDir );
	}

	/**
	 * 创建新模块SQL代码
	 *
	 * @param unknown $path 功能模块根路径
	 * @param unknown $exampleModulePrefix 模板模块前缀
	 * @param unknown $exampleModuleName 模板模块名
	 * @param unknown $tablePrefix 新模块前缀
	 * @param unknown $tableName 新模块名
	 * @return boolean
	 */
	function createSQL($path, $exampleModulePrefix, $exampleModuleName, $tablePrefix, $tableName) {
		// 获取表所有字段名,修改实体和SQL文件
		$fields = $this->tableToEntity->getFieldNames ( $tablePrefix . '_' . $tableName );

		$newModuleDir = $path . $tablePrefix . '_' . $tableName;

		self::editEntityFile ( $newModuleDir . '/entity/' . formatJavaStyle ( $tableName, false ) . '.php', $fields );
		self::editSQLFile ( $newModuleDir . '/dao/' . formatJavaStyle ( $tableName, false ) . 'DAO_SQL.xml', $fields, $exampleModuleName, $tablePrefix . '_', $tableName );
	}

	/**
	 * 编辑模块文件
	 *
	 * @param unknown $file 需要编辑的文件
	 * @param unknown $exampleModulePrefix 模板模块前缀
	 * @param unknown $exampleModuleName 模板模块名
	 * @param unknown $tablePrefix 新模块前缀
	 * @param unknown $tableName 新模块名
	 * @return boolean 返回结果
	 */
	function editModuleFile($file, $exampleModulePrefix, $exampleModuleName, $tablePrefix, $tableName) {
		$content = file_get_contents ( $file );
		if (! $content) {
			return false;
		}
		// 格式化模块名称
		$exampleName1 = '__' . $exampleModuleName; 				// 全小写，下划线间隔[__example]
		$exampleName2 = '_' . $exampleModuleName; 				// 驼峰法，首字母小写[_example]
		$exampleName3 = '_' . ucfirst ( $exampleModuleName ); 	// 驼峰法，首字母大写[_Example]
		$exampleName4 = '__noprefix' . $exampleModuleName;		// 全小写，下划线间隔(无前缀)[__noprefixexample]

		$moduleName1 = $tablePrefix . '_' .$tableName; 			// 全小写，下划线间隔
		$moduleName2 = formatJavaStyle ( $tableName, false ); 	// 驼峰法，首字母小写
		$moduleName3 = formatJavaStyle ( $tableName, true ); 	// 驼峰法，首字母大写
		$moduleName4 = $tableName;								// 全小写，下划线间隔(无前缀)

		$content = str_replace ( $exampleName1, $moduleName1, $content );
		$content = str_replace ( $exampleName2, $moduleName2, $content );
		$content = str_replace ( $exampleName3, $moduleName3, $content );
		$content = str_replace ( $exampleName4, $moduleName4, $content );
		$content = str_replace ( '$_tablePrefix', $tablePrefix, $content );
		// 写入文件
		file_put_contents ( $file, $content );
		// 重命名文件
		rename ( $file, str_replace ( ucfirst ( $exampleModuleName ), $moduleName3, $file ) );
	}

	/**
	 * 编辑模块界面文件
	 *
	 * @param unknown $file 需要编辑的文件
	 * @param unknown $exampleModulePrefix 模板模块前缀
	 * @param unknown $exampleModuleName 模板模块名
	 * @param unknown $tablePrefix 新模块前缀
	 * @param unknown $tableName 新模块名
	 * @param unknown $columnsInfo 表字段信息
	 * @return boolean 返回结果
	 */
	function editHTMLFile($file, $exampleModulePrefix, $exampleModuleName, $tablePrefix, $tableName, $columnsInfo) {
		$content = file_get_contents ( $file );
		if (! $content) {
			return false;
		}
		// 格式化模块名称
		$exampleName1 = '__' . $exampleModuleName; 				// 全小写，下划线间隔[__example]
		$exampleName2 = '_' . $exampleModuleName; 				// 驼峰法，首字母小写[_example]
		$exampleName3 = '_' . ucfirst ( $exampleModuleName ); 	// 驼峰法，首字母大写[_Example]
		$exampleName4 = '__noprefix' . $exampleModuleName;		// 全小写，下划线间隔(无前缀)[__noprefixexample]
		$exampleName5 = '_prefix' . $exampleModuleName;			// 驼峰法，有前缀[_prefixexample]

		$moduleName1 = $tablePrefix . '_' .$tableName; 			// 全小写，下划线间隔
		$moduleName2 = formatJavaStyle ( $tableName, false ); 	// 驼峰法，首字母小写
		$moduleName3 = formatJavaStyle ( $tableName, true ); 	// 驼峰法，首字母大写
		$moduleName4 = $tableName;								// 全小写，下划线间隔(无前缀)
		$moduleName5 = formatJavaStyle ( $tablePrefix . '_' . $tableName, false ); 	// 驼峰法，首字母小写(有前缀)

		$content = str_replace ( $exampleName1, $moduleName1, $content );
		$content = str_replace ( $exampleName2, $moduleName2, $content );
		$content = str_replace ( $exampleName3, $moduleName3, $content );
		$content = str_replace ( $exampleName4, $moduleName4, $content );
		$content = str_replace ( $exampleName5, $moduleName5, $content );

		// 写入字段
		$fieldThs = '';
		$fieldTds = '';
		$fieldTrs = '';
		$fieldDivs = '';
		$fieldDivEdits = '';

		foreach ( $columnsInfo as $column ) {
			// 主键ID不做处理
			if ($column ['Field'] == 'id') {
				continue;
			}
			// 列表页
			$fieldThs = $fieldThs . "\r\n\t\t\t" . '<th>' . $column ['Comment'] . '</th>';
			$fieldTds = $fieldTds . "\r\n\t\t\t" . '<td>{{item.' . $column ['Field'] . '}}</td>';
			// 详情页
			$fieldTrs = $fieldTrs . "\r\n\t" . '<tr>' . "\r\n\t\t" . '<th class="col-sm-3">' . $column ['Comment'] . '</th>' . "\r\n\t\t" . '<td>{{entity.' . formatJavaStyle($column ['Field'],false) . '}}</td>' . "\r\n\t" . '</tr>';
			// 新增页
			if ($column ['Field'] != 'datetime_create' && $column ['Field'] != 'datetime_modify' && $column ['Field'] != 'operator_create' && $column ['Field'] != 'operator_modify') {
				$fieldDivs = $fieldDivs . "\r\n\t\t" . '<div class="col-sm-4">' . "\r\n\t\t\t" . '<div class="input-group">' . "\r\n\t\t\t\t" . '<div class="input-group-addon">' . $column ['Comment'] . '</div>' . "\r\n\t\t\t\t" . '<input type="text" class="form-control" '.'v-model="entity.'.formatJavaStyle($column ['Field'],false).'"/>' . "\r\n\t\t\t" . '</div>' . "\r\n\t\t" . '</div>';
			}
			// 编辑页
			if ($column ['Field'] != 'datetime_create' && $column ['Field'] != 'datetime_modify' && $column ['Field'] != 'operator_create' && $column ['Field'] != 'operator_modify') {
				$fieldDivEdits = $fieldDivEdits . "\r\n\t\t" . '<div class="col-sm-4">' . "\r\n\t\t\t" . '<div class="input-group">' . "\r\n\t\t\t\t" . '<div class="input-group-addon">' . $column ['Comment'] . '</div>' . "\r\n\t\t\t\t" . '<input type="text" class="form-control" v-model="entity.'.formatJavaStyle($column ['Field'],false). '"/>' . "\r\n\t\t\t" . '</div>' . "\r\n\t\t" . '</div>';
			}
		}
		$content = str_replace ( '<th></th>', $fieldThs, $content );
		$content = str_replace ( '<td></td>', $fieldTds, $content );
		$content = str_replace ( '<tr></tr>', $fieldTrs, $content );
		$content = str_replace ( '<div></div>', $fieldDivs, $content );
		$content = str_replace ( '<divEdit></divEdit>', $fieldDivEdits, $content );

		// 写入文件
		file_put_contents ( $file, $content );
		$newFile = str_replace ( $exampleModuleName, $moduleName4, $file );
		$newFile = str_replace ( $exampleModulePrefix.'_', $tablePrefix.'_', $newFile );
		// 重命名文件
		rename ( $file, $newFile );
	}

	/**
	 * 修改实体文件
	 *
	 * @param unknown $file 需要修改的文件
	 * @param unknown $fields 表字段信息
	 * @return boolean
	 */
	function editEntityFile($file, $fields) {
		$content = file_get_contents ( $file );
		if (! $content) {
			return false;
		}
		$fieldStr = '';
		foreach ( $fields as $field ) {
			$fieldStr .= "\t" . 'public ';
			$fieldStr .= '$' . formatJavaStyle ( $field, false ) . ';' . "\r\n";
		}

		$content = str_replace ( 'public $_extendsFields;', $fieldStr, $content );
		// 写入文件
		file_put_contents ( $file, $content );
	}

	/**
	 * 修改SQL文件
	 *
	 * @param unknown $file 需要修改的文件
	 * @param unknown $fields 表字段信息
	 * @param unknown $exampleModuleName 模板模块名
	 * @param unknown $tablePrefix 新模块前缀
	 * @param unknown $tableName 新模块名
	 * @return boolean
	 */
	function editSQLFile($file, $fields, $exampleModuleName, $tablePrefix, $tableName) {
		$content = file_get_contents ( $file );
		if (! $content) {
			return false;
		}
		$fieldStr = '';
		$fieldStrWithPrefix = '';
		$i = 1;
		foreach ( $fields as $field ) {
			if ($i < count ( $fields )) {
				$fieldStr .= "\t\t" . formatPHPStyle ( $field, false ) . ',' . "\r\n";
				$fieldStrWithPrefix .= "\t\t" . formatPHPStyle ( $tablePrefix . '__example.' . $field, false ) . ',' . "\r\n";
			} else {
				$fieldStr .= "\t\t" . formatPHPStyle ( $field, false );
				$fieldStrWithPrefix .= "\t\t" . formatPHPStyle ( $tablePrefix . '__example.' . $field, false );
			}
			$i ++;
		}

		$fieldWhereStr = '';
		$fieldWhereStrWithPrefix = '';
		$i = 1;
		foreach ( $fields as $field ) {
			$fieldWhereStr .= "\t\t" . '<isNotEmpty property="';
			$fieldWhereStr .= formatJavaStyle ( $field, false ) . '">';
			$fieldWhereStr .= 'and ' . $field . '=:' . formatJavaStyle ( $field, false );
			$fieldWhereStr .= '</isNotEmpty>';

			$fieldWhereStrWithPrefix .= "\t\t" . '<isNotEmpty property="';
			$fieldWhereStrWithPrefix .= formatJavaStyle ( $field, false ) . '">';
			$fieldWhereStrWithPrefix .= 'and ' . $tablePrefix . '__example.' . $field . '=:' . formatJavaStyle ( $field, false );
			$fieldWhereStrWithPrefix .= '</isNotEmpty>';

			if ($i < count ( $fields )) {
				$fieldWhereStr .= "\r\n";
				$fieldWhereStrWithPrefix .= "\r\n";
			} else {
			}
			$i ++;
		}

		$content = str_replace ( '$_extends_fields', $fieldStr, $content );
		$content = str_replace ( '$_extends_where', $fieldWhereStr, $content );
		$content = str_replace ( '$_extends_prefix_fields', $fieldStrWithPrefix, $content );
		$content = str_replace ( '$_extends_prefix_where', $fieldWhereStrWithPrefix, $content );

		// 格式化模块名称为
		$exampleName1 = '__' . $exampleModuleName; 				// 全小写，下划线间隔[__example]
		$exampleName2 = '_' . $exampleModuleName; 				// 驼峰法，首字母小写[_example]
		$exampleName3 = '_' . ucfirst ( $exampleModuleName ); 	// 驼峰法，首字母大写[_Example]

		$moduleName1 = $tableName; 								// 全小写，下划线间隔
		$moduleName2 = formatJavaStyle ( $tableName, false ); 	// 驼峰法，首字母小写
		$moduleName3 = formatJavaStyle ( $tableName, true ); 	// 驼峰法，首字母大写

		$content = str_replace ( $exampleName1, $moduleName1, $content );
		$content = str_replace ( $exampleName2, $moduleName2, $content );
		$content = str_replace ( $exampleName3, $moduleName3, $content );

		// 写入文件
		file_put_contents ( $file, $content );
	}

	/**
	 * 编辑菜单文件
	 *
	 * @param unknown $file 需要修改的文件
	 * @param unknown $exampleModuleName 模版模块名
	 * @param unknown $tablePrefix 新模块前缀
	 * @param unknown $tableName 新模块名
	 * @return boolean
	 */
	function editUrlFile($file, $exampleModuleName, $tablePrefix, $tableName) {
		$content = file_get_contents ( $file );
		if (! $content) {
			return false;
		}
		// 格式化模块名称
		$exampleName1 = '__' . $exampleModuleName; 				// 全小写，下划线间隔[__example]
		$exampleName2 = '_' . $exampleModuleName; 				// 驼峰法，首字母小写[_example]
		$exampleName3 = '_' . ucfirst ( $exampleModuleName ); 	// 驼峰法，首字母大写[_Example]
		$exampleName4 = '__noprefix' . $exampleModuleName;		// 全小写，下划线间隔(无前缀)[__noprefixexample]

		$moduleName1 = $tablePrefix . '_' . $tableName; 		// 全小写，下划线间隔
		$moduleName2 = formatJavaStyle ( $tableName, false ); 	// 驼峰法，首字母小写
		$moduleName3 = formatJavaStyle ( $tableName, true ); 	// 驼峰法，首字母大写
		$moduleName4 = $tableName;								// 全小写，下划线间隔(无前缀)

		$content = str_replace ( '<!-- $_moduleUrl -->', '<li><a href="javascript:showHtml(\'__example\',\'__noprefixexample.html\')">_Example管理</a></li>' . "\r\n\t\t\t\t" . '<!-- $_moduleUrl -->', $content );
		$content = str_replace ( $exampleName1, $moduleName1, $content );
		$content = str_replace ( $exampleName2, $moduleName2, $content );
		$content = str_replace ( $exampleName3, $moduleName3, $content );
		$content = str_replace ( $exampleName4, $moduleName4, $content );
		// 写入文件
		file_put_contents ( $file, $content );
	}
}
?>
