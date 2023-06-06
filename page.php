<?php get_header(); ?>
<?php the_post(); ?>

    <div id="sidebar">
        <div id="sidebar-navigation-desktop">
            <?php
            if ( is_home() ) {
                dynamic_sidebar('body_sidebar'); 
            } else {
                custom_sidebar_menu(get_the_ID());
            }
            ?>
        </div>
    </div>

    <div id="page-content-container">

        <div class="breadcrumb breadcrumb-page">
            <?php breadcrumb(); ?>
        </div>

        <h1 class="page-h1">
            <?php the_title(); ?>
        </h1>

        <p id="content-text">
            <?php the_content(); ?>
        </p>

    </div>

<?php get_footer(); ?>
