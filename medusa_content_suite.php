<?php
/*
Plugin Name: Medusa Content Suite
Description: Medusa content suite plugin for custom posts, tax, meta, config.
Plugin URI: http://www.medusamediacreations.co.uk
Author: S. Beasley
Version: 1.0
Author URI: http://www.medusamediacreations.co.uk

*/

namespace MedusaContentSuite;

define( "MEDUSACONTENTSUITE", 1 );

use MedusaContentSuite\Functions\Common as Common;

use MedusaContentSuite\Config\Globals as Globals;

use MedusaContentSuite\Taxonomy\TaxFormatters as TaxFormatters;
use MedusaContentSuite\Taxonomy\TaxTypes as TaxTypes;
use MedusaContentSuite\Taxonomy\TaxMods as TaxMods;

use MedusaContentSuite\Post\PostTypes as PostTypes;
use MedusaContentSuite\Post\PostMods as PostMods;

use MedusaContentSuite\Functions\Callbacks as Callbacks;
use MedusaContentSuite\Functions\Rules as Rules;

use MedusaContentSuite\Config\PostConfig as PostConfig;

use MedusaContentSuite\Config\MainConfig as MainConfig;
use MedusaContentSuite\Config\MenuConfig as MenuConfig;

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

use MedusaContentSuite\Config\Menus as Menus;

#require_once '/var/www/bedrock-test1/vendor/autoload.php';

#add_action( 'init', function(){
  $autoload_path =  dirname( __FILE__ ) . '/vendor/autoload.php';

  #print( "autoload_path - " . $autoload_path );

  if ( file_exists( $autoload_path ) ) :
    require_once( $autoload_path );
  endif;
  
#});






add_action( 'wp_print_scripts', function( ){
   #wp_dequeue_script( 'cmb2-scripts' );
});




#TODO - sort out validation classes
#///////////////////////////////////////////////////////
$number = 123;
$xx = v::numeric( )->validate( $number ); // true

#print($xx);
///////////////////////////////////////////////////////



$Common = new Common; #call this first
$Globals = new Globals;

#Common::write_log( $Globals );

$MedusaContentSuite = new MedusaContentSuite( $Globals );

class MedusaContentSuite
{
  public $Globals;

  public function __construct( $Globals )
  {

    if( ! empty( $Globals->rootConfigLoc ) ) : 

      if( $Globals->checkRootConfigLocExists( ) ) :

        Common::write_log( "checkRootConfigLocExists( )!!!!!!!!" );

        #Common::write_log( $Globals );
       
        $PostTypes = new PostTypes( $Globals );

        $PostMeta = new PostMeta( $Globals );

        
        #$FieldTypeLoader = new FieldTypeLoader;

      endif;

    endif;  

    #Common::write_log( "MedusaContentSuite > __construct" );

   /* 

    $Globals->postConfig = $Globals->postConfig ;

    Common::write_log( "PostTypes - Globals - " );
    Common::write_log( $Globals );*/


    #$TaxTypes = new TaxTypes;

    /*
    $TaxMeta = new TaxMeta;
    #$Validator = new Validator;

    $Menus = new Menus;
    $PostMods = new PostMods;*/


    //$Yaml = new Yaml;#test

    /*

    $TaxFormatters = new TaxFormatters;
    $TaxMods = new TaxMods;
    $Rules = new Rules;

    $Callbacks = new Callbacks;
    $Callbacks = $Callbacks->getCallbacks( );

    */

    #$CustomFieldTypes = new CustomFieldTypes;
    #$PackagesFieldTypes = new PackagesFieldTypes;








    #write_log( $this->Globals );

    if ( ! defined( 'CMB2_LOADED' ) ) :
        
      if ( ! empty( $Globals->activeVendorPath ) ) :

        $CMBLoader = new CMBLoader( $Globals );

        /*
        $FieldTypeLoader = new FieldTypeLoader;
        $FieldTypeLoader = $FieldTypeLoader->init( );
        */

      endif;

    endif;

    if ( ! defined( 'CMB2_LOADED' ) ) :

      #write_log( "CMB2 NOT LOADED" );

    else:

      #write_log( "CMB2_LOADED" );

    endif;






    #$this->Globals = $Globals;

    #Common::write_log( $this->Globals );

    #add_action( 'init', array( $this, 'loadCMB' ), 1 );













  }



  public function loadCMB( )
  {
    write_log( "MedusaContentSuite > loadCMB" );


  }


}