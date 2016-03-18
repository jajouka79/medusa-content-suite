<?php

namespace MedusaContentSuite\Config;

use MedusaContentSuite\Functions\Common as Common;

class Paths extends \MedusaContentSuite\Config\Globals
{


	public function __construct( )
	{

		Common::write_log( "Paths - __construct - parent -----" );

		/*self::testfunk();
		
		return;*/

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
		#$path = str_replace( "/Config", "", $path );
		#parent::$packageVendorPath = $path;

		/*Common::write_log( "setConfigLoc( )" );
		Common::write_log( "path - " . $path );*/

		parent::$configLoc = $path;

		/*
		$loc = getcwd() . '/data';

		if( file_exists( $loc ) ) :
			parent::$configLoc = $loc;
			Common::write_log( parent::$configLoc );
		else:
			throw new  \Exception("configLoc path missing", 1);
		endif;
		*/


	}


	public function setRootConfigLoc( ) #ROOT_DIR is custom constant in bedrock
	{
		if( defined( 'ROOT_DIR' ) ) :    
			if( ! empty( ROOT_DIR ) ) :
				$loc = ROOT_DIR . '/mcs-config';
				parent::$rootConfigLoc = $loc;
			endif;
		endif;
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
		#Common::write_log( "setPackageVendorPath( )" );

		#Common::write_log( self::$Globals );

		$path = plugin_dir_path( __FILE__ ) . "vendor";
		$path = str_replace( "/Config", "", $path );
		parent::$packageVendorPath = $path;
	}


	public function checkPackageVendorPath( )
	{
		/*Common::write_log( "self::Globals->packageVendorPath" );
		Common::write_log( parent::$packageVendorPath );*/

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


	public function getActiveVendorPath( )
	{
		return parent::$activeVendorPath;
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