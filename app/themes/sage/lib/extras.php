<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Config;
use Roots\Sage\Assets;

/**
 * Add <body> classes
 */
function body_class($classes)
{
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Config\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more()
{
  return ' &hellip; <a class="c-post__more" href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

/**
 * Custom login
 */
function login()
{
  if (in_array($GLOBALS['pagenow'], ['wp-login.php','wp-register.php'])) {
    wp_enqueue_style('sage_login', Assets\asset_path('styles/custom-login.css'), false, null);
  }
}
add_action('login_head', __NAMESPACE__ . '\\login');

/**
 * Custom login url
 */
function login_url()
{
  return get_home_url();
}
add_filter('login_headerurl', __NAMESPACE__ . '\\login_url');

/**
 * Numbered Pagination
 *
 * Return numbered pagination
 */
function numbered_pagination()
{
  global $wp_query;

  $limit = 999999999;

  $pagination = paginate_links([
    'base'    => str_replace( $limit, '%#%', esc_url(get_pagenum_link($limit))),
    'format'  => '/page/%#%',
    'current' => max( 1, get_query_var('paged') ),
    'total'   => $wp_query->max_num_pages,
    'type'    => 'array'
  ]);

  if (is_array($pagination)) {
    $paged = (get_query_var('paged') == 0) ? 1 : get_query_var('paged');

    $output = '<nav class="c-post__nav">
                <ol class="c-post__nav-list">';

    foreach ($pagination as $page) {
      $output .= '<li class="c-post__nav-item">'.$page.'</li>';
    }

    return $output .= ' </ol>
                       </nav>';
  }
}

/**
 * Row
 *
 * @param array $atts
 *
 * Return row module shortcode
 */
function row($atts, $content = null)
{
  return '<div class="o-row">'.do_shortcode($content).'</div>';
}
add_shortcode('row', __NAMESPACE__ . '\\row');

/**
 * Column
 *
 * @param array $atts
 *
 * Return column module shortcode
 */
function column($atts, $content = null)
{
  extract(shortcode_atts([
    'columns' => 'Columns',
  ], $atts));

  return '<div class="o-col o-col--'.$columns.'">'.do_shortcode($content).'</div>';
}
add_shortcode('column', __NAMESPACE__ . '\\column');

/**
 * Column Inner
 *
 * @param array $atts
 *
 * Return column inner container shortcode
 */
function column_inner($atts, $content = null)
{
  return '<div class="o-col__inner">'.do_shortcode($content).'</div>';
}
add_shortcode('inner', __NAMESPACE__ . '\\column_inner');

/**
 * Add Excerpts to pages
 */
add_post_type_support('page', 'excerpt');

/**
 * Add shortcode to text widgets
 */
add_filter('widget_text', 'do_shortcode');

/**
 * Modify Query
 *
 * Modify main wp_query
 */
function modify_query($query)
{
  /*if ($query->is_home) {
    $query->set('category__not_in', []);
  }*/
}
//add_action('pre_get_posts', __NAMESPACE__ . '\\modify_query');

/**
 * Current URL
 *
 * Return current page url
 */
function current_url()
{
  global $wp;

  return home_url(add_query_arg([],$wp->request)).'/';
}

/**
 * Main Class
 *
 * Return main class modifier
 */
function main_class()
{
  global $post;

  if (is_tax()) {
    return 'taxonomy';
  } elseif (is_home() || is_single()) {
    return 'blog';
  } elseif (is_category()) {
    return 'category';
  } else {
    return $post->post_name;
  }
}

/**
 * Image Tag
 *
 * @link https://codex.wordpress.org/Function_Reference/get_image_tag
 * @link http://luis-almeida.github.io/unveil/
 *
 * Return modified version of WordPress image tag to use unveil.js
 */
function image_tag($html, $id, $alt, $title, $align, $size)
{
  list($img_src) = image_downsize($id, $size);

  $class = 'align'.esc_attr($align).' size-'.esc_attr($size).' wp-image-'.$id;
  $class = apply_filters('get_image_tag_class', $class, $id, $align, $size);

  return '<img src="'.get_stylesheet_directory_uri().'/dist/images/loading.gif" data-src="'.esc_attr($img_src).'" alt="'.esc_attr($alt).'" class="'.$class.'" />';
}
//add_filter('get_image_tag', __NAMESPACE__ . '\\image_tag', 10, 6);
