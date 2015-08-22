<?php
/*
Plugin Name: Medusa - Custom - Meta Boxes
Description: Creates custom meta boxes  and custom fields for post types.
Plugin URI: http://www.medusamediacreations.co.uk
Author: S. Beasley
Version: 1.0
Author URI: http://www.medusamediacreations.co.uk
*/

namespace MedusaContentSuite;

use MedusaContentSuite\Taxonomy\TaxFormatters as TaxFormatters;
use MedusaContentSuite\Taxonomy\TaxTypes as TaxTypes;
use MedusaContentSuite\Taxonomy\TaxMods as TaxMods;

use MedusaContentSuite\Post\PostTypes as PostTypes;
use MedusaContentSuite\Post\PostMods as PostMods;

use MedusaContentSuite\Functions\Callbacks as Callbacks;
use MedusaContentSuite\Functions\Rules as Rules;

use MedusaContentSuite\Config\MainConfig as MainConfig;
use MedusaContentSuite\Config\MenuConfig as MenuConfig;
use MedusaContentSuite\Config\PostMetaConfig as PostMetaConfig;
use MedusaContentSuite\Config\TaxMetaConfig as TaxMetaConfig;
use MedusaContentSuite\Config\PostConfig as PostConfig;
use MedusaContentSuite\Config\TaxConfig as TaxConfig;
use MedusaContentSuite\Config\ModConfig as ModConfig;

use MedusaContentSuite\CMB\Meta\PostMeta as PostMeta;

/*use MedusaContentSuite\CMB\FieldTypes\CustomFieldTypes as CustomFieldTypes;
use MedusaContentSuite\CMB\FieldTypes\PackagesFieldTypes as PackagesFieldTypes;
use MedusaContentSuite\CMB\Meta\TaxMeta as TaxMeta;*/

require_once '/var/www/bedrock/vendor/autoload.php';

$MedusaContentSuite = new MedusaContentSuite;
$MedusaContentSuite->init();


class MedusaContentSuite
{

  public function init()
  {
    #print( "<ul><li>PostTypes > init</li></ul>" );
    add_action( 'init', array( $this, 'load' ), 1 );
    require_once plugin_dir_path( __FILE__ ).'tester.php';
  }

  public function load()
  {

    #require_once __DIR__ . '/vendor/autoload.php'; 
    //echo "DIR - " . __DIR__ . "<br>";

    #$authFilter = new AuthFilter;
    #$XaddressUk = new AddressUk;
    $PostMods = new PostMods;
    $TaxFormatters = new TaxFormatters;
    $TaxMods = new TaxMods;
    $Rules = new Rules;
    #$TaxMeta = new TaxMeta;
    #$CustomFieldTypes = new CustomFieldTypes;
    #$PackagesFieldTypes = new PackagesFieldTypes;

    $TaxTypes = new TaxTypes;
    $TaxTypes->init();
    $TaxTypes = $TaxTypes->registerTaxTypes();
    
    $PostTypes = new PostTypes;
    $PostTypes->init();
    $PostTypes = $PostTypes->registerPostTypes();

    $Callbacks = new Callbacks;
    $Callbacks->init();
    $Callbacks = $Callbacks->getCallbacks();

    $MainConfig = new MainConfig;
    $MainConfig->init();
    $MainConfig = $MainConfig->getMainConfig();

    $MenuConfig = new MenuConfig;
    $MenuConfig->init();
    $MenuConfig = $MenuConfig->getMenuConfig();

    $PostConfig = new PostConfig;
    $PostConfig->init();
    $PostConfig = $PostConfig->getPostConfig();

    $TaxConfig = new TaxConfig;
    $TaxConfig->init();
    $TaxConfig = $TaxConfig->getTaxConfig();

    $PostMetaConfig = new PostMetaConfig;
    $PostMetaConfig->init();
    $PostMetaConfig = $PostMetaConfig->getPostMetaConfig();


    $TaxMetaConfig = new TaxMetaConfig;
    $TaxMetaConfig->init();
    $TaxMetaConfig = $TaxMetaConfig->getTaxMetaConfig();

    $ModConfig = new ModConfig;
    $ModConfig->init();
    $ModConfig = $ModConfig->getModConfig();

    $PostMeta = new PostMeta;
    $PostMeta->init();

    if ( ! is_admin( ) ) :

      /*print("<br><b>Callbacks</b><br>");
      print_r($Callbacks);
      print("<br><b>MainConfig</b><br>");
      print_r($MainConfig);
      print("<br><b>MenuConfig</b><br>");
      print_r($MenuConfig);
      print("<br><b>PostConfig</b><br>");
      print_r($PostConfig);
      print("<br><b>TaxConfig</b><br>");
      print_r($TaxConfig);      
      print("<br><b>PostMetaConfig</b><br>");
      print_r($PostMetaConfig);
      print("<br><b>ModConfig</b><br>");
      print_r($ModConfig);
      print( "<br><b>PostTypes</b><br>" );
      print_r( $PostTypes );
      print( "<br><b>TaxTypes</b><br>" );
      print_r( $TaxTypes );
      print( "<br><b>PostMeta</b><br>" );
      print_r( $PostMeta );*/

    endif;

  }
}




//include "example-functions.php";

/*
class medusa_custom_meta_boxes {
  function __construct( $meta_box_args ) {
    $this->meta_box_args = $meta_box_args;
    add_filter( 'cmb2_meta_boxes', array( &$this, 'medusa_custom_meta_boxes' ) );
  }

  public function medusa_custom_meta_boxes(){
    return $this->meta_box_args;
  }

}*/

?>