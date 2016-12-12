// 操作选中项
// 模块名称
// action名称
function operateSelectedItem(moduleName, actionName){
	if(window.confirm('确认操作')){
		var action = '../../../../background/module/' + moduleName + '/controller/' + actionName + '.php';
		// 获取所有选中项
		var selectItems = new Array();
		$("input[name='"+formatJavaStyle(moduleName)+"Item']:checked").each(function(){
			selectItems.push($(this).prop('value'));
		});
		if(selectItems.length == 0){
			alert('请先选中需要操作项');
			return;
		}
		// 异步操作选中项
		$.ajax({
			url : action,
			type : 'POST',
			data : {ids:selectItems},
			success : function(response) {
				response = response.replace(/\s/g, '');
				if (response == 'Y') {
					$('#queryBtn').click();
				} else {
					alert(response);
				}
			}
		});
	}
}

// AJAX异步提交表单（刷新当前页面）
// 表单ID
// 模块名称
// Action名称
// Modal名称
// 成功回调
// 失败回调
function formModuleActionModal(formId,moduleName,actionName,modalId,ycallback,ncallback) {
	var action = '../../../../background/module/' + moduleName + '/controller/' + actionName + '.php';
	$('#'+formId).ajaxSubmit({
		url : action,
		success : function(data) {
			newData = data.replace(/\s/g, '');
			if (newData == 'Y') {
				$('#'+modalId).modal('hide');
				if(ycallback != null){
					ycallback();
				}
			} else {
				if(ncallback != null){
					ncallback();
				}else{
					alert(data);
				}
			}
		}
	});
}
// AJAX异步提交表单(跳转新页面)
// 表单ID
// 模块名称
// Action名称
// View名称
// 是否需要确认对话框
function formModuleActionView(formId,moduleName,actionName,viewName,isNeedConfirm) {
	var action = '../../../../background/module/' + moduleName + '/controller/' + actionName + '.php';
	$('#'+formId).ajaxSubmit({
		url : action,
		success : function(data) {
			newData = data.replace(/\s/g, '');
			if (newData == 'Y') {
				showView(moduleName,viewName,isNeedConfirm);
			} else {
				alert(data);
			}
		}
	});
}

//选中/取消选择全部复选框
//当前对象
//模块名称
function selectAll(thisObj,moduleName){
 if($(thisObj).prop('checked') == true){
     $("input[name='"+formatJavaStyle(moduleName)+"Item']").prop('checked',true);
 }else{
     $("input[name='"+formatJavaStyle(moduleName)+"Item']").prop('checked',false);
 }
}

//删除子选项
function deleteSelectItem(){
	$("input[name='selectItem']:checked").each(function(){
		$(this).parent().parent().remove();
	});
	$('#checkboxAll').prop('checked',false);
}