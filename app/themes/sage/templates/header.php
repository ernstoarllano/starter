<header class="header">
  <div class="header-container">
    <a class="logo" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
    <nav class="nav nav--header">
      <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav__list']);
        endif;
      ?>
    </nav>
    <button class="nav-toggle">
      <span class="nav-toggle__line"></span>
    </button>
  </div>
</header>
