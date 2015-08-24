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
		#$cb = $cb->tester('ass');

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
						'name' => 'Page description',
						'desc' => 'Type the info here',
						'id' => $prefix . 'page_desc',
						'type' => 'textarea',
					),
					array(
						'name'         => __( 'Images', 'cmb' ),
						'desc'         => __( 'Upload or add multiple photos.', 'cmb' ),
						'id'           => $prefix . 'images',
						'type'         => 'file_list',
						'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
					),
					array(
						'name' => 'Start Date',
						'desc' => 'Choose Start Date',
						'id' => $prefix . 'start_date',
						'type' => 'text_date_timestamp'
					),
					array(
						'name' => 'End Date',
						'desc' => 'Choose End Date',
						'id' => $prefix . 'end_date',
						'type' => 'text_date_timestamp'
					),

					array(
					    'name'    => 'Test Color Picker',
					    'id'      => 'wiki_test_colorpicker',
					    'type'    => 'colorpicker',
					    'default' => '#ffffff',
					),

					array(
					    'name'    => __( 'RGBa Colorpicker', 'cmb2' ),
					    'desc'    => __( 'Field description (optional)', 'cmb2' ),
					    'id'   => $prefix . 'test_colorpicker',
					    'type' => 'rgba_colorpicker',
					    'default'  => '#ffffff',
					),

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
						'desc' => 'Select if news article featured on front page X',
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
					    'name'        => __( 'Related post' ),
					    'id'          => 'prefix_related_post',
					    'type'        => 'post_search_text', // This field type
					    // post type also as array
					    'post_type'   =>  'news_article',
					    // or checkbox, used in the modal view to select the post type
					    'select_type' => 'radio'
					),

					array(
					    'name' => 'Location',
					    'desc' => 'Drag the marker to set the exact location',
					    'id' => $prefix . 'location',
					    'type' => 'pw_map',
					    // 'split_values' => true, // Save latitude and longitude as two separate fields
					),


				),


				'grid' => array(

					'rows' => array(

						array(
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
						),/*

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
		
		#post

			$prefix = '_cmb_post_options_';
			$config[]=array(
				'id' => 'metabox_post_options',
				'title' => 'Post Options',
				'object_types' => array( 'post' ), // post type
				'context' => 'normal',
				'priority' => 'low',
				'show_names' => true, // Show field names on the left
				'fields' => array(
					array(
						'name' => 'Post description',
						'desc' => 'Type the info here',
						'id' => $prefix . 'post_desc',
						'type' => 'textarea',
					),

				)
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
						'desc' => 'Select if news article featured on front page X',
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
					array(
						'name' => 'News Category',
						'desc' => 'Select news categ',
						'id' => $prefix . 'curriculum_areas',
						'taxonomy' => 'curriculum_areas',
						'type' => 'taxonomy_multicheck',
						'inline' => true,
					),

				)
			);

		#_cmb_event_options_
			$prefix = '_cmb_event_options_';
			$config[]=array(
				'id' => 'metabox_event_options',
				'title' => 'Event Options',
				'object_types' => array( 'event' ), //, 'ubs_event' post type
				'context' => 'normal',
				'priority' => 'high',
				'show_names' => true, // Show field names on the left
				'fields' => array(
					array(
						'name' => 'Featured Event?',
						'desc' => 'Select featured event',
						'id' => $prefix . 'featured_event',
						'type'    => 'select',
						'options' => array(
							'no' => __( 'No', 'cmb' ),
							'yes'   => __( 'Yes', 'cmb' ),
						),
						'default' => 'no',
						'show_option_none' => false,
					),
					/*array(
						'name' => 'Event Category',
						'desc' => 'Select event category',
						'id' => $prefix . 'event_category',
						'taxonomy' => 'event_category',
						'type' => 'taxonomy_multicheck',
						'inline'  => true,
					),*/
					
					/*array(
						'name' => 'Curriculum Areas',
						'desc' => 'Select curriculum areas',
						'id' => $prefix . 'curriculum_areas',
						'taxonomy' => 'curriculum_areas',
						'type' => 'taxonomy_multicheck',
						'inline'  => true,
					),*/

					array(
						'name' => 'Venue',
						'desc' => 'Choose Venue',
						'id' => $prefix . 'venue',
						//'type' => 'pw_multiselect',
						'type' => 'select',
						'options' => $cb->cmb_get_pt_options( array( 'post_type' => 'venue', 'numberposts' => -1, 'orderby' => 'post_title', 'order' => 'ASC' ) ),
						//'sanitization_cb' => 'pw_select2_sanitise',
					),
					array(
						'name' => 'More venue details',
						'desc' => 'Type the venue details here',
						'id' => $prefix . 'more_venue_details',
						'type' => 'textarea',
					),
					array(
						'name'         => __( 'Images', 'cmb' ),
						'desc'         => __( 'Upload or add multiple photos.', 'cmb' ),
						'id'           => $prefix . 'images',
						'type'         => 'file_list',
						'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
					),
					array(
						'name' => 'Start Date',
						'desc' => 'Choose Start Date',
						'id' => $prefix . 'start_date',
						'type' => 'text_date_timestamp'
					),
					array(
						'name' => 'End Date',
						'desc' => 'Choose End Date',
						'id' => $prefix . 'end_date',
						'type' => 'text_date_timestamp'
					),
					array(
						'name' => 'Start Time',
						'desc' => 'Choose Start Time',
						'id' => $prefix . 'start_time',
						'type' => 'text_time'
					),
					array(
						'name' => 'Finish Time',
						'desc' => 'Choose Finish Time',
						'id' => $prefix . 'finish_time',
						'type' => 'text_time'
					),
					array(
						'name' => 'Price',
						'desc' => 'Type the price info',
						'id' => $prefix . 'price',
						'type' => 'text'
					),
					/*array(
						'name' => 'Related form page',
						'desc' => 'Choose related form page',
						'id' => $prefix . 'related_form_page',
						//'type' => 'pw_multiselect',
						'type' => 'pw_multiselect',

						'options' => cmb_get_pt_options( array( 'post_type' => 'form_page', 'numberposts' => -1, 'orderby' => 'post_title', 'order' => 'ASC' ) ),
						'sanitization_cb' => 'pw_select2_sanitise',
					),*/
				),
			);

		return $config;


	}


}