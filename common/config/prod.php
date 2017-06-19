<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'MODULE_ROOT' => array(
            'frontend' => array(
                'host' => "self.gjyuan.com",
                'root' => 'frontend'
            ),
            'backend' => array(
                'regex' => '',
                'root' => ''
            ),
        ),

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
