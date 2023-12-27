<?php
function petio_shop_back_button() {
    $current_category = get_queried_object();
    if ( $current_category && ! empty( $current_category->parent ) ) {
        $parent_category = get_term( $current_category->parent, 'product_cat' );
        
        if ( $parent_category && ! is_wp_error( $parent_category ) ) {
            $parent_link = get_term_link( $parent_category );
            ?>
            <a href="<?php echo esc_url( $parent_link ); ?>" class="back-to-parent-category">
           <span class="bwp-back-button"></span>
            </a>
            <?php
        }
    }
}