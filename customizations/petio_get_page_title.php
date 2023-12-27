<?php

function remove_image_size_text($image_url) {
    // Regular expression to remove the size text at the end of the image URL
    $pattern = '/(-\d+x\d+)(\.[a-zA-Z]{3,4})$/';
    $replacement = '$2'; // Replaces the matched pattern with the file extension

    // Replace the matched pattern with an empty string to remove the size text
    $new_image_url = preg_replace($pattern, $replacement, $image_url);

    return $new_image_url;
}

function petio_get_page_title(){
	global $petio_settings;
	$enable_breadcrumb = petio_get_config('breadcrumb',true);
	$enable_page_title = petio_get_config('page_title',true);
	$layout_breadcrumb = petio_get_config('layout_breadcrumb','layout_1');
	$show_subcategories = petio_get_config('show-subcategories','show');
	$subcategories_style = petio_get_config('style-subcategories','image_categories');
	$bg_default ='';
	$show_page_title_bg = petio_get_config('show_page_title_bg',false);
	if ($show_page_title_bg){
		$bg_default = isset($petio_settings['page_title_bg']['url']) ? $petio_settings['page_title_bg']['url'] : "";
		if( function_exists('is_product_category') && is_product_category()){
			$current_category = get_queried_object();
			$category_bg_breadcrumb = get_term_meta( $current_category->term_id, 'category_bg_breadcrumb', true );
			$bg = !empty($category_bg_breadcrumb) ? $category_bg_breadcrumb : $bg_default;
		}else{
			$bg = $bg_default;
		}
	}
	$class_empty = (empty($bg)) ? " empty-image" : ""; ?>
	<?php if( !is_single() ): ?>
		<div data-bg_default ="<?php echo esc_attr($bg_default); ?>" class="page-title bwp-title<?php echo esc_attr($class_empty); ?>" <?php echo (!empty($bg) ? ' style="background-image:url(' . remove_image_size_text( esc_url($bg) ). ');"' : ''); ?>>
			<div class="container" >	
			<?php if($enable_page_title): ?>
				<?php petio_page_title(); ?>
			<?php endif;
			if($enable_breadcrumb): ?>
				<?php
					if(function_exists('is_woocommerce') && is_woocommerce()){
						if (class_exists("WCV_Vendors") && WCV_Vendors::is_vendor_page()){
							get_template_part( 'breadcrumb');
						}else{
							petio_woocommerce_breadcrumb();
						}
					}else{
						get_template_part( 'breadcrumb');
					}		
				?>			
			<?php endif; ?>
			<?php if( apply_filters( 'petio_custom_category', $html = '' ) && ($show_subcategories =='show') && function_exists('is_woocommerce') && is_woocommerce() ){ ?>
				<?php
					$sub_col_large 		= petio_get_config('sub_col_large',6);
					$sub_col_medium 	= petio_get_config('sub_col_medium',4);
					$sub_col_sm 		= petio_get_config('sub_col_sm',3);
				?>
				<div class="woocommerce-product-subcategorie-content">
					<div class="subcategorie-content">
						<ul class="woocommerce-product-subcategories   slick-carousel <?php echo esc_attr($subcategories_style) ?>" data-nav="true" data-columns4="1" data-columns3="2" data-columns2="<?php echo esc_attr($sub_col_sm); ?>" data-columns1="<?php echo esc_attr($sub_col_medium); ?>" data-columns="<?php echo esc_attr($sub_col_large); ?>">
							<?php echo (apply_filters( 'petio_custom_category', $html = '' )); ?>
						</ul>
					</div>
				</div>
			<?php } ?>
			</div>
		</div><!-- .container -->
	<?php elseif (  function_exists('is_product') && !is_product() ) : ?>
		<div class="breadcrumb-noheading">
			<div class="container">
			<?php if(function_exists('is_woocommerce') && is_woocommerce()){
				if (class_exists("WCV_Vendors") && WCV_Vendors::is_vendor_page()){
					get_template_part( 'breadcrumb');
				}else{
					petio_woocommerce_breadcrumb();
				}
			}else{
				get_template_part( 'breadcrumb');
			} ?>
			</div>
		</div>	
	<?php endif; ?>
<?php }