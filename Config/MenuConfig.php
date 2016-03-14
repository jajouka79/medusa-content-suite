<?php

namespace MedusaContentSuite\Config;

use MedusaContentSuite\Functions\Common as Common;

class MenuConfig
{
	public $menuConfig;
	public $menuConfigLoc = "";

	public function __construct( )
	{
		#add_action( 'init', array( $this, 'getMenuConfig' ), 1 );
		$this->menuConfigLoc = $this->getMenuConfigLoc( );
		$this->menuConfig = $this->setMenuConfig( );
	}

	public function getMenuConfigLoc()
	{
		$loc = plugin_dir_path( __FILE__ ) . 'data' . '/' . 'menu.php';
		return $loc;
	}

	public function setMenuConfig( )
	{
		#Common::write_log( $this->menuConfigLoc  ) ;

		if( file_exists( $this->menuConfigLoc ) ) :
			$config = require_once( $this->menuConfigLoc );
			#Common::write_log ( $config );  
			$this->menuConfig = $config;
		endif;

		#Common::write_log( $this->menuConfig );
	}

/*	public function getMenuConfig()
	{		
		Common::write_log( $this->menuConfig );
		return $this->menuConfig;
	}*/

}