<?php
namespace MedusaContentSuite\CMB\Loaders;

class CMBLoader
{
	#public $projectVendorPath = "/var/www/bedrock-test1/vendor";
	#public $projectVendorPath = "/home/sbeasley/Sites/bedrock-test1/vendor";
	public $projectVendorPath = "http://bedrock-test1.local/vendor";

	

	public $vendorPath;

	public function init( )
	{
		#write_log( "CMBLoader - init" );
/*	write_log ("ABSPATH - " . ABSPATH );


		write_log( '\get_template_directory_uri() - ' . \get_template_directory_uri());
*/
		if ( ! defined( 'CMB2_LOADED' ) ) :
			#write_log("CMB2 NOT LOADED");
			$this->loadCMB();
		else:
			#write_log("CMB2_LOADED");
		endif;		
	}

	public function loadCMB( )
	{		
		#write_log("CMB2Loader > loadCMB");

		$this->setVendorPath( );
		$vendorPath = $this->vendorPath;
		#write_log ( "loadCMB - vendorPath - " . $vendorPath );


		if ( file_exists( $vendorPath . '/WebDevStudiosXXX/cmb2/init.php' ) ) :
			require_once  $vendorPath . '/WebDevStudiosXXX/cmb2/init.php';
		elseif ( file_exists( $vendorPath . '/WebDevStudiosXXX/CMB2/init.php' ) ) :
			require_once  $vendorPath . '/WebDevStudiosXXX/CMB2/init.php';
		endif;

		if ( ! defined( 'CMB2_LOADED' ) ) :
			#write_log("CMB2 NOT LOADED");
		else:
			#write_log("CMB2_LOADED");
		endif;	
	}

	public function setVendorPath( )
	{
		$filePath = plugin_dir_path( __FILE__ );
		$pluginPath = str_replace( "/CMB/Loaders", "", $filePath );
		$localVendorPath = $pluginPath . "vendor";
		
		if( file_exists( $localVendorPath . "/WebDevStudiosXXX" ) ) :
			$vendorPath = $localVendorPath;		
		else :
			if( file_exists( $this->projectVendorPath ) ) :
				$vendorPath = $this->projectVendorPath;
			else :
				$this->vendorPath = false;
			endif;
		endif;

		write_log( $localVendorPath . "/WebDevStudiosXXX" );
		write_log( $this->projectVendorPath . "/WebDevStudiosXXX" );

		$this->vendorPath = $vendorPath;		
	}
}

