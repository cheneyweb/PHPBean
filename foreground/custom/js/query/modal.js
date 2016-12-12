//普通编辑框弹出显示
//modal名称
//模块名称
//action名称
//编辑项ID
function updateModal(modalId,moduleName,actionName,itemId,ycallback,ncallback){
	// 更换提交按钮
	$('#updateBtn').show();
	$('#addBtn').hide();
	// 修改主题文字
	$('#'+modalId+'Label').html($('#'+modalId+'Label').html().replace('新增','编辑'));
	// 获取当前值
	var action = '../../../../background/module/' + moduleName + '/controller/' + actionName + '.php';
	$.ajax({
		url : action,
		type : 'POST',
		data : {itemId:itemId},
		success : function(response) {
			try{
				var dataObj = eval("("+response+")");
				for (key in dataObj){
					$('#'+modalId + " input[name='" + formatJavaStyle(key) + "']").val(dataObj[key]);
					$('#'+modalId + " select[name='" + formatJavaStyle(key) + "']").val(dataObj[key]);
				}
				if(ycallback != null){
					ycallback();
				}
			}catch(e){
				if(ncallback != null){
					ncallback();
				}else{
					alert(response);
				}
			}
		}
	});
	// 显示更新弹出框
	$('#'+modalId).modal();
}

// 展示弹出选择框
function showModal(modalId,moduleName,viewName,obj){
	itemObj = obj;
	$('div[id$="Content"]').each(function(){
		if($(this).attr('id') != modalId+'Content'){
			$(this).html('');
		}
	});
	// 隐藏弹出框
	$('#'+modalId).modal('hide');
	// 获取列表页面，并对其修饰
	$('#'+modalId+'Content').load("../../../../background/module/"+ moduleName +"/view/"+ viewName +".php",getFormJson('#queryForm'),function(){
		$('#'+modalId+'Content').find("button:contains('新增'),button:contains('删除')").remove();// 去掉删除按钮
		$('#'+modalId+'Content tr').find("th:last,td:last").remove();// 去掉最后一列操作列
		
		$('#'+modalId+'Content').find("button:contains('查询')").attr('onclick', 'javascript:showModal("'+modalId+'","'+moduleName+'","'+viewName+'")');
		
		$('#'+modalId+'Content' + ' .sub-header').remove();// 去掉标题
		$('#datetimequery').remove();
		
		// 显示更新弹出框
		$('#'+modalId).removeData("bs.modal");
		$('#'+modalId).modal('show');
	});
}

// 展示详情页面
function showDetailModal(modalId,moduleName,viewName,itemId,ycallback){
	// 清空其他的弹窗div的内容
	$('div[id$="Content"]').each(function(){
		if($(this).attr('id') != modalId+'Content'){
			$(this).html('');
		}
	});
	// 隐藏详情弹出框
	$('#'+modalId).modal('hide');
	// 获取列表页面，并对其修饰
	$('#'+modalId+'Content').load("../../../../background/module/"+ moduleName +"/view/"+ viewName +".php",{'code':itemId},function(){
		$('#'+modalId+'Content').find("button:contains('返回')").remove();// 去掉返回按钮
		$('#'+modalId+'Content' + ' .sub-header').remove();// 去掉标题
		if(ycallback != null){
			ycallback();
		}
		// 显示详情弹出框
		$('#'+modalId).modal('show');
	});
}

//表单编辑框显示
function updateFormModal(formId,modalId,moduleName,actionName,itemId){
	// 更换提交按钮
	$('#updateBtn').show();
	$('#addBtn').hide();
	// 修改主题文字
	$('#'+modalId+'Label').html($('#'+modalId+'Label').html().replace('新增','编辑'));
	// 获取当前值
	var action = '../../../../background/module/' + moduleName + '/controller/' + actionName + '.php';
	if(formId == null){
		formId = 'addForm';
	}
	$.ajax({
		url : action,
		type : 'POST',
		data : {itemId:itemId},
		success : function(response) {
			try{
				var dataObj = eval("("+response+")");
				for (key in dataObj){
					$("#"+ formId + " input[name='" + formatJavaStyle(key) + "']").val(dataObj[key]);
					$("#"+ formId + " select[name='" + formatJavaStyle(key) + "']").val(dataObj[key]);
				}
			}catch(e){
				alert(response);
			}
		}
	});
	// 显示更新弹出框
	$('#'+modalId).modal();
}