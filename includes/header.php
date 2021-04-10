<?php
	$title_error_404 = 'Không tìm thấy trang';
	// Url bài viết
	if (isset($_GET['slug_post']) && isset($_GET['id'])) {
	    $slug_sp = trim(htmlspecialchars($_GET['slug_post']));
	    $id_sp = trim(htmlspecialchars($_GET['id']));
	 
	    // Kiểm tra bài viết tồn tại
	    $sql_check_sp = "SELECT * FROM fd_sanpham WHERE id_sp='$id_sp' AND slug_sp='$slug_sp'";
	    if ($db->num_rows($sql_check_sp)) {
	        $data_sp = $db->fetch_assoc($sql_check_sp, 1);
	 
	        $title = $data_sp['ten_sp'];
	        $url = $_DOMAIN .$slug_sp .'-'. $id_sp .'.html';
	        $img = $_DOMAIN .$data_sp['url_thumb_sp'];
	        $detail_descr = $data_sp['mota_sp'];
	        // ...
	    } else {
	        $title = $title_error_404;
	    }
	// Url chuyên mục
	} else if (isset($_GET['slug_cate'])) {
	    $slug_cate = trim(htmlspecialchars($_GET['slug_cate']));
	    // Kiểm tra chuyên mục tồn tại
	    $sql_check_cate = "SELECT ten_chl, slug_chl, mota_chl, url_thumb_chl FROM fd_chungloai WHERE slug_chl='$slug_cate'";
	    if ($db->num_rows($sql_check_cate)) {
	        $data_cate = $db->fetch_assoc($sql_check_cate, 1);
	 
	        $title = $data_cate['ten_chl'];
	        $url = $_DOMAIN .'species/' .$slug_cate .'&page=1';
                $detail_descr = $data_sp['mota_chl'];
                $img = $_DOMAIN .$data_sp['url_thumb_chl'];
	        // ...
	    } else {
	        $title = $title_error_404;
	    }
	} else {
		$id_sp = '';
		$img = $_DOMAIN .'public/logo/mclogo.png';
		$detail_descr = $data_web['mota_ws'];
		$url = $_DOMAIN;
	    $title = $data_web['tieude_ws'];
	    // ...
	}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="<?php echo $data_web['mota_ws']; ?>">
  	<meta name="keywords" content="<?php echo $data_web['keyword_ws']; ?>">
  	<meta name="author" content="Huy Mee">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta id="meta_topic_id" property="og:id" content="<?php echo $id_sp; ?>">
    <meta property="og:type" content="article">
    <meta property="og:title" content="<?php echo $title; ?>">
    <meta property="og:description" content="<?php echo $detail_descr; ?>">
    <meta property="og:url" content="<?php echo $url; ?>">
    <meta property="og:image" content="<?php echo $img; ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $title; ?>">
    <meta name="twitter:description" content="<?php echo $detail_descr; ?>">
    <meta name="twitter:image" content="<?php echo $img; ?>">
    <title><?php echo $title; ?></title>
        <style type="text/css">
		<?php 
			$file_path = array();
			$file_path[] = './bootstrap/css/foodie.cont.css';
			$file_path[] = './bootstrap/css/foodie.res.css';
			$content = '';
			foreach ($file_path as $key => $path) {
				$handle = @fopen($path, "r");	
				if ($handle) {
					while (($buffer = fgets($handle, filesize($path))) != false) {
						$content .= trim($buffer);
					}
				}
				fclose($handle);
			}
			echo $content;
		?>
	</style>

     <link rel="icon" type="image/png" href="<?php echo $_DOMAIN; ?>public/icons/favicon.ico">
	<link rel="apple-touch-icon" type="image/png" href="<?php echo $_DOMAIN; ?>public/icons/apple-touch-icon.png">
    
    <link rel="stylesheet" href="<?php echo $_DOMAIN; ?>bootstrap/fonts/fontawesome-web/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script>console.log('%cHELLO!', 'color: red; font-size: 50px;');</script>
</head>
<body>
	<header class="header">
		<nav class="nav-header clearfix">
				<div class="logo float-left">
					<a href="<?php echo $_DOMAIN; ?>"><img src="<?php echo $_DOMAIN; ?>public/logo/logo_108x108.png" alt="foodie" class="position-relative"></a>
				</div>
				<nav class="topbar clearfix navbar navbar-expand-xl navbar-light">
					<button class="navbar-toggler ml-auto text-dark" type="button" data-toggle="collapse" data-target="#cl">
			            <span class="navbar-toggler-icon bg-light text-dark"></span>
			        </button>
					<div class="collapse navbar-collapse" id="cl">
						<div class="navbar-nav w-100 d-block">
							<ul class="row m-0 fst-row">
								<?php
									if (!$user) {
										echo '<li class="col-12 col-xl-4 text-xl-left"><a href="'.$_DOMAIN.'sign-in" class="">Đăng nhập ngay</a></li>';
									}
									else {
										echo '<li class="col-12 col-xl-4 text-xl-left"><a href="'.$_DOMAIN.'mybasket/'.md5($data_member['id_kh']).'" class="">Giỏ hàng</a></li>';
									}
								?>
								
								<li class="box-search nav-item col-12 col-xl-4 text-xl-right ml-auto">
									<div class="w-100 form-search">
										<form action="<?php echo $_DOMAIN; ?>" method="get">
											<div class="input-group">
												<input type="search" class="inp-search inp-txt" name="search" placeholder="Tìm kiếm...">
												<div class="input-group-append">
													<button type="submit" class="fa fa-search bg-warning text-white"></button>
												</div>
											</div>
										</form>
									</div>
								</li>
							</ul>
							<ul class="m-0 row sec-row justify-content-between">
								<li class="nav-item clearfix">
									<span class="text-xl-left drop-link">
									    Thực đơn <span class="fa fa-angle-down"></span>
									</span>
								</li>
								<!--<li class="nav-item text-xl-center">
									<a href="#">Xu hướng</a>
								</li>
								<li class="nav-item text-xl-right">
									<a href="#">Sale off</a>
								</li>-->
							</ul>
						</div>
					</div>
				</nav>
				<div class="menu-list mx-auto">
					<ul class="row drop-menu m-0">
						<?php
							$sql_get_all_species = "SELECT * FROM fd_chungloai WHERE trangthai_chl=1";
							if ($db->num_rows($sql_get_all_species)) {
								foreach ($db->fetch_assoc($sql_get_all_species, 0) as $key => $data_spec) {
									echo '
										<li class="drop-item col-md-12 col-xl-4">
																
											<a href="'.$_DOMAIN. 'species/' .$data_spec['slug_chl'].'&page=1" class="d-block w-100 h-100 text-dark">
											<img src="'.$_DOMAIN.$data_spec['url_thumb_chl'].'" class="mr-3" alt="'.$data_spec['ten_chl'].'" width="80" heigth="80"">
											<span>'.$data_spec['ten_chl'].'</span>
											</a>
																
										</li>
										';
								}
							}
						?>
					</ul>
				</div>
			</nav>
	</header>
	
				<hr class="pt-0 pb-3 m-0">