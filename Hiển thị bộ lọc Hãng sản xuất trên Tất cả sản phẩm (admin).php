<?php
// Thêm bộ lọc Hãng sản xuất vào trang "Tất cả sản phẩm" trong menu Sản phẩm
add_action( 'restrict_manage_posts', 'manufacturer_filter_dropdown' );
function manufacturer_filter_dropdown() {
    global $typenow;

    // Chỉ áp dụng cho trang quản lý sản phẩm của WooCommerce
    if ( 'product' === $typenow ) {
        $taxonomy = 'manufacturer';
        $selected = isset( $_GET['manufacturer_filter'] ) ? $_GET['manufacturer_filter'] : '';
        $info_taxonomy = get_taxonomy( $taxonomy );
        wp_dropdown_categories( array(
            'show_option_all' => "Chọn $info_taxonomy->label",
            'taxonomy' => $taxonomy,
            'name' => 'manufacturer_filter',
            'orderby' => 'name',
            'selected' => $selected,
            'show_count' => true,
            'hide_empty' => false,
        ) );
    }
}

// Xử lý bộ lọc khi có yêu cầu từ dropdown
add_filter( 'parse_query', 'apply_manufacturer_filter_query' );
function apply_manufacturer_filter_query( $query ) {
    global $pagenow;
    $taxonomy = 'manufacturer';

    if ( 'edit.php' === $pagenow && isset( $_GET['manufacturer_filter'] ) && $_GET['manufacturer_filter'] != 0 ) {
        $query->query_vars['tax_query'] = array(
            array(
                'taxonomy' => $taxonomy,
                'field' => 'id',
                'terms' => $_GET['manufacturer_filter'],
                'include_children' => false,
            )
        );
    }
}
