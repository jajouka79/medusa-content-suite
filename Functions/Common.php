<?php

namespace MedusaContentSuite\Functions;

class Common
{
	public function __construct()
	{
		add_action('init', array($this, 'getCommonFunctions'), 1);##very early priority
	}


	public static function convertYML( $file )
	{
		//$PostConfig = new PostConfig();
		//$PostConfig = $PostConfig->getPostConfig();
			
		$path = Paths::getThisPluginPath( "/Paths" ) . '/PostMetaConfig.yml';

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
}