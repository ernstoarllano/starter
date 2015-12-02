<form role="search" method="get" class="c-search" action="<?= esc_url(home_url('/')); ?>">
  <label class="sr-only"><?php _e('Search for:', 'sage'); ?></label>
  <div class="c-search__group">
    <input type="search" value="<?= get_search_query(); ?>" name="s" class="c-search__field" placeholder="<?php _e('Search', 'sage'); ?> <?php bloginfo('name'); ?>" required>
    <button type="submit" class="c-btn c-search__btn"><?php _e('Search', 'sage'); ?></button>
  </div>
</form>
