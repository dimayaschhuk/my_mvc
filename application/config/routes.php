<?php

return [
    ''=>[
        'controller'=>'main',
        'action'=>'index',
    ],

    'download'=>[
        'controller'=>'main',
         'action'=>'download',
    ],

    'next_page'=>[
        'controller'=>'main',
        'action'=>'next_page',
    ],

    'account/login'=>[
        'controller'=>'account',
         'action'=>'login',
        ],
    'account/register'=>[
         'controller'=>'account',
         'action'=>'register',
        ],
    'register'=>[
        'controller'=>'account',
        'action'=>'register_post',
    ],
    'login'=>[
        'controller'=>'account',
        'action'=>'login_post',
    ],
    'good_tasks'=>[
        'controller'=>'account',
        'action'=>'good_tasks',
    ],
    'save_tasks'=>[
        'controller'=>'main',
        'action'=>'save_tasks',
    ],

];