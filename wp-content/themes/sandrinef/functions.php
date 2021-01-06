<?php

/*****************
 * VERSIONNING
 ******************/

// Get the theme version & make it a named constant
$theme_data = wp_get_theme();
define('THEME_VERSION', $theme_data->Version);


function set_custom_ver_css_js($src)
{
  // style.css URI
  $style_file = get_stylesheet_directory() . '/style.css';

  if ($style_file) {
    // css file timestamp
    $theme_data = wp_get_theme();
    $version = $theme_data->Version;

    if (strpos($src, 'ver='))
      // use the WP function add_query_arg() 
      // to set the ver parameter in 
      $src = add_query_arg('ver', $version, $src);
    return esc_url($src);
  }
}



/*****************
 * Disable the emoji's
 ******************/
function disable_emojis()
{
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_action('admin_print_styles', 'print_emoji_styles');
  remove_filter('the_content_feed', 'wp_staticize_emoji');
  remove_filter('comment_text_rss', 'wp_staticize_emoji');
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
  add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
  add_filter('wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2);
}
add_action('init', 'disable_emojis');

/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param array $plugins 
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce($plugins)
{
  if (is_array($plugins)) {
    return array_diff($plugins, array('wpemoji'));
  } else {
    return array();
  }
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch($urls, $relation_type)
{
  if ('dns-prefetch' == $relation_type) {
    /** This filter is documented in wp-includes/formatting.php */
    $emoji_svg_url = apply_filters('emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/');

    $urls = array_diff($urls, array($emoji_svg_url));
  }

  return $urls;
}


/*****************
 * Disable embeds
 ******************/
function disable_embeds_code_init()
{

  // Remove the REST API endpoint.
  remove_action('rest_api_init', 'wp_oembed_register_route');

  // Turn off oEmbed auto discovery.
  add_filter('embed_oembed_discover', '__return_false');

  // Don't filter oEmbed results.
  remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

  // Remove oEmbed discovery links.
  remove_action('wp_head', 'wp_oembed_add_discovery_links');

  // Remove oEmbed-specific JavaScript from the front-end and back-end.
  remove_action('wp_head', 'wp_oembed_add_host_js');
  add_filter('tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin');

  // Remove all embeds rewrite rules.
  add_filter('rewrite_rules_array', 'disable_embeds_rewrites');

  // Remove filter of the oEmbed result before any HTTP requests are made.
  remove_filter('pre_oembed_result', 'wp_filter_pre_oembed_result', 10);
}

add_action('init', 'disable_embeds_code_init', 9999);

function disable_embeds_tiny_mce_plugin($plugins)
{
  return array_diff($plugins, array('wpembed'));
}

function disable_embeds_rewrites($rules)
{
  foreach ($rules as $rule => $rewrite) {
    if (false !== strpos($rewrite, 'embed=true')) {
      unset($rules[$rule]);
    }
  }
  return $rules;
}


/******
 * remove link inutile
 ******/
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');


// Disable REST API link tag
remove_action('wp_head', 'rest_output_link_wp_head', 10);

// Disable oEmbed Discovery Links
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);

// Disable REST API link in HTTP headers
remove_action('template_redirect', 'rest_output_link_header', 10);


/******
 * enqueue script
 ******/

// Supprimer le CSS de la bibliothèque de blocs Gutenberg du chargement sur le frontend
function  smartwp_remove_wp_block_library_css()
{
  wp_dequeue_style('wp-block-library');
  wp_dequeue_style('wp-block-library-theme');
  wp_dequeue_style('style bloc-wc'); // Suppression du bloc CSS WooCommerce
}
add_action('wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100);


// Removing front end admin bar because it's ugly
add_filter('show_admin_bar', '__return_false');

///////////
// ADD THEME SUPPORT
//////////

// logo personalisation
function wpc_theme_support() {
	add_theme_support('custom-logo', array(
		'flex-height' => true,
		'flex-width'  => true,
	));
}
add_action('after_setup_theme','wpc_theme_support');

///////////
// ENQUEUE SCRIPT
//////////

// enqueue style
function vcn_enqueue_style()
{
  wp_enqueue_style('my-css-theme', get_stylesheet_uri(), array(), THEME_VERSION);
}

add_action('wp_enqueue_scripts', 'vcn_enqueue_style');


// enqueue script
function vcn_enqueue_script()
{

  wp_deregister_script('jquery');
  wp_enqueue_script('my-js-theme', get_template_directory_uri() . '/js/script.js', [], false, true);
  wp_localize_script('my-js-theme', 'adminAjax', admin_url('admin-ajax.php'));
}


add_action('wp_enqueue_scripts', 'vcn_enqueue_script', 11);
