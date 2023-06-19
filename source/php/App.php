<?php

namespace Operationinfo;

use Operationinfo\Helper\CacheBust;

class App
{
    private $postType = 'operation-infos';

    public function __construct()
    {

        //Init subset
        //new Admin\Settings();

        //Register module
        add_action('plugins_loaded', array($this, 'registerModule'));
        
        //Register post type
        new \Operationinfo\Entity\PostType(__('Operation Info', 'modularity-operationinfo'), __('Operation info', 'modularity-operationinfo'), 'operation-infos', array(
            'description' => __('Operation information', 'modularity-operationinfo'),
            'menu_icon' => 'dashicons-list-view',
            'public' => true,
            'publicly_queriable' => true,
            'show_ui' => true,
            'show_in_nav_menus' => true,
            'has_archive' => true,
            'hierarchical' => false,
            'exclude_from_search' => false,
            'rewrite' => array(
                'slug' => 'driftinfo',
                'with_front' => false
            ),
            'taxonomies' => array(),
            'supports' => array('title', 'revisions', 'editor')
        ));


        // Add view paths
        add_filter('Municipio/blade/view_paths', array($this, 'addViewPaths'), 1, 1);
        add_filter('Municipio/viewData', array($this, 'singleViewData'));
    }

    /**
     * Register the module
     * @return void
     */
    public function registerModule()
    {
        if (function_exists('modularity_register_module')) {
            modularity_register_module(
                OPERATIONINFO_MODULE_PATH,
                'Operationinfo'
            );
        }
    }

    /**
     * Add searchable blade template paths
     * @param array  $array Template paths
     * @return array        Modified template paths
     */
    public function addViewPaths($array)
    {
        // If child theme is active, insert plugin view path after child views path.
        if (is_child_theme()) {
            array_splice($array, 2, 0, array(OPERATIONINFO_VIEW_PATH));
        } else {
            // Add view path first in the list if child theme is not active.
            array_unshift($array, OPERATIONINFO_VIEW_PATH);
        }

        return $array;
    }
    
    public function singleViewData($data)                                                                                                                                                                                                                                             
    {
        // Bail if not drift
        if (get_post_type() !== $this->postType && !is_archive()) {
            return $data;
        }

        global $post;
        $operation      = get_fields($post);
        //Check stats
        $now = date('Y-m-d H:i:s');
        $status = '';
        if($operation['operation_start'] > $now) {
            $status = 'planned';
        } else {
            if($operation['operation_end'] < $now && !empty($operation['operation_end'])) {
                $status = 'ended';
            } else {
                $status = 'live';
            }
        } 

        $data['operation'] = $operation;
        $data['status'] = $status;
        return $data;
    }

}
