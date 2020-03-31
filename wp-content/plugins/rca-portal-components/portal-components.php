<?php
/*
Plugin Name: Portal Components
Description: A CUSTOM Wordpress plugin required by the Client Portal site
Version: 0.1
Author: Edd Twilbeck
Author URI: http://www.marketingincolor.com
License: GPL2
Copyright 2020 Marketing In Color  (email : developer@marketingincolor.com)
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/



/*
|--------------------------------------------------------------------------
| Admin Styling - This was superceded by the use of the Custom Admin Interface Plugin (All CSS changes moved to there)
|--------------------------------------------------------------------------
*/

//add_action('admin_head', 'portal_admin_customizations');

function portal_admin_customizations() {

	if(current_user_can('administrator')) {
	echo '<style>
		body, td, textarea, input, select {
			font-family: monospace;
			font-size: 12px;
		}
		#adminmenu, #adminmenu .wp-submenu, #adminmenuback, #adminmenuwrap { width:0; display:none; } 
		#wpcontent, #wpfooter { margin-left:auto; }
	</style>';
	}
}


/*
|--------------------------------------------------------------------------
| Admin Bar Customization
|--------------------------------------------------------------------------
*/

// customize admin bar css
function override_admin_bar_css() { 
	if ( is_admin_bar_showing() && !current_user_can('administrator') ) {
	echo ' <style type="text/css"> #wpadminbar { background:#c4612b; } #wpcontent {max-width:960px; margin-left:auto; margin-right:auto;
	}</style>';
    }
}

// on backend area
add_action( 'admin_head', 'override_admin_bar_css' );

// on frontend area
add_action( 'wp_head', 'override_admin_bar_css' );

/*
|--------------------------------------------------------------------------
| ACF Customizations
|--------------------------------------------------------------------------
*/
// Change Flexible Content Label to TITLE
add_filter('acf/fields/flexible_content/layout_title', function($title) {
    $ret = $title;
    if ($custom_title = get_sub_field('title')) {
        //$ret = sprintf('<strong>%s</strong> <em style="font-size: 80%; opacity: 0.5">%s</em>', $custom_title, $title);
        //$ret = sprintf($title . ': ' . '<strong>' . $custom_title . '</strong>');
        $ret = sprintf('<span class="acfe-layout-title-text">' . $custom_title . '</span>');
    }

    return $ret;
});

// Custom CSS Injection for ACF Flexible Content Edits
add_action('acf/input/admin_head', 'my_acf_admin_head');
function my_acf_admin_head() {
?>
<style type="text/css">

    .acf-flexible-content .layout .acf-fc-layout-handle {
        /*background-color: #00B8E4;*/
        background-color: #202428;
        color: #eee;
    }

    .acf-repeater.-row > table > tbody > tr > td,
    .acf-repeater.-block > table > tbody > tr > td {
        border-top: 2px solid #202428;
    }

    .acf-repeater .acf-row-handle {
        vertical-align: top !important;
        padding-top: 16px;
    }

    .acf-repeater .acf-row-handle span {
        font-size: 20px;
        font-weight: bold;
        color: #202428;
    }

    .imageUpload img {
        width: 75px;
    }

    .acf-repeater .acf-row-handle .acf-icon.-minus {
        top: 30px;
    }

</style>
<?php
}


/*
|--------------------------------------------------------------------------
| Admin Menu Filter Testing - Not needed with CAI Plugin!!
|--------------------------------------------------------------------------
*/
function filter_admin_menues() {
		
		// If administrator then do nothing
		if (current_user_can('activate_plugins')) return;
		
		// Remove main menus
		$main_menus_to_stay = array(
			
			// Dashboard
			'index.php',
			
			// Edit
			'edit.php',
			
			// Media
			'upload.php'
		);

		// Remove sub menus
		$sub_menus_to_stay = array(
			
			// Dashboard
			'index.php' => ['index.php'],
			
			// Edit
			'edit.php' => ['edit.php', 'post-new.php'],
			
			// Media
			'upload.php' => ['upload.php', 'media-new.php'],
			
			
		);


		if (isset($GLOBALS['menu']) && is_array($GLOBALS['menu'])) {
			foreach ($GLOBALS['menu'] as $k => $main_menu_array) {				
				// Remove main menu
				if (!in_array($main_menu_array[2], $main_menus_to_stay)) {
					remove_menu_page($main_menu_array[2]);
				} else {
					
					// Remove submenu
					foreach ($GLOBALS['submenu'][$main_menu_array[2]] as $k => $sub_menu_array) {
						
						if (!in_array($sub_menu_array[2], $sub_menus_to_stay[$main_menu_array[2]])) {
							
							remove_submenu_page($main_menu_array[2], $sub_menu_array[2]);							
						}
					}
				}
			}
		}
	}

