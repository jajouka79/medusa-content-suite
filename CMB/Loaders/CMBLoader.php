<?php
namespace MedusaContentSuite\CMB\Loaders;

use MedusaContentSuite\Functions\Common as Common;

class CMBLoader
{
	public $cmbPath = false;
	public $Globals;

	public function __construct( $Globals )
	{		
		$this->Globals = $Globals;
		$this->loadCMB( );
	}

	public function checkCmbPathExists( )
	{
		if ( file_exists( $this->Globals->cmbPath ) ) :
			return true;
		endif;
	}


	public function loadCMB( )
	{	
		if ( ! defined( 'CMB2_LOADED' ) ) :

			if( $this->checkCmbPathExists( $this->Globals->cmbPath ) ) : # && ( 2 == 4 )
				require_once( $this->Globals->cmbPath );
				$this->Globals->cmbLoaded = 1;
			endif;

		endif;
	}

	public function getCmbLoaded( )
	{
		return true;
	}


	public function getCmbPath()
	{
		return $this->cmbPath;
	}

}
