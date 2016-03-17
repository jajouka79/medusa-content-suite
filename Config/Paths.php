<?php

namespace MedusaContentSuite\Config;

use MedusaContentSuite\Functions\Common as Common;

class Paths
{

	public static $Globals;

	public function __construct( $Globals )
	{
		self::$Globals = $Globals;
		#Common::write_log( "Paths - Globals" );
		#Common::write_log( self::$Globals );

		#Paths config first
		$this->setPackageVendorPath( );
		$this->setActiveVendorPath( );
		$this->setCmbPath( );

	    $this->setConfigLoc( );
	    $this->setRootConfigLoc( );

		#Common::write_log( self::$Globals );
		
	}


	public function setConfigLoc( )
	{
		$loc = self::$Globals->activeVendorPath . 'data';
		self::$Globals->configLoc = $loc;
		#Common::write_log( self::$Globals->configLoc );
	}


	public function setRootConfigLoc( )
	{
		if( defined( 'ROOT_DIR' ) ) :    
			if( ! empty( ROOT_DIR ) ) :
				$loc = ROOT_DIR . '/mcs-config';
				self::$Globals->rootConfigLoc = $loc;
			endif;
		endif;
	}


	public function setCmbPath( )
	{
		if ( file_exists( self::$Globals->activeVendorPath . '/WebDevStudiosXXX/CMB2/init.php' ) ) :
			self::$Globals->cmbPath = self::$Globals->activeVendorPath . '/WebDevStudiosXXX/CMB2/init.php';
		endif;
	}


	public static function checkRootConfigLocExists( )
	{
		if( file_exists( self::$Globals->rootConfigLoc ) ) :
			return true;
		else:
			return false;
		endif;
	}


	public function setPackageVendorPath( )
	{
		$path = plugin_dir_path( __FILE__ ) . "vendor";
		$path = str_replace( "/Config", "", $path );
		self::$Globals->packageVendorPath = $path;
	}


	public function checkPackageVendorPath( )
	{
		/*Common::write_log( "self::Globals->packageVendorPath" );
		Common::write_log( self::$Globals->packageVendorPath );*/

		if( ! file_exists( self::$Globals->packageVendorPath ) ) : 
			throw new \Exception( "Medusa Content Suite - can't find vendor directory" );
		else :
			self::$Globals->packageVendorPathExists = true;				
		endif;		
	}


	public function setActiveVendorPath( )
	{
		self::$Globals->activeVendorPath = self::$Globals->packageVendorPath;
	}


	public function getActiveVendorPath( )
	{
		return self::$Globals->activeVendorPath;
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