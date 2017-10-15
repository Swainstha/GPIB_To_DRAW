<?php
	class DbOperationsElection{
		private $con;
		function __construct() {
			require_once dirname(__FILE__).'/DbConnect.php';
			$db = new DbConnect();
			$this->con = $db->connect();
		}
		function createUser($first_name,$mid_name, $last_name, $zone, $district, $person) {
			if($this->isUserExist($person,$zone,$district)){
				return 0;
			} else {
				$stmt = $this->con->prepare("INSERT INTO election (first_name, mid_name, last_name, zone, district, person) VALUES(?, ?, ?, ?, ?, ?);");
				if(!$stmt) {
					echo 'shit';
					return 2;
				} else{
					echo 'no';
					$stmt->bind_param("ssssss",$first_name,$mid_name,$last_name, $zone, $district, $person);
					$stmt->execute();
					echo 'yeah';
					return 1;
				}
			}

		}

		public function getUserByUsername($name) {
			$stmt = $this->con->prepare("SELECT * FROM election WHERE person =?");
			$stmt->bind_param("sss",$first_name, $mid_name, $last_name);
			$stmt->execute();
			return $stmt->get_result()->fetch_assoc();
		}
		private function isUserExist($name, $user_id) {
			$stmt = $this->con->prepare("SELECT id FROM user_data WHERE name = ? OR user_id = ?");
			$stmt->bind_param("ss",$name,$user_id);
			$stmt->execute();
			$stmt->store_result();
			return ($stmt->num_rows > 0);
		}
	}
?>
