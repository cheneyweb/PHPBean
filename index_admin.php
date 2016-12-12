<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>PHPBean 管理系统</title>
<!-- Bootstrap 核心 CSS 文件 -->
	<link rel="stylesheet" href="foreground/frame/bootstrap3/css/bootstrap.min.css">
	<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
	<script src="foreground/frame/jquery/jquery-2.0.3.min.js"></script>
	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="foreground/frame/bootstrap3/js/bootstrap.min.js"></script>
	<!-- jQuery Ajax插件 -->
	<script src="foreground/frame/jquery/jquery.form.js"></script>
	<!-- 自定义查询插件 -->
	<script src="foreground/custom/js/query/action.js"></script>
<style>
.main .page-header {
	margin-top: 0;
}

body {
	padding-top: 40px;
	padding-bottom: 40px;
	background-color: #eee;
}

.form-signin {
	max-width: 330px;
	padding: 15px;
	margin: 0 auto;
}

.form-signin .form-signin-heading, .form-signin .checkbox {
	margin-bottom: 10px;
}

.form-signin .checkbox {
	font-weight: normal;
}

.form-signin .form-control {
	position: relative;
	height: auto;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	padding: 10px;
	font-size: 16px;
}

.form-signin .form-control:focus {
	z-index: 2;
}

.form-signin input[type="email"] {
	margin-bottom: -1px;
	border-bottom-right-radius: 0;
	border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
	margin-bottom: 10px;
	border-top-left-radius: 0;
	border-top-right-radius: 0;
}
</style>
</head>

<body>
	<div class="container">
		<form id="regForm" class="form-signin" method="post">
			<!--此隐藏域为必须，name必须为“bean”，value为实体名，注意首字母大写-->
			<input  type=hidden name="bean" value="Admin"/>
			
			<h2 class="form-signin-heading">&nbsp;&nbsp;&nbsp;PHPBean 管理系统</h2>
			<!--表单项的name属性必须为数据库表的字段名-->
			<input type="text" name="account" class="form-control" placeholder="帐号" required autofocus />
			<!--表单项的name属性必须为数据库表的字段名-->
			<input type="password" name="password" class="form-control" placeholder="密码" required />
			<div class="row">
			<div class="col-xs-8">
			<input type="text" class="form-control" name="captcha" placeholder="输入右边图片内容" required />
			</div>
			<img style="margin-top: 5px" id="captcha" class="img-rounded" src="/background/frame/util/captcha.php" alt="看不清楚，换一张" style="cursor: pointer; vertical-align:middle;" onClick="createCaptcha()"/>
			</div>
			<br/>
			<!-- <div class="checkbox">
				<label> <input type="checkbox" value="remember-me"/> 记住我 </label>
			</div> -->
			<button class="btn btn-lg btn-primary btn-block" type="button" onclick="javascript:formModuleActionModal('regForm','sys_admin','LoginAction','addModal',loginSuccess,loginFail)">登录</button>
			<span id="errMsg" class="label label-danger"></span>
		</form>
	</div>
	<!-- /container -->
</body>
</html>
<script type="text/javascript">
	// 回车提交
	$(function(){
		document.onkeydown = function(e){
		    var ev = document.all ? window.event : e;
		    if(ev.keyCode==13) {
		    	formModuleActionModal('regForm','sys_admin','LoginAction','addModal',loginSuccess,loginFail);
		     }
		}
	});
	// 登陆成功跳转
	function loginSuccess(){
		$('#errMsg').html('');
		window.location.href='background/module/sys_module_manager/view/SystemWelcomeView.php';
	}
	// 登陆失败跳转
	function loginFail(){
		createCaptcha();
		$('#errMsg').html(newData);
	}
	// 生成新的验证码
	function createCaptcha(){
		$('#captcha').attr('src','/background/frame/util/captcha.php?'+Math.random()*10000); 
	}
</script>