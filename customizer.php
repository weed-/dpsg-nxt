<?php
    $wp_customizer_settings_default = array(
        'set_homepage_postcount' => '10',
        'set_color_mainbackgroundcolor' => '#0e84cd',
        'set_color_primary1' => '#0e84cd',
        'set_color_primary2' => '#0c6ba7',
        'set_color_buttonevent' => '#40aef2',
        'set_color_footerbackground' => '#775c41',
        'set_color_fontcolor_primary' => '#003056',
        'set_color_fontcolor_secondary' => '#4c4c4c'
    );

    function dpsg_customize_register( $wp_customize ) {
     
        // ------ Website Hintergrund ------
        $wp_customize->add_section('sec_background_image', array(
            'title'          => 'Hintergrundbild'
        ));
        // Background Image
        $wp_customize->add_setting( 'set_backgroundimage' );
        $wp_customize->add_control( 
            new WP_Customize_Image_Control(
                $wp_customize,'set_backgroundimage',array(
                    'label' => 'Website Hintergrund',
                    'section' => 'sec_background_image',
                    'settings' => 'set_backgroundimage',
                    'priority' => 1
                )
            )
        );

        // ------ Homepage ------
        $wp_customize->add_setting( 'set_homepage_postcount', array(
            // 'default' => $wp_customizer_settings_default['set_homepage_postcount'] // TODO testen und ersetzen
            'default' => '10'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Control(
                $wp_customize,'set_homepage_postcount',array(
                    'type' => 'text',
                    'label' => 'Anzahl letzter Beiträge',
                    'section' => 'static_front_page',
                    'settings' => 'set_homepage_postcount',
                )
            )
        );

        // TODO Anzahl Slider Posts
        // TODO Anzahl Slider Kategorie

        // ------ Header ------
        $wp_customize->add_section('sec_header', array(
            'title'          => 'Kopfzeile'
        ));

        // header image
        $wp_customize->add_setting( 'set_headerimage' );
        $wp_customize->add_control( 
            new WP_Customize_Image_Control(
                $wp_customize,'set_headerimage',array(
                    'label' => 'Kopfzeile Hintergrundbild',
                    'section' => 'sec_header',
                    'settings' => 'set_headerimage',
                )
            )
        );

        // header icon
        $wp_customize->add_setting( 'set_headericon' );
        $wp_customize->add_control( 
            new WP_Customize_Image_Control(
                $wp_customize,'set_headericon',array(
                    'label' => 'Kopfzeile Icon',
                    'section' => 'sec_header',
                    'settings' => 'set_headericon',
                )
            )
        );

        // ------ Footer ------        
        $wp_customize->add_section('sec_footer', array(
            'title'          => 'Fußzeile'
        ));

        // footer background image 
        $wp_customize->add_setting( 'set_footer_desktopbackground' );
        $wp_customize->add_control( 
            new WP_Customize_Image_Control(
                $wp_customize,'set_footer_desktopbackground',array(
                    'label' => 'Fußzeile Hintergrundbild (Desktop)',
                    'section' => 'sec_footer',
                    'settings' => 'set_footer_desktopbackground',
                )
            )
        );

        $wp_customize->add_setting( 'set_footer_text' );
        $wp_customize->add_control( 
            new WP_Customize_Control(
                $wp_customize,'set_footer_text',array(
                    'type' => 'textarea',
                    'label' => 'Fußzeilentext',
                    'section' => 'sec_footer',
                    'settings' => 'set_footer_text',
                )
            )
        );

        // ------ Farben ------
        // Schriftfarbe (Titel, Überschriften, ...)
        $wp_customize->add_setting( 'set_color_fontcolor_primary', array(
            'default' => '#003056'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control(
                $wp_customize,'set_color_fontcolor_primary',array(
                    'label' => 'Schriftfarbe (Titel, Überschriften, ...)',
                    'section' => 'colors',
                    'settings' => 'set_color_fontcolor_primary',
                    
                )
            )
        );

        // Schriftfarbe (Fließtext, ...)
        $wp_customize->add_setting( 'set_color_fontcolor_secondary', array(
            'default' => '#4c4c4c'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control(
                $wp_customize,'set_color_fontcolor_secondary',array(
                    'label' => 'Schriftfarbe (Fließtext, ...)',
                    'section' => 'colors',
                    'settings' => 'set_color_fontcolor_secondary',
                    
                )
            )
        );

        // Seitenhintergrund
        $wp_customize->add_setting( 'set_color_mainbackgroundcolor' , array(
            'default' => '#0e84cd',
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control(
                $wp_customize,'set_color_mainbackgroundcolor',array(
                    'label' => 'Seitenhintergrund',
                    'section' => 'colors',
                    'settings' => 'set_color_mainbackgroundcolor',
                )
            )
        );

        // Hintergrund Navigation
        $wp_customize->add_setting( 'set_color_primary1', array(
            'default' => '#0e84cd'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control(
                $wp_customize,'set_color_primary1',array(
                    'label' => 'Primärfarbe 1 (Buttons)',
                    'section' => 'colors',
                    'settings' => 'set_color_primary1',
                )
            )
        );

        // Randhintergrund Navigation
        $wp_customize->add_setting( 'set_color_primary2', array(
            'default' => '#0c6ba7'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control(
                $wp_customize,'set_color_primary2',array(
                    'label' => 'Primärfarbe 2 (Desktop Navigation Hintergrund Buttonzeile)',
                    'section' => 'colors',
                    'settings' => 'set_color_primary2',
                )
            )
        );

        // Button selected/hover/activated
        $wp_customize->add_setting( 'set_color_buttonevent', array(
            'default' => '#40aef2'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control(
                $wp_customize,'set_color_buttonevent',array(
                    'label' => 'Button Event (selected/hover/activated)',
                    'section' => 'colors',
                    'settings' => 'set_color_buttonevent',
                    
                )
            )
        );

        // Hintergrund Quicklinks
        $wp_customize->add_setting( 'set_color_quicklinks', array(
            'default' => '#d9d9d9'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control(
                $wp_customize,'set_color_quicklinks',array(
                    'label' => 'Hintergrund Quicklink Buttons',
                    'section' => 'colors',
                    'settings' => 'set_color_quicklinks',
                )
            )
        );

        // Leiste Quicklinks
        $wp_customize->add_setting( 'set_color_quicklinks2', array(
            'default' => '#bfbfbf'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control(
                $wp_customize,'set_color_quicklinks2',array(
                    'label' => 'Hintergrund Leiste Quicklink Buttons',
                    'section' => 'colors',
                    'settings' => 'set_color_quicklinks2',
                )
            )
        );

        // Footer background Farbe (mobile und bei keinem Hintergrundbild)
        $wp_customize->add_setting( 'set_color_footerbackground', array(
            'default' => '#775c41'
        ));
        $wp_customize->add_control( 
            new WP_Customize_Color_Control(
                $wp_customize,'set_color_footerbackground',array(
                    'label' => 'Footer background',
                    'section' => 'colors',
                    'settings' => 'set_color_footerbackground',
                )
            )
        );

        // TODO Farben für h1, ... 
        // TODO Farben für a in Text und Menüs
    }

    add_action( 'customize_register', 'dpsg_customize_register' );

?>