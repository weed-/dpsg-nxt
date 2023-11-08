<?php 

    class Walker_Mobile_Primary_Menu extends Walker_Nav_Menu {
            // ORIGINAL: public function start_el(&$output, $data_object, $depth, $args) {
            public function start_el(&$output, $data_object, $depth = 0, $args = NULL, $current_object_id = 0) {

            $tmp_output = '';
            parent::start_el($tmp_output, $data_object, $depth, $args);

            if ($depth === 1 && in_array("menu-item-has-children", $data_object->classes)) {

                $theme_dir = get_stylesheet_directory_uri();

                $tmp_output .= "<span class=\"nav-mobile-ul-menu-has-children-marker\" onclick=\"toggleMobileSubmenu('menu-item-' + " . $data_object->ID . ",'url(" . $theme_dir . "/images/navarrow_collapse.png)', 'url(" . $theme_dir . "/images/navarrow_expand.png)')\"></span>";
            }
            $output .= $tmp_output;
        }
    };

?>