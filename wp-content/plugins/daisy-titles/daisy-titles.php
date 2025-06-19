<?php
/**
 * Plugin Name:         Daisy Titles
 * Plugin URI:          https://wordpress.org/plugins/daisy-titles
 * Description:        Customize titles with colors, sizes, and fonts. Optionally hide titles on posts and pages.
 * Version:             1.0.8
 * Requires at least:   5.2
 * Requires PHP:        7.2
 * Author:              DaisyPlugins
 * Author URI:          https://daisyplugins.com
 * License:             GPL v2 or later
 * License URI:         https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:         daisy-titles
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define constants
define('DAISY_TITLES_VERSION', '1.0.8');
define('DAISY_TITLES_PLUGIN_URL', plugin_dir_url(__FILE__));
define('DAISY_TITLES_PLUGIN_PATH', plugin_dir_path(__FILE__));

// Add settings page to the admin menu
add_action('admin_menu', 'daisy_titles_add_admin_menu');
function daisy_titles_add_admin_menu() {
    // Add main menu page
    add_menu_page(
        __('Daisy Titles Settings', 'daisy-titles'),  // Page title
        __('Daisy Titles', 'daisy-titles'),           // Menu title
        'manage_options',                             // Capability
        'daisy-titles',                               // Menu slug
        'daisy_titles_options_page',                  // Callback function
        'dashicons-edit',                             // Icon (using dashicon)
        80                                            // Position (below Settings)
    );
    
    // Remove the duplicate submenu that WordPress adds by default
    remove_submenu_page('daisy-titles', 'daisy-titles');
}

// Register plugin settings
add_action('admin_init', 'daisy_titles_settings_init');
function daisy_titles_settings_init() {
    register_setting(
        'daisy_titles_plugin',
        'daisy_titles_settings',
        array(
            'sanitize_callback' => 'daisy_titles_validate_settings',
            'default' => array()
        )
    );

    // Title visibility section
    add_settings_section(
        'daisy_titles_visibility_section',
        __('Title Visibility (on Single View)', 'daisy-titles'),
        'daisy_titles_visibility_section_callback',
        'daisy_titles_plugin'
    );

    // Hide all posts titles
    add_settings_field(
        'daisy_titles_hide_all_posts',
        __('Hide Titles on All Posts', 'daisy-titles'),
        'daisy_titles_hide_all_posts_render',
        'daisy_titles_plugin',
        'daisy_titles_visibility_section'
    );

    // Hide all pages titles
    add_settings_field(
        'daisy_titles_hide_all_pages',
        __('Hide Titles on All Pages', 'daisy-titles'),
        'daisy_titles_hide_all_pages_render',
        'daisy_titles_plugin',
        'daisy_titles_visibility_section'
    );

    // Main settings section
    add_settings_section(
        'daisy_titles_main_section',
        __('<hr><br>Title Styling (on Single View)', 'daisy-titles'),
        'daisy_titles_section_callback',
        'daisy_titles_plugin'
    );

    // Title Styling Toggle
    add_settings_field(
        'daisy_titles_enable_styling',
        __('Enable Styling', 'daisy-titles'),
        'daisy_titles_enable_styling_render',
        'daisy_titles_plugin',
        'daisy_titles_main_section'
    );

    // Color field
    add_settings_field(
        'daisy_titles_color',
        __('Title Color', 'daisy-titles'),
        'daisy_titles_color_render',
        'daisy_titles_plugin',
        'daisy_titles_main_section'
    );

    // Font size field
    add_settings_field(
        'daisy_titles_font_size',
        __('Font Size (px)', 'daisy-titles'),
        'daisy_titles_font_size_render',
        'daisy_titles_plugin',
        'daisy_titles_main_section'
    );

    // Font family field
    add_settings_field(
        'daisy_titles_font_family',
        __('Font Family', 'daisy-titles'),
        'daisy_titles_font_family_render',
        'daisy_titles_plugin',
        'daisy_titles_main_section'
    );

    // // Font weight field
    // add_settings_field(
    //     'daisy_titles_font_weight',
    //     __('Font Weight', 'daisy-titles'),
    //     'daisy_titles_font_weight_render',
    //     'daisy_titles_plugin',
    //     'daisy_titles_main_section'
    // );

    // // Text transform field
    // add_settings_field(
    //     'daisy_titles_text_transform',
    //     __('Text Transform', 'daisy-titles'),
    //     'daisy_titles_text_transform_render',
    //     'daisy_titles_plugin',
    //     'daisy_titles_main_section'
    // );

    // Letter spacing field
    // add_settings_field(
    //     'daisy_titles_letter_spacing',
    //     __('Letter Spacing (px)', 'daisy-titles'),
    //     'daisy_titles_letter_spacing_render',
    //     'daisy_titles_plugin',
    //     'daisy_titles_main_section'
    // );

    // // Line height field
    // add_settings_field(
    //     'daisy_titles_line_height',
    //     __('Line Height', 'daisy-titles'),
    //     'daisy_titles_line_height_render',
    //     'daisy_titles_plugin',
    //     'daisy_titles_main_section'
    // );

    // Apply to field
    add_settings_field(
        'daisy_titles_apply_to',
        __('Apply To', 'daisy-titles'),
        'daisy_titles_apply_to_render',
        'daisy_titles_plugin',
        'daisy_titles_main_section'
    );
}

// Section callback
function daisy_titles_section_callback() {
    esc_html_e('Customize how your post titles appear on the single view.', 'daisy-titles');
}

// Visibility section callback
function daisy_titles_visibility_section_callback() {
    esc_html_e('Control the visibility of titles globally. These options will override individual post settings.', 'daisy-titles');
}

// Enable styling toggle render
function daisy_titles_enable_styling_render() {
    $options = get_option('daisy_titles_settings');
    ?>
    <label class="daisy-switch">
        <input type="checkbox" id="daisy_titles_enable_styling" name="daisy_titles_settings[daisy_titles_enable_styling]" value="1" <?php checked(isset($options['daisy_titles_enable_styling']) && $options['daisy_titles_enable_styling']); ?>>
        <span class="daisy-slider daisy-round"></span>
    </label>
    <script>
    jQuery(document).ready(function($) {
        // Show/hide styling options based on toggle state
        function toggleStylingOptions() {
            if ($('#daisy_titles_enable_styling').is(':checked')) {
                $('.daisy-styling-option').show();
            } else {
                $('.daisy-styling-option').hide();
            }
        }
        
        // Initial state
        toggleStylingOptions();
        
        // On change
        $('#daisy_titles_enable_styling').change(function() {
            toggleStylingOptions();
        });
    });
    </script>
    <?php
}

// Color field render
function daisy_titles_color_render() {
    $options = get_option('daisy_titles_settings');
    ?>
    <div class="daisy-styling-option">
        <input type="color" name="daisy_titles_settings[daisy_titles_color]" value="<?php echo esc_attr($options['daisy_titles_color'] ?? '#333333'); ?>">
    </div>
    <?php
}

// Font size field render
function daisy_titles_font_size_render() {
    $options = get_option('daisy_titles_settings');
    ?>
    <div class="daisy-styling-option">
        <input type="number" name="daisy_titles_settings[daisy_titles_font_size]" min="10" max="100" value="<?php echo esc_attr($options['daisy_titles_font_size'] ?? '24'); ?>"> px
    </div>
    <?php
}

// Font family field render
function daisy_titles_font_family_render() {
    $options = get_option('daisy_titles_settings');
    $fonts = array(
        'Arial, sans-serif' => 'Arial',
        'Helvetica, sans-serif' => 'Helvetica',
        'Times New Roman, serif' => 'Times New Roman'
    );
    ?>
    <div class="daisy-styling-option">
        <select name="daisy_titles_settings[daisy_titles_font_family]">
            <?php foreach ($fonts as $value => $label) : ?>
                <option value="<?php echo esc_attr($value); ?>" <?php selected($options['daisy_titles_font_family'] ?? '', $value); ?>>
                    <?php echo esc_html($label); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <?php
}

// Font weight field render
function daisy_titles_font_weight_render() {
    $options = get_option('daisy_titles_settings');
    $weights = array(
        'normal' => 'Normal',
        'bold' => 'Bold',
        'bolder' => 'Bolder',
        'lighter' => 'Lighter',
        '100' => '100 (Thin)',
        '200' => '200 (Extra Light)',
        '300' => '300 (Light)',
        '400' => '400 (Regular)',
        '500' => '500 (Medium)',
        '600' => '600 (Semi Bold)',
        '700' => '700 (Bold)',
        '800' => '800 (Extra Bold)',
        '900' => '900 (Black)'
    );
    ?>
<!--     <div class="daisy-styling-option">
        <select name="daisy_titles_settings[daisy_titles_font_weight]">
            <?php foreach ($weights as $value => $label) : ?>
                <option value="<?php echo esc_attr($value); ?>" <?php selected($options['daisy_titles_font_weight'] ?? 'normal', $value); ?>>
                    <?php echo esc_html($label); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div> -->
    <?php
}

// Text transform field render
function daisy_titles_text_transform_render() {
    $options = get_option('daisy_titles_settings');
    $transforms = array(
        'none' => 'None',
        'capitalize' => 'Capitalize',
        'uppercase' => 'Uppercase',
        'lowercase' => 'Lowercase'
    );
    ?>
<!--     <div class="daisy-styling-option">
        <select name="daisy_titles_settings[daisy_titles_text_transform]">
            <?php foreach ($transforms as $value => $label) : ?>
                <option value="<?php echo esc_attr($value); ?>" <?php selected($options['daisy_titles_text_transform'] ?? 'none', $value); ?>>
                    <?php echo esc_html($label); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div> -->
    <?php
}

// Letter spacing field render
function daisy_titles_letter_spacing_render() {
    $options = get_option('daisy_titles_settings');
    ?>
<!--     <div class="daisy-styling-option">
        <input type="number" name="daisy_titles_settings[daisy_titles_letter_spacing]" min="-5" max="10" step="0.1" value="<?php echo esc_attr($options['daisy_titles_letter_spacing'] ?? '0'); ?>"> px
    </div> -->
    <?php
}

 // Line height field render
 function daisy_titles_line_height_render() {
     $options = get_option('daisy_titles_settings');
     ?>
<!--      <div class="daisy-styling-option">
         <input type="number" name="daisy_titles_settings[daisy_titles_line_height]" min="0.5" max="3" step="0.1" value="<?php echo esc_attr($options['daisy_titles_line_height'] ?? '1.2'); ?>">
     </div> -->
     <?php
 }

// Apply to field render
function daisy_titles_apply_to_render() {
    $options = get_option('daisy_titles_settings');
    $post_types = get_post_types(array('public' => true), 'objects');
    $current_types = isset($options['daisy_titles_apply_to']) ? (array)$options['daisy_titles_apply_to'] : array('post', 'page');
    ?>
    <div class="daisy-styling-option">
        <?php foreach ($post_types as $post_type) : ?>
            <?php if ($post_type->name === 'attachment') continue; ?>
            <label>
                <input type="checkbox" name="daisy_titles_settings[daisy_titles_apply_to][]" value="<?php echo esc_attr($post_type->name); ?>" 
                    <?php checked(in_array($post_type->name, $current_types)); ?>>
                <?php echo esc_html($post_type->labels->name); ?>
            </label><br>
        <?php endforeach; ?>
    </div>
    <?php
}

// Hide all posts titles render
function daisy_titles_hide_all_posts_render() {
    $options = get_option('daisy_titles_settings');
    ?>
    <label class="daisy-switch">
        <input type="checkbox" name="daisy_titles_settings[daisy_titles_hide_all_posts]" value="1" <?php checked(isset($options['daisy_titles_hide_all_posts']) && $options['daisy_titles_hide_all_posts']); ?>>
        <span class="daisy-slider daisy-round"></span>
    </label>
    <?php
}

// Hide all pages titles render
function daisy_titles_hide_all_pages_render() {
    $options = get_option('daisy_titles_settings');
    ?>
    <label class="daisy-switch">
        <input type="checkbox" name="daisy_titles_settings[daisy_titles_hide_all_pages]" value="1" <?php checked(isset($options['daisy_titles_hide_all_pages']) && $options['daisy_titles_hide_all_pages']); ?>>
        <span class="daisy-slider daisy-round"></span>
    </label>
    <?php
}

// Options page
function daisy_titles_options_page() {
    // Check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }
    ?>
    <div class="wrap daisy-titles-admin">


        <div class="daisy-titles-header">
            <div class="daisy-titles-title-section">
                <h1><?php esc_html_e('Daisy Titles', 'daisy-titles'); ?></h1>
            </div>
            <div class="daisy-titles-logo">
                <span class="dashicons dashicons-edit-large"></span>
            </div>
        </div>


        
        <div class="daisy-content-wrap">
            <div class="daisy-settings-card">
                    <div class="daisy-titles-card-header">
                        <h3><span class="dashicons dashicons-edit-large"></span> <?php esc_html_e('Setting Options', 'daisy-titles'); ?></h3>
                    </div>
                    <div class="daisy-titles-card-body">
                <form action="options.php" method="post">
                    <?php
                    settings_fields('daisy_titles_plugin');
                    do_settings_sections('daisy_titles_plugin');
                    submit_button(__('Save Settings', 'daisy-titles'), 'primary', 'submit', false);
                    ?>
                </form>
            </div>
            </div>
            
            <div class="daisy-titles-sidebar">



                <div class="daisy-titles-card">
                    <div class="daisy-titles-card-header">
                        <h3><span class="dashicons dashicons-info"></span> <?php esc_html_e('About Plugin', 'daisy-titles'); ?></h3>
                    </div>
                    <div class="daisy-titles-card-body">
                        <div class="daisy-titles-info-item">
                            <h4><span class="dashicons dashicons-admin-plugins"></span> <?php esc_html_e('Version', 'daisy-titles'); ?></h4>
                            <p>1.0.8</p>
                        </div>
                        <div class="daisy-titles-info-item">
                            <h4><span class="dashicons dashicons-calendar-alt"></span> <?php esc_html_e('Release Date', 'daisy-titles'); ?></h4>
                            <p>June 14, 2025</p>
                        </div>
                        <div class="daisy-titles-info-item">
                            <h4><span class="dashicons dashicons-admin-users"></span> <?php esc_html_e('Author', 'daisy-titles'); ?></h4>
                            <p><a href="https://profiles.wordpress.org/daisyplugins/" target="_blank" style="text-decoration: none;">DaisyPlugins</a></p>
                        </div>
                        <div class="daisy-titles-info-item">
                            <h4><span class="dashicons dashicons-admin-site-alt3"></span> <?php esc_html_e('Blog', 'daisy-titles'); ?></h4>
                            <p><a href="https://daisywp.com" target="_blank" style="text-decoration: none;">DaisyWP</a></p>
                        </div>
                    </div>
                </div>


                <div class="daisy-titles-card">
                    <div class="daisy-titles-card-header">
                        <h3><span class="dashicons dashicons-testimonial"></span> <?php esc_html_e('Need Help?', 'daisy-titles'); ?></h3>
                    </div>
                    <div class="daisy-titles-card-body">
                        <p><?php esc_html_e('Check out our documentation or contact support if you have any questions.', 'daisy-titles'); ?></p>
                        <a href="https://wordpress.org/support/plugin/daisy-titles/" class="button" target="_blank"><?php esc_html_e('Get Support', 'daisy-titles'); ?></a>
                    </div>
                </div>
                
                <div class="daisy-titles-card">
                    <div class="daisy-titles-card-header">
                        <h3><span class="dashicons dashicons-thumbs-up"></span> <?php esc_html_e('Like This Plugin?', 'daisy-titles'); ?></h3>
                    </div>

                    <div class="daisy-titles-card-body">
                        <p><?php esc_html_e('Please consider leaving a review on WordPress.org.', 'daisy-titles'); ?></p>
                        <a href="https://wordpress.org/support/plugin/daisy-titles/reviews/?filter=5#new-post" class="button" target="_blank"><?php esc_html_e('Leave a Review', 'daisy-titles'); ?></a>
                    </div>
                </div>





            </div>
        </div>
    </div>
    <?php
}

// Validate and sanitize settings
add_filter('pre_update_option_daisy_titles_settings', 'daisy_titles_validate_settings');
function daisy_titles_validate_settings($new_settings) {
    $sanitized = array();
    
    // Sanitize enable styling toggle
    if (isset($new_settings['daisy_titles_enable_styling'])) {
        $sanitized['daisy_titles_enable_styling'] = (bool)$new_settings['daisy_titles_enable_styling'];
    }

    // Sanitize color
    if (isset($new_settings['daisy_titles_color'])) {
        $sanitized['daisy_titles_color'] = sanitize_hex_color($new_settings['daisy_titles_color']);
    }
    
    // Sanitize font size
    if (isset($new_settings['daisy_titles_font_size'])) {
        $size = intval($new_settings['daisy_titles_font_size']);
        $sanitized['daisy_titles_font_size'] = max(10, min(100, $size)); // Clamp between 10 and 100
    }
    
    // Sanitize font family
    if (isset($new_settings['daisy_titles_font_family'])) {
        $allowed_fonts = array(
            'Arial, sans-serif',
            'Helvetica, sans-serif',
            'Times New Roman, serif',
            'Georgia, serif',
            'Courier New, monospace',
            'Verdana, sans-serif',
            'system-ui, sans-serif',
            'Impact, sans-serif',
            'Palatino, serif',
            'Tahoma, sans-serif'
        );
        $sanitized['daisy_titles_font_family'] = in_array($new_settings['daisy_titles_font_family'], $allowed_fonts) 
            ? $new_settings['daisy_titles_font_family'] 
            : 'Arial, sans-serif';
    }
    
    // // Sanitize font weight
    // if (isset($new_settings['daisy_titles_font_weight'])) {
    //     $allowed_weights = array('normal', 'bold', 'bolder', 'lighter', '100', '200', '300', '400', '500', '600', '700', '800', '900');
    //     $sanitized['daisy_titles_font_weight'] = in_array($new_settings['daisy_titles_font_weight'], $allowed_weights) 
    //         ? $new_settings['daisy_titles_font_weight'] 
    //         : 'normal';
    // }
    
    // // Sanitize text transform
    // if (isset($new_settings['daisy_titles_text_transform'])) {
    //     $allowed_transforms = array('none', 'capitalize', 'uppercase', 'lowercase');
    //     $sanitized['daisy_titles_text_transform'] = in_array($new_settings['daisy_titles_text_transform'], $allowed_transforms) 
    //         ? $new_settings['daisy_titles_text_transform'] 
    //         : 'none';
    // }
    
    // // Sanitize letter spacing
    // if (isset($new_settings['daisy_titles_letter_spacing'])) {
    //     $spacing = floatval($new_settings['daisy_titles_letter_spacing']);
    //     $sanitized['daisy_titles_letter_spacing'] = max(-5, min(10, $spacing)); // Clamp between -5 and 10
    // }
    
    // // Sanitize line height
    // if (isset($new_settings['daisy_titles_line_height'])) {
    //     $height = floatval($new_settings['daisy_titles_line_height']);
    //     $sanitized['daisy_titles_line_height'] = max(0.5, min(3, $height)); // Clamp between 0.5 and 3
    // }
    
    // Sanitize apply to
    if (isset($new_settings['daisy_titles_apply_to'])) {
        $valid_post_types = array_keys(get_post_types(array('public' => true)));
        $sanitized['daisy_titles_apply_to'] = array();
        
        foreach ((array)$new_settings['daisy_titles_apply_to'] as $post_type) {
            if (in_array($post_type, $valid_post_types)) {
                $sanitized['daisy_titles_apply_to'][] = sanitize_key($post_type);
            }
        }
    }
    
    // Sanitize hide all posts
    if (isset($new_settings['daisy_titles_hide_all_posts'])) {
        $sanitized['daisy_titles_hide_all_posts'] = (bool)$new_settings['daisy_titles_hide_all_posts'];
    }
    
    // Sanitize hide all pages
    if (isset($new_settings['daisy_titles_hide_all_pages'])) {
        $sanitized['daisy_titles_hide_all_pages'] = (bool)$new_settings['daisy_titles_hide_all_pages'];
    }
    
    return $sanitized;
}

// Add metabox to posts and pages
add_action('add_meta_boxes', 'daisy_titles_add_meta_box');
function daisy_titles_add_meta_box() {
    $post_types = get_post_types(array('public' => true));
    
    foreach ($post_types as $post_type) {
        if ($post_type === 'attachment') continue;
        
        add_meta_box(
            'daisy_titles_visibility',
            __('Daisy Titles', 'daisy-titles'),
            'daisy_titles_meta_box_callback',
            $post_type,
            'side',
            'default'
        );
    }
}

// Metabox callback
function daisy_titles_meta_box_callback($post) {
    wp_nonce_field('daisy_titles_save_meta_box_data', 'daisy_titles_meta_box_nonce');
    
    $hide_title = get_post_meta($post->ID, '_daisy_titles_hide_title', true);
    ?>
    <div class="daisy-meta-box">
        <label for="daisy_titles_hide_title" class="daisy-toggle-label">
            <?php esc_html_e('Hide The Title', 'daisy-titles'); ?>
        </label>
        <label class="daisy-switch">
            <input type="checkbox" id="daisy_titles_hide_title" name="daisy_titles_hide_title" value="1" <?php checked($hide_title); ?>>
            <span class="daisy-slider daisy-round"></span>
        </label>
    </div>

        <p class="description"><?php esc_html_e('This will hide the title only on the single view of this post/page.', 'daisy-titles'); ?></p>
    <?php
}

// Save metabox data
add_action('save_post', 'daisy_titles_save_meta_box_data');
function daisy_titles_save_meta_box_data($post_id) {
    // Check if our nonce is set
    if (!isset($_POST['daisy_titles_meta_box_nonce'])) {
        return;
    }
    
    // Verify that the nonce is valid
    if (!wp_verify_nonce($_POST['daisy_titles_meta_box_nonce'], 'daisy_titles_save_meta_box_data')) {
        return;
    }
    
    // If this is an autosave, our form has not been submitted, so we don't want to do anything
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check the user's permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Save or delete the meta field
    if (isset($_POST['daisy_titles_hide_title'])) {
        update_post_meta($post_id, '_daisy_titles_hide_title', (bool)$_POST['daisy_titles_hide_title']);
    } else {
        delete_post_meta($post_id, '_daisy_titles_hide_title');
    }
}

// Apply styles to titles
add_filter('the_title', 'daisy_titles_modify_title', 10, 2);
function daisy_titles_modify_title($title, $id) {
    // Don't modify titles in admin area or for nav menus
    if (is_admin() || doing_filter('wp_nav_menu_objects')) {
        return $title;
    }
    
    // Only modify titles on single posts/pages
    if (!is_singular()) {
        return $title;
    }
    
    $post = get_post($id);
    if (!$post) {
        return $title;
    }
    
    // Check if title is hidden for this post
    $hide_title = get_post_meta($post->ID, '_daisy_titles_hide_title', true);
    
    // Check global hide settings if not overridden by post
    if (!$hide_title) {
        $options = get_option('daisy_titles_settings');
        
        if ($post->post_type === 'post' && isset($options['daisy_titles_hide_all_posts']) && $options['daisy_titles_hide_all_posts']) {
            $hide_title = true;
        } elseif ($post->post_type === 'page' && isset($options['daisy_titles_hide_all_pages']) && $options['daisy_titles_hide_all_pages']) {
            $hide_title = true;
        }
    }
    
    // Return empty if title should be hidden
    if ($hide_title) {
        return '';
    }
    
    // Apply styling if not hidden and styling is enabled
    $options = get_option('daisy_titles_settings');
    if (empty($options) || !isset($options['daisy_titles_enable_styling']) || !$options['daisy_titles_enable_styling']) {
        return $title;
    }
    
    // Check if we should modify this post type's title
    $post_type = get_post_type($id);
    $apply_to = isset($options['daisy_titles_apply_to']) ? (array)$options['daisy_titles_apply_to'] : array('post', 'page');
    
    if (!in_array($post_type, $apply_to)) {
        return $title;
    }
    
    // Build style attributes
    $style = array();
    
    if (!empty($options['daisy_titles_color'])) {
        $style[] = 'color: ' . esc_attr($options['daisy_titles_color']);
    }
    
    if (!empty($options['daisy_titles_font_size'])) {
        $style[] = 'font-size: ' . intval($options['daisy_titles_font_size']) . 'px';
    }
    
    if (!empty($options['daisy_titles_font_family'])) {
        $style[] = 'font-family: ' . esc_attr($options['daisy_titles_font_family']);
    }
    
    if (!empty($options['daisy_titles_font_weight'])) {
        $style[] = 'font-weight: ' . esc_attr($options['daisy_titles_font_weight']);
    }
    
    if (!empty($options['daisy_titles_text_transform'])) {
        $style[] = 'text-transform: ' . esc_attr($options['daisy_titles_text_transform']);
    }
    
    if (!empty($options['daisy_titles_letter_spacing'])) {
        $style[] = 'letter-spacing: ' . esc_attr($options['daisy_titles_letter_spacing']) . 'px';
    }
    
    if (!empty($options['daisy_titles_line_height'])) {
        $style[] = 'line-height: ' . esc_attr($options['daisy_titles_line_height']);
    }
    
    if (empty($style)) {
        return $title;
    }
    
    // Wrap title in span with styles
    return '<span style="' . esc_attr(implode('; ', $style)) . '">' . $title . '</span>';
}

// Load text domain
add_action('plugins_loaded', 'daisy_titles_load_textdomain');
function daisy_titles_load_textdomain() {
    load_plugin_textdomain('daisy-titles', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}

// Enqueue admin styles and scripts
add_action('admin_enqueue_scripts', 'daisy_titles_admin_assets');
function daisy_titles_admin_assets() {
    $screen = get_current_screen();
    
    // Only load on our settings page and post edit screens
    if ($screen->id === 'toplevel_page_daisy-titles' || $screen->base === 'post') {
        // CSS
        echo '<style>
        /* Daisy Titles Admin Styles */
        .daisy-titles-admin {
            max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
        }

        .daisy-titles-header {
            background: #e49b0f;
            /* padding: 20px; */
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 5px solid #e49b0f;


    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);

        }


