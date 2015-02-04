<?php
/**
* Registers the sidebar(s).
*/
function careta_widgets_init() 
{
    register_sidebar(
    	array
        (
    		'name'			=>	'Footer',
    		'id'			=>	'sidebar-footer',
    		'before_widget'	=>	'<div class="widget">',
    		'after_widget'	=>	'</div>'
    	)
    );
    register_sidebar(
    	array
        (
    		'name'			=>	'Sidebar',
    		'id'			=>	'sidebar',
    		'before_widget'	=>	'<div class="sidebar">',
    		'after_widget'	=>	'</div>'
    	)
    );
}
add_action( 'widgets_init', 'careta_widgets_init' );
register_nav_menu('primary', 'Primary Menu');

function careta_nav_menu_args($args = '')
{
	$args['container'] = false;
	return $args;
}
add_filter('wp_nav_menu_args', 'careta_nav_menu_args');


/**
* Configure general theme settings and register styles & scripts.
*/
function careta_warnings($text)
{
    $replace = array('[alert]' => '<div class="alert">', '[/alert]' => '</div>', '[error]' => '<div class="error">', '[/error]' => '</div>', '[info]' => '<div class="info">', '[/info]' => '</div>');
    $text = str_replace(array_keys($replace), $replace, $text);
    return $text;
}
add_filter('the_content', 'careta_warnings');

function careta_index_exists($var,$index)
{
  return(isset($var[$index])?$var[$index]:null);
}

function careta_startup_script()
{
    if(!isset($content_width)) $content_width = 1140;
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'careta_startup_script');

function careta_load_scripts()
{
	wp_register_style('careta-magnific-popup-css',get_template_directory_uri() . '/css/magnific-popup.css');
	wp_enqueue_style('careta-magnific-popup-css');

	wp_register_style('careta-custom-css-fonts','//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,700,300');
	wp_enqueue_style('careta-custom-css-fonts');

	wp_register_script('careta-js-init',get_template_directory_uri() . '/js/careta.js',array('jquery'),null,true);
	wp_enqueue_script('careta-js-init');

	wp_register_script('careta-js-magnific',get_template_directory_uri() . '/js/jquery.magnific-popup.min.js',array('jquery'),null,true);
	wp_enqueue_script('careta-js-magnific');
	
	wp_register_script('careta-js-carousel',get_template_directory_uri() . '/js/jcarousellite_1.0.1.min.js',array('jquery'),null,true);
	wp_enqueue_script('careta-js-carousel');
	
	wp_enqueue_script('masonry');
	
	if(is_singular()) wp_enqueue_script('comment-reply', false);
}
add_action('wp_enqueue_scripts', 'careta_load_scripts');

function careta_wp_title($title, $sep)
{
	return $title . get_bloginfo('name');
}
add_filter('wp_title', 'careta_wp_title', 10, 2);


