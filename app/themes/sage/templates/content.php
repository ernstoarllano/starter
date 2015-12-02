<article <?php post_class('c-post'); ?>>
  <header class="c-post__header">
    <h2 class="c-post__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php get_template_part('templates/entry-meta'); ?>
  </header>
  <div class="c-post__content">
    <?php the_excerpt(); ?>
  </div>
</article>
