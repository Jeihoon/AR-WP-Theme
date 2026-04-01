<?php
/**
 * The template for displaying comments.
 *
 * @package AR_Theme
 */

if ( post_password_required() ) {
    return; // Don’t show comments if the post is password-protected
}
?>

<div id="comments" class="ar-comments-section">

    <?php if ( have_comments() ) : ?>
        <h3 class="ar-comments-title">
            <?php
            printf(
                /* translators: %s: number of comments */
                _nx(
                    '%1$s Comment',
                    '%1$s Comments',
                    get_comments_number(),
                    'comments title',
                    'ar-theme'
                ),
                number_format_i18n( get_comments_number() )
            );
            ?>
        </h3>

        <ul class="ar-comment-list comment-list">
            <?php
            wp_list_comments( [
                'style'       => 'ul',
                'short_ping'  => true,
                'avatar_size' => 0,
                'callback'    => 'ar_comment_callback',
            ] );
            ?>
        </ul>

        <?php
        // Paginate comments if needed
        the_comments_pagination( [
            'prev_text' => __( '← Older Comments', 'ar-theme' ),
            'next_text' => __( 'Newer Comments →', 'ar-theme' ),
        ] );
        ?>
    <?php endif; ?>

    <?php if ( ! comments_open() && get_comments_number() ) : ?>
        <p class="ar-comments-closed">
            <?php esc_html_e( 'Comments are closed.', 'ar-theme' ); ?>
        </p>
    <?php endif; ?>

    <?php
    // Comment form
    comment_form( [
        'class_form'   => 'ar-comment-form comment-form',
        'title_reply'  => __( 'Leave a Reply', 'ar-theme' ),
        'label_submit' => __( 'Post Comment', 'ar-theme' ),
    ] );
    ?>

</div>
