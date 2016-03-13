<?php

	{
		#write_log( "PostMetaConfig > setPostMetaConfig" );


		#promoter

			$prefix = '_cmb_promoter_options_';
			$config[]=array(
				'id' => 'metabox_promoter_options',
				'title' => 'Promoter Options',
				'object_types' => array( 'promoter' ),
				'context' => 'normal',
				'priority' => 'low',
				'show_names' => true,
				'fields' => array(

					array(
						'name' => 'Web Address',
						'desc' => 'Type the price info',
						'id' => $prefix . 'web_address',
						'type' => 'text',
						'default' => 'http://',
					),

				),


				'grid' => array(

					'rows' => array(

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
					),

					array(
						'name'         => __( 'Images', 'cmb' ),
						'desc'         => __( 'Upload or add multiple photos.', 'cmb' ),
						'id'           => $prefix . 'images',
						'type'         => 'file_list',
						'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
					),

					array(
					    'name'        => __( 'Related post' ),
					    'id'          => $prefix .'related_post',
					    'type'        => 'post_search_text', // This field type
					    'post_type'   =>  'news_article',
					    'select_type' => 'radio',
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
					    'name'       => __( 'Test Date Range', 'cmb2' ),
					    'desc'       => __( 'field description (optional)', 'cmb2' ),
					    'id'         => $prefix . 'date_range',
					    'type'       => 'date_range',
					),

					array(
					    'name' => 'Location',
					    'desc' => 'Drag the marker to set the exact location',
					    'id' => $prefix . 'location',
					    'type' => 'pw_map',
					    // 'split_values' => true, // Save latitude and longitude as two separate fields
					),

					array(
					    'name'    => __( 'RGBa Colorpicker', 'cmb2' ),
					    'desc'    => __( 'Field description (optional)', 'cmb2' ),
					    'id'   => $prefix . 'test_colorpicker',
					    'type' => 'rgba_colorpicker',
					    'default'  => '#ffffff',
					),

					array(
					    'name'        => 'Slider Field',
					    'desc'        => 'Set your value.',
					    'id'          => $prefix . 'slider',
					    'type'        => 'own_slider',
					    'min'         => '0',
					    'max'         => '200',
					    'default'     => '0', // start value
					    'value_label' => 'Value:',
					),

					array(
					    'name' => 'Gallery Images',
					    'desc' => 'Upload and manage gallery images',
					    'button' => 'Manage gallery', // Optionally set button label
					    'id'   => $prefix . 'gallery_images',
					    'type' => 'pw_gallery',
					    'sanitization_cb' => 'pw_gallery_field_sanitise',
					),

					array(
					    'name'    => 'Cooking time',
					    'id'      => $prefix . 'cooking_time',
					    'desc'    => 'Cooking time',
					    'type'    => 'pw_select',
					    'options' => array(
					        '5'  => '5 minutes',
					        '10' => '10 minutes',
					        '30' => 'Half an hour',
					        '60' => '1 hour',
					    ),
					),

					array(
					    'name'    => __( 'Select an Image', 'textdomain' ),
					    'id'      => $prefix . 'gallery',
					    'type'    => 'remote_image_select',
					),


				)
			);


		#_cmb_event_options_
			$prefix = '_cmb_event_options_';
			$config[]=array(
				'id' => 'metabox_event_options',
				'title' => 'Event Options',
				'object_types' => array( 'event' ), 
				'context' => 'normal',
				'priority' => 'low',
				'show_names' => true, 
				'fields' => array(

					array(
					    'name'        => __( 'Promoter' ),
					    'id'          => 'prefix_promoter',
					    'type'        => 'post_search_text',
					    'post_type'   =>  'promoter',
					    'select_type' => 'radio',
						'show_option_none' => false,
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
						'name' => 'Show Type',
						'desc' => 'Select show type',
						'id' => $prefix . 'show_type',
						'taxonomy' => 'show_type',
						'type' => 'taxonomy_multicheck',
						'inline' => true,
					),
						
					array(
						'name'         => __( 'Images', 'cmb' ),
						'desc'         => __( 'Upload or add multiple photos.', 'cmb' ),
						'id'           => $prefix . 'images',
						'type'         => 'file_list',
						'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
					),

					array(
						'name' => 'Price',
						'desc' => 'Type the price',
						'id' => $prefix . 'price',
						'type' => 'text',
					),

					array(
						'name' => 'Web Address',
						'desc' => 'Type the web address',
						'id' => $prefix . 'web_address',
						'type' => 'text',
						'default' => 'http://',
					),

					array(
						'name' => 'Wegottickets',
						'desc' => 'Type the Wegottickets link',
						'id' => $prefix . 'wegottickets',
						'type' => 'text',
						'default' => 'http://',
					),


				),
			);







		#_cmb_class_options_
			$prefix = '_cmb_class_options_';
			$config[]=array(
				'id' => 'metabox_class_options',
				'title' => 'Class Options',
				'object_types' => array( 'class' ), 
				'context' => 'normal',
				'priority' => 'low',
				'show_names' => true, 
				'fields' => array(

					array(
					    'name'        => __( 'Related News' ),
					    'id'          => 'prefix_promoter',
					    'type'        => 'post_search_text',
					    'post_type'   =>  'news_article',
					    'select_type' => 'radio',
						'show_option_none' => false,
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
						'name' => 'Class Type',
						'desc' => 'Select class type',
						'id' => $prefix . 'class_type',
						'taxonomy' => 'class_type',
						'type' => 'taxonomy_multicheck',
						'inline' => true,
					),
						
					array(
						'name'         => __( 'Images', 'cmb' ),
						'desc'         => __( 'Upload or add multiple photos.', 'cmb' ),
						'id'           => $prefix . 'images',
						'type'         => 'file_list',
						'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
					),

					array(
						'name' => 'Price',
						'desc' => 'Type the price',
						'id' => $prefix . 'price',
						'type' => 'text',
					),

					array(
						'name' => 'Web Address',
						'desc' => 'Type the web address',
						'id' => $prefix . 'web_address',
						'type' => 'text',
						'default' => 'http://',
					),

					array(
						'name' => 'Wegottickets',
						'desc' => 'Type the Wegottickets link',
						'id' => $prefix . 'wegottickets',
						'type' => 'text',
						'default' => 'http://',
					),


				),
			);


		#$this->postMetaConfig = $config;


	}