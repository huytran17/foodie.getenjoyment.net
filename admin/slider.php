<?php
	require_once('core/init.php');
	if ($user) {
		if (isset($_FILES['inpAddSlide'])) {
			$dir = '../upload/slider/';
			$name_img = stripslashes($_FILES['inpAddSlide']['name']);
			$source_img = $_FILES['inpAddSlide']['tmp_name'];
			$descrSlide = empty($_POST['descrSlide']) ? '' : trim(addslashes(htmlspecialchars($_POST['descrSlide'])));
			$titleSlide = empty($_POST['titleSlide']) ? '' : trim(addslashes(htmlspecialchars($_POST['titleSlide'])));
			$selectSp = empty($_POST['selectSp']) ? '' : trim(addslashes(htmlspecialchars($_POST['selectSp'])));

			$url_img = $dir .$name_img;
			move_uploaded_file($source_img, $url_img);
			$url_img = substr($url_img, 3);
			$sql_update_url_avt = "INSERT INTO fd_slider VALUES('', '$url_img', '$descrSlide', 1, '$titleSlide', '$selectSp')";
			$db->db_exe_query($sql_update_url_avt);
			new Redirect($_DOMAIN . 'slider');			
		}	
		elseif (isset($_POST['action'])) {
			$ac = trim(addslashes(htmlspecialchars($_POST['action'])));
			$id_slider = empty($_POST['id_slider']) ? '' : trim(addslashes(htmlspecialchars($_POST['id_slider'])));
			if ($ac == 'del_slide') {
				$url_img = empty($_POST['url_img']) ? '' : $_POST['url_img'];
				if (file_exists($url_img)) {
					unlink($url_img);
				}
				$sql_del_slide = "DELETE FROM fd_slider WHERE id_slider='$id_slider'";
				$db->db_exe_query($sql_del_slide);
			}
			else new Redirect($_DOMAIN.'slider');
		}
		else new Redirect($_DOMAIN);
	}
	else new Redirect($_DOMAIN);
?>