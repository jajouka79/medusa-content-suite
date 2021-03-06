<?php



$config = array();


	$prefix = "_news_category_tax_fields_";

	    $config[] = array(

	    	'box_config' => array(
		        'id' => 'news_cat_tax_metabox',
		        'title' => __( 'Test news cat Metabox', 'cmb2' ),
		        // 'key' and 'value' should be exactly as follows
		        'object_types'    => array( 'term' ),
		        'taxonomies'    => array( 'news_category' ),
		        #'show_names' => true, // Show field names on the left
	        ),

	        'fields'     => array(
				array(
				    'name'    => 'Ingredients',
				    'id'      => $prefix . 'ingredients',
				    'desc'    => 'Select ingredients. Drag to reorder.',
				    'type'    => 'pw_select',
				    'options' => array(
				        'flour'  => 'Flour',
				        'salt'   => 'Salt',
				        'eggs'   => 'Eggs',
				        'milk'   => 'Milk',
				        'butter' => 'Butter',
				    ),
				),
				
				array(
				    'name'       => __( 'Test Date Range', 'cmb2' ),
				    'desc'       => __( 'field description (optional)', 'cmb2' ),
				    'id'         => $prefix . 'date_range',
				    'type'       => 'date_range',
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
				    'name'    => 'Test Color Picker',
				    'id'      => $prefix . 'test_colorpicker',
				    'type'    => 'colorpicker',
				    'default' => '#ffffff',
				),

				array(
				    'name'    => __( 'RGBa Colorpicker', 'cmb2' ),
				    'desc'    => __( 'Field description (optional)', 'cmb2' ),
				    'id'   => $prefix . 'rgba_colorpicker',
				    'type' => 'rgba_colorpicker',
				    'default'  => '#ffffff',
				),


				array(
				    'name'        => __( 'Related post' ),
				    'id'          => $prefix . 'related_post',
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





	$prefix = "_class_type_tax_fields_";

	    $config[] = array(

	    	'box_config' => array(
		        'id' => 'class_type_tax_metabox',
		        'title' => __( 'Test class type tax Metabox 2', 'cmb2' ),
		        // 'key' and 'value' should be exactly as follows
		        'object_types'    => array( 'term' ),
		        'taxonomies'    => array( 'class_type' ),
		        #'show_names' => true, // Show field names on the left
	        ),

	        'fields'     => array(
				array(
				    'name'    => 'Ingredients',
				    'id'      => $prefix . 'ingredients',
				    'desc'    => 'Select ingredients. Drag to reorder.',
				    'type'    => 'pw_select',
				    'options' => array(
				        'flour'  => 'Flour',
				        'salt'   => 'Salt',
				        'eggs'   => 'Eggs',
				        'milk'   => 'Milk',
				        'butter' => 'Butter',
				    ),
				),
				
				array(
				    'name'       => __( 'Test Date Range', 'cmb2' ),
				    'desc'       => __( 'field description (optional)', 'cmb2' ),
				    'id'         => $prefix . 'date_range',
				    'type'       => 'date_range',
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
				    'name'    => 'Test Color Picker',
				    'id'      => $prefix . 'test_colorpicker',
				    'type'    => 'colorpicker',
				    'default' => '#ffffff',
				),

				array(
				    'name'    => __( 'RGBa Colorpicker', 'cmb2' ),
				    'desc'    => __( 'Field description (optional)', 'cmb2' ),
				    'id'   => $prefix . 'rgba_colorpicker',
				    'type' => 'rgba_colorpicker',
				    'default'  => '#ffffff',
				),


				array(
				    'name'        => __( 'Related post' ),
				    'id'          => $prefix . 'related_post',
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

            )
	    );



return $config;


