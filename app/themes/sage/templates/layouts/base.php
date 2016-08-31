<!doctype html>
<html <?php language_attributes(); ?>>
<?php get_template_part('partials/head'); ?>
<body <?php body_class(); ?>>
    <!--[if IE]>
    <div style="margin-bottom:30px;padding:15px;color:#8a6d3b;background-color:#fcf8e3;border:1px solid #faf2cc;">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
    </div>
    <![endif]-->
    <?php
        do_action('get_header');
        get_template_part('partials/debug');
        get_template_part('partials/header');
    ?>
    <?php if (!is_front_page()) { ?>
        <section class="c-content" role="main">
            <div class="o-container">
                <?php if (App\display_sidebar()) { ?>
                    <div class="o-row">
                        <div class="o-col o-col--8@sm">
                            <main class="c-content__main">
                                <?php include App\template()->main(); ?>
                            </main>
                        </div>
                        <div class="o-col o-col--4@sm">
                            <aside class="c-content__sidebar" role="complementary">
                                <?php App\template_part('partials/sidebar'); ?>
                            </aside>
                        </div>
                    </div>
                <?php } else { ?>
                    <main class="c-content__main">
                        <?php include App\template()->main(); ?>
                    </main>
                <?php } ?>
            </div>
        </section>
    <?php } else { ?>
        <?php include App\template()->main(); ?>
    <?php } ?>
    <?php
        do_action('get_footer');
        get_template_part('partials/footer');
        wp_footer();
    ?>
</body>
</html>
