<?php
    if (post_password_required())
        return;
?>

<div id="comments">
    <?php if (have_comments()) : ?>

        <ul class="comment-list">
            <?php
                wp_list_comments( array(
                    'style'       => 'ul',
                    'short_ping'  => true,
                    'avatar_size' => 0,
                ));
            ?>
        </ul>

        <?php
            if (get_comment_pages_count() > 1 && get_option('page_comments')) :
        ?>
        <nav role="navigation">
            <h1><?php _e( 'Comment navigation', '' ); ?></h1>
            <div><?php previous_comments_link( __( '&larr; Older Comments', '' ) ); ?></div>
            <div><?php next_comments_link( __( 'Newer Comments &rarr;', '' ) ); ?></div>
        </nav>
        <?php endif; ?>

        <?php if (!comments_open() && get_comments_number() ) : ?>
            <p class="no-comments"><?php _e( 'Comments are closed.' , '' ); ?></p>
        <?php endif; ?>

    <?php endif; ?>
    <?php comment_form(); ?>
</div>
