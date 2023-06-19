<?php 

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
    'key' => 'group_63907c1118603',
    'title' => __('Display Operation information', 'modularity-operationinfo'),
    'fields' => array(
        0 => array(
            'key' => 'field_63907c1155d47',
            'label' => __('Show active', 'modularity-operationinfo'),
            'name' => 'show_active',
            'aria-label' => '',
            'type' => 'true_false',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'message' => '',
            'default_value' => 0,
            'ui_on_text' => '',
            'ui_off_text' => '',
            'ui' => 1,
        ),
        1 => array(
            'key' => 'field_63907c5e38405',
            'label' => __('Active label', 'modularity-operationinfo'),
            'name' => 'active_label',
            'aria-label' => '',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
                0 => array(
                    0 => array(
                        'field' => 'field_63907c1155d47',
                        'operator' => '==',
                        'value' => '1',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'maxlength' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
        ),
        2 => array(
            'key' => 'field_63908f2ef8119',
            'label' => __('Show planed', 'modularity-operationinfo'),
            'name' => 'show_planed',
            'aria-label' => '',
            'type' => 'true_false',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'message' => '',
            'default_value' => 0,
            'ui_on_text' => '',
            'ui_off_text' => '',
            'ui' => 1,
        ),
        3 => array(
            'key' => 'field_63908f35f811a',
            'label' => __('Planed label', 'modularity-operationinfo'),
            'name' => 'planed_label',
            'aria-label' => '',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
                0 => array(
                    0 => array(
                        'field' => 'field_63908f2ef8119',
                        'operator' => '==',
                        'value' => '1',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'maxlength' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
        ),
        4 => array(
            'key' => 'field_6391d1749e392',
            'label' => __('Show finished', 'modularity-operationinfo'),
            'name' => 'show_finished',
            'aria-label' => '',
            'type' => 'true_false',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'message' => '',
            'default_value' => 0,
            'ui_on_text' => '',
            'ui_off_text' => '',
            'ui' => 1,
        ),
        5 => array(
            'key' => 'field_6391d1819e394',
            'label' => __('Finished label', 'modularity-operationinfo'),
            'name' => 'finished_label',
            'aria-label' => '',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array(
                0 => array(
                    0 => array(
                        'field' => 'field_6391d1749e392',
                        'operator' => '==',
                        'value' => '1',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'maxlength' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
        ),
        6 => array(
            'key' => 'field_648ac2b50cfb4',
            'label' => __('Kategori', 'modularity-operationinfo'),
            'name' => 'drift_category',
            'aria-label' => '',
            'type' => 'acfe_taxonomy_terms',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'taxonomy' => array(
                0 => 'operation-infos_category',
            ),
            'allow_terms' => '',
            'allow_level' => '',
            'field_type' => 'select',
            'default_value' => array(
            ),
            'return_format' => 'id',
            'ui' => 1,
            'allow_null' => 1,
            'placeholder' => '',
            'search_placeholder' => '',
            'multiple' => 0,
            'ajax' => 0,
            'save_terms' => 0,
            'load_terms' => 0,
            'choices' => array(
            ),
            'layout' => '',
            'toggle' => 0,
            'allow_custom' => 0,
            'other_choice' => 0,
        ),
    ),
    'location' => array(
        0 => array(
            0 => array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'mod-operationinfo',
            ),
        ),
        1 => array(
            0 => array(
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/operationinfo',
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