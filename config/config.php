<?php

return [
/*
* Provider .
*/
'provider'  => 'lavalite',

/*
* Package .
*/
'package'   => 'message',

/*
* Modules .
*/
'modules'   => ['message'],

'image'         => [
    'xs'        => ['width' => '60',         'height' => '45'],
    'sm'        => ['width' => '100',        'height' => '75'],
    'md'        => ['width' => '460',        'height' => '345'],
    'lg'        => ['width' => '800',        'height' => '600'],
    'xl'        => ['width' => '1000',       'height' => '750'],
    ],

'message' => [
                    'model'             => 'Lavalite\Message\Models\Message',
                    'table'             => 'messages',
                    'hidden'            => [],
                    'visible'           => [],
                    'guarded'           => ['*'],
                    'slugs'             => ['slug' => 'name'],
                    'dates'             => ['deleted_at'],
                    'appends'           => [],
                    'fillable'          => ['user_id', 'status',  'star',  'from',  'to',  'subject',  'message',  'read',  'type'],
                    'translatable'      => [],
                    'upload-folder'     => '/uploads/message/message',
                    'uploadable'        => [],
                    'casts'             => [],
                    'revision'          => [],
                    'perPage'           => '20',
                ],
];