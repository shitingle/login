<?php
include_once 'comm/opmysql.php';
require_once 'PHPMailer/class.phpmailer.php'; 
$url='http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['SCRIPT_NAME']).'/activation.php';
$url.='?name='.$_GET['regname'].'&pwd='.md5($_GET['regpwd1']).'';
$subject="激活码成功领取";
$mailbody='<html><body>注册成功。您的激活码是:'.'<a href="'.$url.'" target="_blank">'.$url.'</a><br>'.'请点击改地址，激活您的邮箱</body></html>';
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
$mail->AddAddress($_GET['email'],"获取注册用户激活码");
$mail->Send();
$sql="insert into tb_member(name,password,question,answer,email,realname,birthday,telephone,qq)
		values('".$_GET['regname']."','".md5($_GET['regpwd1'])."','".$_GET['question']."','".$_GET['answer']."','".$_GET['email']."',
     '".$_GET['realname']."','".$_GET['birthday']."','".$_GET['telephone']."','".$_GET['qq']."')";
$num=$conne->uidRst($sql);

?>