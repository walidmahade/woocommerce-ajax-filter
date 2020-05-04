<?php
/*
*
*	***** mw-woo-filter *****
*
*	Core Functions
*
*/
// If this file is called directly, abort. //
if ( ! defined( 'WPINC' ) ) {die;} // end if

/*
 * Front End Filter form
 */
function mwf_filter_form_html() {
    ?>
    <form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">
		<?php
            $taxonomies = wc_get_attribute_taxonomy_names();
            // var_dump($taxonomies);
            foreach ($taxonomies as $prod_attr) {
                if ( $terms = get_terms(
                    array (
                        'taxonomy' => $prod_attr,
                        'orderby' => 'name'
                    )
                )) :
                    echo '<select name="product_attributes['. $prod_attr .']"><option value="">' . ucfirst(str_replace('pa_', '', $prod_attr))  . '</option>';
                    foreach ( $terms as $term ) :
                        echo '<option value="' . $term->term_id . '">' . $term->name . '</option>'; // ID of the category as the value of an option
                    endforeach;
                    echo '</select>';
                endif;
            }
		?>
        <!-- <button>Apply filter</button> -->
        <input type="hidden" name="action" value="myfilter">
    </form>
    <?php
}
add_action('woocommerce_before_shop_loop', 'mwf_filter_form_html');



/*
* Custom Front End Ajax Scripts / Loads In WP Footer
*/
function mwf_frontend_ajax_form_scripts() {
?>
<script type="text/javascript">
    jQuery(function($){
        $('#filter select').change(function() {
            var filter = $('#filter');
            // console.log(filter.serialize());
            $.ajax({
                url:filter.attr('action'),
                data:filter.serialize(), // form data
                type:filter.attr('method'), // POST
                beforeSend:function(xhr){
                    filter.find('button').text('Processing...'); // changing the button label
                },
                success:function(data){
                    filter.find('button').text('Apply filter'); // changing the button label back
                    $('ul.products').html(data); // insert data
                }
            });
            return false;
        });
    });
</script>
<?php }
add_action('wp_footer','mwf_frontend_ajax_form_scripts');
