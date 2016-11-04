<?php

return [
    /*
     * Setup the request, parse response and field mapping strategies for each site
     */
    'sites' => [
        'flub' => [
            'request' => [
                'type' => 'local_file',
                'base' => __DIR__ . '/../feed-exports/',
                'filename' => 'flub.yaml'
            ],
            'parse' => [
                'type' => 'yaml'
            ],
            'map' => [
                /*
                 * Field mapping:
                 * response field name => target field name
                 */
                'fields' => [
                    'name' => 'title',
                    'url' => 'url',
                    'labels' => 'tags'
                ]
            ]
        ],
        'glorf' => [
            'request' => [
                'type' => 'local_file',
                'base' => __DIR__ . '/../feed-exports/',
                'filename' => 'glorf.json'
            ],
            'parse' => [
                'type' => 'json'
            ],
            'map' => [
                /*
                 * Parent key:
                 * The video list/array will be found within this key
                 */
                'parent_key' => 'videos',
                /*
                 * Field mapping:
                 * response field name => target field name
                 */
                'fields' => [
                    'title' => 'title',
                    'url' => 'url',
                    'tags' => 'tags'
                ]
            ]
        ]
    ]
];
