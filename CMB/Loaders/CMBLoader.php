<?php
namespace MedusaContentSuite\CMB\Loaders;

use MedusaContentSuite\Functions\Common as Common;

class CMBLoader
{
	public $vendorPath = false;
	public $cmbPath = false;
	public $Globals;


	public function __construct( $Globals )
	{		
		$this->Globals = $Globals;
		$this->loadCMB( );
	}


	public function loadCMB( )
	{	
		if ( ! defined( 'CMB2_LOADED' ) ) :
			require_once( $Globals->cmbPath );
			Common::write_log( );
		endif;
	}


	public function getCmbPath()
	{
		return $this->cmbPath;
	}

}
