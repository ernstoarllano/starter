<?php
/**
 * Template Name: Home
 */
?>

<section class="c-home c-home--intro">
    <div class="o-container">
        <?php while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile; ?>
    </div>
</section>
