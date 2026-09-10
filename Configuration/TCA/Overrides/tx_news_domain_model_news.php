<?php

defined('TYPO3') or die();

$fields = [
    'tx_villa_price' => [
        'exclude' => 0,
        'label' => 'Price',
        'description' => 'Enter price with formatting (e.g., 2.264.000)',
        'config' => [
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim',
            'placeholder' => 'Format: 2.264.000'
        ],
    ],
    'tx_villa_address' => [
        'exclude' => 0,
        'label' => 'Address',
        'description' => 'Full property address',
        'config' => [
            'type' => 'input',
            'size' => 80,
            'eval' => 'trim',
            'placeholder' => 'e.g., 18 Old Street Miami, OR 97219'
        ],
    ],
    'tx_villa_bedrooms' => [
        'exclude' => 0,
        'label' => 'Bedrooms',
        'config' => [
            'type' => 'number',
            'size' => 10,
            'range' => [
                'lower' => 0,
                'upper' => 99,
            ],
            'default' => 0,
        ],
    ],
    'tx_villa_bathrooms' => [
        'exclude' => 0,
        'label' => 'Bathrooms',
        'config' => [
            'type' => 'number',
            'size' => 10,
            'range' => [
                'lower' => 0,
                'upper' => 99,
            ],
            'default' => 0,
        ],
    ],
    'tx_villa_area' => [
        'exclude' => 0,
        'label' => 'Area (m²)',
        'config' => [
            'type' => 'input',
            'size' => 10,
            'eval' => 'trim',
            'placeholder' => 'e.g., 545',
        ],
    ],
    'tx_villa_floor' => [
        'exclude' => 0,
        'label' => 'Floor',
        'config' => [
            'type' => 'number',
            'size' => 10,
            'range' => [
                'lower' => 0,
                'upper' => 999,
            ],
            'default' => 0,
        ],
    ],
    'tx_villa_parking' => [
        'exclude' => 0,
        'label' => 'Parking Spots',
        'config' => [
            'type' => 'number',
            'size' => 10,
            'range' => [
                'lower' => 0,
                'upper' => 99,
            ],
            'default' => 0,
        ],
    ],
];


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'tx_news_domain_model_news',
    $fields
);


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tx_news_domain_model_news',
    'tx_villa_price, tx_villa_address, tx_villa_bedrooms, tx_villa_bathrooms, tx_villa_area, tx_villa_floor, tx_villa_parking',
    '',
    'after:title'
);