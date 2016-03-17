<?php

namespace MedusaContentSuite\Config;

use MedusaContentSuite\Functions\Common as Common;

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
		$loc = plugin_dir_path( __FILE__ ) . 'data' . '/' . 'tax.php';
		return $loc;
	}


	public function setTaxConfig( )
	{
		if( file_exists( $this->taxConfigLoc ) ) :		
			$config = require_once( $this->taxConfigLoc );
			$this->taxConfig = $config;
		endif;
	}


}