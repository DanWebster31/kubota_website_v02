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

<section id="news-content">

		<?php 
			if (have_posts()) :
			while (have_posts()) : the_post();

				$featured_image = get_field('post_featured_image');

		?>

		<div class="full news-block <?php echo (++$j % 2 == 0) ? 'bglbrown' : 'bgbrown'; ?>">
			<div class="wrapper-full clearfix">
				
				<div class="half <?php echo (++$q % 2 == 0) ? 'left bgleft newsimgl' : 'right bgright newsimgr'; ?> fullbg" style="background-image: url('<?= $featured_image; ?>')"></div>

				<div class="newstxt half <?php echo (++$r % 2 == 0) ? 'right' : 'left'; ?> news-post-front pad2 reveal fade">
					
					<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>

					<h4 class="date"><?php the_time('F jS, Y') ?></h4>
					
					<?php echo custom_trim_excerpt('','80'); ?>

				</div>
				
			</div>
		</div>

	<?php endwhile; ?>

		<?php if (get_next_posts_link() || get_previous_posts_link()) { ?>

		<div class="navigation full bgwhite">
			<div class="wrapper clearfix">
				<div class="arrow-left"><?php next_posts_link('<i class="fa fa-chevron-left pad1-0"></i> Previous News') ?></div>
				<div class="arrow-right"><?php previous_posts_link('Recent News <i class="fa fa-chevron-right pad1-0"></i>') ?></div>
			</div>
		</div>

		<?php } ?>

	<?php else : ?>

		<h1>Not Found</h1>
		<p>Sorry, but you are looking for something that isn't here.</p>

	<?php endif; ?>

</section>
        
<?php get_footer(); ?>