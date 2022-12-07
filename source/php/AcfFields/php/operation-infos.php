<?php 

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
    'key' => 'group_63905783a2ea5',
    'title' => __('Operation information', 'modularity-operationinfo'),
    'fields' => array(
        0 => array(
            'key' => 'field_6390578498f2c',
            'label' => __('Operation start', 'modularity-operationinfo'),
            'name' => 'operation_start',
            'aria-label' => '',
            'type' => 'date_time_picker',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'display_format' => 'Y-m-d H:i:s',
            'return_format' => 'Y-m-d H:i:s',
            'first_day' => 1,
        ),
        1 => array(
            'key' => 'field_63907ae7a25f8',
            'label' => __('Operation end', 'modularity-operationinfo'),
            'name' => 'operation_end',
            'aria-label' => '',
            'type' => 'date_time_picker',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'display_format' => 'Y-m-d H:i:s',
            'return_format' => 'Y-m-d H:i:s',
            'first_day' => 1,
        ),
    ),
    'location' => array(
        0 => array(
            0 => array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'operation-infos',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'left',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
    'acfe_display_title' => '',
    'acfe_autosync' => '',
    'acfe_form' => 0,
    'acfe_meta' => '',
    'acfe_note' => '',
));
}