<?php
include_once 'comm/opmysql.php';
$sql="select * from tb_member where name='".$_GET['name']."' ";
$num=$conne->getRowsNum($sql);
if($num==1){
	echo "用户名已经被占用";
}else if($num!=1){
	echo "用户名可用";
	
}else{
	echo "未知错误";
}
?> 