.daisy-titles-title-section h1 {
    margin: 0!important;
    color: #ffffff;
    display: flex;
    align-items: center;
    font-weight: bolder!important;
    font-size: 36px!important;
    line-height: 60px!important;
    padding: 0!important;
}


.daisy-titles-logo .dashicons-edit-large {
    color: #e49b0f;
    background: #ffffff;
    width: 60px;
    height: 60px;
    font-size: 32px;
    line-height: 60px;
    text-align: center;
    border-radius: 50%;
}

        .daisy-content-wrap {
            display: flex;

 
            gap: 20px;
        }




        .daisy-settings-card {
            flex: 1;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);


    background: #fff;
    border-radius: 8px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    overflow: hidden;
        }

        .daisy-titles-sidebar {
            width: 300px;
        }

        .daisy-titles-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
            /* padding: 20px; */
overflow: hidden;
        }


.daisy-titles-card-header {
    background: #e49b0f;
    padding: 15px 20px;
}

.daisy-titles-card-header h3
        /*.daisy-titles-card h3*/ {


    margin: 0;
    font-size: 18px;
    display: flex;
    align-items: center;
    gap: 10px;
    color: #FFFFFF;
        }

.daisy-titles-card-body {
    padding: 20px;
}

        .daisy-titles-card p {
            color: #666;
            margin-top: 0;
            margin-bottom: 15px;
        }

