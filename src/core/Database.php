<?
class Database {
	
    private $_connection;
    private static $_instance; //The single instance
	private $_chartset = 'utf8';
    private $_host = S__DB_host;
    private $_username = S__DB_username;
    private $_password = S__DB_password;
    private $_database = S__DB_name;
	
    /*
    Get an instance of the Database
    @return Instance
    */
    public static function getInstance() {
        if (!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    // Constructor
    private function __construct() {
        try {
			$dsn['user'] = $this->_username;
			$dsn['pass'] = $this->_password;
			$dsn['host'] = $this->_host;
			$dsn['db'] = $this->_database;
			$dsn['charset'] = $this->_chartset;
			$dsn['errmode'] = 'exception';
			$this->_connection = new SafeMySQL($dsn);
			$this->_connection->query('SET NAMES utf8');
            //$this->_connection  = new \PDO("mysql:host=$this->_host;dbname=$this->_database", $this->_username, $this->_password);
			//$this->_connection->exec("set names utf8");
            //echo 'Connected to database';
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    // Magic method clone is empty to prevent duplication of connection
    private function __clone(){
		/* noop */
    }
    // Get mysql pdo connection
    public function getConnection() {
        return $this->_connection;
    }
	
}

?>