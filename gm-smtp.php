<?php

namespace GMSmtp;

/**
 * Plugin Name:       GM SMTP
 * Update URI:        goodmotion-smtp
 * Description:       This plugin add settings SMTP for mail send.
 * Requires at least: 5.7
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Faramaz Patrick <infos@goodmotion.fr>
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       gm-smtp
 *
 * @package           goodmotion
 */

require_once(dirname(__FILE__) . '/includes/options.php');
require_once(dirname(__FILE__) . '/includes/salt.php');

add_action('phpmailer_init', function ($phpmailer) {
    if (get_option('gm_smtp_has') !== false) {
        $phpmailer->isSMTP(); //switch to smtp
        $phpmailer->Host = get_option('gm_smtp_host');
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = get_option('gm_smtp_port');
        $phpmailer->From = get_option('gm_smtp_from');
        $phpmailer->FromName = get_option('gm_smtp_from_name');
        $phpmailer->Username = get_option('gm_smtp_username');
        $phpmailer->Password = \GMSmtp\includes\salt\decrypte(get_option('gm_smtp_password'));
        $phpmailer->SMTPSecure = get_option('gm_smtp_secure');
    }
});

// add_action('wp_mail_failed', function ($error) {
//     var_dump($error->get_error_message());
// });
