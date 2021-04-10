<?php
	require_once('classes/Database.php');
	require_once('classes/Session.php');
	require_once('classes/Functions.php');
	//default
	$_DOMAIN = 'http://foodie.getenjoyment.net/admin/';

	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$current_date = date('Y-m-d H:i:sa');

	//db
	$db = new Database();
	$db->db_charset('utf8');
	//slug
	$slug = new Slug();
	//session
	$sess = new Session();
	
	if ($sess->sess_get('user')) {
		$user = $sess->sess_get('user');
	}
	else $user = '';
	//get current users
	if ($user) {
		$sql_get_data_user = $db->db_create_query('select', '*', 'fd_admin', array('username_ad'=>$user));
		if ($db->db_num_rows($sql_get_data_user)) {
			$data_user = $db->db_fetch_assoc($sql_get_data_user, 1);
		}
	}
?>