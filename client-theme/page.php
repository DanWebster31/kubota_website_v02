<?php
/**
 * @package client-theme
 */
get_header(); ?>

<section id="default-content" class="bgwhite">
	<div class="wrapper pad3-0">
			<?php
				while ( have_posts() ) : the_post();
					the_content();
				endwhile;
			?>
	</div>
</section>

<?php get_footer(); ?>
