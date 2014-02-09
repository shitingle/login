<?php
include 'comm/opmysql.php';
include_once 'comm/security.php';
require_once 'PHPMailer/class.phpmailer.php';
$found=$_GET['foundname'];
$question=$_GET['question'];
$answer=$_GET['answer'];
$sql="select * from tb_member where name='".$found."'  and question='".$question."' and answer='".$answer."'";
$num=$conne->getRowsRst($sql);
$email= $num['email'];
if($num!=""){
$rnd=rand(1000,time());
$sql="update tb_member set password='".md5($rnd)."' where name='".$found."'";
$num=$conne->uidRst($sql);	
	   if($num!=''){
		$mailbody="您的密码是'".$rnd."'";
		$subject="找回密码";
		$mail=new PHPMailer(true);
		$mail->IsSMTP();
		$mail->CharSet='utf-8';
		$mail->SMTPAuth=true;
		$mail->Port=25;
		$mail->Host="smtp.163.com";
		$mail->From="shitingle@163.com";
		$mail->FromName="shitingle";
		$mail->Username="shitingle";
		$mail->Password="135072562";
		$mail->Subject=$subject;
		$mail->IsHTML(true);
		$mail->Body=$mailbody;
		$mail->AddReplyTo("shitingle@163.com","shitingle");
		$mail->AddAddress($email,"找回密码");
		$mail->Send();}	
	echo 1;	
}else{
	echo 2;
}

?>