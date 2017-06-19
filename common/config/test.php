<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'modules' => array(
            'lianjia-resource' => array(
                'regex' => 'ff\.lianjia\.com(?::\d+)?',
                'directory' => 'lianjia-resource'
            ),
            'm-lianjia-resource' => array(
                'regex' => 'm\.ff\.lianjia\.com(?::\d+)?',
                'directory' => 'lianjia-resource'
            ),
        ),
        
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
