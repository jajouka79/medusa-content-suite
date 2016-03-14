<?php

namespace MedusaContentSuite\Functions;

use MedusaContentSuite\Paths as Paths;
#use Symfony\Component\Yaml as Yaml;

class Common
{
	public function __construct()
	{
		add_action('init', array( $this, 'getCommonFunctions'), 1);##very early priority
		add_action( 'plugins_loaded', array( $this, 'checkPluginActive'), 1, 1 );

		#do_action( 'plugins_loaded', $param1, $param2 );
	}


	public static function convertYML( $path )
	{
		//$PostConfig = new PostConfig();
		//$PostConfig = $PostConfig->getPostConfig();
			
		#$path = Paths::getThisPluginPath( "/Paths" ) . '/PostMetaConfig.yml';

		#return;

		if( file_exists ( $path ) ) :

			#write_log( '--------------' );
			#write_log( $path );
			$contents = file_get_contents( $path ) ;

			if ( ! empty( $contents ) ) :
				#write_log( 'contents--------------'.$contents );
				$array = Yaml::parse( $contents );
				#write_log( Yaml::dump( $array ) );
				#write_log( $array );
			endif;

		endif;

		return $PostConfig;
	}


	public function getCommonFunctions()
	{
		include "medusa_resources_common_functions.php";
	}


	public static function write_log( $log ){

		if ( true === WP_DEBUG ) {
			if ( is_array( $log ) || is_object( $log ) ) {
				error_log( print_r( $log, true ) );
			} else {
			error_log( $log );
			}
		}
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
}