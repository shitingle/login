function check_chk(){
	var xmlhttp;
	var foundname=document.getElementById("foundname").value;
	var question=document.getElementById("question").value;
	var answer=document.getElementById("answer").value;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.open("GET","http://localhost/register/found_chk.php?foundname="+foundname+"&question="+question+"&answer="+answer,true);
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	    msg=xmlhttp.responseText;
	    if(msg==1){
	    	document.getElementById("error").innerHTML="找回密码成功，请登陆注册邮箱";
	    }else if(msg==2){
	    	document.getElementById("error").innerHTML="填写信息错误";
	    	return false;
	    }
	    }
	  }
	xmlhttp.send();
}