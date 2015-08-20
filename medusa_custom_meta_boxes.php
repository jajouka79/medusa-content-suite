<?php
/*
Plugin Name: Medusa - Custom - Meta Boxes
Description: Creates custom meta boxes  and custom fields for post types.
Plugin URI: http://www.medusamediacreations.co.uk
Author: S. Beasley
Version: 1.0
Author URI: http://www.medusamediacreations.co.uk
#https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress/wiki/Field-Types#Custom

# TODO
# required fields!!! issue raised in github:
# (https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress/issues?page=1&state=open)
# maybe this (http://jqueryvalidation.org/documentation)
# maybe this http://wordpress.stackexchange.com/questions/36180/can-you-make-a-custom-metabox-field-be-required-to-save-a-new-post
# sanitise data
# video functions - generalize somehow

# include cmb2 as dep
# field types, callbacks, taxonomy meta, show on functions
# sort out wp-options, wp-large-options deps
# include config files (project-specific, json/php?, error handling) 
# sanitisation
# test with groups of fields
# 
#
#

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
use MedusaContentSuite\Config\MetaConfig as MetaConfig;
use MedusaContentSuite\Config\PostConfig as PostConfig;
use MedusaContentSuite\Config\TaxConfig as TaxConfig;
use MedusaContentSuite\Config\ModConfig as ModConfig;

use MedusaContentSuite\CMB\FieldTypes\CustomFieldTypes as CustomFieldTypes;
use MedusaContentSuite\CMB\FieldTypes\PackagesFieldTypes as PackagesFieldTypes;

use MedusaContentSuite\CMB\Meta\PostMeta as PostMeta;
use MedusaContentSuite\CMB\Meta\TaxMeta as TaxMeta;


$MedusaContentSuite = new MedusaContentSuite();
$MedusaContentSuite->init();


class MedusaContentSuite
{

  public function init()
  {
    #print( "<ul><li>PostTypes > init</li></ul>" );
    add_action( 'init', array( $this, 'load' ), 1 );
  }

  public function load()
  {

    #require_once __DIR__ . '/vendor/autoload.php'; 
    //echo "DIR - " . __DIR__ . "<br>";

    require_once '/var/www/bedrock/vendor/autoload.php'; 


    #$authFilter = new AuthFilter();
    #$XaddressUk = new AddressUk();

    $PostMods = new PostMods();

    $TaxFormatters = new TaxFormatters();
    $TaxMods = new TaxMods();

    $Rules = new Rules();

    
    $TaxTypes = new TaxTypes();
    $TaxTypes->init();
    $TaxTypes = $TaxTypes->registerTaxTypes();

    
    $PostTypes = new PostTypes();
    $PostTypes->init();
    $PostTypes = $PostTypes->registerPostTypes();


    $Callbacks = new Callbacks();
    $Callbacks->init();
    $Callbacks = $Callbacks->getCallbacks();


    $MainConfig = new MainConfig();
    $MainConfig->init();
    $MainConfig = $MainConfig->getMainConfig();

    $MenuConfig = new MenuConfig();
    $MenuConfig->init();
    $MenuConfig = $MenuConfig->getMenuConfig();

    $PostConfig = new PostConfig();
    $PostConfig->init();
    $PostConfig = $PostConfig->getPostConfig();

    $TaxConfig = new TaxConfig();
    $TaxConfig->init();
    $TaxConfig = $TaxConfig->getTaxConfig();

    $MetaConfig = new MetaConfig();
    $MetaConfig->init();
    $MetaConfig = $MetaConfig->getMetaConfig();

    $ModConfig = new ModConfig();
    $ModConfig->init();
    $ModConfig = $ModConfig->getModConfig();

    $PostMeta = new PostMeta();
    $PostMeta->init();
    $PostMeta = $PostMeta->registerPostMeta();

    $CustomFieldTypes = new CustomFieldTypes();
    $PackagesFieldTypes = new PackagesFieldTypes();

    $TaxMeta = new TaxMeta();

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
      print("<br><b>MetaConfig</b><br>");
      print_r($MetaConfig);
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