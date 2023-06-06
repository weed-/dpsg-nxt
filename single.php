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

        <h1 class="li-postlist-item-title">
            <?php the_title(); ?>
        </h1>
        <div class="li-postlist-item-subtitle">
            <small><?php the_date()?> (von: <?php the_author(); ?>)</small>
        </div>

        <p id="content-text">
            <?php the_content(); ?>
        </p>

        <?php comments_template(); ?>
    </div>

<?php get_footer(); ?>
