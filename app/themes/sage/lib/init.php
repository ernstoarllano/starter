<?php

namespace Roots\Sage\Init;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
  load_theme_textdomain('sage', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'sage')
  ]);

  // Add post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');

  // Add post formats
  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

  // Add HTML5 markup for captions
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list']);

  // Add WooCommerce support
  add_theme_support('woocommerce');

  // Create custom Client Admin role. NOTE: Some plugins create their own capabilities that will need to be added to this array if the client needs to have access to it.
  // Gravity forms is a good example of this. See below.
  remove_role( 'client_admin' );
  add_role('client_admin', __('Client Admin', 'modular'), [
    'read' => true,
    'read_private_posts' => true,
    'read_private_pages' => true,
    'edit_posts' => true,
    'publish_posts' => true,
    'edit_published_posts' => true,
    'edit_private_posts' => true,
    'edit_others_posts' => true,
    'delete_posts' => true,
    'delete_published_posts' => true,
    'delete_private_posts' => true,
    'delete_others_posts' => true,
    'edit_pages' => true,
    'publish_pages' => true,
    'edit_published_pages' => true,
    'edit_private_pages' => true,
    'edit_others_pages' => true,
    'edit_theme_options' => true,
    'delete_pages' => true,
    'delete_published_pages' => true,
    'delete_private_pages' => true,
    'delete_others_pages' => true,
    'manage_categories' => true,
    'upload_files' => true,
    'edit_files' => true,
    'unfiltered_html' => true,
    'manage_links' => true,
    'moderate_comments' => true,
    'export' => true,
    'import' => true,
    'edit_dashboard' => true,
    'gravityforms_create_form' => true,
    'gravityforms_delete_entries' => true,
    'gravityforms_delete_forms' => true,
    'gravityforms_edit_entries' => true,
    'gravityforms_edit_entry_notes' => true,
    'gravityforms_edit_forms' => true,
    'gravityforms_edit_settings' => true,
    'gravityforms_export_entries' => true,
    'gravityforms_feed' => true,
    'gravityforms_view_entries' => true,
    'gravityforms_view_entry_notes' => true,
    'gravityforms_view_settings' => true
  ]);
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Register sidebars
 */
function widgets_init() {
  register_sidebar([
    'name'          => __('Primary', 'sage'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Footer', 'sage'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');
