<?php

namespace MedusaContentSuite\Config;

use MedusaContentSuite\Functions\Common as Common;
use MedusaContentSuite\Config\Globals as Globals;

class MenuConfig
{
	public $menuConfig;
	public $menuConfigLoc = "";

	public function __construct( )
	{
		$this->setMenuConfigLoc( );
		$this->setMenuConfig( );
	}


	public function setMenuConfigLoc( )
	{
		$loc = Globals::$activeConfigLoc . '/' . 'menu.php';
		$this->menuConfigLoc = $loc;
	}


	public function setMenuConfig( )
	{
		if( file_exists( $this->menuConfigLoc ) ) :
			$config = require_once( $this->getMenuConfigLoc( ) );
			$this->menuConfig = $config;
		endif;
	}

	
	public function getMenuConfig( )
	{		
		return $this->menuConfig;
	}

	
	public function getMenuConfigLoc( )
	{		
		return $this->menuConfigLoc;
	}
	

}