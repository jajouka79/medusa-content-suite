<?php
/*
Plugin Name: Medusa Content Suite
Description: Medusa content suite plugin for custom posts, tax, meta, config.
Plugin URI: http://www.medusamediacreations.co.uk
Author: S. Beasley
Version: 1.0
Author URI: http://www.medusamediacreations.co.uk

TODO :

  - http://bedrock-test1.local/wp/home/sbeasley/Sites/bedrock-test1/vendor/WebDevStudiosXXX/CMB2/css/cmb2.css?ver=4.4.1
  - http://bedrock-test1.local/app/plugins/medusa-content-suite/vendor/WebDevStudiosXXX/CMB2/css/cmb2.css?ver=4.4.1
  - make compatible with multi-site
  - WebDevStudiosXXX needs changing - look at package type priorities in composer
  - global variables need - DRY - vendorPath and any other common vars
  - sort out constructors
  - config tests - error notices
    - check all metabox ids are unique!
  - Linkage class for vendordir and package dirs, calling new Checker class with config tests
  - cmb2 field types config needs moving or automating
  - add bootstrap ! check integration with cmb2 grid - probably not needed
  - php validation needed - zend, respect validation, yii ?? 
    - tpl needed for 
*/

namespace MedusaContentSuite;

use MedusaContentSuite\Functions\Common as Common;

use MedusaContentSuite\Taxonomy\TaxFormatters as TaxFormatters;
use MedusaContentSuite\Taxonomy\TaxTypes as TaxTypes;
use MedusaContentSuite\Taxonomy\TaxMods as TaxMods;

use MedusaContentSuite\Post\PostTypes as PostTypes;
use MedusaContentSuite\Post\PostMods as PostMods;

use MedusaContentSuite\Functions\Callbacks as Callbacks;
use MedusaContentSuite\Functions\Rules as Rules;

use MedusaContentSuite\Config\MainConfig as MainConfig;
use MedusaContentSuite\Config\MenuConfig as MenuConfig;

use MedusaContentSuite\Config\PostConfig as PostConfig;
use MedusaContentSuite\Config\TaxConfig as TaxConfig;
use MedusaContentSuite\Config\ModConfig as ModConfig;

use MedusaContentSuite\CMB\Meta\PostMeta as PostMeta;
use MedusaContentSuite\CMB\Meta\TaxMeta as TaxMeta;

use Respect\Validation\Validator as v;

use MedusaContentSuite\CMB\Validators\Validator as Validator;



/*
use MedusaContentSuite\CMB\FieldTypes\CustomFieldTypes as CustomFieldTypes;
use MedusaContentSuite\CMB\FieldTypes\PackagesFieldTypes as PackagesFieldTypes;
*/

#require_once '/var/www/bedrock-test1/vendor/autoload.php';


add_action( 'init', function(){
  $autoload_path =  dirname( __FILE__ ) . '/vendor/autoload.php';
  if ( file_exists( $autoload_path ) ) :
    print "autoload exists";
    require_once( $autoload_path );
  else:
    print "autoload does not exist";
  endif;
  #new calderawp\twitter_core\core();
  
});






#TODO - sort out validation classes
#///////////////////////////////////////////////////////

$number = 123;
$xx = v::numeric( )->validate( $number ); // true

#print($xx);

///////////////////////////////////////////////////////



$MedusaContentSuite = new MedusaContentSuite;
$MedusaContentSuite->init( );

$Common = new Common;
$Common = $Common->getCommonFunctions( );


$PostConfig = new PostConfig;
$PostConfig = $PostConfig->getPostConfig( );

$PostTypes = new PostTypes;
$PostTypes->init( );

$PostMeta = new PostMeta;
$PostMeta = $PostMeta->init( );

$TaxTypes = new TaxTypes;
$TaxTypes->init( );

$TaxConfig = new TaxConfig;
$TaxConfig = $TaxConfig->getTaxConfig( );


$TaxMeta = new TaxMeta;
$TaxMeta = $TaxMeta->init( );

$Validator = new Validator;


/*

$PostMods = new PostMods;
$TaxFormatters = new TaxFormatters;
$TaxMods = new TaxMods;
$Rules = new Rules;

$Callbacks = new Callbacks;
$Callbacks = $Callbacks->getCallbacks( );

$MainConfig = new MainConfig;
$MainConfig = $MainConfig->getMainConfig( );

$MenuConfig = new MenuConfig;
$MenuConfig = $MenuConfig->getMenuConfig( );

$ModConfig = new ModConfig;
$ModConfig = $ModConfig->getModConfig( );

*/

#$CustomFieldTypes = new CustomFieldTypes;
#$PackagesFieldTypes = new PackagesFieldTypes;


class MedusaContentSuite
{
  public $vendorDirExists = false;
  public $vendorPath;
  public $cmbLoaded = false;

  public function init( )
  {
    add_action( 'init', array( $this, 'load' ), 1 );
  }

  public function load( )
  {

    write_log( "MedusaContentSuite > load" );

    $this->setVendorPath( );

    #write_log( "this->vendorPath - " . $this->vendorPath );

    $this->checkVendorDirExists( );

    #write_log("vendorDirExists - " . $this->vendorDirExists );

  }

  public function setVendorPath( )
  {
    $filePath = plugin_dir_path( __FILE__ );
    $packageVendorPath = $filePath . "vendor";
    $this->vendorPath = $packageVendorPath;
  }

  public function checkVendorDirExists( )
  {
    if ( file_exists( $this->vendorPath ) ) :
      $this->vendorDirExists = true;
    else :
      throw new \Exception( "Medusa Content Suite - can't find vendor directory" );
    endif;
  }





}

?>