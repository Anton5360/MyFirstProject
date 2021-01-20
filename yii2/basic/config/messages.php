<?php

return [
    'color' => null,
    'interactive' => true,
    'help' => null,
    'sourcePath' => '@app',
    'languages' => ['ru-RU', 'uk-UA'],
    'translator' => 'Yii::t',
    'sort' => false,
    'overwrite' => true,
    'removeUnused' => false,
    'markUnused' => true,
    'except' => [
        '@yii/messages',
        '@yii/BaseYii.php',
        '/vendor',
    ],
    'only' => [
        '*.php',
    ],
    'format' => 'db',
    'db' => 'db',
    'ignoreCategories' => [
        'yii',
    ],
];