<?php

$getMethod = 'get';
$postMethod = 'post';
$putMethod = 'put';
$deleteMethod = 'delete';

$homeBaseUrl = '/home';
$userBaseUrl = '/users';
$roleBaseUrl = '/roles';
$loginLogsBaseUrl = '/login-logs';
$activityLogsBaseUrl = '/activity-logs';
$languagesBaseUrl = '/languages';
$translationBaseUrl = '/translations';
$emailTemplateBaseUrl = '/email-templates';
$configBaseUrl = '/configs';
$categoriesBaseUrl = '/categories';
$profileBaseUrl = '/profile';
$mailtestBaseUrl = '/mail-test';
$orderBaseUrl = '/order';
$sizeBaseUrl = '/sizes';
$billsBaseUrl = '/bills';
$ratesBaseUrl = '/rates';
$frontendUserBaseUrl = '/frontend-users';
$customerBaseUrl = '/customers';

return  [
    // routes entered in this array are accessible by any user no matter what role is given
    'permissionGrantedbyDefaultRoutes' => [
        [
            'url' => $homeBaseUrl,
            'method' => $getMethod,
        ],
        [
            'url' => '/logout',
            'method' => $getMethod,
        ],
        [
            'url' => '/languages/set-language/*',
            'method' => $getMethod,
        ],
        [
            'url' => '/miscellaneous/scrap',
            'method' => $getMethod,
        ],
        [
            'url' => $profileBaseUrl,
            'method' => $getMethod,
        ],
        [
            'url' => $profileBaseUrl . '/*',
            'method' => $putMethod,
        ],
        [
            'url' => '/change-password',
            'method' => $getMethod,
        ],
    ],

    // All the routes are accessible by super user by default
    // routes entered in this array are not accessible by super user
    'permissionDeniedToSuperUserRoutes' => [],

    'modules' => [
        [
            'name' => 'Dashboard',
            'icon' => "<i class='fa fa-home'></i>",
            'hasSubmodules' => false,
            'route' => $homeBaseUrl,
        ],
        [
            'name' => 'User Management',
            'icon' => "<i class='fa fa-user'></i>",
            'hasSubmodules' => true,
            'submodules' => [
                [
                    'name' => 'Users',
                    'icon' => "<i class='fa fa-users'></i>",
                    'hasSubmodules' => false,
                    'route' => $userBaseUrl,
                    'permissions' => [
                        [
                            'name' => 'View Users',
                            'route' => [
                                'url' => $userBaseUrl,
                                'method' => $getMethod,
                            ],
                        ],
                        [
                            'name' => 'Create Users',
                            'route' => [
                                [
                                    'url' => $userBaseUrl . '/create',
                                    'method' => $getMethod,
                                ],
                                [
                                    'url' => $userBaseUrl,
                                    'method' => $postMethod,
                                ],
                            ],
                        ],
                        [
                            'name' => 'Edit Users',
                            'route' => [
                                [
                                    'url' => $userBaseUrl . '/*/edit',
                                    'method' => $getMethod,
                                ],
                                [
                                    'url' => $userBaseUrl . '/*',
                                    'method' => $putMethod,
                                ],
                            ],
                        ],
                        [
                            'name' => 'Delete Users',
                            'route' => [
                                'url' => $userBaseUrl . '/*',
                                'method' => $deleteMethod,
                            ],
                        ],
                        [
                            'name' => 'Reset Password',
                            'route' => [
                                'url' => $userBaseUrl . '/reset-password/*',
                                'method' => $postMethod,
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'Roles',
                    'icon' => "<i class='fa fa-tags'></i>",
                    'hasSubmodules' => false,
                    'route' => '/roles',
                    'permissions' => [
                        [
                            'name' => 'View Roles',
                            'route' => [
                                'url' => $roleBaseUrl,
                                'method' => $getMethod,
                            ],
                        ],
                        [
                            'name' => 'Create Roles',
                            'route' => [
                                [
                                    'url' => $roleBaseUrl . '/create',
                                    'method' => $getMethod,
                                ],
                                [
                                    'url' => $roleBaseUrl,
                                    'method' => $postMethod,
                                ],
                            ],
                        ],
                        [
                            'name' => 'Edit Roles',
                            'route' => [
                                [
                                    'url' => $roleBaseUrl . '/*/edit',
                                    'method' => $getMethod,
                                ],
                                [
                                    'url' => $roleBaseUrl . '/*',
                                    'method' => $putMethod,
                                ],
                            ],
                        ],
                        [
                            'name' => 'Delete Roles',
                            'route' => [
                                'url' => $roleBaseUrl . '/*',
                                'method' => $deleteMethod,
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'name' => 'System configs',
            'icon' => "<i class='fa fa-cogs' aria-hidden='true'></i>",
            'hasSubmodules' => true,
            'submodules' => [
                [
                    'name' => 'Email Templates',
                    'icon' => "<i class='fa fa-envelope' aria-hidden='true'></i>",
                    'route' => $emailTemplateBaseUrl,
                    'hasSubmodules' => false,
                    'permissions' => [
                        [
                            'name' => 'View Email Templates',
                            'route' => [
                                'url' => $emailTemplateBaseUrl,
                                'method' => $getMethod,
                            ],
                        ],
                        [
                            'name' => 'Edit Email Templates',
                            'route' => [
                                [
                                    'url' => $emailTemplateBaseUrl . '/*/edit',
                                    'method' => $getMethod,
                                ],
                                [
                                    'url' => $emailTemplateBaseUrl . '/*',
                                    'method' => $putMethod,
                                ],
                            ],
                        ],
                        [
                            'name' => 'Delete Email Templates',
                            'route' => [
                                'url' => $emailTemplateBaseUrl . '/*',
                                'method' => $deleteMethod,
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'Configs',
                    'icon' => '<i class="fa fa-cog" aria-hidden="true"></i>',
                    'route' => $configBaseUrl,
                    'hasSubmodules' => false,
                    'permissions' => [
                        [
                            'name' => 'View Configs',
                            'route' => [
                                'url' => $configBaseUrl,
                                'method' => $getMethod,
                            ],
                        ],
                        [
                            'name' => 'Create Config',
                            'route' => [
                                'url' => $configBaseUrl,
                                'method' => $postMethod,
                            ],
                        ],
                        [
                            'name' => 'Edit Config',
                            'route' => [
                                'url' => $configBaseUrl . '/*',
                                'method' => $putMethod,
                            ],
                        ],
                        [
                            'name' => 'Delete Config',
                            'route' => [
                                'url' => $configBaseUrl . '/*',
                                'method' => $deleteMethod,
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'name' => 'Basic Setup',
            'icon' => "<i class='fa fa-cogs' aria-hidden='true'></i>",
            'hasSubmodules' => true,
            'submodules' => [
                [
                    'name' => 'Orders',
                    'icon' => '<i class="fas fa-icons"></i>',
                    'route' => $orderBaseUrl,
                    'hasSubmodules' => false,
                    'permissions' => [
                        [
                            'name' => 'View Email Templates',
                            'route' => [
                                'url' => $orderBaseUrl,
                                'method' => $getMethod,
                            ],
                        ],
                        [
                            'name' => 'Edit Email Templates',
                            'route' => [
                                [
                                    'url' => $orderBaseUrl . '/*/edit',
                                    'method' => $getMethod,
                                ],
                                [
                                    'url' => $orderBaseUrl . '/*',
                                    'method' => $putMethod,
                                ],
                            ],
                        ],
                        [
                            'name' => 'Delete Email Templates',
                            'route' => [
                                'url' => $orderBaseUrl . '/*',
                                'method' => $deleteMethod,
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'Size',
                    'icon' => '<i class="fas fa-tape"></i>',
                    'route' => $sizeBaseUrl,
                    'hasSubmodules' => false,
                    'permissions' => [
                        [
                            'name' => 'View Configs',
                            'route' => [
                                'url' => $sizeBaseUrl,
                                'method' => $getMethod,
                            ],
                        ],
                        [
                            'name' => 'Create Config',
                            'route' => [
                                'url' => $sizeBaseUrl,
                                'method' => $postMethod,
                            ],
                        ],
                        [
                            'name' => 'Edit Config',
                            'route' => [
                                'url' => $sizeBaseUrl . '/*',
                                'method' => $putMethod,
                            ],
                        ],
                        [
                            'name' => 'Delete Config',
                            'route' => [
                                'url' => $sizeBaseUrl . '/*',
                                'method' => $deleteMethod,
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'Rate',
                    'icon' => '<i class="fas fa-money-bill-wave"></i>',
                    'route' => $ratesBaseUrl,
                    'hasSubmodules' => false,
                    'permissions' => [
                        [
                            'name' => 'View Configs',
                            'route' => [
                                'url' => $ratesBaseUrl,
                                'method' => $getMethod,
                            ],
                        ],
                        [
                            'name' => 'Create Config',
                            'route' => [
                                'url' => $ratesBaseUrl,
                                'method' => $postMethod,
                            ],
                        ],
                        [
                            'name' => 'Edit Config',
                            'route' => [
                                'url' => $ratesBaseUrl . '/*',
                                'method' => $putMethod,
                            ],
                        ],
                        [
                            'name' => 'Delete Config',
                            'route' => [
                                'url' => $ratesBaseUrl . '/*',
                                'method' => $deleteMethod,
                            ],
                        ],
                    ],
                ],
                [
                    'name' => 'Bill Type',
                    'icon' => '<i class="fas fa-tape"></i>',
                    'route' => $configBaseUrl,
                    'hasSubmodules' => false,
                    'permissions' => [
                        [
                            'name' => 'View Configs',
                            'route' => [
                                'url' => $configBaseUrl,
                                'method' => $getMethod,
                            ],
                        ],
                        [
                            'name' => 'Create Config',
                            'route' => [
                                'url' => $configBaseUrl,
                                'method' => $postMethod,
                            ],
                        ],
                        [
                            'name' => 'Edit Config',
                            'route' => [
                                'url' => $configBaseUrl . '/*',
                                'method' => $putMethod,
                            ],
                        ],
                        [
                            'name' => 'Delete Config',
                            'route' => [
                                'url' => $configBaseUrl . '/*',
                                'method' => $deleteMethod,
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'name' => 'Bill Management',
            'icon' => '<i class="fas fa-file-invoice"></i>',
            'hasSubmodules' => false,
            'route' => $billsBaseUrl,
            'permissions' => [
                [
                    'name' => 'View Category',
                    'route' => [
                        'url' => $billsBaseUrl,
                        'method' => $getMethod,
                    ],
                ],
                [
                    'name' => 'Create Category',
                    'route' => [
                        [
                            'url' => $billsBaseUrl . '/create',
                            'method' => $getMethod,
                        ],
                        [
                            'url' => $billsBaseUrl,
                            'method' => $postMethod,
                        ],

                    ],
                ],
                [
                    'name' => 'Edit Category',
                    'route' => [
                        [
                            'url' => $billsBaseUrl . '/*/edit',
                            'method' => $getMethod,
                        ],
                        [
                            'url' => $billsBaseUrl . '/*',
                            'method' => $putMethod,
                        ],
                    ],
                ],
                [
                    'name' => 'Delete Category',
                    'route' => [
                        'url' => $billsBaseUrl . '/*',
                        'method' => $deleteMethod,
                    ],
                ],
            ],
        ],

        [
            'name' => 'Other Income Management',
            'icon' => '<i class="fas fa-money-bill-wave"></i>',
            'hasSubmodules' => false,
            'route' => $billsBaseUrl,
            'permissions' => [
                [
                    'name' => 'View Category',
                    'route' => [
                        'url' => $billsBaseUrl,
                        'method' => $getMethod,
                    ],
                ],
                [
                    'name' => 'Create Category',
                    'route' => [
                        [
                            'url' => $billsBaseUrl . '/create',
                            'method' => $getMethod,
                        ],
                        [
                            'url' => $billsBaseUrl,
                            'method' => $postMethod,
                        ],

                    ],
                ],
                [
                    'name' => 'Edit Category',
                    'route' => [
                        [
                            'url' => $billsBaseUrl . '/*/edit',
                            'method' => $getMethod,
                        ],
                        [
                            'url' => $billsBaseUrl . '/*',
                            'method' => $putMethod,
                        ],
                    ],
                ],
                [
                    'name' => 'Delete Category',
                    'route' => [
                        'url' => $billsBaseUrl . '/*',
                        'method' => $deleteMethod,
                    ],
                ],
            ],
        ],



        [
            'name' => 'Customer Management',
            'icon' => '<i class="fas fa-users"></i>',
            'hasSubmodules' => false,
            'route' => $customerBaseUrl,
            'permissions' => [
                [
                    'name' => 'View Category',
                    'route' => [
                        'url' => $customerBaseUrl,
                        'method' => $getMethod,
                    ],
                ],
                [
                    'name' => 'Create Category',
                    'route' => [
                        [
                            'url' => $customerBaseUrl . '/create',
                            'method' => $getMethod,
                        ],
                        [
                            'url' => $customerBaseUrl,
                            'method' => $postMethod,
                        ],

                    ],
                ],
                [
                    'name' => 'Edit Category',
                    'route' => [
                        [
                            'url' => $customerBaseUrl . '/*/edit',
                            'method' => $getMethod,
                        ],
                        [
                            'url' => $customerBaseUrl . '/*',
                            'method' => $putMethod,
                        ],
                    ],
                ],
                [
                    'name' => 'Delete Category',
                    'route' => [
                        'url' => $customerBaseUrl . '/*',
                        'method' => $deleteMethod,
                    ],
                ],
            ],
        ],

        [
            'name' => 'User Management',
            'icon' => '<i class="fas fa-user-shield"></i>',
            'hasSubmodules' => false,
            'route' => $frontendUserBaseUrl,
            'permissions' => [
                [
                    'name' => 'View Category',
                    'route' => [
                        'url' => $frontendUserBaseUrl,
                        'method' => $getMethod,
                    ],
                ],
                [
                    'name' => 'Create Category',
                    'route' => [
                        [
                            'url' => $frontendUserBaseUrl . '/create',
                            'method' => $getMethod,
                        ],
                        [
                            'url' => $frontendUserBaseUrl,
                            'method' => $postMethod,
                        ],

                    ],
                ],
                [
                    'name' => 'Edit Category',
                    'route' => [
                        [
                            'url' => $frontendUserBaseUrl . '/*/edit',
                            'method' => $getMethod,
                        ],
                        [
                            'url' => $frontendUserBaseUrl . '/*',
                            'method' => $putMethod,
                        ],
                    ],
                ],
                [
                    'name' => 'Delete Category',
                    'route' => [
                        'url' => $frontendUserBaseUrl . '/*',
                        'method' => $deleteMethod,
                    ],
                ],
            ],
        ],



        // [
        //     'name' => 'Mail Test',
        //     'icon' => "<i class='fa fa-envelope-o'></i>",
        //     'hasSubmodules' => false,
        //     'route' => $mailtestBaseUrl.'/create',
        //     'permissions' => [
        //         [
        //             'name' => 'Create Mail',
        //             'route' => [
        //                 'url' => $mailtestBaseUrl.'/create',
        //                 'method' => $getMethod,
        //             ],
        //             [
        //                 'url' => $mailtestBaseUrl,
        //                 'method' => $postMethod,
        //             ],

        //         ],
        //     ],
        // ],

    ],
];
