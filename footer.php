                </div>
            </div>  <!-- background-container --->
        </div> <!--- body-container --->

        <div class="custom-hr-white"></div>

        <footer style="background-image: url(<?php echo get_theme_mod('set_footer_desktopbackground') ?>); background-color: <?php echo get_theme_mod_default('set_color_footerbackground') ?>;">
            <div id="footer-main-container">
                <div id="footer-content-container">
                    
                    <!-- Menü div -->
                    <div class="footer-menu-container-parent">
                        <!-- Quicklink div -->
                        <div class="footer-menu-container">
                            <p class="footer-menu-header">Quicklinks</p>
    
                            <?php
                                $menu_name = 'quicklink';
                                $locations = get_nav_menu_locations();
                                $menu = wp_get_nav_menu_object($locations[$menu_name]);
                                $menuitems = wp_get_nav_menu_items($menu->term_id, array('order' => 'DESC'));

                                foreach ($menuitems as $menuitem) 
                                { 
                                    if ($menuitem->menu_item_parent != 0)
                                        continue;

                                    ?>

                                    <div class="footer-menu-quicklink-itemcontainer-main">
                                        <a class="footer-menu-quicklink-itemlink" href="<?php echo $menuitem->url ?>">
                                            <div class="footer-menu-quicklink-itemcontainer">
                                                <?php echo $menuitem->title ?>
                                            </div>
                                        </a>
                                    </div> 
                                
                                    <?php
                                }

                                // echo "</ul>";
                            ?>
                        </div>

                        <?php 
                            print_footer_menu('primary_menu_part1');
                            print_footer_menu('primary_menu_part2');
                            print_footer_menu('primary_menu_part3');
                        ?>
                </div>

                <div>
                    <hr class="custom-hr-white-2">

                    <div>
                        <p class="footer-custom-text">
                            <?php echo nl2br(get_theme_mod('set_footer_text')) ?>
                        </p>
                    </div>

                    <div class="footer-nav-container">
                        <!-- Einfache Darstellung aktivieren/deaktivieren -->
                        <a onclick="easymodeButtonHandler()" class="link-easymode link-easymode-footer">Einfache Darstellung aktivieren</a>
                        
                        <ul id="footer-nav">

                            <?php
                                $menu_name = 'footer';
                                $locations = get_nav_menu_locations();
                                $menu = wp_get_nav_menu_object($locations[$menu_name]);
                                $menuitems = wp_get_nav_menu_items($menu->term_id, array('order' => 'DESC'));

                                for ($i = 0; $i < sizeof($menuitems); $i++)
                                {
                                    $menuitem = $menuitems[$i];

                                    ?>

                                    <li>
                                        <a href=" <?php echo $menuitem->url ?> ">
                                            <div>
                                                <?php echo $menuitem->title ?> 
                                            </div>
                                        </a>
                                    </li>

                                    <?php
                                    if ($i+1 < sizeof($menuitems)) { ?>
                                    
                                        <span class="footer-nav-delimiter">|</span>

                                    <?php }
                                }
                            ?>

                        </ul>
                    </div>
                    
                </div>
            </div>
        </footer>

        <?php wp_footer(); ?>

	</body>
</html>