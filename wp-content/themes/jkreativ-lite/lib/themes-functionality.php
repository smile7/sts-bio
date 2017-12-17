<?php

function jkreativ_lite_is_using_loading() {
	return ( ot_get_option('enable_loader') === "on" ) ? true : false ;
}

/**
 * Detect retina device
 */
function jkreativ_lite_is_retina_device()
{
	if(isset($_COOKIE["device_pixel_ratio"])) {
		return $_COOKIE["device_pixel_ratio"] > 1;
	} else {
		return false;
	}
}

/**
 * social icon
 */
function jkreativ_lite_populate_social () {
	$socialarray = array();

	// facebook
	if(ot_get_option('social_facebook')) {
		$socialarray[] = array(
			'icon'	=> 'default-facebook',
			'url'	=> ot_get_option('social_facebook'),
			'text'	=> 'Facebook'
		);
	}

	// twitter
	if(ot_get_option('social_twitter')) {
		$socialarray[] = array(
			'icon'	=> 'default-twitter',
			'url'	=> ot_get_option('social_twitter'),
			'text'	=> 'Twitter'
		);
	}

	// linked in
	if(ot_get_option('social_linkedin')) {
		$socialarray[] = array(
			'icon'	=> 'default-linkedin',
			'url'	=> ot_get_option('social_linkedin'),
			'text'	=> 'Linked In'
		);
	}

	// Google Plus
	if(ot_get_option('social_googleplus')) {
		$socialarray[] = array(
			'icon'	=> 'default-googleplus',
			'url'	=> ot_get_option('social_googleplus'),
			'text'	=> 'Google Plus'
		);
	}

	// Pinterest
	if(ot_get_option('social_pinterest')) {
		$socialarray[] = array(
			'icon'	=> 'default-pinterest',
			'url'	=> ot_get_option('social_pinterest'),
			'text'	=> 'Pinterest'
		);
	}

	// Github
	if(ot_get_option('social_github')) {
		$socialarray[] = array(
			'icon'	=> 'default-github',
			'url'	=> ot_get_option('social_github'),
			'text'	=> 'Github'
		);
	}

	// Flickr
	if(ot_get_option('social_flickr')) {
		$socialarray[] = array(
			'icon'	=> 'default-flickr',
			'url'	=> ot_get_option('social_flickr'),
			'text'	=> 'Flickr'
		);
	}

	// Tumblr
	if(ot_get_option('social_tumblr')) {
		$socialarray[] = array(
			'icon'	=> 'default-tumblr',
			'url'	=> ot_get_option('social_tumblr'),
			'text'	=> 'Tumblr'
		);
	}

	// Dribbble
	if(ot_get_option('social_dribbble')) {
		$socialarray[] = array(
			'icon'	=> 'default-dribbble',
			'url'	=> ot_get_option('social_dribbble'),
			'text'	=> 'Dribbble'
		);
	}

	// Soundcloud
	if(ot_get_option('social_soundcloud')) {
		$socialarray[] = array(
			'icon'	=> 'default-soundcloud',
			'url'	=> ot_get_option('social_soundcloud'),
			'text'	=> 'Soundcloud'
		);
	}

	// Last FM
	if(ot_get_option('social_lastfm')) {
		$socialarray[] = array(
			'icon'	=> 'default-lastfm',
			'url'	=> ot_get_option('social_lastfm'),
			'text'	=> 'Last.FM'
		);
	}

	// Behance
	if(ot_get_option('social_behance')) {
		$socialarray[] = array(
			'icon'	=> 'default-behance',
			'url'	=> ot_get_option('social_behance'),
			'text'	=> 'Behance'
		);
	}

	// instagram
	if(ot_get_option('social_instagram')) {
		$socialarray[] = array(
			'icon'	=> 'default-instagram',
			'url'	=> ot_get_option('social_instagram'),
			'text'	=> 'Instagram'
		);
	}

	// Vimeo
	if(ot_get_option('social_vimeo')) {
		$socialarray[] = array(
			'icon'	=> 'default-vimeo',
			'url'	=> ot_get_option('social_vimeo'),
			'text'	=> 'Vimeo'
		);
	}

	return $socialarray;
}

function jkreativ_lite_social_icon($withtext)
{
	$html = "<ul>";

	$socialarray = jkreativ_lite_populate_social();
	foreach($socialarray as $soc) {
		if($withtext) {
			$html .= "<li><a href='" . esc_url($soc['url']) . "'><i class='" . esc_attr($soc['icon']) . "'></i>" . esc_html($soc['text']) . "</a></li>";
		} else {
			$html .= "<li><a href='" . esc_url($soc['url']) . "'><i class='" . esc_attr($soc['icon']) . "'></i></a></li>";
		}
	}

	$html .= "</ul>";

	return $html;
}



