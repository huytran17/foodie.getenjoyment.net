<?php
	if (isset($_GET['slug_post']) && isset($_GET['id'])) {
		require('templates/post.php');
	}
	elseif (isset($_GET['slug_cate'])) {
		require('templates/species.php');
	}
	elseif (isset($_GET['search'])) {
		require('templates/search.php');
	}
	elseif (isset($_GET['slug_cus'])) {
		require('templates/customer.php');
	}
	elseif (isset($_GET['sign'])) {
		require('templates/sign.php');
	}
	elseif (isset($_GET['slug_if'])) {
		require('templates/info.php');
	}
	elseif (isset($_GET['slug_sp']) && isset($_GET['id'])) {
		require('templates/order.php');
	}
	elseif (isset($_GET['idkh'])) {
		require('templates/basket.php');
	}
	elseif (isset($_GET['vcode'])) {
		require('./verify.php');
	}
	elseif (isset($_GET['repass'])) {
		require('templates/resetpass.php');
	}
	elseif (isset($_GET['signout'])) {
		require('./signout.php');
	}
	else require('templates/news.php');
?>