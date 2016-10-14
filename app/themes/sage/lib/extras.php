<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;
use Roots\Sage\Assets;

/**
 * Add <body> classes
 *
 * @link https://developer.wordpress.org/reference/functions/body_class/
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
    if (Setup\display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 *
 * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/excerpt_more
 */
function excerpt_more()
{
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

/**
 * Custom admin styles
 *
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/login_head
 */
function admin_styles()
{
    if (in_array($GLOBALS['pagenow'], ['wp-login.php','wp-register.php'])) {
        wp_enqueue_style('sage/admin', Assets\asset_path('styles/admin.css'), false, null);
    }
}
add_action('login_head', __NAMESPACE__ . '\\admin_styles');

/**
 * Custom login url
 *
 * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/login_headerurl
 */
function login_url()
{
    return get_home_url();
}
add_filter('login_headerurl', __NAMESPACE__ . '\\login_url');

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
  return '<div class="o-col o-col--'.$columns.'@md">'.do_shortcode($content).'</div>';
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
//add_post_type_support('page', 'excerpt');

/**
 * Add shortcode to text widgets
 */
//add_filter('widget_text', 'do_shortcode');

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
    $paged  = (get_query_var('paged') == 0) ? 1 : get_query_var('paged');
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
 * Image Tag
 *
 * @link https://codex.wordpress.org/Function_Reference/get_image_tag
 * @link http://luis-almeida.github.io/unveil/
 *
 * Return modified version of WordPress image tag to lazy load images
 */
function image_tag($html, $id, $alt, $title, $align, $size)
{
    list($img_src) = image_downsize($id, $size);
    $class = 'align'.esc_attr($align).' size-'.esc_attr($size).' wp-image-'.$id;
    $class = apply_filters('get_image_tag_class', $class, $id, $align, $size);
    return '<img src="'.get_stylesheet_directory_uri().'/dist/images/loading.gif" data-src="'.esc_attr($img_src).'" alt="'.esc_attr($alt).'" class="'.$class.'" />';
}
//add_filter('get_image_tag', __NAMESPACE__ . '\\image_tag', 10, 6);

/**
 * Custom image sizes
 *
 * @link https://developer.wordpress.org/reference/functions/add_image_size/
 *
 * e.g. add_image_size('w800x400', 800, 400, true)
 */
