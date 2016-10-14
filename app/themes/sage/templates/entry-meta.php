<time class="c-post__date" datetime="<?= get_post_time('c', true); ?>"><?= get_the_date(); ?></time>
<p class="c-post__author"><?= __('By', 'sage'); ?> <a href="<?= get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?= get_the_author(); ?></a></p>
