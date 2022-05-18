<?php

//Reorganización del single-product

function custom_cityshop_get_sku(){
    global $product;

    echo $product -> get_sku();

}
add_action( 'woocommerce_single_product_summary', 'custom_cityshop_get_sku', 6 );