/* Info Items */
.daisy-titles-info-item {
    margin-bottom: 15px;
}

.daisy-titles-info-item:last-child {
    margin-bottom: 0;
}

.daisy-titles-info-item h4 {
    margin: 0 0 5px;
    font-size: 15px;
    display: flex;
    align-items: center;
    gap: 8px;
    color: #1d2327;
}
.daisy-titles-info-item p {
    margin: 0;
    color: #646970;
    font-size: 14px;
    padding-left: 28px;
}

        /* Toggle switch styles */
        .daisy-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
            margin-left: 10px;
            vertical-align: middle;
        }

        .daisy-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .daisy-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 24px;
        }

        .daisy-slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .daisy-slider {
            background-color: #e49b0f;
        }

        input:checked + .daisy-slider:before {
            transform: translateX(26px);
        }

        .daisy-toggle-label {
            display: inline-block;
            margin-right: 10px;
            vertical-align: middle;
            font-weight: 500;
        }

        /* Meta box styles */

        #daisy_titles_visibility .postbox-header {
        background-color: #e49b0f;
        color: #ffffff;
    }

#daisy_titles_visibility .order-higher-indicator,
#daisy_titles_visibility .order-lower-indicator,
#daisy_titles_visibility .toggle-indicator {
    color: #ffffff;
}



        .daisy-meta-box {
            padding: 10px 0;
        }

        .daisy-meta-box .description {
            margin-top: 10px;
            color: #666;
            font-style: italic;
            font-size: 13px;
        }

        /* Styling options */
        .daisy-styling-option {
            margin: 1px 0;
        }

        @media (max-width: 782px) {
            .daisy-content-wrap {
                flex-direction: column;
            }
            
            .daisy-titles-sidebar {
                width: 100%;
            }
        }







        .daisy-meta-box {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.daisy-toggle-label {
  /* Left aligned by default */
  margin-right: auto;
}

.daisy-switch {
  /* Right aligned by default */
  margin-left: auto;
}
        </style>';

        // JavaScript
        wp_enqueue_script('jquery');
    }
}

