<?php

namespace MedusaContentSuite\Config;

use MedusaContentSuite\Functions\Callbacks as Callbacks;
use MedusaContentSuite\Functions\Common as Common;


#convertYML

class TaxMetaConfig
{
	public $taxMetaConfig;
	#public $taxMetaConfigByType;
	public $taxMetaConfigLoc = "";

	public function __construct()
	{
		$this->taxMetaConfigLoc = $this->getTaxMetaConfigLoc( );
		#write_log( $this->taxMetaConfigLoc );
	}

	public function getTaxMetaConfigLoc()
	{
		$loc = plugin_dir_path( __FILE__ ) . 'data' . '/' . 'tax_meta.php';
		return $loc;
	}

	public function setTaxMetaConfig()
	{
		#write_log( "TaxMetaConfig > setTaxMetaConfig" );

		#Common::write_log( "yyyyyyyyyyyyyyyyyyy----------" . $this->taxMetaConfigLoc );

		#Common::write_log( file_exists( $this->taxMetaConfigLoc ) );

		if( file_exists( $this->taxMetaConfigLoc ) ) :

			$Callbacks = new Callbacks();

			//$Common = new Common;

			#Common::write_log( "loc - " . $this->taxMetaConfigLoc );

			#$config = $Common::convertYML( $this->taxMetaConfigLoc );

			$config = require_once( $this->taxMetaConfigLoc );

			#Common::write_log( $config );

			#$config = $config;

			$this->taxMetaConfig = $config;

		endif;

	}


}