<?php

namespace MedusaContentSuite\Post;

use MedusaContentSuite\Config\PostConfig as PostConfig;
use MedusaContentSuite\Config\MainConfig as MainConfig;
use MedusaContentSuite\Functions\Common as Common;

class PostMods
{

	public function __construct()
	{
		#Common::write_log( " PostMods > __construct " );

		add_filter( 'gettext', array( $this, 'custom_enter_title' ), 1 );
		add_filter( 'getdecsription', array( $this, 'custom_enter_desc' ), 1 );
		add_action( 'init', array( $this, 'addExcerptsToPages' ), 1 );
		add_action( 'admin_menu', array( $this, 'removeDefaultPostType' ), 1 );
		add_action( 'admin_bar_menu', array( $this, 'removePostAdminToolbarMenuLinks' ), 999  );

	}

	public function custom_enter_title( $input )
	{
		global $post;


		$PostConfig = new PostConfig;


		Common::write_log ( 'PostConfig' );
		Common::write_log ( $PostConfig );


		$PostConfig = $PostConfig->getPostConfig( );


		/*

		#Common::write_log( $PostConfig['pages_excerpt'] );
		#Common::write_log( 'custom_enter_title( )' );

		require_once( ABSPATH . 'wp-admin/includes/screen.php' );
		$screen = \get_current_screen( );

		if( is_admin( ) ) :
			if( ! empty( $screen ) ) :
				if( $screen->parent_base == 'edit' ) :
					if ( ! empty( $post ) ) :
						$pt = get_post_type_object( $post->post_type );
						$label = $pt->labels->singular_name;

						#Common::write_log( 'label' );
						#Common::write_log( $label );

						if ( 'Enter title here' == $input ) :
							$input = 'Enter ' . strtolower( $label ) . ' title';
						endif;
					endif;
				endif;
			endif;
		endif;

		*/

		return $input;
	}

	public function custom_enter_desc( $input )
	{
		global $post_type;
		//if( is_admin() && 'Enter title here' == $input && 'job' == $post_type )
		$input = 'Enter ' . $post->post_type . ' title xxxxxxx';
		return $input;
	}

	public function addExcerptsToPages( )
	{
		#Common::write_log( "addExcerptsToPages" );

		$MainConfig = new MainConfig;
		$MainConfig = $MainConfig->getMainConfig( );
		#Common::write_log( $MainConfig['pages_excerpt'] );

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