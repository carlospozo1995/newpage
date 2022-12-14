<?php

	class Database{

		const ASSOC = MYSQLI_ASSOC;
		
		private $hostDb;
		private $userDb;
		private $passDb;
		private $nameDb;
		private $charsetDb;
		private $connection;
		private $query;
        private $resultSet;

        protected $lastQuery;
        protected $trimEnabled = true;
        protected $result;
        private $queries = array(); 
        private $res_set;    
        private $rowset = array(); 
        private $total_queries; 
        private $_trans_status; 

		function __construct($host, $user, $password, $name, $charset)
		{
			$this->hostDb = $host;
			$this->userDb = $user;
			$this->passDb = $password;
			$this->nameDb = $name;
			$this->charsetDb = $charset;
		}

		function connectDb()
		{
			$this->connection = new mysqli($this->hostDb, $this->userDb, $this->passDb, $this->nameDb);
			$this->connection->set_charset($this->charsetDb);

			if ($this->connection->connect_error) {
				die("LA CONEXION A ALA BASE DE DATOS A FALLADO. " . $this->connection->connect_error);
			}
		}

		function fetch_row($result_set, $dorowset=false, $result_type=self::ASSOC ) {
            if( !$dorowset ) {
                if ($result_set === FALSE) {
                    return $result_set;
                }
              return mysqli_fetch_array($result_set, $result_type);
            }
            if( $dorowset ) {      
                $result = array();
                if ($result_set === FALSE) {
                    return $result;
                }
                while( $rows = mysqli_fetch_array( $result_set, $result_type ) ){
                    $result[] = $rows;
                }
                return $result;
            }
        }

        public function formatQuery($sql, $params=array()){
            if (count($params)==0){
                return $sql;
            }
            $parts = explode('?', $sql);
            $n = count($parts);
            if( $n == 0 ){
                return $sql;
            }
            $i = 1;
            $result = '';
            foreach ($params as $param){
                if ($i >= $n ){
                    break;
                }
                $result .= $parts[$i-1] . "'" . $param . "'";
                $i++;
            }
            $result.= $parts[$n-1];
            return $result;
        }
          
        function Query($query, $params=array()) {
            if (count($params)>0){
                $query = $this->formatQuery($query, $params);
            }
            // Utils::log("SQL Query: $query");
            $this->result = mysqli_query($this->connection, $query);
            $this->total_queries++;
            if ($this->result === FALSE){
              //$msg = "SQL ERROR: ". $this->error();
              //Utils::log($msg);
            }
            $this->_trans_status = false;      
            $this->lastQuery = $query;
            $this->_trans_status = true;
            return $this->result;
        }
          
        function auto_array($query, $params = array(), $dorowset=false, $result_type=self::ASSOC) {
            $this->result = $this->Query($query, $params);
            if($this->result === false){
                return null;
            }
            $this->res_set = $this->fetch_row($this->result, $dorowset, $result_type);
            mysqli_free_result($this->result);
            return $this->res_set;
        }
          
        function error() {
            return mysqli_connect_errno($this->connection). ': ' .  mysqli_connect_error($this->connection);
        }

	}

?>