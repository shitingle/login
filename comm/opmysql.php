<?php 
Class db{
	private $host="localhost";
	private $name="root";
	private $pwd="";
	private $result="";
	private $conn="";
	private $dbname="db_member";
	function __construct($host="",$name="",$pwd=""){
		$this->connect();
	}
	function connect(){
		$this->conn=mysql_connect($this->host,$this->name,$this->pwd);
	    mysql_select_db($this->dbname,$this->conn);
		mysql_query("set names gb2312");
	}
	function mysql_query_rst($sql){
		$this->result=mysql_query($sql,$this->conn);
	}
	function getRowsNum($sql){
		$this->mysql_query_rst($sql);
		return @mysql_num_rows($this->result);//查询记录数函数，返回记录
	}
	function getRowsRst($sql){  //查询单条记录
		$this->mysql_query_rst($sql);
		return mysql_fetch_array($this->result);
		
	}
	function getRowsArray($sql){ //取得多条记录
		$this->mysql_query_rst($sql);
		while($row=mysql_fetch_array($this->result)){
			$this->rowsArray[]=$row;
		}
	}
	function uidRst($sql){
		mysql_query($sql);
		$this->rowsNum=mysql_affected_rows();
		$rowsNum=mysql_affected_rows();//更新，删除，添加函数
		return $this->rowsNum;
	}
	function close_rst(){
		mysql_free_result($this->result);
		$this->msg="";
		$this->fieldNum=0;
		$this->rowsNum=0;
		$this->filesArray="";
		$this->rowsArray="";
	}
	function close_conn(){
		$this->close_rst();
		mysql_close($this->conn);
		$this->conn="";
	}
}

$conne=new db();

?>