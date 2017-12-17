<?php

/** register support for WordPress menu **/
add_action('init', 'jkreativ_lite_register_menu');

function jkreativ_lite_register_menu() {
	register_nav_menus(array(
		'side_navigation' => __('Main Side Navigation', 'jkreativ-lite'),
		'side_btm_navigation' => __('Side Navigation Bottom', 'jkreativ-lite'),
		'mobile_navigation' => __('Mobile Navigation', 'jkreativ-lite')
	));
};

/******************************************************************
 * mobile navigation
 ******************************************************************/

function jkreativ_lite_mobile_navigation() {
	wp_nav_menu(
		array(
			'theme_location' => 'mobile_navigation',
			'container' => false,
			'menu_class' => '',
			'depth' => -1,
			'walker' => new jkreativ_lite_mobile_navigation_walker(),
			'fallback_cb'     => ''
		)
	);
}

class jkreativ_lite_mobile_navigation_walker extends Walker_Nav_Menu
{
	function start_el(&$output, $item, $depth = 0, $args = Array(), $current_object_id = 0)
	{
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$classes[] = 'bgnav';

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_url(  $item->url        ) .'"' : '';

		$nav_description = ! empty($item->description) ? '<span>' . esc_attr( $item->description ) . '</span>' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before  . apply_filters( 'the_title', $item->title, $item->ID )  ;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args ) . "<li class='separator'></li>";
	}
}


/******************************************************************
 * Side Navigation Bottom
 ******************************************************************/

function jkreativ_lite_side_bottom_navigation() {
	if(function_exists('wp_nav_menu')) {
		wp_nav_menu(
			array(
				'theme_location' => 'side_btm_navigation',
				'container' => 'div',
				'container_class' => 'footlink',
				'menu_class' => '',
				'depth' => -1,
				'walker' => new jkreativ_lite_side_btm_navigation_walker(),
				'fallback_cb'     => '',
			)
		);
	}
}

class jkreativ_lite_side_btm_navigation_walker extends Walker_Nav_Menu
{
	function start_el(&$output, $item, $depth = 0, $args = Array(), $current_object_id = 0)
	{
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';


		if($item->post_type === 'page') {
			$output .= "<li><a href='" . get_page_link($item->ID) . "'> " . $item->post_title . " </a></li>";
		} else {
			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;
			$classes[] = 'bgnav';

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			$class_names = ' class="' . esc_attr( $class_names ) . '"';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names .'>';

			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ! empty( $item->url )        ? ' href="'   . esc_url(  $item->url        ) .'"' : '';

			$nav_description = ! empty($item->description) ? '<span>' . esc_attr( $item->description ) . '</span>' : '';

			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before  . apply_filters( 'the_title', $item->title, $item->ID )  ;
			$item_output .= '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args ) . "<li class='separator'></li>";
		}
	}
}



/******************************************************************
 * Main side navigation
 ******************************************************************/

function jkreativ_lite_main_side_navigation() {
	if(function_exists('wp_nav_menu')) {
		wp_nav_menu(
			array(
				'theme_location' => 'side_navigation',
				'container' => 'div',
				'container_class' => 'mainnavigation',
				'menu_class' => 'mainnav',
				'depth' => 3,
				'walker' => new jkreativ_lite_side_navigation_walker(),
				'fallback_cb' => ''
			)
		);
	}
}

class jkreativ_lite_side_navigation_walker extends Walker_Nav_Menu
{
	function start_el(&$output, $item, $depth = 0, $args = Array(), $current_object_id = 0)
	{
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		if($item->post_type === 'page') {
			$output .= "<li><a href='" . get_page_link($item->ID) . "'> " . $item->post_title . " </a></li>";
		} else {
			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;
			$classes[] = 'bgnav';

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			$class_names = ' class="' . esc_attr( $class_names ) . '"';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names .'>';

			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

			$nav_description = ! empty($item->description) ? '<span>' . esc_attr( $item->description ) . '</span>' : '';

			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before . '<h2>' . apply_filters( 'the_title', $item->title, $item->ID ) . '</h2>' ;
			$item_output .= '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}

	}

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"childmenu\">\n";
	}
}
