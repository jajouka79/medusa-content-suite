<?php

namespace MedusaContentSuite\Post;

use MedusaContentSuite\Config\PostConfig as PostConfig;
use MedusaContentSuite\Functions\Common as Common;

class PostTypes
{

	public function __construct()
	{
		add_action( 'init', array( $this, 'registerPostTypes' ), 2 );		
	}

	public function registerPostTypes(  )
	{
		#write_log("registerPostTypes(  )");
		global $blog_id;

		$PostConfig = new PostConfig(  );
		$PostConfig = $PostConfig->getPostConfig( );

		if ( is_main_site( $blog_id ) ) {
			#write_log( "yes, this is the main site - blog_id : " . $blog_id );
		}

		if( ! empty ( $PostConfig ) ) :

			foreach ( $PostConfig as $p ) :
	
				if ( ! is_main_site( $blog_id ) ) :
					if( ! isset( $p['extras']['mu_main_site_only'] ) || $p['extras']['mu_main_site_only'] == false ):
						register_post_type( $p['types'], $p['args'] );
					else:
						#write_log (" -- mu_main_site_only - not set". "<br />");
					endif;
				else:
					if( ! isset( $p['extras']['sub_site_only']) || $p['extras']['sub_site_only'] == false ) :
						#write_log( $p['args'] );
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