<?php

namespace App;

/**
 * Theme customizer
 */
add_action('customize_register', function (\WP_Customize_Manager $wp_customize) {
    // Add postMessage support
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->selective_refresh->add_partial('blogname', [
        'selector' => '.brand',
        'render_callback' => function () {
            bloginfo('name');
        }
    ]);

    // Set custom branding
    $wp_customize->add_setting('branding', [
        'type'      => 'option',
        'default'   => '',
        'transport' => 'postMessage'
    ]);

    $wp_customize->add_control(new \WP_Customize_Image_Control($wp_customize, 'branding', [
        'label'     => 'Site Branding',
        'section'   => 'title_tagline',
        'settings'  => 'branding'
    ]));

    $wp_customize->get_setting('branding')->transport = 'postMessage';

    // Set custom analytics section
    $wp_customize->add_section('analytics', [
        'title'         => 'Google Tag Manager',
        'description'   => '',
        'priority'      => 120
    ]);

    $wp_customize->add_setting('google_tag_manager', [
        'type'      => 'option',
        'default'   => '',
        'transport' => 'postMessage'
    ]);

    $wp_customize->add_control('google_tag_manager', [
        'label'         => 'Google Tag Manager',
        'section'       => 'analytics',
        'settings'      => 'google_tag_manager',
        'description'   => 'Exclude the GTM portion'
    ]);

    // Set custom location info section
    $wp_customize->add_section('location_info', [
        'title'         => 'Location Info',
        'description'   => '',
        'priority'      => 120
    ]);

    // Define location meta options to create
    $location_meta = [
        'Street'    => 'location_street',
        'City'      => 'location_city',
        'State'     => 'location_state',
        'Zipcode'   => 'location_zipcode',
        'Phone'     => 'location_phone',
        'Email'     => 'location_email'
    ];

    foreach ($location_meta as $key => $meta) {
        $wp_customize->add_setting($meta, [
            'type'      => 'option',
            'default'   => '',
            'transport' => 'postMessage'
        ]);

        $wp_customize->add_control($meta, [
            'label'         => $key,
            'section'       => 'location_info',
            'settings'      => $meta
        ]);
    }

    // Set custom social media section
    $wp_customize->add_section('social_media', [
        'title'         => 'Social Media',
        'description'   => '',
        'priority'      => 120
    ]);

    // Define social options to create
    $links = [
        'Facebook'          => 'facebook_url',
        'TripAdvisor'       => 'tripadvisor_url',
        'Yelp'              => 'yelp_url',
        'Twitter'           => 'twitter_url',
        'Google'            => 'google_url',
        'Instagram'         => 'instagram_url',
        'Pinterest'         => 'pinterest_url',
        'LinkedIn'          => 'linkedin_url',
    ];

    // Set social options
    foreach ($links as $key => $link) {
        $wp_customize->add_setting($link, [
            'type'      => 'option',
            'default'   => '',
            'transport' => 'postMessage'
        ]);

        $wp_customize->add_control($link, [
            'label'     => $key,
            'section'   => 'social_media',
            'settings'  => $link
        ]);
    }
});

/**
 * Customizer JS
 */
add_action('customize_preview_init', function () {
    wp_enqueue_script('sage/customizer.js', asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
});

/*
 * Add custom page template column
 */
add_filter('manage_edit-page_columns', function($page_columns) {
    $page_columns['template'] = __('Page Template');

    return $page_columns;
});

/**
 * Populate custom page template column
 */
add_action('manage_page_posts_custom_column', function($column_name) {
    if ('template' !== $column_name) {
        return;
      }

      global $post;

      $template_name = get_page_template_slug($post->ID);
      $template = untrailingslashit(get_stylesheet_directory()) . '/' . $template_name;

      if (strlen(trim($template_name)) === 0 || !file_exists($template)) {
        $template_name = __('Default');
      } else {
        $template_name = get_file_description($template);
      }

      echo esc_html($template_name);
});

/**
 * Add custom registration date column
 */
add_filter('manage_users_columns', function($columns) {
    $columns['registration_date'] = 'Registration Date';

    return $columns;
});

/**
 * Populate custom registration date column
 */
add_filter('manage_users_custom_column', function($row_output, $column_id_attr, $user) {
    $date_format = 'm/d/Y g:i a';

    switch ( $column_id_attr ) {
      case 'registration_date':
        return date( $date_format, strtotime( get_the_author_meta( 'registered', $user ) ) );
      break;
    }

    return $row_output;
}, 10, 3);

/*
 * Disable page editor on templates with default content
 */
add_action('init', function() {
    if ( isset($_GET['post']) ) {
        switch ( get_post_meta($_GET['post'], '_wp_page_template', true) ) {
            case 'views/template-accessibility.blade.php':
            case 'views/template-privacy-policy.blade.php':
                remove_post_type_support('page', 'editor');
            break;
        }
    }
});

/**
 * ACF Options Page
 */
if (function_exists('acf_add_options_page')) {
    acf_add_options_page([
      'page_title' => 'Global Info',
      'menu_title' => 'Global Info',
      'menu_slug'  => 'global-info',
      'capability' => 'edit_posts',
      'redirect'   => false
    ]);
}
