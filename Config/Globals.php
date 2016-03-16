<?php

namespace MedusaContentSuite\Config;

use MedusaContentSuite\Functions\Common as Common;

class Globals extends \MedusaContentSuite\MedusaContentSuite{

	public $rootConfigLoc;
	public $configLoc;
	public $postConfig;
	public $postMetaConfig;
	public $taxConfig;
	public $taxMetaConfig;

	public $cmbLoaded = false;

	public $activeVendorPath;
	#public $projectVendorPath;
	public $packageVendorPath;

	public $cmbPath;

	public function __construct( )
	{
		#Common::write_log( "GLOBALS - __construct");
		$this->setStaticVariables( );
	}

	public function setStaticVariables()
	{
	    $this->setConfigLoc( );
	    $this->setRootConfigLoc( );
    	$this->setPostConfig( );
    	$this->setPostMetaConfig( );
		$this->setPackageVendorPath( );
		$this->setActiveVendorPath( );
		$this->setCmbPath( );
	}


	/*
	public static function getVendorPath( )
	{
		$path = plugin_dir_url( __FILE__ ) . "vendor";
		#write_log( 'getVendorPath( ) ---' . $path );
		return $path;
	}
	*/


	public function setCmbPath( )
	{
		if ( file_exists( $this->activeVendorPath . '/WebDevStudiosXXX/CMB2/init.php' ) ) :
			$this->cmbPath = $this->activeVendorPath . '/WebDevStudiosXXX/CMB2/init.php';
		endif;
	}

	public function setPostConfig( )
	{
		$PostConfig = new PostConfig;
		$PostConfig->setPostConfig( );
		$PostConfig = $PostConfig->postConfig;
		$this->postConfig = $PostConfig;
	}

	public function getPostConfig( )
	{
		return $this->postConfig;
	}

	public function setPostMetaConfig( )
	{
		$PostMetaConfig = new PostMetaConfig;
		$PostMetaConfig->setPostMetaConfig( );
		$PostMetaConfig = $PostMetaConfig->postMetaConfig;
		$this->postMetaConfig = $PostMetaConfig;
	}

	public function getPostMetaConfig( )
	{
		return $this->postMetaConfig;
	}

	public function getTaxConfig()
	{
		$TaxConfig = new TaxConfig;
		$TaxConfig = $TaxConfig->getTaxConfig();
		return $TaxConfig;
	}


	public function setConfigLoc( )
	{
		$loc = plugin_dir_path( __FILE__ ) . 'data';
		$this->configLoc = $loc;

	}


	public function setRootConfigLoc( )
	{
		if( defined( 'ROOT_DIR' ) ) :    
			if( ! empty( ROOT_DIR ) ) :
				$loc = ROOT_DIR . '/mcs-config';
				$this->rootConfigLoc = $loc;
			endif;
		endif;
	}


	public function checkRootConfigLocExists( )
	{
		if( file_exists( $this->rootConfigLoc ) ) :
			return true;
		else:
			return false;
		endif;
	}


	public function setPackageVendorPath( )
	{
		$path = plugin_dir_path( __FILE__ ) . "vendor";
		$path = str_replace( "/Config", "", $path );
		$this->packageVendorPath = $path;
	}

	public function checkPackageVendorPath( )
	{
		Common::write_log( "this->packageVendorPath" );

		Common::write_log( $this->packageVendorPath );

		if( ! file_exists( $this->packageVendorPath ) ) : 
			throw new \Exception( "Medusa Content Suite - can't find vendor directory" );
		else :
			$this->packageVendorPathExists = true;				
		endif;		
	}


	public function setActiveVendorPath( )
	{
		$this->activeVendorPath = $this->packageVendorPath;
	}


	public function getActiveVendorPath( )
	{
		return $this->activeVendorPath;
	}



}