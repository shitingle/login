<?php
class db{
	private $host='localhost';
	private $name='root';
	private $pwd='';
	private $db='db_member';
	private $conn='';
	private $result='';
	private $msg='';
	private $field;
	private $fieldsNum=0;
	private $rowsNum=0;
	private $rowsRst='';
	private $filesArray=array();
	private $rowsArray=array();
	function __construct($host='',$name='',$pwd=''){
		$this->init_conn();
	}
	function init_conn(){
		$this->conn=mysql_connect($this->host,$this->name,$this->pwd);
		if(!$this->conn){
			echo "filed to host".mysql_error();
		}else if(mysql_select_db($this->db,$this->conn)){
			echo "success to db".mysql_error();
		}else{
			echo $this->db.mysql_error();}
			mysql_query("set names gb2312");
	}
		
}
$conn=new db();

?>