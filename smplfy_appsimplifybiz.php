<?php
/**
 * Plugin Name: SMPLFY appsimplifybiz
 * Version: 1.0.0
 * Description: Custom plugin for appsimplifybiz.com
 * Author: Thomas Picolo-Donnelly
 * Author URI: https://simplifybiz.com/
 * Requires PHP: 8.2
 * Requires Plugins:  smplfy-core
 *
 * @package Bliksem
 * @author Thomas Picolo-Donnelly
 * @since 0.0.1
 */

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_Log;

prevent_external_script_execution();

define('SITE_URL', get_site_url());
define('SMPLFY_NAME_PLUGIN_URL', plugin_dir_url(__FILE__));
define('SMPLFY_NAME_PLUGIN_DIR', plugin_dir_path(__FILE__));

//Load files and run function that initialise the whole plugin
require_once SMPLFY_NAME_PLUGIN_DIR . 'includes/smplfy_bootstrap.php';

bootstrap_appsimplifybiz_plugin();

function prevent_external_script_execution(): void
{
    if (!function_exists('get_option')) {
        header('HTTP/1.0 403 Forbidden');
        die;
    }
}