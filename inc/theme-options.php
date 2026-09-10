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


/**
 * Phone number shortcode.
 *
 * @param array  $atts {
 *     Array of shortcode attributes.
 *
 *     @type string $target       Where the link should open. Accepts _self, _blank, _parent, _top. Default _self.
 *     @type string $button_id    Optional ID for the anchor. Will be sanitized.
 *     @type string $button_class Optional CSS class(es) for the anchor. Will be sanitized.
 *     @type string $wrapper      Optional class for a wrapping <div>. Will be sanitized.
 *     @type string $text         Optional prefix text (e.g. "Call "). Will be escaped for output.
 * }
 * @param string $content       Inner content (ignored – kept for compatibility).
 * @return string               HTML markup for the phone link.
 */
function mytheme_phonenumber_shortcode( $atts, $content = null ) {

	// -----------------------------------------------------------------
	// 1️⃣ Define and sanitize attributes
	// -----------------------------------------------------------------
	$atts = shortcode_atts(
		array(
			'target'    => '_self',
			'button_id' => '',
			'button_class' => '',
			'wrapper'   => '',
			'text'      => '',
		),
		$atts,
		'phonenumber'   // shortcode name – useful for debugging
	);

	// Whitelist allowed target values.
	$allowed_targets = array( '_self', '_blank', '_parent', '_top' );
	$target          = in_array( $atts['target'], $allowed_targets, true )
		? $atts['target']
		: '_self';

	// Sanitize IDs and classes.
	$button_id    = sanitize_html_class( $atts['button_id'] );
	$button_class = implode( ' ', array_map( 'sanitize_html_class', explode( ' ', $atts['button_class'] ) ) );
	$wrapper      = implode( ' ', array_map( 'sanitize_html_class', explode( ' ', $atts['wrapper'] ) ) );

	// Escape prefix text (allowed to contain HTML? If you want to allow limited HTML, use wp_kses_post() instead).
	$text_prefix = wp_kses_post( $atts['text'] ); // or esc_html() if you want plain text only.

	// -----------------------------------------------------------------
	// 2️⃣ Resolve the phone number to display
	// -----------------------------------------------------------------
	$phone_number = '';

	// Try ACF field first (returns false if field doesn't exist or empty).
	if ( function_exists( 'get_field' ) ) {
		$acf_val = get_field( 'page_phone_number' );
		if ( $acf_val !== false && $acf_val !== '' ) {
			$phone_number = $acf_val;
		}
	}

	// Fallback to theme options if ACF didn't give us a value.
	if ( empty( $phone_number ) ) {
		$option_val = get_option( 'op_text_input' );
		if ( ! empty( $option_val ) ) {
			$phone_number = $option_val;
		}
	}

	// If we still have nothing, bail out – returning an empty string prevents broken markup.
	if ( empty( $phone_number ) ) {
		return '';
	}

	// -----------------------------------------------------------------
	// 3️⃣ Build the link text and href
	// -----------------------------------------------------------------
	// Prefix text (if any) + a space + the raw phone number.
	$label = $text_prefix
		? $text_prefix . ' ' . $phone_number
		: $phone_number;

	// Clean the number for use in a tel: URI.
	// Keep only digits, plus, *, # (commonly allowed in tel:).
	$tel_clean = preg_replace( '/[^0-9+*#]/', '', $phone_number );

	// If cleaning removed everything, we cannot produce a usable link.
	if ( empty( $tel_clean ) ) {
		return '';
	}

	// Build the href attribute value.
	$href = 'tel: ' . $tel_clean; // note the space after tel: is *not* valid – remove it.
	$href = 'tel:' . $tel_clean; // correct format.

	// -----------------------------------------------------------------
	// 4️⃣ Assemble the markup
	// -----------------------------------------------------------------
	$output = '';

	if ( $wrapper !== '' ) {
		$output .= '<div class="' . esc_attr( $wrapper ) . '">';
	}

	$output .= sprintf(
		'<a href="%s" target="%s" id="%s" class="%s">%s</a>',
		esc_attr( $href ),               // href
		esc_attr( $target ),             // target
		esc_attr( $button_id ),          // id
		esc_attr( $button_class ),       // class
		esc_html( $label )               // visible text (safe)
	);

	if ( $wrapper !== '' ) {
		$output .= '</div>';
	}

	return $output;
}
add_shortcode( 'phonenumber', 'mytheme_phonenumber_shortcode' );

/**
 * Shortcode: [justnumber]
 *
 * Returns the phone number stored in the option `op_text_input_link`.
 * If the option is empty, a fallback string is returned.
 *
 * @return string  Escaped phone number (plain text, safe for HTML output).
 */
function mytheme_justnumber_shortcode() {
    // Grab the raw option value.
    $raw_number = get_option( 'op_text_input_link' );

    // If the option is set and not empty, use it; otherwise use the fallback.
    $number = ( ! empty( $raw_number ) ) ? $raw_number : '+1xxx-xxx-xxxx';

    // **Important:** Escape for HTML output.
    // We are returning plain text, so esc_html() is sufficient.
    // (If you ever want to allow limited HTML, use wp_kses_post() instead.)
    return esc_html( $number );
}
add_shortcode( 'justnumber', 'mytheme_justnumber_shortcode' );
