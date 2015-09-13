<?php

namespace MedusaContentSuite\Config;

class ModConfig
{

  public function init()
  {
	#print( "<ul><li>ModConfig > init</li></ul>" );
	add_action( 'init', array( $this, 'getModConfig'), 1 );
	add_action( 'widgets_init', array( $this, 'medusa_configuration_sidebars' ), 1 );
	add_filter( 'gettext', array( $this, 'custom_enter_title' ), 1 );
	add_filter( 'getdecsription', array( $this, 'custom_enter_desc' ), 1 );
	add_action( 'init', array( $this, 'my_add_excerpts_to_pages' ), 1 );
  }

	public function getModConfig()
	{
	//
		$config = array('nothing in here!!');
		return $config;

	}

	public function medusa_configuration_sidebars() {
		#echo"medusa_configuration_sidebars()<br>";
		if ( function_exists( 'medusa_configuration_get_post_types_data' ) ):
			$pt_data=medusa_configuration_get_post_types_data();
		endif;
		if ( function_exists( 'medusa_custom_sidebars_widgets_init' ) ):
			medusa_custom_sidebars_widgets_init();
		endif;
		#$a = new medusa_custom_sidebars($pt_data);
	}


	public function medusa_configuration_sidebars_to_remove() {
		$remove=array(
			//'home-widget-1',
			//'home-widget-2',
			//'home-widget-3',
			//'top-widget',
			//'footer-widget',
			//'right-sidebar-half',
			//'left-sidebar-half',
			//'left-sidebar',
			//'right-sidebar',
			//'main-sidebar',
			//'gallery-widget',
			//'colophon-widget',
		);
		return $remove;
	}

	public function custom_enter_title( $input ) {
		global $post_type;
		if ( is_admin() && 'Enter title here' == $input && 'job' == $post_type )
			return 'Enter Job Title';
		return $input;
	}

	public function custom_enter_desc( $input ) {
		global $post_type;
		//if( is_admin() && 'Enter title here' == $input && 'job' == $post_type )
		return 'Enter Job Title';
		return $input;
	}


	public function my_add_excerpts_to_pages() {

		add_post_type_support( 'page', 'excerpt' );

	}


}