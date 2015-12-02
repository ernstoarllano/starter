<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class('c-post c-post--single'); ?>>
    <header class="c-post__header c-post__header--single">
      <h1 class="c-post__title c-post__title--single"><?php the_title(); ?></h1>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="c-post__content c-post__content--single">
      <?php the_content(); ?>
    </div>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
