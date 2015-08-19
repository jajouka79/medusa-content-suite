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
#use Codecourse\TaxonomyMeta\TaxonomyMetaXX as TaxonomyMetaXX;
#use Codecourse\Filters\AuthFilter as AuthFilter;
#use Codecourse\FieldTypes\AddressUk as AddressUk;
use Codecourse\Functions\FunctionsInc as FunctionsInc;

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

#require_once __DIR__ . '/vendor/autoload.php'; 
//echo "DIR - " . __DIR__ . "<br>";

require_once '/var/www/bedrock/vendor/autoload.php'; 

$FunctionsInc = new FunctionsInc();
#$TaxonomyMetaXX = new TaxonomyMetaXX();

#$authFilter = new AuthFilter();
#$XaddressUk = new AddressUk();

#$PostTypes = new PostTypes();
$PostMods = new PostMods();

$TaxTypes = new TaxTypes();
$TaxFormatters = new TaxFormatters();
$TaxMods = new TaxMods();

$Rules = new Rules();



$PostTypes = new PostTypes();
$PostTypes->init();
$PostTypes = $PostTypes->registerPostTypes();
print("<b>PostTypes</b>");
print_r($PostTypes);



$Callbacks = new Callbacks();
$Callbacks->init();
$Callbacks = $Callbacks->getCallbacks();
print("<b>Callbacks</b>");
print_r($Callbacks);


$MainConfig = new MainConfig();
$MainConfig->init();
$MainConfig = $MainConfig->getMainConfig();
print("<b>MainConfig</b>");
print_r($MainConfig);

$MenuConfig = new MenuConfig();
$MenuConfig->init();
$MenuConfig = $MenuConfig->getMenuConfig();
print("<b>MenuConfig</b>");
print_r($MenuConfig);

$PostConfig = new PostConfig();
$PostConfig->init();
$PostConfig = $PostConfig->getPostConfig();
print("<b>PostConfig</b>");
print_r($PostConfig);

$TaxConfig = new TaxConfig();
$TaxConfig->init();
$TaxConfig = $TaxConfig->getTaxConfig();
print("<b>TaxConfig</b>");
print_r($TaxConfig);

#need functions
$MetaConfig = new MetaConfig();
$MetaConfig->init();
$MetaConfig = $MetaConfig->getMetaConfig();
print("<b>MetaConfig</b>");
print_r($MetaConfig);


$ModConfig = new ModConfig();
$ModConfig->init();
$ModConfig = $ModConfig->getModConfig();
print("<b>ModConfig</b>");
print_r($ModConfig);

$CustomFieldTypes = new CustomFieldTypes();
$PackagesFieldTypes = new PackagesFieldTypes();
$PostMeta = new PostMeta();
$TaxMeta = new TaxMeta();



//include "example-functions.php";


class medusa_custom_meta_boxes {
  function __construct( $meta_box_args ) {
    $this->meta_box_args = $meta_box_args;
    add_filter( 'cmb2_meta_boxes', array( &$this, 'medusa_custom_meta_boxes' ) );
  }

  public function medusa_custom_meta_boxes(){
    return $this->meta_box_args;
  }

}



//#TODO - include in medusa_configuration function, add fields to the taxonomy array

