<?php

namespace MedusaContentSuite\Config;

class PostConfig
{
	public function __construct( )
	{
		add_action( 'init', array( $this, 'getPostConfig' ), 1 );
		#do_action( 'init', $newPt );
	}

	public function getPostConfig(  )
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











		
		//PT - Promoter
			$prefix = '_promoter_';
			$labels = array(
				'name'               => _x( 'Promoters', 'post type general name' ),
				'singular_name'      => _x( 'Promoter', 'post type singular name' ),
				'add_new'            => _x( 'Add New', 'Promoter' ),
				'add_new_item'       => __( 'Add New Promoter' ),
				'edit_item'          => __( 'Edit Promoter' ),
				'new_item'           => __( 'New Promoter' ),
				'all_items'          => __( 'All Promoters' ),
				'view_item'          => __( 'View Promoter' ),
				'search_items'       => __( 'Search Promoters' ),
				'not_found'          => __( 'No promoter found' ),
				'not_found_in_trash' => __( 'No promoter found in the Trash' ),
				'parent_item_colon'  => '',
				'menu_name'          => 'Promoters',
			);

			$rewrite = array(
		        'slug'=>'promoter',
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
				'description'   => 'Holds our promoters and promoter data',
				'public'        => true,
				'menu_position' => 20,
				'supports'      => array( 'title',  'attributes' ), //'excerpt', , 'comments', 'thumbnail', 'page-attributes'
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
				'query_var' => 'promotersXXX',
				'can_export' => true,

			);

			$types = 'promoter';
			
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







		
		//PT - Event
			$prefix = '_event_';
			$labels = array(
				'name'               => _x( 'Events', 'post type general name' ),
				'singular_name'      => _x( 'Event', 'post type singular name' ),
				'add_new'            => _x( 'Add New', 'Event' ),
				'add_new_item'       => __( 'Add New Event' ),
				'edit_item'          => __( 'Edit Event' ),
				'new_item'           => __( 'New Event' ),
				'all_items'          => __( 'All Events' ),
				'view_item'          => __( 'View Event' ),
				'search_items'       => __( 'Search Events' ),
				'not_found'          => __( 'No event found' ),
				'not_found_in_trash' => __( 'No event found in the Trash' ),
				'parent_item_colon'  => '',
				'menu_name'          => 'Events',
			);

			$rewrite = array(
		        'slug'=>'event',
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
				'description'   => 'Holds our events and event data',
				'public'        => true,
				'menu_position' => 20,
				'supports'      => array( 'title', 'editor', 'attributes', 'excerpt' ), // 'comments', 'thumbnail', 'page-attributes'
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
				'query_var' => 'eventsXXX',
				'can_export' => true,

			);

			$types = 'event';
			
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
















		
		//PT - Class
			$prefix = '_class_';
			$labels = array(
				'name'               => _x( 'Classes', 'post type general name' ),
				'singular_name'      => _x( 'Class', 'post type singular name' ),
				'add_new'            => _x( 'Add New', 'Class' ),
				'add_new_item'       => __( 'Add New Class' ),
				'edit_item'          => __( 'Edit Class' ),
				'new_item'           => __( 'New Class' ),
				'all_items'          => __( 'All Classes' ),
				'view_item'          => __( 'View Class' ),
				'search_items'       => __( 'Search Classes' ),
				'not_found'          => __( 'No class found' ),
				'not_found_in_trash' => __( 'No class found in the Trash' ),
				'parent_item_colon'  => '',
				'menu_name'          => 'Classes',
			);

			$rewrite = array(
		        'slug'=>'class',
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
				'description'   => 'Holds our classes and class data',
				'public'        => true,
				'menu_position' => 20,
				'supports'      => array( 'title', 'editor', 'attributes', 'excerpt' ), // 'comments', 'thumbnail', 'page-attributes'
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
				'query_var' => 'classesXXX',
				'can_export' => true,

			);

			$types = 'class';
			
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


			#$newPt = array('arse');

			#write_log( apply_filters( 'PostConfigHook', $PostConfig, $newPt ) );

			#return apply_filters( 'PostConfigHook', $config, $newPt );


			#if( has_filter( 'PostConfigHook' ) ) :


				#$config = apply_filters( 'PostConfigHook', $config );


				#write_log("1111");
			#endif;


			return $config;

	}

	static function test(){
		return "test valid";
	}


}