function careta_customize_register( $wp_customize )
{
    class Careta_Customize_Textarea_Control extends WP_Customize_Control 
    {
    	public $type = 'textarea';
     
    	public function render_content() {
    		?>
    		<label>
    		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
    		<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
    		</label>
    		<?php
    	}
    }
    
    
	$wp_customize->remove_control('blogdescription');
	//********************************************************************************************************************
	//********************************************************************************************************************
	// header options section
	//********************************************************************************************************************
	//********************************************************************************************************************
	$wp_customize->add_section(
		'careta_header_options',
		array(
			'title'		=> __('Header Options', 'default'),
			'priority'	=> 30,
		)
	);

	// header display text
	$wp_customize->add_setting(
		'careta_header_showname',
		array(
			'default'	=> true,
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);
	 
	$wp_customize->add_control(
		'careta_header_showname',
		array(
			'label' => __('Display Blog Name', 'default'),
			'section' => 'careta_header_options',
			'settings' => 'careta_header_showname',
			'type' => 'checkbox',
			'priority'  => 30,  
		)
	);
	
	// header display text
	$wp_customize->add_setting(
		'careta_header_showmenu',
		array(
			'default'	=> true,
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);
	 
	$wp_customize->add_control(
		'careta_header_showmenu',
		array(
			'label' => __('Display Menu', 'default'),
			'section' => 'careta_header_options',
			'settings' => 'careta_header_showmenu',
			'type' => 'checkbox',
			'priority'  => 31,  
		)
	);
	
	
	// header image align
	$wp_customize->add_setting(
		'careta_headeralign_text',
		array(
			'default'	=> 'left',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	// select control
	$wp_customize->add_control('careta_headeralign_text', array(
		'label' => __('Alignment','default'),
		'section' => 'careta_header_options',
		'type' => 'select',
		'priority'  => 32,  
		'choices' => array(
			'left' => 'Left',
			'right' => 'Right',
			'center' => 'Center',
		),
	) );	
	

	// header background color
	$wp_customize->add_setting(
		'careta_headerbg_color',
		array(
			'default'	=> '#262626',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_headerbg_color',
			array(
				'label'		=> __('Background Color', 'default'),
				'section'	=> 'careta_header_options',
				'settings'	=> 'careta_headerbg_color',
				'priority'	=> 10,
			)
		)
	);

	// header text color
	$wp_customize->add_setting(
		'careta_header_color',
		array(
			'default'	=> '#ffffff',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_header_color',
			array(
				'label'		=> __('Text Color', 'default'),
				'section'	=> 'careta_header_options',
				'settings'	=> 'careta_header_color',
				'priority'	=> 11,
			)
		)
	);
	
	// header hover text color
	$wp_customize->add_setting(
		'careta_headerhover_color',
		array(
			'default'	=> '#DD3333',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_headerhover_color',
			array(
				'label'		=> __('Links', 'default'),
				'section'	=> 'careta_header_options',
				'settings'	=> 'careta_headerhover_color',
				'priority'	=> 12,
			)
		)
	);

	// header image text
	$wp_customize->add_setting(
		'careta_header_image',
		array(
			'default'	=> '',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);
	 
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'careta_header_image', array(
		'label' => __( 'Image', 'default' ),
		'section' => 'careta_header_options',
		'settings' => 'careta_header_image',
	) ) );
	

 	
	
	//********************************************************************************************************************
	//********************************************************************************************************************
	// footer options section
	//********************************************************************************************************************
	//********************************************************************************************************************
	$wp_customize->add_section(
		'careta_footer_options',
		array(
			'title'		=> __('Footer Options', 'default'),
			'priority'	=> 31,
		)
	);
	
	// footer bg color
	$wp_customize->add_setting(
		'careta_footerbg_color',
		array(
			'default'	=> '#b7b7b7',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_footerbg_color',
			array(
				'label'		=> __('Background Color', 'default'),
				'section'	=> 'careta_footer_options',
				'settings'	=> 'careta_footerbg_color',
			)
		)
	);

	// footer text color
	$wp_customize->add_setting(
		'careta_footer_color',
		array(
			'default'	=> '#636363',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_footer_color',
			array(
				'label'		=> __('Text Color', 'default'),
				'section'	=> 'careta_footer_options',
				'settings'	=> 'careta_footer_color',
			)
		)
	);
	
	// footer link color
	$wp_customize->add_setting(
		'careta_footerlink_color',
		array(
			'default'	=> '#383838',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_footerlink_color',
			array(
				'label'		=> __('Links', 'default'),
				'section'	=> 'careta_footer_options',
				'settings'	=> 'careta_footerlink_color',
			)
		)
	);
	
	// footer link hover color
	$wp_customize->add_setting(
		'careta_footerlinkhover_color',
		array(
			'default'	=> '#FF0000',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_footerlinkhover_color',
			array(
				'label'		=> __('Links', 'default') . ' (Hover)',
				'section'	=> 'careta_footer_options',
				'settings'	=> 'careta_footerlinkhover_color',
			)
		)
	);
	
	//********************************************************************************************************************
	//********************************************************************************************************************
	// theme info section
	//********************************************************************************************************************
	//********************************************************************************************************************
	$wp_customize->add_section(
		'careta_themeinfo_options',
		array(
			'title'		=> __('Theme Info Section', 'default'),
			'priority'	=> 32,
		)
	);
	
	// theme info background color
	$wp_customize->add_setting(
		'careta_themeinfobg_color',
		array(
			'default'	=> '#d8d8d8',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_themeinfobg_color',
			array(
				'label'		=> __('Background Color', 'default'),
				'section'	=> 'careta_themeinfo_options',
				'settings'	=> 'careta_themeinfobg_color',
			)
		)
	);	

		// theme info text color
	$wp_customize->add_setting(
		'careta_themeinfo_color',
		array(
			'default'	=> '#4f4f4f',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
			
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_themeinfo_color',
			array(
				'label'		=> __('Text Color', 'default'),
				'section'	=> 'careta_themeinfo_options',
				'settings'	=> 'careta_themeinfo_color',
			)
		)
	);

	// theme info link color
	$wp_customize->add_setting(
		'careta_themeinfolink_color',
		array(
			'default'	=> '#DD3333',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_themeinfolink_color',
			array(
				'label'		=> __('Links', 'default'),
				'section'	=> 'careta_themeinfo_options',
				'settings'	=> 'careta_themeinfolink_color',
			)
		)
	);

	// theme info text
	$wp_customize->add_setting(
		'careta_themeinfo_text', 
		array(
			'default'        => 'Theme Careta by <a href="http://mcunha98.wordpress.com">MCunha98</a>',
            'section'	=> 'careta_themeinfo_options',
			'sanitize_callback' => 'careta_sanitize_string',
		) 
	);
	 
	$wp_customize->add_control( new Careta_Customize_Textarea_Control( $wp_customize, 'careta_themeinfo_text', array(
		'label'   => __('Text','default'),
		'section' => 'careta_themeinfo_options',
		'settings'   => 'careta_themeinfo_text',
		'priority'	=>	99,
	) ) );	
	
	
	// header image align
	$wp_customize->add_setting(
		'careta_themeinfoalign_text',
		array(
			'default'	=> 'left',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	// select control
	$wp_customize->add_control('careta_themeinfoalign_text', array(
		'label' => __('Alignment','default'),
		'section' => 'careta_themeinfo_options',
		'type' => 'select',
		'choices' => array(
			'left' => 'Left',
			'right' => 'Right',
			'center' => 'Center',
		),
	) );	
	
	

	//********************************************************************************************************************
	//********************************************************************************************************************
	// page options section
	//********************************************************************************************************************
	//********************************************************************************************************************
	$wp_customize->add_section(
		'careta_page_options',
		array(
			'title'		=> __('Page Options', 'default'),
			'priority'	=> 40,
		)
	);
	
	// background color
	$wp_customize->add_setting(
		'careta_background_color',
		array(
			'default'	=> '#E9E9E9',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_background_color',
			array(
				'label'		=> __('Background Color', 'default'),
				'section'	=> 'careta_page_options',
				'settings'	=> 'careta_background_color',
			)
		)
	);

	// wrap color
	$wp_customize->add_setting(
		'careta_wrap_color',
		array(
			'default'	=> '#F3F3F3',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_wrap_color',
			array(
				'label'		=> __('Background Color', 'default') . ' (Container)',
				'section'	=> 'careta_page_options',
				'settings'	=> 'careta_wrap_color',
			)
		)
	);
	

	// background image
	$wp_customize->add_setting(
		'careta_background_image',
		array(
			'default'	=> '',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);
	 
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'careta_background_image', array(
		'label' => __( 'Background Image', 'default' ),
		'section' => 'careta_page_options',
		'settings' => 'careta_background_image',
	) ) );


	// category styles
	$wp_customize->add_setting(
		'careta_background_style',
		array(
			'default'	=> 'tile',
			'transport'	=> 'refresh',
            'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	// select control
	$wp_customize->add_control('careta_background_style', array(
		'label' => __('Style','default'),
		'section' => 'careta_page_options',
		'type' => 'select',
		'priority'  => 101,  
		'choices' => array(
			'tile' => 'Tile',
			'cover' => 'Cover'
		),
	) );	

	
	
	//********************************************************************************************************************
	//********************************************************************************************************************
	// category options section
	//********************************************************************************************************************
	//********************************************************************************************************************
	$wp_customize->add_section(
		'careta_category_options',
		array(
			'title'		=> __('Category Options', 'default'),
			'priority'	=> 41,
		)
	);

	
	// display excerpts
	$wp_customize->add_setting(
		'careta_display_excerpts',
		array(
			'default'	=> true,
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);
	 
	$wp_customize->add_control(
		'careta_display_excerpts',
		array(
			'label' => __('Display Excerpts', 'default'),
			'section' => 'careta_category_options',
			'settings' => 'careta_display_excerpts',
			'type' => 'checkbox',
			'priority'  => 90,  
		)
	);

	// display more link
	$wp_customize->add_setting(
		'careta_display_more',
		array(
			'default'	=> true,
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);
	 
	$wp_customize->add_control(
		'careta_display_more',
		array(
			'label' => __('Display More Link', 'default'),
			'section' => 'careta_category_options',
			'settings' => 'careta_display_more',
			'type' => 'checkbox',
			'priority'  => 91,  
		)
	);
	
	// display category tags
	$wp_customize->add_setting(
		'careta_display_category_tags',
		array(
			'default'	=> true,
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);
	 
	$wp_customize->add_control(
		'careta_display_category_tags',
		array(
			'label' => __('Display Tags', 'default'),
			'section' => 'careta_category_options',
			'settings' => 'careta_display_category_tags',
			'type' => 'checkbox',
			'priority'  => 92,  
		)
	);
	
	
	// display category tags
	$wp_customize->add_setting(
		'careta_display_category_author',
		array(
			'default'	=> true,
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);
	 
	$wp_customize->add_control(
		'careta_display_category_author',
		array(
			'label' => __('Display Author Picture', 'default'),
			'section' => 'careta_category_options',
			'settings' => 'careta_display_category_author',
			'type' => 'checkbox',
			'priority'  => 92,  
		)
	);

	// post box color
	$wp_customize->add_setting(
		'careta_postbox_color',
		array(
			'default'	=> '#ffffff',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_postbox_color',
			array(
				'label'		=> __('Background Color', 'default'),
				'section'	=> 'careta_category_options',
				'settings'	=> 'careta_postbox_color',
			)
		)
	);
	
	
	
	// text color
	$wp_customize->add_setting(
		'careta_text_color',
		array(
			'default'	=> '#333333',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_text_color',
			array(
				'label'		=> __('Text Color', 'default'),
				'section'	=> 'careta_category_options',
				'settings'	=> 'careta_text_color',
			)
		)
	);
	
	// text hover color
	$wp_customize->add_setting(
		'careta_text_hover_color',
		array(
			'default'	=> '#ffffff',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_text_hover_color',
			array(
				'label'		=> __('Text Color', 'default') . ' (Hover)',
				'section'	=> 'careta_category_options',
				'settings'	=> 'careta_text_hover_color',
			)
		)
	);
	
	// highlight color
	$wp_customize->add_setting(
		'careta_highlight_color',
		array(
			'default'	=> '#DD3333',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_highlight_color',
			array(
				'label'		=> __('Background Color', 'default') . ' (Hover)',
				'section'	=> 'careta_category_options',
				'settings'	=> 'careta_highlight_color',
			)
		)
	);
	
	// details box color
	$wp_customize->add_setting(
		'careta_postdetails_color',
		array(
			'default'	=> '#e0e0e0',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_postdetails_color',
			array(
				'label'		=> __('Text Color', 'default') . ' (Details)',
				'section'	=> 'careta_category_options',
				'settings'	=> 'careta_postdetails_color',
			)
		)
	);
	
	

	// category styles
	$wp_customize->add_setting(
		'careta_category_style',
		array(
			'default'	=> 'variable',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	// select control
	$wp_customize->add_control('careta_category_style', array(
		'label' => __('Style','default'),
		'section' => 'careta_category_options',
		'type' => 'select',
		'priority'  => 101,  
		'choices' => array(
			'variable' => 'Variable Size',
			'fixed' => 'Fixed Size'
		),
	) );	

	
	// excepert size
	$wp_customize->add_setting(
		'careta_category_excerpt_size',
		array(
			'default'	=> 'small',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	// select control
	$wp_customize->add_control('careta_category_excerpt_size', array(
		'label' => __('Exceprt Length','default'),
		'section' => 'careta_category_options',
		'type' => 'select',
		'priority'  => 101,  
		'choices' => array(
			'small' => 'Small',
			'medium' => 'Medium',
            'large' => 'Large'
		),
	) );	
	
	//********************************************************************************************************************
	//********************************************************************************************************************
	// post options section
	//********************************************************************************************************************
	//********************************************************************************************************************
	$wp_customize->add_section(
		'careta_post_options',
		array(
			'title'		=> __('Post Options', 'default'),
			'priority'	=> 42,
		)
	);
	
	// display tags
	$wp_customize->add_setting(
		'careta_display_tags',
		array(
			'default'	=> true,
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		'careta_display_tags',
		array(
			'label' => __('Display Tags', 'default'),
			'section' => 'careta_post_options',
			'settings' => 'careta_display_tags',
			'type' => 'checkbox',
            'priority'	=> 30,
		)
	);
	
	
	// display category
	$wp_customize->add_setting(
		'careta_display_category',
		array(
			'default'	=> true,
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		'careta_display_category',
		array(
			'label' => __('Display Category', 'default'),
			'section' => 'careta_post_options',
			'settings' => 'careta_display_category',
			'type' => 'checkbox',
            'priority'	=> 32,
		)
	);
	
	// display date
	$wp_customize->add_setting(
		'careta_display_date',
		array(
			'default'	=> true,
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		'careta_display_date',
		array(
			'label' => __('Display Date', 'default'),
			'section' => 'careta_post_options',
			'settings' => 'careta_display_date',
			'type' => 'checkbox',
            'priority'	=> 34,
		)
	);
	

	// display sidebar
	$wp_customize->add_setting(
		'careta_display_sidebar',
		array(
			'default'	=> false,
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		'careta_display_sidebar',
		array(
			'label' => __('Display Sidebar', 'default'),
			'section' => 'careta_post_options',
			'settings' => 'careta_display_sidebar',
			'type' => 'checkbox',
            'priority'	=> 36,
		)
	);
	
	// link color
	$wp_customize->add_setting(
		'careta_postlink_color',
		array(
			'default'	=> '#DD3333',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_postlink_color',
			array(
				'label'		=> __('Links', 'default'),
				'section'	=> 'careta_post_options',
				'settings'	=> 'careta_postlink_color',
				'priority'  => 1,  
			)
		)
	);

	// text color
	$wp_customize->add_setting(
		'careta_posttext_color',
		array(
			'default'	=> '#333333',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_posttext_color',
			array(
				'label'		=> __('Text', 'default'),
				'section'	=> 'careta_post_options',
				'settings'	=> 'careta_posttext_color',
				'priority'  => 2,  
			)
		)
	);

	
	//********************************************************************************************************************
	//********************************************************************************************************************
	// author options section
	//********************************************************************************************************************
	//********************************************************************************************************************
	$wp_customize->add_section(
		'careta_author_options',
		array(
			'title'		=> __('Author Options', 'default'),
			'priority'	=> 46,
		)
	);
	
	// display author
	$wp_customize->add_setting(
		'careta_display_author',
		array(
			'default'	=> true,
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		'careta_display_author',
		array(
			'label' => __('Display Author', 'default'),
			'section' => 'careta_author_options',
			'settings' => 'careta_display_author',
			'type' => 'checkbox',
		)
	);
	
	
	// text  color
	$wp_customize->add_setting(
		'careta_author_text_color',
		array(
			'default'	=> '#7c7c7c',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_author_text_color',
			array(
				'label'		=> __('Text Color', 'default'),
				'section'	=> 'careta_author_options',
				'settings'	=> 'careta_author_text_color',
			)
		)
	);
	
	// back  color
	$wp_customize->add_setting(
		'careta_author_back_color',
		array(
			'default'	=> '#E9E9E9',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_author_back_color',
			array(
				'label'		=> __('Background Color', 'default'),
				'section'	=> 'careta_author_options',
				'settings'	=> 'careta_author_back_color',
			)
		)
	);
	
	
	//********************************************************************************************************************
	//********************************************************************************************************************
	// pagination options section
	//********************************************************************************************************************
	//********************************************************************************************************************
	$wp_customize->add_section(
		'careta_pagination_options',
		array(
			'title'		=> __('Pagination Options', 'default'),
			'priority'	=> 44,
		)
	);
	
	// text  color
	$wp_customize->add_setting(
		'careta_pagination_color',
		array(
			'default'	=> '#cecece',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_pagination_color',
			array(
				'label'		=> __('Text Color', 'default'),
				'section'	=> 'careta_pagination_options',
				'settings'	=> 'careta_pagination_color',
			)
		)
	);
	
	// text background color
	$wp_customize->add_setting(
		'careta_paginationbg_color',
		array(
			'default'	=> '#4F4F4F',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_paginationbg_color',
			array(
				'label'		=> __('Background Color', 'default'),
				'section'	=> 'careta_pagination_options',
				'settings'	=> 'careta_paginationbg_color',
			)
		)
	);

	// text background color
	$wp_customize->add_setting(
		'careta_paginationhover_color',
		array(
			'default'	=> '#ffffff',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_paginationhover_color',
			array(
				'label'		=> __('Text Color', 'default') . ' (Hover)',
				'section'	=> 'careta_pagination_options',
				'settings'	=> 'careta_paginationhover_color',
			)
		)
	);
	

	// text background color
	$wp_customize->add_setting(
		'careta_paginationbghover_color',
		array(
			'default'	=> '#DD3333',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_paginationbghover_color',
			array(
				'label'		=> __('Background Color', 'default') . ' (Selected)',
				'section'	=> 'careta_pagination_options',
				'settings'	=> 'careta_paginationbghover_color',
			)
		)
	);
	
	
	//********************************************************************************************************************
	//********************************************************************************************************************
	// forms section
	//********************************************************************************************************************
	//********************************************************************************************************************
	$wp_customize->add_section(
		'careta_form_options',
		array(
			'title'		=> __('Form Options', 'default'),
			'priority'	=> 45,
		)
	);
	
	// text  color
	$wp_customize->add_setting(
		'careta_input_color',
		array(
			'default'	=> '#494949',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_input_color',
			array(
				'label'		=> __('Text Color', 'default'),
				'section'	=> 'careta_form_options',
				'settings'	=> 'careta_input_color',
			)
		)
	);
	// background color
	$wp_customize->add_setting(
		'careta_inputbg_color',
		array(
			'default'	=> '#cecece',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_inputbg_color',
			array(
				'label'		=> __('Background Color', 'default'),
				'section'	=> 'careta_form_options',
				'settings'	=> 'careta_inputbg_color',
			)
		)
	);

	// border color
	$wp_customize->add_setting(
		'careta_inputborder_color',
		array(
			'default'	=> 'darkgrey',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_inputborder_color',
			array(
				'label'		=> __('Border', 'default'),
				'section'	=> 'careta_form_options',
				'settings'	=> 'careta_inputborder_color',
			)
		)
	);

	// text background color
	$wp_customize->add_setting(
		'careta_inputfocus_color',
		array(
			'default'	=> '#ffffff',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_inputfocus_color',
			array(
				'label'		=> __('Text Color', 'default') . ' (Hover)',
				'section'	=> 'careta_form_options',
				'settings'	=> 'careta_inputfocus_color',
			)
		)
	);
	

	// text background color
	$wp_customize->add_setting(
		'careta_inputfocusbg_color',
		array(
			'default'	=> '#2b2b2b',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_inputfocusbg_color',
			array(
				'label'		=> __('Background Color', 'default') . ' (Hover)',
				'section'	=> 'careta_form_options',
				'settings'	=> 'careta_inputfocusbg_color',
			)
		)
	);
	
	// border color
	$wp_customize->add_setting(
		'careta_inputfocusborder_color',
		array(
			'default'	=> '#4A4A4A',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'careta_inputfocusborder_color',
			array(
				'label'		=> __('Border', 'default') .  ' (Hover)',
				'section'	=> 'careta_form_options',
				'settings'	=> 'careta_inputfocusborder_color',
			)
		)
	);
	
	
	//********************************************************************************************************************
	//********************************************************************************************************************
	// social options section
	//********************************************************************************************************************
	//********************************************************************************************************************
	$wp_customize->add_section(
		'careta_social_options',
		array(
			'title'		=> __('Social Options', 'default'),
			'priority'	=> 51,
		)
	);


	
	// Email
	$wp_customize->add_setting(
		'careta_social_email',
		array(
			'default'	=> 'careta',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		'careta_social_email',
		array(
			'label' => __('Email Address', 'default'),
			'section' => 'careta_social_options',
			'settings' => 'careta_social_email',
			'type' => 'text',
		)
	);

	// facebook
	$wp_customize->add_setting(
		'careta_social_facebook',
		array(
			'default'	=> 'careta',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		'careta_social_facebook',
		array(
			'label' => __('Facebook Account', 'default'),
			'section' => 'careta_social_options',
			'settings' => 'careta_social_facebook',
			'type' => 'text',
		)
	);


	// flickr
	$wp_customize->add_setting(
		'careta_social_flickr',
		array(
			'default'	=> 'careta',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		'careta_social_flickr',
		array(
			'label' => __('Flicker Account', 'default'),
			'section' => 'careta_social_options',
			'settings' => 'careta_social_flickr',
			'type' => 'text',
		)
	);

	// GooglePlus
	$wp_customize->add_setting(
		'careta_social_googleplus',
		array(
			'default'	=> 'careta',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		'careta_social_googleplus',
		array(
			'label' => __('Google Plus Account', 'default'),
			'section' => 'careta_social_options',
			'settings' => 'careta_social_googleplus',
			'type' => 'text',
		)
	);
	
	// Linkedin
	$wp_customize->add_setting(
		'careta_social_linkedin',
		array(
			'default'	=> 'careta',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		'careta_social_flickr',
		array(
			'label' => __('Linkedin Account', 'default'),
			'section' => 'careta_social_options',
			'settings' => 'careta_social_linkedin',
			'type' => 'text',
		)
	);
	
	// Pintrest
	$wp_customize->add_setting(
		'careta_social_pintrest',
		array(
			'default'	=> 'careta',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		'careta_social_pintrest',
		array(
			'label' => __('Pintrest Account', 'default'),
			'section' => 'careta_social_options',
			'settings' => 'careta_social_pintrest',
			'type' => 'text',
		)
	);
	
	
	// twitter
	$wp_customize->add_setting(
		'careta_social_twitter',
		array(
			'default'	=> 'careta',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		'careta_social_twitter',
		array(
			'label' => __('Twitter Account', 'default'),
			'section' => 'careta_social_options',
			'settings' => 'careta_social_twitter',
			'type' => 'text',
		)
	);
	
	// vimeo
	$wp_customize->add_setting(
		'careta_social_vimeo',
		array(
			'default'	=> 'careta',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		'careta_social_vimeo',
		array(
			'label' => __('Vimeo Account', 'default'),
			'section' => 'careta_social_options',
			'settings' => 'careta_social_vimeo',
			'type' => 'text',
		)
	);
	
	// youtube
	$wp_customize->add_setting(
		'careta_social_youtube',
		array(
			'default'	=> 'careta',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	$wp_customize->add_control(
		'careta_social_youtube',
		array(
			'label' => __('YouTube Account', 'default'),
			'section' => 'careta_social_options',
			'settings' => 'careta_social_youtube',
			'type' => 'text',
		)
	);
	
	// social bar location
	$wp_customize->add_setting(
		'careta_social_location',
		array(
			'default'	=> 'header',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	// social bar location
	$wp_customize->add_control('careta_social_location', array(
		'label' => 'Location:',
		'section' => 'careta_social_options',
		'priority'  => 100,  
		'type' => 'select',
		'choices' => array(
			'header' => 'Header',
			'footer' => 'Footer'
		),
	) );	
	
	// social bar align
	$wp_customize->add_setting(
		'careta_social_align',
		array(
			'default'	=> 'right',
			'transport'	=> 'refresh',
			'sanitize_callback' => 'careta_sanitize_string'
		)
	);

	// select control
	$wp_customize->add_control('careta_social_align', array(
		'label' => 'Alignment:',
		'section' => 'careta_social_options',
		'type' => 'select',
		'choices' => array(
			'left' => __('Left','default'),
			'right' => __('Right','default'),
			'center' => __('Center','default'),
		),
	) );	
	
}
add_action('customize_register', 'careta_customize_register');


function careta_customize_css()
{
	$bgColor = get_theme_mod('careta_background_color', '#E9E9E9');
	$bgImage = get_theme_mod('careta_background_image', '');
	$bgStyle = get_theme_mod('careta_background_style', 'tile');
	
    $wrapColor = get_theme_mod('careta_wrap_color', '#F3F3F3');
    
	$textColor = get_theme_mod('careta_text_color', '#333333');
	$textHoverColor = get_theme_mod('careta_text_hover_color', '#ffffff');
	$postBgColor = get_theme_mod('careta_postbox_color', '#ffffff');
	$highlightColor = get_theme_mod('careta_highlight_color', '#DD3333');
	$thumbnailWidth = (int) get_option('thumbnail_size_w');
	$thumbnailHeight = (int) get_option('thumbnail_size_h');
    
    $postTextColor = get_theme_mod('careta_posttext_color','#333333');
	$postLinkColor = get_theme_mod('careta_postlink_color','#DD3333');
	$postDetailsColor = get_theme_mod('careta_postdetails_color', '#e0e0e0');
	
	$style = get_theme_mod('careta_category_style','variable');
	
	
	$footerColor = get_theme_mod('careta_footer_color', '#636363');
	$footerBgColor = get_theme_mod('careta_footerbg_color', '#b7b7b7');
	$footerLinkColor = get_theme_mod('careta_footerlink_color', '#383838');
	$footerLinkHoverColor = get_theme_mod('careta_footerlinkhover_color', '#FF0000');
	
	
	$themeinfoColor = get_theme_mod('careta_themeinfo_color', '#4f4f4f');
	$themeinfoBgColor = get_theme_mod('careta_themeinfobg_color', '#d8d8d8');
	$themeinfoLinkColor = get_theme_mod('careta_themeinfolink_color', '#DD3333');
	$themeinfoAlign = get_theme_mod('careta_themeinfoalign_text', 'left');
	
	$headerColor = get_theme_mod('careta_header_color', '#ffffff');
	$headerColorHover = get_theme_mod('careta_headerhover_color', '#DD3333');
	$headerBgColor = get_theme_mod('careta_headerbg_color', '#262626');
	$headerTextAlign = get_theme_mod('careta_headeralign_text', 'left');
	$headerImage = get_theme_mod('careta_header_image', '');
	
	$authorColor = get_theme_mod('careta_author_text_color', '#7c7c7c');
	$authorBGColor = get_theme_mod('careta_author_back_color', '#E9E9E9');
	
	$paginationColor = get_theme_mod('careta_pagination_color', '#cecece');
	$paginationBgColor = get_theme_mod('careta_paginationbg_color', '#4F4F4F');
	$paginationHoverColor = get_theme_mod('careta_paginationhover_color', 'yellow');
	$paginationBgHoverColor = get_theme_mod('careta_paginationbghover_color', '#DD3333');
	
	
	$inputColor = get_theme_mod('careta_input_color', '#494949');
	$inputBgColor = get_theme_mod('careta_inputbg_color', '#cecece');
	$inputBorderColor = get_theme_mod('careta_inputborder_color','darkgrey');
	
	$inputFocusColor = get_theme_mod('careta_inputfocus_color', '#ffffff');
	$inputFocusBgColor = get_theme_mod('careta_inputfocusbg_color', '#2b2b2b');
	$inputFocusBorderColor = get_theme_mod('careta_inputfocusborder_color', '#4A4A4A');
	
	$socialAlign = get_theme_mod('careta_social_align', 'right');
	
	
	$hex = $textColor;
	if($hex{0} === '#') $hex = substr($hex, 1);
	
	if(strlen($hex) == 6)
	{
		list($r, $g, $b) = array($hex{0} . $hex{1}, $hex{2} . $hex{3}, $hex{4} . $hex{5});
	}
	elseif(strlen($hex) == 3)
	{
		list($r, $g, $b) = array($hex{0} . $hex{0}, $hex{1} . $hex{1}, $hex{2} . $hex{2});
	}
	else
	{
		return array();
	}
	
	$r = hexdec($r);
	$g = hexdec($g);
	$b = hexdec($b);
	$textColorRGB = array('r' => $r, 'g' => $g, 'b' => $b);
?>
	<style type="text/css">
		body, .mfp-bg 
		{ 
			<?php	$start = $bgColor; $end = careta_adjust_brightness($start,-30); ?>
			<?php	careta_create_gradient($start,$end);  ?>
			<?php if ($bgImage != '') 
			{ 
				if ($bgStyle == 'cover') 
				{
			?>
				background: url(<?php echo $bgImage; ?>) !important; no-repeat center center fixed !important; 
				-webkit-background-size: cover !important;
				-moz-background-size: cover !important;
				-o-background-size: cover !important;
				background-size: cover !important;
				<?php 
				} 
				else 
				{ ?>
				background-image: url(<?php echo $bgImage; ?>) !important;
			<?php } ?>
		<?php } ?>
		}
		body, #blog-title a, #post-list .post .no-more, .post .post-more div, .comment-author, .comment-meta, .ti, .ta, .form .hint, .mfp-title, .mfp-counter, .mfp-close-btn-in .mfp-close, #page.open #menu .menu .current_page_ancestor > a 
		{
			color: <?php echo $textColor; ?>;
		}
		#menu .menu a
		{
			color: <?php echo $headerColor; ?>;
		}
		#post a, #post blockquote:before, #post blockquote:after, .comment-author a, .comment-meta a 
		{
			color: <?php echo $postLinkColor; ?>;
		}
		.post-more-date, .post-more-comments
		{
			color: <?php echo $postDetailsColor; ?> !important;
			font-size: 14px;
		}
		
		#post blockquote,.comment p 
		{
			border-left:0.5rem solid <?php echo $textColor; ?>;
			background:<?php echo $postBgColor; ?>;
			color:<?php echo $textColor; ?>;
		}
		.respond
		{
			background:<?php echo $postBgColor; ?>;
		}
		.wrap 
		{
			background-color: <?php echo $wrapColor; ?>;
			<?php	$start = $wrapColor; $end = careta_adjust_brightness($start,50); ?>
			<?php	careta_create_gradient($start,$end);  ?>
			
		}
		#header .inner , #menu .menu > ul > li > .children, #menu .menu > li > .sub-menu 
		{
			color: <?php echo $headerColor; ?>;
			background-color: <?php echo $headerBgColor; ?>;
			<?php	$start = $headerBgColor; $end = careta_adjust_brightness($start,-50); ?>
			<?php	careta_create_gradient($start,$end);  ?>
		}
        
		<?php if ($headerImage != ''){ ?>
		#header .inner 
		{ 
			background-image:url(<?php echo $headerImage; ?>) !important;
			background-repeat:no-repeat !important;
			background-size: 100% !important;
		}
		<?php } ?>
		#header a, #header .inner a
		{
			color: <?php echo $headerColor; ?>;
		}
		#header a:hover, #header .inner a:hover
		{
			color: <?php echo $headerColorHover; ?>;
		}
		#header 
		{ 
			text-align: <?php echo $headerTextAlign; ?>; 
		}
		#themeinfo
		{
			color: <?php echo $themeinfoColor; ?>;
			background-color: <?php echo $themeinfoBgColor; ?>;
			text-align: <?php echo $themeinfoAlign; ?> !important; 
		}
		#themeinfo a
		{
			color: <?php echo $themeinfoLinkColor; ?>;
		}
		.social
		{
			text-align: <?php echo $socialAlign; ?> !important; 
		}
		
		a, #blog-title a:hover, #menu .menu a:hover, #menu .menu .current-menu-item > a, #menu .menu .current_page_item > a, #menu .menu .current_page_ancestor > a, .bypostauthor .comment-author a, .bypostauthor .comment-author cite, #post-navi div, .form .req label span 
		{
			color: <?php echo $headerColorHover; ?>;
		}
		
		#menu .menu > ul > li > .children, #menu .menu > li > .sub-menu 
		{ 
			border-top: 0px solid <?php echo $highlightColor; ?>; 
		}
		#post-navi 
		{ 
			text-align: left;
		}
		.mfp-title, .mfp-counter 
		{ 
			text-shadow: 1px 1px 0 <?php echo $bgColor; ?>; 
		}
		.mfp-arrow-left:after, .mfp-arrow-left .mfp-a 
		{ 
			border-right-color: <?php echo $bgColor; ?>; 
		}
		.mfp-arrow-left:before, .mfp-arrow-left .mfp-b 
		{ 
			border-right-color: <?php echo $textColor; ?>; 
		}
		.mfp-arrow-right:after, .mfp-arrow-right .mfp-a 
		{ 
			border-left-color: <?php echo $bgColor; ?>; 
		}
		.mfp-arrow-right:before, .mfp-arrow-right .mfp-b 
		{ 
			border-left-color: <?php echo $textColor; ?>; 
		}
		.page-numbers, .page-numbers a, .post-more 
		{
			color: <?php echo $paginationColor; ?>;
			<?php	$start = $paginationBgColor; $end = careta_adjust_brightness($start,-70); ?>
			<?php	careta_create_gradient($start,$end);  ?>
			
		}
		.page-numbers a:hover, .current
		{
			color: <?php echo $paginationHoverColor; ?>;
			<?php	$start = $paginationBgHoverColor; $end = careta_adjust_brightness($start,-50); ?>
			<?php	careta_create_gradient($start,$end);  ?>
		}
		.post-tags, .post-tags a, .post-categories, .post-categories a 
		{
			color: <?php echo $paginationColor; ?> !important;
			background-color: <?php echo $paginationBgColor; ?>;
		}
		.post-tags a:hover, .post-categories a:hover
		{
			color: <?php echo $paginationHoverColor; ?> !important;
			background-color: <?php echo $paginationBgHoverColor; ?> !important;
		}
		.post 
		{ 
			background: <?php echo $postBgColor; ?>; 
			<?php if ($style == 'fixed') { ?>
				min-height: 17rem;
			<?php } ?>
			
		}
		.post-content 
		{ 
			background: <?php echo $wrapColor; ?>;
            color: <?php echo $postTextColor; ?>; 
		}
		
		#post-list .post:hover, #post-list .post:hover a
		{ 
			background: <?php echo $highlightColor; ?>; 
			color: <?php echo $textHoverColor; ?>; 
		}
		#post-list .sticky-icon 
		{ 
			border-color: transparent <?php echo $highlightColor; ?> transparent transparent; 
		}
		#post .gallery .gallery-item 
		{
			width: <?php echo $thumbnailWidth . 'px'; ?>;
			height: <?php echo $thumbnailHeight . 'px'; ?>;
		}
		#page.open 
		{ 
			box-shadow: 10px 0 20px 0 rgba(<?php echo $textColorRGB['r']; ?>, <?php echo $textColorRGB['g']; ?>, <?php echo $textColorRGB['b']; ?>, .3); 
		}
		input[type="text"], textarea , select, input[type="submit"], input[type="button"], .searchform input[type="text"], .searchform input[type="button"], .searchform input[type="submit"]
		{
			color: <?php echo $inputColor; ?>;
			<?php	$start = $inputBgColor; $end = careta_adjust_brightness($start,-30); ?>
			<?php	careta_create_gradient($start,$end);  ?>
			border:1px solid <?php echo $inputBorderColor; ?>;
		}

		input[type="text"]:focus, textarea:focus , select:focus, input[type="submit"]:focus, input[type="submit"]:hover, input[type="button"]
		{
			color: <?php echo $inputFocusColor; ?>;
			<?php	$start = $inputFocusBgColor; $end = careta_adjust_brightness($start,-30); ?>
			<?php	careta_create_gradient($start,$end);  ?>
			border:1px solid <?php echo $inputFocusBorderColor; ?>;
		}
		
		#mobile-menu 
		{ 
			background: <?php echo $highlightColor; ?>; 
		}
		#mobile-menu:before 
		{ 
			border-color: rgba(<?php echo $textColorRGB['r']; ?>, <?php echo $textColorRGB['g']; ?>, <?php echo $textColorRGB['b']; ?>, .7); 
		}
		#mobile-menu:hover 
		{ 
			background: <?php echo $highlightColor; ?>; 
		}
		#mobile-menu:hover:before 
		{ 
			border-color: <?php echo $textHoverColor; ?>; 
		}
		#menu .menu
		{
			background: <?php $headerBgColor; ?>;
		}
		#sidebar-footer a
		{ 
			color: <?php echo $footerLinkColor; ?>;
		}
		#sidebar-footer a:hover 
		{ 
			color: <?php echo $footerLinkHoverColor; ?>;
		}
		#sidebar-footer 
		{ 
			color: <?php echo $footerColor; ?>; 
			<?php	$start = $footerBgColor; $end = careta_adjust_brightness($start,-40); ?>
			<?php	careta_create_gradient($start,$end);  ?>
		}
		.comment-reply-link
		{
			color:<?php echo $inputColor; ?> !important;
			background-color:<?php echo $inputBgColor; ?> !important;
			border:1pt solid <?php echo $inputBorderColor; ?> !important;
		}
		.comment-reply-link:hover
		{
			color:<?php echo $inputFocusColor; ?> !important;
			background-color:<?php echo $inputFocusBgColor; ?> !important;
			border:1pt solid <?php echo $inputFocusBorderColor; ?> !important;
		}
		.author-box
		{
			color:<?php echo $authorColor; ?> !important;
			background-color:<?php echo	$authorBGColor; ?> !important;
			border:1pt solid <?php echo $inputFocusBorderColor; ?> !important;
		}
	</style>
<?php
}
add_action('wp_head', 'careta_customize_css');

function careta_remove_recent_comments_style() 
{
	global $wp_widget_factory;
	remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'careta_recent_comments_style'));
}
add_action('widgets_init', 'careta_remove_recent_comments_style');


function careta_draw_transparent()
{
	$folder = get_template_directory_uri() . "/images/";
	$value = "transparent.gif";
	echo "<img src=\"$folder/$value\" class=\"post-thumb\" width=\"300px\" height=\"199px\"  >\n";
}

//Create a second color based on $hex, steps : -255 and 255. 
//Negative = darker, positive = lighter
function careta_adjust_brightness($hex, $steps) 
{
    $steps = max(-255, min(255, $steps));
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 3)  $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);

    // Get decimal values
    $r = hexdec(substr($hex,0,2));
    $g = hexdec(substr($hex,2,2));
    $b = hexdec(substr($hex,4,2));

    // Adjust number of steps and keep it inside 0 to 255
    $r = max(0,min(255,$r + $steps));
    $g = max(0,min(255,$g + $steps));  
    $b = max(0,min(255,$b + $steps));

    $r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
    $g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
    $b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);

    return '#'.$r_hex.$g_hex.$b_hex;
}

function careta_create_gradient($start,$end)
{
	?>
	background-color: <?php echo $start; ?> !important; 
	background-image: -webkit-gradient(linear, left top, left bottom, from(<?php echo $start; ?>), to(<?php echo $end; ?>)) !important;
	background-image: -webkit-linear-gradient(top, <?php echo $start; ?> , <?php echo $end; ?>) !important;
	background-image: -moz-linear-gradient(top, <?php echo $start; ?> , <?php echo $end; ?>) !important;
	background-image: -ms-linear-gradient(top, <?php echo $start; ?> , <?php echo $end; ?>) !important;
	background-image: -o-linear-gradient(top, <?php echo $start; ?> , <?php echo $end; ?>) !important;
	background-image: linear-gradient(to bottom, <?php echo $start; ?> , <?php echo $end; ?>) !important;
	filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=<?php echo $start; ?> , endColorstr=<?php echo $end; ?>) !important;	
	<?php
}


function careta_draw_social()
{
	echo "<div class=\"social\">";
		$folder = get_template_directory_uri() . "/images/";

		$value = get_theme_mod('careta_social_facebook', '');
		if ($value != "") echo "<a href=\"http://facebook.com/$value\" class=\"genericon genericon-facebook\" title=\"Facebook\"></a>\n";

		$value = get_theme_mod('careta_social_googleplus', '');
		if ($value != "") echo "<a href=\"https://plus.google.com/$value\" class=\"genericon genericon-googleplus\" title=\"GooglePlus\"></a>\n";
		
		$value = get_theme_mod('careta_social_twitter', '');
		if ($value != "") echo "<a href=\"http://twitter.com/$value\" class=\"genericon genericon-twitter\" title=\"Twitter\"></a>\n";
		
		$value = get_theme_mod('careta_social_linkedin', '');
		if ($value != "") echo "<a href=\"http://linkedin.com/$value\" class=\"genericon genericon-linkedin\" title=\"Linkedin\"></a>\n";
		
		$value = get_theme_mod('careta_social_pintrest', '');
		if ($value != "") echo "<a href=\"http://pintrest.com/$value\" class=\"genericon genericon-pinterest\" title=\"Pinterest\"></a>\n";
	
		$value = get_theme_mod('careta_social_vimeo', '');
		if ($value != "") echo "<a href=\"http://vimeo.com/$value\" class=\"genericon genericon-vimeo\" title=\"Vimeo\"></a>\n";

		$value = get_theme_mod('careta_social_youtube', '');
		if ($value != "") echo "<a href=\"http://youtube.com/$value\" class=\"genericon genericon-youtube\" title=\"YouTube\"></a>\n";

		$value = get_theme_mod('careta_social_email', '');
		if ($value != "") echo "<a href=\"mailto:$value\" class=\"genericon genericon-mail\" title=\"Email\"></a>\n";
	echo "</div>";
}

function careta_cut_text($title,$size)
{
	if (strlen($title) > $size)
	{
		echo substr($title,0,$size) . "...";
	}
	else
	{
		echo $title;
	}
}

function careta_sanitize_string($value)
{
	return $value;
}

function careta_sanitize_integer($value)
{
	if (is_null($value) || empty($value) || strlen(trim($value)) == 0)
	{
		return 0;
	}
	
	if (!is_numeric($value))
	{
		return 0;
	}

	return intval($value);
}

?>