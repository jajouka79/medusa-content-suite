<?php

namespace Codecourse\Functions;

#my\foo();

echo "Codecourse\FunctionsCodecourse\Functions<br>";

add_action( 'cmb2_init', 'Codecourse\Functions\yourprefix_register_demo_metabox' );

/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
 */
function yourprefix_register_demo_metabox() {

	echo "yourprefix_register_demo_metabox<br>";

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_yourprefix_demo_';

	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => __( 'Test Metabox', 'cmb2' ),
		'object_types'  => array( 'page', ), // Post type
	) );

	$cmb_demo->add_field( array(
		'name'       => __( 'Test Text', 'cmb2' ),
		'desc'       => __( 'field description (optional)', 'cmb2' ),
		'id'         => $prefix . 'text',
		'type' => 'pw_select',
		'options' => array( "op1", "op2", "op3"),
		'sanitization_cb' => 'pw_select2_sanitise',		
		//'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
	) );

	$cmb_demo->add_field( array(
		'name' => __( 'Test Text Small', 'cmb2' ),
		'desc' => __( 'field description (optional)', 'cmb2' ),
		'id'   => $prefix . 'textsmall',
		'type' => 'text_small',
	) );
}

class FunctionsInc
{
	public function __construct()
	{
echo "FunctionsIncFunctionsIncFunctionsIncFunctionsInc<br>";
	}
}