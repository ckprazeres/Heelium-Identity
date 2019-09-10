<?php
/**
 * Initialize the custom theme options.
 */
add_action( 'admin_init', 'custom_theme_options' );

function heels_get_post_types(){
	$args = array(
	   'public'   => true,
	   '_builtin' => false
	);

	$output = 'object'; // names or objects, note names is the default
	$operator = 'and'; // 'and' or 'or'

	$post_types = get_post_types( $args, $output, $operator );
	return $post_types;
}

function heels_add_post_type_options($ot_setting_options, $column_options){
	$args = array(
	   'public'   => true,
	   '_builtin' => false
	);

	$output = 'object'; // names or objects, note names is the default
	$operator = 'and'; // 'and' or 'or'

	$post_types = heels_get_post_types();

	foreach ( $post_types  as $post_type ) {
		$name = $post_type->name;
		$singular = $post_type->labels->singular_name;
		$plural = $post_type->labels->name;
		$ot_setting_options[] = array(
				'id'          => 'layout-'.$name,
				'label'       => __( $singular, 'unc-heels-settings.txt' ),
				'desc'        => __( 'Individual ' . $singular . ' pages', 'unc-heels-settings.txt' ),
				'std'         => 'inherit',
				'type'        => 'radio-image',
				'section'     => 'layout',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'condition'   => '',
				'operator'    => '',
				'choices'     => $column_options
			);
		/*$ot_setting_options[] = array(
				'id'          => 'layout-'.$name.'-archive',
				'label'       => __( $plural . ' Archive', 'unc-heels-settings.txt' ),
				'desc'        => __( $plural . ' archive', 'unc-heels-settings.txt' ),
				'std'         => 'inherit',
				'type'        => 'radio-image',
				'section'     => 'layout',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'condition'   => '',
				'operator'    => '',
				'choices'     => $column_options
			);
		*/
		$ot_setting_options[] = array(
				'id'		=> 's1-'.$name,
				'label'		=>  $singular.' -- Left',
				'desc'		=> 'The left sidebar ',
				'type'		=> 'sidebar-select',
				'section'	=> 'sidebars'
			);
		$ot_setting_options[] =  array(
				'id'		=> 's2-'.$name,
				'label'		=> $singular.' -- Right',
				'desc'		=> 'The right sidebar that will show up on single '.$singular.' type pages',
				'type'		=> 'sidebar-select',
				'section'	=> 'sidebars'
			);
		/*$ot_setting_options[] = array(
				'id'		=> 's1-'.$name.'-archive',
				'label'		=> $plural.' Archive -- Left',
				'desc'		=> 'The left side bar that will show up on '.$plural.' archive pages',
				'type'		=> 'sidebar-select',
				'section'	=> 'sidebars'
			);
		$ot_setting_options[] =  array(
				'id'		=> 's2-'.$name.'-archive',
				'label'		=> $plural.' Archive -- Right',
				'desc'		=> 'The right side bar that will show up on '.$plural.' archive pages',
				'type'		=> 'sidebar-select',
				'section'	=> 'sidebars'
			);
		*/
	}
	return $ot_setting_options;

}





