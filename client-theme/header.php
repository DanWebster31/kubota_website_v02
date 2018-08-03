<?php
/**
 * @package client-theme
 */
global $scriptsHeader;

// Scroll to ID on a page
if (isset($_GET["goto"])) {
$goto = $_GET["goto"];
} else {
$goto = '';
}

global $post;
$currentpage = $post->post_name;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="no-js">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?php the_title(); ?></title>

<!-- INCLUDE THE HEADER -->
<?php wp_head(); ?>

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="shortcut icon" href="<?= the_field('favicon','option'); ?>"/>
<link rel="apple-touch-icon" href="<?= the_field('favicon','option'); ?>">

<?php
$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
$ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
if ($iphone || $android || $palmpre || $ipod || $berry || $ipad == true) { ?>
<link href="<?php bloginfo('template_directory'); ?>/includes/css/mobile.css" rel="stylesheet" type="text/css" />
<?php } ?>

<!--[if lte IE 8]>
<link href="<?php //bloginfo('template_directory'); ?>/includes/css-ie.css" rel="stylesheet" type="text/css" media="all" />
<![endif]-->

<!-- ANALYTICS -->
 <script>
 // (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
 // (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
 // m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
 // })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
 //
 // ga('create', '<?= the_field('global-analytics','option'); ?>', 'auto');
 // ga('send', 'pageview');
 </script>

<?php if($goto ) { ?>
  <script>
    $( document ).ready(function() {
    goToByScroll('<?= $goto; ?>');
    });
  </script>
<?php } ?>

<!-- INCLUDED SCRIPTS -->
<?php
  if (!empty($scriptsHeader)) {
  	scriptPrint($scriptsHeader);
  }
?>

</head>

<body id="top" class="<?php if(is_single() || is_archive()) { echo 'locations'; } else { the_slug(); } ?>">

<div id="container">

<a href="javascript:goToByScroll('top');" id="uplink" class="twhite pad1"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>

<!--[if lt IE 7]>
    <div class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</div>
<![endif]-->

<header>

  <a href="/"><img id="logo" src="<?= the_field('logo','option'); ?>" alt="Kubota & Craig"></a>

  <a id="header-menu-toggle" href="javascript:void(0);" class="clearfix"><img class="stretch left" src="<?= get_template_directory_uri(); ?>/images/global/icon-hamburger.svg"><span class="full left">MENU</span></a>

  <nav id="mainmenu">

    <ul id="menu-home-menu">

    <li<? if(is_page('home')) { ?> class="active"<?php } ?>><a href="<? if(is_page('home')) { ?>#slider<?php } else { ?>/<?php } ?>">Home</a></li>
    <!-- <li><a href="<? if(!is_page('home')) { ?>/<?php } ?>#filming-locations">Filming Locations</a></li>
      <ul>
      <?php
        $args = array( 'post_type' => 'locations', 'posts_per_page' => -1 , 'order' => 'ASC');
        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post();
        $locName = $post->post_title;
        $locSlug = $post->post_name;
        $locCity = get_field('city');
        //$locState = get_field('state');
      ?>
      <li<?php if($currentpage == $locSlug) {?> class="active"<?php } ?>><a href="<?= get_permalink(); ?>"><?= $locName; ?><span class="comma"> &bull; </span><span class="city"><?= $locCity; ?></span></a></li>
      <?php endwhile; wp_reset_query(); ?>
      </ul> -->
      <li><a href="<? if(!is_page('home')) { ?>/<?php } ?>#about-us">About Us</a></li>
      <li><a href="<? if(!is_page('home')) { ?>/<?php } ?>#team">Team</a></li>
      <!-- <li><a href="<? if(!is_page('home')) { ?>/<?php } ?>#client-list">Client List</a></li>
      <li><a href="<? if(!is_page('home')) { ?>/<?php } ?>#testimonials">Testimonials</a></li> -->
      <li><a href="<? if(!is_page('home')) { ?>/<?php } ?>#contact-us">Contact Us</a></li>

  </ul>

</nav>

</header>

<section id="slider" class="cycle-slideshow" data-cycle-speed="1000" data-cycle-timeout="5000" data-cycle-slides="> .slide">

        <div id="slidergrad-top"></div>
        <div id="slidergrad-bottom"></div>

        <?php $images = get_field('top_slides'); foreach( $images as $image ): ?>
        <div class="slide cover parallax-bg" style="background-image: url('<?= $image['url']; ?>');"></div>
        <?php endforeach; ?>

        <?php if(is_page('home')) { ?>
          <div id="page-title">
            <h1><?= the_field('slide_text'); ?></h1>
            <h2><?= the_field('slide_sub'); ?></h2>
          </div>
        <?php } else { ?>
          <div id="page-title"><h1><?php the_title(); ?></h1></div>
        <?php } ?>

      <a id="downarrow" href="javascript:goToByScroll('about-us');"><img src="<?= get_template_directory_uri(); ?>/images/home/arrow-down.svg"></a>

</section>
