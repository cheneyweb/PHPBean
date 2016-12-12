function defaultInputValidator()
{
	// 以下是默认规则
	bindEvent('_inputMoney',/^\d+\.?\d{0,2}$/);		//最多两位小数
	bindEvent('_inputMoneyWithMinus',/^-?\d*\.?\d{0,2}$/);//最多两位小数,可带负号
	bindEvent('_inputNumber',/^\d+$/);				//纯数字
	bindEvent('_inputPositiveNumber',/^[1-9]\d*$/);	//非零纯数字
	bindEvent('_inputChinese',/^[\u4E00-\uFA29]*$/);	//中文字
	bindEvent('_inputVariable',/^\w*$/);				//字母数字下划线
	bindEvent('_inputLevel',/^\d+[\.\d]*\.?$/);		//层级号
	// 可以自定义拓展规则...
	// bindEvent(类名,正则)；
}

// 以下是RuntimeValidator的核心代码，一般情况，无需修改
function bindEvent(className,reg)
{
	$('.'+className).keyup(function(){
		regValidator(this,reg);
	})
	$('.'+className).blur(function(){
		regValidator(this,reg);
	})
}
// 拼凑替换正则
function makeReg(reg)
{
	var reg = reg +'';
	var reg2 = reg.substring(2,reg.length-2);
	var prefix = '/';
	var suffix = '/';
	reg2  = prefix + reg2 + suffix;
	return reg2;
}
// 核心正则校验替换错误内容
function regValidator(inputObject,reg)
{
	var reg2 = eval(makeReg(reg));
	var value = inputObject.value;
	if(!reg.test(value))
	{
	    value = value.replace(value,value.match(reg2)?value.match(reg2):'');
	    $('#errMsg').html('请输入正数,不超过17字符');
	}
	else
	{
	    $('#errMsg').html('');
	}
	inputObject.value = value;
}