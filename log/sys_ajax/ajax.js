function Ajax(url,data,callback)
{
	this.url=url;
	this.data=data;
	this.callback=callback;
	if(callback == false || callback == null)
	{
		this.async = false;
	}
	else
	{
		this.async = true;
	}
	this.browser=
	(
		function()
		{
			if(navigator.userAgent.indexOf("MSIE")>0) 
			{
				return "MSIE";//IE浏览器
			}
			else
			{
				return "other";//其他
			}
		}
	)();
};
Ajax.prototype=
{
	get:function()
	{
		var result;
		var xmlhttp;
		if(this.browser=='MSIE')
		{
			try
			{
				xmlhttp=new ActiveXObject('microsoft.xmlhttp');
			}
			catch(e)
			{
				xmlhttp=new ActiveXObject('msxml2.xmlhttp');
			}
		}
		else
		{
			xmlhttp=new XMLHttpRequest();
		};
		
		var asyncTemp = this.async;
		var callbackTemp = this.callback;
		xmlhttp.onreadystatechange=function()
		{
			if(asyncTemp == true && xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				result = xmlhttp.responseText;
				callbackTemp(result);
			}
			else
			{
				result = xmlhttp.responseText;
			}
		};
		xmlhttp.open('GET',this.url+'?'+this.data,this.async);
		xmlhttp.send(null);
		return result;
	},
	post:function()
	{
		var result;
		var xmlhttp;
		if(this.browser=='MSIE')
		{
			xmlhttp=new ActiveXObject('microsoft.xmlhttp');
		}
		else
		{
			xmlhttp=new XMLHttpRequest();
		};
		var asyncTemp = this.async;
		var callbackTemp = this.callback;
		xmlhttp.onreadystatechange=function()
		{
			if(asyncTemp == true && xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				result = xmlhttp.responseText;
				callbackTemp(result);
			}
			else
			{
				result = xmlhttp.responseText;
			}
		};
		xmlhttp.open('POST',this.url,this.async);
		xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");//POST中，这句必须
		xmlhttp.send(this.data);
		return result;
	}
};

