<?php get_header(); ?>
<?php the_post(); ?>

    <div id="sidebar">
        <!-- Desktop Navigation -->
        <div id="sidebar-navigation-desktop">
            <?php
                custom_sidebar_menu(get_the_ID());
            ?>
        </div>
        
        <div>
            <?php 
                if (function_exists('dynamic_sidebar')) { 
                    dynamic_sidebar('body_sidebar'); 
                } 
            ?>
        </div>
    </div>

    <div id="page-content-container">

        <div class="breadcrumb breadcrumb-single">
            <?php breadcrumb(); ?>
        </div>

        <ul class="category-ul">

            <?php
            while ( have_posts() ) : the_post(); ?>
                <li class="li-postlist-item">
                    <!-- Überschrift -->
                    <h2 class="li-postlist-item-title">
                        <a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                    </h2>

                    <!-- Datum, Autor, ... -->
                    <div class="li-postlist-item-subtitle">
                        <small>Veröffentlicht am <?php the_date()?> (von: <?php the_author(); ?>)</small>
                    </div>

                    <div class="li-postlist-item-content">
                        <!-- Thumbnail -->
                        <?php if (has_post_thumbnail())
                        { 
                            $thumbnail_id = get_post_thumbnail_id( $post->ID );
                            $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true); 
                        
                            ?>
                            <div class="li-postlist-item-thumbnail">
                                <a href="<?php the_permalink() ?>">
                                    <img style="background-image: url('<?php the_post_thumbnail_url('articleimage') ?>')">
                                </a>
                            </div>
                        <?php } ?>
                            
                        <!-- Textvorschau -->
                        <?php 
                            add_filter('excerpt_length', 'home_excerpt_length'); 
                            the_excerpt(); 
                            remove_filter('excerpt_length', 'home_excerpt_length'); 
                        ?>
                    </div>
                </li>

            <?php endwhile; ?>
        </ul>

        <div class="navigation">
            <p>
                <?php posts_nav_link(); ?>
            </p>
        </div>

    </div>

<?php get_footer(); ?>