// Filter admin side navigation menues
//add_action('admin_init',  'filter_admin_menues');








/*
|--------------------------------------------------------------------------
| Site Custom Dashboard Plugin (Merged)
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| CONSTANTS
|--------------------------------------------------------------------------
*/
// plugin folder url
//if(!defined('SCD_PLUGIN_URL')) {
//define('SCD_PLUGIN_URL', plugin_dir_url( __FILE__ ));
//}

/*
|--------------------------------------------------------------------------
| MAIN CLASS
|--------------------------------------------------------------------------
*/
class site_custom_dashboard {

	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/

	/**
	 * Initializes the plugin
	 */
	function __construct() {
		add_action('admin_menu', array( &$this,'scd_register_menu') );
		add_action('load-index.php', array( &$this,'scd_redirect_dashboard') );
	} // end constructor

	function scd_redirect_dashboard() {

		if( /*is_admin()*/ !current_user_can('administrator') ) {
			$screen = get_current_screen();
			
			if( $screen->base == 'dashboard' ) {

				wp_redirect( admin_url( 'index.php?page=custom-dashboard' ) );
				
			}
		}

	}

	function scd_register_menu() {
		add_dashboard_page( 'Custom Dashboard', 'Custom Dashboard', 'read', 'custom-dashboard', array( &$this,'scd_create_dashboard') );
	}

	function scd_create_dashboard() {
		include_once( 'custom_dashboard.php'  );
	}

}
// instantiate plugin's class
$GLOBALS['site_custom_dashboard'] = new site_custom_dashboard();



/**
 * Redirect user after successful login.
 *
 * @param string $redirect_to URL to redirect to.
 * @param string $request URL the user is coming from.
 * @param object $user Logged user's data.
 * @return string
 */
function my_login_redirect( $redirect_to, $request, $user ) {
    //is there a user to check?
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {
        //check for admins
        if ( in_array( 'administrator', $user->roles ) ) {
            // redirect them to the default place
            return $redirect_to;
        } else {
            return admin_url( 'index.php?page=custom-dashboard' );
        }
    } else {
        return $redirect_to;
    }
}
 
add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );




/*
|--------------------------------------------------------------------------
| Site Custom Dashboard Message - Instead of Custom Dashboard above
|--------------------------------------------------------------------------
*/

/**
 * Remove the default welcome dashboard message
 *
 */
//remove_action( 'welcome_panel', 'wp_welcome_panel' );

/**
 * Custom welcome panel function
 *
 * @access      public
 * @since       1.0 
 * @return      void
 */
