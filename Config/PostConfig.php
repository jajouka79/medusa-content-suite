<?php

namespace MedusaContentSuite\Config;

use MedusaContentSuite\Functions\Common as Common;
use MedusaContentSuite\Config\Globals as Globals;

class PostConfig
{	
	public $postConfig;
	public $postConfigLoc = "";

	public function __construct( )
	{
		$this->postConfigLoc = $this->getPostConfigLoc( );
	}


	public function getPostConfigLoc( )
	{
		$loc = Globals::$activeConfigLoc . '/' . 'post.php';
		return $loc;
	}


	public function setPostConfig( )
	{
		if( file_exists( $this->postConfigLoc ) ) :		
			$config = require_once( $this->postConfigLoc );
			$this->postConfig = $config;
		endif;
	}


	static function getConfigByPt( $pt )
	{		
		return $ptConfig;
	}

}