// Clean up on uninstallation
register_uninstall_hook(__FILE__, 'daisy_titles_uninstall');
function daisy_titles_uninstall() {
    // Delete plugin options
    delete_option('daisy_titles_settings');
    
    // Remove all post meta data created by the plugin
    $posts = get_posts(array(
        'post_type' => 'any',
        'post_status' => 'any',
        'numberposts' => -1,
        'meta_key' => '_daisy_titles_hide_title'
    ));
    
    foreach ($posts as $post) {
        delete_post_meta($post->ID, '_daisy_titles_hide_title');
    }
}


// Migration notice for old plugin
add_action('admin_notices', 'daisy_titles_show_cleanup_notice');

function daisy_titles_show_cleanup_notice() {
    if (!is_plugin_active('hide-titles/hide-titles.php')) {
        return;
    }
    
    $deactivate_url = wp_nonce_url(
        add_query_arg([
            'action' => 'deactivate',
            'plugin' => 'hide-titles/hide-titles.php'
        ], admin_url('plugins.php')),
        'deactivate-plugin_hide-titles/hide-titles.php'
    );
    
    $delete_url = wp_nonce_url(
        add_query_arg([
            'action' => 'delete-selected',
            'checked[]' => 'hide-titles/hide-titles.php',
            'plugin_status' => 'all'
        ], admin_url('plugins.php')),
        'bulk-plugins'
    );
    ?>
    <div class="notice notice-warning">
        <h3><?php esc_html_e('Plugin Cleanup Recommended', 'daisy-titles'); ?></h3>
        <p>
            <?php esc_html_e('You now have "Daisy Titles" active which replaces the old "Hide Titles" plugin. The old plugin is no longer needed and should be removed to prevent potential conflicts.', 'daisy-titles'); ?>
        </p>
        <p>
            <a href="<?php echo esc_url($deactivate_url); ?>" class="button">
                <?php esc_html_e('Deactivate Hide Titles', 'daisy-titles'); ?>
            </a>
            <a href="<?php echo esc_url($delete_url); ?>" class="button button-danger" onclick="return confirm('<?php esc_attr_e('Are you sure you want to delete the old plugin?', 'daisy-titles'); ?>')">
                <?php esc_html_e('Delete Hide Titles', 'daisy-titles'); ?>
            </a>
        </p>
    </div>
    <?php
}