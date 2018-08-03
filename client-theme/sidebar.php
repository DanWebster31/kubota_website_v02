<?php
/**
 * @package client-theme
 */
?>

<div id="categories" class="left">
	<h2>Categories</h2>
	<ul>
		<li <?php if (is_home()) { print 'class="current-cat"'; } ?>><a href="/news/">All News</a></li>
		<?php wp_list_categories('title_li=&exclude=1'); ?>
	</ul>
</div>

<div id="facebook" class="left">
	<h2>Get Social</h2>
	<div id="fb-root"></div>
	<script>
		(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=246041785417109";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
	<div class="fb-page" data-href="<?= the_field('facebook','option'); ?>" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="<?= the_field('facebook','option'); ?>"><a href="<?= the_field('facebook','option'); ?>"><?php bloginfo('name'); ?></a></blockquote></div></div>
</div>

<div id="weather" class="left">
	<h2>Current Weather</h2>
	<?php $city = get_field('global_city','option'); $state = get_field('global_state','option'); echo do_shortcode( '[wunderground location="' . $city . ', '. $state   .'" numdays="1" iconset="Incredible" layout="current" hidedata="search"]' ); ?>
</div>