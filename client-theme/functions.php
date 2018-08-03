<?php
/**
* @package client-theme
*/


/*********** LOAD STYLES AND SCRIPTS ***********/

function load_styles_scripts() {

  // P11 Screen Styles
  wp_enqueue_style( 'screen', get_template_directory_uri() . '/includes/css/screen.css', array(), false );

  /******************
  * SCRIPTS / JS
  ******************/

  /*****
  *** Load any custom javascript (remember to update dependencies)...
  *****/

  // Load Modinizer
  wp_enqueue_script( 'modernizer', get_template_directory_uri() . '/includes/js/contrib/modernizr.js', array(), '2.6.2', false );

  // Load jQuery
  wp_enqueue_script( 'jQuery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js', array(), '2.2.4', false );

  // Load SlickNav
  wp_enqueue_script( 'slicknav', get_template_directory_uri() . '/includes/js/contrib/slicknav.js', array('jQuery'), '1.0.1', true );

  // Load Cycle JS
  wp_enqueue_script( 'cycle', get_template_directory_uri() . '/includes/js/contrib/cycle2.js', array('jQuery'), '2.1.3', true );

  // Load Global JS
  wp_enqueue_script( 'js', get_template_directory_uri() . '/includes/js/global.js', array('jQuery', 'cycle', 'slicknav'), false, true );

}

add_action( 'wp_enqueue_scripts', 'load_styles_scripts');

// Async load JS
function p11creative_async_scripts($url)
{
    if ( strpos( $url, '#asyncload') === false )
        return $url;
    else if ( is_admin() )
        return str_replace( '#asyncload', '', $url );
    else
	return str_replace( '#asyncload', '', $url )."' async='async";
    }
add_filter( 'clean_url', 'p11creative_async_scripts', 11, 1 );


// ACF Responsive SRC SET
function _acf_ricg_image($image, $alt='', $class = '', $size='full') {

	if (!empty($image)) {
		if (!$alt) {
			$alt = $image['alt'];
		}

		$url = $image['url'];

		if ($size) {
			if (isset($image['sizes'][$size])) {
				$url = $image['sizes'][$size];
			}
		}

		if (function_exists('wp_get_attachment_image_srcset')) {
			$img = '<img src="'. $url . '" srcset="' . wp_get_attachment_image_srcset( $image['id'], $size ) . '" alt="' . $alt . '"';
		} else {
			$img = '<img src="'. $url . '" alt="' . $alt . '"';
		}

		if ($class) {
			$img .= ' class="' . $class . '"';
		}
		$img .= ' />';

		return $img;
	}
}


/*********** CUSTOM LOGIN/ADMIN COLORS & LOGO ***********/

function custom_login_scripts () {
  wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/includes/css/admin.css' );
  $thelogo = get_field('logo','option');
  echo '<style type="text/css">
  h1 a { background-image:url(' . $thelogo . ') !important;
    background-size:100% !important;
    width: 220px !important;
    height: 125px !important;
    pointer-events: none;
    cursor: default;
  }
  </style>';
}
add_action( 'login_enqueue_scripts', 'custom_login_scripts' );

/*********** Custom Logo on Dashboard ***********/

add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');

function my_custom_dashboard_widgets() {
global $wp_meta_boxes;

wp_add_dashboard_widget('custom_help_widget', '&nbsp;', 'custom_dashboard_help');
}

function custom_dashboard_help() {
$thelogo = get_field('logo_dark','option');
echo '<div style="text-align:center; padding: 2em;"><img style="width: 60%; height: auto; margin: 0 auto;" src="' . $thelogo . '" /></div>';
echo '<p style="text-align:center;">Custom Theme by <a href="http://www.p11.com" target="_blank">p11creative</a></p>';
}

// Get Featured Image Alt Value
function get_the_post_thumbnail_alt($post_id) {
    return get_post_meta(get_post_thumbnail_id($post_id), '_wp_attachment_image_alt', true);
}

/*********** REMOVE WORDPRESS LOGO ***********/

function annointed_admin_bar_remove() {
  global $wp_admin_bar;

  /* Remove their stuff */
  $wp_admin_bar->remove_menu('wp-logo');
}

