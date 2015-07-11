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

use Codecourse\Repositories\UserRepository as UserRepository;
use Codecourse\Filters\AuthFilter as AuthFilter;
use Codecourse\FieldTypes\AddressUk as AddressUk;

//require_once __DIR__ . '/vendor/autoload.php'; 

echo "DIR - " . __DIR__ . "<br>";

require_once '/var/www/bedrock/vendor/autoload.php'; 

$authFilter = new AuthFilter();
$addressUk = new AddressUk();

/*
  if ( file_exists(  __DIR__ .'/vendor/cmb2/init.php' ) ) {
      require_once  __DIR__ .'/vendor/cmb2/init.php';
  } elseif ( file_exists(  __DIR__ .'/vendor/CMB2/init.php' ) ) {
      require_once  __DIR__ .'/vendor/CMB2/init.php';
  }
*/

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


function cmb2_taxonomy_meta_initiate( array $meta_box )  {
  //echo('medusa me first- ---<br><br>');
  //require_once 'CMB2/init.php';
  //require_once 'fields/Taxonomy_MetaData/Taxonomy_MetaData_CMB2.php';


  //_curriculum_areas_tax_fields_image_full_width
  $prefix="_curriculum_areas_tax_fields_";//TODO - change to more generic field title - beware of associations
  $meta_box = array(
    'id'         => 'cat_options',
    // 'key' and 'value' should be exactly as follows
    'show_on'    => array( 'key' => 'options-page', 'value' => array( 'unknown', ), ),
    'object_types'  => array( 'page', ), // Post type
    'show_names' => true, // Show field names on the left
    'fields'     => array(

      array(
        'name' => 'Description',
        'desc' => 'Type the description text here.',
        'id' => $prefix . 'description',
        'type' => 'wysiwyg',
        'options' => array(
          'wpautop' => true, // use wpautop?
          'media_buttons' => false, // show insert/upload button(s)
          'textarea_rows' => get_option( 'default_post_edit_rows', 25 ), // rows="..."
          'tabindex' => '',
          'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the `<style>` tags, can use "scoped".
          'editor_class' => '', // add extra class(es) to the editor textarea
          'teeny' => false, // output the minimal editor config used in Press This
          'dfw' => true, // replace the default fullscreen with DFW (needs specific css)
          'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
          'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
        )
      ),

      array(
        'name' => 'Excerpt (Short teaser text)',
        'desc' => 'Type the excerpt text here',
        'id' => $prefix . 'excerpt',
        'type' => 'wysiwyg',
        'options' => array(
          'wpautop' => true, // use wpautop?
          'media_buttons' => false, // show insert/upload button(s)
          'textarea_rows' => get_option( 'default_post_edit_rows', 25 ), // rows="..."
          'tabindex' => '',
          'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the `<style>` tags, can use "scoped".
          'editor_class' => '', // add extra class(es) to the editor textarea
          'teeny' => false, // output the minimal editor config used in Press This
          'dfw' => true, // replace the default fullscreen with DFW (needs specific css)
          'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
          'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
        )
      ),

      array(
        'name'         => __( 'Image - thumb', 'cmb2' ),
        'desc'         => __( 'Upload or add image.', 'cmb2' ),
        'id'           => $prefix . 'image_thumb',
        'type'         => 'file',
        'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
      ),

      array(
        'name'         => __( 'Image - full width image', 'cmb2' ),
        'desc'         => __( 'Upload or add image.', 'cmb2' ),
        'id'           => $prefix . 'image_full_width',
        'type'         => 'file',
        'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
      ),
    )
  );

  // (Recommended) Use wp-large-options
  //require_once 'wp-large-options/wp-large-options.php';
  $overrides = array(
      'get_option'    => 'wlo_get_option',
      'update_option' => 'wlo_update_option',
      'delete_option' => 'wlo_delete_option',
  );

  // if(! class_exists('CMB2')){
  //     print 'class ! exists in cmb2_taxonomy_meta_initiate <br><br>';
  // }


  //Instantiate our taxonomy meta class

  return $meta_box;

  /*
    $cats = new Taxonomy_MetaData_CMB2( 'curriculum_areas', $meta_box, __( 'Category Settings', 'taxonomy-metadata' ), $overrides );
    $cats2 = new Taxonomy_MetaData_CMB2( 'training_areas', $meta_box, __( 'Category Settings', 'taxonomy-metadata' ), $overrides );
  */

}

#add_filter('cmb2-taxonomy_meta_boxes', 'cmb2_taxonomy_meta_initiate');


//add_action( 'init', 'cmb2_taxonomy_meta_initiate',10 );
