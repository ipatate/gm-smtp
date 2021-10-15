<?php

namespace GMSmtp\includes\options;

require_once(dirname(__FILE__) . '/salt.php');


function register_settings()
{
    add_option('gm_smtp_has', false);
    add_option('gm_smtp_host', '');
    add_option('gm_smtp_port', '');
    add_option('gm_smtp_from', '');
    add_option('gm_smtp_from_name', '');
    add_option('gm_smtp_username', '');
    add_option('gm_smtp_password', '');
    add_option('gm_smtp_secure', 'ssl');


    register_setting('gm_contact_form_options_group', 'gm_smtp_has');
    register_setting('gm_contact_form_options_group', 'gm_smtp_host');
    register_setting('gm_contact_form_options_group', 'gm_smtp_port');
    register_setting('gm_contact_form_options_group', 'gm_smtp_from');
    register_setting('gm_contact_form_options_group', 'gm_smtp_from_name');
    register_setting('gm_contact_form_options_group', 'gm_smtp_username');
    register_setting('gm_contact_form_options_group', 'gm_smtp_password', array('sanitize_callback' => 'GMSmtp\includes\salt\encrypt'));
    register_setting('gm_contact_form_options_group', 'gm_smtp_secure');
}


function register_options_page()
{
    add_options_page('Settings SMTP', 'Settings SMTP', 'manage_options', 'gm-smtp', __NAMESPACE__ . '\options_page');
}


function options_page()
{
?>
    <div>
        <h2>Contact Form SMTP</h2>
        <form method="post" action="options.php">
            <?php settings_fields('gm_contact_form_options_group'); ?>
            <input type="hidden" value="true" name="gm_smtp_has" />
            <table>
                <tr valign="top">
                    <th scope="row"><label for="gm_smtp_host">SMTP Host</label></th>
                    <td><input type="text" id="gm_smtp_host" name="gm_smtp_host" required value="<?php echo get_option('gm_smtp_host'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="gm_smtp_port">SMTP Port</label></th>
                    <td><input type="text" id="gm_smtp_port" name="gm_smtp_port" required value="<?php echo get_option('gm_smtp_port'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="gm_smtp_from">SMTP From email</label></th>
                    <td><input type="email" id="gm_smtp_from" name="gm_smtp_from" required value="<?php echo get_option('gm_smtp_from'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="gm_smtp_from_name">SMTP From name</label></th>
                    <td><input type="text" id="gm_smtp_from_name" name="gm_smtp_from_name" required value="<?php echo get_option('gm_smtp_from_name'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="gm_smtp_username">SMTP username</label></th>
                    <td><input type="text" id="gm_smtp_username" name="gm_smtp_username" value="<?php echo get_option('gm_smtp_username'); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="gm_smtp_password">SMTP Password</label></th>
                    <td><input type="password" id="gm_smtp_password" name="gm_smtp_password" value="<?php echo \GMSmtp\includes\salt\decrypte(get_option('gm_smtp_password')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="gm_smtp_secure">SMTP Secure Type (ssl, tsl)</label></th>
                    <td><input type="text" id="gm_smtp_secure" name="gm_smtp_secure" value="<?php echo get_option('gm_smtp_secure'); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
<?php
}



add_action('admin_menu', __NAMESPACE__ . '\register_options_page');
add_action('admin_init', __NAMESPACE__ . '\register_settings');
