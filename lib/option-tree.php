<?php
/* ------------------------------------------------------------------------- *
 *  OptionTree framework integration: Use in theme mode
/* ------------------------------------------------------------------------- */

add_filter( 'ot_theme_mode', '__return_true' );
load_template( get_template_directory() . '/option-tree/ot-loader.php' );
load_template( get_stylesheet_directory() . '/lib/theme-options.php' );
load_template( get_template_directory() . '/lib/theme-options-meta-boxes.php');
