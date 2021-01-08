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



// REMOVE POST MENU ADMIN
function remove_posts_menu()
{
  remove_menu_page('edit.php');
}
add_action('admin_menu', 'remove_posts_menu');


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
function wpc_theme_support()
{
  add_theme_support('custom-logo', array(
    'flex-height' => true,
    'flex-width'  => true,
  ));
}
add_action('after_setup_theme', 'wpc_theme_support');

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



/////////////
// CPT
////////////

// Register Custom Post Type
function custom_post_type()
{

  // MASSAGES
  $labelsMassages = array(
    'name'                  => 'Massages',
    'singular_name'         => 'Massage',
    'menu_name'             => __('Massages', 'text_domain'),
    'name_admin_bar'        => __('Massages', 'text_domain'),
    'archives'              => __('Item Archives', 'text_domain'),
    'attributes'            => __('Item Attributes', 'text_domain'),
    'parent_item_colon'     => __('Parent Item:', 'text_domain'),
    'all_items'             => __('Tout les massages', 'text_domain'),
    'add_new_item'          => __('Ajouter un nouveau massage', 'text_domain'),
    'add_new'               => __('Ajouter', 'text_domain'),
    'new_item'              => __('Nouveau massage', 'text_domain'),
    'edit_item'             => __('Modifier le massage', 'text_domain'),
    'update_item'           => __('Mettre à jour le massage', 'text_domain'),
    'view_item'             => __('Voir le massage', 'text_domain'),
    'view_items'            => __('Voir les massages', 'text_domain'),
    'search_items'          => __('Chercher un massage', 'text_domain'),
    'not_found'             => __('Not found', 'text_domain'),
    'not_found_in_trash'    => __('Not found in Trash', 'text_domain'),
    'featured_image'        => __('Featured Image', 'text_domain'),
    'set_featured_image'    => __('Set featured image', 'text_domain'),
    'remove_featured_image' => __('Remove featured image', 'text_domain'),
    'use_featured_image'    => __('Use as featured image', 'text_domain'),
    'insert_into_item'      => __('Insert into item', 'text_domain'),
    'uploaded_to_this_item' => __('Uploaded to this item', 'text_domain'),
    'items_list'            => __('Items list', 'text_domain'),
    'items_list_navigation' => __('Items list navigation', 'text_domain'),
    'filter_items_list'     => __('Filter items list', 'text_domain'),
  );
  $argsMassages = array(
    'label'                 => __('Massage', 'text_domain'),
    'description'           => __('Services proposé', 'text_domain'),
    'labels'                => $labelsMassages,
    'supports'              => array('title', 'page-attributes'),
    'taxonomies'            => array(),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'menu_icon'             => 'dashicons-universal-access',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => false,
    'exclude_from_search'   => false,
    'publicly_queryable'    => false,
    'capability_type'       => 'page',
  );
  register_post_type('massages', $argsMassages);


  // AVANTAGES
  $labelsAvantages = array(
    'name'                  => 'Avantages',
    'singular_name'         => 'Avantage',
    'menu_name'             => __('Avantages', 'text_domain'),
    'name_admin_bar'        => __('Avantages', 'text_domain'),
    'archives'              => __('Item Archives', 'text_domain'),
    'attributes'            => __('Item Attributes', 'text_domain'),
    'parent_item_colon'     => __('Parent Item:', 'text_domain'),
    'all_items'             => __('Tout les avantages', 'text_domain'),
    'add_new_item'          => __('Ajouter un nouveau avantage', 'text_domain'),
    'add_new'               => __('Ajouter', 'text_domain'),
    'new_item'              => __('Nouveau avantage', 'text_domain'),
    'edit_item'             => __('Modifier l\'avantage', 'text_domain'),
    'update_item'           => __('Mettre à jour l\'avantage', 'text_domain'),
    'view_item'             => __('Voir l\'avantage', 'text_domain'),
    'view_items'            => __('Voir les avantages', 'text_domain'),
    'search_items'          => __('Chercher un avantage', 'text_domain'),
    'not_found'             => __('Not found', 'text_domain'),
    'not_found_in_trash'    => __('Not found in Trash', 'text_domain'),
    'featured_image'        => __('Featured Image', 'text_domain'),
    'set_featured_image'    => __('Set featured image', 'text_domain'),
    'remove_featured_image' => __('Remove featured image', 'text_domain'),
    'use_featured_image'    => __('Use as featured image', 'text_domain'),
    'insert_into_item'      => __('Insert into item', 'text_domain'),
    'uploaded_to_this_item' => __('Uploaded to this item', 'text_domain'),
    'items_list'            => __('Items list', 'text_domain'),
    'items_list_navigation' => __('Items list navigation', 'text_domain'),
    'filter_items_list'     => __('Filter items list', 'text_domain'),
  );
  $argsAvantages = array(
    'label'                 => __('Avantage', 'text_domain'),
    'description'           => __('Bienfaits et avantages', 'text_domain'),
    'labels'                => $labelsAvantages,
    'supports'              => array('title', 'page-attributes'),
    'taxonomies'            => array(),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'menu_icon'             => 'dashicons-heart',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => false,
    'capability_type'       => 'page',
  );
  register_post_type('avantages', $argsAvantages);


   // AVANTAGES
   $labelsReview = array(
    'name'                  => 'Avis clients',
    'singular_name'         => 'Avis client',
    'menu_name'             => __('Avis clients', 'text_domain'),
    'name_admin_bar'        => __('Avis clients', 'text_domain'),
    'archives'              => __('Item Archives', 'text_domain'),
    'attributes'            => __('Item Attributes', 'text_domain'),
    'parent_item_colon'     => __('Parent Item:', 'text_domain'),
    'all_items'             => __('Tout les avis clients', 'text_domain'),
    'add_new_item'          => __('Ajouter un nouveau avis client', 'text_domain'),
    'add_new'               => __('Ajouter', 'text_domain'),
    'new_item'              => __('Nouveau avis client', 'text_domain'),
    'edit_item'             => __('Modifier l\'avis client', 'text_domain'),
    'update_item'           => __('Mettre à jour l\'avis client', 'text_domain'),
    'view_item'             => __('Voir l\'avis client', 'text_domain'),
    'view_items'            => __('Voir les avis clients', 'text_domain'),
    'search_items'          => __('Chercher un avis client', 'text_domain'),
    'not_found'             => __('Not found', 'text_domain'),
    'not_found_in_trash'    => __('Not found in Trash', 'text_domain'),
    'featured_image'        => __('Featured Image', 'text_domain'),
    'set_featured_image'    => __('Set featured image', 'text_domain'),
    'remove_featured_image' => __('Remove featured image', 'text_domain'),
    'use_featured_image'    => __('Use as featured image', 'text_domain'),
    'insert_into_item'      => __('Insert into item', 'text_domain'),
    'uploaded_to_this_item' => __('Uploaded to this item', 'text_domain'),
    'items_list'            => __('Items list', 'text_domain'),
    'items_list_navigation' => __('Items list navigation', 'text_domain'),
    'filter_items_list'     => __('Filter items list', 'text_domain'),
  );
  $argsReview = array(
    'label'                 => __('Avis clients', 'text_domain'),
    'description'           => __('Avis clients', 'text_domain'),
    'labels'                => $labelsReview,
    'supports'              => array('title', 'page-attributes'),
    'taxonomies'            => array(),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'menu_icon'             => 'dashicons-format-chat',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => false,
    'capability_type'       => 'page',
  );
  register_post_type('review', $argsReview);



     // QUALIFICATIONS
     $labelsQualifications = array(
      'name'                  => 'Qualifications',
      'singular_name'         => 'Qualification',
      'menu_name'             => __('Qualifications', 'text_domain'),
      'name_admin_bar'        => __('Qualifications', 'text_domain'),
      'archives'              => __('Item Archives', 'text_domain'),
      'attributes'            => __('Item Attributes', 'text_domain'),
      'parent_item_colon'     => __('Parent Item:', 'text_domain'),
      'all_items'             => __('Toutes les qualifications', 'text_domain'),
      'add_new_item'          => __('Ajouter une nouvelle qualification', 'text_domain'),
      'add_new'               => __('Ajouter', 'text_domain'),
      'new_item'              => __('Nouvelle qualification', 'text_domain'),
      'edit_item'             => __('Modifier la qualification', 'text_domain'),
      'update_item'           => __('Mettre à jour la qualification', 'text_domain'),
      'view_item'             => __('Voir la qualification', 'text_domain'),
      'view_items'            => __('Voir les qualifications', 'text_domain'),
      'search_items'          => __('Chercher une qualifications', 'text_domain'),
      'not_found'             => __('Not found', 'text_domain'),
      'not_found_in_trash'    => __('Not found in Trash', 'text_domain'),
      'featured_image'        => __('Featured Image', 'text_domain'),
      'set_featured_image'    => __('Set featured image', 'text_domain'),
      'remove_featured_image' => __('Remove featured image', 'text_domain'),
      'use_featured_image'    => __('Use as featured image', 'text_domain'),
      'insert_into_item'      => __('Insert into item', 'text_domain'),
      'uploaded_to_this_item' => __('Uploaded to this item', 'text_domain'),
      'items_list'            => __('Items list', 'text_domain'),
      'items_list_navigation' => __('Items list navigation', 'text_domain'),
      'filter_items_list'     => __('Filter items list', 'text_domain'),
    );
    $argsQualifications = array(
      'label'                 => __('Qualifications', 'text_domain'),
      'description'           => __('Qualifications', 'text_domain'),
      'labels'                => $labelsQualifications,
      'supports'              => array('title', 'page-attributes'),
      'taxonomies'            => array(),
      'hierarchical'          => false,
      'public'                => true,
      'show_ui'               => true,
      'show_in_menu'          => true,
      'menu_position'         => 5,
      'menu_icon'             => 'dashicons-welcome-learn-more',
      'show_in_admin_bar'     => true,
      'show_in_nav_menus'     => true,
      'can_export'            => true,
      'has_archive'           => true,
      'exclude_from_search'   => false,
      'publicly_queryable'    => false,
      'capability_type'       => 'page',
    );
    register_post_type('qualifications', $argsQualifications);
}
add_action('init', 'custom_post_type', 0);



