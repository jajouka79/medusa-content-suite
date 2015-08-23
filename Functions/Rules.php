<?php

namespace MedusaContentSuite\Functions;
 
class Rules
{

  public function init()
  {
	#print("<ul><li>Rules > init</li></ul>");
    add_action('init', array($this, 'getRules'), 5);
    add_action('cmb_show_on', array($this, 'be_metabox_show_on_slug'), 10, 2 );
    add_filter( 'cmb2_show_on', 'ba_metabox_add_for_top_level_posts_only', 10, 2 );
  }

	public function getRules()
	{
		$config=array('NOWT'
			
		);
		//write_log( $config);
		return $config;

	}
	
	public function be_metabox_show_on_slug( $display, $meta_box ) {
	    if ( 'slug' !== $meta_box['show_on']['key'] )
	        return $display;
	    // Get the current ID
	    if ( isset( $_GET['post'] ) ) $post_id = $_GET['post'];
	    elseif ( isset( $_POST['post_ID'] ) ) $post_id = $_POST['post_ID'];
	    if ( !( isset( $post_id ) || is_page() ) ) return false;
	    $slug = get_post( $post_id )->post_name;
	    // If value isn't an array, turn it into one
	    $meta_box['show_on']['value'] = !is_array( $meta_box['show_on']['value'] ) ? array( $meta_box['show_on']['value'] ) : $meta_box['show_on']['value'];
	    // See if there's a match
	    return in_array( $slug, $meta_box['show_on']['value'] );
	}

	
	public function ba_metabox_add_for_top_level_posts_only( $display, $meta_box ) {

	    print("ba_metabox_add_for_top_level_posts_only");

	    #print_html_r($meta_box );

	    if ( 'parent-id' !== $meta_box['show_on']['key'] ):
	        print ("returning display");
	        return $display;
	    endif;

	    // Get the post's ID so we can see if it has ancestors
	    if( isset( $_GET['post'] ) ) $post_id = $_GET['post'];
	    elseif( isset( $_POST['post_ID'] ) ) $post_id = $_POST['post_ID'];
	    if( !isset( $post_id ) )
	        return false;

	    // If the post doesn't have ancestors, show the box
	    if ( !get_post_ancestors( $post_id ) )
	        return $display;
	        // Otherwise, it's not a top level post, so don't show it
	    else
	        return false;
	}
	
}