add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);

/*********** ADD CUSTOM ADMIN COLORS ***********/
function additional_admin_color_schemes() {
  //Get the theme directory
  $theme_dir = get_template_directory_uri();

  //Custom Colors
  wp_admin_css_color( 'custom', __( 'Custom' ),
  $theme_dir . '/includes/css/admin.css',
  array( '#000000', '#444444', '#666666', '#FFFFFF' )
);
}
add_action('admin_init', 'additional_admin_color_schemes');

/*********** SET DEFAULT ADMIN COLORS ***********/

function set_default_admin_color($user_id) {
  $args = array(
    'ID' => $user_id,
    'admin_color' => 'custom'
  );
  wp_update_user( $args );
}
add_action('user_register', 'set_default_admin_color');

/*********** DISABLE THEME EDITOR ***********/

define('DISALLOW_FILE_EDIT', true);

/*********** THEME OPTIONS ***********/

if ( function_exists( 'add_theme_support' ) ) {

  //add_theme_support( 'post-thumbnails' );

  add_theme_support('menus');

  register_nav_menus( array(
    'home' => esc_html__( 'Home Menu', 'client-theme' ),
    'secondary' => esc_html__( 'Secondary Menu', 'client-theme' )
    ) );

  }

 //Deletes all CSS classes and id's, except for those listed in the array below
  function custom_wp_nav_menu($var) {
    return is_array($var) ? array_intersect($var, array(
      //List of allowed menu classes
      'current_page_item',
      'current_page_parent',
      'current_page_ancestor',
      'current-page-ancestor',
      'first',
      'last',
      'vertical',
      'horizontal',
      'scrollto'
    )
    ) : '';
  }
  add_filter('nav_menu_css_class', 'custom_wp_nav_menu');
  add_filter('nav_menu_item_id', 'custom_wp_nav_menu');
  add_filter('page_css_class', 'custom_wp_nav_menu');
  //Replaces "current-menu-item" with "active"
  function current_to_active($text){
    $replace = array(
      //List of menu item classes that should be changed to "active"
      'current_page_item' => 'active',
      'current_page_parent' => 'active',
      'current_page_ancestor' => 'active',
      'current-page-ancestor' => 'active',
    );
    $text = str_replace(array_keys($replace), $replace, $text);
    return $text;
  }
  add_filter ('wp_nav_menu','current_to_active');
  //Deletes empty classes and removes the sub menu class
  function strip_empty_classes($menu) {
    $menu = preg_replace('/ class=""| class="sub-menu"/','',$menu);
    return $menu;
  }
  add_filter ('wp_nav_menu','strip_empty_classes');


  /*********** CUSTOM FIELDS OPTIONS ***********/

  if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
      'page_title' 	=> 'Website Settings',
      'menu_title'	=> 'Website Settings',
      'menu_slug' 	=> 'website-settings',
      'capability'	=> 'edit_posts',
      'redirect'		=> false
    ));

  }

  // Include Post Types
  // require_once WP_CONTENT_DIR . '/themes/client-theme/includes/php/floorplans-post-type.php';
  require_once WP_CONTENT_DIR . '/themes/client-theme/includes/php/poi-post-type.php';
  require_once WP_CONTENT_DIR . '/themes/client-theme/includes/php/locations-post-type.php';

  /*********** TRIM EXCERPT ***********/

  function custom_trim_excerpt($text,$length) { // Fakes an excerpt if needed
    global $post;

    if ( $text == '' ) {
      $text = get_the_content('');

      $text = apply_filters('the_content', $text);
      $text = str_replace(']]>', ']]>', $text);
      //$text = strip_tags($text);
      $excerpt_length = $length;

      // If $text is longer than $length, add ...
      if(str_word_count($text) > $excerpt_length) {
        $words = explode(' ', $text, $excerpt_length + 1);
        array_pop($words);
        array_push($words, '... <a href="' . get_permalink() . '" class="more">MORE ></a>');
        //array_push($words, '...');
        $text = implode(' ', $words);

        $text = str_replace(' ...', '...', $text);
        $text = str_replace(',...', '...', $text);
      }

    }

    return $text;

  }

