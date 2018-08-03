<?php
/**
 * @package client-theme
 */
  $path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
  include($path.'wp-load.php')
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title><?php bloginfo('name'); ?> - 404 Not Found</title>
  <link href="<?php bloginfo('template_directory'); ?>/includes/css/404.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body>

  <div id="four-oh-four">
    <img id="logo" src="<?= the_field('logo_dark','option'); ?>">
		<h1>Error 404: File Not Found</h1>
		<p>The page you are looking for isn't here.<br />Please <a href="/">click here</a> to return to the home page.</p>
  </div>
</body>

</html>
