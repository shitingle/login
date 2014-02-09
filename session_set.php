<?php 
include_once("comm/opmysql.php");
class MySessionHandler implements SessionHandlerInterface {
     /**
    * @access private
    * @var object ���ݿ�����
    */
    private $_dbLink;
    /**
    * @access private
    * @var string ����session�ı���
    */
    Private $_sessionTable;
    /**
    * @access private
    * @var string session��
    */
    private $_sessionName;
    /**
    * @const ����ʱ��
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
    * ��
    * @access public
    * @param string $session_save_path ����session��·��
    * @param string $session_name session��
    * @return integer
    */
    public function open($session_save_path, $session_name) {
        $this->_sessionName = $session_name;
        return 0;
    }
    /**
    * �ر�
    * @access public
    * @return integer
    */
    public function close() {
        return 0;
    }
    /**
    * �ر�session
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
    * д��session
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
    * ����session
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
    * ��������
    * @access public
    * @param string $maxlifetime session �����ʱ��
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