# Starter

## Requirements

* PHP >= 5.6
* Composer - [Install](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)

## Installation

1. Create a directory for your project and switch into it.
`mkdir project-folder && cd project-folder`.

2. Clone the repo into your project directory.
`git clone git@github.com:ernstoarllano/starter.git .`.

3. Remove the existing git branch.
`rm -rf .git`.

4. Install the required Composer packages with `composer install`, this may take a minute or two.

5. Configure the `wp-config.php`.

6. Access the WP admin at `http://example.com/wp/wp-admin` and configure your site. Be sure to remove the `/wp` portion from the Site Address (URL) in the Settings->General options.

7. Now you need to install the necessary Sage node packages with `npm install`, this may take a minute or two. You'll also need to install the necessary Bower packages with `bower install`. You can run both of the install scripts independently or combine both at the same time like so `npm install && bower install`.

8. If you have [WP-CLI](http://wp-cli.org) activate the theme with `wp theme activate sage` otherwise activate the theme in the WP backend.

## Documentation

[Sage](https://roots.io/sage/) documentation is available at [https://roots.io/sage/docs/](https://roots.io/sage/docs/).
