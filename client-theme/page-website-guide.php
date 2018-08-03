<?php
/**
 * Template Name: Website Guide
 * @package client-theme
 */

/* INCLUDE PAGE SCRIPTS */

$scriptsHeader = '';
$scriptsFooter = '';

get_header(); ?>

<section id="website-guide" class="pad3-0 tcenter">
  <ul>
  <li><a href="/">Home</a></li>
  <li><a href="/#filming-locations">Filming Locations</a></li>
    <ul>
    <?php
      $args = array( 'post_type' => 'locations', 'posts_per_page' => -1 , 'order' => 'ASC');
      $loop = new WP_Query( $args );
      while ( $loop->have_posts() ) : $loop->the_post();
      $locName = $post->post_title;
      $locSlug = $post->post_name;
      $locCity = get_field('city');
      $locState = get_field('state');
    ?>
    <li><a href="<?= get_permalink(); ?>"><?= $locName; ?><span class="comma">, </span><span class="city"><?= $locCity . ', ' . $locState; ?></span></a></li>
    <?php endwhile; wp_reset_query(); ?>
    </ul>
  <li><a href="/#client-list">Client List</a></li>
  <li><a href="/#testimonials">Testimonials</a></li>
  <li><a href="/#about-us">About Us</a></li>
  <li><a href="/#contact-us">Contact Us</a></li>
  <li><a href="/privacy-policy/">Privacy Policy</a></li>
</ul>
</section>


<?php get_footer(); ?>
