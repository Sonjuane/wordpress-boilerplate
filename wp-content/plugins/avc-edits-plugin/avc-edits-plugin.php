<?php

/**
 *
 * @link              https://avelica.com
 * @since             1.0.0
 * @package           AVC_edits_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       AVC [Avelica Custom Edits] Plugin
 * Plugin URI:        https://avelica.com
 * Description:       Contains custom js/css for target wordpress website.
 * Version:           1.0.0
 * Author:            Sonny Juane
 * Author URI:        https://arclabs.ca
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       avc-edits-plugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

$rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('path/to/folder'));
$files = array();
foreach ($rii as $file) {

    if ($file->isDir()) {
        continue;
    }

    $files[] = $file->getPathname();
}
var_dump($files);