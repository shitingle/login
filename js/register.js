name=0;
pwd;
email;
function checkuser(){
	var regname=document.getElementById("regname").value;
	var test=/^[a-zA-Z_]\w{6,11}$/;
    if(regname==""){
    	name=2
    	document.getElementById("text1").innerHTML="<span style='color:red'>用户名不能为空</span>";
    }
    else if(test.test(regname)){
    	name=1;
    	res("http://localhost/register/chkname.php?name="+regname,"text1")
    }
    else{
    	name=2;
    	document.getElementById("text1").innerHTML="<span style='color:red'>用户名格式不正确</span>";}
	
}
function checkpwd(){
	var pwd=document.getElementById("regpwd1").value;
	var pwd2=document.getElementById("regpwd2").value;
	if(pwd==""||pwd2==""){
		pwd=2;
		document.getElementById("text2").innerHTML="<span style='color:red'>密码不能为空</span>";
	}else if(pwd==pwd2&&pwd.length<=6){
		pwd=1;
		document.getElementById("text2").innerHTML="密码输入正确  密码强度：弱";
	}else if(pwd==pwd2&&pwd.length>=6){
		pwd=1;
		document.getElementById("text2").innerHTML="密码输入正确 密码强度：强";
	}else{
		pwd=2;
		document.getElementById("text2").innerHTML="<span style='color:red'>俩次密码不一致</span>";
	}
}
function checkemail(){
	var email=document.getElementById("regemail").value;
	var test=/^[\w]*@\w*\.com$/;
	if(email==""){
		email=2;
		document.getElementById("text3").innerHTML="<span style='color:red'>邮箱不能为空</span>";
	}else if(test.test(email)){
		email=1;
		document.getElementById("text3").innerHTML="<span style='color:green'>邮箱填写正确</span>";
	}
	else{
		email=2;
		document.getElementById("text3").innerHTML="<span style='color:red'>邮箱格式不正确</span>";}
}
function check(){
	if(name==1&&email==1&&pwd==1){
		alert(1);
	}else{
		event.preventDefault()	
	}
	
}
function res(url,div){
	var xmlhttp;
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
	    document.getElementById(div).innerHTML=xmlhttp.responseText;
	    }
	  }
	xmlhttp.open("GET",url,true);
	xmlhttp.send();
	}	
