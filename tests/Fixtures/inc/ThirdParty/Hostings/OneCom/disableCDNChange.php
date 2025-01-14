<?php

return [
	'testShouldReturnDefaultFieldSettings' => [
		'config'      => [
            'oc_cdn_enabled' => false,
            'field_settings' => [
                'cdn' => [
                    'type'              => 'checkbox',
                    'label'             => 'Some text',
                    'helper'            => '',
                    'section'           => 'cdn_section',
                    'page'              => 'page_cdn',
                    'default'           => 0,
                    'sanitize_callback' => 'sanitize_checkbox',
                ],
            ]
        ],
		'expected' => [
            'field_settings' => [
                'cdn' => [
                    'type'              => 'checkbox',
                    'label'             => 'Some text',
                    'helper'            => '',
                    'section'           => 'cdn_section',
                    'page'              => 'page_cdn',
                    'default'           => 0,
                    'sanitize_callback' => 'sanitize_checkbox',
                ],
            ],
        ],
	],
	'testShouldUpdateFieldSettings' => [
		'config'      => [
            'oc_cdn_enabled' => true,
            'field_settings' => [
                'cdn' => [
                    'type'              => 'checkbox',
                    'label'             => 'Some text',
                    'helper'            => '',
                    'section'           => 'cdn_section',
                    'page'              => 'page_cdn',
                    'default'           => 0,
                    'sanitize_callback' => 'sanitize_checkbox',
                ],
            ]
        ],
		'expected' => [
            'field_settings' => [
                'cdn' => [
                    'type'              => 'checkbox',
                    'label'             => 'Some text',
                    'helper'            => '',
                    'section'           => 'cdn_section',
                    'page'              => 'page_cdn',
                    'default'           => 0,
                    'sanitize_callback' => 'sanitize_checkbox',
                    'container_class'   => [
                        'wpr-isDisabled'
                    ],
                    'input_attr'        => [
                        'disabled' => 1,
                    ]
                ],
            ],
        ],
	],
];

