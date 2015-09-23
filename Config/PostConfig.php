<?php

namespace MedusaContentSuite\Config;

class PostConfig
{

	public function init()
	{
		#print( "<ul><li>PostConfig > init</li></ul>" );
		#add_action( 'init', array( $this, 'getPostConfig' ), 1 );
	}

	public function getPostConfig()
	{

		$config = array();

		
		//PT - News Article
			$prefix = '_news_article_';
			$labels = array(
				'name'               => _x( 'News Articles', 'post type general name' ),
				'singular_name'      => _x( 'News Article', 'post type singular name' ),
				'add_new'            => _x( 'Add New', 'News Article' ),
				'add_new_item'       => __( 'Add New News Article' ),
				'edit_item'          => __( 'Edit News Article' ),
				'new_item'           => __( 'New News Article' ),
				'all_items'          => __( 'All News Articles' ),
				'view_item'          => __( 'View News Article' ),
				'search_items'       => __( 'Search News Articles' ),
				'not_found'          => __( 'No news article found' ),
				'not_found_in_trash' => __( 'No news article found in the Trash' ),
				'parent_item_colon'  => '',
				'menu_name'          => 'News Articles',
			);

			$rewrite = array(
		        'slug'=>'news_article',
		        'with_front'=> true,
		        'feed'=> true,
		        'pages'=> true
	    	);

			$columns = array(
				'config'=>array(
					'pt'=>'news_article',
					'image_src'=>'custom',
					'image_custom_field'=>'_cmb_news_article_images',
					'image_show_multiple'=>true,
					'image_size_thumb'=>'thumb-square-80',
					'image_size_display'=>'display-width-1000',
				),
				'fields'=>array(

				),
			);

			$args = array(
				'labels'        => $labels,
				'rewrite'        => $rewrite,
				'description'   => 'Holds our news articles and news article data',
				'public'        => true,
				'menu_position' => 20,
				'supports'      => array( 'title', 'editor', 'attributes' ), //'excerpt', , 'comments', 'thumbnail', 'page-attributes'
				'has_archive'   => true,
				'hierarchical' => false,
				'exclude_from_search' => false,
				'publicly_queryable' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'show_in_admin_bar' => true,
				'show_in_nav_menus' => true,
				'menu_icon' => 'dashicons-admin-page',
				#'capability_type' => null, #array('news', 'news'), #plural
				#'capabilities' => null,
				#'map_meta_cap' => null,
				#'register_meta_box_cb' => null,
				#'taxonomies' => null,
				'query_var' => 'news_articlesXXX',
				'can_export' => true,

			);

			$types = 'news_article';
			
			$extras = array(
				'sidebars'=>false,
				'list_page'=>739,
				'mu_main_site_only'=>false,
				'sub_site_only'=>false,
				'columns'=>$columns,
				'default_category_tax'=>true,
				'is_product_pt'=>false,
				'show_in_nav_menu'=>true,
				'nav_menu_position'=>1,
				'show_posts_in_nav_menu'=>true,
				'create_dummy_posts'=>false,
				'url_query_vars'=>array( 'page_id' ),
			);

			$config[] = array ( 'args' => $args, 'types' => $types, 'extras' => $extras );











		
		//PT - Service
			$prefix = '_service_';
			$labels = array(
				'name'               => _x( 'Services', 'post type general name' ),
				'singular_name'      => _x( 'Service', 'post type singular name' ),
				'add_new'            => _x( 'Add New', 'Service' ),
				'add_new_item'       => __( 'Add New Service' ),
				'edit_item'          => __( 'Edit Service' ),
				'new_item'           => __( 'New Service' ),
				'all_items'          => __( 'All Services' ),
				'view_item'          => __( 'View Service' ),
				'search_items'       => __( 'Search Services' ),
				'not_found'          => __( 'No service found' ),
				'not_found_in_trash' => __( 'No service found in the Trash' ),
				'parent_item_colon'  => '',
				'menu_name'          => 'Services',
			);

			$rewrite = array(
		        'slug'=>'service',
		        'with_front'=> true,
		        'feed'=> true,
		        'pages'=> true
	    	);

			$columns = array(
				'config'=>array(
				),
				'fields'=>array(

				),
			);

			$args = array(
				'labels'        => $labels,
				'rewrite'        => $rewrite,
				'description'   => 'Holds our services and service data',
				'public'        => true,
				'menu_position' => 20,
				'supports'      => array( 'title', 'editor', 'attributes' ), //'excerpt', , 'comments', 'thumbnail', 'page-attributes'
				'has_archive'   => true,
				'hierarchical' => false,
				'exclude_from_search' => false,
				'publicly_queryable' => true,
				'show_ui' => true,
				'show_in_menu' => true,
				'show_in_admin_bar' => true,
				'show_in_nav_menus' => true,
				'menu_icon' => 'dashicons-admin-page',
				#'capability_type' => null, #array('news', 'news'), #plural
				#'capabilities' => null,
				#'map_meta_cap' => null,
				#'register_meta_box_cb' => null,
				#'taxonomies' => null,
				'query_var' => 'servicesXXX',
				'can_export' => true,

			);

			$types = 'service';
			
			$extras = array(
				'sidebars'=>false,
				'list_page'=>739,
				'mu_main_site_only'=>false,
				'sub_site_only'=>false,
				'columns'=>$columns,
				'default_category_tax'=>true,
				'is_product_pt'=>false,
				'show_in_nav_menu'=>true,
				'nav_menu_position'=>1,
				'show_posts_in_nav_menu'=>true,
				'create_dummy_posts'=>false,
				'url_query_vars'=>array( 'page_id' ),
			);

			$config[] = array ( 'args' => $args, 'types' => $types, 'extras' => $extras );













			return $config;

	}


}