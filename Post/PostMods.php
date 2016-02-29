<?php

namespace MedusaContentSuite\Post;

use MedusaContentSuite\Config\MainConfig as MainConfig;
use MedusaContentSuite\Functions\Common as Common;

class PostMods
{

	public function __construct()
	{
		#Common::write_log( " PostMods > __construct " );

		add_filter( 'gettext', array( $this, 'custom_enter_title' ), 1 );
		add_filter( 'getdecsription', array( $this, 'custom_enter_desc' ), 1 );
		add_action( 'init', array( $this, 'my_add_excerpts_to_pages' ), 1 );
		add_action( 'admin_menu', array( $this, 'removeDefaultPostType' ), 1 );
		add_action( 'admin_bar_menu', array( $this, 'removePostAdminToolbarMenuLinks' ), 999  );

	}

	public function custom_enter_title( $input )
	{
		global $post;

		#Common::write_log( 'custom_enter_title()' );

		if ( ! empty( $post ) ) :
			if ( is_admin( ) && 'Enter title here' == $input )
				$input = 'Enter ' . $post->post_type . ' title';
		endif;

		return $input;
	}

	public function custom_enter_desc( $input )
	{
		global $post_type;
		//if( is_admin() && 'Enter title here' == $input && 'job' == $post_type )
		$input = 'Enter ' . $post->post_type . ' title';
		return $input;
	}

	public function my_add_excerpts_to_pages( )
	{
		#Common::write_log( "my_add_excerpts_to_pages" );

		$MainConfig = new MainConfig;
		$MainConfig = $MainConfig->getMainConfig( );
		Common::write_log( $MainConfig['pages_excerpt'] );

		if( $MainConfig['pages_excerpt']  ) :
			add_post_type_support( 'page', 'excerpt' );
		endif;

	}

    
    public function removeDefaultPostType( ) 
    {
		$MainConfig = new MainConfig;
		$MainConfig = $MainConfig->getMainConfig( );

		if( ! $MainConfig['posts_enabled'] ) :

        	remove_menu_page('edit.php');

    	endif;

    }

	public function removePostAdminToolbarMenuLinks( ) 
	{
	    global $wp_admin_bar;   
		$MainConfig = new MainConfig;
		$MainConfig = $MainConfig->getMainConfig( );

		if( ! $MainConfig['posts_enabled'] ) :

		    $wp_admin_bar->remove_node( 'new-post' );
		    #$wp_admin_bar->remove_node( 'new-link' );
		    #$wp_admin_bar->remove_node( 'new-media' );

		endif;
	}

}