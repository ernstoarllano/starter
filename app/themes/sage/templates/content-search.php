<article <?php post_class('c-post c-post--search'); ?>>
    <header class="c-post__header">
        <h2 class="c-post__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>
        <?php if (get_post_type() === 'post') { ?>
            <?php get_template_part('templates/entry-meta'); ?>
        <?php } ?>
    </header>
    <div class="c-post__summary">
        <?php the_excerpt(); ?>
    </div>
</article>
