<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {
	// Change this to use your theme slug
	return 'skt-photosession';
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'skt-photo-session'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	$options = array();
	$imagepath =  get_template_directory_uri() . '/images/';
		
	
	//Basic Settings
	
	$options[] = array(
		'name' => __('Basic Settings', 'skt-photo-session'),
		'type' => 'heading');
		
		$options[] = array(
		'name' => __('Logo', 'skt-photo-session'),
		'desc' => __('Upload your logo here', 'skt-photo-session'),
		'id' => 'logo',
		'class' => '',
		'std'	=> '',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('Copyright Text', 'skt-photo-session'),
		'desc' => __('Some Text regarding copyright of your site, you would like to display in the footer.', 'skt-photo-session'),
		'id' => 'footertext2',
		'std' => 'Photo Session 2014. All Rights Reserved',
		'type' => 'text');

	$options[] = array(
		'name' => __('Featured image as background', 'skt-photo-session'),
		'desc' => __('Do not use featured image as background image.', 'skt-photo-session'),
		'id' => 'featured_as_background',
		'type' => 'checkbox',
		'std' => '' );

	$options[] = array(
		'name' => __('Color Scheme', 'skt-photo-session'),
		'desc' => __('Select the color scheme for theme', 'skt-photo-session'),
		'id' => 'navigation_color',
		'std' => '#7BB303',
		'type' => 'color');

	/*$options[] = array(
		'name' => __('Navigation Icon', 'skt-photo-session'),
		'desc' => __('Upload icon for navigation<br />(max image size 9px X 9px)', 'skt-photo-session'),
		'id' => 'navigation_icon',
		'class' => '',
		'std'	=> get_template_directory_uri()."/images/nav-icon-hover.png",
		'type' => 'upload');*/
		
	$options[] = array(
		'name' => __('Pagination Gradient Color - Top', 'skt-photo-session'),
		'desc' => __('Select the top gradient color for pagination links', 'skt-photo-session'),
		'id' => 'pagin_grad_top_color',
		'std' => '#89b219',
		'type' => 'color');
		
	$options[] = array(
		'name' => __('Pagination Gradient Color - Bottom', 'skt-photo-session'),
		'desc' => __('Select the bottom gradient color for pagination links', 'skt-photo-session'),
		'id' => 'pagin_grad_bottom_color',
		'std' => '#3f8d03',
		'type' => 'color');

	//Layout Settings
		
	$options[] = array(
		'name' => __('Layout Settings', 'skt-photo-session'),
		'type' => 'heading');	
	
	$options[] = array(
		'name' => "Menu Layout",
		'desc' => "Select Layout for Menu position. It applies on inner pages only.",
		'id' => "sidebar-layout",
		'std' => "left",
		'type' => "images",
		'options' => array(
			'left' => $imagepath . '2cl.png',
			'right' => $imagepath . '2cr.png')
	);
	
	$options[] = array(
		'name' => __('Custom CSS', 'skt-photo-session'),
		'desc' => __('Some Custom Styling for your site. Place any css codes here instead of the style.css file.', 'skt-photo-session'),
		'id' => 'style2',
		'std' => '',
		'type' => 'textarea');
	
	//SLIDER SETTINGS

	$options[] = array(
		'name' => __('Homepage Slider', 'skt-photo-session'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('Slider Image 1', 'skt-photo-session'),
		'desc' => __('First Slide', 'skt-photo-session'),
		'id' => 'slide1',
		'class' => '',
		'std' => get_template_directory_uri()."/images/banner_bg.jpg",
		'type' => 'upload');
	
	$options[] = array(
		'desc' => __('Title', 'skt-photo-session'),
		'id' => 'slidetitle1',
		'std' => 'Slider Image 1',
		'type' => 'text');
	
	$options[] = array(
		'desc' => __('Description or Tagline', 'skt-photo-session'),
		'id' => 'slidedesc1',
		'std' => 'Small description for slide 1',
		'type' => 'textarea');			
		
	$options[] = array(
		'desc' => __('Url', 'skt-photo-session'),
		'id' => 'slideurl1',
		'std' => '#link1',
		'type' => 'text',
		'subtype' => 'url');		
	
	$options[] = array(
		'name' => __('Slider Image 2', 'skt-photo-session'),
		'desc' => __('Second Slide', 'skt-photo-session'),
		'class' => '',
		'id' => 'slide2',
		'std' => get_template_directory_uri()."/images/banner-welcome.jpg",
		'type' => 'upload');
	
	$options[] = array(
		'desc' => __('Title', 'skt-photo-session'),
		'id' => 'slidetitle2',
		'std' => 'Slider Image 2 ',
		'type' => 'text');	
	
	$options[] = array(
		'desc' => __('Description or Tagline', 'skt-photo-session'),
		'id' => 'slidedesc2',
		'std' => 'Small description for slide 2',
		'type' => 'textarea');		
		
	$options[] = array(
		'desc' => __('Url', 'skt-photo-session'),
		'id' => 'slideurl2',
		'std' => '#link2',
		'type' => 'text',
		'subtype' => 'url');	
		
	$options[] = array(
		'name' => __('Slider Image 3', 'skt-photo-session'),
		'desc' => __('Third Slide', 'skt-photo-session'),
		'id' => 'slide3',
		'class' => '',
		'std' => get_template_directory_uri()."/images/banner-third.jpg",
		'type' => 'upload');	
	
	$options[] = array(
		'desc' => __('Title', 'skt-photo-session'),
		'id' => 'slidetitle3',
		'std' => 'Slider Title 3',
		'type' => 'text');	
		
	$options[] = array(
		'desc' => __('Description or Tagline', 'skt-photo-session'),
		'id' => 'slidedesc3',
		'std' => 'Small description for slide 2',
		'type' => 'textarea');	
			
	$options[] = array(
		'desc' => __('Url', 'skt-photo-session'),
		'id' => 'slideurl3',
		'std' => '#link3',
		'type' => 'text',
		'subtype' => 'url');		
	
	$options[] = array(
		'name' => __('Slider Image 4', 'skt-photo-session'),
		'desc' => __('Fourth Slide', 'skt-photo-session'),
		'id' => 'slide4',
		'class' => '',
		'std' => get_template_directory_uri()."/images/banner-fourth.jpg",
		'type' => 'upload');	
		
	$options[] = array(
		'desc' => __('Title', 'skt-photo-session'),
		'id' => 'slidetitle4',
		'std' => 'Slider Title 4',
		'type' => 'text');
	
	$options[] = array(
		'desc' => __('Description or Tagline', 'skt-photo-session'),
		'id' => 'slidedesc4',
		'std' => 'Small description for slide 4',
		'type' => 'textarea');			
		
	$options[] = array(
		'desc' => __('Url', 'skt-photo-session'),
		'id' => 'slideurl4',
		'std' => '#link4',
		'type' => 'text',
		'subtype' => 'url');		
	
	$options[] = array(
		'name' => __('Slider Image 5', 'skt-photo-session'),
		'desc' => __('Fifth Slide', 'skt-photo-session'),
		'id' => 'slide5',
		'class' => '',
		'std' => '',
		'type' => 'upload');	
		
	$options[] = array(
		'desc' => __('Title', 'skt-photo-session'),
		'id' => 'slidetitle5',
		'std' => '',
		'type' => 'text');	
	
	$options[] = array(
		'desc' => __('Description or Tagline', 'skt-photo-session'),
		'id' => 'slidedesc5',
		'std' => '',
		'type' => 'textarea');		
		
	$options[] = array(
		'desc' => __('Url', 'skt-photo-session'),
		'id' => 'slideurl5',
		'std' => '',
		'type' => 'text',
		'subtype' => 'url');	
			
	//Social Settings
	
	$options[] = array(
		'name' => __('Social Settings', 'skt-photo-session'),
		'type' => 'heading');
	
	$options[] = array(
		'desc' => __('Please set the value of following fields, as per the instructions given along. If you do not want to use an icon, just leave it blank. If some icons are showing up, even when no value is set then make sure they are completely blank, and just save the options once. They will not be shown anymore.', 'skt-photo-session'),
		'type' => 'info');

	$options[] = array(
		'name' => __('Facebook', 'skt-photo-session'),
		'desc' => __('Facebook Profile or Page URL i.e. http://facebook.com/username/ ', 'skt-photo-session'),
		'id' => 'facebook',
		'std' => '#',
		'class' => 'mini',
		'type' => 'text',
		'subtype' => 'url');
	
	$options[] = array(
		'name' => __('Twitter', 'skt-photo-session'),
		'desc' => __('Twitter Username', 'skt-photo-session'),
		'id' => 'twitter',
		'std' => '#',
		'class' => 'mini',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('Google Plus', 'skt-photo-session'),
		'desc' => __('Google Plus profile url, including "http://"', 'skt-photo-session'),
		'id' => 'google',
		'std' => '#',
		'class' => 'mini',
		'type' => 'text',
		'subtype' => 'url');
		
	$options[] = array(
		'name' => __('Linkedin', 'skt-photo-session'),
		'desc' => __('Linkedin URL', 'skt-photo-session'),
		'id' => 'linkedin',
		'std' => '#',
		'class' => 'mini',
		'type' => 'text',
		'subtype' => 'url');	

	
	// Contact Details
		$options[] = array(
		'name' => __('Contact Details for footer', 'skt-photo-session'),
		'type' => 'heading');
	
		$options[] = array(
		'desc' => __('Company Name', 'skt-photo-session'),
		'id' => 'contact1',
		'std' => 'PHOTO SESSION',
		'type' => 'text');	
		
		$options[] = array(
		'desc' => __('Address 1', 'skt-photo-session'),
		'id' => 'contact2',
		'std' => '123 Some Street',
		'type' => 'text');	
		
		$options[] = array(
		'desc' => __('Address 2', 'skt-photo-session'),
		'id' => 'contact3',
		'std' => 'California, USA',
		'type' => 'text');
		
		$options[] = array(
		'desc' => __('Phone', 'skt-photo-session'),
		'id' => 'contact4',
		'std' => '100 2000 300',
		'type' => 'text');
		
		$options[] = array(
		'desc' => __('Email', 'skt-photo-session'),
		'id' => 'contact5',
		'std' => sanitize_email( 'info@example.com' ),
		'type' => 'text',
		'subtype' => 'email');	

	// Support					
		$options[] = array(
		'name' => __('Our Themes', 'skt-photo-session'),
		'type' => 'heading');
		
	$options[] = array(
		'desc' => __('SKT Photo Session WordPress theme has been Designed and Created by SKT Themes.', 'skt-photo-session'),
		'type' => 'info');	
		
	 $options[] = array(
		'desc' => __('<a href="'.esc_url(SKT_THEME_URL).'" target="_blank"><img src="'.get_template_directory_uri().'/images/sktskill.jpg"></a><p><em><a target="_blank" href="'.esc_url(SKT_THEME_URL_DIRECT).'">Buy PRO version for only $30 with more features.</a></em></p>', 'skt-photo-session'),
		'type' => 'info');	
	
	
	return $options;
}