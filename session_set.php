<?php 
include_once("comm/opmysql.php");
class MySessionHandler implements SessionHandlerInterface {
     /**
    * @access private
    * @var object 数据库连接
    */
    private $_dbLink;
    /**
    * @access private
    * @var string 保存session的表名
    */
    Private $_sessionTable;
    /**
    * @access private
    * @var string session名
    */
    private $_sessionName;
    /**
    * @const 过期时间
    */
    const SESSION_EXPIRE = 10;
    public function __construct($dbLink, $sessionTable) {
        if(!is_object($dbLink)) {
            return false;
        }
        $this->_dbLink = $dbLink;
        $this->_sessionTable = $sessionTable;
    }
    /**
    * 打开
    * @access public
    * @param string $session_save_path 保存session的路径
    * @param string $session_name session名
    * @return integer
    */
    public function open($session_save_path, $session_name) {
        $this->_sessionName = $session_name;
        return 0;
    }
    /**
    * 关闭
    * @access public
    * @return integer
    */
    public function close() {
        return 0;
    }
    /**
    * 关闭session
    * @access public
    * @param string $session_id session ID
    * @return string
    */
    public function read($session_name) {
        $query = "SELECT value FROM {$this->_sessionTable} WHERE name = {$session_name} AND UNIX_TIMESTAMP(expiration) + " . self::SESSION_EXPIRE . " > UNIX_TIMESTAMP(NOW())";
        $result = $this->_dbLink->mysql_query_rst($query);
        if(!isset($value) || empty($value)) {
            $value = "";
            return $value;
        }
        $this->_dbLink->uidRst("UPDATE {$this->_sessionTable} SET expiration = CURRENT_TIMESTAMP() WHERE name = {$session_id}");
        $value = $this->getRowsRst();
        $this->_dblink->close_rst();
        return $value['value'];
    }
    /**
    * 写入session
    * @access public
    * @param string $session_id session ID
    * @param string $session_data session data
    * @return integer
    */
    public function write($session_name, $session_data) {
        $query = "SELECT value FROM {$this->_sessionTable} WHERE name = '{$session_name}' AND UNIX_TIMESTAMP(expiration) + " . self::SESSION_EXPIRE . " > UNIX_TIMESTAMP(NOW())";
        $result = $this->_dbLink->getRowsNum($query);
        if(!empty($result)) {
            $result = $this->_dbLink->uidRst("UPDATE {$this->_sessionTable} SET count = {$session_data} WHERE name = {$session_name}");
        }
        else{
            $result = $this->_dbLink->uidRst("INSERT INTO {$this->_sessionTable} (name, count) VALUES ('{$session_name}', '{$session_data}')");
        }
        if($result){
            return 0;
        }
        else{
            return 1;
        }      
    }
    /**
    * 销魂session
    * @access public
    * @param string $session_id session ID
    * @return integer
    */
    public function destroy($session_id) {
        $result = $this->_dbLink->query("DELETE FROM {$this->_sessionTable} WHERE name = '{$session_name}'");
        if($result){
            return 0;
        }
        else{
            return 1;
        }
    }
    /**
    * 垃圾回收
    * @access public
    * @param string $maxlifetime session 最长生存时间
    * @return integer
    */
    public function gc($maxlifetime) {
        $result = $this->_dbLink->query("DELETE FROM {$this->_sessionTable} WHERE UNIX_TIMESTAMP(expiration) < UNIX_TIMESTAMP(NOW()) - " . self::SESSION_EXPIRE);
        if($result){
            return 0;
        }
        else{
            return 1;
        }
    }
}

$dbLink = new db();
$sessionTable = "sessioninfo";
$handler = new MySessionHandler($dbLink, $sessionTable);
session_set_save_handler($handler);
session_start();
$_SESSION['yangyao'] = "1";
echo $_SESSION["yangyao"];
echo session_data();
?>