<?php namespace App;

/**
 * Custom url for logo on login page
 * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/login_headerurl
 */
add_filter('login_headerurl', function () {
    return get_home_url();
});

/**
 * Row
 *
 * @param array $atts
 * Return row module shortcode
 */
add_shortcode('row', function ($atts, $content = null) {
    return '<div class="o-row">'.do_shortcode($content).'</div>';
});

/**
 * Column
 *
 * @param array $atts
 * Return column module shortcode
 */
add_shortcode('column', function ($atts, $content = null) {
    extract(shortcode_atts([
      'columns' => 6,
    ], $atts));

    return '<div class="o-col o-col--'.$columns.'">'.do_shortcode($content).'</div>';
});
