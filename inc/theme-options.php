<?php
add_action( 'customize_register', function($wp_customize) {

	// Add a new section (More Options section)
	$wp_customize->add_section( 'ct_more_options_section', array(
		'title' => 'More Options'
	) );

	// Text Input Option
	$wp_customize->add_setting( 'op_text_input', array(
		'type' => 'option',
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'op_text_input', array(
		'label' => 'Phone number',
		'type'  => 'text',
		'section' => 'ct_more_options_section',
		'description' => 'Site Phone number to use in site.[phonenumber]',
		'settings' => 'op_text_input'
	) ) );

    $wp_customize->add_setting( 'op_text_input_link', array(
		'type' => 'option',
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'op_text_input_link', array(
		'label' => 'Phone number Link',
		'type'  => 'text',
		'section' => 'ct_more_options_section',
		'description' => 'Site Phone number how to link to add.',
		'settings' => 'op_text_input_link'
	) ) );

} );

function formatPhoneNumber($phoneNumber) {
    // Remove all non-digit characters
    $cleaned = preg_replace('/\D/', '', $phoneNumber);
    
    // Check if we have a valid length (10 or 11 digits)
    // If 11 digits, assume first digit is country code (1)
    // If 10 digits, prepend country code
    if (strlen($cleaned) === 11 && $cleaned[0] === '1') {
        $cleaned = substr($cleaned, 1);
    } elseif (strlen($cleaned) !== 10) {
        return null; // Invalid format
    }
    
    // Format as +1XXX-XXX-XXXX
    return '+1' . substr($cleaned, 0, 3) . '-' . substr($cleaned, 3, 3) . '-' . substr($cleaned, 6);
}

function phonenumber($atts, $content = null){
	extract(shortcode_atts(array(
		'target' => '_self',
		'button_id' => '',
		'button_class' => '',
        'wraper' => '',
		'text' => ''
	), $atts));

	$pagePhoneNumber = get_field('page_phone_number');
	if($pagePhoneNumber != '') {
		$linktext = $pagePhoneNumber;
		$linkhref = formatPhoneNumber($pagePhoneNumber);
	} else {
		$linktext = (get_option('op_text_input')) ? get_option('op_text_input') : 'xxx-xxx-xxxx';
		$linkhref = (get_option('op_text_input_link')) ? get_option('op_text_input_link') : $linktext;
	}
	
	if($text) {
		$label = $text.' '.$linktext;
	} else {
		$label = $linktext;
	}

	$output = '';
    if($wraper != '') :
	    $output .= '<div class="'.$wraper.'">';
    endif;
	    $output .= '<a href="tel:'. $linkhref .'" target="'. $target .'" id="'.$button_id.'" class="'.$button_class.'">'.$label.'</a>';
    if($wraper != '') :
	    $output .= '</div>';
    endif;
	return $output;
}
add_shortcode('phonenumber', 'phonenumber' );
function justnumber(){
    return (get_option('op_text_input_link')) ? get_option('op_text_input_link') : '+1xxx-xxx-xxxx';
}
add_shortcode('justnumber', 'justnumber' );