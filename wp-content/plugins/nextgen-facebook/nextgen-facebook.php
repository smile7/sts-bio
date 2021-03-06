<?php
/*
 * Plugin Name: NextGEN Facebook
 * Plugin Slug: nextgen-facebook
 * Text Domain: nextgen-facebook
 * Domain Path: /languages
 * Plugin URI: https://surniaulula.com/extend/plugins/nextgen-facebook/
 * Assets URI: https://surniaulula.github.io/nextgen-facebook/assets/
 * Author: JS Morisset
 * Author URI: https://surniaulula.com/
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl.txt
 * Description: Complete meta tags for the best looking shares on Facebook, Google, Pinterest, Twitter, etc - no matter how your webpage is shared!
 * Requires At Least: 3.7
 * Tested Up To: 4.8.1
 * Version: 8.45.6
 *
 * Version Numbering: {major}.{minor}.{bugfix}[-{stage}.{level}]
 *
 *	{major}		Major structural code changes / re-writes or incompatible API changes.
 *	{minor}		New functionality was added or improved in a backwards-compatible manner.
 *	{bugfix}	Backwards-compatible bug fixes or small improvements.
 *	{stage}.{level}	Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).
 *
 * Copyright 2012-2017 Jean-Sebastien Morisset (https://surniaulula.com/)
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'These aren\'t the droids you\'re looking for...' );
}

if ( ! class_exists( 'Ngfb' ) ) {

	class Ngfb {
		/*
		 * Class Object Variables
		 */
		public $p;			// Ngfb
		public $admin;			// NgfbAdmin (admin menus and page loader)
		public $cache;			// SucomCache (object and file caching)
		public $check;			// NgfbCheck
		public $debug;			// SucomDebug or SucomNoDebug
		public $head;			// NgfbHead
		public $loader;			// NgfbLoader
		public $media;			// NgfbMedia (images, videos, etc.)
		public $msgs;			// NgfbMessages (admin tooltip messages)
		public $notice;			// SucomNotice or SucomNoNotice
		public $og;			// NgfbOpenGraph
		public $opt;			// NgfbOptions
		public $page;			// NgfbPage (page title, desc, etc.)
		public $reg;			// NgfbRegister
		public $script;			// NgfbScript (admin jquery tooltips)
		public $sharing;		// NgfbSharing (wp_head and wp_footer js and buttons)
		public $style;			// NgfbStyle (admin styles)
		public $tc;			// NgfbTwitterCard
		public $util;			// NgfbUtil (extends SucomUtil)
		public $weibo;			// NgfbWeibo

		/*
		 * Reference Variables (config, options, modules, etc.)
		 */
		public $m = array();		// plugin modules
		public $m_ext = array();	// plugin extension modules
		public $cf = array();		// config array defined in construct method
		public $avail = array();	// assoc array for other plugin checks
		public $options = array();	// individual blog/site options
		public $site_options = array();	// multisite options
		public $sc = array();		// shortcodes

		private static $instance;

		/*
		 * Ngfb Constructor
		 */
		public function __construct() {

			require_once dirname( __FILE__ ).'/lib/config.php';
			$this->cf = NgfbConfig::get_config( false, false );	// unfiltered - $cf['*'] array is not available yet
			NgfbConfig::set_constants( __FILE__ );
			NgfbConfig::require_libs( __FILE__ );			// includes the register.php class library
			$this->reg = new NgfbRegister( $this );			// activate, deactivate, uninstall hooks

			add_action( 'init', array( &$this, 'set_config' ), -10 );				// runs at init -10 (before widgets_init)
			add_action( 'widgets_init', array( &$this, 'init_widgets' ), 10 );			// runs at init 1
			add_action( 'init', array( &$this, 'set_options' ), NGFB_INIT_PRIORITY - 3 );		// runs at init 11 by default
			add_action( 'init', array( &$this, 'set_objects' ), NGFB_INIT_PRIORITY - 2 );		// runs at init 12 by default
			add_action( 'init', array( &$this, 'init_shortcodes' ), NGFB_INIT_PRIORITY - 1 );	// runs at init 13 by default
			add_action( 'init', array( &$this, 'init_plugin' ), NGFB_INIT_PRIORITY );		// runs at init 14 by default

			if ( is_admin() ) {
				add_action( 'ngfb_init_textdomain', 		// action is run after the debug property is defined
					array( __CLASS__, 'init_textdomain' ), -10, 1 );	// hooks override_textdomain_mofile if debug enabled
			}
		}

		public static function &get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		// runs at init priority -10
		// called by activate_plugin() as well
		public function set_config( $activate = false ) {
			$this->cf = NgfbConfig::get_config( false, true );	// apply filters and define the $cf['*'] array
		}

		// runs at init 1
		public function init_widgets() {
			$opts = get_option( NGFB_OPTIONS_NAME );
			if ( ! empty( $opts['plugin_widgets'] ) ) {
				foreach ( $this->cf['plugin'] as $ext => $info ) {
					if ( isset( $info['lib']['widget'] ) && is_array( $info['lib']['widget'] ) ) {
						foreach ( $info['lib']['widget'] as $id => $name ) {
							$classname = apply_filters( $ext.'_load_lib', false, 'widget/'.$id );
							if ( $classname !== false && class_exists( $classname ) ) {
								register_widget( $classname );	// name of a class that extends WP_Widget
							}
						}
					}
				}
			}
		}

		// runs at init priority 11 by default
		// called by activate_plugin() as well
		public function set_options( $activate = false ) {

			if ( $activate && defined( 'NGFB_RESET_ON_ACTIVATE' ) && NGFB_RESET_ON_ACTIVATE ) {
				error_log( 'NGFB_RESET_ON_ACTIVATE constant is true - reloading default settings for plugin activation' );
				delete_option( NGFB_OPTIONS_NAME );
			}

			$this->options = get_option( NGFB_OPTIONS_NAME );

			// look for alternate options name
			if ( ! is_array( $this->options ) ) {
				if ( defined( 'NGFB_OPTIONS_NAME_ALT' ) && NGFB_OPTIONS_NAME_ALT ) {
					$this->options = get_option( NGFB_OPTIONS_NAME_ALT );
					if ( is_array( $this->options ) ) {
						$preserve_alt_opts = class_exists( 'Wpsso' ) && 
							NGFB_OPTIONS_NAME_ALT === 'wpsso_options' ? true : false;
						if ( ! $preserve_alt_opts ) {
							update_option( NGFB_OPTIONS_NAME, $this->options );	// auto-creates with autoload = yes
							delete_option( NGFB_OPTIONS_NAME_ALT );
						}
					}
				}
			}

			// check_options() saves the settings
			if ( ! is_array( $this->options ) ) {
				if ( isset( $this->cf['opt']['defaults'] ) ) {	// just in case
					$this->options = $this->cf['opt']['defaults'];
				} else {
					$this->options = array();
				}
				// reload from filtered defaults when all classes loaded
				$this->options['options_reload_defaults'] = true;
			}

			if ( is_multisite() ) {

				$this->site_options = get_site_option( NGFB_SITE_OPTIONS_NAME );

				// look for alternate site options name
				if ( ! is_array( $this->site_options ) ) {
					if ( defined( 'NGFB_SITE_OPTIONS_NAME_ALT' ) && NGFB_SITE_OPTIONS_NAME_ALT ) {
						$this->site_options = get_site_option( NGFB_SITE_OPTIONS_NAME_ALT );
						if ( is_array( $this->site_options ) ) {
							$preserve_alt_opts = class_exists( 'Wpsso' ) && 
								NGFB_SITE_OPTIONS_NAME_ALT === 'wpsso_site_options' ? true : false;
							if ( ! $preserve_alt_opts ) {
								update_site_option( NGFB_SITE_OPTIONS_NAME, $this->site_options );
								delete_site_option( NGFB_SITE_OPTIONS_NAME_ALT );
							}
						}
					}
				}

				// check_options() saves the settings
				if ( ! is_array( $this->site_options ) ) {
					if ( isset( $this->cf['opt']['site_defaults'] ) ) {	// just in case
						$this->site_options = $this->cf['opt']['site_defaults'];
					} else {
						$this->site_options = array();
					}
					// reload from filtered defaults when all classes loaded
					$this->site_options['options_reload_defaults'] = true;
				}

				// if multisite options are found, check for overwrite of site specific options
				if ( is_array( $this->options ) && is_array( $this->site_options ) ) {
					$blog_id = get_current_blog_id();	// since wp 3.1
					$defined_constants = get_defined_constants( true );	// $categorize = true
					foreach ( $this->site_options as $key => $val ) {
						if ( strpos( $key, ':use' ) !== false ) {
							continue;
						}
						if ( isset( $this->site_options[$key.':use'] ) ) {
							switch ( $this->site_options[$key.':use'] ) {
								case'force':
									$this->options[$key.':is'] = 'disabled';
									$this->options[$key] = $this->site_options[$key];
									break;
								case 'empty':	// blank string, null, false, or 0
									if ( empty( $this->options[$key] ) ) {
										$this->options[$key] = $this->site_options[$key];
									}
									break;
							}
						}
						$constant_name = 'NGFB_ID_'.$blog_id.'_OPT_'.strtoupper( $key );
						if ( isset( $defined_constants['user'][$constant_name] ) ) {
							$this->options[$key] = $defined_constants['user'][$constant_name];
						}
					}
				}
			}
		}

		// runs at init priority 12 by default
		// called by activate_plugin() as well
		public function set_objects( $activate = false ) {
			
			$network = is_multisite() ? true : false;

			$this->check = new NgfbCheck( $this );
			$this->avail = $this->check->get_avail();	// uses $this->options in checks

			// configure the debug class
			if ( ! empty( $this->options['plugin_debug'] ) || ( defined( 'NGFB_HTML_DEBUG' ) && NGFB_HTML_DEBUG ) ) {
				$html_debug = true;
			} else {
				$html_debug = false;
			}

			if ( defined( 'NGFB_WP_DEBUG' ) && NGFB_WP_DEBUG ) {
				$wp_debug = true;
			} elseif ( is_admin() && defined( 'NGFB_ADMIN_WP_DEBUG' ) && NGFB_ADMIN_WP_DEBUG ) {
				$wp_debug = true;
			} else {
				$wp_debug = false;
			}

			if ( ( $html_debug || $wp_debug ) &&	// only load debug class if debug options are enabled
				( $classname = NgfbConfig::load_lib( false, 'com/debug', 'SucomDebug' ) ) ) {
				$this->debug = new $classname( $this, array( 'html' => $html_debug, 'wp' => $wp_debug ) );
				if ( $this->debug->enabled ) {
					global $wp_version;
					$this->debug->log( 'debug enabled on '.date( 'c' ) );
					$this->debug->log( 'hostname '.php_uname( 'n' ) );
					$this->debug->log( 'WP version '.$wp_version );
					$this->debug->log( 'PHP version '.phpversion() );
					$this->debug->log( $this->check->get_ext_list() );
				}
			} else {
				$this->debug = new SucomNoDebug();	// make sure debug property is always available
			}

			do_action( 'ngfb_init_textdomain', $this->debug->enabled );

			if ( is_admin() &&	// only load notice class in the admin interface
				( $classname = NgfbConfig::load_lib( false, 'com/notice', 'SucomNotice' ) ) ) {
				$this->notice = new $classname( $this );
			} else {
				$this->notice = new SucomNoNotice();	// make sure the notice property is always available
			}

			$this->util = new NgfbUtil( $this );			// extends SucomUtil
			$this->opt = new NgfbOptions( $this );
			$this->cache = new SucomCache( $this );			// object and file caching
			$this->style = new NgfbStyle( $this );			// admin styles
			$this->script = new NgfbScript( $this );		// admin jquery tooltips
			$this->page = new NgfbPage( $this );			// page title, desc, etc.
			$this->media = new NgfbMedia( $this );			// images, videos, etc.
			$this->filters = new NgfbFilters( $this );		// integration filters
			$this->head = new NgfbHead( $this );

			// meta tags and json-ld markup
			$this->og = new NgfbOpenGraph( $this );			// open graph
			$this->weibo = new NgfbWeibo( $this );			// weibo
			$this->tc = new NgfbTwitterCard( $this );		// twitter
			$this->schema = new NgfbSchema( $this );		// schema

			if ( is_admin() ) {
				$this->msgs = new NgfbMessages( $this );	// admin tooltip messages
				$this->admin = new NgfbAdmin( $this );		// admin menus and page loader
			}

			if ( $this->avail['p_ext']['ssb'] ) {
				$this->sharing = new NgfbSharing( $this );	// wp_head and wp_footer js and buttons
			}

			$this->loader = new NgfbLoader( $this );		// module loader

			if ( $this->debug->enabled ) {
				$this->debug->mark( 'init objects action' );	// begin timer
			}
			do_action( 'ngfb_init_objects', $activate );

			if ( $this->debug->enabled ) {
				$this->debug->mark( 'init objects action' );	// end timer
			}

			/*
			 * set_options() may have loaded the static defaults for new or missing options.
			 * After all objects have been loaded, and all filter / action hooks registered, 
			 * check to see if the options need to be reloaded from the filtered defaults.
			 */
			if ( isset( $this->options['options_reload_defaults'] ) && 
				$this->options['options_reload_defaults'] === true ) {
				$this->options = $this->opt->get_defaults();	// check_options() saves the settings
			}
			$this->options = $this->opt->check_options( NGFB_OPTIONS_NAME,
				$this->options, $network, $activate );

			if ( $network ) {
				if ( isset( $this->options['options_reload_defaults'] ) && 
					$this->options['options_reload_defaults'] === true ) {
					$this->options = $this->opt->get_site_defaults();	// check_options() saves the settings
				}
				$this->site_options = $this->opt->check_options( NGFB_SITE_OPTIONS_NAME,
					$this->site_options, $network, $activate );
			}

			/*
			 * Issue reminder notices and disable some caching when the plugin's debug mode is enabled.
			 */
			if ( $this->debug->enabled ) {
				$info = $this->cf['plugin']['ngfb'];
				if ( $this->debug->is_enabled( 'wp' ) ) {
					if ( ! isset( $_SESSION ) ) {
						session_start();
					}
					$this->debug->log( 'WP debug log mode is active' );
					if ( is_admin() ) {
						$this->notice->warn( __( 'WP debug log mode is active &mdash; debug messages are being sent to the WordPress debug log.',
							'nextgen-facebook' ).' '.sprintf( __( 'Debug mode disables some %s caching features, which degrades performance slightly.',
							'nextgen-facebook' ), $info['short'] ).' '.__( 'Please disable debug mode when debugging is complete.',
							'nextgen-facebook' ) );
					}
				} elseif ( $this->debug->is_enabled( 'html' ) ) {
					$this->debug->log( 'HTML debug mode is active' );
					if ( is_admin() ) {
						$this->notice->warn( __( 'HTML debug mode is active &mdash; debug messages are being added to webpages as hidden HTML comments.',
							'nextgen-facebook' ).' '.sprintf( __( 'Debug mode disables some %s caching features, which degrades performance slightly.',
							'nextgen-facebook' ), $info['short'] ).' '.__( 'Please disable debug mode when debugging is complete.',
							'nextgen-facebook' ) );
					}
				}
				$this->util->add_plugin_filters( $this, array( 
					'cache_expire_head_array' => '__return_zero',
					'cache_expire_setup_html' => '__return_zero',
					'cache_expire_sharing_buttons' => '__return_zero',
				) );
			}

			if ( class_exists( 'Wpsso' ) ) {	// just in case
				if ( $this->debug->enabled ) {
					$this->debug->log( 'wpsso class detected - disabling a selection of features' );
				}
				if ( is_admin() ) {
					$this->notice->err( __( 'The WPSSO core plugin has been detected &mdash; WPSSO is a newer version of NextGEN Facebook and the two plugins cannot be active at the same time. Please deactivate and uninstall the NextGEN Facebook plugin.', 'nextgen-facebook' ) );
				}
				add_filter( 'ngfb_add_head_html', '__return_false' );
				add_filter( 'ngfb_add_schema_head_attributes', '__return_false' );
				add_filter( 'ngfb_sharing_buttons_html', '__return_false' );
			}
		}

		// runs at init priority 13 by default
		public function init_shortcodes() {
			if ( ! empty( $this->options['plugin_shortcodes'] ) ) {
				foreach ( $this->cf['plugin'] as $ext => $info ) {
					if ( isset( $info['lib']['shortcode'] ) && is_array( $info['lib']['shortcode'] ) ) {
						foreach ( $info['lib']['shortcode'] as $id => $name ) {
							$classname = apply_filters( $ext.'_load_lib', false, 'shortcode/'.$id );
							if ( $classname !== false && class_exists( $classname ) ) {
								$this->sc[$id] = new $classname( $this );
							}
						}
					}
				}
			}
		}

		// runs at init priority 14 by default
		public function init_plugin() {

			if ( $this->debug->enabled ) {
				$this->debug->mark( 'plugin initialization' );	// begin timer
			}

			if ( $this->debug->enabled ) {
				foreach ( array( 'wp_head', 'wp_footer', 'admin_head', 'admin_footer' ) as $action ) {
					foreach ( array( -9000, 9000 ) as $prio ) {
						add_action( $action, create_function( '',
							'echo "<!-- ngfb '.$action.' action hook priority '.$prio.' mark -->\n";' ), $prio );
						add_action( $action, array( &$this, 'show_debug' ), $prio + 1 );
					}
				}
				foreach ( array( 'wp_footer', 'admin_footer' ) as $action ) {
					foreach ( array( 9900 ) as $prio ) {
						add_action( $action, array( &$this, 'show_config' ), $prio );
					}
				}
			}

			if ( $this->debug->enabled ) {
				$this->debug->log( 'running init_plugin action' );
			}

			do_action( 'ngfb_init_plugin' );

			if ( $this->debug->enabled ) {
				$this->debug->mark( 'plugin initialization' );	// end timer
			}
		}

		// runs at ngfb_init_textdomain priority -10
		public static function init_textdomain( $debug_enabled ) {
			if ( $debug_enabled ) {
				add_filter( 'load_textdomain_mofile', 
					array( self::get_instance(), 'override_textdomain_mofile' ), 10, 3 );
			}
			load_plugin_textdomain( 'nextgen-facebook', false, 'nextgen-facebook/languages/' );
		}

		// only runs when debug is enabled
		public function override_textdomain_mofile( $wp_mofile, $domain ) {
			if ( strpos( $domain, 'nextgen-facebook' ) === 0 ) {	// optimize
				foreach ( $this->cf['plugin'] as $ext => $info ) {
					if ( $info['slug'] === $domain ) {
						$constant_name = strtoupper( $ext ).'_PLUGINDIR';
						if ( defined( $constant_name ) && $plugin_dir = constant( $constant_name ) ) {
							$plugin_mofile = $plugin_dir.'languages/'.basename( $wp_mofile );
							if ( $plugin_mofile !== $wp_mofile && is_readable( $plugin_mofile ) ) {
								global $l10n;
								unset( $l10n[$domain] );	// prevent merging
								return $plugin_mofile;
							}
						}
						break;	// stop here
					}
				}
			}
			return $wp_mofile;
		}

		// only runs when debug is enabled
		public function show_debug() { 
			$this->debug->show_html( null, 'debug log' );
		}

		// only runs when debug is enabled
		public function show_config() { 

			if ( ! $this->debug->enabled ) {	// just in case
				return;
			}

			// show constants
			$defined_constants = get_defined_constants( true );
			$defined_constants['user']['NGFB_NONCE'] = '********';

			if ( is_multisite() ) {
				$this->debug->show_html( SucomUtil::preg_grep_keys( '/^(MULTISITE|^SUBDOMAIN_INSTALL|.*_SITE)$/', 
					$defined_constants['user'] ), 'multisite constants' );
			}

			$this->debug->show_html( SucomUtil::preg_grep_keys( '/^NGFB_/', $defined_constants['user'] ), 'ngfb constants' );

			// show active plugins
			$this->debug->show_html( print_r( SucomUtil::active_plugins(), true ), 'active plugins' );

			// show available modules
			$this->debug->show_html( print_r( $this->avail, true ), 'available features' );

			// show all plugin options
			$opts = $this->options;
			foreach ( $opts as $key => $val ) {
				switch ( $key ) {
					case ( strpos( $key, '_js_' ) !== false ? true : false ):
					case ( strpos( $key, '_css_' ) !== false ? true : false ):
					case ( preg_match( '/(_css|_js|_html)$/', $key ) ? true : false ):
					case ( preg_match( '/_(key|secret|tid|token)$/', $key ) ? true : false ):
						$opts[$key] = '[removed]';
						break;
				}
			}
			$this->debug->show_html( $opts, 'ngfb settings' );
		}
	}

	global $ngfb;
	$ngfb =& Ngfb::get_instance();
}

?>
