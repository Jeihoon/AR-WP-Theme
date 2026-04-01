<?php
class AR_Recent_Posts_Widget extends WP_Widget_Recent_Posts {
    public function __construct() {
        parent::__construct(
            'ar_recent_posts',
            __( 'AR Recent Posts', 'ar-theme' ),
            [
                'classname'   => 'widget_recent_entries ar-recent-posts',
                'description' => __( 'Your Recent Posts, with thumbnails & date.', 'ar-theme' ),
            ]
        );
    }

    public function widget( $args, $instance ) {
        $title     = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) : '';
        $number    = ! empty( $instance['number'] ) ? absint( $instance['number'] ) : 5;
        $show_date = ! empty( $instance['show_date'] );

        // Begin widget wrapper
        echo $args['before_widget'];

        if ( $title ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        // Scoped CSS -> use this widget's unique ID so it overrides theme styles
        $wid = isset( $args['widget_id'] ) ? sanitize_html_class( $args['widget_id'] ) : ('ar-recent-posts-' . $this->number);
        ?>
        <style>
        /* ───────── AR Recent Posts (scoped to this widget) ───────── */
        #<?php echo esc_attr( $wid ); ?> .ar-rp-list{margin:0;padding:0;list-style:none;}
        #<?php echo esc_attr( $wid ); ?> .ar-rp-item{
            display:grid;
            grid-template-columns:80px 1fr; /* fixed thumb column | text column */
            column-gap:10px;                /* ← consistent space between thumb & text */
            align-items:center;
            margin:0 0 12px;
            text-align:left;
        }
        /* Thumb circle (works for <a> and <span>) */
        #<?php echo esc_attr( $wid ); ?> .ar-rp-thumb{
            position:relative;
            width:80px; height:80px;
            border-radius:50%;
            overflow:hidden;
            display:block;
            line-height:0;
            background:#f1f3f5; /* placeholder if no image */
            margin:0 !important; padding:0 !important; border:0 !important;
            transform:none !important; box-sizing:border-box;
        }
        #<?php echo esc_attr( $wid ); ?> .ar-rp-thumb img{
            position:absolute; inset:0;
            width:100%; height:100%;
            object-fit:cover; object-position:center;
            display:block; max-width:none !important; transform:none !important;
        }
        /* Text column: stack title (line 1) and date (line 2) */
        #<?php echo esc_attr( $wid ); ?> .ar-rp-text{
            grid-column:2;
            display:flex; flex-direction:column; align-items:flex-start;
            min-width:0; text-align:left;
        }
        /* Title exactly one line so date always shifts to the next line */
        #<?php echo esc_attr( $wid ); ?> .ar-rp-title{
            display:block;
            margin:0 !important;              /* neutralize generic li a margins */
            color:var(--ar-heading);
            font-weight:700;
            line-height:1.3;
            text-decoration:none;
            white-space:nowrap; overflow:hidden; text-overflow:ellipsis;
        }
        /* Date on its own line */
        #<?php echo esc_attr( $wid ); ?> .ar-rp-date{
            display:block;
            margin-top:.25em;
            font-size:.85em; color:gray; line-height:1.5;
        }
        /* Neutralize generic widget link rules that cause uneven spacing */
        #<?php echo esc_attr( $wid ); ?> .ar-rp-item a{margin:0 !important; text-decoration:none; color:inherit; font-weight:500;}
        </style>
        <?php

        $r = new WP_Query([
            'posts_per_page'      => $number,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
        ]);

        if ( $r->have_posts() ) {
            echo '<ul class="ar-rp-list">';
            while ( $r->have_posts() ) {
                $r->the_post();
                $has_thumb = has_post_thumbnail();
                ?>
                <li class="ar-rp-item">
                    <?php if ( $has_thumb ) : ?>
                        <a class="ar-rp-thumb" href="<?php echo esc_url( get_permalink() ); ?>"
                           aria-label="<?php echo esc_attr( get_the_title() ); ?>">
                            <?php
                            // Ensure image fills the circle without distortion
                            echo get_the_post_thumbnail(
                                get_the_ID(),
                                'thumbnail',
                                [
                                    'alt'   => the_title_attribute( [ 'echo' => false ] ),
                                    'class' => 'ar-rp-img',
                                ]
                            );
                            ?>
                        </a>
                    <?php else : ?>
                        <span class="ar-rp-thumb ar-rp-thumb--empty" aria-hidden="true"></span>
                    <?php endif; ?>

                    <div class="ar-rp-text">
                        <a class="ar-rp-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        <?php if ( $show_date ) : ?>
                            <time class="ar-rp-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                                <?php echo esc_html( get_the_date() ); ?>
                            </time>
                        <?php endif; ?>
                    </div>
                </li>
                <?php
            }
            echo '</ul>';
            wp_reset_postdata();
        }

        echo $args['after_widget'];
    }
}

add_action( 'widgets_init', function() {
    unregister_widget( 'WP_Widget_Recent_Posts' );
    register_widget( 'AR_Recent_Posts_Widget' );
});
