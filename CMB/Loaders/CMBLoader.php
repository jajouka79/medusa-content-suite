<?php
namespace MedusaContentSuite\CMB\Meta;

class CMBLoader
{
	public $vendorPath;

	public function init( )
	{
		write_log( "CMBLoader - init" );

		if ( ! defined( 'CMB2_LOADED' ) ) :
			write_log("CMB2 NOT LOADED");
			$this->loadCMB2();
		else:
			write_log("CMB2_LOADED");
		endif;		
	}

	public function loadCMB2( )
	{		
		write_log("CMB2Loader > loadCMB2");

		$this->setVendorPath( );
	}

	public function setVendorPath( $path )
	{
		write_log("CMB2Loader > setVendorPath");

		if( file_exists( "vendor/WebDevStudiosXXX" ) ) :

			write_log("vendor/WebDevStudiosXXX");
		
		else:
			write_log("vendor/WebDevStudiosXXX does not exist");

		endif;

		$this->vendorPath = "dir";		
	}
}

