<header class="c-header" role="banner">
  <div class="o-container">
    <a class="c-header__logo" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
    <nav class="c-header__nav" role="navigation">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'c-nav__list']);
      endif;
      ?>
    </nav>
  </div>
</header> <!-- /.c-header -->
