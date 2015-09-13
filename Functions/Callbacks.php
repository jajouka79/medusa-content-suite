<?php

namespace MedusaContentSuite\Functions;
 
class Callbacks
{

  public function init()
  {
		#print("<ul><li>Callbacks > init</li></ul>");
    add_action('init', array($this, 'getCallbacks'), 5);
  }

	public function getCallbacks()
	{
		$config=array('NOWT'
			
		);
		//write_log( $config);
		return $config;

	}

	public function tester($a)
	{
		$b = 'returned! ---- from ' . $a;
		return $b;

	}


    public function medusa_custom_meta_boxes_get_countries() {
	    $countryList = medusa_resources_common_data_countries();
	    return $countryList;

	}


    public function medusa_custom_meta_boxes_get_english_counties() {
	    $uk_counties = medusa_resources_common_data_uk_counties();
	    $english_counties = $uk_counties['England'];
	    return $english_counties;

	}


    public function cmb_get_post_options( $query_args ) {
	    $posts = get_posts( $query_args );
	    $post_options = array();
	    if ( $posts ) {
	        foreach ( $posts as $post ) {
	            $post_options[] = array(
	                'name' => $post->post_title,
	                'value' => $post->ID
	            );
	        }
	    }
	    //write_log('post_options:');
	    //write_log($post_options);
	    return $post_options;

	}


    public function cmb_get_pt_options( $query_args ) {
	    //write_log('cmb_get_pt_options - query_args:-');
	    //write_log($query_args );
	    $posts = get_posts( $query_args );
	    //write_log('cmb_get_pt_options - posts:-');
	    //write_log($posts );
	    $post_options = array();
	    if ( $posts ) {
	        foreach ( $posts as $post ) {
	            $post_options[$post->ID] = $post->post_title;
	        }
	    }
	    //write_log('cmb_get_pt_options:');
	    //write_log($post_options);
	    return $post_options;

	}


    public function cmb_get_pt_options_posts_with_anc( $query_args ) {

	    #write_log('cmb_get_pt_options - query_args:-');
	    #write_log($query_args );
	    $posts = get_posts( $query_args );
	    #$posts = new WP_Query( $query_args );
	    #write_log('cmb_get_pt_options - posts:-');
	    #write_log($posts );
	    $post_options = array();

	    $anc = false;

	    if ( $posts ) {
	        foreach ( $posts as $post ) {
	            #write_log( $post );

	            $str="";

	            $ancs = get_post_ancestors( $post );

	            if(count($ancs)>0){
	                #write_log( $ancs );

	                foreach($ancs as $anc){
	                    $str.=get_the_title($anc) . " > ";
	                }
	            }

	            if($str){$str = ' ('.$str.')';}
	            $post_options[$post->ID] = "(".$post->post_type.") - " . $post->post_title . $str;
	        }
	    }

	    $default = array( '' => "none" );

	    $post_options = $default + $post_options;

	    /*write_log('cmb_get_pt_options:');
	    write_log($post_options);*/
	    return $post_options;

	}


    public function cmb_get_taxonomy_list ( $allowed ) {//NOT USED

	   // write_log ( $allowed );

	    $args = array(
	      'public'   => true,
	      '_builtin' => false,
	      'name' => $allowed, //doesn't accept array :-(
	    );

	    $output = 'objects'; // names or objects
	    $operator = 'and'; // 'and' or 'or'
	    $taxonomies = get_taxonomies( $args, $output, $operator );

	    $tax_arr = array();

	    //write_log ( $taxonomies );

	    if ( $taxonomies ) :

	        foreach ( $taxonomies  as $taxonomy ) :
	            $tax_arr[] = "(taxonomy) - " . $taxonomy->name;
	        endforeach;

	    endif;

	    return $tax_arr;

	}


