<div class="container">
	<div class="menu_admin">
		<div class="row pt-2">
			<img src="<?php echo empty($data_user['url_avt_ad']) ? $_DOMAIN.'public/default_avt/avt.png' : $_DOMAIN .$data_user['url_avt_ad']; ?>" alt="img" style="box-shadow: 0 0 1px 1px rgb(191, 252, 255);">
			<p class="text-gray-dark">Hello <?php echo $data_user['displayname_ad'];?>!</p>
		</div>
		<div class="row">
			<?php if ($data_user['vitri_ad'] != 3){ ?>
				<div class="col-12 col-sm-4 col-md-3">
					<a href="<?php echo $_DOMAIN; ?>dashboard">
						<span class="fa fa-area-chart"></span><span>Thống kê</span></a>
				</div>
				<div class="col-12 col-sm-4 col-md-3 ">
					<a href="<?php echo $_DOMAIN; ?>profile">
						<span class="fa fa-tags"></span><span>Hồ sơ</span></a>
				</div>
				<div class="col-12 col-sm-4 col-md-3 ">
					<a href="<?php echo $_DOMAIN; ?>species">
						<span class="fab fa-yelp"></span><span>Chủng loại</span></a>
				</div>
				<div class="col-12 col-sm-4 col-md-3 ">
					<a href="<?php echo $_DOMAIN; ?>foods">
						<span class="fas fa-pizza-slice"></span><span>Món ăn</span></a>
				</div>
			<?php } ?>
			<?php
				if ($data_user['vitri_ad'] == 1) {
					echo '<div class="col-12 col-sm-4 col-md-3 ">
						<a href="'.$_DOMAIN.'accounts">
							<span class="fas fa-user-edit"></span><span>Quản trị viên</span></a>
					</div>';
				}
			?>
			<?php if ($data_user['vitri_ad'] != 3): ?>
				<div class="col-12 col-sm-4 col-md-3 ">
					<a href="<?php echo $_DOMAIN; ?>customers">
						<span class="fa fa-users"></span><span>Khách hàng</span></a>
				</div>
			<?php endif ?>
			<div class="col-12 col-sm-4 col-md-3 ">
				<a href="<?php echo $_DOMAIN; ?>orders">
					<span class="fa fa-shopping-cart"></span><span>Đơn hàng</span></a>
			</div>
			<?php if ($data_user['vitri_ad'] != 3): ?>
				<div class="col-12 col-sm-4 col-md-3 ">
					<a href="<?php echo $_DOMAIN; ?>slider">
						<span class="fa fa-video-camera"></span><span>Slider</span></a>
				</div>
				<div class="col-12 col-sm-4 col-md-3 ">
					<a href="<?php echo $_DOMAIN; ?>site">
						<span class="fa fa-info-circle"></span><span>Thông tin</span></a>
				</div>
				<div class="col-12 col-sm-4 col-md-3 ">
					<a href="<?php echo $_DOMAIN; ?>social">
						<span class="fa fa-users"></span><span>Cộng đồng</span></a>
				</div>
			<?php endif ?>
			<?php
				if ($data_user['vitri_ad'] == 1) {
					echo '
					<div class="col-12 col-sm-4 col-md-3 ">
						<a href="'.$_DOMAIN.'settings">
							<span class="fa fa-gears"></span><span>Cài đặt</span></a>
					</div>
					';
				}
			?>
			<div class="col-12 col-sm-4 col-md-3 ">
				<a href="<?php echo $_DOMAIN; ?>logout.php">
					<span class="fa fa-power-off"></span><span>Thoát</span></a>
			</div>
		</div>
	</div>
</div><hr class="w-25">