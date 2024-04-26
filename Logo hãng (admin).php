<?php
//https://stackoverflow.com/questions/57937232/how-to-add-acf-image-field-to-wp-admin-table-column-of-custom-taxonomy
/**
 * Add ACF thumbnail columns to Product Brand custom taxonomy
 */
function add_thumbnail_columns($columns) {
    $columns['manufacturer_logo'] = __('Logo');
    $new = array();
    foreach ($columns as $key => $value) {
        if ($key=='name') // Put the Thumbnail column before the Name column
            $new['manufacturer_logo'] = 'Logo';
        $new[$key] = $value;
    }
    return $new;
    // Code end
}
add_filter('manage_edit-manufacturer_columns', 'add_thumbnail_columns');

/**
 * Output ACF thumbnail content in Linen Category custom taxonomy columns
 */
function thumbnail_columns_content($content, $column_name, $term_id) {
    if ('manufacturer_logo' == $column_name) {
        $term = get_term($term_id);
       // $linen_thumbnail_var = get_field('thumbnail_id', $term);
	   
	   $image_id = get_term_meta( $term->term_id, 'manufacturer_logo', true );
	   $image_data = wp_get_attachment_image_src( $image_id, 'full' );
	  
	   if ( $image_data != false ) {
		   $image = $image_data[0];
		  $content = '<img src="' .  esc_url( $image ) . '" width = "60px" alt="'. $term->name .'"/>';
	   }
	  
	   /*if ( $image_id ) {
			$image = wp_get_attachment_image( $image_id,  array('80', 'auto') );
			if( $image ){
			    $content = $image;
			}
  		}*/		
      
	   //$content = '<img src="'.$linen_thumbnail_var['url'].'" width="60" />';
	    //$content = print_r($image_data);
     }
    return $content;
}
add_filter('manage_manufacturer_custom_column' , 'thumbnail_columns_content' , 10 , 3);
