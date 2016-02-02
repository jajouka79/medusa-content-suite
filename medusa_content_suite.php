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
  - global variables need - DRY - packageVendorPath and any other common vars
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

use MedusaContentSuite\CMB\Loaders\CMBLoader as CMBLoader;
use MedusaContentSuite\CMB\Loaders\FieldTypeLoader as FieldTypeLoader;

use MedusaContentSuite\CMB\FieldTypes\CustomFieldTypes as CustomFieldTypes;
use MedusaContentSuite\CMB\FieldTypes\PackagesFieldTypes as PackagesFieldTypes;


#require_once '/var/www/bedrock-test1/vendor/autoload.php';

add_action( 'init', function(){
  $autoload_path =  dirname( __FILE__ ) . '/vendor/autoload.php';
  if ( file_exists( $autoload_path ) ) :

    write_log( "autoload exists" );

    require_once( $autoload_path );
  else:
    write_log( "autoload does not exist" );
  endif;
  #new calderawp\twitter_core\core();
  
});




add_action( 'wp_print_scripts',function(){

   #wp_dequeue_script( 'cmb2-scripts' );
});




#TODO - sort out validation classes
#///////////////////////////////////////////////////////

$number = 123;
$xx = v::numeric( )->validate( $number ); // true

#print($xx);

///////////////////////////////////////////////////////

$MedusaContentSuite = new MedusaContentSuite;

class MedusaContentSuite
{
  public $vendorDirExists = false;
  public $vendorPath;
  public $cmbLoaded = false;
  public $activeVendorPath = false;
  public $projectVendorPath = ROOT_DIR . "/vendor";
  public static $projectVendorPath2 = ROOT_DIR."/vendor";
  public $packageVendorPath;
  public $projectVendorPathExists = false;
  public $packageVendorPathExists = false;


  public function __construct(){

    #print( "MedusaContentSuite > __construct" );

    $PostConfig = new PostConfig;
    $PostConfig = $PostConfig->getPostConfig( );


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

    $TaxMeta = new TaxMeta;
    $TaxMeta = $TaxMeta->init( );

    $TaxConfig = new TaxConfig;
    $TaxConfig = $TaxConfig->getTaxConfig( );

    $Validator = new Validator;
    $CMBLoader = new CMBLoader;



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


  }


  public function __construct__( )
  {
    add_action( 'init', array( $this, 'load' ), 1 );
  }


  public function load( )
  {
    write_log( "MedusaContentSuite > load" );
    #$this->setVendorPath( );
    #write_log( "this->vendorPath - " . $this->vendorPath );
    #$this->checkPackageVendorDirExists( );
    #write_log("vendorDirExists - " . $this->vendorDirExists );
    write_log("activeVendorPath - " . $activeVendorPath );




    if ( ! defined( 'CMB2_LOADED' ) ) :
      if ( $activeVendorPath ) :

/*
$url = home_url();
echo $url;
require_once( $url . '/vendor/WebDevStudiosXXX/CMB2/init.php');*/

        $CMBLoader = new CMBLoader;
        $CMBLoader = $CMBLoader->init( );

/*
global $wp_scripts; 
echo "xxxxxxx";
echo "<div style='position:absolute; width:800px; height 450px; background:#ffffff; border:red 1px dotted; right:0px; overflow:scroll; z-index:999999999999999999999'>";
    foreach( $wp_scripts->registered as $handle ) :


print_html_r($handle);



    endforeach; 

echo "</div>";*/


       /* $FieldTypeLoader = new FieldTypeLoader;
        $FieldTypeLoader = $FieldTypeLoader->init( );*/

      endif;
    endif;

    if ( ! defined( 'CMB2_LOADED' ) ) :
      #write_log( "CMB2 NOT LOADED" );
    else:
      #write_log( "CMB2_LOADED" );
    endif;

  }

  public static function getVendorPath(){
    $path = ROOT_DIR."/vendor";
    $path = $projectVendorPath2;
    write_log( 'getVendorPath( ) ---' . $path );
    write_log( 'projectVendorPath2 ---' . $projectVendorPath2 );
    return $path;
  }

  public function getActiveVendorPath( ){

    $this->packageVendorPath = plugin_dir_path( __FILE__ ) . "vendor";
    $this->checkPackageVendorDirExists( );
    $this->checkProjectVendorDirExists( );

    if ( $this->packageVendorPathExists ) :
      $this->activeVendorPath = $this->packageVendorPath;
    elseif ( $this->projectVendorPathExists ) :
      $this->activeVendorPath = $this->projectVendorPath;
    else :
      throw new \Exception( "Medusa Content Suite - can't find vendor directory" );
    endif;

    #write_log( "this->projectVendorPath - " . $this->projectVendorPath );
    #write_log( "this->packageVendorPath - " . $this->packageVendorPath );
    #write_log( "activeVendorPath - " . $this->activeVendorPath );

    return $this->activeVendorPath;

  }
  public function checkPackageVendorDirExists( )
  {
    if ( file_exists( $this->packageVendorPath ) ) :
      $this->packageVendorPathExists = true;
    endif;
  }

  public function checkProjectVendorDirExists( )
  {
    if ( file_exists( $this->projectVendorPath ) ) :
      $this->projectVendorPathExists = true;
    endif;
  }

}

?>