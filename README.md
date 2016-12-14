# PHPBean
整个框架划分两大部分——“前端”和“后台”,PHP的开发者们不需要再羡慕Java上的各种优秀的框架的便捷性了，在PHPBean这个框架中，尝试尽所有可能地把Java Web的开发思想引入PHP，主体思想为MVC+MVVM，包括struts,mybatis,spring的引入（使用PHP来实现），例如强制规范使用Bean作为数据传输单位，例如规范的文件夹分类和文件命名。这个框架的开发灵感来源于Magento框架和Java的多种开源框架，在他们的基础上加以理解和重组。PS:纯MVVM架构的PHPBean-MVVM框架也已经在开发中...

使用说明
>
	1,数据库配置
		数据库连接:PDOUtil.php
		数据表前缀:模块中的entity中设置$tablePrefix
	2,基于shell文件夹中的phpbean.sql创建数据库
	3,使用模块管理功能创建新模块(输入表前缀和表名)

命名规则
>
	文件相关：
		文件夹:下划线，全小写
		文件名:驼峰法，根据是否是类而决定是否首字母【大】写
	后台代码：
		类名：驼峰法，首字母【大】写
		方法名：驼峰法，首字母小写
		变量名：驼峰法，首字母小写
		常量名：下划线，全【大】写
		SQL输出：下划线，全小写
	前台代码：
		元素id：驼峰法，首字母小写
		元素name:驼峰法，首字母小写
	数据库相关：
		表名：下划线，全小写
		字段名：下划线，全小写
	
前后台交互API
>
	表单行为：
		// AJAX异步提交表单（刷新当前页面）[表单ID，模块名，Action名，弹窗ID]
		formModuleActionModal(formId,moduleName,actionName,modalId,ycallback,ncallback)
		// AJAX异步提交表单(跳转新页面)[表单ID，模块名，Action名，View名，是否需确认]
		formModuleActionView(formId,moduleName,actionName,viewName,isNeedConfirm)
	弹窗行为：
		// 显示编辑弹出框（弹窗编辑Bean对象）[弹窗ID，模块名，Action名，项目ID]
		updateModal(modalId,moduleName,actionName,itemId,ycallback,ncallback)
		// 展示弹出框[弹窗ID，模块名，View名]
		showModal(modalId,moduleName,viewName,obj)
		// 展示详情弹出框（弹窗快速展示详情信息）[弹窗ID，模块名，View名，项目ID]
		showDetailModal(modalId,moduleName,viewName,itemId,ycallback)

状态机API
>
	配置状态机XML：
		参考sys_module_manager/config/status.xml
	Plugin插件：
		插件返回结果为null视为该插件执行失败,否则前一个插件的返回结果将会作为下一个插件的执行入参
	第一步：导入状态机
		include_once BASEURL . 'background/module/module_manager/controller/StatusEngine.php'
	第二步：校验状态（$entity->status中设置下一个状态，其余属性设置查询条件，前置状态包含当前查询状态，则校验通过）[需要查询状态的对象]
		$checkResult = StatusEngine::changeStatus ( $entity )
	第三步：执行状态变更（$entity->status中设置下一个状态,$entity->id中设置数据对象id）[状态机插件传递参数,需要变更状态的对象]
		$changeResult = StatusEngine::changeStatus ( $inparam, $entity )
	
DAO层API
>
	系统封装：
		// 插入数据对象（id无须设值，自增长）[对象实体]
		$this->pDOUtil->insert ( $entity )
		// 删除数据对象（设置的属性是“与”查询关系）[对象实体]
		$this->pDOUtil->delete ( $entity )
		// 更新数据对象，NULL不更新（$query为null时，根据$entity的id更新）[对象实体，查询条件对象]
		$this->pDOUtil->update ( $entity , $query)
		// 更新数据对象，NULL也更新（$query为null时，根据$entity的id更新）[对象实体，查询条件对象]
		$this->pDOUtil->updateAll ( $entity , $query)
		// 查询数据对象数组（数组中的单个对象使用“.”来获取属性）[对象实体]
		$this->pDOUtil->queryArr ( $entity )
		// 查询单个数据对象（使用“['属性名']”来获取属性）[对象实体]
		$this->pDOUtil->queryObj ( $entity )
	用户自定义SQL：
		// 查询分页数据[对象实体]
		$this->myBatis->queryPage(__METHOD__,$obj)
		// 查询分页数量[对象实体]
		$this->myBatis->queryPageCount(__METHOD__,$obj)
		// 查询数据对象，通过对象作为查询条件[对象实体]
		$this->myBatis->queryObjByObj(__METHOD__,$obj)
		// 查询数据对象，通过参数列表作为查询条件[逗号间隔参数]
		$this->myBatis->queryObjByVars(__METHOD__,$args...)
		// 查询对象数组，通过对象作为查询条件[对象实体]
		$this->myBatis->queryObjArrByObj(__METHOD__,$obj)
		// 查询对象数组，通过参数列表作为查询条件[逗号间隔参数]
		$this->myBatis->queryObjArrByVars(__METHOD__,$args...)

