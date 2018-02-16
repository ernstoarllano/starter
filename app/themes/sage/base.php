<?php
use Roots\Sage\Setup;
use Roots\Sage\Wrapper;
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>
  <?php
    do_action('get_header');
    get_template_part('templates/debug');
    get_template_part('templates/header');
  ?>
  <main class="main-content" role="main">
    <?php if (Setup\display_content()) : ?>
      <div class="cms-content">
        <?php if (Setup\display_sidebar()) : ?>
          <?php
            include Wrapper\template_path();
            include Wrapper\sidebar_path();
          ?>
        <?php else : ?>
          <?php include Wrapper\template_path(); ?>
        <?php endif; ?>
      </div>
    <?php else : ?>
      <?php include Wrapper\template_path(); ?>
    <?php endif; ?>
  </main>
  <?php
    do_action('get_footer');
    get_template_part('templates/footer');
    wp_footer();
  ?>
</body>
</html>
