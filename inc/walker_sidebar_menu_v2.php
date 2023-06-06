<?php

    class Walker_Sidebar_Menu_V2 extends Walker_Page {
        public function start_el(&$output, $data_object, $depth, $args, $current_object_id) {

            $tmp_output = '';
            parent::start_el($tmp_output, $data_object, $depth, $args, $current_object_id);

            if ($depth === 0) {
                $tmp_output = str_replace('<a', '<a class="sidebar-title-level0" ', $tmp_output);
            }
            $output .= $tmp_output;
        }
    };

?>