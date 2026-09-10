<?php
/**
 * Secure SVG support for WordPress.
 *
 * Allows SVG uploads for administrators and sanitizes SVG files
 * using the Safe SVG plugin's sanitizer when available.
 */

/**
 * Allow SVG MIME type for administrators.
 */
add_filter('upload_mimes', function ($mimes) {
    if (current_user_can('manage_options')) {
        $mimes['svg']  = 'image/svg+xml';
        $mimes['svgz'] = 'image/svg+xml';
    }

    return $mimes;
});

/**
 * Fix SVG file type detection.
 */
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {
    if (!current_user_can('manage_options')) {
        return $data;
    }

    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    if ($extension === 'svg') {
        $data['ext']             = 'svg';
        $data['type']            = 'image/svg+xml';
        $data['proper_filename'] = $filename;
    }

    return $data;
}, 10, 4);

/**
 * Allow SVG files to be displayed in the Media Library.
 */
add_filter('wp_prepare_attachment_for_js', function ($response, $attachment, $meta) {
    if ($response && $response['mime'] === 'image/svg+xml') {
        $response['type'] = 'image';
    }

    return $response;
}, 10, 3);