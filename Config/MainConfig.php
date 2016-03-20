<?php

namespace MedusaContentSuite\Config;

use MedusaContentSuite\Functions\Common as Common;
use MedusaContentSuite\Config\Globals as Globals;

class MainConfig
{
	public $mainConfigLoc = "";
	public $mainConfig;

	public function __construct()
	{
		$this->setMainConfigLoc( );
		$this->setMainConfig( );
	}


	public function setMainConfigLoc()
	{
		$loc = Globals::$activeConfigLoc . '/' . 'main.php';
		$this->mainConfigLoc = $loc;	
	}


	public function setMainConfig( )
	{
		if( file_exists( $this->mainConfigLoc ) ) :
			$config = require_once( $this->getMainConfigLoc( ) );
			$this->mainConfig = $config;
		endif;
	}

	
	public function getMainConfig( )
	{		
		return $this->mainConfig;
	}

		
	public function getMainConfigLoc( )
	{		
		return $this->mainConfigLoc;
	}
	
}