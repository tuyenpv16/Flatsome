<?php
function custom_product_tabs($tabs) {
    global $product;
    // Lấy dữ liệu từ ACF Repeater Field
    $datasheets = get_field('datasheet', $product->get_id());
    // Kiểm tra xem có tài liệu nào không
    if (!empty($datasheets)) {
        // Nếu có tài liệu, thêm tab mới
        $tabs['datasheet_tab'] = array(
            'title'    => __('Tài liệu sản phẩm', 'woocommerce'),
            'priority' => 15,
            'callback' => 'custom_datasheet_tab_content'
        );
    }
    return $tabs;
}
add_filter('woocommerce_product_tabs', 'custom_product_tabs');

// Hàm hiển thị nội dung của tab mới
function custom_datasheet_tab_content() {
    global $product;
    $datasheets = get_field('datasheet', $product->get_id());
    if ($datasheets) {
        echo '<ul>';
        foreach ($datasheets as $datasheet) {
            $file = $datasheet['file']; // Đường dẫn đến file đã tải lên
			echo '<li><a href="' . esc_url($file['url']) . '" target="_blank">' . esc_html($file['title']) . '</a></li>'; // Thêm thuộc tính target="_blank" để mở trong tab mới
        }
        echo '</ul>';
    } else {
        echo '<p>' . esc_html__('Không có tài liệu nào được tải lên cho sản phẩm này.', 'woocommerce') . '</p>';
    }
}
