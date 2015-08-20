<?php

namespace MedusaContentSuite\CMB\Meta;

use MedusaContentSuite\Config\MetaConfig as MetaConfig;

class PostMeta
{

	public function init()
	{
		#print( "<ul><li>PostMeta > init</li></ul>" );
		#print_r ( $this->registerPostMeta() );
		#add_filter( 'cmb2_meta_boxes', array( &$this, 'registerPostMeta' ) );
		add_action( 'cmb2_init', array( $this, 'registerPostMeta' ) );
	}

	public function getMetaConfig()
	{
		$MetaConfig = new MetaConfig();
		$MetaConfig = $MetaConfig->getMetaConfig();
		return $MetaConfig;
	}

	public function registerPostMeta()
	{		
		echo "registerPostMeta()<br><br>";
		
		/*
		$MetaConfig = $this->getMetaConfig();
		return $MetaConfig;
		*/

		

		$cmb_demo = new_cmb2_box( array(
			'id'            => $prefix . 'metabox',
			'title'         => __( 'Test Metabox', 'cmb2' ),
			'object_types'  => array( 'page', ), // Post type
			// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
			// 'context'    => 'normal',
			// 'priority'   => 'high',
			// 'show_names' => true, // Show field names on the left
			// 'cmb_styles' => false, // false to disable the CMB stylesheet
			// 'closed'     => true, // true to keep the metabox closed by default
		) );

		$cmb_demo->add_field( array(
			'name'       => __( 'Test Text', 'cmb2' ),
			'desc'       => __( 'field description (optional)', 'cmb2' ),
			'id'         => $prefix . 'text',
			'type'       => 'text',
			'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
			// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
			// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
			// 'on_front'        => false, // Optionally designate a field to wp-admin only
			// 'repeatable'      => true,
		) );

		$cmb_demo->add_field( array(
			'name' => __( 'Test Text Small', 'cmb2' ),
			'desc' => __( 'field description (optional)', 'cmb2' ),
			'id'   => $prefix . 'textsmall',
			'type' => 'text_small',
			// 'repeatable' => true,
		) );

		

	}

}