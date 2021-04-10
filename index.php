<?php

    /*$cache_ext      = '.html';
    $cache_time     = 43200;
    $cache_folder   = 'cache/';
    $ignore_pages   = array('', '');
    $dynamic_url    = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . $_SERVER['QUERY_STRING'];
    $cache_file     = $cache_folder . md5($dynamic_url) . $cache_ext;
    $ignore         = (in_array($dynamic_url, $ignore_pages)) ? true : false;
    if (!$ignore && file_exists($cache_file) && time() - $cache_time < filemtime($cache_file)) {
        ob_start('ob_gzhandler');
        readfile($cache_file);
        echo '<!-- Cached page - ' . date('l jS \of F Y h:i:s A', filemtime($cache_file)) . ', Page: ' . $dynamic_url . ' -->';
        ob_end_flush();
        exit();
    }
    ob_start('ob_gzhandler');*/

	require_once('core/init.php');
	require_once('includes/header.php');
	require_once('templates/content.php');
	require_once('includes/footer.php');

	/*if (!is_dir($cache_folder)) {
        mkdir($cache_folder);
    }
    if(!$ignore){
        $fp = fopen($cache_file, 'w');
        fwrite($fp, ob_get_contents());
        fclose($fp);
    }
    ob_end_flush();*/
?>