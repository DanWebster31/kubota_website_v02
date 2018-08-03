<?php
/**
 * @package client-theme
 */

global $scriptsFooter;

?>

<footer id="footer" class="bgtertiary">
  <div class="wrapper pad3-0 tcenter">
    <img id="footer-logo" src="<?= the_field('logo','option'); ?>" alt="Kubota & Craig">
    <p id="copyright" class="twhite">Copyright &copy;<?= date(Y); ?> Kubota & Craig. All Rights Reserved.</p>
      <!-- <a href="/privacy-policy/">Privacy&nbsp;Policy</a> &nbsp; <a href="/website-guide/">Website&nbsp;Guide</a>. -->
  </div>
</footer>

<script>
  // Change <html> classes if JavaScript is enabled
  document.documentElement.classList.remove('no-js');
  document.documentElement.classList.add('js');
</script>

<style>
  /* Ensure elements load hidden before ScrollReveal runs */
  .js .reveal { visibility: hidden; }
</style>

<?php wp_footer(); ?>

<script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>

<?php
	if (!empty($scriptsFooter)) {
		scriptPrint($scriptsFooter);
	}
?>

<?php
if(get_field('footer_scripts', 'options')):
  the_field('footer_scripts', 'options');
endif;
?>

</div> <!-- end #container -->

</body>
</html>
