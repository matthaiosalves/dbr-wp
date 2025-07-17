<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Diário_Brasileiro_Habbo
 */

?>

</div> <!-- .container -->

<footer class="page-footer">
	<div class="container">
		<div class="row">
			<div class="col l2 s12">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/dbr.png" alt="DBR Logo">
			</div>
			<div class="col l10 s12">
				<p>Este site não possui vínculos com o Exército Brasileiro, não é de propriedade ou operado pela Sulake Corporation Oy e não é parte do Habbo Hotel®. Desenvolvido por sr.carolvitoria e majoryanzinho.</p>
			</div>
		</div>
	</div>
	<div class="footer-copyright">
		<div class="container">
			© 2012 - <?php echo date('Y'); ?> Copyright Diário Brasileiro, DBR
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/script.js"></script>

</body>

</html>