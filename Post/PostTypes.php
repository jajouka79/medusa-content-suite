<?php

namespace MedusaContentSuite\Post;

use MedusaContentSuite\Config\PostConfig as PostConfig;
use MedusaContentSuite\Functions\Common as Common;

class PostTypes
{
	public $Globals;

	public function __construct( $Globals )
	{
		Common::write_log( "PostTypes - __construct" );

		add_action( 'init', array( $this, 'registerPostTypes' ), 2 );
		$this->Globals = $Globals;
	}

	public function registerPostTypes(  )
	{
		global $blog_id;
		Common::write_log( "registerPostTypes()" );

		$PostConfig = $this->Globals->postConfig;
		$PostConfig = apply_filters( 'PostConfigHook', $PostConfig, array( ) );


		/*Common::write_log( "PostTypes - PostConfig - " );
		Common::write_log( $PostConfig );*/

		if ( is_main_site( $blog_id ) ) :
			#write_log( "yes, this is the main site - blog_id : " . $blog_id );
		endif;

		if( ! empty ( $PostConfig ) ) :

			foreach ( $PostConfig as $p ) :

				Common::write_log( $p );

				if ( ! is_main_site( $blog_id ) ) :
					if( ! isset( $p['extras']['mu_main_site_only'] ) || $p['extras']['mu_main_site_only'] == false ):
						register_post_type( $p['types'], $p['args'] );
					else:
						#write_log (" -- mu_main_site_only - not set". "<br />");
					endif;
				else :
					if( ! isset( $p['extras']['sub_site_only']) || $p['extras']['sub_site_only'] == false ) :
					
						register_post_type( $p['types'], $p['args'] );
					
					endif;
				endif;

			endforeach;

			#add_theme_support('post-thumbnails');

			#$post_types = get_post_types( '', 'names' );
			#foreach ( $post_types as $post_type ){ write_log( $post_type ); }

		endif;
	}
}