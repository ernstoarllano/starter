<?php while (have_posts()) : the_post(); ?>
    <article <?php post_class('post post--single'); ?>>
        <header class="post__header">
            <h1 class="post__title"><?php the_title(); ?></h1>
            <?php get_template_part('templates/entry-meta'); ?>
        </header>
        <div class="post__content">
            <?php the_content(); ?>
        </div>
        <footer>
            <?php wp_link_pages(['before' => '<nav class="nav nav--pagination"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
        </footer>
        <?php comments_template('/templates/comments.php'); ?>
    </article>
<?php endwhile; ?>
