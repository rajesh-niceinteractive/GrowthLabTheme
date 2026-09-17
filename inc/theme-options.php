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

function phonenumber( $atts ) {
    // Define attributes with secure defaults
    $atts = shortcode_atts(
        array(
            'target'     => '_self',   // Valid values: _self, _blank, _parent, _top
            'button_id'  => '',
            'button_class' => '',
            'wrapper'    => '',        // FIXED: Corrected typo from 'wraper' to 'wrapper'
            'text'       => '',
        ),
        $atts,
        'phonenumber'
    );

    // Get phone number data from ACF or options (preserving original logic)
    if ( get_field( 'page_phone_number' ) !== '' ) {
        $display_text = get_field( 'page_phone_number' );
        $href_value   = formatPhoneNumber( $display_text );
        
        // Fallback to raw value if formatter fails
        if ( $href_value === '' ) {
            $href_value = $display_text;
        }
    } else {
        $display_text = get_option( 'op_text_input' );
        if ( $display_text === '' ) {
            $display_text = 'xxx-xxx-xxxx';
        }
        
        $href_value   = get_option( 'op_text_input_link' );
        if ( $href_value === '' ) {
            $href_value = $display_text;
        }
    }

    // SECURITY: Sanitize href value for tel: scheme
    // Allow only valid telephone number characters (digits, *, #, -, (), space, comma)
    /*$linkhref = preg_replace( '/[^0-9\*\#\-\s\(\)\,]/', '', $href_value );*/
    $linkhref = trim( $href_value );

    // SECURITY: Escape all user-facing output
    $escaped_display_text = esc_html( $display_text );
    $text_attr            = ! empty( $atts['text'] ) ? esc_html( $atts['text'] ) : '';

    // Build label (text attribute + phone number)
    $label = $text_attr ? $text_attr . ' ' . $escaped_display_text : $escaped_display_text;

    // START OUTPUT BUILDING
    $output = '';

    // Wrapper div (if wrapper class provided)
    $wrapper_class = ! empty( $atts['wrapper'] ) ? sanitize_html_class( $atts['wrapper'] ) : '';
    if ( $wrapper_class ) {
        $output .= '<div class="' . esc_attr( $wrapper_class ) . '">';
    }

    // Anchor tag with SECURE attribute handling
    $target_attr   = ! empty( $atts['target'] ) ? esc_attr( $atts['target'] ) : '_self';
    $button_id     = ! empty( $atts['button_id'] ) ? sanitize_html_class( $atts['button_id'] ) : '';
    $button_class  = ! empty( $atts['button_class'] ) ? sanitize_html_class( $atts['button_class'] ) : '';

    $output .= '<a href="tel:+' . esc_attr( $linkhref ) . '"';
    $output .= ' target="' . esc_attr( $target_attr ) . '"';
    
    // Only add ID/class if they have values (avoids empty attributes)
    if ( $button_id ) {
        $output .= ' id="' . esc_attr( $button_id ) . '"';
    }
    if ( $button_class ) {
        $output .= ' class="' . esc_attr( $button_class ) . '"';
    }
    
    $output .= '>' . $label . '</a>';

    // Close wrapper div if opened
    if ( $wrapper_class ) {
        $output .= '</div>';
    }

    return $output;
}
add_shortcode( 'phonenumber', 'phonenumber' );

function justnumber() {
    // 1. PRIORITY: Check ACF field first (matches phonenumber shortcode logic)
    $acf_number = get_field( 'page_phone_number' );
    
    if ( $acf_number !== '' ) {
        // Use formatted version if available (with safety fallback)
        $number = formatPhoneNumber( $acf_number );
        if ( $number === '' ) {
            $number = $acf_number; // Fallback to raw ACF value if formatter fails
        }
    } 
    // 2. SECONDARY: Fall back to option if ACF empty
    else {
        $number = get_option( 'op_text_input_link' );
        if ( $number === '' ) {
            $number = '+1xxx-xxx-xxxx'; // Final fallback
        }
    }
    
    // 3. CRITICAL: Escape for safe HTML output (prevents XSS in tel: attributes)
    return esc_attr( $number );
}
add_shortcode( 'justnumber', 'justnumber' );