Action层API
>
	返回结果：
		“Y”：执行成功
		“详细错误内容”：详细错误内容
	Add...Action.php使用案例：
		通过$entity = $this->struts->genEntity ()来获取需要新增的对象
	Delete...Action.php使用案例：
		通过$_POST ['ids']来获取需要删除的对象id
	Update...Action.php使用案例：
		通过$_POST ['itemId']来获取需要更新的对象id
	
框架层次
>
	视图层——这一层使用Smarty进行后端渲染,除了渲染工作在后端进行,本身前后端交互逻辑已经尽可能分离,唯一需要注意的是交互表单的属性有些许特殊要求（例如:表单需要添加隐藏域）
	控制层——这一层负责传输数据
	插件层——这一层与业务层同级,用于处理复杂多状态流转业务
	业务层——这一层负责业务处理
	数据层——这一次负责底层数据操作,目前已经封装好mysql和mongodb

后台
>
	全Spring化,对象实例化全部使用配置
	已实现数据库层封装,与struts对接,可自动将表单转为对象,再存入数据库相应表
	完善的dao层封装,增删改查等基础查询操作完全不再需要编写SQL
	实现Mybatis!可以自定义SQL,现在您可以在PHP上体验Mybatis的超灵活DAO开发
	安全模块已经实现正则表达式校验封装
	集成smarty3.1.4,现在可以实现前端代码与样式的彻底分离了

前端
>
	foreground——MVC前端框架(后端模板渲染,纯前端渲染项目参见PHPBean-MVVM)
	集成bootstrap3
	集成jquery2.0.3,不支持IE6,7,8
	集成ztree3.5.24
	实现JS封装,目前已经封装异步表单提交,异步页面加载
    frame文件夹放置目前成熟流行的前端框架
    custom文件夹可以放定制性的前端CSS或JS代码
    module文件夹放置模块的前端HTML代码

框架目录结构（后台）
>
    background——后台根目录
        frame——框架源文件
			dao——数据库封装
				mongo——mongo数据库封装
				pdo——pdo数据库封装，mysql数据库封装
			mybatis——mybatis框架的PHP实现
			security——安全封装
			struts——struts封装
			spring——spring封装
			smarty——smarty模版框架封装
			util——工具类集合
			webservice——外部API封装
		moudle——模块根目录
			sys_admin——系统用户模块（系统自带模块,用户可以自定义自己的模块）
				config——配置文件
					spring.xml——类对象注入配置文件
					plugin.xml——插件对象配置文件
				dao——数据库层代码集合（包括DAO和SQL）
					***Dao.php（数据层代码）
					***Dao_SQL.xml（SQL代码）
				entity——实体类集合（即对应Java中的POJO集合）
				controller——控制层（即对应Java中的Action集合）
				view——视图层（即对应JAVA中的View集合）
				plugin——插件层（状态机使用，分离逻辑与业务）
				service——业务层（即对应Java中的Service集合）
				validate——校验层（独立增加校验，防范XSS和SQL注入等攻击）
				webservice——外部API层(提高给APP等外部应用)
			sys_ajax——ajax演示模块
			sys_query——分页控件模块
			sys_moudle_manage——模块管理模块
				config
					status.xml——模块实体状态配置文件
				controller
					StatusEngine.php——状态机引擎
			sys_role——角色模块（系统自带模块，用于配置系统用户角色和其权限）
			sys_global_config——系统全局配置模块（系统自带模块，用于系统全局配置）
			sys_example——模版模块（用于模块生成）

框架目录结构（前台）
>
    foreground——前台根目录
        frame——框架源文件
        	bootstrap-datetimepicker
            bootstrap3
            jquery
            ztree
        custom——定制css和js
        	css——定制css
        	js——定制js
        		ajax
        		query
        			action.js(表单行为)
        			modal.js(弹窗行为)
        			query.js(查询行为)
        			show.js(页面行为)
        		runtime_validator
        		tree
        module——模块根目录
        	layout——布局模版
				common——通用模版
					header.html——HTML头文件
					nav.html——顶部导航
				left_module.html——模块管理左侧菜单
				left_system.html——系统管理左侧菜单
        	sys_admin——系统用户模块
			sys_ajax——ajax演示模块
			sys_module_manager——模块管理
			sys_query——分页查询控件
			sys_role——系统角色模块
	log——系统LOG
    shell——SQL备份
    	phpbean.sql(全库)
    	phpbean_tables.sql(全表)
    	prefix_tablename.sql(基础表SQL)
    index.php——站点主页

更新日志
>
	2016.05.28:全新2.0架构升级
	
	后续有待实现：全局系统配置，全局审核流
