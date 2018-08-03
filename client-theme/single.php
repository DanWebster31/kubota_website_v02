<?php
/**
 * @package client-theme
 */

/* INCLUDE PAGE SCRIPTS */

$scriptsHeader = '';
$scriptsFooter = '';


get_header(); ?>

<section id="intro" class="bgwhite pad2">
	<div class="wrapper clearfix">

		<?php get_sidebar(); ?>

	</div>
</section> <!-- / #homeSubhead -->


<section id="newsContent">

	<?php 
		if (have_posts()) :
		while (have_posts()) : the_post();
	?>

		<div class="full">
			<div class="wrapper news-wrapper">
				<div class="news-post clearfix reveal newstxt fade">
				
					<?php

						$featured_image = get_field('post_featured_image');

						if( $featured_image ) {
							echo '<img src="'.$featured_image.'" class="stretch" />';
						} else {
							echo '<img src="'.get_bloginfo('template_url').'/images/news/default.jpg" class="stretch" />';    
						}

					?>

					<h3 class="newstitle"><?php the_title(); ?></h3>
					<h4 class="date"><?php the_time('F jS, Y') ?></h4>

					<?php the_content(); ?>

					<div class="sharing-and-caring clearfix">
						<a class="addthis_button" href="javascript:void(0);"><i class="fa fa-share-alt"></i> Share</a>
					</div>
					
					<a href="/news/" class="go-back clearfix"><span class="backtext"> Back To Main</span><span class="backarrow"></span></a>

				</div>
			</div>
		</div>

	<?php endwhile; endif; ?>

</section>
        
<?php get_footer(); ?>