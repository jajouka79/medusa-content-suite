<?php

namespace MedusaContentSuite\Config;

class PostConfig
{	
	public $postConfig;
	public $postConfigLoc = "";

	public function __construct( )
	{
		#add_action( 'init', array( $this, 'getPostConfig' ), 1 );
		#do_action( 'init', $newPt );

		$this->postConfigLoc = $this->getPostConfigLoc( );
		#write_log( $this->postConfigLoc );
	}

	public function getPostConfigLoc()
	{
		$loc = plugin_dir_path( __FILE__ ) . 'data' . '/' . 'post.php';
		return $loc;
	}

	public function setPostConfig( )
	{
		#write_log( "xxxxxxxxxxxxxxxxxxxxxxx----------" . $this->postConfigLoc );


		#Common::write_log( file_exists( $this->postConfigLoc ) );

		if( file_exists( $this->postConfigLoc ) ) :		

			$config = require_once( $this->postConfigLoc );
			#write_log( $config );

			$this->postConfig = $config;

		endif;
	}

	static function getConfigByPt( $pt )
	{
		
		
		
		return $ptConfig;

	}




}