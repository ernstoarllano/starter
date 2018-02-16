<?php use Roots\Sage\Extras; ?>

<?php get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert--error">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'search'); ?>
<?php endwhile; ?>

<?php if ($wp_query->max_num_pages > 1) { ?>
    <?= Extras\numbered_pagination($wp_query); ?>
<?php } ?>
