<?php


		$config = array();
		
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

			$args_ext = array(
				'show_tax_meta' => true,
			);


			$tax = 'news_category';
			$pt = array ( 
				array (
					'id' => 'news_article', 
					'show_tax_meta' => false 
				),
			);

			$config[] = array ( 'args' => $args, 'pt' => $pt, 'tax' => $tax );

		



		//TX - Show Type
			$labels=array(
				'name' => _x( 'Show Type', 'taxonomy general name' ),
				'singular_name' => _x( 'Show Type', 'taxonomy singular name' ),
				'search_items' =>  __( 'Search News Categories' ),
				'all_items' => __( 'All News Categories' ),
				'parent_item' => __( 'Parent Location' ),
				'parent_item_colon' => __( 'Parent Show Type:' ),
				'edit_item' => __( 'Edit Show Type' ),
				'update_item' => __( 'Update Show Type' ),
				'add_new_item' => __( 'Add New Show Type' ),
				'new_item_name' => __( 'New Show Type' ),
				'menu_name' => __( 'Show Type' ),
			);

			$args = array(
				'labels' => $labels,
				'slug' => 'show-type', // This controls the base slug that will display before each term
				'with_front' => false, // Don't display the category base before "/locations/"
				'hierarchical' => false, // This will allow URL's like "/locations/boston/cambridge/"
				'show_ui' => false,
				'capabilities' => array(
					/*'manage_terms' => 'update_core',
					'edit_terms' => 'update_core',
					'delete_terms' => 'update_core',
					'assign_terms' => 'update_core'*/
				),
			);

			$args_ext = array(
				'show_tax_meta' => true,
			);


			$tax = 'show_type';
			$pt = array ( 
				array (
					'id' => 'event', 
					'show_tax_meta' => false 
				),
			);

			$config[] = array ( 'args' => $args, 'pt' => $pt, 'tax' => $tax );






		//TX - Class Type
			$labels=array(
				'name' => _x( 'Class Type', 'taxonomy general name' ),
				'singular_name' => _x( 'Class Type', 'taxonomy singular name' ),
				'search_items' =>  __( 'Search News Categories' ),
				'all_items' => __( 'All News Categories' ),
				'parent_item' => __( 'Parent Location' ),
				'parent_item_colon' => __( 'Parent Class Type:' ),
				'edit_item' => __( 'Edit Class Type' ),
				'update_item' => __( 'Update Class Type' ),
				'add_new_item' => __( 'Add New Class Type' ),
				'new_item_name' => __( 'New Class Type' ),
				'menu_name' => __( 'Class Type' ),
			);

			$args = array(
				'labels' => $labels,
				'slug' => 'class-type', // This controls the base slug that will display before each term
				'with_front' => false, // Don't display the category base before "/locations/"
				'hierarchical' => false, // This will allow URL's like "/locations/boston/cambridge/"
				'public' => true,
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'show_in_menu' => true,
				'show_in_admin_bar' => true,
				'menu_position' => 5,
				'show_in_quick_edit' => true,
				'show_tagcloud' => true,
				'show_admin_column' => true,
				'description' => 'xxx-desc..???',
				'capabilities' => array(
					/*'manage_terms' => 'update_core',
					'edit_terms' => 'update_core',
					'delete_terms' => 'update_core',
					'assign_terms' => 'update_core'*/
				),
			);

			$args_ext = array(
				'show_tax_meta' => false,
			);

			$tax = 'class_type';
			$pt = array ( 
				array (
					'id' => 'class', 
					'class_tax_meta' => false 
				),
			);

			$config[] = array ( 'args' => $args, 'pt' => $pt, 'tax' => $tax );








			return $config;