function wpex_wp_welcome_panel() { ?>

	<div class="custom-welcome-panel-content">
		<h3><?php _e( 'Welcome to your custom dashboard Message!' ); ?></h3>
		<p class="about-description"><?php _e( 'Here you can place your custom text, give your customers instructions, place an ad or your contact information.' ); ?></p>
		<div class="welcome-panel-column-container">
			<div class="welcome-panel-column">
				<h4><?php _e( "Let's Get Started" ); ?></h4>
				<a class="button button-primary button-hero load-customize hide-if-no-customize" href="http://your-website.com"><?php _e( 'Call me maybe !' ); ?></a>
					<p class="hide-if-no-customize"><?php printf( __( 'or, <a href="%s">edit your site settings</a>' ), admin_url( 'options-general.php' ) ); ?></p>
			</div><!-- .welcome-panel-column -->
			<div class="welcome-panel-column">
				<h4><?php _e( 'Next Steps' ); ?></h4>
				<ul>
				<?php if ( 'page' == get_option( 'show_on_front' ) && ! get_option( 'page_for_posts' ) ) : ?>
					<li><?php printf( '<a href="%s" class="welcome-icon welcome-edit-page">' . __( 'Edit your front page' ) . '</a>', get_edit_post_link( get_option( 'page_on_front' ) ) ); ?></li>
					<li><?php printf( '<a href="%s" class="welcome-icon welcome-add-page">' . __( 'Add additional pages' ) . '</a>', admin_url( 'post-new.php?post_type=page' ) ); ?></li>
				<?php elseif ( 'page' == get_option( 'show_on_front' ) ) : ?>
					<li><?php printf( '<a href="%s" class="welcome-icon welcome-edit-page">' . __( 'Edit your front page' ) . '</a>', get_edit_post_link( get_option( 'page_on_front' ) ) ); ?></li>
					<li><?php printf( '<a href="%s" class="welcome-icon welcome-add-page">' . __( 'Add additional pages' ) . '</a>', admin_url( 'post-new.php?post_type=page' ) ); ?></li>
					<li><?php printf( '<a href="%s" class="welcome-icon welcome-write-blog">' . __( 'Add a blog post' ) . '</a>', admin_url( 'post-new.php' ) ); ?></li>
				<?php else : ?>
					<li><?php printf( '<a href="%s" class="welcome-icon welcome-write-blog">' . __( 'Write your first blog post' ) . '</a>', admin_url( 'post-new.php' ) ); ?></li>
					<li><?php printf( '<a href="%s" class="welcome-icon welcome-add-page">' . __( 'Add an About page' ) . '</a>', admin_url( 'post-new.php?post_type=page' ) ); ?></li>
				<?php endif; ?>
					<li><?php printf( '<a href="%s" class="welcome-icon welcome-view-site">' . __( 'View your site' ) . '</a>', home_url( '/' ) ); ?></li>
				</ul>
			</div><!-- .welcome-panel-column -->
			<div class="welcome-panel-column welcome-panel-last">
				<h4><?php _e( 'More Actions' ); ?></h4>
				<ul>
					<li><?php printf( '<div class="welcome-icon welcome-widgets-menus">' . __( 'Manage <a href="%1$s">widgets</a> or <a href="%2$s">menus</a>' ) . '</div>', admin_url( 'widgets.php' ), admin_url( 'nav-menus.php' ) ); ?></li>
					<li><?php printf( '<a href="%s" class="welcome-icon welcome-comments">' . __( 'Turn comments on or off' ) . '</a>', admin_url( 'options-discussion.php' ) ); ?></li>
					<li><?php printf( '<a href="%s" class="welcome-icon welcome-learn-more">' . __( 'Learn more about getting started' ) . '</a>', __( 'http://codex.wordpress.org/First_Steps_With_WordPress' ) ); ?></li>
				</ul>
			</div><!-- .welcome-panel-column welcome-panel-last -->
		</div><!-- .welcome-panel-column-container -->
	</div><!-- .custom-welcome-panel-content -->

<?php }
//add_action( 'welcome_panel', 'wpex_wp_welcome_panel' );




/**
 * Customization of REPORT CPT Edit area 
 *
 *
 * 
 */

$post_type = 'report'; // Change this to a post type you'd want
function portal_screen_layout_post( $selected ) {
    if( false === $selected ) { 
        return 1; // Use 1 column if user hasn't selected anything in Screen Options
    }
    //return $selected; // Use what the user wants
    return 1; // FORCES 1 column
}
add_filter( "get_user_option_screen_layout_{$post_type}", 'portal_screen_layout_post' );

function portal_move_post_metaboxes( $post ) {
    global $wp_meta_boxes;

    remove_meta_box( 'submitdiv', 'report', 'side' );
    add_meta_box( 'submitdiv', __( 'Publish' ), 'report_submit_meta_box', 'report', 'normal', 'low' );
}
add_action( 'add_meta_boxes_cpt-slug', 'portal_move_post_metaboxes' );


add_filter( "get_user_option_meta-box-order_{$post_type}", 'portal_one_column_for_all' );
function portal_one_column_for_all( $order )
{
    return array(
        'normal'   => join( ",", array(
            'postexcerpt',
            'formatdiv',
            'trackbacksdiv',
            'categorydiv',
            'postimagediv',
            'postcustom',
            'commentstatusdiv',
            'slugdiv',
            'authordiv',
            'tagsdiv-clients',
            'submitdiv',
        ) ),
        'side'     => '',
        'advanced' => '',
    );
}