<?php
	DEFINE('DB', array(
    "HOST" => 'fdb23.awardspace.net',
    "USER" => '3418615_foodie',
    "PASS" => 'mynameiszero0',
    "DBNAME" => '3418615_foodie'
));
	/**
	 * 
	 */
	class Database
	{
		private $__conn = null;
		//constructor
		public function __construct() {
			$this->__conn = new mysqli(DB['HOST'], DB['USER'], DB['PASS'], DB['DBNAME']);
		}
		//disconnect
		public function db_disconnect() {
			if ($this->__conn) {
				$this->__conn->close();
			}
		}
		//create query
		public function db_create_query($type, $params = null, $table, $conditions = array(), $extra = '') {
			$where = array();
			foreach ($conditions as $key => $value) {
				if (isset($conditions[$key])) {
					$where[] = "{$key} = '{$conditions[$key]}'";
				}
			}
			$sql = strtoupper($type) .' '. $params .' FROM '. $table;
			if ($where) {
				$sql .= ' WHERE '.implode(' AND ', $where);
			}
			$sql .= ' '. $extra;
			return $sql;
		}
		//excute query
		public function db_exe_query($sql) {
			if ($this->__conn) {
				$this->__conn->query($sql);
			}
		}
		//get record
		public function db_fetch_assoc($sql = null, $type) {
			if ($this->__conn) {
				$query = $this->__conn->query($sql);
				if ($query) {
					if ($type == 0) {
						while ($row = $query->fetch_assoc()) {
							$data[] = $row;
						}
						return $data;
					}
					else if ($type == 1) {
						$data = $query->fetch_assoc();
						return $data;
					}
				}
			}
			return false;
		}
		//count num rows
		public function db_num_rows($sql = null) {
			if ($this->__conn) {
	            $query = $this->__conn->query($sql);
	            if ($query) {
	                $row = $query->num_rows;
	                return $row;
	            }   
	        }    
		}
		//get latest id
		public function db_insert_id() {
			if ($this->__conn) {
				$count = $this->__conn->insert_id;
				return $count;
			}
			return false;
		}
		//charset 
		public function db_charset($set_code) {
			if ($this->__conn) {
				$this->__conn->set_charset($set_code);
			}
		}
	}
?>