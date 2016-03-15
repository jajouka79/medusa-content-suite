<?php

namespace MedusaContentSuite\Config;
use MedusaContentSuite\Functions\Common as Common;

class PostConfig
{	
	public $postConfig;
	public $postConfigLoc = "";


	public function __construct( )
	{
		$this->postConfigLoc = $this->getPostConfigLoc( );
	}


	public function getPostConfigLoc()
	{
		$loc = plugin_dir_path( __FILE__ ) . 'data' . '/' . 'post.php';
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