<?php

namespace MedusaContentSuite\Config;

##names space includes needed?
use MedusaContentSuite\Functions\Common as Common;
use MedusaContentSuite\Config\Paths as Paths;
use MedusaContentSuite\Config\MenuConfig as MenuConfig;
use MedusaContentSuite\CMB\Loaders\FieldTypeLoader as FieldTypeLoader;

class Globals extends \MedusaContentSuite\MedusaContentSuite{

	public $rootConfigLoc;
	public $configLoc;
	public $postConfig;
	public $postMetaConfig;
	public $taxConfig;
	public $taxMetaConfig;

	public $menuConfig;

	#public $cmbLoaded = false;

	public $activeVendorPath;
	#public $projectVendorPath;
	public $packageVendorPath;
	public $cmbPath;
	public $fieldTypes;

	public function __construct( )
	{
		#Common::write_log( "GLOBALS - __construct");
		$this->callSetters( );
	}


	public function callSetters()
	{

	    #Content config
    	$this->setPostConfig( );
    	$this->setPostMetaConfig( );

    	$this->setTaxConfig( );
    	$this->setTaxMetaConfig( );


    	$this->setMenuConfig( );


		$this->setPaths( );

		$this->setFieldTypes( );
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

	public function setMenuConfig()
	{
		$MenuConfig = new MenuConfig;
	    $MenuConfig->setMenuConfig( );
	    $this->menuConfig = $MenuConfig->menuConfig;

	    Common::write_log( $this->menuConfig );
	}

################POST

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

		$Paths = new Paths( $this );

	}




	#####################


}
