<?php
/**
 * @package Turbo-Plugin
 */
/*
Plugin Name: Turbo Plugin
Plugin URI: https://github.com/Oussamahaddi/WP_plugin
Description: A plugin to create a feedback form
Version: 1.0.0
Author: Oussama Haddi
Author URI: https://www.linkedin.com/in/oussama-haddi-4b4863253/
License: GPLv2 or later
Text Domain: Turbo-plugin
*/

/*
    this program is free software; you can redistribute it and/or 
    modify it under the terms of the gnu general public license 
    as published by the free software foundation; either version 2 
    of the license, or (at your option) any later version.

    this program is distributed in the hope that it will be useful,
    but without any warranty; without even the implied warranty of
    merchantability or fitness for a particular purpose.  see the
    gnu general public license for more details.

    you should have received a copy of the gnu general public license
    along with this program; if not, write to the free software
    foundation, inc., 51 franklin street, fifth floor, boston, ma  02110-1301, usa.

    or see <http://www.gnu.org/licenses/>.

    copyright (c) 2023 Turbo plugin
*/

// Define the feedback form shortcode
function feedback_form_shortcode() {
    ob_start();
    ?>
    <form method="post" action="" style="display:flex; flex-direction: column; gap: 10px; justify-items:center; background-color: #1d2327; color:white; padding:2rem ; border-radius: 10px">
        <div style="display:flex; justify-content: space-between">
            <div style="width:calc(90% / 2)">
                <label for="note">Note (obligatoire):</label> <br>
                <input type="number" name="note" min="0" max="5" required  style="border-radius: 0.25rem; padding:1rem 0; width:100%" >
            </div>
            <div style="width:calc(90% / 2)">
                <label for="post_id">ID de post ou de page (obligatoire):</label> <br>
                <input type="text" name="post_id" required style="border-radius: 0.25rem; padding:1rem 0; width:100%;">
            </div>
        </div>
        <div>
            <label for="remarque">Remarque (obligatoire):</label> <br>
            <textarea name="remarque" rows="5" required style="border-radius: 0.25rem; padding:1rem 0; width:100%"></textarea>
        </div>
        <br><br>
        <input type="submit" name="submit_feedback" value="Envoyer" style="border-radius: 0.25rem; padding:1rem ; background-color:#1c64f2; color: white; border: none; cursor:pointer; ">
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode( 'feedback_form', 'feedback_form_shortcode' );

// Save feedback data to the database
function save_feedback() {
    if ( isset( $_POST['submit_feedback'] ) ) {
        global $wpdb;
        $turbo_feedback = $wpdb->prefix . 'feedback_data';
        $note = sanitize_text_field( $_POST['note'] );
        $remarque = sanitize_textarea_field( $_POST['remarque'] );
        $post_id = sanitize_text_field( $_POST['post_id'] );
        $wpdb->insert(
            $turbo_feedback,
            array(
                'note' => $note,
                'remarque' => $remarque,
                'post_id' => $post_id
            ),
            array(
                '%d',
                '%s',
                '%s'
            )
        );
    }
}
add_action( 'init', 'save_feedback' );

// Create the feedback data table in the database on plugin activation
function create_feedback_table() {
    global $wpdb;
    $turbo_feedback = $wpdb->prefix . 'feedback_data';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $turbo_feedback (
        id int(11) NOT NULL AUTO_INCREMENT,
        note int(1) NOT NULL,
        remarque text NOT NULL,
        post_id varchar(255) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
register_activation_hook( __FILE__, 'create_feedback_table' );

// Add an admin menu item for the feedback data
function feedback_menu_item() {
    add_menu_page(
        'Feedback Data',
        'Feedback Data',
        'manage_options',
        'feedback-data',
        'feedback_data_page'
    );
}
add_action( 'admin_menu', 'feedback_menu_item' );

// Create the feedback data page in the admin panel
function feedback_data_page() {
    global $wpdb;
    $turbo_feedback = $wpdb->prefix . 'feedback_data';
    $feedback_data = $wpdb->get_results( "SELECT * FROM $turbo_feedback" );
    ?>
    <div class="wrap">
        <h1>Feedback Data</h1>
        <table class="widefat" >
            <thead style="background-color: #1d2327; font-weight: bold; padding: 10px 0;">
                <tr>
                    <th style="color:white; font-weight:bold">ID</th>
                    <th style="color:white; font-weight:bold">    Note</th>
                    <th style="color:white; font-weight:bold">Remarque</th>
                    <th style="color:white; font-weight:bold">Post ID</th>
            </tr>
        </thead>
        <tbody style="background-color: #3e464b;">
            <?php foreach ( $feedback_data as $feedback ) : ?>
                <tr>
                    <td style="color:white;"><?php echo $feedback->id; ?></td>
                    <td style="color:white;"><?php echo $feedback->note; ?></td>
                    <td style="color:white;"><?php echo $feedback->remarque; ?></td>
                    <td style="color:white;"><?php echo $feedback->post_id; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php
}