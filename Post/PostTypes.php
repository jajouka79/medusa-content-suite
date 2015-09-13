<?php

namespace MedusaContentSuite\Post;

use MedusaContentSuite\Config\PostConfig as PostConfig;

class PostTypes
{

  public function init()
  {
    add_action( 'init', array( $this, 'getPostConfig' ), 1 );
    add_action( 'init', array( $this, 'registerPostTypes' ), 2 );
  }

	public function getPostConfig()
	{
		$PostConfig = new PostConfig();
		$PostConfig = $PostConfig->getPostConfig();

		return $PostConfig;
	}

	public function registerPostTypes()
	{
		#write_log("registerPostTypes()");
		global $blog_id;

		$PostConfig =  $this->getPostConfig();
		/*print("<h1>this->PostConfig</h1>");
		echo "<pre>";
		print_r ( $PostConfig );
		echo "</pre>";*/


		if ( is_main_site($blog_id) ) {
			#write_log( "yes, this is the main site" . "<br />" );
		}

		if( ! empty ( $PostConfig ) ):

			foreach ( $PostConfig as $p ):

				/*
				echo "<pre>";
				print_r ( $p );
				echo "</pre>";
				*/
				
				if ( ! is_main_site( $blog_id ) ) :

					#echo "name - " . $p['args']['labels']['name'];
					#write_log("name - " . $p['args']['labels']['name']);

					if( ! isset($p['extras']['mu_main_site_only']) || $p['extras']['mu_main_site_only'] == false ):
						register_post_type( $p['types'], $p['args'] );

					else:
						#write_log (" -- mu_main_site_only - not set". "<br />");
					endif;

				else:
					#write_log( $p['types'] );				
					if( ! isset( $p['extras']['sub_site_only']) || $p['extras']['sub_site_only'] == false ):
						register_post_type( $p['types'], $p['args'] );
					endif;

				endif;

			endforeach;

			#add_theme_support('post-thumbnails');

			#$post_types = get_post_types( '', 'names' );
			#foreach ( $post_types as $post_type ){ write_log( $post_type ); }

		endif;

		return $PostConfig;

	}

}