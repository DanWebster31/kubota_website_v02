<?php
/**
 * Template Name: Home
 * @package client-theme
 */

/* INCLUDE PAGE SCRIPTS */

$scriptsHeader = '';
$scriptsFooter = 'js/contrib/one-page-nav.js, js/home.js, js/global.js';

get_header(); ?>

<section id="about-us">
  <div class="wrapper pad4-0 tcenter">
    <h2 class="hometitle tprimary-dark tcenter upper">About Us</h2>
    <?php the_field('about_us_text'); ?>
    <div class="injury-icon tcenter"><img src="<?= get_template_directory_uri(); ?>/images/home/injury-icon.png" alt="injury"></div>
  </div>
</section>

<section id="team" class="bgsecondary marb2">

  <div class="wrapper pad4-0 twhite tcenter">
    <h2 class="hometitle tprimary tcenter upper"><?= the_field('team_title'); ?></h2>
    <?= the_field('team_text'); ?>
  </div>

  <div id="team-members">
  <?php if( have_rows('team_members') ): ?>
    <?php $count = 0; ?>
    <?php while ( have_rows('team_members') ) : the_row(); ?>
      <?php $image = get_sub_field('photo'); ?>
      <?php if ( $count %2 != 0 ) { ?>
      <div class="team-member pushleft">
      <?php } else { ?>
        <div class="team-member pushright">
      <?php } ?>
        <div class="team-member-photo">
          <img src="<?php echo $image['url']; ?>" />
          <div class="team-member-info">
            <a href="mailto:<?= the_sub_field('email'); ?>">
            <img src="<?= get_template_directory_uri(); ?>/images/global/email.svg" alt="email"><h2>Email <?php the_sub_field('email_name'); ?></h2>
          </a>
          </div>
        </div>
        <div class="team-member-text">
<<<<<<< HEAD
          <h2><?php the_sub_field('name'); ?></h2>
          <h3><?php the_sub_field('title'); ?></h3>
          <div class="team-member-bio">
            <p><?php the_sub_field('bio'); ?></p>
          </div>
=======
          <h2><?php the_sub_field('team_member_name'); ?></h2>
          <h3><?php the_sub_field('team_member_title'); ?></h3>
        </div>
        <div class="team-member-bio">
          <p><?php the_sub_field('team_member_bio'); ?></p>
>>>>>>> origin/master
        </div>
      </div>
      <?php $count++; ?>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>

</section>

<!-- <section id="client-list" class="fixedbg">
  <div class="wrapper pad3-0 tcenter">
    <h2 class="hometitle">CLIENT LIST</h2>
    <p>Kubota & Craig has hosted a number of large productions, including:</p>
    <div class="third-gutter1 mart2 clearfix">

        <?php //if( have_rows('clients_left') ): ?>
            <ul class="third left">
            <?php //while ( have_rows('clients_left') ) : the_row(); ?>
              <li><?php //the_sub_field('client_name'); ?></li>
            <?php //endwhile; ?>
            </ul>
          <?php //endif; ?>

          <?php //if( have_rows('clients_middle') ): ?>
              <ul class="third left">
              <?php //while ( have_rows('clients_middle') ) : the_row(); ?>
                <li><?php //the_sub_field('client_name'); ?></li>
              <?php //endwhile; ?>
              </ul>
          <?php //endif; ?>

            <?php //if( have_rows('clients_right') ): ?>
                <ul class="third left">
                <?php //while ( have_rows('clients_right') ) : the_row(); ?>
                  <li><?php //the_sub_field('client_name'); ?></li>
                <?php //endwhile; ?>
                </ul>
            <?php //endif; ?>
    </div>
  </div>
</section> -->

<!-- <section id="testimonials" class="bgtertiary">

    <h2 class="hometitle twhite tcenter upper">Testimonials</h2>

    <div id="testimonials-slideshow" class="cycle-slideshow" data-cycle-fx="scrollHorz" data-cycle-timeout="0" data-cycle-swipe="true" data-cycle-pause-on-hover="true" data-cycle-speed="500" data-cycle-slides="> .testimonial-box">

      <?php //if( have_rows('testimonials') ): ?>
          <?php //while ( have_rows('testimonials') ) : the_row(); ?>
            <div class="testimonial-box cover" style="background-image: url('<?php //the_sub_field('testimonials_background_image'); ?>')">
              <div class="wrapper">
              <?php //the_sub_field('testimonial_text'); ?>
              <div class="fade-cover"></div>
              <img class="testimonial-logo" src="<?php //the_sub_field('testimonial_logo'); ?>" alt="">
              </div>
            </div>
          <?php //endwhile; ?>
      <?php //endif; ?>

    	<div class="cycle-prev gallery-left"><img src="<?= get_template_directory_uri(); ?>/images/global/arrow-left.svg" ></div>
  		<div class="cycle-next gallery-right"><img src="<?= get_template_directory_uri(); ?>/images/global/arrow-right.svg" ></div>
		</div>

</section> -->


<section id="contact-us">
  <div class="wrapper pad3-0">
    <h2 class="hometitle tprimary-dark tcenter upper">Contact Us</h2>
    <p class="tcenter">For more information about Kubota & Craig, please give us a call. We look forward to hearing from you.</p>
    <div class="contact-row">
      <h2 class="tprimary tcenter"><img src="<?= get_template_directory_uri(); ?>/images/global/phone.svg" alt="call"> <?= the_field('contact_phone','option'); ?></h2>
  </div>
<!--
    <form name="interest-list" id="interest-list" class="clearfix">

    			<input name="notification" type="hidden" value="p11creative@gmail.com" />
    			<input name="source" type="hidden" value="Website" />
    			<input name="community" type="hidden" value="" />

    			<div id="errorchecking" class="alert hidden full left">
    				<p>For more information regarding Kubota & Craig, please call or submit the following information. We look forward to hearing from you.</p>
    			</div>

    			<div id="sec1" class="half left">

    				<div class="fielditem">

    					<input type="text" class="required" required name="firstName" id="firstName" placeholder="FIRST NAME*" value="" />
    				</div>

    				<div class="fielditem">
    					<input type="text" class="required" required name="lastName" id="lastName" placeholder="LAST NAME*" value="" />
    				</div>

    				<div class="fielditem">
    					<input type="email" class="required" required name="email" id="email" placeholder="EMAIL*" value="" />
    				</div>

    				<div class="fielditem">
    					<input type="text" name="phone" id="phone" placeholder="PHONE" value="" />
    				</div>

    			</div>

    			<div id="sec2" class="left half">

            <div  class="fielditem">
              <textarea id="comments" name="comments" placeholder="COMMENTS"></textarea>
            </div>

    			</div>

    			<div id="form-submit" class="full left tcenter">
    				<span>*Required</span>
    				<input type="submit" value="SUBMIT" id="submitbutton" class="trans" />
    			</div>

    		</form> -->


  </div>
</section>

<!-- <script type="text/javascript">
$('#testimonials-slideshow').on('cycle-before',function(e, optionHash, outgoingSlideEl, incomingSlideEl, forwardFlag){
  $('.testimonial-box').removeClass('fademe');
  $(incomingSlideEl).addClass('fademe')
});
</script> -->

<?php get_footer(); ?>
