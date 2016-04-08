<?php

namespace MedusaContentSuite\Functions;

use MedusaContentSuite\Paths as Paths;

class Common
{
	public function __construct()
	{
		add_action('init', array( $this, 'getCommonFunctions'), 1);##very early priority
		add_action( 'plugins_loaded', array( $this, 'checkPluginActive'), 1, 1 );
	}


	public static function convertYML( $path )
	{
		if( file_exists ( $path ) ) :
			$contents = file_get_contents( $path );
			if ( ! empty( $contents ) ) :
				$array = Yaml::parse( $contents );
			endif;
		endif;

		return $PostConfig;
	}


	public function getCommonFunctions()
	{
		include "medusa_resources_common_functions.php";
	}


	public static function write_log( $log )
	{
		if ( true === WP_DEBUG ) :
			if ( is_array( $log ) || is_object( $log ) ) :
				error_log( print_r( $log, true ) );			
			else :
				error_log( $log );
			endif;
		endif;
	}


	public static function checkPluginActive( $plugin_const )
	{
		if( defined( $plugin_const ) ) :
			self::write_log( $plugin_const );
			return true;
		else:
			return false;
		endif;
	}


	public static function getPageNameById( $id )
	{
		$this_post = get_post( $id );

		if( isset( $this_post ) ) :
			if( ! empty( $this_post ) ):
				return $this_post->post_name;
			endif;
		endif;

		return false;
	}


	public static function getPageIdByName( $name )
	{
		$this_post = get_page_by_title( $name, OBJECT, 'page' );

		if( ! empty( $this_post ) ) :
			return $this_post->ID;
		endif;

		return false;
	}


	public static function getPageIdByNameAndType( $name, $type ) {
		$this_post = get_page_by_title( $name, OBJECT, $type );

		if( ! empty( $this_post ) ):
			return $this_post->ID;
		endif;

		return false;
	}


}