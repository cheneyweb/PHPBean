// 显示普通html页面
function showHtml(moduleName,htmlName) {
	//var start = new Date().getTime();//起始时间
	$('#content').load("../../../../foreground/module/"+ moduleName +"/"+ htmlName,function(){
		afterViewLoad();
		//var end = new Date().getTime();//接受时间
	    //alert(end - start);//返回函数执行需要时间
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
    	// 更换新增按钮
        $('#updateBtn').hide();
        $('#addBtn').show();
        // 修改主题文字
        $('#addModalLabel').html($('#addModalLabel').html().replace('编辑','新增'));
		$('#queryBtn').click();
	});
}
