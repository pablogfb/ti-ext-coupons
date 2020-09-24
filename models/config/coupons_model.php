<?php
$config['list']['filter'] = [
    'search' => [
        'prompt' => 'lang:igniter.coupons::default.text_filter_search',
        'mode' => 'all',
    ],
    'scopes' => [
        'location' => [
            'label' => 'lang:admin::lang.text_filter_location',
            'type' => 'select',
            'scope' => 'whereHasLocation',
            'modelClass' => 'Admin\Models\Locations_model',
            'nameFrom' => 'location_name',
            'locationAware' => 'hide',
        ],
        'type' => [
            'label' => 'lang:igniter.coupons::default.text_filter_type',
            'type' => 'select',
            'conditions' => 'type = :filtered',
            'options' => [
                'F' => 'lang:igniter.coupons::default.text_fixed_amount',
                'P' => 'lang:igniter.coupons::default.text_percentage',
            ],
        ],
        'status' => [
            'label' => 'lang:admin::lang.text_filter_status',
            'type' => 'switch',
            'conditions' => 'status = :filtered',
        ],
    ],
];

$config['list']['toolbar'] = [
    'buttons' => [
        'create' => [
            'label' => 'lang:admin::lang.button_new',
            'class' => 'btn btn-primary',
            'href' => admin_url('igniter/coupons/coupons/create'),
        ],
        'delete' => [
            'label' => 'lang:admin::lang.button_delete',
            'class' => 'btn btn-danger',
            'data-attach-loading' => '',
            'data-request' => 'onDelete',
            'data-request-form' => '#list-form',
            'data-request-data' => "_method:'DELETE'",
            'data-request-confirm' => 'lang:admin::lang.alert_warning_confirm',
        ],
    ],
];

$config['list']['columns'] = [
    'edit' => [
        'type' => 'button',
        'iconCssClass' => 'fa fa-pencil',
        'attributes' => [
            'class' => 'btn btn-edit',
            'href' => admin_url('igniter/coupons/coupons/edit/{coupon_id}'),
        ],
    ],
    'name' => [
        'label' => 'lang:admin::lang.label_name',
        'type' => 'text',
        'searchable' => TRUE,
    ],
    'code' => [
        'label' => 'lang:igniter.coupons::default.column_code',
        'type' => 'text',
        'searchable' => TRUE,
    ],
    'locations' => [
        'label' => 'lang:admin::lang.column_location',
        'type' => 'text',
        'relation' => 'locations',
        'select' => 'location_name',
        'locationAware' => 'hide',
        'invisible' => TRUE,
    ],
    'formatted_discount' => [
        'label' => 'lang:igniter.coupons::default.column_discount',
        'type' => 'text',
        'sortable' => FALSE,
        'formatter' => function ($record, $column, $value) {
            return $record->isFixed() ? currency_format($value) : $value;
        },
    ],
    'validity' => [
        'label' => 'lang:igniter.coupons::default.column_validity',
        'type' => 'text',
        'searchable' => TRUE,
        'formatter' => function ($record, $column, $value) {
            return $value ? ucwords($value) : null;
        },
    ],
    'status' => [
        'label' => 'lang:admin::lang.label_status',
        'type' => 'switch',
    ],
    'coupon_id' => [
        'label' => 'lang:admin::lang.column_id',
        'invisible' => TRUE,
    ],

];

$config['form']['toolbar'] = [
    'buttons' => [
        'save' => [
            'label' => 'lang:admin::lang.button_save',
            'class' => 'btn btn-primary',
            'data-request' => 'onSave',
            'data-progress-indicator' => 'admin::lang.text_saving',
        ],
        'saveClose' => [
            'label' => 'lang:admin::lang.button_save_close',
            'class' => 'btn btn-default',
            'data-request' => 'onSave',
            'data-request-data' => 'close:1',
            'data-progress-indicator' => 'admin::lang.text_saving',
        ],
        'delete' => [
            'label' => 'lang:admin::lang.button_icon_delete',
            'class' => 'btn btn-danger',
            'data-request' => 'onDelete',
            'data-request-data' => "_method:'DELETE'",
            'data-request-confirm' => 'lang:admin::lang.alert_warning_confirm',
            'data-progress-indicator' => 'admin::lang.text_deleting',
            'context' => ['edit'],
        ],
    ],
];

