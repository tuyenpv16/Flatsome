<?php
// Thêm tab mới vào trang sản phẩm WooCommerce
add_filter( 'woocommerce_product_tabs', 'custom_specification_tab' );
function custom_specification_tab( $tabs ) {
    
    // Lấy dữ liệu từ trường ACF 'specification'
    $specification = get_field( 'specification' );

    // Kiểm tra nếu có dữ liệu thì thêm tab
    if ( !empty( $specification ) ) {
        $tabs['specification_tab'] = array(
            'title'    => __( 'Thông số kỹ thuật', 'woocommerce' ),
            'priority' => 10,
            'callback' => 'specification_tab_content'
        );
    }

    return $tabs;
}

// Nội dung của tab 'Thông số kỹ thuật'
function specification_tab_content() {
    // Lấy dữ liệu từ trường ACF 'specification'
    $specification = get_field( 'specification' );
    if ( !empty( $specification ) ) {
        echo '<div class="woocommerce-specification">';
        echo $specification; // Hiển thị dữ liệu của trường Wysiwyg Editor
        echo '</div>';
    }
}
