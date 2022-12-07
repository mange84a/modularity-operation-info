<?php

namespace Operationinfo\Admin;

class Settings
{
    public function __construct() {
        add_action('acf/init', array($this, 'registerSettings'));
    }

    /**
     * Register settings
     * @return void
     */
    public function registerSettings()
    {
        if (function_exists('acf_add_options_sub_page')) {
            acf_add_options_sub_page(array(
                'page_title'  => __("Operation Information", 'modularity-operationinfo'),
                'menu_title'  => __("Operation Information Settings", 'modularity-operationinfo'),
                'menu_slug'   => 'modularity-operationinfo-settings',
                'parent_slug' => 'options-general.php',
                'capability'  => 'manage_options'
            ));
        }
    }
}
