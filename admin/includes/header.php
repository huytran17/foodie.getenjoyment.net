<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8"/>
    <title>Administration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
 
    <script src="<?php echo $_DOMAIN; ?>js/jquery-3.4.1.min.js"></script>  
    <!--<script src="<?php echo $_DOMAIN; ?>ckeditor/ckeditor.js"></script>-->
    <link rel="stylesheet" href="<?php echo $_DOMAIN; ?>bootstrap/css/control.css">
    <link rel="stylesheet" href="<?php echo $_DOMAIN; ?>bootstrap/css/content.css">
    <link rel="stylesheet" href="<?php echo $_DOMAIN; ?>bootstrap/css/foodie.all.css">
    <link rel="stylesheet" href="<?php echo $_DOMAIN; ?>bootstrap/fonts/fontawesome-web/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script>console.log('%cHELLO!', 'color: red; font-size: 50px;');</script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
        <!-- Nếu chưa đăng nhập -->
        <?php 
	        if (!$user) {
	            echo '<div class="container">
		                <div class="page-header row mt-5 w-100 ml-5 ml-sm-0">
		                    <h1 class="text-info">Foodie <br class="header-br"><small class="text-secondary">Administration</small></h1>
		                </div>
		            </div><hr class="w-75">';
	        }
	        else {
	        //Nếu đăng nhập
	            echo '<div class="container">
		                <nav class="navbar navbar-light page-header" role="navigation">
		                    <div class="navbar-header">
		                        <a class="navbar-brand text-info" href="'.$_DOMAIN.'"><h1 class="text-info">Foodie <br class="header-br"><small class="text-info">Administration</small></h1></a>
		                    </div>
		                </nav>
		            </div><hr class="w-75">';
	        }
        ?>