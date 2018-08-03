<?php
/**
 * @package client-theme
 */

/* INCLUDE PAGE SCRIPTS */

$apikey = get_field('google_api_key','option');
$scriptsHeader = 'css/gmap.css, //maps.googleapis.com/maps/api/js?v=3.3&key='. $apikey;
$scriptsFooter = 'js/location.js';

get_header(); ?>

<section id="intro">
  <div class="wrapper pad3-0 tcenter">
    <?= the_field('intro_text'); ?>
  </div>
</section>

<section id="highlights">
  <div class="wrapper padb3">
    <h2 class="hometitle tprimary-dark tcenter marb1 upper">Highlights</h2>

    <div class="half-gutter2 clearfix">

        <?php if( have_rows('highlights_left') ): ?>
            <ul class="half left">
            <?php while ( have_rows('highlights_left') ) : the_row(); ?>
              <li><?php the_sub_field('highlight'); ?></li>
            <?php endwhile; ?>
            </ul>
          <?php endif; ?>

          <?php if( have_rows('highlights_right') ): ?>
              <ul class="half left">
              <?php while ( have_rows('highlights_right') ) : the_row(); ?>
                <li><?php the_sub_field('highlight'); ?></li>
              <?php endwhile; ?>
              </ul>
            <?php endif; ?>
    </div>
  </div>
</section>

<section id="gallery" class="bgtertiary">
  <div class="wrapper pad3-0 tcenter clearfix">
    <h2 class="hometitle tprimary upper">Gallery</h2>

    <ul id="gallery-nav" class="secmenu pad2-0">
      <li><a class="active" href="#location-slideshow">Photos</a></li>
      <?php if(is_single("renaissance-tower")) { ?>
        <li><a href="#location-vr">Community Tour</a></li>
        <li><a href="#location-vr2">Penthouse Tour</a></li>
      <?php } else { ?>
        <li><a href="#location-vr">Virtual Tour</a></li>
      <?php } ?>

    </ul>

    <div id="location-slideshow" class="gallery-links cycle-slideshow" data-cycle-fx="scrollHorz" data-cycle-timeout="0" data-cycle-swipe="true" data-cycle-caption-plugin="caption2" data-cycle-caption-template="{{title}}" data-cycle-pause-on-hover="true" data-cycle-speed="500" data-cycle-slides="> .slide">

      <?php $images = get_field('gallery_photos'); foreach( $images as $image ): ?>
      <div class="slide cover" style="background-image: url('<?= $image['url']; ?>');" data-cycle-title="<?= $image['title']; ?>"></div>
      <?php endforeach; ?>

      <div class="cycle-caption twhite tcenter"></div>

    	<div class="cycle-prev gallery-left"><img src="<?= get_template_directory_uri(); ?>/images/global/arrow-left.svg" ></div>
  		<div class="cycle-next gallery-right"><img src="<?= get_template_directory_uri(); ?>/images/global/arrow-right.svg" ></div>
		</div>

    <div id="location-vr" class="gallery-links">
      <iframe src="<?= the_field('virtual_tour_link'); ?>" scrolling="no" style="height: 100%; width: 100%; display: inline;">
         Sorry your browser does not support inline frames.
      </iframe>
    </div>

    <?php if( get_field('virtual_tour_link_2') ) { ?>
    <div id="location-vr2" class="gallery-links">
      <iframe src="<?= the_field('virtual_tour_link_2'); ?>" scrolling="no" style="height: 100%; width: 100%; display: inline;">
         Sorry your browser does not support inline frames.
      </iframe>
    </div>
    <?php } ?>

  </div>
</section>

<section id="contact-us">
  <div class="wrapper pad3-0 padb2 tcenter">
    <h2 class="hometitle marb1 tprimary-dark tcenter upper">Contact Us</h2>
    <p>Thank you for your interest in the <?php the_title(); ?> community. For more information regarding filming at this location, please call us or contact us online.</p>
    <h4 class="pad1-0 tprimary-dark"><?= the_field('contact_name','option'); ?> &nbsp;|&nbsp; <?= the_field('contact_title','option'); ?> &nbsp;|&nbsp; <?= the_field('contact_phone','option'); ?><br />
        <span class="upper"><?php the_title(); ?></span><br />
        <?= the_field('address'); ?>, <?= the_field('city'); ?>, <?= the_field('state'); ?> <?= the_field('zip'); ?></h4>
    <?php if( get_field('website') ) { ?><a href="<?= the_field('website'); ?>" target="_blank" class="boxbtn mar1">Visit Community Website</a><?php } ?>
  </div>

  <div id="googledirections" class="tcenter twhite padb1">
  	<div class="wrapper">
  		<form action="http://maps.google.com/maps" method="get" target="_blank" class="clearfix fade">
  			<h3 class="tprimary-dark">Get Google Directions</h3>
  			<input type="hidden" name="daddr" value="<?= the_field('address'); ?>, <?= the_field('global_city'); ?>, <?= the_field('global_state'); ?> <?= the_field('global_zip'); ?>" />
  			<input type="text" id="saddr" name="saddr" placeholder="Enter Starting Address" />
  			<input type="submit" value="&#xf105;" id="google-btn" />
  		</form>
  	</div>
  </div>

  <section id="gmapHolder" class="clearfix bsurrogate">
    <div class="map-views">Satellite View</div>
    <div class="map-views2">Map View</div>
    <div id="map_canvas"></div>
    <div id="cd-zoom-in"></div>
    <div id="cd-zoom-out"></div>
  </section>

  <?php get_template_part("content-gmap"); ?>

</section>


<?php get_footer(); ?>
