<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $title_style
 * @var $title_size
 * @var $title_align
 * @var $title_scheme
 * @var $show
 * @var $slugs
 * @var $category
 * @var $number
 * @var $columns
 * @var $orderby
 * @var $order
 * @var $is_slider
 * @var $rows
 * @var $arrows
 * @var $dots
 * @var $arrows_position
 * @var $arrows_style
 * @var $custom_catalog_style_enable
 * @var $product_catalog_style
 * @var $product_category_enable
 * @var $product_sale_count_down_enable
 * @var $column_gap
 * @var $css_animation
 * @var $animation_duration
 * @var $animation_delay
 * @var $el_class
 * @var $css
 * @var $items_md
 * @var $items_sm
 * @var $items_xs
 * @var $items_mb
 * Shortcode class
 * @var $this WPBakeryShortCode_G5Plus_Products
 */

$title = $title_style = $title_size = $title_align = $title_scheme = $show = $slugs = $category =  $number = $columns = $orderby = $order = $is_slider = $rows = $arrows = $dots = $arrows_position = $arrows_style = $custom_catalog_style_enable = $product_catalog_style = $product_category_enable = $product_sale_count_down_enable = $column_gap = $css_animation = $animation_duration = $animation_delay = $el_class = $css = $items_md = $items_sm = $items_xs = $items_mb =  '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$wrapper_attributes = array();
$styles = array();

$wrapper_classes = array(
	'woocommerce',
	'g5plus-products',
	'heading-' . $title_style,
	'clearfix',
	$this->getExtraClass( $el_class ),
	$this->getCSSAnimation( $css_animation )
);

// animation
$animation_style = $this->getStyleAnimation($animation_duration,$animation_delay);
if (sizeof($animation_style) > 0) {
	$styles = $animation_style;
}

if ( $styles ) {
	$wrapper_attributes[] = 'style="' . implode( ' ', $styles ) . '"';
}

$product_visibility_term_ids = wc_get_product_visibility_term_ids();

// get sources
$query_args = array(
	'posts_per_page' => $number,
	'post_status'    => 'publish',
	'post_type'      => 'product',
	'no_found_rows'  => 1,
	'meta_query'     => array(),
	'tax_query'      => array(
		'relation' => 'AND',
	),
);

if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) ) {
	$query_args['tax_query'] = array(
		array(
			'taxonomy' => 'product_visibility',
			'field'    => 'term_taxonomy_id',
			'terms'    => $product_visibility_term_ids['outofstock'],
			'operator' => 'NOT IN',
		),
	);
}



if (!empty($category) && ($show != 'products')) {
	$query_args['tax_query'][] = array(
		'taxonomy' 		=> 'product_cat',
		'terms' 		=>  explode(',',$category),
		'field' 		=> 'slug',
		'operator' 		=> 'IN'
	);
}

switch($show) {
	case 'sale':
		$product_ids_on_sale    = wc_get_product_ids_on_sale();
		$product_ids_on_sale[]  = 0;
		$query_args['post__in'] = $product_ids_on_sale;
		break;
	case 'new-in':
		$query_args['orderby'] = 'DESC';
		$query_args['order'] = 'date';
		break;
	case 'featured':
		$query_args['tax_query'][] = array(
			'taxonomy' => 'product_visibility',
			'field'    => 'term_taxonomy_id',
			'terms'    => $product_visibility_term_ids['featured'],
		);
		break;
	case 'top-rated':
		$query_args['meta_key'] = '_wc_average_rating';
		$query_args['orderby'] = 'meta_value_num';
		$query_args['order'] = 'DESC';
		$query_args['meta_query'] = WC()->query->get_meta_query();
		$query_args['tax_query'] = WC()->query->get_tax_query();
		break;
	case 'recent-review':
		add_filter( 'posts_clauses', array($this, 'order_by_comment_date_post_clauses' ) );
		break;
	case 'best-selling' :
		$query_args['meta_key'] = 'total_sales';
		$query_args['orderby'] = 'meta_value_num';
		break;
	case 'products':
		$product_ids = g5plus_get_product_ids_by_slugs($slugs);
		$query_args['post__in'] = array_merge( array( 0 ), $product_ids );
		$query_args['posts_per_page'] = -1;
		$query_args['orderby'] = 'post__in';
		break;
}

