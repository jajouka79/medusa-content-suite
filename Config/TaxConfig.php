<?php

namespace MedusaContentSuite\Config;

class TaxConfig
{

	public function init()
	{
		#print( "<ul><li>TaxConfig > init</li></ul>" );
		add_action( 'init', array( $this, 'getTaxConfig' ), 1 );
	}

	public function getTaxConfig()
	{
		
		//TX - News Category
			$labels=array(
				'name' => _x( 'News Category', 'taxonomy general name' ),
				'singular_name' => _x( 'News Category', 'taxonomy singular name' ),
				'search_items' =>  __( 'Search News Categories' ),
				'all_items' => __( 'All News Categories' ),
				'parent_item' => __( 'Parent Location' ),
				'parent_item_colon' => __( 'Parent News Category:' ),
				'edit_item' => __( 'Edit News Category' ),
				'update_item' => __( 'Update News Category' ),
				'add_new_item' => __( 'Add New News Category' ),
				'new_item_name' => __( 'New News Category' ),
				'menu_name' => __( 'News Category' ),
			);
			// Control the slugs used for this taxonomy
			$args = array(
				'labels' => $labels,
				'slug' => 'news-category', // This controls the base slug that will display before each term
				'with_front' => false, // Don't display the category base before "/locations/"
				'hierarchical' => false, // This will allow URL's like "/locations/boston/cambridge/"
				'show_ui' => true,
				'capabilities' => array(
					'manage_terms' => 'update_core',
					'edit_terms' => 'update_core',
					'delete_terms' => 'update_core',
					'assign_terms' => 'update_core'
				),
			);
			$taxes = 'news_category';
			$types = array ( 
				array (
					'id' => 'news_article', 
					'show_tax_meta' => false 
				),
			);

			$config[] = array ( 'args' => $args, 'types' => $types, 'taxes' => $taxes );


		//TX - Event Category
			$labels=array(
				'name' => _x( 'Event Category', 'taxonomy general name' ),
				'singular_name' => _x( 'Event Category', 'taxonomy singular name' ),
				'search_items' =>  __( 'Search Event Categories' ),
				'all_items' => __( 'All Event Categories' ),
				'parent_item' => __( 'Parent Location' ),
				'parent_item_colon' => __( 'Parent Event Category:' ),
				'edit_item' => __( 'Edit Event Category' ),
				'update_item' => __( 'Update Event Category' ),
				'add_new_item' => __( 'Add New Event Category' ),
				'new_item_name' => __( 'New Event Category' ),
				'menu_name' => __( 'Event Category' ),
			);
			// Control the slugs used for this taxonomy
			$args = array(
				'labels' => $labels,
				'slug' => 'event_category', // This controls the base slug that will display before each term
				'with_front' => false, // Don't display the category base before "/locations/"
				'hierarchical' => false, // This will allow URL's like "/locations/boston/cambridge/"
				'show_ui' => true,
				'capabilities' => array(
					'manage_terms' => 'update_core',
					'edit_terms' => 'update_core',
					'delete_terms' => 'update_core',
					'assign_terms' => 'update_core'
				),
			);

			$taxes = 'event_category';
			$types = array ( 
				array (
					'id' => 'event', 
					'show_tax_meta' => false 
				),
			);

			$config[] = array ( 'args' => $args, 'types' => $types, 'taxes' => $taxes );


			return $config;

	}

}