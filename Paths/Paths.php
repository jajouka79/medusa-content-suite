<?php

namespace MedusaContentSuite\Paths;

class Paths{

	public static function getThisPluginPath( $excPath = "/CMB/Meta" ){

		#write_log( $excPath );

		$path = plugin_dir_path( __FILE__ );
		$path = str_replace( $excPath, '', $path );		
		return $path;
	}

	public static function checkThisPluginPath( ){

		if( file_exists ( self::getThisPluginPath() ) ) :
			return true;
		else:
			return false;
		endif;
	}

}