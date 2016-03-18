<?php

namespace MedusaContentSuite\Config;

use MedusaContentSuite\Functions\Common as Common;
use MedusaContentSuite\Config\Globals as Globals;
use MedusaContentSuite\Config\Paths as Paths;


class Paths extends \MedusaContentSuite\Config\Globals
{

	public function __construct( )
	{

		#Paths config first
		self::setPackageVendorPath( );
		self::setActiveVendorPath( );
		self::setCmbPath( );

	    self::setConfigLoc( );
	    self::setRootConfigLoc( );

		#Common::write_log( self::$Globals );
		
	}


	public function setConfigLoc( )
	{
		$path = plugin_dir_path( __FILE__ ) . 'data';
		parent::$configLoc = $path;
	}


	public static function getConfigLoc( )
	{
		return parent::$configLoc;
	}


	public function setRootConfigLoc( ) #ROOT_DIR is custom constant in bedrock
	{
		if( defined( 'ROOT_DIR' ) ) :    
			if( ! empty( ROOT_DIR ) ) :
				$loc = ROOT_DIR . '/mcs-config';
				if( file_exists( $loc ) ) : 
					Common::write_log( "mcs-config EXISTS!!!!" );
					parent::$rootConfigLoc = $loc;

				endif;
			endif;
		endif;
	}




	public function setActiveConfigLoc( )
	{
		#parent::$activeVendorPath = parent::$packageVendorPath;
	}




	public static function getRootConfigLoc( )
	{
		return parent::$rootConfigLoc;
	}


	public function setCmbPath( )
	{
		if ( file_exists( parent::$activeVendorPath . '/WebDevStudiosXXX/CMB2/init.php' ) ) :
			parent::$cmbPath = parent::$activeVendorPath . '/WebDevStudiosXXX/CMB2/init.php';
		endif;
	}


	public static function checkRootConfigLocExists( )
	{
		if( file_exists( parent::$rootConfigLoc ) ) :
			return true;
		else:
			return false;
		endif;
	}


	public function setPackageVendorPath( )
	{

		$path = plugin_dir_path( __FILE__ ) . "vendor";
		$path = str_replace( "/Config", "", $path );
		parent::$packageVendorPath = $path;
	}


	public function checkPackageVendorPath( )
	{
		if( ! file_exists( parent::$packageVendorPath ) ) : 
			throw new \Exception( "Medusa Content Suite - can't find vendor directory" );
		else :
			parent::$packageVendorPathExists = true;				
		endif;		
	}


	public function setActiveVendorPath( )
	{
		parent::$activeVendorPath = parent::$packageVendorPath;
	}



	public static function getActiveVendorPath( )
	{
		return parent::$activeVendorPath;
	}



	public static function getCmbPath( )
	{
		return parent::$cmbPath;
	}




	/*

	#for YAML

	public static function getThisPluginPath( $excPath = "/CMB/Meta" )
	{
		$path = plugin_dir_path( __FILE__ );
		$path = str_replace( $excPath, '', $path );		
		return $path;
	}
	*/


}