$config['form']['tabs'] = [
    'defaultTab' => 'lang:igniter.coupons::default.text_tab_general',
    'fields' => [
        'name' => [
            'label' => 'lang:admin::lang.label_name',
            'type' => 'text',
            'span' => 'left',
        ],
        'code' => [
            'label' => 'lang:igniter.coupons::default.label_code',
            'type' => 'text',
            'span' => 'right',
        ],
        'type' => [
            'label' => 'lang:admin::lang.label_type',
            'type' => 'radiotoggle',
            'span' => 'left',
            'cssClass' => 'flex-width',
            'default' => 'F',
            'options' => [
                'F' => 'lang:igniter.coupons::default.text_fixed_amount',
                'P' => 'lang:igniter.coupons::default.text_percentage',
            ],
        ],
        'discount' => [
            'label' => 'lang:igniter.coupons::default.label_discount',
            'type' => 'money',
            'span' => 'left',
            'cssClass' => 'flex-width',
        ],
        'min_total' => [
            'label' => 'lang:igniter.coupons::default.label_min_total',
            'type' => 'currency',
            'span' => 'right',
            'default' => 0,
        ],
        'redemptions' => [
            'label' => 'lang:igniter.coupons::default.label_redemption',
            'type' => 'number',
            'span' => 'left',
            'default' => 0,
            'comment' => 'lang:igniter.coupons::default.help_redemption',
        ],
        'customer_redemptions' => [
            'label' => 'lang:igniter.coupons::default.label_customer_redemption',
            'type' => 'number',
            'span' => 'right',
            'default' => 0,
            'comment' => 'lang:igniter.coupons::default.help_customer_redemption',
        ],
        'validity' => [
            'label' => 'lang:igniter.coupons::default.label_validity',
            'type' => 'radiotoggle',
            'default' => 'forever',
            'span' => 'left',
            'options' => [
                'forever' => 'lang:igniter.coupons::default.text_forever',
                'fixed' => 'lang:igniter.coupons::default.text_fixed',
                'period' => 'lang:igniter.coupons::default.text_period',
                'recurring' => 'lang:igniter.coupons::default.text_recurring',
            ],
        ],
        'order_restriction' => [
            'label' => 'lang:igniter.coupons::default.label_order_restriction',
            'type' => 'radiotoggle',
            'comment' => 'lang:igniter.coupons::default.help_order_restriction',
            'span' => 'right',
            'options' => [
                'lang:admin::lang.text_none',
                'lang:igniter.coupons::default.text_delivery_only',
                'lang:igniter.coupons::default.text_collection_only',
            ],
        ],
        'fixed_date' => [
            'label' => 'lang:igniter.coupons::default.label_fixed_date',
            'type' => 'datepicker',
            'mode' => 'date',
            'span' => 'left',
            'cssClass' => 'flex-width',
            'trigger' => [
                'action' => 'show',
                'field' => 'validity',
                'condition' => 'value[fixed]',
            ],
        ],
        'fixed_from_time' => [
            'label' => 'lang:igniter.coupons::default.label_fixed_from_time',
            'type' => 'datepicker',
            'mode' => 'time',
            'span' => 'left',
            'cssClass' => 'flex-width',
            'trigger' => [
                'action' => 'show',
                'field' => 'validity',
                'condition' => 'value[fixed]',
            ],
        ],
        'fixed_to_time' => [
            'label' => 'lang:igniter.coupons::default.label_fixed_to_time',
            'type' => 'datepicker',
            'mode' => 'time',
            'span' => 'left',
            'cssClass' => 'flex-width',
            'trigger' => [
                'action' => 'show',
                'field' => 'validity',
                'condition' => 'value[fixed]',
            ],
        ],
        'period_start_date' => [
            'label' => 'lang:igniter.coupons::default.label_period_start_date',
            'type' => 'datepicker',
            'mode' => 'date',
            'span' => 'left',
            'cssClass' => 'flex-width',
            'trigger' => [
                'action' => 'show',
                'field' => 'validity',
                'condition' => 'value[period]',
            ],
        ],
        'period_end_date' => [
            'label' => 'lang:igniter.coupons::default.label_period_end_date',
            'type' => 'datepicker',
            'mode' => 'date',
            'span' => 'left',
            'cssClass' => 'flex-width',
            'trigger' => [
                'action' => 'show',
                'field' => 'validity',
                'condition' => 'value[period]',
            ],
        ],
        'recurring_every' => [
            'label' => 'lang:igniter.coupons::default.label_recurring_every',
            'type' => 'checkboxtoggle',
            'trigger' => [
                'action' => 'show',
                'field' => 'validity',
                'condition' => 'value[recurring]',
            ],
        ],
        'recurring_from_time' => [
            'label' => 'lang:igniter.coupons::default.label_recurring_from_time',
            'type' => 'datepicker',
            'mode' => 'time',
            'span' => 'left',
            'cssClass' => 'flex-width',
            'trigger' => [
                'action' => 'show',
                'field' => 'validity',
                'condition' => 'value[recurring]',
            ],
        ],
        'recurring_to_time' => [
            'label' => 'lang:igniter.coupons::default.label_recurring_to_time',
            'type' => 'datepicker',
            'mode' => 'time',
            'span' => 'left',
            'cssClass' => 'flex-width',
            'trigger' => [
                'action' => 'show',
                'field' => 'validity',
                'condition' => 'value[recurring]',
            ],
        ],
        'locations' => [
            'label' => 'lang:admin::lang.label_location',
            'type' => 'relation',
            'valueFrom' => 'locations',
            'nameFrom' => 'location_name',
            'locationAware' => 'hide',
            'comment' => 'lang:igniter.coupons::default.help_locations',
        ],
        'categories' => [
            'label' => 'lang:igniter.coupons::default.label_categories',
            'type' => 'relation',
            'comment' => 'lang:igniter.coupons::default.help_categories',
        ],
        'menus' => [
            'label' => 'lang:igniter.coupons::default.label_menus',
            'type' => 'relation',
            'comment' => 'lang:igniter.coupons::default.help_menus',
            'nameFrom' => 'menu_name',
        ],
        'description' => [
            'label' => 'lang:admin::lang.label_description',
            'type' => 'textarea',
        ],
        'status' => [
            'label' => 'lang:admin::lang.label_status',
            'type' => 'switch',
            'default' => 1,
        ],
        'history' => [
            'tab' => 'lang:igniter.coupons::default.text_tab_history',
            'type' => 'datatable',
            'columns' => [
                'order_id' => [
                    'title' => 'lang:igniter.coupons::default.column_order_id',
                ],
                'customer_name' => [
                    'title' => 'lang:igniter.coupons::default.column_customer',
                ],
                'min_total' => [
                    'title' => 'lang:igniter.coupons::default.column_min_total',
                ],
                'amount' => [
                    'title' => 'lang:igniter.coupons::default.column_amount',
                ],
                'date_used' => [
                    'title' => 'lang:igniter.coupons::default.column_date_used',
                ],
            ],
        ],
    ],
];

return $config;