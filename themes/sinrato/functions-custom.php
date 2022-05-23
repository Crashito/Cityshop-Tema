<?php

//Reorganización del single-product

function custom_cityshop_get_sku(){
    global $product;
    echo $product -> get_sku();

}
add_action( 'woocommerce_single_product_summary', 'custom_cityshop_get_sku', 6 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt',20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta',40 );


function custom_cityshop_get_attributes(){
    global $product;
    
    $heading = apply_filters( 'woocommerce_product_additional_information_heading', __( '', 'woocommerce' ) );
    
    if ( $heading ) {
         echo esc_html( $heading );
    }
    do_action( 'woocommerce_product_additional_information', $product );
    
}
add_action( 'woocommerce_single_product_summary', 'custom_cityshop_get_attributes', 40 );