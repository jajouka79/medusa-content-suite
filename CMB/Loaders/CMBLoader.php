<?php
namespace MedusaContentSuite\CMB\Loaders;

class CMBLoader
{
	#public $projectVendorPath = "/var/www/bedrock-test1/vendor";
	public $projectVendorPath = "/home/sbeasley/Sites/bedrock-test1/vendor";
	#public $projectVendorPath = "http://bedrock-test1.local/vendor";
	public $vendorPath = false;

	public function init( )
	{
		#write_log( "CMBLoader - init" );
		#write_log( $MedusaContentSuite->$vendorPath );

		$this->setCmbPath( );

		if ( ! defined( 'CMB2_LOADED' ) ) :
			#write_log("CMB2 NOT LOADED");
			$this->loadCMB( );
		endif;			

	}

	public function loadCMB( )
	{		
		#write_log("CMB2Loader > loadCMB");
		
		$vendorPath = $this->vendorPath;
		#write_log ( "loadCMB - vendorPath - " . $vendorPath );

		if ( file_exists( $vendorPath . '/WebDevStudiosXXX/cmb2/init.php' ) ) :
			require_once  $vendorPath . '/WebDevStudiosXXX/cmb2/init.php';
		elseif ( file_exists( $vendorPath . '/WebDevStudiosXXX/CMB2/init.php' ) ) :
			require_once  $vendorPath . '/WebDevStudiosXXX/CMB2/init.php';
		endif;
	}

	public function setCmbPath( )
	{
		$filePath = plugin_dir_path( __FILE__ );
		$pluginPath = str_replace( "/CMB/Loaders", "", $filePath );
		$packageVendorPath = $pluginPath . "vendor";

		$vendorPath = false;
		
		if( file_exists( $packageVendorPath . "/WebDevStudiosXXX" ) ) :
			$vendorPath = $packageVendorPath;		
		else :
		    write_log("Medusa Content Suite - packageVendorPath path not available");
			#TODO
			/*
			if( file_exists( $this->projectVendorPath ) ) :
				$vendorPath = $this->projectVendorPath;
			else :
				$this->vendorPath = false;
			endif;
			*/
		endif;

		#write_log( $packageVendorPath . "/WebDevStudiosXXX" );
		#write_log( $this->projectVendorPath . "/WebDevStudiosXXX" );

		$this->vendorPath = $vendorPath;		
	}
}

