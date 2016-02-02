<?php
namespace MedusaContentSuite\CMB\Loaders;

use MedusaContentSuite\MedusaContentSuite as MedusaContentSuite;

class CMBLoader
{
	public $vendorPath = false;
	public $cmbPath = false;

	public function init( )
	{
		write_log( "CMBLoader - init" );
		#$this->setCmbPath( MedusaContentSuite::getVendorPath() );
		$MedusaContentSuite = new MedusaContentSuite;
		$activeVendorPath = $MedusaContentSuite->getActiveVendorPath();

		write_log( "activeVendorPath - " . $activeVendorPath );
		
		$this->setCmbPath( $activeVendorPath );

		if ( ! defined( 'CMB2_LOADED' ) ) :
			#write_log("CMB2 NOT LOADED");
			$this->loadCMB( );
			write_log( $this->vendorPath );
		endif;
	}

	public function loadCMB( )
	{		
		write_log("CMB2Loader > loadCMB");
		
		$vendorPath = $this->vendorPath;
		#write_log ( "loadCMB - vendorPath - " . $vendorPath );

		write_log("CMB2Loader > loadCMB");		
		require_once( $this->cmbPath );

	}

	public function setCmbPath( $vendorPath )
	{
		if ( file_exists( $vendorPath . '/WebDevStudiosXXX/CMB2/init.php' ) ) :
			#$cmbPath = $vendorPath . '/WebDevStudiosXXX/CMB2/init.php';
			write_log( "vendorPath - " . $vendorPath );
			$cmbPath = $vendorPath . '/WebDevStudiosXXX/CMB2/init.php';
			$this->cmbPath = $cmbPath;
			write_log( "cmb path - " . $cmbPath );
		endif;
	}
}

