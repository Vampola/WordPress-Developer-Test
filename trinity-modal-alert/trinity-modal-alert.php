<?php

/**
 * Plugin Name: Trinity Modal Alert Box
 * Plugin URI: http://wampola.com
 * Description: Show a modal on every page or custom post selected from admin panel 
 * Version: 1.0
 * Author: Damir Vampola 
 * Author URI: http://wampola.com
 * Licence: GPLv2 or later
 */
include('includes/display-functions.php');

function trinity_modal_options_page()
{
    ?>
    <div class="wrap">
        <?php screen_icon(); ?>
        <h2><?php _e('Trinity Plugin Modal Test', 'tt-test') ?></h2>
        <form method="POST" action="options.php">
            <?php settings_fields('tt_modal_settings'); ?>
            <table class="form-table">
                <?php trinity_modal_do_options(); ?>
            </table>
            <input type="submit" class="button-primary" value="<?php _e('Save Options', 'tt-test') ?>" />
            <input type="hidden" name="trinity-modal-submit" value="Y" />
        </form>
    </div>
<?php
}

function trinity_modal_menu()
{
    add_submenu_page('options-general.php', __('Modal/Alert', 'modal-alert'), __('Modal/Alert', 'modal-alert'), 'administrator', 'tt_modal', 'trinity_modal_options_page');
}
add_action('admin_menu', 'trinity_modal_menu');


/**
 * Add scripts in back-end.
 *
 */
function plugin_name_scripts()
{   
    wp_enqueue_script('jquery-min', 'https://code.jquery.com/jquery-3.4.1.min.js', array(), null, true);
}
add_action('init', 'plugin_name_scripts');

/**
 * Add scripts and css.
 *
 */
function trinity_modal_scripts()
{
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.4.1.min.js', array(), null, false);
    wp_enqueue_script( 'modaljs' , plugins_url( '/js/bootstrap.min.js',  __FILE__), array( 'jquery' ), '3.3.7', true );
    wp_enqueue_script('main', plugins_url('js/main.js', __FILE__), array('jquery'), null, false);
    // css
    wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
}
add_action('wp_print_scripts', 'trinity_modal_scripts');


/**
 * Set the database where the options are going to be stored
 *
 */
function trinity_modal_init()
{    
    register_setting('tt_modal_settings', 'tt_modal');
}
add_action('admin_init', 'trinity_modal_init');



/**
 * Get options form database if any exist
 *
 */
function trinity_modal_do_options()
{
    $options = get_option('tt_modal');
    $pages = get_pages();
    $posts = get_posts();
    ?>
    <!-- Title for the modal -->
    <tr valign="top">
        <th scope="row"><?php _e('Add Title:', 'tt-test'); ?></th>
        <td>
            <?php
            if ($options['modal-title']) {
                $options['modal-title'] = wp_kses($options['modal-title'], array());
            } else {
                $options['modal-title'] = __('Modal Example Text');
            }
            ?>
            <input type="text" id="modal-title" name="tt_modal[modal-title]" width="30" value="<?php echo $options['modal-title']; ?>"><br>
            <label class="description" for="tt-modal[modal-title]"><?php _e('Change the text of the modal', 'tt-test')  ?></label>
        </td>
    </tr>
    <!-- Description for the modal -->
    <tr valign="top">
        <th scope="row"><?php _e('Add Description:', 'tt-test'); ?></th>
        <td>
            <?php
            if ($options['modal-desc']) {
                $options['modal-desc'] = wp_kses($options['modal-desc'], array());
            } else {
                $options['modal-desc'] = __('Modal Example Description');
            }
            ?>
            <textarea rows="4" cols="50" id="modal-desc" name="tt_modal[modal-desc]"><?php echo $options['modal-desc']; ?>
            </textarea>
            <br>
            <label class="description" for="tt-modal[modal-desc]"><?php _e('Change the description of the modal', 'tt-test')  ?></label>
        </td>
    </tr>
    <!-- Select where to show modal -->
    <tr>
        <th scope="row"><?php _e('Show modal on:', 'tt-test'); ?></th>
        <td>
        <input id="pages-checkbox" type="checkbox" name="tt_modal[enablePage]" value="1"  <?php checked(1, $options[enablePage]); ?> />
            <label class="description" for="tt_modal[enablePage]"><?php _e('Pages', 'tt-test')  ?></label>
            <br>
            <input id="posts-checkbox" type="checkbox" name="tt_modal[enablePost]" value="1" <?php checked(1, $options[enablePost]); ?>/>
            <label class="description" for="tt_modal[enablePost]"><?php _e('Posts', 'tt-test')  ?></label>
        </td>
    </tr>
    <!-- Display List of Pages -->
    <tr id="tt-page-list" style="display:none">
        <th scope="row"><?php _e('Select Pages:', 'tt-test'); ?></th>
        <td>
        <?php
        foreach ($pages as $page) {
            ?>            
                <input 
                type="checkbox" 
                name="tt_modal[page_modal][<?php echo $page->ID; ?>]" 
                value="<?php echo $page->ID; ?>" 
                <?php checked($page->ID, $options[page_modal][$page->ID]); ?>/>

                <?php echo $page->post_title; ?>
                <br>
            <?php
        }
        
        ?>
        </td>
    </tr>
    <!-- Display List of Posts -->
    <tr id="tt-post-list" style="display:none">
        <th scope="row"><?php _e('Select Posts:', 'tt-test'); ?></th>
        <td>
        <?php
        foreach ($posts as $post) {
            ?>            
                <input 
                type="checkbox" 
                name="tt_modal[post_modal][<?php echo $post->ID; ?>]" 
                value="<?php echo $post->ID; ?>" 
                <?php checked($post->ID, $options[post_modal][$post->ID]); ?>/>
                <?php echo $post->post_title; ?>
                <br>            
            <?php
        }
        ?>
        </td>
    </tr>
<?php
}