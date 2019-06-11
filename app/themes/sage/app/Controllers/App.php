<?php

namespace App\Controllers;

use Sober\Controller\Controller;

/**
 * App
 *
 * Global methods to use throughout the build
 */
class App extends Controller
{
    /**
     * Site Name
     *
     * @return  string  The site name
     */
    public function siteName()
    {
        return get_bloginfo('name');
    }

    /**
     * Page Title
     *
     * @return  string  The page title
     */
    public static function title()
    {
        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }
            return __('Latest Posts', 'sage');
        }
        if (is_archive()) {
            return get_the_archive_title();
        }
        if (is_search()) {
            return sprintf(__('Search Results for %s', 'sage'), get_search_query());
        }
        if (is_404()) {
            return __('Not Found', 'sage');
        }
        return get_the_title();
    }

    /**
     * Google Tag Manager
     *
     * @return  string  The sites Google Tag Manager
     */
    public function tag_manager() {
        $tag = get_option('google_tag_manager');

        if ($tag) {
            return $tag;
        }

        return;
    }

    /**
     * Directions
     *
     * @return  string  The locations full address
     */
    public function directions() {
        if (get_option('location_street') && get_option('location_city') && get_option('location_state') && get_option('location_zipcode')) {
            return get_option('location_street') . ' ' . get_option('location_city') . ' ' . get_option('location_state') . ' ' . get_option('location_zipcode');
        }
    }

    /**
     * Location Schema
     *
     * NOTE: Need to add a type switch to change the schema
     *
     * @param   string  $type   The type of schema to return
     * @return  string
     */
    public function location() {
        if ( get_option('location_street') && get_option('location_city') && get_option('location_state') && get_option('location_zipcode') ) {
            $html = '<div itemscope itemtype="http://schema.org/RVPark">
                        <p class="mb-0 itemprop="name">'.self::siteName().'</p>
                        <address itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                            <span itemprop="streetAddress">'.get_option('location_street').'</span>
                            <span itemprop="addressLocality">'.get_option('location_city').'</span>,
                            <span itemprop="addressRegion">'.get_option('location_state').'</span>
                            <span itemprop="postalCode">'.get_option('location_zipcode').'</span>
                        </address>
                     </div>';

            return $html;
        }

        return;
    }

    /**
     * Location Phone
     *
     * @return  string  The location's phone number
     */
    public function phone() {
        if (get_option('location_phone')) {
            return get_option('location_phone');
        }

        return;
    }

    /**
     * Location Email
     *
     * @return  string  The location's email
     */
    public function email() {
        if (get_option('location_email')) {
            return get_option('location_email');
        }

        return;
    }

    /**
     * Location Social
     *
     * @return  array   The location's social media links
     */
    public function social() {
        $social_links = [];

        $social_mods = [
            'facebook' => [
                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 264 512"><path d="M76.7 512V283H0v-91h76.7v-71.7C76.7 42.4 124.3 0 193.8 0c33.3 0 61.9 2.5 70.2 3.6V85h-48.2c-37.8 0-45.1 18-45.1 44.3V192H256l-11.7 91h-73.6v229"/></svg>',
                'url' => get_option('facebook_url')
            ],
            'tripadvisor' => [
                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M166.4 280.521c0 13.236-10.73 23.966-23.966 23.966s-23.966-10.73-23.966-23.966 10.73-23.966 23.966-23.966 23.966 10.729 23.966 23.966zm264.962-23.956c-13.23 0-23.956 10.725-23.956 23.956 0 13.23 10.725 23.956 23.956 23.956 13.23 0 23.956-10.725 23.956-23.956-.001-13.231-10.726-23.956-23.956-23.956zm89.388 139.49c-62.667 49.104-153.276 38.109-202.379-24.559l-30.979 46.325-30.683-45.939c-48.277 60.39-135.622 71.891-197.885 26.055-64.058-47.158-77.759-137.316-30.601-201.374A186.762 186.762 0 0 0 0 139.416l90.286-.05a358.48 358.48 0 0 1 197.065-54.03 350.382 350.382 0 0 1 192.181 53.349l96.218.074a185.713 185.713 0 0 0-28.352 57.649c46.793 62.747 34.964 151.37-26.648 199.647zM259.366 281.761c-.007-63.557-51.535-115.075-115.092-115.068C80.717 166.7 29.2 218.228 29.206 281.785c.007 63.557 51.535 115.075 115.092 115.068 63.513-.075 114.984-51.539 115.068-115.052v-.04zm28.591-10.455c5.433-73.44 65.51-130.884 139.12-133.022a339.146 339.146 0 0 0-139.727-27.812 356.31 356.31 0 0 0-140.164 27.253c74.344 1.582 135.299 59.424 140.771 133.581zm251.706-28.767c-21.992-59.634-88.162-90.148-147.795-68.157-59.634 21.992-90.148 88.162-68.157 147.795v.032c22.038 59.607 88.198 90.091 147.827 68.113 59.615-22.004 90.113-88.162 68.125-147.783zm-326.039 37.975v.115c-.057 39.328-31.986 71.163-71.314 71.106-39.328-.057-71.163-31.986-71.106-71.314.057-39.328 31.986-71.163 71.314-71.106 39.259.116 71.042 31.94 71.106 71.199zm-24.512 0v-.084c-.051-25.784-20.994-46.645-46.778-46.594-25.784.051-46.645 20.994-46.594 46.777.051 25.784 20.994 46.645 46.777 46.594 25.726-.113 46.537-20.968 46.595-46.693zm313.423 0v.048c-.02 39.328-31.918 71.194-71.247 71.173s-71.194-31.918-71.173-71.247c.02-39.328 31.918-71.194 71.247-71.173 39.29.066 71.121 31.909 71.173 71.199zm-24.504-.008c-.009-25.784-20.918-46.679-46.702-46.67-25.784.009-46.679 20.918-46.67 46.702.009 25.784 20.918 46.678 46.702 46.67 25.765-.046 46.636-20.928 46.67-46.693v-.009z"/></svg>',
                'url' => get_option('tripadvisor_url')
            ],
            'yelp' => [
                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M136.9 328c-1 .3-109.2 35.7-115.8 35.7-15.2-.9-18.5-16.2-19.9-31.2-1.5-14.2-1.4-29.8.3-46.8 1.9-18.8 5.5-45.1 24.2-44 4.8 0 67.1 25.9 112.7 44.4 17.1 6.8 18.6 35.8-1.5 41.9zm57.9-113.9c1.8 38.2-25.5 48.5-47.2 14.3L41.3 60.4c-1.5-6.6.3-12.4 5.3-17.4C62.2 26.5 146 3.2 168.1 8.9c7.5 1.9 12.1 6.1 13.8 12.6 1.3 8.3 11.5 167.4 12.9 192.6zm-1.4 164.8c0 4.6.2 116.4-1.7 121.5-2.3 6-7 9.7-14.3 11.2-10.1 1.7-27.1-1.9-51-10.7-22-8.1-56.7-21.5-49.3-42.5 2.8-6.9 51.4-62.8 77.3-93.6 12-15.2 39.8-5.5 39 14.1zm180.2-117.8c-5.6 3.7-110.8 28.2-118.1 30.6l.3-.6c-18.1 4.7-35.4-18.5-23.3-34.6 3.7-3.7 65.9-92.4 72.8-97 5.2-3.6 11.3-3.8 18.3-.6 18.4 8.8 55.1 63.1 57.4 84.6-.1 2.9 1.2 11.7-7.4 17.6zm10.1 130.7c-2.7 20.6-44.5 73.4-63.8 81-6.9 2.6-12.9 2-17.7-2-5-3.5-61.8-97.1-64.9-102.3-10.9-16.2 6.8-39.8 25.6-33.2 0 0 110.5 35.7 114.7 39.4 5.2 4.1 7.2 9.8 6.1 17.1z"/></svg>',
                'url' => get_option('yelp_url')
            ],
            'twitter' => [
                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"/></svg>',
                'url' => get_option('twitter_url')
            ],
            'google' => [
                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512"><path d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"/></svg>',
                'url' => get_option('google_url')
            ],
            'instagram' => [
                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>',
                'url' => get_option('instagram_url')
            ],
            'pinterest' => [
                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path d="M496 256c0 137-111 248-248 248-25.6 0-50.2-3.9-73.4-11.1 10.1-16.5 25.2-43.5 30.8-65 3-11.6 15.4-59 15.4-59 8.1 15.4 31.7 28.5 56.8 28.5 74.8 0 128.7-68.8 128.7-154.3 0-81.9-66.9-143.2-152.9-143.2-107 0-163.9 71.8-163.9 150.1 0 36.4 19.4 81.7 50.3 96.1 4.7 2.2 7.2 1.2 8.3-3.3.8-3.4 5-20.3 6.9-28.1.6-2.5.3-4.7-1.7-7.1-10.1-12.5-18.3-35.3-18.3-56.6 0-54.7 41.4-107.6 112-107.6 60.9 0 103.6 41.5 103.6 100.9 0 67.1-33.9 113.6-78 113.6-24.3 0-42.6-20.1-36.7-44.8 7-29.5 20.5-61.3 20.5-82.6 0-19-10.2-34.9-31.4-34.9-24.9 0-44.9 25.7-44.9 60.2 0 22 7.4 36.8 7.4 36.8s-24.5 103.8-29 123.2c-5 21.4-3 51.6-.9 71.2C65.4 450.9 0 361.1 0 256 0 119 111 8 248 8s248 111 248 248z"/></svg>',
                'url' => get_option('pinterest_url')
            ],
            'linkedin' => [
                'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448.1 512"><path d="M100.3 448H7.4V148.9h92.9V448zM53.8 108.1C24.1 108.1 0 83.5 0 53.8S24.1 0 53.8 0s53.8 24.1 53.8 53.8-24.1 54.3-53.8 54.3zM448 448h-92.7V302.4c0-34.7-.7-79.2-48.3-79.2-48.3 0-55.7 37.7-55.7 76.7V448h-92.8V148.9h89.1v40.8h1.3c12.4-23.5 42.7-48.3 87.9-48.3 94 0 111.3 61.9 111.3 142.3V448h-.1z"/></svg>',
                'url' => get_option('linkedin_url')
            ],
        ];

        foreach ($social_mods as $key => $social_mod) {
            if ( $social_mod['url'] ) {
                $social_links[$key] = $social_mod;
            }
        }

        return $social_links;
    }

    /**
     * Copyright
     *
     * @return  string  The default copyright
     */
    public function copyright() {
        return '<p class="footer__copyright">&copy '.date('Y').' '.self::siteName().'. <span class="footer__creator">Website by <a class="footer__link" href="https://bigrigmedia.com">Big Rig Media LLC</a> &reg;</span></p>';
    }
}
