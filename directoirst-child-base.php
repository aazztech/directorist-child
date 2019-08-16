<?php
/**
Plugin Name: Directorist - Child
Plugin URI: https://aazztech.com/product/directorist-child
Description: This is a child plugin of Directorist to customize & extend it.
Version: 1.0.0
Author: AazzTech
Author URI: https://aazztech.com
License: GPLv2 or later
Text Domain: directorist-child
Domain Path: /languages
 */
// prevent direct access to the file
defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );

// code goes here....
/******************* Search box in one line *********************************/

function atbdp_search_form_fields()
{
    $categories = get_terms(ATBDP_CATEGORY, array('hide_empty' => 0));
    $locations = get_terms(ATBDP_LOCATION, array('hide_empty' => 0));
    $require_cat = get_directorist_option('require_search_category');
    $require_cat = !empty($require_cat) ? "required" : "";
    $require_loc = get_directorist_option('require_search_location');
    $require_loc = !empty($require_loc) ? "required" : "";
    $search_fields = get_directorist_option('search_tsc_fields', array('search_text', 'search_category', 'search_location'));
    $search_placeholder = get_directorist_option('search_placeholder', esc_attr_x('What are you looking for?', 'placeholder', 'your_textdomain'));
    $search_category_placeholder = get_directorist_option('search_category_placeholder', esc_html__('Select a category', 'your_textdomain'));
    $search_location_placeholder = get_directorist_option('search_location_placeholder', esc_html__('Select a location', 'your_textdomain'));
    $search_listing_text = get_directorist_option('search_listing_text', esc_html__('Search Listing', 'your_textdomain'));
    $search_button = get_directorist_option('search_button', 1);

    if (in_array('search_text', $search_fields)) { ?>
        <div class="single_search_field search_query">
            <input class="form-control search_fields" type="text" name="q"
                   placeholder="<?php echo esc_html($search_placeholder); ?>">
        </div>
    <?php } ?>
    <?php if (in_array('search_category', $search_fields)) { ?>
    <div class="single_search_field search_category">
        <select <?php echo esc_attr($require_cat); ?>
            name="in_cat" class="search_fields form-control" id="at_biz_dir-category">
            <option value=""><?php echo esc_html($search_category_placeholder); ?></option>
            <?php
            foreach ($categories as $category) {
                ?>
                <option id='atbdp_category'
                        value='<?php echo esc_attr($category->term_id); ?>'>
                    <?php echo esc_attr($category->name); ?>
                </option>
                <?php
            } ?>
        </select>
    </div>
<?php }
    if (in_array('search_location', $search_fields)) { ?>
        <div class="single_search_field search_location">
            <select <?php echo esc_attr($require_loc); ?>
                name="in_loc" class="search_fields form-control" id="at_biz_dir-location">
                <option value=""><?php echo esc_html($search_location_placeholder); ?></option>
                <?php
                foreach ($locations as $location) {
                    ?>
                    <option id='atbdp_location'
                            value='<?php echo esc_attr($location->term_id); ?>'>
                        <?php echo esc_attr($location->name); ?>
                    </option>
                    <?php
                } ?>
            </select>
        </div>
    <?php }
    if (!empty($search_button)) { ?>
        <div class="atbd_submit_btn">
            <button type="submit" class="btn btn-primary btn-lg btn_search">
                <?php echo esc_attr($search_listing_text); ?>
            </button>
        </div>
    <?php }
}
add_action('atbdp_search_form_fields', 'atbdp_search_form_fields');
function atbdp_search_btn(){
    return;
}
add_filter('atbdp_search_listing_button', 'atbdp_search_btn');

function atbdp_custom_style(){
   wp_enqueue_style('atbdp_custom_style', plugin_dir_url(__FILE__).'assets/public/style.css');
}
add_action( 'wp_enqueue_scripts', 'atbdp_custom_style');
/******************* END Search box in one line *********************************/
