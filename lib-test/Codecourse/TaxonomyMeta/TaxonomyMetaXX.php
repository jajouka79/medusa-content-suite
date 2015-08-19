<?php

namespace Codecourse\TaxonomyMeta;


/*class MyClass
{
  public $prop1 = "I'm a class property!";
 
  public function setProperty($newval)
  {
      $this->prop1 = $newval;
  }
 
  public function getProperty()
  {
      return $this->prop1 . "<br />";
  }
}
 
// Create two objects
$obj = new MyClass;
$obj2 = new MyClass;
 
// Get the value of $prop1 from both objects
#echo $obj->getProperty();
#echo $obj2->getProperty();
 
// Set new values for both objects
$obj->setProperty("I'm a new property value!");
$obj2->setProperty("I belong to the second instance!");

*/

// Output both objects' $prop1 value
/*echo $obj->getProperty();
echo $obj2->getProperty();*/


class TaxonomyMetaXX
{
	public function __construct()
	{
		echo "TaxonomyMetaXX -> __construct<br>";



	}


	public function cmb2_taxonomy_meta_initiate( array $meta_box )
	{
	  //echo('medusa me first- ---<br><br>');
	  //require_once 'CMB2/init.php';
	  //require_once 'fields/Taxonomy_MetaData/Taxonomy_MetaData_CMB2.php';


	  //_curriculum_areas_tax_fields_image_full_width


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



}


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



#add_filter('cmb2-taxonomy_meta_boxes', 'cmb2_taxonomy_meta_initiate');


//add_action( 'init', 'cmb2_taxonomy_meta_initiate',10 );




