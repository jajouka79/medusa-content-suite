<?php

namespace MedusaContentSuite\Config;
 
class MainConfig
{
	public $mainConfigLoc = "";
	public $mainConfig;

	public function __construct()
	{
		$this->mainConfigLoc = $this->getMainConfigLoc( );
		#write_log( "---------------MainConfig - __construct - this->mainConfigLoc - " );
		#write_log( $this->mainConfigLoc );
	}



	public function getMainConfig( )
	{
		#write_log( "getMainConfig() - loc - " );

		#write_log( $this->mainConfigLoc );
		
		if( file_exists( $this->mainConfigLoc ) ) :

			$config = require_once( $this->mainConfigLoc );

			#Common::write_log( $config );

			$this->mainConfig = $config;

			/*write_log( 'config:' );
			write_log( $config );*/

		endif;

	}


	public function getMainConfigLoc()
	{
		$loc = plugin_dir_path( __FILE__ ) . 'data' . '/' . 'main.php';
		return $loc;
	}

}