    public function cmb_merge_posts_and_tax_names() {

	    $tax_names = cmb_get_taxonomy_list ( 'curriculum_areas'  );
	    $post_titles = cmb_get_pt_options_posts_with_anc( 
	            array(
	                'post_type' =>
	                    array(
	                        'page',
	                        'news_article',
	                        'post',
	                        'case_study',
	                        'employer',
	                        'showcase',
	                    ),
	                'numberposts' => -1,
	                'orderby' => 'post_title',
	                'order' => 'ASC' 
	            )
	        );

	    $merged = array_merge ( $tax_names, $post_titles );

	    #write_log("merged : ");
	    #write_log($merged);

	    return $merged;

	}


    public function cmb_get_post_options2( $query_args ) {
	    $args = wp_parse_args( $query_args, array(
	            'post_type' => 'post',
	            'numberposts' => 10
	        ) );
	    //write_log($args);
	    $posts = get_posts( $args );
	    $post_options = array();
	    if ( !empty( $args['default'] ) ):
	        $post_options[] = array(
	            'name' => $args['default'],
	            'value' => 'default',
	        );
	    endif;
	    if ( $posts ):
	        foreach ( $posts as $post ) {
	            if ( !empty( $post->post_title ) ):
	                $post_options[] = array(
	                    'name' => $post->post_title,
	                    'value' => $post->ID,
	                );
	            endif;
	        }
	    endif;
	    //write_log($post_options);
	    return $post_options;

	}


	//USE this function instead of CMBs 'taxonomy-select' type, as its fucked

    public function cmb_get_term_options( $taxonomy = 'category', $args = array( 'hide_empty'=> false, 'orderby' => 'name' ) ) {
	    //write_log("cmb_get_term_options - taxonomy - " . $taxonomy);
	    $args['taxonomy'] = $taxonomy;
	    // $defaults = array( 'taxonomy' => 'category' );
	    $args = wp_parse_args( $args, array( 'taxonomy' => 'category' ) );
	    $taxonomy = $args['taxonomy'];
	    //write_log("args : ");
	    //write_log($args);
	    //write_log("taxonomy - " . $taxonomy);
	    $terms = (array) get_terms( $taxonomy, $args, true );
	    // Initate an empty array
	    $term_options = array();
	    if ( ! empty( $terms ) ) {
	        foreach ( $terms as $term ) {
	            //write_log("term : ");
	            //write_log($term);
	            $term_options[ $term->slug ] = $term->name;
	        }
	    }
	    //write_log("term_options : ");
	    //write_log($term_options);
	    return $term_options;

	}


    public function cmb_get_taxonomy_id_value_pairs( $taxonomy = 'category', $args = array( 'hide_empty'=> false, 'orderby' => 'name' ) ) {
	    //write_log("cmb_get_term_options - taxonomy - " . $taxonomy);
	    $args['taxonomy'] = $taxonomy;
	    // $defaults = array( 'taxonomy' => 'category' );
	    $args = wp_parse_args( $args, array( 'taxonomy' => 'category' ) );
	    $taxonomy = $args['taxonomy'];
	    //write_log("args : ");
	    //write_log($args);
	    //write_log("taxonomy - " . $taxonomy);
	    $terms = (array) get_terms( $taxonomy, $args, true );

	    #print_html_r($terms);

	    // Initate an empty array
	    $term_options = array();
	    if ( ! empty( $terms ) ) {
	        foreach ( $terms as $term ) {
	            //write_log("term : ");
	            //write_log($term);
	            $term_options[ $term->term_id ] = $term->name;
	        }
	    }
	    //write_log("term_options : ");
	    //write_log($term_options);
	    return $term_options;
	}

	public function cmb_get_formidable_forms_list() {
	    global $wpdb;
	    $sql = "SELECT ID, form_key, name FROM `wp_frm_forms`";
	    $forms = $wpdb->get_results( $sql );
	    //write_log($forms);
	    $form_options = array();
	    if ( ! empty( $forms ) ) {
	        foreach ( $forms as $form ) {
	            $form_options[ $form->ID ] = $form->name;
	        }
	    }
	    return $form_options;
	}

}