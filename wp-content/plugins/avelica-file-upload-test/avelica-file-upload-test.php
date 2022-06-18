<?php

/**
 *
 * @link              https://avelica.com
 * @since             1.0.0
 * @package           Avelica_File_Update_Test_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Avelica File Upload Test
 * Plugin URI:        https://avelica.com
 * Description:       testing for file upload
 * Version:           1.0.0
 * Author:            Avelica / ARCLabs
 * Author URI:        https://avelica.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       avelica-upload-test
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

add_shortcode('misha_uploader', 'misha_uploader_callback');
function misha_uploader_callback()
{
    return '<form action="' . plugin_dir_url(__FILE__) . 'process_upload.php" method="post" enctype="multipart/form-data">
	Your Photo: <input type="file" name="profilepicture" size="25" />
	<input type="submit" name="submit" value="Submit" />
	</form>';
}

// FILE UPLOAD CODE

// [file_uploader] SHORCODE
add_shortcode('file_uploader', 'file_uploader_callback');
function file_uploader_callback()
{

    return '<form action="" method="post" enctype="multipart/form-data" name="file-upload">
	File Upload: <input type="file" name="fileUpload" value="someurl.png" size="25" />
	<input type="hidden" name="action" value="upload_file" style="display: none; visibility: hidden; opacity: 0;">
    <button type="submit">UPLOAD FILE</button>
	</form>';

}

add_shortcode('form_submit', 'form_submit_callback');
function form_submit_callback()
{

    return '<form action="" method="post" name="contact-me">
    <div class="form-field">
        <label>Name: </label>
        <input name="name" type="text" placeholder="Type your name" required>
    </div>
    <div class="form-field">
        <label>Email: </label>
        <input name="email"  type="email" placeholder="Type a valid email" required>
    </div>
    <div class="form-field">
        <label>Name: </label>
        <textarea name="comment" placeholder="Type your comment" required></textarea>
    </div>
    <input type="hidden" name="action" value="send_form" style="display: none; visibility: hidden; opacity: 0;">
    <button type="submit">Send message!</button>
</form>';

}

// ADD PLUGIN SCRIPTS
add_action('wp_enqueue_scripts', 'wpb_adding_scripts');
function wpb_adding_scripts()
{
    wp_register_script('main', plugins_url('js/main.js', __FILE__), array('jquery'), '1.1', true);
    wp_enqueue_script('main');
}
// JS SCRIPTS  - LOCALIZE VARIABLES ajax_url / ajax_nonce
add_action('wp_enqueue_scripts', 'ajax_form_scripts');
function ajax_form_scripts()
{
    $translation_array = array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'ajax_nonce' => wp_create_nonce("secure_nonce_name"),
    );
    wp_localize_script('main', 'ajax_object', $translation_array);
}

// THE AJAX ADD ACTIONS
// Here we register our "send_form" function to handle our AJAX request, do you remember the "superhypermega" hidden field? Yes, this is what it refers, the "send_form" action.
add_action('wp_ajax_send_form', 'send_form'); // This is for authenticated users
add_action('wp_ajax_nopriv_send_form', 'send_form'); // This is for unauthenticated users.
/**
 * In this function we will handle the form inputs and send our email.
 *
 * @return void
 */

function send_form()
{

    // This is a secure process to validate if this request comes from a valid source.
    check_ajax_referer('secure_nonce_name', 'security');
    //check_ajax_referer($_POST['security'], 'secure_nonce_name');
    /**
     * First we make some validations,
     * I think you are able to put better validations and sanitizations. =)
     */

    if (empty($_POST["name"])) {
        echo "Insert your name please";
        wp_die();
    }

    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        echo 'Insert your email please';
        wp_die();
    }

    if (empty($_POST["comment"])) {
        echo "Insert your comment please";
        wp_die();
    }

    // This is the email where you want to send the comments.
    $to = 'sonjuane@gmail.com';

    // Your message subject.
    $subject = 'Now message from a client!';

    $body = 'From: ' . $_POST['name'] . '\n';
    $body .= 'Email: ' . $_POST['name'] . '\n';
    $body .= 'Message: ' . $_POST['comment'] . '\n';

    // This are the message headers.
    // You can learn more about them here: https://developer.wordpress.org/reference/functions/wp_mail/
    $headers = array('Content-Type: text/html; charset=UTF-8');

    wp_mail($to, $subject, $body, $headers);

    echo 'Done!';
    wp_die();
}

add_action('wp_ajax_upload_file', 'upload_file'); // This is for authenticated users
add_action('wp_ajax_nopriv_upload_file', 'upload_file'); // This is for unauthenticated users.
/**
 * In this function we will handle the form inputs and send our email.
 *
 * @return void
 */

function upload_file()
{

    // This is a secure process to validate if this request comes from a valid source.
    check_ajax_referer('secure_nonce_name', 'security');
    //check_ajax_referer($_POST['security'], 'secure_nonce_name');
    /**
     * First we make some validations,
     * I think you are able to put better validations and sanitizations. =)
     */

    if (empty($_POST["fileUpload"])) {
        echo "Please choose file";
        wp_die();
    }

// WordPress environment
    require dirname(__FILE__) . '/../../../wp-load.php';

    $wordpress_upload_dir = wp_upload_dir();
// $wordpress_upload_dir['path'] is the full server path to wp-content/uploads/2017/05, for multisite works good as well
    // $wordpress_upload_dir['url'] the absolute URL to the same folder, actually we do not need it, just to show the link to file
    $i = 1; // number of tries when the file with the same name is already exists

    $fileUpload = $_FILES['fileUpload'];
    $new_file_path = $wordpress_upload_dir['path'] . '/' . $fileUpload['name'];
    $new_file_mime = mime_content_type($fileUpload['tmp_name']);

    if (empty($fileUpload)) {
        //echo "File is not selected." . $fileUpload;
        die('File is not selected.');
    }

    if ($fileUpload['error']) {
        print_r($fileUpload);
        echo '<br/>';
        echo $fileUpload['error'] . "-profile error";
        die($fileUpload['error']);
    }

    if ($fileUpload['size'] > wp_max_upload_size()) {
        echo 'It is too large than expected.';
        die('It is too large than expected.');
    }

    if (!in_array($new_file_mime, get_allowed_mime_types())) {
        echo 'WordPress doesn\'t allow this type of uploads.';
        die('WordPress doesn\'t allow this type of uploads.');
    }

    while (file_exists($new_file_path)) {
        $i++;
        $new_file_path = $wordpress_upload_dir['path'] . '/' . $i . '_' . $fileUpload['name'];
    }

// looks like everything is OK
    if (move_uploaded_file($fileUpload['tmp_name'], $new_file_path)) {

        $upload_id = wp_insert_attachment(array(
            'guid' => $new_file_path,
            'post_mime_type' => $new_file_mime,
            'post_title' => preg_replace('/\.[^.]+$/', '', $fileUpload['name']),
            'post_content' => '',
            'post_status' => 'inherit',
        ), $new_file_path);

        // wp_generate_attachment_metadata() won't work if you do not include this file
        require_once ABSPATH . 'wp-admin/includes/image.php';

        // Generate and save the attachment metas into the database
        wp_update_attachment_metadata($upload_id, wp_generate_attachment_metadata($upload_id, $new_file_path));

        // show upload url
        echo $wordpress_upload_dir['url'] . '/' . basename($new_file_path);

        // Show the uploaded file in browser - redirects to file uploaded url
        //wp_redirect($wordpress_upload_dir['url'] . '/' . basename($new_file_path));

    }

    echo 'Done!';
    wp_die();
}