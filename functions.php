<?php
// disable Gutenberg
add_filter( 'use_block_editor_for_post', '__return_false' );

// Gọi thằng close button về bên trong lightbox
add_filter( 'flatsome_lightbox_close_btn_inside', '__return_true' );

// Style close button lightbox
add_filter( 'flatsome_lightbox_close_button', function ( $html ) {
	$html = '<button title="%title%" type="button" class="mfp-close">';
	/* f.ex. We're replacing the SVG icon into another one. */
	$html .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 475.2 475.2" width="28" height="28"><path d="M405.6 69.6C360.7 24.7 301.1 0 237.6 0s-123.1 24.7-168 69.6S0 174.1 0 237.6s24.7 123.1 69.6 168 104.5 69.6 168 69.6 123.1-24.7 168-69.6 69.6-104.5 69.6-168-24.7-123.1-69.6-168zm-19.1 316.9c-39.8 39.8-92.7 61.7-148.9 61.7s-109.1-21.9-148.9-61.7c-82.1-82.1-82.1-215.7 0-297.8C128.5 48.9 181.4 27 237.6 27s109.1 21.9 148.9 61.7c82.1 82.1 82.1 215.7 0 297.8z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#FFF"/><path d="M342.3 132.9c-5.3-5.3-13.8-5.3-19.1 0l-85.6 85.6-85.6-85.6c-5.3-5.3-13.8-5.3-19.1 0-5.3 5.3-5.3 13.8 0 19.1l85.6 85.6-85.6 85.6c-5.3 5.3-5.3 13.8 0 19.1 2.6 2.6 6.1 4 9.5 4s6.9-1.3 9.5-4l85.6-85.6 85.6 85.6c2.6 2.6 6.1 4 9.5 4 3.5 0 6.9-1.3 9.5-4 5.3-5.3 5.3-13.8 0-19.1l-85.4-85.6 85.6-85.6c5.3-5.3 5.3-13.8 0-19.1z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#FFF"/></svg>';
	$html .= '</button>';

	return $html;
} );
/*** Hide Short Description*/
add_action( 'woocommerce_single_product_summary', 'wc_remove_single_product_short_description', 12 );

