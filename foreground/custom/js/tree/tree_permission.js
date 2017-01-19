var setting = {
		check: {
			enable: true,
			chkboxType: { 'Y' : 'ps', 'N' : 'ps' }
		},
		data: {
			simpleData: {
				enable: true
			}
		},
		callback:{
            onCheck:onCheck
        }
};
var zNodes =[
	{ id:1, pId:0, name:'模块管理'},
	{ id:2, pId:0, name:'系统管理'},
		{ id:21, pId:2, name:'账户管理'},
			{ id:211, pId:21, name:'查看'},
			{ id:212, pId:21, name:'新增'},
			{ id:213, pId:21, name:'修改'},
			{ id:214, pId:21, name:'删除'},
		{ id:22, pId:2, name:'角色管理'},
			{ id:221, pId:22, name:'查看'},
			{ id:222, pId:22, name:'新增'},
			{ id:223, pId:22, name:'修改'},
			{ id:224, pId:22, name:'删除'},
];
//点击触发
function onCheck(e,treeId,treeNode){
	var treeObj=$.fn.zTree.getZTreeObj('treePermission');
	var checkedNodes=treeObj.getCheckedNodes(true);
	var checkedCodes = null;
	for(var i=0; i < checkedNodes.length; i++) {
		checkedCodes += checkedNodes[i].id;
		if(i != checkedNodes.length -1){
			checkedCodes += ',';
		}
	}
	$('#permissionIds').val(checkedCodes);
}
//获取选中节点的值
function getCheckedCodes(){
	var treeObj = $.fn.zTree.getZTreeObj('treePermission');
	var checkedNodes = treeObj.getCheckedNodes(true);
	var checkedCodes = '';
	for(var i=0; i < checkedNodes.length; i++) {
		checkedCodes += checkedNodes[i].id;
		if(i != checkedNodes.length -1){
			checkedCodes += ',';
		}
	}
	return checkedCodes;
}
//勾选传入的节点
function checkNode(hiddenInputId,treeId){
	if(hiddenInputId == null){
		hiddenInputId = 'permissionIds';
	}
	if(treeId == null){
		treeId = 'treePermission';
	}
	if($('#'+hiddenInputId).val().length > 0){
		var treeObj=$.fn.zTree.getZTreeObj(treeId);
		var ids = $('#'+hiddenInputId).val().split(',');
		for(i = 0; i < ids.length; i++ ) {
			treeObj.checkNode(treeObj.getNodeByParam('id',ids[i]), true );
		}
	}
}
