<header class="banner navbar navbar-default  <?php echo heels_nav_class(); ?>" role="navigation">
	<div class="<?php echo heels_container_class(); ?>">

	<div class="navbar-header">
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only">Toggle navigation</span>
		<div id="mobile-menu-icon">
			<span></span>
			<span></span>
			<span></span>
			<span></span>
		</div>
	</button>
	<?php if ( get_theme_mod( 'themeslugsmall_logo' ) ) : ?>
		<a class="navbar-brand navbar-brand-logo" href='<?php echo esc_url( home_url() ); ?>' title='<?php echo esc_attr( get_bloginfo( ' name ', 'display ' ) ); ?>' rel='home'><img src='<?php echo esc_url( get_theme_mod( 'themeslugsmall_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'></a>
	<?php else : ?>
	<a class="navbar-brand" href="<?php echo home_url(); ?>/"><?php bloginfo( 'name' ); ?></a>
	<?php endif; ?>
	</div>

	<nav class="collapse navbar-collapse" role="navigation">
		<?php
		if ( has_nav_menu( 'primary_navigation' ) ) :
			wp_nav_menu(array(
				'theme_location' => 'primary_navigation',
				'menu_class'     => 'nav navbar-nav',
				'walker'         => new Mega_Menu_Walkernav()
			) );
	endif;
		?>
	</nav>
	</div>
</header>
