<?php use Roots\Sage\Extras; ?>
<?php get_template_part('templates/page', 'header'); ?>
<?php if (!have_posts()) : ?>
  <div class="c-alert c-alert--warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
<?php endif; ?>
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
<?php endwhile; ?>
<?php if ($wp_query->max_num_pages > 1) : ?>
  <?= Extras\numbered_pagination(); ?>
<?php endif; ?>
