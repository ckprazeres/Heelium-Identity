<?php
	if (
		(!function_exists('tribe_is_event') || (!tribe_is_event() && !is_single()))
		&& (!is_front_page() || is_home()) //Don't show title if homepage is static page, show if blog posts page
	) { ?>
		<div class="full-width-contained blue">
			<div class="page-icon"></div>
			<div class="page-header">
			<h1><?php echo roots_title(); ?></h1>

			<?php the_breadcrumb(); ?>
			</div>
		</div>
	<?php 
}