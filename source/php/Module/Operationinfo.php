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
        //Get active is used 
        if($data['showActive']) { 
            $activeOperations = $this->getActiveOperations($data['driftCategory']);
            $data['activeOperations'] = $this->formatOperationInfos($activeOperations['posts']);
            $data['totalActiveOperations'] = $activeOperations['postcount'];
        }   

        //Get planed if used
        if($data['showPlaned']) { 
            $planedOperations = $this->getPlanedOperations($data['driftCategory']);
            $data['planedOperations'] = $this->formatOperationInfos($planedOperations['posts']);
            $data['totalPlanedOperations'] = $planedOperations['postcount'];
        } 

        //Get finished if used
        if($data['showFinished']) { 
            $finishedOperations = $this->getFinishedOperations($data['driftCategory']);
            $data['finishedOperations'] = $this->formatOperationInfos($finishedOperations['posts']);
            $data['totalFinishedOperations'] = $finishedOperations['postcount'];
        } 

        //Translations
        $data['lang'] = (object) array(
            'noActive' => __("No active operations found.", 'modularity-operationinfo'),
            'noPlaned' => __("No planed operations found.", 'modularity-operationinfo'),
            'noFinished' => __("No finished operations found.", 'modularity-operationinfo'),
        );

        return $data;
    }
    
    /**
     * Get the active oprations to show, 
     *
     * @return array
     * Posts array including all matching items
     */
    private function getActiveOperations($category_id = null) {
       if(!empty($category_id)) {
            $tax = [[ 
                'taxonomy' => 'operation-infos_category',
                'field' => 'term_id',
                'terms' => [$category_id],
                'operator' => 'IN'
            ]];
        } else {
            $tax = [];
        }
        $query = new \WP_Query(array(
            'post_type' => 'operation-infos',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'suppress_filters' => true,
            'tax_query' => $tax,
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
    
    /**
     * Get the planed oprations to show, 
     *
     * @return array
     * Posts array including all matching items
     */
    private function getPlanedOperations($category_id = null) {
        if(!empty($category_id)) {
            $tax = [[ 
                'taxonomy' => 'operation-infos_category',
                'field' => 'term_id',
                'terms' => $category_id,
                'operator' => 'IN'
            ]];
        } else {
            $tax = [];
        }
        $query = new \WP_Query(array(
            'post_type' => 'operation-infos',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'suppress_filters' => true,
            'meta_key' => 'operation_start',
            'meta_value' => date('Y-m-d H:i:s'),
            'meta_compare' => '>',
            'meta_type' => 'DATE',
            'tax_query' => $tax
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
     * Get the finished oprations to show, 
     *
     * @return array
     * Posts array including all matching items
     */
    private function getFinishedOperations($category_id = null) {
        if(!empty($category_id)) {
            $tax = [[ 
                'taxonomy' => 'operation-infos_category',
                'field' => 'term_id',
                'terms' => $category_id,
                'operator' => 'IN'
            ]];
        } else {
            $tax = [];
        }

        $query = new \WP_Query(array(
            'post_type' => 'operation-infos',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'suppress_filters' => true,
            'tax_query' => $tax,
            'meta_query' => [
                'relation' => 'AND',
                [ 
                    'key' => 'operation_end',
                    'value' => date('Y-m-d H:i:s'),
                    'compare' => '<',
                    'type' => 'DATE'
                ],
                [
                    'key' => 'operation_end',
                    'value' => '',
                    'compare' => '!=',
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
                $operationinfo->startDateFormatted = date('Y-m-d', strtotime($fields['operation_start']));
                $operationinfo->link = get_permalink($operationinfo->ID);
                $operationinfo->description = get_the_excerpt($operationinfo->ID);
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
        //No js
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