/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
	/**
	 * Get a copy of the saved settings array.
	 */
	$saved_settings = get_option( 'option_tree_settings', array() );


    $heels_column_options = array(
					array(
						'value'       => 'inherit',
						'label'       => __( 'Inherit Global Layout', 'unc-heels-settings.txt' ),
						'src'         => get_template_directory_uri() . '/assets/img/option-tree/layout-off.png'
					),
					array(
						'value'       => 'col-1c',
						'label'       => __( '1 Column', 'unc-heels-settings.txt' ),
						'src'         => get_template_directory_uri() . '/assets/img/option-tree/col-1c.png'
					),
					array(
						'value'       => 'col-2cl',
						'label'       => __( '2 Column Left', 'unc-heels-settings.txt' ),
						'src'         => get_template_directory_uri() . '/assets/img/option-tree/col-2cl.png'
					),
					array(
						'value'       => 'col-2cr',
						'label'       => __( '2 Column Right', 'unc-heels-settings.txt' ),
						'src'         => get_template_directory_uri() . '/assets/img/option-tree/col-2cr.png'
					),
					array(
						'value'       => 'col-3cm',
						'label'       => __( '3 Column Middle', 'unc-heels-settings.txt' ),
						'src'         => get_template_directory_uri() . '/assets/img/option-tree/col-3cm.png'
					)
				);


	/**
	 * Custom settings array that will eventually be
	 * passes to the OptionTree Settings API Class.
	 */
	$custom_settings = array(
		'sections'        => array(
			array(
				'id'          => 'layout',
				'title'       => __( 'Layout', 'unc-heels-settings.txt' )
			),
			array(
				'id'          => 'sidebars',
				'title'       => __( 'Sidebars', 'unc-heels-settings.txt')
			),
			array(
				'id'          => 'container',
				'title'       => __( 'Container', 'unc-heels-settings.txt' )
			)
			,
			array(
				'id'          => 'header',
				'title'       => __( 'Header', 'unc-heels-settings.txt' )
			)

		),
		'settings'        => array(
			array(
				'id'          => 'layout-global',
				'label'       => __( 'Global Layout', 'unc-heels-settings.txt' ),
				'desc'        => __( 'Other layouts will override this option if they are set', 'unc-heels-settings.txt' ),
				'std'         => 'col-3cm',
				'type'        => 'radio-image',
				'section'     => 'layout',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'condition'   => '',
				'operator'    => '',
				'choices'     => array(
					array(
						'value'       => 'col-1c',
						'label'       => __( '1 Column', 'unc-heels-settings.txt' ),
						'src'         => get_template_directory_uri() . '/assets/img/option-tree/col-1c.png'
					),
					array(
						'value'       => 'col-2cl',
						'label'       => __( '2 Column Left', 'unc-heels-settings.txt' ),
						'src'         => get_template_directory_uri() . '/assets/img/option-tree/col-2cl.png'
					),
					array(
						'value'       => 'col-2cr',
						'label'       => __( '2 Column Right', 'unc-heels-settings.txt' ),
						'src'         => get_template_directory_uri() . '/assets/img/option-tree/col-2cr.png'
					),
					array(
						'value'       => 'col-3cm',
						'label'       => __( '3 Column Middle', 'unc-heels-settings.txt' ),
						'src'         => get_template_directory_uri() . '/assets/img/option-tree/col-3cm.png'
					)
				)
			),
			array(
				'id'          => 'layout-home',
				'label'       => __( 'Front Page (Home)', 'unc-heels-settings.txt' ),
				'desc'        => __( '[ <strong>is_front_page</strong> ] Front page layout - If front page has a set layout, it will overide this', 'unc-heels-settings.txt' ),
				'std'         => 'inherit',
				'type'        => 'radio-image',
				'section'     => 'layout',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'condition'   => '',
				'operator'    => '',
				'choices'     => $heels_column_options
			),
			array(
				'id'          => 'layout-blog',
				'label'       => __( 'Blog page', 'unc-heels-settings.txt' ),
				'desc'        => __( '[ <strong>is_home</strong> ] This is whatever you set to be your main blog page', 'unc-heels-settings.txt' ),
				'std'         => 'inherit',
				'type'        => 'radio-image',
				'section'     => 'layout',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'condition'   => '',
				'operator'    => '',
				'choices'     => $heels_column_options
			),
			array(
				'id'          => 'layout-single',
				'label'       => __( 'Single', 'unc-heels-settings.txt' ),
				'desc'        => __( '[ <strong>is_single</strong> ] Single post layout - If a post has a set layout, it will override this.', 'unc-heels-settings.txt' ),
				'std'         => 'inherit',
				'type'        => 'radio-image',
				'section'     => 'layout',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'condition'   => '',
				'operator'    => '',
				'choices'     => $heels_column_options
			),
			array(
				'id'          => 'layout-archive',
				'label'       => __( 'Archive', 'unc-heels-settings.txt' ),
				'desc'        => __( '[ <strong>is_archive</strong> ] Category, date, tag and author archive layout', 'unc-heels-settings.txt' ),
				'std'         => 'inherit',
				'type'        => 'radio-image',
				'section'     => 'layout',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'condition'   => '',
				'operator'    => '',
				'choices'     => $heels_column_options
			),
			array(
				'id'          => 'layout-category',
				'label'       => __( 'Archive &mdash; Category', 'unc-heels-settings.txt' ),
				'desc'        => __( '[ <strong>is_category</strong> ] Category archive layout', 'unc-heels-settings.txt' ),
				'std'         => 'inherit',
				'type'        => 'radio-image',
				'section'     => 'layout',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'condition'   => '',
				'operator'    => '',
				'choices'     => $heels_column_options
			),
			array(
				'id'          => 'layout-tag',
				'label'       => __( 'Archive &mdash; Tag', 'unc-heels-settings.txt' ),
				'desc'        => __( '[ <strong>is_tag</strong> ] Tag archive layout', 'unc-heels-settings.txt' ),
				'std'         => 'inherit',
				'type'        => 'radio-image',
				'section'     => 'layout',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'condition'   => '',
				'operator'    => '',
				'choices'     => $heels_column_options
			),
			array(
				'id'          => 'layout-search',
				'label'       => __( 'Search', 'unc-heels-settings.txt' ),
				'desc'        => __( '[ <strong>is_search</strong> ] Search page layout', 'unc-heels-settings.txt' ),
				'std'         => 'inherit',
				'type'        => 'radio-image',
				'section'     => 'layout',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'condition'   => '',
				'operator'    => '',
				'choices'     => $heels_column_options
			),
			array(
				'id'          => 'layout-404',
				'label'       => __( 'Error 404', 'unc-heels-settings.txt' ),
				'desc'        => __( '[ <strong>is_404</strong> ] Error 404 page layout', 'unc-heels-settings.txt' ),
				'std'         => 'inherit',
				'type'        => 'radio-image',
				'section'     => 'layout',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'condition'   => '',
				'operator'    => '',
				'choices'     => $heels_column_options
			),
			array(
				'id'          => 'layout-page',
				'label'       => __( 'Default Page', 'unc-heels-settings.txt' ),
				'desc'        => __( '[ <strong>is_page</strong> ] Default page layout - If a page has a set layout, it will override this.', 'unc-heels-settings.txt' ),
				'std'         => 'inherit',
				'type'        => 'radio-image',
				'section'     => 'layout',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'condition'   => '',
				'operator'    => '',
				'choices'     => $heels_column_options
			),
			array(
				'id'          => 'container-layout',
				'label'       => __( 'Container', 'unc-heels-settings.txt' ),
				'desc'        => __( 'Container type', 'unc-heels-settings.txt' ),
				'std'         => 'contained',
				'type'        => 'radio-image',
				'section'     => 'container',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'condition'   => '',
				'operator'    => '',
				'choices'     => array(
					array(
						'value'       => 'contained',
						'label'       => __( 'Contained text with full width background – Allows the header and footer background to extend the entire width of the browser while keeping your content contained within a fixed width in the center of the browser window.', 'unc-heels-settings.txt' ),
						'src'         => get_template_directory_uri() . '/assets/img/option-tree/contained-width.png'
					),
					array(
						'value'       => 'full',
						'label'       => __( 'Full width text and backgrounds – Allows your content to extend across the entire width of you browser window.', 'unc-heels-settings.txt' ),
						'src'         => get_template_directory_uri() . '/assets/img/option-tree/full-width.png'
					),
					array(
						'value'       => 'boxed',
						'label'       => __( 'Boxed Site – Allows you to place a box around your website’s content and separate it from the background. This is best illustrated by the below image.', 'unc-heels-settings.txt' ),
						'src'         => get_template_directory_uri() . '/assets/img/option-tree/boxed-container.png'
					),
				)
			),
			array(
				'id'          => 'header-style',
				'label'       => __( 'Header Type', 'unc-heels-settings.txt' ),
				'desc'        => __( 'Header type. For this child theme, only this option is available.', 'unc-heels-settings.txt' ),
				'std'         => 'both',
				'type'        => 'radio-image',
				'section'     => 'header',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'condition'   => '',
				'operator'    => '',
				'choices'     => array(
					array(
						'value'       => 'nav',
						'label'       => __( 'Just use the navbar', 'unc-heels-settings.txt' ),
						'src'         => get_template_directory_uri() . '/assets/img/option-tree/single-header.png'
					),
				)
			),
			array(
				'id'          => 'background-color',
				'label'       => __( 'Background Color', 'theme-text-domain' ),
				'desc'        => __( 'Add a background color', 'theme-text-domain' ),
				'std'         => '#ffffff',
				'type'        => 'colorpicker',
				'section'     => 'container',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'condition'   => '',
				'operator'    => 'and'
			),
			array(
				'id'          => 'background-image',
				'label'       => __( 'Background image', 'unc-heels-settings.txt' ),
				'desc'        => sprintf( __( 'A background image can be used to spice up your site. Generally pairs best with the boxed container style.', 'unc-heels-settings.txt' ), apply_filters( 'ot_upload_text', __( 'Send to OptionTree', 'theme-text-domain' ) ), 'FTP' ),
				'std'         => '',
				'type'        => 'upload',
				'section'     => 'container',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'condition'   => '',
				'operator'    => 'and'
		    ),
			array(
				'id'          => 'stickynav',
				'label'       => __( 'Sticky Navigation', 'theme-text-domain' ),
				'desc'        => __( 'Sticky, or fixed, navigation is basically a website menu that is locked into place so that it does not disappear when the user scrolls down the page. If you do not wish to make you header menu sticky you can simply turn this option off.', 'theme-text-domain' ),
				'std'         => 'no',
				'type'        => 'radio',
				'section'     => 'header',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'condition'   => '',
				'operator'    => 'and',
				'choices'     => array(
				  array(
					'value'       => 'yes',
					'label'       => __( 'Yes', 'theme-text-domain' ),
					'src'         => ''
				  ),
				  array(
					'value'       => 'no',
					'label'       => __( 'No', 'theme-text-domain' ),
					'src'         => ''
				  ),
				)
			  ),


			// Sidebars: Create Areas
			array(
				'id'		=> 'sidebar-areas',
				'label'		=> 'Create Sidebars',
				'desc'		=> 'You must save changes for the new areas to appear below. <br /><i>Warning: Make sure each area has a unique ID.</i>',
				'type'		=> 'list-item',
				'section'	=> 'sidebars',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => 'heelsoptionsidebars',
				'condition'   => '',
				'operator'    => '',
				'choices'	=> array(),
				'settings'	=> array(
					array(
						'id'		=> 'id',
						'label'		=> 'Sidebar ID',
						'desc'		=> 'This ID must be unique, for example "sidebar-about"',
						'std'		=> 'sidebar-',
						'type'		=> 'text',
						'choices'	=> array()
					)
				)
			),
			// Sidebar 1 & 2
			array(
				'id'		=> 's1-home',
				'label'		=> 'Front Page (Home)',
				'desc'		=> '[ <strong>is_front_page</strong> ] Left Sidebar Area - If the front page has a unique sidebar, it will override this.',
				'type'		=> 'sidebar-select',
				'section'	=> 'sidebars'
			),
			array(
				'id'		=> 's2-home',
				'label'		=> 'Front Page (Home)',
				'desc'		=> '[ <strong>is_front_page</strong> ] Right Sidebar Area - If the front page has a unique sidebar, it will override this.',
				'type'		=> 'sidebar-select',
				'section'	=> 'sidebars'
			),
			array(
				'id'		=> 's1-blog',
				'label'		=> 'Blog Page (Blog)',
				'desc'		=> '[ <strong>is_home</strong> ] Left Sidebar Area - If the blog page has a unique sidebar, it will override this.',
				'type'		=> 'sidebar-select',
				'section'	=> 'sidebars'
			),
			array(
				'id'		=> 's2-blog',
				'label'		=> 'Blog Page (Blog)',
				'desc'		=> '[ <strong>is_home</strong> ] Right Sidebar Area - If the blog page has a unique sidebar, it will override this.',
				'type'		=> 'sidebar-select',
				'section'	=> 'sidebars'
			),
			array(
				'id'		=> 's1-single',
				'label'		=> 'Single',
				'desc'		=> '[ <strong>is_single</strong> ] Left Sidebar Area - If a single post has a unique sidebar, it will override this.',
				'type'		=> 'sidebar-select',
				'section'	=> 'sidebars'
			),
			array(
				'id'		=> 's2-single',
				'label'		=> 'Single',
				'desc'		=> '[ <strong>is_single</strong> ] Right Sidebar Area - If a single post has a unique sidebar, it will override this.',
				'type'		=> 'sidebar-select',
				'section'	=> 'sidebars'
			),
			array(
				'id'		=> 's1-archive',
				'label'		=> 'Archive',
				'desc'		=> '[ <strong>is_archive</strong> ] Left Sidebar Area',
				'type'		=> 'sidebar-select',
				'section'	=> 'sidebars'
			),
			array(
				'id'		=> 's2-archive',
				'label'		=> 'Archive',
				'desc'		=> '[ <strong>is_archive</strong> ] Right Sidebar Area',
				'type'		=> 'sidebar-select',
				'section'	=> 'sidebars'
			),
			array(
				'id'		=> 's1-archive-category',
				'label'		=> 'Archive &mdash; Category',
				'desc'		=> '[ <strong>is_category</strong> ] Left Sidebar Area',
				'type'		=> 'sidebar-select',
				'section'	=> 'sidebars'
			),
			array(
				'id'		=> 's2-archive-category',
				'label'		=> 'Archive &mdash; Category',
				'desc'		=> '[ <strong>is_category</strong> ] Right Sidebar Area',
				'type'		=> 'sidebar-select',
				'section'	=> 'sidebars'
			),
			array(
				'id'		=> 's1-archive-tag',
				'label'		=> 'Archive &mdash; Tag',
				'desc'		=> '[ <strong>is_tag</strong> ] Left Sidebar Area',
				'type'		=> 'sidebar-select',
				'section'	=> 'sidebars'
			),
			array(
				'id'		=> 's2-archive-tag',
				'label'		=> 'Archive &mdash; Tag',
				'desc'		=> '[ <strong>is_tag</strong> ] Right Sidebar Area',
				'type'		=> 'sidebar-select',
				'section'	=> 'sidebars'
			),
			array(
				'id'		=> 's1-search',
				'label'		=> 'Search',
				'desc'		=> '[ <strong>is_search</strong> ] Left Sidebar Area',
				'type'		=> 'sidebar-select',
				'section'	=> 'sidebars'
			),
			array(
				'id'		=> 's2-search',
				'label'		=> 'Search',
				'desc'		=> '[ <strong>is_search</strong> ] Right Sidebar Area',
				'type'		=> 'sidebar-select',
				'section'	=> 'sidebars'
			),
			array(
				'id'		=> 's1-404',
				'label'		=> 'Error 404',
				'desc'		=> '[ <strong>is_404</strong> ] Left Sidebar Area',
				'type'		=> 'sidebar-select',
				'section'	=> 'sidebars'
			),
			array(
				'id'		=> 's2-404',
				'label'		=> 'Error 404',
				'desc'		=> '[ <strong>is_404</strong> ] Right Sidebar Area',
				'type'		=> 'sidebar-select',
				'section'	=> 'sidebars'
			),
			array(
				'id'		=> 's1-page',
				'label'		=> 'Default Page',
				'desc'		=> '[ <strong>is_page</strong> ] Left Sidebar Area - If a page has a unique sidebar, it will override this.',
				'type'		=> 'sidebar-select',
				'section'	=> 'sidebars'
			),
			array(
				'id'		=> 's2-page',
				'label'		=> 'Default Page',
				'desc'		=> '[ <strong>is_page</strong> ] Right Sidebar Area - If a page has a unique sidebar, it will override this.',
				'type'		=> 'sidebar-select',
				'section'	=> 'sidebars'
			)
		)
	);

	$custom_settings['settings'] = heels_add_post_type_options($custom_settings['settings'], $heels_column_options);

	/* allow settings to be filtered before saving */
	$custom_settings = apply_filters( 'option_tree_settings_args', $custom_settings );

	/* settings are not the same update the DB */
	if ( $saved_settings !== $custom_settings ) {
		update_option( 'option_tree_settings', $custom_settings );
	}

}
