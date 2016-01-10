<?php
namespace MedusaContentSuite\CMB\Meta;

class CMBLoader
{
	public $vendorPath;

	public function init( )
	{
		write_log( "FieldTypeLoader - init" );

		if ( ! defined( 'CMB2_LOADED' ) ) :
			write_log("CMB2 NOT LOADED");
			$this->loadCMB2();
		else:
			write_log("CMB2_LOADED");
		endif;		
	}


	public function loadFieldTypes( )
	{		
		write_log("FieldTypeLoader > loadFieldTypes");

		$this->vendorPath = "dir";		
		
	}
}

