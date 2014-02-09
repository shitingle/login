<?php
header('Content-Type:text/html;charset=gb2312');
include_once("comm/opmysql.php");
$name=$_GET['lgname'];
$pwd=$_GET['lgpwd'];
if(!empty($name)||!empty($pwd)){
	$sql="select * from tb_member where name='$name'";
	$num=$conne->getRowsRst($sql);
	$active=$num['active'];
	$count=$num['count'];
	$conne->close_rst();
	if($active==''){
		echo "4";
	}else if($active==0){
		echo "0";
	}else if($count>=3){
		echo "3";
	}else{
		$sql.="and pwd='".md5($pwd)."'";
		$numm=$conne->getRowsNum($sql);
		if($numm==0||$numm==null){
			$numm=$conne->uidRst("update tb_member set count=".($count+1)." where name='".$name."'");
			echo ($count+1);
		}
else{
	if($count!=0){
		$num=$conne->uidRst("update tb_member set count=0 where name=".$name."");
	}
	
	$_SESSION['name']=$name;
	echo "-1";
}}}
?>