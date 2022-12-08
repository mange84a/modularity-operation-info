<?php

/**
 * Plugin Name:       Operation Information
 * Plugin URI:        https://github.com/mange84a/modularity-operationinfo
 * Description:       Show operational information.
 * Version:           1.0.0
 * Author:            Magnus Andersson @ EF
 * Author URI:        https://github.com/mange84a
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       mod-operationinfo
 * Domain Path:       /languages
 */

 // Protect agains direct file access
if (! defined('WPINC')) {
    die;
}

define('OPERATIONINFO_PATH', plugin_dir_path(__FILE__));
define('OPERATIONINFO_URL', plugins_url('', __FILE__));
define('OPERATIONINFO_TEMPLATE_PATH', OPERATIONINFO_PATH . 'templates/');
define('OPERATIONINFO_VIEW_PATH', OPERATIONINFO_PATH . 'views/');
define('OPERATIONINFO_MODULE_VIEW_PATH', plugin_dir_path(__FILE__) . 'source/php/Module/views');
define('OPERATIONINFO_MODULE_PATH', OPERATIONINFO_PATH . 'source/php/Module/');

load_plugin_textdomain('modularity-operationinfo', false, plugin_basename(dirname(__FILE__)) . '/lang');

require_once OPERATIONINFO_PATH . 'source/php/Vendor/Psr4ClassLoader.php';
require_once OPERATIONINFO_PATH . 'Public.php';

// Instantiate and register the autoloader
$loader = new Operationinfo\Vendor\Psr4ClassLoader();
$loader->addPrefix('Operationinfo', OPERATIONINFO_PATH);
$loader->addPrefix('Operationinfo', OPERATIONINFO_PATH . 'source/php/');
$loader->register();

// Acf auto import and export
$acfExportManager = new \AcfExportManager\AcfExportManager();
$acfExportManager->setTextdomain('modularity-operationinfo');
$acfExportManager->setExportFolder(OPERATIONINFO_PATH . 'source/php/AcfFields/');
$acfExportManager->autoExport(array(
    'operationinfo-module' => 'group_63907c1118603', //Update with acf id here, module view
    'operation-infos' => 'group_63905783a2ea5' //Update with acf id here, settings view
));
$acfExportManager->import();

// Modularity 3.0 ready - ViewPath for Component library
add_filter('/Modularity/externalViewPath', function ($arr) {
    $arr['mod-operationinfo'] = OPERATIONINFO_MODULE_VIEW_PATH;
    return $arr;
}, 10, 3);

// Start application
new Operationinfo\App();