/** register sidebar **/
if(!function_exists('jkreativ_lite_register_sidebars'))
{
	function jkreativ_lite_register_sidebars()
	{
		register_sidebar(array(
			'name'			=> __('Main Sidebar', 'jkreativ-lite'),
			'id' 			=> 'sidebar-main',
			'before_widget' => '<div class="blog-sidebar %2$s" id="%1$s"><div class="blog-sidebar-content">',
	        'before_title'	=> '<div class="blog-sidebar-title"><h3>',
	        'after_title' 	=> '</h3></div>',
	        'after_widget' 	=> '</div></div>',
		));
	}
	add_action( 'widgets_init', 'jkreativ_lite_register_sidebars' );
}


/** next prev item **/
if ( ! function_exists( 'jkreativ_lite_next_prev_portfolio' ) )
{
	function jkreativ_lite_next_prev_portfolio($parentid, $currentid, $to, $category = '')
	{
		$portfolioquery = array(
			'post_type' => 'portfolio',
			'meta_query' => array(
		       array(
		           'key' => 'portfolio_parent',
		           'value' => array($parentid),
		           'compare' => 'IN',
		       )
		   	),
			'orderby' => 'date',
			'order' => 'DESC',
		);


		if($category !== '') {
			$portfolioquery['tax_query'] =
			array(
		        array(
		            'taxonomy' 	=>  'portfolio_category',
		            'terms' 	=>  $category,
		            'field' 	=> 'id',
		            'operator' 	=> 'IN'
		        )
		    );
		}

		$query = new WP_Query($portfolioquery);

		$result = $query->posts;
		$currentpost = 0;

		foreach($result as $key => $res) {
			if($currentid === $res->ID) {
				$currentpost = $key;
				break;
			}
		}

		if($to === 'next') {
			$nextpost = $currentpost + 1;
			if($nextpost >= sizeof($result)) {
				$nextpost = 0;
			}

			$nextcontent = $result[$nextpost];
			return $nextcontent->ID;
		} else {
			$prevpost = $currentpost - 1;
			if($prevpost < 0) {
				$prevpost = sizeof($result) - 1;
			}
			$prevcontent = $result[$prevpost];
			return $prevcontent->ID;
		}
	}
}
/** next prev item **/


/*** excerpt setup ***/
function jkreativ_lite_excerpt_length( $length )
{
	return 50;
}

if ( ! function_exists( 'jkreativ_lite_continue_reading_link' ) )
{
	function jkreativ_lite_continue_reading_link() {
		return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'jkreativ-lite' ) . '</a>';
	}
}

function jkreativ_lite_auto_excerpt_more( $more ) {
	return ' &hellip;' . jkreativ_lite_continue_reading_link();
}

add_filter( 'excerpt_length', 'jkreativ_lite_excerpt_length' );
add_filter( 'excerpt_more', 'jkreativ_lite_auto_excerpt_more' );

function jkreativ_lite_posts_link_attributes() {
	return 'class="btn"';
}

/***
 * Post View Count
 */
 function jkreativ_lite_get_post_views($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}

function jkreativ_lite_set_post_views($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count=='') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}


/** comment **/
function jkreativ_lite_get_wordpress_comment()
{
	$number = get_comments_number();

	if ( $number > 1 ) {
		$output = str_replace('%', number_format_i18n($number), __('% Comments', 'jkreativ-lite'));
	}
	elseif ( $number == 0 ) {
		$output = __('No Comments', 'jkreativ-lite');
	}
	else { // must be one
		$output = __('1 Comment', 'jkreativ-lite');
	}

	return $output;
}



function jkreativ_lite_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?>>
	<div id="comment-<?php comment_ID(); ?>">
		<div class="coment-box">
			<div class="coment-box-inner">
				<div class="comment-autor">
					<?php echo get_avatar($comment,$size='80',$default='' ); ?>
				</div>

				<div class="comment-meta">
					<ul>
						<li class="addby">
							<div class="authorcomment"><?php comment_author_link(); ?></div>
							<span data-comment-id="<?php comment_ID(); ?>" class="replycomment"><?php _e('Replay', 'jkreativ-lite'); ?></span>
							<span class="closecommentform"><?php _e('Cancel Replay', 'jkreativ-lite'); ?></span>
						</li>
						<li class="addtime"><?php echo get_comment_date('F j, Y'); ?></li>
					</ul>
				</div>

				<div class="comment-text">
					<?php
					if($comment->comment_approved == '0') :
						echo "<em>" . _e("Your comment is awaiting moderation", "jkreativ-lite") . "</em>";
					endif;
					echo '<p>' . get_comment_text() . '</p>';
					?>
				</div>
				<div style="clear: both;"></div>
			</div>
		</div>
	</div>
