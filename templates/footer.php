<footer class="content-info" role="contentinfo">
	<div class="footer-container guidelines-container">
		<div class="container">
			<div class="row">
				<section class="col-md-4 col-sm-6 col-xs-12">
					<img src="<?php print(get_stylesheet_directory_uri() . '/assets/img/footer-unc-logo.png'); ?>" id="footer-logo">
				</section>
				<section class="col-md-4 col-sm-6 col-xs-12">
					<p id="footer-guidelines-text">University Branding and Visual Identity Guidelines</p>
				</section>
				<section class="col-md-4 col-sm-6 col-xs-12">
					<?php
						$guidelines_url = get_theme_mod('guidelines');
						if($guidelines_url) { ?>
							<a class="btn btn-guidelines guidelines-link" href="<?php echo $guidelines_url ?>">Full Guidelines</a>
					<?php } else { ?>
						Go to the Customizer > Footer Guidelines to upload the full guidelines file.
					<?php } ?>
				</section>
			</div>
		</div>
	</div>
	<div class="footer-container footer-widgets-container <?php echo heels_container_class(); ?>">
		<div class="row">
		<?php dynamic_sidebar('sidebar-footer'); ?>
		
		</div>
	</div>
		<div id="copyright">
				<?php
				$heels_copyright = get_theme_mod( 'copyright_textbox', '' );
				if($heels_copyright) { ?>
						<p class="copyright">&copy; <?php echo date('Y'); ?> <?php echo $heels_copyright; ?></p>
				<?php } else { ?>
						<p class="copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
				<?php } ?>
	</div>
</footer>
<?php wp_footer(); ?>