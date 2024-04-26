<?php
// Tạo shortcode để hiển thị Hãng sản xuất và tuỳ chỉnh vị trí
function display_manufacturer_shortcode() {
    global $product;
    $terms = get_the_term_list( $product->ID, 'manufacturer', '<span>Hãng sản xuất: ', ', ', '</span>' );
    if ( $terms ) {
        return $terms;
    } else {
        return 'Không có thông tin về hãng sản xuất.';
    }
}
add_shortcode( 'manufacturer_info', 'display_manufacturer_shortcode' );

// shortcode: [manufacturer_info]