function wc_remove_single_product_short_description()
{
	global $post;
	if ( ! empty( $post->post_excerpt ) )
	{
		$post->post_excerpt = '';
		echo $post->post_excerpt;
	}
}
/*
 * Thêm nút Xem thêm vào phần mô tả của danh mục sản phẩm
*/
add_action('wp_footer','devvn_readmore_taxonomy_flatsome');
function devvn_readmore_taxonomy_flatsome(){
    if(is_woocommerce() && is_tax('product_cat')):
        ?>
        <style>
            .term-description {
                overflow: hidden;
                position: relative;
                margin-bottom: 20px;
                padding-bottom: 25px;
            }
            .devvn_readmore_taxonomy_flatsome {
                text-align: center;
                cursor: pointer;
                position: absolute;
                z-index: 10;
                bottom: 0;
                width: 100%;
                background: #fff;
            }
            .devvn_readmore_taxonomy_flatsome:before {
                height: 55px;
                margin-top: -45px;
                content: "";
                background: -moz-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
                background: -webkit-linear-gradient(top, rgba(255,255,255,0) 0%,rgba(255,255,255,1) 100%);
                background: linear-gradient(to bottom, rgba(255,255,255,0) 0%,rgba(255,255,255,1) 100%);
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff00', endColorstr='#ffffff',GradientType=0 );
                display: block;
            }
            .devvn_readmore_taxonomy_flatsome a {
                color: #ff9900;
                display: block;
            }
            .devvn_readmore_taxonomy_flatsome a:after {
                content: '';
                width: 0;
                right: 0;
                border-top: 6px solid #318A00;
                border-left: 6px solid transparent;
                border-right: 6px solid transparent;
                display: inline-block;
                vertical-align: middle;
                margin: -2px 0 0 5px;
            }
            .devvn_readmore_taxonomy_flatsome_less:before {
                display: none;
            }
            .devvn_readmore_taxonomy_flatsome_less a:after {
                border-top: 0;
                border-left: 6px solid transparent;
                border-right: 6px solid transparent;
                border-bottom: 6px solid #318A00;
            }
        </style>
        <script>
            (function($){
                $(window).on('load', function(){
                    if($('.term-description').length > 0){
                        var wrap = $('.term-description');
                        var current_height = wrap.height();
                        var your_height = 200;
                        if(current_height > your_height){
                            wrap.css('height', your_height+'px');
                            wrap.append(function(){
                                return '<div class="devvn_readmore_taxonomy_flatsome devvn_readmore_taxonomy_flatsome_show"><a title="Xem thêm" href="javascript:void(0);">Xem thêm</a></div>';
                            });
                            wrap.append(function(){
                                return '<div class="devvn_readmore_taxonomy_flatsome devvn_readmore_taxonomy_flatsome_less" style="display: none"><a title="Thu gọn" href="javascript:void(0);">Thu gọn</a></div>';
                            });
                            $('body').on('click','.devvn_readmore_taxonomy_flatsome_show', function(){
                                wrap.removeAttr('style');
                                $('body .devvn_readmore_taxonomy_flatsome_show').hide();
                                $('body .devvn_readmore_taxonomy_flatsome_less').show();
                            });
                            $('body').on('click','.devvn_readmore_taxonomy_flatsome_less', function(){
                                wrap.css('height', your_height+'px');
                                $('body .devvn_readmore_taxonomy_flatsome_show').show();
                                $('body .devvn_readmore_taxonomy_flatsome_less').hide();
                            });
                        }
                    }
                });
            })(jQuery);
        </script>
    <?php
    endif;
}
/*
 * chuyển 0đ thành chữ “Liên hệ”
*/
function devvn_wc_custom_get_price_html( $price, $product ) {
    if ( ! $product->get_price() ) {
        if ( $product->is_on_sale() && $product->get_regular_price() ) {
            $regular_price = wc_get_price_to_display( $product, array( 'qty' => 1, 'price' => $product->get_regular_price() ) );
  
            $price = wc_format_price_range( $regular_price, __( 'Free!', 'woocommerce' ) );
        } else {
            $price = '<span class="amount" style="color: green"> ' . __( 'Liên hệ', 'woocommerce' ) . '</span>';
        }
    }
    return $price;
}
add_filter( 'woocommerce_get_price_html', 'devvn_wc_custom_get_price_html', 10, 2 );
/*
Thêm giá vào kết quả tìm 
*/
add_filter( 'algolia_post_product_shared_attributes', 'devvn_add_price_to_algolia', 10, 2 );
add_filter( 'algolia_searchable_product_shared_attributes', 'devvn_add_price_to_algolia', 10, 2 );
function devvn_add_price_to_algolia($shared_attributes, $post){
    $product = wc_get_product( $post );
    $shared_attributes['price_html'] = $product->get_price_html();
    return $shared_attributes;
}
/*
 * Sửa lỗi hasMerchantReturnPolicy và shippingDetails
 * Author: levantoan.com
 * */
