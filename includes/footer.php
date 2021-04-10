
	<footer class="footer mx-auto content p-0">
		<nav class="nav-footer h-100">
			<div class="footer-footer h-100">
				<ul class="row p-0 m-0 h-100">
				<?php
					$sql_get_all_info = "SELECT * FROM fd_siteinfo WHERE idcha_si=0";
					if ($db->num_rows($sql_get_all_info)) {
						foreach ($db->fetch_assoc($sql_get_all_info, 0) as $key => $data_info) {
							$sql_get_child = "SELECT * FROM fd_siteinfo WHERE idcha_si='$data_info[id_si]'";
			
							if ($db->num_rows($sql_get_child)) {
								echo '<li class="par col-12 col-xl-3 p-0">
										<div class="list-item clearfix">
											<h2 class="expand">'.$data_info['tieude_si'].'<span class="fa fa-plus d-xl-none float-right"></span>
											</h2>
											<ul class="coll">
							';
								foreach ($db->fetch_assoc($sql_get_child, 0) as $key => $data_child) {
									echo '<li class="ft-item"><a class="ft-link" href="'.$_DOMAIN. 'info/' .$data_child['slug_info_si'] .'">'.$data_child['tieude_si'].'</a></li>';
								}
								echo '</ul></div></li>';
							}
							else echo '<li class="par col-12 col-xl-3 p-0"><div class="list-item clearfix">
								<h2 class="expand">'.$data_info['tieude_si'].'<span class="fa fa-plus d-xl-none float-right"></span></h2></div></li>';
							
						}
					}
				?>
				</ul>
			</div>
		</nav>
	</footer>
	<footer class="footer-media cont mx-auto content p-0 mt-2 clearfix">
		<a href="<?php echo $_DOMAIN; ?>signout=1" class="float-right out-lk"><span class="fa fa-sign-out"></span></a>
		<nav class="social-media">
			<ul class="media">
				<?php
					$sql_get_all_media = "SELECT * FROM fd_socialmedia";
					if ($db->num_rows($sql_get_all_media)) {
						foreach ($db->fetch_assoc($sql_get_all_media, 0) as $key => $data_media) {
							echo '<li class="media-item"><a class="rounded-circle" target="__blank" href="'.$data_media['link_sm'].'"><span class="'.$data_media['icon_sm'].'"></span></a></li>';
						}
					}
				?>
			</ul>
		</nav>
	</footer>
	<hr>
	<footer class="global-footer cont content clearfix my-2">
		<p class="copyright">
			<img src="<?php echo $_DOMAIN; ?>public/nav/logo_108x108.png" alt="<?php echo $data_web['tieude_ws']; ?>">
			© 2017 - 2020 Foodie's. All Rights Reserved
		</p>
	</footer>
</body>
        <script src="<?php echo $_DOMAIN; ?>js/jquery-3.4.1.min.js"></script>

	<script src="<?php echo $_DOMAIN; ?>js/foodie.form.js"></script>	
	<script src="<?php echo $_DOMAIN; ?>js/foodie.en.js"></script>	
	<script src="<?php echo $_DOMAIN; ?>js/foodie.def.js"></script>	
	<script src="<?php echo $_DOMAIN; ?>js/foodie.helper.js"></script>	
    	
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5eb188dffedfdd81"></script>

	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</html>