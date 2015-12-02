<?php
use Roots\Sage\Config;
use Roots\Sage\Wrapper;
use Roots\Sage\Extras;
?>

<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <!--[if lt IE 9]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>
    <?php if (!is_front_page()) { ?>
      <section class="c-main c-main--<?= Extras\main_class(); ?>" role="document">
        <div class="o-container">
          <div class="o-layout">
            <div class="col-8">
              <?php include Wrapper\template_path(); ?>
            </div>
            <?php if (Config\display_sidebar()) : ?>
              <aside class="col-4" role="complementary">
                <?php include Wrapper\sidebar_path(); ?>
              </aside>
            <?php endif; ?>
          </div>
        </div>
      </section> <!-- /.c-main -->
    <?php } else { ?>
      <?php include Wrapper\template_path(); ?>
    <?php } ?>
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
