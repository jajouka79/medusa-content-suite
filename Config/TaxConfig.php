<?php

namespace MedusaContentSuite\Config;

use MedusaContentSuite\Functions\Common as Common;
use MedusaContentSuite\Config\Globals as Globals;

class TaxConfig
{	
	public $taxConfig;
	public $taxConfigLoc = "";

	public function __construct( )
	{
		$this->taxConfigLoc = $this->getTaxConfigLoc( );
	}

	public function getTaxConfigLoc()
	{
		$loc = Globals::$activeConfigLoc . '/' . 'tax.php';
		return $loc;
	}

	/*
	public function getTaxConfigLocByTaxName()
	{
		$taxConfig = Globals::
		#$config = Globals::$activeConfigLoc . '/' . 'tax.php';
		return $config;
	}
	*/

	public function setTaxConfig( )
	{
		if( file_exists( $this->taxConfigLoc ) ) :		
			$config = require_once( $this->taxConfigLoc );
			$this->taxConfig = $config;
		endif;
	}


}