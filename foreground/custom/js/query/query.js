//转化为Java变量风格
function formatJavaStyle(str){
	var a = str.split("_");
	var javaStyleStr = a[0];
	for(var i=1;i<a.length;i++){
		javaStyleStr = javaStyleStr + a[i].slice(0,1).toUpperCase() + a[i].slice(1);
	}
	return javaStyleStr;
}

// 分页选择
function selectPage(pageIndex){
	var queryCount = $('#queryCount').val();
	$('#queryBegin').val(pageIndex*queryCount);
	$('#queryBtn').click();
}

// 前一页
function previousPage(){
	var queryBegin = $('#queryBegin').val();
	var queryCount = $('#queryCount').val();
	if(queryBegin-queryCount >= 0){
		$('#queryBegin').val(queryBegin-queryCount);
		$('#queryBtn').click();
	}
}

// 后一页
function nextPage(){
	var queryBegin = $('#queryBegin').val();
	var queryCount = $('#queryCount').val();
	var pageCount = $('#pageCount').val();
	if(queryBegin / queryCount < pageCount-1 ){
		$('#queryBegin').val(queryBegin+queryCount);
		$('#queryBtn').click();
	}
}

//查询参数
function getFormJson(form) {
	var o = {};
	var a = $(form).serializeArray();
	$.each(a, function() {
		if (o[this.name] !== undefined) {
			if (!o[this.name].push) {
				o[this.name] = [ o[this.name] ];
			}
			o[this.name].push(this.value || '');
		} else {
			o[this.name] = this.value || '';
		}
	});
	return o;
}

// 查询表单
// 表单ID
// 模块名称
// view名称
function queryLoad(formName, moduleName, viewName) {
	$('#content').load("../../../../background/module/" + moduleName + "/view/" + viewName + ".php", getFormJson('#'+formName),function(){
		afterViewLoad();
	});
}

// 页面加载后执行
function afterViewLoad(){
	// 先清除日期控件
	$(".datetimepicker").not(":eq(0)").remove();
	$(".datetimepicker_start").not(":eq(0)").remove();
	$(".datetimepicker_start2").not(":eq(0)").remove();
	// 添加日期控件
    $('.datetimepicker').datetimepicker({
    	minView: "month", //选择日期后，不会再跳转去选择时分秒
    	format: "yyyy-mm-dd", //选择日期后，文本框显示的日期格式
    	language: "zh", //汉化
    	//startDate:new Date(),
    	autoclose:true //选择日期后自动关闭 
    });
    $('.datetimepicker_start').datetimepicker({
    	minView: "month", //选择日期后，不会再跳转去选择时分秒
    	format: "yyyy-mm-dd", //选择日期后，文本框显示的日期格式
    	language: "zh", //汉化
    	startDate:new Date(),
    	autoclose:true //选择日期后自动关闭 
    });
    $('.datetimepicker_start2').datetimepicker({
    	minView: "month", //选择日期后，不会再跳转去选择时分秒
    	format: "yyyy-mm-dd", //选择日期后，文本框显示的日期格式
    	language: "zh", //汉化
    	startDate:new Date(),
    	autoclose:true //选择日期后自动关闭 
    });
  	//校验控件
	defaultInputValidator();
	// 弹窗消失后自动查询
    $('#addModal').on('hidden.bs.modal', function (e) {
		$('#queryBtn').click();
	});
}