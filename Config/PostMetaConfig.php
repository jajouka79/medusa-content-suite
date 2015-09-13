<?php

namespace MedusaContentSuite\Config;

use MedusaContentSuite\Functions\Callbacks as Callbacks;

class PostMetaConfig
{

	public function init()
	{
		#print("<ul><li>PostMetaConfig > init</li></ul>");
		add_action( 'init', array( $this, 'getPostMetaConfig' ), 1 );
	}

	public function getPostMetaConfig()
	{

		$cb = new Callbacks();
		#$cb = $cb->tester('testvar');

		#page

			$prefix = '_cmb_page_options_';
			$config[]=array(
				'id' => 'metabox_page_options',
				'title' => 'Page Options',
				'object_types' => array( 'page' ), // post type
				'context' => 'normal',
				'priority' => 'low',
				'show_names' => true, // Show field names on the left
				'fields' => array(

					array(
						'name'         => __( 'Images', 'cmb' ),
						'desc'         => __( 'Upload or add multiple photos.', 'cmb' ),
						'id'           => $prefix . 'images',
						'type'         => 'file_list',
						'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
					),

					array(
					    'name'        => __( 'Related post' ),
					    'id'          => 'prefix_related_post',
					    'type'        => 'post_search_text', // This field type
					    // post type also as array
					    'post_type'   =>  'news_article',
					    // or checkbox, used in the modal view to select the post type
					    'select_type' => 'radio'
					),

				),


				'grid' => array(

					'rows' => array(

						/*array(
							'columns' => array(
								array(
									$prefix . 'images', 
									'class' => 'col-md-6 '
								),
								array(
									$prefix . 'start_date', 
									'class' => 'col-md-3 '
								),
								array(
									$prefix . 'end_date', 
									'class' => 'col-md-3 '
								),
							),
						),
*/
						/*

						array(
							'columns' => array(
								array(
									'wiki_test_colorpicker', 
									'class' => 'col-md-2 '
								),
								array(
									$prefix . 'test_colorpicker', 
									'class' => 'col-md-2 '
								),
								array(
									$prefix . 'images', 
									'class' => 'col-md-6
								'),															
							),
						),


						array(
							'columns' => array(

								array(
									$prefix . 'featured_news_article', 
									'class' => 'col-md-2'
								),
								array(
									$prefix . 'featured_on_front', 
									'class' => 'col-md-2'
								),
							),
						),*/
					),
				),
			);



		#_cmb_news_options_

			$prefix = '_cmb_news_options_';
			$config[]=array(
				'id' => 'metabox_news_articles_options',
				'title' => 'News Article Options',
				'object_types' => array( 'news_article' ), // post type
				'context' => 'normal',
				'priority' => 'low',
				'show_names' => true, // Show field names on the left
				'fields' => array(
					array(
						'name' => 'Featured News Article?',
						'desc' => 'Select featured news article',
						'id' => $prefix . 'featured_news_article',
						'type'    => 'select',
						'options' => array(
							'no' => __( 'No', 'cmb' ),
							'yes'   => __( 'Yes', 'cmb' ),
						),
						'show_option_none' => false,
					),
					array(
						'name' => 'Featured on Front Page?',
						'desc' => 'Select if news article featured on front page',
						'id' => $prefix . 'featured_on_front',
						'type'    => 'select',
						'options' => array(
							'no' => __( 'No', 'cmb' ),
							'yes'   => __( 'Yes', 'cmb' ),
						),
						//'default' => 'no',
						'show_option_none' => false,
					),
					array(
						'name'         => __( 'Images', 'cmb' ),
						'desc'         => __( 'Upload or add multiple photos.', 'cmb' ),
						'id'           => $prefix . 'images',
						'type'         => 'file_list',
						'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
					),

				)
			);

		#_cmb_service_options_
			$prefix = '_cmb_service_options_';
			$config[]=array(
				'id' => 'metabox_service_options',
				'title' => 'Service Options',
				'object_types' => array( 'service' ), //, 'ubs_service' post type
				'context' => 'normal',
				'priority' => 'high',
				'show_names' => true, // Show field names on the left
				'fields' => array(
					array(
						'name' => 'Featured Service?',
						'desc' => 'Select featured service',
						'id' => $prefix . 'featured_service',
						'type'    => 'select',
						'options' => array(
							'no' => __( 'No', 'cmb' ),
							'yes'   => __( 'Yes', 'cmb' ),
						),

					),

					array(
						'name'         => __( 'Images', 'cmb' ),
						'desc'         => __( 'Upload or add multiple photos.', 'cmb' ),
						'id'           => $prefix . 'images',
						'type'         => 'file_list',
						'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
					),			

				),
			);

		return $config;


	}


}