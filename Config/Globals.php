<?php

namespace MedusaContentSuite\Config;

##names space includes needed?
use MedusaContentSuite\Functions\Common as Common;
use MedusaContentSuite\Config\Paths as Paths;
use MedusaContentSuite\Config\MenuConfig as MenuConfig;
use MedusaContentSuite\CMB\Loaders\FieldTypeLoader as FieldTypeLoader;
use MedusaContentSuite\CMB\Loaders\CMBLoader as CMBLoader;

class Globals extends \MedusaContentSuite\MedusaContentSuite
{
	public $postConfig;
	public static $postConfigStatic;
	public $postMetaConfig;
	public static $postMetaConfigStatic;
	public $taxConfig;
	public $taxMetaConfig;

	public $fieldTypes;
	public $menuConfig;

	#public $cmbLoaded = false;

	public static $activeVendorPath;
	#public $projectVendorPath;
	public static $packageVendorPath;
	public static $cmbPath;

	public static $rootConfigLoc;
	public static $configLoc;

	public static $activeConfigLoc;

	public function __construct( )
	{
		#Common::write_log( "GLOBALS - __construct");
		$this->callSetters( );
	}


	public function callSetters()
	{
		$this->setPaths( );
    	$this->setMainConfig( );

	    #Content config
    	$this->setPostConfig( );
    	$this->setPostMetaConfig( );

    	$this->setTaxConfig( );
    	$this->setTaxMetaConfig( );

    	$this->setMenuConfig( );
		$this->setFieldTypes( );
	}


	public static function loadCMB( )
	{
		/*if ( ! defined( 'CMB2_LOADED' ) ) :
		Common::write_log( "CMB2 NOT LOADED" );
		else :
		Common::write_log( "CMB2_LOADED" );
		endif;*/

		if ( ! defined( 'CMB2_LOADED' ) ) :        
			if ( ! empty( Paths::getActiveVendorPath( ) ) ) :
				$CMBLoader = new CMBLoader( );
				$FieldTypeLoader = new FieldTypeLoader(  );
			endif;
		endif;
	}


	public function setFieldTypes( )
	{
		$FieldTypes = new FieldTypeLoader( $this );##FieldTypeLoader class called 2 times? coupling?
		$FieldTypes->setFieldTypes( );
		$FieldTypes = $FieldTypes->fieldTypes;
		$this->fieldTypes = $FieldTypes;
	}


	public function getFieldTypes( )
	{
		#$this->fieldTypes = FieldTypeLoader::$fieldTypes;
	}


	public function setMainConfig()
	{
		$MainConfig = new MainConfig;
	    $this->mainConfig = $MainConfig->getMainConfig( );
	    #Common::write_log( $this->getMainConfig( ) );
	}


	public function getMainConfig( )
	{
	    return $this->mainConfig;
	}


	public function setMenuConfig( )
	{
		$MenuConfig = new MenuConfig;
	    $this->menuConfig = $MenuConfig->getMenuConfig( );
	}


	public function getMenuConfig( )
	{
	    return $this->menuConfig;
	}



################POST

	public function setPostConfig( )
	{
		$PostConfig = new PostConfig;
		$PostConfig->setPostConfig( );
		$PostConfig = $PostConfig->postConfig;
		$this->postConfig = $PostConfig;
		self::$postConfigStatic = $PostConfig;

	}


	public function getPostConfig( )
	{
		return $this->postConfig;
	}


	public static function getPostConfigStatic( )
	{
		return self::$postConfigStatic;
	}


	public function setPostMetaConfig( )
	{
		$PostMetaConfig = new PostMetaConfig;
		$PostMetaConfig->setPostMetaConfig( );
		$PostMetaConfig = $PostMetaConfig->postMetaConfig;
		$this->postMetaConfig = $PostMetaConfig;
		self::$postMetaConfigStatic = $PostMetaConfig;
	}


	public function getPostMetaConfig( )
	{
		return $this->postMetaConfig;
	}


	public static function getPostMetaConfigStatic( )
	{
		return self::$postMetaConfigStatic;
	}


	/*public static function getPostMetaPrefixByPostType( $postType )
	{
		Common::write_log( 'getPostMetaPrefixByPostType( '.$postType.' )');

		foreach( self::$postMetaConfigStatic as $mb ) :

			Common::write_log( 'object_types : ' );

			Common::write_log( $mb['object_types'] );

			if( in_array( $postType, $mb['object_types'] ) ) :

				Common::write_log( '!!!MATCH' );
				Common::write_log( $mb['prefix'] );

				#return $mb['prefix'];

			endif;

		endforeach;

	}*/


#####################



#############TAXOMONY

	public function setTaxConfig( )
	{
		$TaxConfig = new TaxConfig;
		$TaxConfig->setTaxConfig( );
		$TaxConfig = $TaxConfig->taxConfig;
		$this->taxConfig = $TaxConfig;
	}


	public function getTaxConfig( )
	{
		return $this->taxConfig;
	}


	public function setTaxMetaConfig( )
	{
		$TaxMetaConfig = new TaxMetaConfig;
		$TaxMetaConfig->setTaxMetaConfig( );
		$TaxMetaConfig = $TaxMetaConfig->taxMetaConfig;
		$this->taxMetaConfig = $TaxMetaConfig;
	}


	public function getTaxMetaConfig( )
	{
		return $this->taxMetaConfig;
	}

#####################




#############PATHS


	public function setPaths( )
	{
		#Common::write_log( "Globals - setPaths()" );
		#Common::write_log( $this );
		$Paths = new Paths( );
	}




}
