<?php
namespace Roots\Sage\CustomPostType;

/**
 * Register CPT
 *
 * @link https://codex.wordpress.org/Function_Reference/register_post_type
 * Register custom post types
 */
function register_cpt()
{

}
add_action('init', __NAMESPACE__ . '\\register_cpt');

/**
 * Register Taxonomies
 *
 * @link https://codex.wordpress.org/Function_Reference/register_taxonomy
 * Register custom taxonomies
 */

function register_taxonomies()
{

}
add_action('init', __NAMESPACE__ . '\\register_taxonomies');
