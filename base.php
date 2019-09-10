<?php get_template_part('templates/head'); ?>

<body <?php body_class(); ?>>



<!--[if lt IE 8]>
<div class="alert alert-warning">
    <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?>
</div>
<![endif]-->
<div class="<?php echo heels_box_class(); ?>">
    <div class="row">
        <?php

        do_action('get_header');
        get_template_part('templates/header-top-navbar-small');

        ?>
    </div>
        <div class="row">
            <?php heels_above_content_area(); ?>
        </div>

    <div class="wrap row" role="document">

        <div class="content <?php echo heels_container_class(); ?>">
            <div class="row ">
                <main class="main <?php echo roots_main_class(); ?>" role="main">
                    <?php include roots_template_path(); ?>
                </main><!-- /.main -->
                <?php if (HeelsSidebars::get_instance()->left_sidebar) : ?>
                    <aside class="sidebar <?php echo roots_left_sidebar_class(); ?>" role="complementary">
                        <?php include roots_sidebar_path('left'); ?>
                    </aside><!-- /.sidebar -->
                <?php endif; ?>
                <?php if (HeelsSidebars::get_instance()->right_sidebar) : ?>
                    <aside class="sidebar <?php echo roots_sidebar_class(); ?>" role="complementary">
                        <?php include roots_sidebar_path('right'); ?>
                    </aside><!-- /.sidebar -->
                <?php endif; ?>
            </div>
        </div><!-- /.content -->
    </div><!-- /.wrap -->
    <div class="row">
        <?php heels_below_content_area(); ?>
    </div>

    <div class="row">
        <?php get_template_part('templates/footer'); ?>
    </div>
</div>


</body>
</html>