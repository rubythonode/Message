<?php
 return ['message' => [
                    'Name'          => 'Message',
                    'name'          => 'message',
                    'table'         => 'messages',
                    'model'         => 'Lavalite\Message\Models\Message',
                    'image'         =>
                        [
                        'xs'        => ['width' =>'60',     'height' =>'45'],
                        'sm'        => ['width' =>'100',    'height' =>'75'],
                        'md'        => ['width' =>'460',    'height' =>'345'],
                        'lg'        => ['width' =>'800',    'height' =>'600'],
                        'xl'        => ['width' =>'1000',   'height' =>'750'],
                        ],
                    'fillable'          =>  ['id', 'from', 'to', 'subject', 'message', 'read', 'type', 'deleted_at', 'created_at', 'updated_at'],
                    'listfields'        =>  ['id', 'from', 'to', 'subject', 'message', 'read', 'type', 'deleted_at', 'created_at', 'updated_at'],
                    'translatable'      =>  ['id', 'from', 'to', 'subject', 'message', 'read', 'type', 'deleted_at', 'created_at', 'updated_at'],
                    'upload-folder'     =>  '/uploads/message/message',
                    'uploadable'        =>  [
                                                'single' => [],
                                                'multiple' => []
                                            ],

                    ]];

