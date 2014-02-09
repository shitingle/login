function checklogin(){
	var xmlhttp;
	var name=document.getElementById("lgname").value;
	var pwd=document.getElementById("lgpwd").value
	url="http://localhost/register/login_chk.php?lgname="+name+"&lgpwd="+pwd;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	    msg=xmlhttp.responseText;
	    if(msg=="0"){
	    	document.getElementById("error").innerHTML="您还没有激活，请先登录进行激活操作";
	    }else if(msg=="1"){
	    	document.getElementById("error").innerHTML="用户名或密码输入错误，您还有2次机会";
	    }else if(msg=="2"){
	    	document.getElementById("error").innerHTML="用户名或密码输入错误，您还有1次机会";
	    }else if(msg=="3"){
	    	document.getElementById("error").innerHTML="请2小时候之后再式";
	    	return false;
	    }
	    else if(msg=="4"){
	    	document.getElementById("error").innerHTML="用户名输入错误";
	    }else if(msg=="-1"){
	    	document.getElementById("error").innerHTML="登录成功";
	    	
	    }
	    }
	  }
	xmlhttp.open("GET",url,true);
	xmlhttp.send();
}

