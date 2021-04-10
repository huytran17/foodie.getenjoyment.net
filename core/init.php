<?php
	require_once('classes/Database.php');
	require_once('classes/Session.php');
	require_once('classes/Functions.php');
	$db = new Database();
	$db->connect();
	$db->set_char('utf8');
	
	$slug = new Slug();

	$_DOMAIN = 'http://foodie.getenjoyment.net/';
	// Lấy thông tin website
	$sql_get_data_web = "SELECT * FROM fd_website";
	if ($db->num_rows($sql_get_data_web)) {
	    $data_web = $db->fetch_assoc($sql_get_data_web, 1);
	}

	date_default_timezone_set('Asia/Ho_Chi_Minh'); 
	$current_date = date("Y-m-d H:i:sa");
	 
	// Khởi tạo session
	$session = new Session();
	$session->start();

	// Kiểm tra session
	if ($session->get('kh') != '')
	{
	    $user = $session->get('kh');
	    // Lấy dữ liệu tài khoản
	    $sql_get_data_member = "SELECT * FROM fd_khachhang WHERE username_kh = '$user'";
	}
	elseif ($session->get('fbid') != '') {
		$user = $session->get('fbid');
		// Lấy dữ liệu tài khoản
	    $sql_get_data_member = "SELECT * FROM fd_khachhang WHERE fbid = '$user'";
	}
	else
	{
	    $user = '';
	}
	 
	// Nếu đăng nhập
	if ($user)
	{
	    if ($db->num_rows($sql_get_data_member))
	    {
	        $data_member = $db->fetch_assoc($sql_get_data_member, 1);
	    }
	}
?>