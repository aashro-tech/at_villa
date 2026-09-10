<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'AT Villa – Real Estate Property Website',
    'description' => 'AT Villa is a modern TYPO3 extension for showcasing properties, listings, agents, and real estate enquiries.',
    'category' => 'templates',
    'author' => 'Aashro Tech',
    'author_email' => 'info@aashro.com',
    'state' => 'stable',
    'clearCacheOnLoad' => 0,
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '13.0.0-13.5.99',
            'news' => '14.0.1',
            'content_blocks' => '1.0.0-1.3.18',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];