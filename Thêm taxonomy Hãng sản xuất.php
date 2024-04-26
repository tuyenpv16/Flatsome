<?php
// Tạo taxonomy cho Hãng sản xuất
function custom_manufacturer_taxonomy() {
    $labels = array(
        'name' => 'Hãng sản xuất',
        'singular_name' => 'Hãng sản xuất',
        'search_items' => 'Tìm kiếm Hãng sản xuất',
        'all_items' => 'Tất cả Hãng sản xuất',
        'edit_item' => 'Chỉnh sửa Hãng sản xuất',
        'update_item' => 'Cập nhật Hãng sản xuất',
        'add_new_item' => 'Thêm mới Hãng sản xuất',
        'new_item_name' => 'Tên Hãng sản xuất mới',
        'menu_name' => 'Hãng sản xuất',
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'manufacturer' ),
    );
    register_taxonomy( 'manufacturer', 'product', $args );
}
add_action( 'init', 'custom_manufacturer_taxonomy' );
