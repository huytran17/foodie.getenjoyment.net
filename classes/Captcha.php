<?php
	session_start();
	class Captcha {
		var $img_width = 150;
		var $img_height = 50;
		var $char_length = 4;
		var $line_length = 7;
		var $font_size = 18;
		var $font = 'bootstrap/fonts/Helvetica/Helvetica400.ttf';
		var $chars_set = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

		function showCaptcha() {
			$img = imagecreatetruecolor($this->img_width, $this->img_height);
			$bg_color = imagecolorallocate($img, 255, 255, 255);
			imagefilledrectangle($img, 0, 0, $this->img_width-1, $this->img_height-1, $bg_color);
			for ($i = 0; $i < $this->line_length; $i++) {
				imageline($img, rand(0, $this->img_width-1), rand(0, $this->img_height-1), 
								rand(0, $this->img_width-1), rand(0, $this->img_height-1),
								imagecolorallocate($img, rand(0, 190), rand(0, 190), rand(0, 190)));
			}
			$y = ($this->img_height / 2) + ($this->font_size / 2);
			$code = '';
			for ($i = 0; $i < $this->char_length; $i++) {
				$angle = rand(-30, 30);
				$color = imagecolorallocate($img, rand(0, 150), rand(0, 150), rand(0, 150));
				$char = substr($this->chars_set, rand(0, strlen($this->chars_set) - 1), 1);
				$code .= $char;
				$x = intval((($this->img_width / $this->char_length) * $i) + ($this->font_size / 2));
				imagettftext($img, $this->font_size, $angle, $x, $y, $color, realpath($this->font), $char);
			}
			$_SESSION['capt_code'] = $code;
			header('Content-Type: image/jpg');
			imagejpeg($img);
			iamgedestroy($img);
		}
	}
?>