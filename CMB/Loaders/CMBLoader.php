<?php
namespace MedusaContentSuite\CMB\Loaders;

class CMBLoader
{
	public $projectVendorPath = "/var/www/bedrock-test1/vendor";
	public $vendorPath;

	public function init( )
	{
		#write_log( "CMBLoader - init" );

		if ( ! defined( 'CMB2_LOADED' ) ) :
			write_log("CMB2 NOT LOADED");
			$this->loadCMB();
		else:
			write_log("CMB2_LOADED");
		endif;		
	}

	public function loadCMB( )
	{		
		#write_log("CMB2Loader > loadCMB");

		$this->setVendorPath( );
		$vendorPath = $this->vendorPath;
		
		write_log( "vendorPath-------------" . $vendorPath );

		if ( file_exists(  $vendorPath . '/cmb2/init.php' ) ) :
			write_log( "111" );
			require_once  $vendorPath . '/cmb2/init.php';
		elseif ( file_exists(  $vendorPath . '/CMB2/init.php' ) ) :
			write_log( "222" );
			require_once  $vendorPath . '/CMB2/init.php';
		endif;

		if ( ! defined( 'CMB2_LOADED' ) ) :
			write_log("CMB2 NOT LOADED");
		else:
			write_log("CMB2_LOADED");
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
			write_log( $localVendorPath . "/WebDevStudiosXXX - DOES NOT EXIST" );
			if( file_exists( $this->projectVendorPath ) ) :
				$vendorPath = $this->projectVendorPath;
			else :
				$this->vendorPath = false;
			endif;
		endif;

		$this->vendorPath = $vendorPath;		
	}
}

