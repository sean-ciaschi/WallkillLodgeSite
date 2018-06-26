<?php

return [
    'pdf' => [
        'enabled' => true,
        'binary'  => '"C:\wkhtmltopdf\bin\wkhtmltopdf"',
        'timeout' => false,
        'options' => [],
        '.env'     => [],
    ],
    'image' => [
        'enabled' => false,
        'binary'  => '/usr/local/bin/wkhtmltoimage',
        'timeout' => false,
        'options' => [],
        '.env'     => [],
    ],
];
