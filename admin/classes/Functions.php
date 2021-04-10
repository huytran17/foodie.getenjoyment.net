<?php
	class Redirect {
    public function __construct($url = null) {
        if ($url)
        {
            echo '<script>location.href="'.$url.'";</script>';
        }
    }
}
	/**
	 * 
	 */
	class Slug
	{
		public function to_slug($str) {
		    $str = trim(mb_strtolower($str));
		    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
		    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
		    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
		    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
		    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
		    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
		    $str = preg_replace('/(đ)/', 'd', $str);
		    $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
		    $str = preg_replace('/([\s]+)/', '-', $str);
		    return $str;
		}
	}
	class Pagination {
		protected $_config = array(
			'current_page' => 1,
			'total_page' => 1,
			'total_record' => 1,
			'limit' => 10,
			'start' => 0,
			'link_first' => '',
			'link_full' => '',
			'range' => 10,
			'min' => 0,
			'max' => 0
		);
		function init($config = array()) {
			//validate config
			foreach ($config as $key => $value) {
				if (isset($this->_config[$key])) {
					$this->_config[$key] = $value;
				}
			}
			//validate limit
			if ($this->_config['limit'] < 0) {
				$this->_config['limit'] = 0;
			}
			//calc total page
			$this->_config['total_page'] = ceil($this->_config['total_record'] / $this->_config['limit']);
			//validate total page
			if (!$this->_config['total_page']) {
				$this->_config['total_page'] = 1;
			}
			//validate current page
			if ($this->_config['current_page'] < 1) {
				$this->_config['current_page'] = 1;
			}
			if ($this->_config['current_page'] > $this->_config['total_page']) {
				$this->_config['current_page'] = $this->_config['total_page'];
			}
			//calc start
			$this->_config['start'] = ($this->_config['current_page'] - 1) * $this->_config['limit'];
			//calc middle
			$middle = ceil($this->_config['range'] / 2);
			//validate min max
			if ($this->_config['total_page'] < $this->_config['range']) {
				$this->_config['min'] = 1;
				$this->_config['max'] = $this->_config['total_page'];
			}
			else {
				$this->_config['min'] = $this->_config['current_page'] - $middle - 1;
				$this->_config['max'] = $this->_config['current_page'] + $middle - 1;
				//validate min max
				if ($this->_config['min'] < 1) {
					$this->_config['min'] = 1;
					$this->_config['max'] = $this->_config['range'];
				}
				elseif ($this->_config['max'] > $this->_config['total_page']) {
					$this->_config['max'] = $this->_config['total_page'];
					$this->_config['min'] = $this->_config['total_page'] - $this->_config['range'] + 1;
				}
			}
		}
		private function __link($page) {
			if ($page <= 1 && $this->_config['link_first']) {
				return $this->_config['link_first'];
			}
			return str_replace('{page}', $page, $this->_config['link_full']);
		}
		function html() {
			$html = '';
			if ($this->_config['total_record'] > $this->_config['limit']) {
				$html = '<ul class="pagination mt-4">';
				if ($this->_config['current_page'] > 1) {
					$html .= '<li class="page-item"><a class="page-link" href="' .$this->__link('1'). '"><span class="fa fa-angle-double-left"></span></a></li>';
	                $html .= '<li class="page-item"><a class="page-link" href="' .$this->__link($this->_config['current_page'] - 1). '"><span class="fa fa-angle-left"></span></a></li>';
				}
				for ($i = $this->_config['min']; $i <= $this->_config['max']; $i++) { 
					if ($i == $this->_config['current_page']) {
						$html .= '<li class="page-item paging-active"><span class="page-link">' .$i. '</span></li>';
					}
					else $html .= '<li class="page-item"><a class="page-link" href="' .$this->__link($i). '">' .$i. '</a></li>';
				}
				if ($this->_config['current_page'] < $this->_config['total_page']) {
					$html .= '<li class="page-item"><a class="page-link" href="' .$this->__link($this->_config['current_page'] + 1).'"><span class="fa fa-angle-right"></span></a></li>';
					$html .= '<li class="page-item"><a class="page-link" href="' .$this->__link($this->_config['total_page']). '"><span class="fa fa-angle-double-right"></span></a></li>';
				}
				$html .= '</ul>';
			}
			return $html;
		}
	}

?>