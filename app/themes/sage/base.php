<?php
use Roots\Sage\Setup;
use Roots\Sage\Wrapper;
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>
    <!--[if IE]>
        <div class="alert alert--warning">
            <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
        </div>
    <![endif]-->
    <?php
        do_action('get_header');
        get_template_part('templates/debug');
        get_template_part('templates/header');
    ?>
    <?php if (Setup\display_content()) : ?>
        <div class="content content--main">
            <div class="container">
                <?php if (Setup\display_sidebar()) : ?>
                    <div class="row">
                        <div class="col col--8@md">
                            <?php include Wrapper\template_path(); ?>
                        </div>
                        <div class="col col--4@md">
                            <?php include Wrapper\sidebar_path(); ?>
                        </div>
                    </div>
                <?php else : ?>
                    <?php include Wrapper\template_path(); ?>
                <?php endif; ?>
            </div>
        </div>
    <?php else : ?>
        <?php include Wrapper\template_path(); ?>
    <?php endif; ?>
    <?php
        do_action('get_footer');
        get_template_part('templates/footer');
        wp_footer();
    ?>
</body>
</html>