if (in_array($show,array('all','sale','featured'))) {
	$query_args['order'] = $order;
	switch ( $orderby ) {
		case 'price' :
			$query_args['meta_key'] = '_price';
			$query_args['orderby']  = 'meta_value_num';
			break;
		case 'rand' :
			$query_args['orderby']  = 'rand';
			break;
		case 'sales' :
			$query_args['meta_key'] = 'total_sales';
			$query_args['orderby']  = 'meta_value_num';
			break;
		default :
			$query_args['orderby']  = 'date';
	}
}

$r = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $query_args, $atts ) );


if($show =='recent-review' ){
	remove_filter( 'posts_clauses', array($this, 'order_by_comment_date_post_clauses' )  );
}

$totalRecord = $r->post_count;
$per_page = $rows * $columns;
$index = 0;
$index_sub = 0;

$g5plus_woocommerce_loop = &G5Plus_Framework_Global::get_woocommerce_loop();
$g5plus_woocommerce_loop['columns'] = $columns;
$g5plus_woocommerce_loop['columns_md'] = $items_md;
$g5plus_woocommerce_loop['columns_sm'] = $items_sm;
$g5plus_woocommerce_loop['columns_xs'] = $items_xs;
$g5plus_woocommerce_loop['columns_mb'] = $items_mb;
if ($is_slider && ($totalRecord > $per_page)) {
	$g5plus_woocommerce_loop['layout'] = 'slider';
	$g5plus_woocommerce_loop['dots'] = ($dots ? 'true' : 'false');
	$g5plus_woocommerce_loop['arrows'] = ($arrows ? 'true' : 'false');
	if ($rows > 1) {
		$g5plus_woocommerce_loop['rows'] = $rows;
	}
	$g5plus_woocommerce_loop['arrows_position'] = $arrows_position;
	$g5plus_woocommerce_loop['arrows_style'] = $arrows_style;
}
if ($custom_catalog_style_enable) {
	$g5plus_woocommerce_loop['catalog_style'] = $product_catalog_style;
	$g5plus_woocommerce_loop['category_enable'] = ($product_category_enable ? 1 : 0);
	$g5plus_woocommerce_loop['column_gap'] = $column_gap;
	$g5plus_woocommerce_loop['sale_count_down_enable'] = ($product_sale_count_down_enable ? 1 : 0);
}

$class_to_filter = implode(' ', $wrapper_classes);
$class_to_filter .= vc_shortcode_custom_css_class($css, ' ');
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);
?>
<div class="<?php echo esc_attr($css_class) ?>" <?php echo implode( ' ', $wrapper_attributes ); ?>>
	<?php $this->the_title($title,$title_style,$title_size,$title_align,$title_scheme); ?>
	<?php if ($r->have_posts()): ?>
		<?php woocommerce_product_loop_start(); ?>
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>
			<?php if (($is_slider) && ($totalRecord > $per_page) && ($rows > 1) && (($index % $per_page) === 0)): ?>
				<?php $index_sub = 0; ?>
				<div>
			<?php endif; ?>
			<?php wc_get_template_part( 'content', 'product' ); ?>
			<?php if (($is_slider) && ($totalRecord > $per_page) && ($rows > 1) && ($index_sub == ($per_page - 1))) : ?>
				</div><!-- End Loop -->
			<?php endif; ?>
			<?php
				$index_sub++;
				$index++;
			?>
		<?php endwhile; // end of the loop. ?>
		<?php if (($is_slider) && ($totalRecord > $per_page) && ($rows > 1) && ($index_sub != $per_page) && ($index > 0)) : ?>
			</div><!-- End Loop -->
		<?php endif; ?>
		<?php woocommerce_product_loop_end(); ?>
	<?php else: ?>
		<div class="item-not-found"><?php esc_html_e('No item found','g5plus-orson'); ?></div>
	<?php endif; ?>
</div>
<?php wp_reset_postdata(); ?>