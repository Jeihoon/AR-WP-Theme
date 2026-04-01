<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function ar_comment_callback( $comment, $args, $depth ) {
    $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
    printf( '<%1$s %2$s id="comment-%3$d">', $tag, comment_class( 'ar-comment', $comment, null, false ), get_comment_ID() );
    printf( '<p class="ar-comment-date">%1$s at %2$s</p>', get_comment_date( '', $comment ), get_comment_time( '', $comment ) );
    printf( '<p class="ar-comment-author">%s says:</p>', esc_html( get_comment_author( $comment ) ) );
    echo '<div class="ar-comment-content">'; comment_text(); echo '</div>';
    if ( '0' === $comment->comment_approved ) {
        echo '<p class="ar-comment-moderation">'; esc_html_e( 'Your comment is awaiting moderation.', 'ar-theme' ); echo '</p>';
    }
    echo '<div class="ar-comment-reply">';
    comment_reply_link( array_merge( $args, [ 'depth'=>$depth, 'max_depth'=>$args['max_depth'], 'reply_text'=>__( 'Reply', 'ar-theme' ) ] ) );
    echo '</div>';
    echo "</{$tag}>\n";
}