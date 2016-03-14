<?php

namespace MedusaContentSuite\Config;

use MedusaContentSuite\Functions\Callbacks as Callbacks;
use MedusaContentSuite\Functions\Common as Common;


#convertYML

class PostMetaConfig
{
	public $postMetaConfig;
	#public $postMetaConfigByType;
	public $postMetaConfigLoc = "";

	public function __construct()
	{
		$this->postMetaConfigLoc = $this->getPostMetaConfigLoc( );
		#write_log( $this->postMetaConfigLoc );
	}

	public function getPostMetaConfigLoc()
	{
		$loc = plugin_dir_path( __FILE__ ) . 'data' . '/' . 'post_meta.php';
		return $loc;
	}

	public function setPostMetaConfig()
	{
		#write_log( "PostMetaConfig > setPostMetaConfig" );

		#Common::write_log( "yyyyyyyyyyyyyyyyyyy----------" . $this->postMetaConfigLoc );

		#Common::write_log( file_exists( $this->postMetaConfigLoc ) );

		if( file_exists( $this->postMetaConfigLoc ) ) :

			$Callbacks = new Callbacks();

			//$Common = new Common;

			#Common::write_log( "loc - " . $this->postMetaConfigLoc );

			#$config = $Common::convertYML( $this->postMetaConfigLoc );

			$config = require_once( $this->postMetaConfigLoc );

			#Common::write_log( $config );

			#$config = $config;

			$this->postMetaConfig = $config;

		endif;

	}


}