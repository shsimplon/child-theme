
<?php
    add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

    function my_theme_enqueue_styles() {
        wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
        wp_enqueue_style( 'child-style', 
             get_stylesheet_directory_uri() . '/style.css',
             array( 'parent-style' ),
             wp_get_theme()->get('Version')
        );
     }


    add_action(
        'customize_register', 'gridbox_child_add_stuff_to_customizer' );

function gridbox_child_add_stuff_to_customizer( $wp_customize ) {
  $wp_customize->add_section(
    'gridbox_child_custom_section',
    array(
      'title'       => 'Réglages Brioche et Canelle',
      'description' => 'Les options ajoutés via le thème gridbox-child',
    )
  );

        $wp_customize->add_setting(
            'gridbox_child_info_sponsor',
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_filter_nohtml_kses',
            )
        );

        $wp_customize->add_control(
            'gridbox_child_info_sponsor',
            array(
                'type'        => 'textarea',
                'section'     => 'gridbox_child_custom_section',
                'label'       => 'Info sponsor',
                'description' => 'Texte affiché en haut de toutes les pages.',
            )
        );

        $wp_customize->selective_refresh->add_partial(
            'gridbox_child_info_sponsor',
            array(
                'selector' => '.sponsor-info',
            )
        );
}