// Adds in superscript and subscript buttons to the Visual Editor
function my_mce_buttons_2( $buttons ) {
	/**
	 * Add in a core button that's disabled by default
	 */
	$buttons[] = 'superscript';
	$buttons[] = 'subscript';

	return $buttons;
}
add_filter( 'mce_buttons_2', 'my_mce_buttons_2' );

  /*********** TRIM HTML (with tags) ***********/

  /**
 * truncateHtml can truncate a string up to a number of characters while preserving whole words and HTML tags
 *
 * @param string $text String to truncate.
 * @param integer $length Length of returned string, including ellipsis.
 * @param string $ending Ending to be appended to the trimmed string.
 * @param boolean $exact If false, $text will not be cut mid-word
 * @param boolean $considerHtml If true, HTML tags would be handled correctly
 *
 * @return string Trimmed string.
 */
function truncateHtml($text, $length = 325, $ending = '...', $exact = false, $considerHtml = true) {
    if ($considerHtml) {
        // if the plain text is shorter than the maximum length, return the whole text
        if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
            return $text;
        }
        // splits all html-tags to scanable lines
        preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);
        $total_length = strlen($ending);
        $open_tags = array();
        $truncate = '';
        foreach ($lines as $line_matchings) {
            // if there is any html-tag in this line, handle it and add it (uncounted) to the output
            if (!empty($line_matchings[1])) {
                // if it's an "empty element" with or without xhtml-conform closing slash
                if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
                    // do nothing
                // if tag is a closing tag
                } else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
                    // delete tag from $open_tags list
                    $pos = array_search($tag_matchings[1], $open_tags);
                    if ($pos !== false) {
                    unset($open_tags[$pos]);
                    }
                // if tag is an opening tag
                } else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
                    // add tag to the beginning of $open_tags list
                    array_unshift($open_tags, strtolower($tag_matchings[1]));
                }
                // add html-tag to $truncate'd text
                $truncate .= $line_matchings[1];
            }
            // calculate the length of the plain text part of the line; handle entities as one character
            $content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
            if ($total_length+$content_length> $length) {
                // the number of characters which are left
                $left = $length - $total_length;
                $entities_length = 0;
                // search for html entities
                if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
                    // calculate the real length of all entities in the legal range
                    foreach ($entities[0] as $entity) {
                        if ($entity[1]+1-$entities_length <= $left) {
                            $left--;
                            $entities_length += strlen($entity[0]);
                        } else {
                            // no more characters left
                            break;
                        }
                    }
                }
                $truncate .= substr($line_matchings[2], 0, $left+$entities_length);
                // maximum lenght is reached, so get off the loop
                break;
            } else {
                $truncate .= $line_matchings[2];
                $total_length += $content_length;
            }
            // if the maximum length is reached, get off the loop
            if($total_length>= $length) {
                break;
            }
        }
    } else {
        if (strlen($text) <= $length) {
            return $text;
        } else {
            $truncate = substr($text, 0, $length - strlen($ending));
        }
    }
    // if the words shouldn't be cut in the middle...
    if (!$exact) {
        // ...search the last occurance of a space...
        $spacepos = strrpos($truncate, ' ');
        if (isset($spacepos)) {
            // ...and cut the text in this position
            $truncate = substr($truncate, 0, $spacepos);
        }
    }
    // add the defined ending to the text
    $truncate .= $ending;
    if($considerHtml) {
        // close all unclosed html-tags
        foreach ($open_tags as $tag) {
            $truncate .= '</' . $tag . '>';
        }
    }
    return $truncate;
}

  /*********** GET THE SLUG ***********/

  function the_slug() {
    global $post; $slug = get_post( $post->post_parent )->post_name;
    echo  $slug;
  }

  /*********** CUSTOM SCRIPT INCLUDE ***********/

  function scriptPrint($scripts) {
    $scriptPath = get_template_directory_uri();
    $scripts = str_replace(' ', '', $scripts);
    $scripts = preg_replace( "/\r|\n/", "", $scripts );
    $scriptArray = explode(',', $scripts);
    foreach($scriptArray as $value) {
      if (strpos($value, "//") !== false) {

        if (strpos($value, ".css") !== false) {
          echo '<link href="'.$value.'" rel="stylesheet" type="text/css" media="all" />'."\n";
        } else {
          echo '<script src="'.$value.'"></script>'."\n";
        }

      } else {

        if (strpos($value, ".css") !== false) {
          echo '<link href="'.$scriptPath.'/includes/'.$value.'" rel="stylesheet" type="text/css" media="all" />'."\n";
        } else {
          echo '<script src="'.$scriptPath.'/includes/'.$value.'"></script>'."\n";
        }

      }
    }
  }

  /*********** DISABLE EMOJIS!!! ***********/

  function disable_wp_emojicons() {

    // all actions related to emojis
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

    // filter to remove TinyMCE emojis
    add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
  }
  add_action( 'init', 'disable_wp_emojicons' );

  function disable_emojicons_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
      return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
      return array();
    }
  }

  /***********  REMOVE CUSTOMIZE FUNTIONALITY   ***********/

  add_action('admin_head', 'hide_customize');

  function hide_customize() {
    echo '<style>
    .theme-overlay .theme-actions, .hide-if-no-customize {
      display: none !important;
    }
    .single-theme .theme-overlay .theme-about {
      padding-bottom: 30px !important;
    }
    .single-theme .theme-overlay .theme-name span {
      display: none !important;
    }
    </style>';
  }

  /***********  REMOVE ADMIN MENU ITEMS   ***********/

  function edit_admin_menus() {
    remove_menu_page('edit-comments.php');
  }
  add_action( 'admin_menu', 'edit_admin_menus' );

  /***********  DISABLE EMBEDS  ***********/

  function disable_embeds_init() {
    // Remove the REST API endpoint.
    remove_action('rest_api_init', 'wp_oembed_register_route');
    // Turn off oEmbed auto discovery.
    // Don't filter oEmbed results.
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
    // Remove oEmbed discovery links.
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action('wp_head', 'wp_oembed_add_host_js');
  }
  add_action('init', 'disable_embeds_init', 9999);

  /*********** ALLOW SVG UPLOADS ***********/