</li>
<?php
}


/** location builder **/

function jkreativ_lite_location_block($idx, $location) {
	$html = '<div class="locationlist"><div data-index="'. $idx .'" class="mapitem">';
	if($location['title_leading'] !== '') {
		$html .= '<h4>' . $location['title_leading'] . ' : ' . $location['title'] . '</h4>';
	} else {
		$html .= '<h4>' . $location['title'] . '</h4>';
	}
	$html .= '<div class="mapdetail"><ul>';

	if($location['address'] !== '') {
		$html .= '<li><div class="detail">' . $location['address'] . '</div></li>';
	}
	if($location['address_second'] !== '') {
		$html .= '<li><div class="detail">' . $location['address_second'] . '</div></li>';
	}
	if($location['phone'] !== '') {
		$html .= '<li><div class="detail">' . $location['phone'] . '</div></li>';
	}
	if($location['email'] !== '') {
		$html .= '<li><div class="detail">' . $location['email'] . '</div></li>';
	}
	if($location['website'] !== '') {
		$html .= '<li><div class="detail"><a target="_blank" href="' . $location['website'] . '">' . $location['website'] . '</a></div></li>';
	}

	$html .= '</ul></div><div class="mapwrapper mapbutton"><span class="button-text">' . __('GET DIRECTION', 'jkreativ-lite') . '</span></div>';
	$html .= '</div></div>';

	return $html;
}


function jkreativ_lite_info_window($idx, $location) {
	$html = '<div class="infowindow" data-lat="' . $location['x'] . '" data-lng="' . $location['y'] . '">';
	$html .= '<div class="infowindow-wrapper">';
	$html .= '<h4>' . $location['title'] . '</h4>';
	$html .= '<ul>';

	if($location['address'] !== '') {
		$html .= '<li><div class="detail">' . $location['address'] . '</div></li>';
	}
	if($location['address_second'] !== '') {
		$html .= '<li><div class="detail">' . $location['address_second'] . '</div></li>';
	}
	if($location['phone'] !== '') {
		$html .= '<li><div class="detail">' . $location['phone'] . '</div></li>';
	}
	if($location['email'] !== '') {
		$html .= '<li><div class="detail">' . $location['email'] . '</div></li>';
	}
	if($location['website'] !== '') {
		$html .= '<li><div class="detail">' . $location['website'] . '</div></li>';
	}

	$html .= '</ul></div><div class="closeme"></div></div>';

	return $html;
}


function jkreativ_lite_get_all_portfolio_category ($pageid) {
	$category = array();
	$query = new WP_Query(array(
		'post_type' => 'portfolio',
		'meta_query' => array(
			array(
	           'key' => 'portfolio_parent',
	           'value' => array($pageid),
	           'compare' => 'IN',
	       )
	   	)
	));

	$result = $query->posts;
	foreach($result as $res) {
		$termlist = get_the_terms($res->ID, JEG_PORTFOLIO_CATEGORY);
		foreach($termlist as $term) {
			$category[$term->term_id] = $term->name;
		}
	}

	return $category;
}


function jkreativ_lite_to_slug($str)
{
	$replace	= '-';
	$trans = array(
		'&\#\d+?;'				=> '',
		'&\S+?;'				=> '',
		'\s+'					=> $replace,
		'[^a-z0-9\-\._]'		=> '',
		$replace.'+'			=> $replace,
		$replace.'$'			=> $replace,
		'^'.$replace			=> $replace,
		'\.+$'					=> ''
	);

	$str = strip_tags($str);

	foreach ($trans as $key => $val) :
		$str = preg_replace("#".$key."#i", $val, $str);
	endforeach;

	return trim(stripslashes(strtolower($str)));
}



function jkreativ_lite_get_post_images( $args=array() ) {
	global $post;

	$defaults = array(
		'numberposts'		=> -1,
		'order'				=> 'ASC',
		'orderby'			=> 'menu_order',
		'post_mime_type'	=> 'image',
		'post_parent'		=>  $post->ID,
		'post_type'			=> 'attachment',
	);

	$args = wp_parse_args( $args, $defaults );

	return get_posts( $args );
}