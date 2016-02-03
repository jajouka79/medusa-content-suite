<?php
namespace MedusaContentSuite\CMB\Loaders;

use MedusaContentSuite\MedusaContentSuite as MedusaContentSuite;



class CMBLoader
{
	public $vendorPath = false;
	public $cmbPath = false;

	public function __construct( )
	{		
		add_action( 'init', array( $this, 'loadCMB' ), 20 );
	}

	public function loadCMB( )
	{		
		#write_log("CMB2Loader > loadCMB");
		if ( ! defined( 'CMB2_LOADED' ) ) :
			#write_log("CMB2 NOT LOADED");
			
			$MedusaContentSuite = new MedusaContentSuite;
			$activeVendorPath = $MedusaContentSuite->getActiveVendorPath();
			$this->setCmbPath( $activeVendorPath );

			$vendorPath = $this->vendorPath;
			#write_log ( "loadCMB - vendorPath - " . $vendorPath );

			require_once( $this->cmbPath );

			#wp_dequeue_script( 'cmb2-scripts' );
		endif;

	}

	public function setCmbPath( $vendorPath )
	{
		if ( file_exists( $vendorPath . '/WebDevStudiosXXX/CMB2/init.php' ) ) :
			#$cmbPath = $vendorPath . '/WebDevStudiosXXX/CMB2/init.php';
			#write_log( "vendorPath - " . $vendorPath );
			$cmbPath = $vendorPath . '/WebDevStudiosXXX/CMB2/init.php';
			$this->cmbPath = $cmbPath;
			#write_log( "cmb path - " . $cmbPath );
		endif;
	}
}

