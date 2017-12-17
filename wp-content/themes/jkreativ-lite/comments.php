<?php

	if ( post_password_required() ) {
		echo '<p class="nopassword">' . __( 'This post is password protected. Enter the password to view any comments.', 'jkreativ-lite') . '</p>';
		return ;
	}


	function jkreativ_lite_comment_form($i) {

		$commenter = wp_get_current_commenter();
		$user = wp_get_current_user();
		$user_identity = $user->exists() ? $user->display_name : '';

		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

		$i['author'] =  '<p class="comment-form-author"><span class="comment-author-wrapper comment-input-wrapper">' . '<label for="author">' . __("Name","jkreativ-lite") . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
		                '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></span></p>';
		$i['email']  =  '<p class="comment-form-email"><span class="comment-email-wrapper comment-input-wrapper"><label for="email">' . __( 'Email','jkreativ-lite' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
		            	'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></span></p>';
		$i['url']    =  '<p class="comment-form-url"><span class="comment-form-wrapper comment-input-wrapper"><label for="url">' . __( 'Website','jkreativ-lite' ) . '</label>' .
		            	'<input id="url" name="url" type="text" value="' . esc_url( $commenter['comment_author_url'] ) . '" size="30" /></span></p>';

		return $i;
	}

	add_action('comment_form_default_fields', 'jkreativ_lite_comment_form');


	function jkreativ_lite_comment_default_form($defaults)
	{

		global $id;
		$post_id = $id;

		$commenter = wp_get_current_commenter();
		$user = wp_get_current_user();
		$user_identity = $user->exists() ? $user->display_name : '';

		$req = get_option( 'require_name_email' );
		$required_text = sprintf( ' ' . __( 'Required fields are marked %s', 'jkreativ-lite' ) , '<span class="required">*</span>' );

		$newdefaults = array(
			'fields'               => $defaults['fields'],
			'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . __('Comment', 'jkreativ-lite') . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
			'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'jkreativ-lite' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
			'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'jkreativ-lite' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
			'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published', 'jkreativ-lite' ) . ( $req ? $required_text : '' ) . '</p>',
			'comment_notes_after'  => '<p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'jkreativ-lite' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
			'id_form'              => 'commentform',
			'id_submit'            => 'submit',
			'title_reply'          => __( 'Leave a Reply', 'jkreativ-lite' ),
			'title_reply_to'       => __( 'Leave a Reply to %s', 'jkreativ-lite' ),
			'cancel_reply_link'    => __( 'Cancel reply', 'jkreativ-lite' ),
			'label_submit'         => __( 'Post Comment', 'jkreativ-lite' ),
		);

		return $newdefaults;
	}

	add_action('comment_form_defaults', 'jkreativ_lite_comment_default_form');

	if ( comments_open() ) {
?>
<div id="comments" class="comment-container">
	<h2><?php echo jkreativ_lite_get_wordpress_comment() ?></h2>
	<hr>

	<div id="comment-content-container">
		<ul class="commentlist">
			<?php wp_list_comments(array(
				'type'			=> 'all',
				'callback'		=> apply_filters('jkreativ_lite_comment_callback', 'jkreativ_lite_comment'),
				'avatar_size'	=> '80'
			)); ?>
		</ul>

		<div class="comment-navigation navigation" >
			<div class='alignleft' style="margin-bottom: 20px;">
				<?php next_comments_link('<span>&laquo;</span> Previous') ?>
			</div>
			<div class='alignright' style="margin-bottom: 20px;">
				<?php previous_comments_link('Next<span>&raquo;</span>') ?>
			</div>
		</div>
	</div>


	<?php
		if ( get_option('comment_registration') && !is_user_logged_in() ) :
			echo "<p>" . __("Please login to comment","jkreativ-lite") . "</p>";
		else :
			comment_form();
		endif; // comment form
	?>
</div>

<?php
	} // if comment open
?>
