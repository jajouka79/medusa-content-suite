<?php

namespace MedusaContentSuite\Config;

use MedusaContentSuite\Functions\Common as Common;

class MenuConfig
{
	public $menuConfig;
	public $menuConfigLoc = "";

	public function __construct( )
	{
		$this->getMenuConfigLoc( );
		$this->setMenuConfig( );
	}

	public function getMenuConfigLoc()
	{
		$loc = plugin_dir_path( __FILE__ ) . 'data' . '/' . 'menu.php';
		$this->menuConfigLoc = $loc;
		#return $loc;
	}

	public function setMenuConfig( )
	{
		#Common::write_log( $this->menuConfigLoc  ) ;

		if( file_exists( $this->menuConfigLoc ) ) :
			Common::write_log( "!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!" ) ;
			$config = require_once( $this->menuConfigLoc );  
			$this->menuConfig = $config;
		endif;

		#Common::write_log( $this->menuConfig );
	}

	/*
	public function getMenuConfig()
	{		
		Common::write_log( $this->menuConfig );
		return $this->menuConfig;
	}
	*/

}