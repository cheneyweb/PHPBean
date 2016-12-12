// 显示普通页面
function showView(moduleName,viewName,isNeedConfirm) {
	if(isNeedConfirm){
		$('div[id$="Modal"]').modal('hide');
		alert('操作成功');
	}
	//var start = new Date().getTime();//起始时间
	$('#content').load("../../../../background/module/"+ moduleName +"/view/"+ viewName +".php",function(){
		afterViewLoad();
		//var end = new Date().getTime();//接受时间
	    //alert(end - start);//返回函数执行需要时间
	});
}

// 显示详情页面
function showDetailView(moduleName,viewName,id) {
	$('#content').load("../../../../background/module/"+ moduleName +"/view/"+ viewName +".php",{"id":id},function(){
		afterViewLoad();
	});
}

// 显示编辑页面
function updateView(moduleName,viewName,itemId){
	$('#content').load("../../../../background/module/"+ moduleName +"/view/"+ viewName +".php",{"itemId":itemId},function(){
		afterViewLoad();
	});
}
