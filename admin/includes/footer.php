	<script src="<?php echo $_DOMAIN; ?>js/jquery.form.min.js"></script>  
	<script src="<?php echo $_DOMAIN; ?>js/foodie.form.js"></script>
	<script src="<?php echo $_DOMAIN; ?>js/foodie.helper.js"></script>
	<script src="<?php echo $_DOMAIN; ?>js/foodie.exec.js"></script>
<?php
	$tab = empty($_GET['tab']) ? '' : trim(addslashes(htmlspecialchars($_GET['tab'])));
	$ac = empty($_GET['ac']) ? '' : trim(addslashes(htmlspecialchars($_GET['ac'])));
	$id = empty($_GET['id']) ? '' : trim(addslashes(htmlspecialchars($_GET['id'])));
	if ($tab) {
		if ($tab == 'dashboard') {
			echo '<script>$(".menu_admin .row:eq(1) div:eq(0)").addClass("active");</script>';
		}
		elseif ($tab == 'profile') {
			echo '<script>$(".menu_admin .row:eq(1) div:eq(1)").addClass("active");</script>';
		}
		elseif ($tab == 'species') {
			echo '<script>$(".menu_admin .row:eq(1) div:eq(2)").addClass("active");</script>';
		}
		elseif ($tab == 'foods') {
			echo '<script>$(".menu_admin .row:eq(1) div:eq(3)").addClass("active");</script>';
		}
		elseif ($tab == 'accounts') {
			echo '<script>$(".menu_admin .row:eq(1) div:eq(4)").addClass("active");</script>';
		}
		elseif ($tab == 'customers') {
			echo '<script>$(".menu_admin .row:eq(1) div:eq(5)").addClass("active");</script>';
		}
		elseif ($tab == 'orders') {
			echo '<script>$(".menu_admin .row:eq(1) div:eq(6)").addClass("active");</script>';
		}
		elseif ($tab == 'slider') {
			echo '<script>$(".menu_admin .row:eq(1) div:eq(7)").addClass("active");</script>';
		}
		elseif ($tab == 'site') {
			echo '<script>$(".menu_admin .row:eq(1) div:eq(8)").addClass("active");</script>';
		}
		elseif ($tab == 'social') {
			echo '<script>$(".menu_admin .row:eq(1) div:eq(9)").addClass("active");</script>';
		}
		elseif ($tab == 'settings') {
			echo '<script>$(".menu_admin .row:eq(1) div:eq(10)").addClass("active");</script>';
		}
	}
?>
	<!--<script>
		config = {};
	    config.entities_latin = false;
	    config.language = "vi";
	    CKEDITOR.replace("ed_detailEditFood", config);
	    CKEDITOR.replace("ed_noteEditFood", config);
	    CKEDITOR.replace("ed_descrEditCate", config);
	    CKEDITOR.replace("ed_bodyEditRule", config);
	    CKEDITOR.replace("ed_bodyEditPoly", config);
	    CKEDITOR.replace("ed_addNdSi", config);
	    CKEDITOR.replace("ed_descrSlide", config);
	    CKEDITOR.replace("ed_editSi", config);
    </script>-->
</body>
</html>