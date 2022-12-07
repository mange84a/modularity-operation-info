<?php

namespace Operationinfo\Module;

use Operationinfo\Helper\CacheBust;

/**
 * Class Operationinfo
 * @package Operationinfo\Module
 */
class Operationinfo extends \Modularity\Module
{
    public $slug = 'operationinfo';
    public $supports = array();

    public function init()
    {
        $this->nameSingular = __("Operationinfo", 'modularity-operationinfo');
        $this->namePlural = __("Operationinfo", 'modularity-operationinfo');
        $this->description = __("Show operational information.", 'modularity-operationinfo');
    }

    /**
     * Data array
     * @return array $data
     */
    public function data(): array
    {
        $data = array();
        //Append field config
        
        $data = array_merge($data, (array) \Modularity\Helper\FormatObject::camelCase(
            get_fields($this->ID)
        ));
        
        //Archive link
        $data['archiveLink'] = get_post_type_archive_link('operation-infos');
        
        if($data['showActive']) { 
            $activeOperations = $this->getActiveOperations();
            $data['activeOperations'] = $this->formatOperationInfos($activeOperations['posts']);
            $data['totalActiveOperations'] = $activeOperations['postcount'];
        }   
        
        if($data['showPlaned']) { 
            $planedOperations = $this->getPlanedOperations();
            $data['planedOperations'] = $this->formatOperationInfos($planedOperations['posts']);
            $data['totalPlanedOperations'] = $planedOperations['postcount'];
        } 

        
        //Translations
        $data['lang'] = (object) array(
            'info' => __(
                "Hey! This is your new Operation Information module. Let's get going.",
                'modularity-operationinfo'
            )
        );

        return $data;
    }
    
    /**
     * Get the posts to show, include max number of posts that can be fetched
     *
     * @return array                    Posts array including maimum number of matching items
     */
    private function getActiveOperations() {

        $query = new \WP_Query(array(
            'post_type' => 'operation-infos',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'suppress_filters' => true,
            'meta_query' => [
                'relation' => 'AND',
                [ 
                    'relation' => 'OR',
                    [
                        'key' => 'operation_start',
                        'value' => date('Y-m-d H:i:s'),
                        'compare' => '<=',
                        'type' => 'DATE'
                    ],
                    [
                        'key' => 'operation_start',
                        'value' => '',
                        'compare' => '=',
                    ]            
                ],
                [
                    'relation' => 'OR', 
                    [
                        'key' => 'operation_end',
                        'value' => date('Y-m-d H:i:s'),
                        'compare' => '>=',
                        'type' => 'DATE'
                    ],
                    [
                        'key' => 'operation_end',
                        'value' => '',
                        'compare' => '=',
                    ]  
                ]
            ]
        ));

        if(!is_wp_error($query)) {
            return [
                'postcount' => $query->found_posts,
                'posts' => $query->posts
            ];
        }

        return false; 
    }
    
    private function getPlanedOperations() {

        $query = new \WP_Query(array(
            'post_type' => 'operation-infos',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'suppress_filters' => true,
            'meta_key' => 'operation_start',
            'meta_value' => date('Y-m-d H:i:s'),
            'meta_compare' => '>',
            'meta_type' => 'DATE'
        ));

        if(!is_wp_error($query)) {
            return [
                'postcount' => $query->found_posts,
                'posts' => $query->posts
            ];
        }

        return false; 
    }


    /**
     * Format operationinfos array
     *
     * @param array $operationinfos
     * @return array
     */
    public function formatOperationInfos($operationinfos) {
        if(is_array($operationinfos) && !empty($operationinfos)) {
            foreach ($operationinfos as $key => $operationinfo) {
                $fields = get_fields($operationinfo->ID);
                $operationinfo->startDateFormatted = date('Y-m-d H:i:s', strtotime($fields['operation_start']));
                $operationinfo->link = get_permalink($operationinfo->ID);
            }
        }
        return $operationinfos;
    }


    /**
     * Blade Template
     * @return string
     */
    public function template(): string
    {
        return "operationinfo.blade.php";
    }

    /**
     * Style - Register & adding css
     * @return void
     */
    public function style()
    {
        //Register custom css
        wp_register_style(
            'modularity-operationinfo',
            OPERATIONINFO_URL . '/dist/' . CacheBust::name('css/modularity-operationinfo.css'),
            null,
            '1.0.0'
        );

        //Enqueue
        wp_enqueue_style('modularity-operationinfo');
    }

    /**
     * Script - Register & adding scripts
     * @return void
     */
    public function script()
    {
        //Register custom css
        wp_register_script(
            'modularity-operationinfo',
            OPERATIONINFO_URL . '/dist/' . CacheBust::name('js/modularity-operationinfo.js'),
            null,
            '1.0.0'
        );

        //Enqueue
        wp_enqueue_script('modularity-operationinfo');
    }

    /**
     * Available "magic" methods for modules:
     * init()            What to do on initialization
     * data()            Use to send data to view (return array)
     * style()           Enqueue style only when module is used on page
     * script            Enqueue script only when module is used on page
     * adminEnqueue()    Enqueue scripts for the module edit/add page in admin
     * template()        Return the view template (blade) the module should use when displayed
     */
}
