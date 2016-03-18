<?php
namespace MedusaContentSuite\CMB\Loaders;

use MedusaContentSuite\Functions\Common as Common;
use MedusaContentSuite\Config\Globals as Globals;
use MedusaContentSuite\Config\Paths as Paths;

class CMBLoader
{

	public function __construct( )
	{				
		$this->loadCMB( );
	}


	public function checkCmbPathExists( )
	{
		if ( file_exists( Paths::getCmbPath( ) ) ) :
			return true;
		endif;
	}


	public function loadCMB( )
	{	
		if ( ! defined( 'CMB2_LOADED' ) ) :

			if( $this->checkCmbPathExists( Paths::getCmbPath( ) ) ) : # && ( 2 == 4 )
				require_once( Paths::getCmbPath() );
				#$this->Globals->cmbLoaded = 1;
			endif;

		endif;
	}



}
