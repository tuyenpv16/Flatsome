<?php
//Shortcode to display YITH Logo Brand Grid
add_shortcode('ycb_brand_grid', 'ycb_brand_grid_shortcode');

/**
 * Attributes shortcode callback.
 */
function ycb_brand_grid_shortcode($atts)
{

    $attributes = shortcode_atts(
        array(
            'brand' => '',
            'class' => 'logo-grid-wrapper',
        ),
        $atts
    );
    $brand = $attributes['brand'];
    $class = $attributes['class'];
    $html = '';
    $html .= '<div class="' . $class . '">';

    if (!empty($brand)) {
        $brand = be_dps_explode($brand);
        // start with a null string because shortcodes need to return not echo a value
        foreach ($brand as $term) {
            $term = get_term_by('slug', $term, 'manufacturer');
            $image_id = get_term_meta($term->term_id, 'manufacturer_logo', true);
            // image data stored in array, second argument is which image size to retrieve
            $image_data = wp_get_attachment_image_src($image_id, 'full');
            // image url is the first item in the array (aka 0)
            $image = $image_data[0];

            if (!empty($image)) {
                $html .= '<a href="' . get_term_link($term) . '">
                <div class="logo-grid">';
                $html .= '<img src="' .  esc_url($image) . '" alt="' . $term->name . '" title="' . $term->name . '" />';
                $html .= '<span class="logo-name">' . $term->name . '</span>';
                $html .= '</div>
                </a>';
            }
        }
    } 
    
    else {
        $terms = get_terms(array(
            'taxonomy' => 'manufacturer',
            'hide_empty' => false,
        ));
        // start with a null string because shortcodes need to return not echo a value
        foreach ($terms as $term) {
            $image_id = get_term_meta($term->term_id, 'manufacturer_logo', true);
            // image data stored in array, second argument is which image size to retrieve
            $image_data = wp_get_attachment_image_src($image_id, 'full');
            // image url is the first item in the array (aka 0)
            $image = $image_data[0];

            if (!empty($image)) {
                $html .= '<a href="' . get_term_link($term) . '">
                <div class="logo-grid">';
                $html .= '<img src="' .  esc_url($image) . '" alt="' . $term->name . '" title="' . $term->name . '" />';
                $html .= '<span class="logo-name">' . $term->name . '</span>';
                $html .= '</div>
                </a>';
            }
        }
    }



    $html .= '</div>';
    return $html;
}

function be_dps_explode($string = '') {
    $string = str_replace(', ', ',', $string);
    return explode(',', $string);
}
// [ycb_brand_grid] --> show all
// [ycb_brand_grid brand="mahr, insize, reed-instruments, national-instrument, ..."]  --> show selected
