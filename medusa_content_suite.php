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

use MedusaContentSuite\Config\Paths as Paths;

use MedusaContentSuite\TimberMods\TimberPostMod as TimberPostMod;


use MedusaContentSuite\Taxonomy\TaxFormatters as TaxFormatters;
use MedusaContentSuite\Taxonomy\TaxTypes as TaxTypes;
use MedusaContentSuite\Taxonomy\TaxMods as TaxMods;

use MedusaContentSuite\Post\PostTypes as PostTypes;
use MedusaContentSuite\Post\PostMods as PostMods;

use MedusaContentSuite\Functions\Callbacks as Callbacks;
use MedusaContentSuite\Functions\Rules as Rules;


use MedusaContentSuite\CMB\Meta\PostMeta as PostMeta;
use MedusaContentSuite\CMB\Meta\TaxMeta as TaxMeta;

use Respect\Validation\Validator as v;
use MedusaContentSuite\CMB\Validators\Validator as Validator;



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

/*$number = 123;
$xx = v::numeric( )->validate( $number );*/

#print($xx);
///////////////////////////////////////////////////////


$Common = new Common; #call this first
$Globals = new Globals;

/*Common::write_log( "Globals" );
Common::write_log( $Globals );*/


$MedusaContentSuite = new MedusaContentSuite( $Globals );

class MedusaContentSuite
{
  public static $Globals;

  public function __construct( $Globals )
  {
    self::$Globals = $Globals;

    #Common::write_log( $Globals );
  
    if( Paths::checkRootConfigLocExists( ) ) :  

      $this->init( );
      
    else :

      Common::write_log( "MCS Error :: root config folder missing" );
    
    endif;  

  }


  public function init( )
  {

      $PostTypes = new PostTypes;
      $PostMeta = new PostMeta;
      $TaxTypes = new TaxTypes;
      $TaxMeta = new TaxMeta;
      $Menus = new Menus;
      $PostMods = new PostMods;

      Paths::loadCMB( );

    


    /*

      #$Validator = new Validator;

      #$Menus = new Menus;
      #$PostMods = new PostMods;


      #$Yaml = new Yaml;#test

      #$TaxFormatters = new TaxFormatters;
      #$TaxMods = new TaxMods;
      #$Rules = new Rules;

      #$Callbacks = new Callbacks;
      #$Callbacks = $Callbacks->getCallbacks( );

      #$CustomFieldTypes = new CustomFieldTypes;
      #$PackagesFieldTypes = new PackagesFieldTypes;

    */

  }

  public static function getGlobals( )
  {
    return self::$Globals;
  }


}