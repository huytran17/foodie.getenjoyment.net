<?php
	class Session {
		//constructor
		public function __construct() {
			session_start();
		}
		//get session
		public  function sess_get($name) {
			if (!empty($_SESSION[$name])) {
				$user = $_SESSION[$name];
			}
			else $user = '';
			return $user;
		}
		//save session
		public function sess_save($name, $data) {
			$_SESSION[$name] = $data;
		}
		//delete session
		public function sess_delete($name) {
			unset($_SESSION[$name]);
		}
		//destroy all sessions
		public function sess_destroy() {
			session_destroy();
		}
	}
?>