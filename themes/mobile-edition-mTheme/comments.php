<a name="comments" id="comments"></a>
<?php if ( post_password_required() ) : ?>
       <div class="ot_comments_container">
    <strong><?php _e( 'This post is password protected. Enter the password to view any comments.', 'fdx-lang' ); ?>  </strong>
        </div>
<?php
return;
		endif;
?>

<?php if ( have_comments() ) : ?>

               <div class="rack1"></div>
             <div class="ot_comments_respond">
           	<?php
				printf('&ldquo;%2$s&rdquo; Comment', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'fdx-lang' ,
					number_format_i18n( get_comments_number() ));
			?>
          <?php if ( ! comments_open()) : ?> <div style="float: right; margin-top: 5px; margin-right: 5px"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/comment-no.png" width="20" height="20" border="0" alt="" /></div> <?php else: ?> <div style="float: right; margin-top: 5px; margin-right: 5px"><a href="#ot_reply"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/comment-yes.png" width="20" height="20" border="0" alt="" /></a></div> <?php endif; ?>
            </div>
             <div id="respond">
        <div class="ot_comments_container" style=" padding: 0; border: 0">


        <div class="ot_comments" id="comments">
		<ol>
		<?php wp_list_comments( array( 'callback' => 'fdx_comment' ) );?>
		</ol>
        </div>


		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
    	<div class="ot_comments_container">
		 	<div style="float: left" class="pages_count"><?php previous_comments_link( __( '&larr; Older Comments', 'fdx-lang' ) ); ?></div>
			<div style="float: right" class="pages_count"><?php next_comments_link( __( 'Newer Comments &rarr;', 'fdx-lang' ) ); ?></div>

        <div class="ot_clear"></div>
         </div>
		<?php endif; // check for comment navigation ?>


       </div>
      </div>

<?php endif; // have_comments() ?>

<?php if ( ! comments_open()) : ?>
<!-- Comments are closed -->
<?php else: ?>
<div class="rack1"></div>
 <a id="ot_reply" name="ot_reply"></a>
<div class="ot_comments_respond"><?php _e('Leave a Comment', 'fdx-lang') ?></div>
<div class="ot_comments_container">
<div style="width: 295px;">
<?php comment_form(array(
        'title_reply' => '',
		'cancel_reply_link' => __('Cancel reply', 'fdx-lang'),
		'label_submit' => __( 'Post Comment', 'fdx-lang'),
        'comment_field' => '<br /><label for="comment">' . __( 'Comment', 'fdx-lang' ) . '</label><textarea class="ot_commentform_textarea" name="comment" cols="100" rows="10" aria-required="true"></textarea>',
        'comment_notes_after' => '',
        'comment_notes_before' => '',
        'must_log_in' => '<p>' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'fdx-lang'), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>'
     )); ?>
</div>
</div>

 <?php endif; ?>