//////////
// MENU PAGE ADMIN
//////////



if (function_exists('acf_add_options_page')) {
  acf_add_options_page(array(
    'page_title'    => 'Informations de contact',
    'menu_title'    => 'Contact',
    'menu_slug'     => 'information',
    'capability'    => 'edit_posts',
    'position'      => 8,
    'icon_url'      => 'dashicons-text-page',
    'redirect'      => false,
  ));
}

if (function_exists('acf_add_options_page')) {
  acf_add_options_page(array(
    'page_title'    => 'Informations de l\'événement',
    'menu_title'    => 'Evénement',
    'menu_slug'     => 'evenement-info',
    'capability'    => 'edit_posts',
    'position'      => 7,
    'icon_url'      => 'dashicons-calendar-alt',
    'redirect'      => false,
  ));
}


/////////
// ADD MENU WORDPRESS
/////////

// s'il y a plusieurs menus à rajouter, voici le code :
function register_my_menus() {
  register_nav_menus(
  array(
  'main-menu' => __( 'Menu principal' ),
  'footer-menu' => __( 'Menu Footer' ),
  )
  );
 }
 add_action( 'init', 'register_my_menus' );

////////
// ADD CLASS ACTIVE MENU WORDPRESS CURRENT PAGE
////////

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
  if (in_array('current-menu-item', $classes) ){
    $classes[] = 'active ';
  }
  return $classes;
}