add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
  global $wp_version;
  if( $wp_version == '4.7' || ( (float) $wp_version < 4.7 ) ) {
    return $data;
  }
  $filetype = wp_check_filetype( $filename, $mimes );
  return array( 'ext' => $filetype['ext'], 'type' => $filetype['type'], 'proper_filename' => $data['proper_filename'] );
}, 10, 4 );

function cc_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml'; return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

function fix_svg() {
  echo '<style>.attachment-266×266, .thumbnail img { width: 100% !important; height: auto !important; }</style>';
}
add_action( 'admin_head', 'fix_svg' );


  /***********  MAKE LIST ITEMS FROM TEXT AREA  ***********/

  function convert_to_list_elements($textarea) {
    $lines = explode("\n", $textarea);
    if ( !empty($lines) ) {
      foreach ( $lines as $line ) {
        echo '<li>'. trim( $line ) .'</li>';
      }
    }
  }

/*********** EXTEND WORDPRESS SEARCH TO INCLUDE CUSTOM FIELDS/ADVANCED CUSTOM FIELD VALUES
 * https://adambalee.com
 * Join posts and postmeta tables http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join */
function cf_search_join( $join ) {
    global $wpdb;
    if ( is_search() ) {
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }
    return $join;
}
add_filter('posts_join', 'cf_search_join' );
/* Modify the search query with posts_where http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where */
function cf_search_where( $where ) {
    global $pagenow, $wpdb;
    if ( is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }
    return $where;
}
add_filter( 'posts_where', 'cf_search_where' );

/* Prevent duplicates http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct */
function cf_search_distinct( $where ) {
    global $wpdb;
    if ( is_search() ) {
        return "DISTINCT";
    }
    return $where;
}
add_filter( 'posts_distinct', 'cf_search_distinct' );

  ?>
