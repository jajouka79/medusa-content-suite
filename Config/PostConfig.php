<?php

namespace MedusaContentSuite\Config;

class PostConfig
{

  public function init()
  {
		print("<ul><li>PostConfig > init</li></ul>");
    add_action('init', array($this, 'getPostConfig'), 1);
  }

	public function getPostConfig()
	{
		//PT - News Article
			$prefix='_news_article_';
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
		        'slug'=>'news',
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
					array(
						'name'=>'cb',
						'display_name'=>'<input type="checkbox" />',
						'order_by'=>false,
						'function'=>false,
					),
					array(
						'name'=>'title',
						'display_name'=>'Title',
						'order_by'=>false,
						'function'=>false,
					),
					array(
						'name'=>'_cmb_news_article_images',
						'display_name'=>'Images',
						'order_by'=>false,
						'function'=>'medusa_admin_columns_show_images',
					),
					array(
						'name'=>'_cmb_news_article_category',
						'display_name'=>'News CategoriesXX',
						'order_by'=>false,
						'function'=>'medusa_admin_columns_show_terms_from_tax',
						'function_data_type'=>'configcats_ddd',
					),
					array(
						'name'=>'date',
						'display_name'=>'Published Date',
						'order_by'=>false,
					),
					array(
						'name'=>'author',
						'display_name'=>'Author',
						'order_by'=>false,
					),
				),
			);

			$config[0]['args'] = array(
				'labels'        => $labels,
				'rewrite'        => $rewrite,
				'description'   => 'Holds our news articles and news article data',
				'public'        => true,
				'menu_position' => 7,
				'supports'      => array( 'title', 'editor', 'attributes' ), //'excerpt', , 'comments', 'thumbnail', 'page-attributes'
				'has_archive'   => true,
				'hierarchical' => false,
				'show_ui' => true,
			);

			$config[0]['types']='news_article';
			
			$config[0]['extras']=array(
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

		//PT - Events
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
				'not_found'          => __( 'No events found' ),
				'not_found_in_trash' => __( 'No events found in the Trash' ),
				'parent_item_colon'  => '',
				'menu_name'          => 'Events',
			);

			$rewrite = array(
		        'slug'=>'events',
		        'with_front'=> true,
		        'feed'=> true,
		        'pages'=> true
	    	);

			$columns = array(
				'config'=>array(
					'pt'=>'event',
					'image_src'=>'custom',
					'image_custom_field'=>'_cmb_events_images',
					'image_show_multiple'=>false,
					'image_size_thumb'=>'thumb-square-80',
					'image_size_display'=>'display-width-1000',
				),
				'fields'=>array(
					array(
						'name'=>'cb',
						'display_name'=>'<input type="checkbox" />',
						'order_by'=>false,
						'function'=>false,
					),
					array(
						'name'=>'title',
						'display_name'=>'Title',
						'order_by'=>false,
						'function'=>false,
					),
					array(
						'name'=>'_cmb_events_images',
						'display_name'=>'Images',
						'order_by'=>false,
						'function'=>'medusa_admin_columns_show_images',
					),
					array(
						'name'=>'_cmb_events_featured',
						'display_name'=>'Featured Event?',
						'order_by'=>false,
						'function'=>'medusa_admin_columns_get_meta_value',
						'function_data_type'=>'featured_event',
					),
					array(
						'name'=>'_cmb_events_weblink',
						'display_name'=>'Web Link',
						'order_by'=>false,
						'function'=>'medusa_admin_columns_get_meta_value',
						'function_data_type'=>'weblink',
					),
					array(
						'name'=>'date',
						'display_name'=>'Published Date',
						'order_by'=>false,
					),
					array(
						'name'=>'author',
						'display_name'=>'Author',
						'order_by'=>false,
					),
				),
			);

			/*$config[1]['args'] = array(
				'labels'        => $labels,
				'rewrite'        => $rewrite,
				'description'   => 'Holds our events and event related data',
				'public'        => true,
				'menu_position' => 2,
				'supports'      => array( 'title', 'editor' ), //'excerpt', 'comments', 'thumbnail', 'attributes'
				'has_archive'   => true,
				'show_ui' 		=> true,
			);
			$config[1]['types']='event';
			$config[1]['extras']=array(
				'sidebars'=>false,
				'list_page'=>false,
				'mu_main_site_only'=>false,
				'sub_site_only'=>false,
				'columns'=>$columns,
				'default_category_tax'=>true,
				'is_product_pt'=>false,
				'show_in_nav_menu'=>true,
				'nav_menu_position'=>1,
				'show_posts_in_nav_menu'=>true,
				'create_dummy_posts'=>false,
			);*/

			return $config;

	}


}