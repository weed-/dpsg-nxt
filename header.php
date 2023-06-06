<!DOCTYPE html>
<html lang="de">
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>
            <?php
                if (is_home()) 
                {
                    bloginfo('name');
                    wp_title('&raquo;');
                } 
                else 
                {
                    wp_title('');
                    echo " &#8211; ";
                    bloginfo('name');
                }
            ?>
        </title>
        <meta name="robots" content="index, follow" />
		<meta name="author" content="Bjoern, DPSG Paderborn">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.ico">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri(); ?>/images/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon-16x16.png">
        <link rel="mask-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
        <?php wp_head(); ?>
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/easymode.js" defer></script>
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/menu.js" defer></script>
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>?2" />
        <style>
            #page-content-container h1, #page-content-container h2, #page-content-container h3, #page-content-container h4, #page-content-container h5, #page-content-container h6, #page-content-container #page-content-container h1 a, #page-content-container h2 a, #page-content-container h3 a, #page-content-container h4 a, #page-content-container h5 a, #page-content-container h6 a, #nav-desktop-ul-menu2>li>ul>li>a, .sidebar-title-level0, .sidebar-default-main-menu > li > a, div.events a {
                color: <?php echo get_theme_mod_default('set_color_fontcolor_primary'); ?>;
            }
        </style>
	</head>

	<body <?php body_class(); ?> style="background-color: <?php echo get_theme_mod_default('set_color_mainbackgroundcolor') ?>;" onload="checkEasymode()"> 
    
    <div id="body-container">
        
        <header>
            <div id="actions-desktop">
                <!-- Suchfeld (Desktop) -->
                <div class="suche-desktop">
                    <form method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
                        <label class="screen-reader-text" for="s">Suchen nach:</label>
                        <input class="textfeld" type="text" onfocus="this.value=''" value="Suchen ..." name="s" id="search-btn" />
                        <input class="knopf" type="submit" id="searchsubmit" value="&raquo;" />
                    </form>

                    <!-- Einfache Darstellung aktivieren/deaktivieren -->
                    <a onclick="easymodeButtonHandler()" class="link-easymode link-easymode-header">Einfache Darstellung aktivieren</a>
                </div>
            </div>

            <a id="header-link" href="/">
                <!-- Header Titel -->
                <div id="img-header-container" style="background-image: url(<?php echo get_theme_mod('set_headerimage') ?>)">

                    <?php if (get_theme_mod_default('set_headericon') != NULL) {?>
                        <img id="img-header-icon" src="<?php echo get_theme_mod_default('set_headericon') ?>" alt="Header Icon">
                        <p id="header-title" class="header-title-with-header-icon" style="color: <?php echo get_theme_mod_default('set_color_fontcolor_primary') ?>;">
                            <?php echo bloginfo('title'); ?>
                        </p>
                    <?php } else { ?>
                        <p id="header-title" class="header-title-without-header-icon" style="color: <?php echo get_theme_mod_default('set_color_fontcolor_primary') ?>;">
                            <?php echo bloginfo('title'); ?>
                        </p>
                    <?php } ?>
                </div>
            </a>

            <div class="custom-hr-white"></div>

            <!-- Navigation -->
            <?php 
            if (get_customcss(get_the_ID(), 'custom-navigationcontainer-class') != null) { ?>
                    <div class="header-nav-container" <?php echo get_customcss(get_the_ID(), 'custom-navigationcontainer-class'); ?>">
                <?php 
            } else { 
                ?>
                    <div class="header-nav-container" style="background-color: <?php echo get_theme_mod_default('set_color_primary2') ?>">
                <?php 
            } ?>

            <!-- Desktop -->
                <div id="header-navigation-desktop">
                    <!-- quicklinks -->
                    <div id="quicklink-container-1" style="background-color: <?php echo get_theme_mod_default('set_color_quicklinks2') ?>">
                        <div id="quicklink-container-2" style="background-color: <?php echo get_theme_mod_default('set_color_quicklinks') ?>">
                            <ul id="nav-desktop-ul-menu1">

                                <?php
                                    $menu_name = 'quicklink';
                                    $locations = get_nav_menu_locations();
                                    $menu = wp_get_nav_menu_object($locations[$menu_name]);
                                    $menuitems = wp_get_nav_menu_items($menu->term_id, array('order' => 'DESC'));

                                    foreach ($menuitems as $menuitem) 
                                    { ?>
                                        <li class="nav-desktop-li nav-desktop-li-menu1">
                                            <a href=" <?php echo $menuitem->url ?> ">
                                                <div class="nav-desktop-button-menu1">
                                                    <?php echo $menuitem->title ?> 
                                                </div>
                                            </a>
                                        </li>
                                    <?php } 
                                ?>
                            </ul>
                        </div>
                    </div>

                    <!-- Hauptmenü -->
                    <!-- <div id="primary-container-1" style="background-color: <?php echo get_theme_mod_default('set_color_primary2') ?>"> -->
                    <?php 
                    if (get_customcss(get_the_ID(), 'custom-navigationcontainer-class') != null) { ?>
                            <div id="primary-container-1" <?php echo get_customcss(get_the_ID(), 'custom-navigationcontainer-class'); ?>">
                        <?php 
                    } else { 
                        ?>
                            <div id="primary-container-1" style="background-color: <?php echo get_theme_mod_default('set_color_primary2') ?>">
                        <?php 
                    } ?>

                        <div id="primary-container-2">
                            <ul id="nav-desktop-ul-menu2">
                            <?php
                                if (has_nav_menu('primary_menu_part1')) {
                                    $menuParams = array(
                                        'theme_location'  => 'primary_menu_part1',
                                        'menu'            => 'primary_menu_part1',
                                        'container'       => false,
                                        'menu_class'      => 'menu',
                                        'items_wrap'      => '%3$s',
                                        'depth'           => 3,
                                        'partial_sub_menu' => false,
                                    );

                                    wp_nav_menu($menuParams);
                                }
                                
                                if (has_nav_menu('primary_menu_part2')) {
                                    $menuParams = array(
                                        'theme_location'  => 'primary_menu_part2',
                                        'menu'            => 'primary_menu_part2',
                                        'container'       => false,
                                        'menu_class'      => 'menu',
                                        'items_wrap'      => '%3$s',
                                        'depth'           => 3,
                                        'partial_sub_menu' => false,
                                    );

                                    wp_nav_menu($menuParams);
                                }
                                
                                if (has_nav_menu('primary_menu_part3')) {
                                    $menuParams = array(
                                        'theme_location'  => 'primary_menu_part3',
                                        'menu'            => 'primary_menu_part3',
                                        'container'       => false,
                                        'menu_class'      => 'menu',
                                        'items_wrap'      => '%3$s',
                                        'depth'           => 3,
                                        'partial_sub_menu' => false,
                                    );

                                    wp_nav_menu($menuParams);
                                }
                            ?>
                            </ul>
                        </div>

                    </div>
                </div>

                <!-- Button Mobile Navigation -->
                <div id="header-navigation-mobile">
                    <div class="nav-menu-btn" onclick="toggleNavMenu(this)">
                        <div class="nav-menu-btn-bar1"></div>
                        <div class="nav-menu-btn-bar2"></div>
                        <div class="nav-menu-btn-bar3"></div>
                    </div>

                    <script>
                        var menuToggle = false;

                        function toggleNavMenu(x) {
                            x.classList.toggle("change");

                            e = document.getElementById("header-navigation-mobile-menuitems");
                            if (menuToggle == false) {
                                e.style.display = "flex";
                                e.style.flexDirection = "column";
                                menuToggle = true;
                            } else {
                                e.style.display = "none";
                                menuToggle = false;
                            }
                        }
                    </script>
                </div>
            </div>

            <!-- Mobile Navigation -->
            <?php 
            if (get_customcss(get_the_ID(), 'custom-navigationcontainer-class') != null) { 
                ?>
                    <div id="header-navigation-mobile-menuitems" <?php echo get_customcss(get_the_ID(), 'custom-navigationcontainer-class'); ?>">
                <?php 
            } else { 
                ?>
                    <div id="header-navigation-mobile-menuitems" style="background-color: <?php echo get_theme_mod_default('set_color_primary2') ?>">
                <?php 
            } ?>
            
                <!-- Suchfeld -->
                <div class="suche-mobile">
                    <form method="get" id="searchform-mobile" action="<?php echo home_url( '/' ); ?>">
                        <label class="screen-reader-text" for="s">Suchen nach:</label>
                        <input class="textfeld" type="text" onfocus="this.value=''" value="Suchen ..." name="s" id="search-btn-mobile"/>
                        <input class="knopf" type="submit" id="searchsubmit-mobile" value="&raquo;">
                    </form>
                </div>

                <!-- Hauptmenü -->
                <div class="menu">
                    <ul id="nav-mobile-ul-menu">
                        <?php
                            if (has_nav_menu('primary_menu_part1')) {
                                $defaults = array(
                                    'theme_location'  => 'primary_menu_part1',
                                    'menu'            => 'primary_menu_part1',
                                    'container'       => false,
                                    'menu_class'      => 'menu',
                                    'items_wrap'      => '%3$s',
                                    'depth'           => 3,
                                    'partial_sub_menu' => false,
                                    'walker'          => new Walker_Mobile_Primary_Menu()
                                );

                                wp_nav_menu($defaults);
                            }
                            
                            if (has_nav_menu('primary_menu_part2')) {
                                $defaults = array(
                                    'theme_location'  => 'primary_menu_part2',
                                    'menu'            => 'primary_menu_part2',
                                    'container'       => false,
                                    'menu_class'      => 'menu',
                                    'items_wrap'      => '%3$s',
                                    'depth'           => 3,
                                    'partial_sub_menu' => false,
                                    'walker'          => new Walker_Mobile_Primary_Menu()
                                );

                                wp_nav_menu($defaults);
                            }
                            
                            if (has_nav_menu('primary_menu_part3')) {
                                $defaults = array(
                                    'theme_location'  => 'primary_menu_part3',
                                    'menu'            => 'primary_menu_part3',
                                    'container'       => false,
                                    'menu_class'      => 'menu',
                                    'items_wrap'      => '%3$s',
                                    'depth'           => 3,
                                    'partial_sub_menu' => false,
                                    'walker'          => new Walker_Mobile_Primary_Menu()
                                );

                                wp_nav_menu($defaults);
                            }
                        ?>
                    </ul>
                </div>

                <!-- Quicklinks -->
                <div class="nav-mobile-menu1">
                    <ul>
                        <?php
                            $menu_name = 'quicklink';
                            $locations = get_nav_menu_locations();
                            $menu = wp_get_nav_menu_object($locations[$menu_name]);
                            $menuitems = wp_get_nav_menu_items($menu->term_id, array('order' => 'DESC'));

                            foreach ($menuitems as $menuitem) 
                            { ?>
                                <li class="nav-mobile-li-menu1">
                                    <a href=" <?php echo $menuitem->url ?> ">
                                        <?php echo $menuitem->title ?> 
                                    </a>
                                </li>
                            <?php } 
                        ?>
                    </ul>
                </div>

            </div>

            <div class="custom-hr-white"></div>

            
        </header>


            <?php 
            if (get_customcss(get_the_ID(), 'custom-backgroundimage-class') != null) { ?>
                <div id="background-container" <?php echo get_customcss(get_the_ID(), 'custom-backgroundimage-class'); ?>>
                <?php 
            } else { 
                ?>
                    <div id="background-container" style="background-image: url(<?php echo get_theme_mod('set_backgroundimage'); ?>)">
                <?php 
            } ?>

            <!-- main Content container -->
            <div id="main-content-container">