add_filter( 'woocommerce_structured_data_product_offer', 'devvn_woocommerce_structured_data_product_offer' );
add_filter( 'wpseo_schema_product', 'devvn_wpseo_schema_product' );
add_filter( 'rank_math/snippet/rich_snippet_product_entity', 'devvn_rich_snippet_product_entity' );
add_filter( 'wp_schema_pro_schema_product', 'devvn_wp_schema_pro_schema_product' );
function get_hasMerchantReturnPolicy(){
    return '{
    "@type": "MerchantReturnPolicy",
    "applicableCountry": "vi",
    "returnPolicyCategory": "https://schema.org/MerchantReturnFiniteReturnWindow",
    "merchantReturnDays": "7",
    "returnMethod": "https://schema.org/ReturnByMail",
    "returnFees": "https://schema.org/FreeReturn"
}';
}
function get_shippingDetails(){
    return '{
  "@type": "OfferShippingDetails",
  "shippingRate": {
    "@type": "MonetaryAmount",
    "value": "0",
    "currency": "VND"
  },
  "deliveryTime": {
    "@type": "ShippingDeliveryTime",
    "businessDays": {
        "@type": "OpeningHoursSpecification",
         "dayOfWeek": [
            "https://schema.org/Monday",
            "https://schema.org/Tuesday",
            "https://schema.org/Wednesday",
            "https://schema.org/Thursday",
            "https://schema.org/Friday"
        ]
    },
    "handlingTime": {
      "@type": "QuantitativeValue",
      "minValue": "0",
      "maxValue": "3",
      "samedaydelivery" : "Yes",
      "unitCode": "DAY"
       
    },
    "transitTime": {
      "@type": "QuantitativeValue",
      "minValue": "0",
      "maxValue": "3",
      "samedaydelivery" : "Yes",
      "unitCode": "DAY"
    }                   
  },
  "shippingDestination": [
    {
      "@type": "DefinedRegion",
      "addressCountry": "VN",
      "addressRegion": ["VN"]
    }
  ]
}';
}
function devvn_wpseo_schema_product($data){
    if(isset($data['offers'])){
        $hasMerchantReturnPolicy = get_hasMerchantReturnPolicy();
        $shippingDetails = get_shippingDetails();
        foreach ($data['offers'] as $key => $offer){
            if(!isset($offers['hasMerchantReturnPolicy']) && $hasMerchantReturnPolicy){
                $data['offers'][$key]['hasMerchantReturnPolicy'] = json_decode($hasMerchantReturnPolicy, true);
            }
            if(!isset($offers['shippingDetails']) && $shippingDetails){
                $data['offers'][$key]['shippingDetails'] = json_decode($shippingDetails, true);
            }
        }
    }
    return $data;
}
function devvn_rich_snippet_product_entity($entity){
    global $product;
    if(!is_singular('product') || !$product || is_wp_error($product)) return $entity;
    $hasMerchantReturnPolicy = get_hasMerchantReturnPolicy();
    $shippingDetails = get_shippingDetails();
    if(!isset($entity['offers']['hasMerchantReturnPolicy']) && $hasMerchantReturnPolicy){
        $entity['offers']['hasMerchantReturnPolicy'] = json_decode($hasMerchantReturnPolicy, true);
    }
    if(!isset($entity['offers']['shippingDetails']) && $shippingDetails){
        $entity['offers']['shippingDetails'] = json_decode($shippingDetails, true);
    }
    return $entity;
}
function devvn_wp_schema_pro_schema_product($schema){
    if(isset($schema['offers']) && apply_filters( 'wp_schema_pro_remove_product_offers', true )) {
        $hasMerchantReturnPolicy = get_hasMerchantReturnPolicy();
        $shippingDetails = get_shippingDetails();
        if (!isset($schema['offers']['hasMerchantReturnPolicy']) && $hasMerchantReturnPolicy) {
            $schema['offers']['hasMerchantReturnPolicy'] = json_decode($hasMerchantReturnPolicy, true);
        }
        if (!isset($schema['offers']['shippingDetails']) && $shippingDetails) {
            $schema['offers']['shippingDetails'] = json_decode($shippingDetails, true);
        }
    }
    return $schema;
}
function devvn_woocommerce_structured_data_product_offer($offers){
    $hasMerchantReturnPolicy = get_hasMerchantReturnPolicy();
    $shippingDetails = get_shippingDetails();
    if(!isset($offers['hasMerchantReturnPolicy']) && $hasMerchantReturnPolicy){
        $offers['hasMerchantReturnPolicy'] = json_decode($hasMerchantReturnPolicy, true);
    }
    if(!isset($offers['shippingDetails']) && $shippingDetails){
        $offers['shippingDetails'] = json_decode($shippingDetails, true);
    }
    return $offers;
}
/*
 * chuyển mô tả danh mục sản phẩm xuống dưới sản phẩm
 *
 * */
remove_action('woocommerce_archive_description','woocommerce_taxonomy_archive_description', 10);
remove_action('woocommerce_archive_description','woocommerce_product_archive_description', 10);

add_action('woocommerce_after_main_content','woocommerce_taxonomy_archive_description', 1);
add_action('woocommerce_after_main_content','woocommerce_product_archive_description', 1);


/**
 * Fix RankMath missing `AggregateRating` on product category schema
 *
 * @author codetot
 */
add_filter('rank_math/json_ld', 'codetot_product_rich_snippet_schema', 100);
function codetot_product_rich_snippet_schema( $data ) {
    if ( !is_tax( 'product_cat' ) ) {
        return $data;
    }

    if ( isset( $data['ProductsPage']) ) {
        $product_schemas = array_map(function($product) {
            if ( empty($product['aggregateRating'] ) ) {
                $aggregateRating = [
                    '@type' => 'AggregateRating',
                    'ratingValue' => 5,
                    'ratingCount' => 1
                ];

                $product['aggregateRating'] = $aggregateRating;
            }

            return $product;
        }, $data['ProductsPage']['@graph'] );

        $data['ProductsPage']['@graph'] = $product_schemas;
    }

    return $data;
}
