<?php

return [

    'admin_url' => env('ADMIN_URL'),
    'website_url' => env('WEBSITE_URL'),
    'email_verify_url' => env('EMAIL_VERIFY_URL'),
    'email_verify_url_mobile' => env('EMAIL_VERIFY_URL_MOBILE'),
    'default_avatar' => env('DEFAULT_AVATAR'),
    'from_email' => env('FROM_EMAIL', 'admin@doroosi.com'),
    'logo_path' => env('LOGO_PATH'),
    'ticket_images_path' => env('TICKET_IMAGES_PATH'),

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-WhichVocation/wiki/6.-Basic-Configuration
    |
    */

    'image_tooltip' => 'Upload max 2 MB file. Only .jpg .svg and .png files are allowed to upload.',
    'docs_tooltip' => 'Upload max 2 MB file. Only .jpg .gif .png .svg .doc .docx .xls .xlsx .ods .pdf files are allowed to upload.',
    'whichvocation' => 'Doroosi',
    'set_password' => 'Central Motor Approved | Set Password',
    'title_prefix' => '',
    'title_postfix' => '',

    'title' => 'Central Motor',
    'title_prefix' => '',
    'title_postfix' => '',

    'ticket_acknowledgement_subject' => 'Central Motor Ticket Updates',
    'ticket_acknowledgement_message_sender' => 'You have replied to a ticket',
    'ticket_acknowledgement_message_receiver' => 'You have received a new message on a ticket',
    'thanks_footer' => 'Thank you for using our application!',
    'not_clickable_message' => 'If you’re having trouble clicking the button, copy and paste the URL below into your web browser:',
    'copyright' => 'Copyright © 2021 Central Motor',
    'hello' => 'Hello!',
    'view_ticket' => 'View Ticket',
    'regards' => 'Regards',
    'team' => 'Team',
    'title' => 'Central Motor',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-WhichVocation/wiki/6.-Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-WhichVocation/wiki/6.-Basic-Configuration
    |
    */

    'logo' => '<b></b>',
    // 'logo_img' => 'images/logo.svg',
    'logo_img' => 'images/logo_new.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Central Motor',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-WhichVocation/wiki/6.-Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-WhichVocation/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-WhichVocation/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-WhichVocation/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-WhichVocation/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => true,
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-WhichVocation/wiki/7.-Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-WhichVocation/wiki/6.-Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'admin/dashboard',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-WhichVocation/wiki/9.-Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-WhichVocation/wiki/8.-Menu-Configuration
    |
    */

  'menu' => [
        
        [
            'text' => 'dashboard',
            'url'  => 'admin/dashboard',
            'icon' => 'fas fa-fw fa-tachometer-alt',
        ],
        
        ['header' => 'management'],
        
        [
            'key' => 'admin_users_management',
            'text' => 'users_management',
            'icon' => 'fas fa-fw fa-users',
            'active' => ['admin/users*','admin/job-show*','admin/driver-show/*'],
            'can' => ['manage_user','manage_transporter','manage_admins'],
            'submenu' => [
                [
                    'text' => 'Users',
                    'icon' => 'fas fa-fw fa-users',
                    'url'  => 'admin/users',
                    'active' => ['admin/users/*','admin/job-show*'],
                    'can' => ['add_user','edit_user','view_user','delete_user'],
                ],
                [
                    'text' => 'Transporters',
                    'icon' => 'fas fa-fw fa-user',
                    'url'  => 'admin/transporters',
                    'active' => ['admin/transporters*','admin/driver-show/*'],
                    'can' => ['add_transporter','edit_transporter','view_transporter','delete_transporter'],
                ],                
                [
                    'text' => 'Driver',
                    'icon' => 'fas fa-fw fa-user',
                    'url'  => 'admin/driver/list',
                    'active' => ['admin/driver*','admin/driver-list/*'],
                   // 'can' => ['add_transporter','edit_transporter','view_transporter','delete_transporter'],
                ],
            ],
        ], 
        [
            'key' => 'job_management',
            'text' => 'Job Management',
            'icon' => 'fas fa-fw fa fa-newspaper',
            'active' => ['admin/jobs*'],
            'can' => ['manage_jobs','manage_job_booked'],
            'submenu' => [
                [
                    'text' => 'Register an order',
                    'icon' => 'fa fa-list ',
                    'url'  => 'admin/create-job2',
                    'active' => ['admin/create-job2*'],
                    'can' => ['view_jobs','edit_jobs','delete_jobs','add_jobs'],
                ],
                [
                    'text' => 'Jobs',
                    'icon' => 'fa fa-list ',
                    'url'  => 'admin/jobs',
                    'active' => ['admin/jobs*'],
                    'can' => ['view_jobs','edit_jobs','delete_jobs','add_jobs'],
                ],
                [
                    'text' => 'Job Booked',
                    'icon' => 'fa fa-list',
                    'url'  => 'admin/booking',
                    'active' => ['admin/booking*','admin/view-booking*'],
                    'can' => ['view_job_booked','edit_job_booked','delete_job_booked','add_job_booked'],
                ],
                [
                    'text' => 'Exprired Job Quotes',
                    'icon' => 'fa fa-list',
                    'url'  => 'admin/expired',
                    'active' => ['admin/expired*','admin/view-expired*'],
                    'can' => ['view_job_booked','edit_job_booked','delete_job_booked','add_job_booked'],
                ],  
                [
                    'text' => 'Pending Payments',
                    'icon' => 'fa fa-list',
                    'url'  => 'admin/pending-payment',
                    'active' => ['admin/pending-payment*','admin/view-pending-payment*'],
                    'can' => ['view_job_booked','edit_job_booked','delete_job_booked','add_job_booked'],
                ],
                
            ],
        ], 
        [
            'key' => 'admin_email_management',
            'text' => 'Email Management',
            'icon' => 'fas fa-fw fa fa-newspaper',
            'active' => ['admin/emails*'],
            'can' => ['manage_email'],
            'submenu' => [
                [
                    'text' => 'Email templates',
                    'icon' => 'fas fa-chart-bar',
                    'url'  => 'admin/emails',
                    'active' => ['admin/emails*'],
                    'can' => ['view_email','edit_email','delete_email','add_email'],
                ],  
                
            ],
        ], 
        // [
        //     'key' => 'admin_banners_management',
        //     'text' => 'Banner Management',
        //     'icon' => 'fas fa-fw fa fa-newspaper',
        //     'active' => ['admin/banners*'],
         
        //     'submenu' => [
        //         [
        //             'text' => 'Banner',
        //             'icon' => 'fas fa-chart-bar',
        //             'url'  => 'admin/banner',
        //             'active' => ['admin/banner*'],
        //             // 'can' => ['view_reports'],
        //         ],  
                
        //     ],
        // ], 


        // payments
        [
            'text' => 'Payments',
            'icon' => 'fas fa-fw fa-credit-card',
            
            'can' => ['manage_payment','manage_transporter_wallets','manage_user_refunds'],
            'submenu' => [
                
                [
                    'text' => 'Payment Transactions',
                    'icon' => 'fa fa-list',
                    'url'  => 'admin/payments',
                    'active' => ['admin/payments*'],
                    'can' => ['view_payment','edit_payment','delete_payment','add_payment'],
                ],
                [
                    'text' => 'Transporter Wallets',
                    'icon' => 'fa fa-list',
                    'url'  => 'admin/wallets',
                    'active' => ['admin/wallets*'],
                    'can' => ['view_transporter_wallets','edit_transporter_wallets','delete_transporter_wallets','add_transporter_wallets'],
                ],
                [
                    'text' => 'User Refunds',
                    'icon' => 'fa fa-list',
                    'url'  => 'admin/refunds',
                    'active' => ['admin/refunds*'],
                    'can' => ['view_user_refunds','edit_user_refunds','delete_user_refunds','add_user_refunds'],
                ],
                
            ],
        ],
       
        // payments

        
        [
            'key' => 'manage_cms',
            'text' => 'Content Management',
            'icon' => 'fas fa-fw fa-edit',
            'active' => ['admin/content*'],
            'can' => ['manage_website_content','manage_mobile_content','manage_banner'],
            'submenu' => [
                [
                    'text' => 'Website',
                    'icon' => 'fas fa-fw fa-laptop',
                    'url'  => 'admin/content/website/list',
                    'active' => ['admin/content/website*'],
                    'can' => ['view_website_content','edit_website_content','delete_website_content','add_website_content'],
                ],
                [
                    'text' => 'Mobile',
                    'icon' => 'fas fa-fw fa-mobile',
                    'url'  => 'admin/content/mobile/list',
                    'active' => ['admin/content/mobile*'],
                    'can' => ['view_mobile_content','edit_mobile_content','delete_mobile_content','add_mobile_content'],
                ],
                [
                    'text' => 'Banners',
                    'icon' => 'fas fa-chart-bar',
                    'url'  => 'admin/banner',
                    'active' => ['admin/banner*'],
                    'can' => ['view_banner','edit_banner','delete_banner','add_banner'],
                ], 
                [
                    'text' => 'FAQ',
                    'icon' => 'fas fa-chart-bar',
                    'url'  => 'admin/faq',
                    'active' => ['admin/faq*'],
                    //'can' => ['view_faq','edit_faq','delete_faq','add_faq'],
                ],  
                 [
                    'text' => 'Tutorial',
                    'icon' => 'fas fa-fw fa-laptop',
                    'url'  => 'admin/content/tutorials',
                    'active' => ['admin/content/tutorials*'],
                    'can' => ['view_website_content','edit_website_content','delete_website_content','add_website_content'],
                ],
                 [
                    'text' => 'Video',
                    'icon' => 'fas fa-chart-bar',
                    'url'  => 'admin/video',
                    'active' => ['admin/video*'],
                    //'can' => ['view_faq','edit_faq','delete_faq','add_faq'],
                ]
            ],
        ],
        [
            'text' => "Users' Feedback",
            'icon' => 'fas fa-ticket-alt',
            'url'  => '#',
            'active' => ['admin/tickets*'],
            'can' => ['manage_feedback','manage_reviews','manage_testimonials'],
            'submenu' => [
               
                [
                    'text' => 'contact_us',
                    'icon' => 'fas fa-envelope',
                    'url'  => 'admin/contact_us/list',
                    'active' => ['admin/contact_us*'],
                    'can' => ['view_feedback','reply_feedback'],
                ],
                [
                    'text' => 'Special Requests',
                    'icon' => 'fas fa-envelope',
                    'url'  => 'admin/special-requests/list',
                    'active' => ['admin/special-requests*'],
                    'can' => ['view_feedback','reply_feedback'],
                ],
                [
                    'text' => 'Reviews',
                    'icon' => 'fas fa-star',
                    'url'  => 'admin/reviews',
                    'active' => ['admin/reviews*'],
                    'can' => ['view_review','delete_review','edit_review'],
                ],
                [
                    'text' => 'Testimonials',
                    'icon' => 'fa fa-list',
                    'url'  => 'admin/testimonials',
                    'active' => ['admin/testimonials*'],
                    'can' => ['view_testimonials','edit_testimonials','delete_testimonials','add_testimonials'],
                ],
                [
                    'text' => 'Requests User Information',
                    'icon' => 'fas fa-star',
                    
                    'url'  => 'admin/update_info/list',
                    'active' => ['admin/information*'],
                   // 'can' => ['view_review','delete_review','edit_review'],
                ],
            ]
        ],
             // reports
        [
            'text' => 'Reports & Analytics',
            'icon' => 'fas fa-chart-bar',
            'active' => ['admin/reports*'],
            'can' => ['view_reports'],
            'submenu' => [
                [
                    'text' => 'Reports & Analytics',
                    'icon' => 'fas fa-chart-bar',
                    'url'  => 'admin/reports',
                    'active' => ['admin/reports*'],
                    'can' => ['view_reports'],
                ],
                [
                    'text' => 'Quotations & Invoices',
                    'icon' => 'fas fa-chart-bar',
                    'url'  => 'admin/download-quation-invoice',
                    'active' => ['admin/download-quation-invoice*'],
                    'can' => ['view_reports'],
                ],
            
            ],
        ],

        [
            'text' => 'Blogs Management',
            'icon' => 'fas fa-chart-bar',
            'active' => ['admin/blogs*'],
            'can' => ['manage_blog'],
            'submenu' => [
               /* [
                    'text' => 'Blog Category ',
                    'icon' => 'fas fa-chart-bar',
                    'url'  => 'admin/blog-category ',
                    'active' => ['admin/blog-category *'],
                   // 'can' => ['blog_category '],
                ],*/
                [
                    'text' => 'Blogs ',
                    'icon' => 'fas fa-chart-bar',
                    'url'  => 'admin/blogs ',
                    'active' => ['admin/blog*'],
                    'can' => ['view_blog','add_blog','edit_blog','delete_blog'],
                ],
             
            ],
        ],
        [
            'text' => 'Misc Data Management',
            'icon' => 'fas fa-fw fa-info-circle',
            'url'  => '#',
            'active' => ['admin/misc*'],
            'can' => ['manage_misc'],
            
            'submenu' => [
                [
                    'text' => 'Promo Codes',
                    'icon' => 'fa fa-list',
                    'url'  => 'admin/promocodes',
                    'active' => ['admin/promocodes*'],
                    
                ],
                [
                    'text' => 'Vehicle Type',
                    'icon' => 'fa fa-list',
                    'url'  => 'admin/vehicletypes',
                    'active' => ['admin/vehicletypes*'],
                    
                ],
                [
                    'text' => 'Products',
                    'icon' => 'fa fa-list',
                    'url'  => 'admin/product',
                    'active' => ['admin/product/*'],
                    
                ],               
                [
                    'text' => 'Pricing',
                    'icon' =>'fa fa-list',
                    'url'  => 'admin/pricing',
                    'active' => ['admin/pricing*'],                  
                ],
                [
                    'text' => 'Region',
                    'icon' =>'fa fa-list',
                    'url'  => 'admin/region',
                    'active' => ['admin/region*'],
                    
                ],
                [
                    'text' => 'Sub Region',
                    'icon' =>'fa fa-list',
                    'url'  => 'admin/sub-region',
                    'active' => ['admin/sub-region*'],
                    
                ],
                [
                    'text' => 'Bank Account',
                    'icon' =>'fa fa-list',
                    'url'  => 'admin/bank-account',
                    'active' => ['admin/bank-account*'],                  
                ],
                [
                    'text' => 'Setting',
                    'icon' =>'fa fa-list',
                    'url'  => 'admin/setting',
                    'active' => ['admin/setting*'],                  
                ],          
            ],
        ],
        [
            'text' => 'access_control',
            'icon'    => 'fas fa-fw fa-cogs',
            'url'  => '#',
            'active' => ['admin/roles*'],
            //'can' => ['manage_roles','manage_permission'],
            'submenu' => [
                [
                    'text' => 'admins',
                    'icon' => 'fas fa-fw fa-universal-access',
                    'url'  => 'admin/admins/list',
                    'active' => ['admin/admins*'],
                    'can' => ['add_admins','edit_admins','view_admins','delete_admins'],                   
                ],
                [
                    'text' => 'roles',
                    'icon'    => 'fas fa-fw fa-users',
                    'url'  => 'admin/roles/list',
                    'active' => ['admin/roles/list*', 'admin/roles/add*', 'admin/roles/edit*', 'admin/roles/view*'],
                    'can' => ['view_role','add_role','edit_role','delete_role','delete_role'],
                ],
                [
                    'text' => 'permissions',
                    'icon'    => 'fas fa-key',
                    'url'  => 'admin/role_permissions',
                    'active' => ['admin/role_permissions*'],
                    'can' => ['manage_permission'],
                ]
            ],
        ],             
        [
            'key' => 'admin_recylce_bin',
            'text' => 'recylce_bin',
            'icon' => 'fas fa-trash',
            'url'  => '#',
            'active' => ['admin/recycle_bin*'],
            'can' => ['manage_recycle_bin'],
            'submenu' => [
                [
                    'text' => 'Users',
                    'icon' => 'fas fa-fw fa-briefcase',
                    'url'  => 'admin/recycle_bin/users/deleted',
                    
                ],
                [
                    'text' => 'Transporters',
                    'icon' => 'fas fa-fw fa-user',
                    'url'  => 'admin/recycle_bin/transporters/deleted',
                    //'active' => ['admin/recycle_bin/transporters/deleted'],
                    //'can' => ['view_teacher'],
                ],
                [
                    'text' => 'Drivers',
                    'icon' => 'fas fa-fw fa-user',
                    'url'  => 'admin/recycle_bin/drivers/deleted',
                    //'active' => ['admin/recycle_bin/transporters/deleted'],
                    //'can' => ['view_teacher'],
                ],
                
                [
                    'text' => 'admins',
                    'icon' => 'fas fa-fw fa-universal-access',
                    'url'  => 'admin/recycle_bin/admins/deleted',                   
                ],

                [
                    'text' => 'Jobs',
                    'icon' => 'fas fa-fw fa fa-newspaper',
                    'url'  => 'admin/recycle_bin/jobs/deleted',                   
                ],
                [
                    'text' => 'Website Content',
                    'icon' => 'fas fa-fw fa-laptop',
                    'url'  => 'admin/recycle_bin/webiste_content/deleted',                   
                ],
                [
                    'text' => 'Mobile Content',
                    'icon' => 'fas fa-fw fa-mobile',
                    'url'  => 'admin/recycle_bin/mobile_content/deleted',                   
                ],
                [
                    'text' => 'Banners',
                    'icon' => 'fas fa-chart-bar',
                    'url'  => 'admin/recycle_bin/banner/deleted',                   
                ],
                [
                    'text' => 'Reviews',
                    'icon' => 'fas fa-star',
                    'url'  => 'admin/recycle_bin/reviews/deleted',                   
                ],
                [
                    'text' => 'Testimonials',
                    'icon' => 'fas fa-chart-bar',
                    'url'  => 'admin/recycle_bin/testimonials/deleted',                   
                ],                   
            ],
        ],
        
    ],
    // 'menu' => [
    //     [
    //         'text' => 'dashboard',
    //         'url'  => 'admin/dashboard',
    //         'icon' => 'fas fa-fw fa-tachometer-alt',
    //     ],
        
    //     ['header' => 'management'],
    

    //     [
    //         'text' => 'User Management',
    //         'icon' => 'fas fa-fw fa-users',
    //         'active' => ['users*'],
    //        // 'can' => ['view_admin','view_teacher','view_student'],
    //         'submenu' => [
    //             [
    //                 'text' => 'Transporter',
    //                 'icon' => 'fas fa fa-building',
    //                 'url'  => 'admin/transporters',
    //                 'active' => ['admin/transporters*'],
    //                 //'can' => ['view_teacher'],
    //             ],
    //              [
    //                 'text' => 'Driver',
    //                 'icon' => 'fas fa fa-id-card',
    //                 'url'  => 'admin/drivers',
    //                 'active' => ['admin/drivers*'],
    //                 //'can' => ['view_student'],
    //             ],
    //             [
    //                 'text' => 'User',
    //                 'icon' => 'fas fa fa-user',
    //                 'url'  => 'admin/users',
    //                 'active' => ['admin/users*'],
    //                 //'can' => 'view_admin',
    //             ],
    //         ],
    //     ],
    //     [
    //         'text' => 'Pricing management',
    //         'icon' => 'fas fa-fw fa-chalkboard-teacher',
    //         'active' => ['admin/instructor-management*'],
    //         // 'can' => ['view_instructors'],
    //         'submenu' => [
    //             [
    //                 'text' => 'Pricing',
    //                 'icon' => 'fas fa-fw fa-chalkboard-teacher',
    //                 'url'  => 'admin/pricing',
    //                 'active' => ['admin/pricing*'],
    //                 // 'can' => ['view_instructors'],
    //             ],
               
    //         ],
    //     ],

    //     [
    //         'text' => 'Payment Management',
    //         'icon' => 'fas fa-fw fa-credit-card',
    //         'active' => ['admin/payments*'],
    //         // 'can' => ['view_instructors'],
    //         'submenu' => [
    //             [
    //                 'text' => 'Payments',
    //                 'icon' => 'fas fa-fw fa-chalkboard-teacher',
    //                 'url'  => 'admin/payments',
    //                 'active' => ['admin/payments*'],
    //                 // 'can' => ['view_instructors'],
    //             ],
               
    //         ],
    //     ],

    //     

    //     [
    //         'text' => 'Misc Data Management',
    //         'icon' => 'fas fa-fw fa-info-circle ',
    //         'active' => ['admin/vehicletypes*'],
    //         // 'can' => ['view_students'],
    //         'submenu' => [
    //             [
    //                 'text' => 'Vehicle Type',
    //                 'icon' => 'fa fa-list',
    //                 'url'  => 'admin/vehicletypes',
    //                 'active' => ['admin/vehicletypes*'],
    //                 // 'can' => ['view_students'],
    //             ],
    //             [
    //                 'text' => 'Products',
    //                 'icon' => 'fa fa-list',
    //                 'url'  => 'admin/product',
    //                 'active' => ['admin/product/*'],
    //                 // 'can' => ['view_students'],
    //             ],
    //             [
    //                 'text' => 'Products Shapes',
    //                 'icon' => 'fa fa-list',
    //                 'url'  => 'admin/productshape',
    //                 'active' => ['admin/productshape/*'],
    //                 // 'can' => ['view_students'],
    //             ],
                
    //         ],
    //     ],

    //     [
    //         'text' => 'Email templates',
    //         'icon' => 'fas fa-chart-bar',
    //         'active' => ['admin/emails*'],
    //         // 'can' => ['view_reports'],
    //         'submenu' => [
    //             [
    //                 'text' => 'Email templates',
    //                 'icon' => 'fas fa-chart-bar',
    //                 'url'  => 'admin/emails',
    //                 'active' => ['admin/emails*'],
    //                 // 'can' => ['view_reports'],
    //             ],

               
    //         ],
    //     ],
    //     // reports
    //     [
    //         'text' => 'Reviews & Ratings',
    //         'icon' => 'fas fa-chart-bar',
    //         'active' => ['admin/reviews*'],
    //         // 'can' => ['view_reports'],
    //         'submenu' => [
    //             [
    //                 'text' => 'Review',
    //                 'icon' => 'fas fa-chart-bar',
    //                 'url'  => 'admin/reviews',
    //                 'active' => ['admin/reviews*'],
    //                 // 'can' => ['view_reports'],
    //             ],

               
    //         ],
    //     ],
    //     // reports
    //     [
    //         'text' => 'Reports & Analytics',
    //         'icon' => 'fas fa-chart-bar',
    //         'active' => ['admin/reports*'],
    //         // 'can' => ['view_reports'],
    //         'submenu' => [
    //             [
    //                 'text' => 'Reports & Analytics',
    //                 'icon' => 'fas fa-chart-bar',
    //                 'url'  => 'admin/reports',
    //                 'active' => ['admin/reports*'],
    //                 // 'can' => ['view_reports'],
    //             ],

               
    //         ],
    //     ],
    //     // reports

       

       

    //     // [
    //     //     'text' => "Users Feedback",
    //     //     'icon' => 'fas fa-ticket-alt',
    //     //     'url'  => '#',
    //     //     'active' => ['admin/tickets*'],
    //     //     // 'can' => ['view_feedbacks'],
    //     //     'submenu' => [
    //     //         [
    //     //             'text' => 'contact_us',
    //     //             'icon' => 'fas fa-envelope',
    //     //             'url'  => 'admin/contact_us/list',
    //     //             'active' => ['admin/contact_us*'],
    //     //             // 'can' => ['view_feedbacks']
    //     //         ],
    //     //     ]
    //     // ],

        


    //     // cms
    //     [
    //         'text' => 'Content Management',
    //         'icon' => 'fas fa-fw fa-edit ',
    //         'active' => ['admin/cms*'],
    //         // 'can' => ['view_website_page', 'view_mobile_page'],
    //         'submenu' => [
    //             [
    //                 'text' => 'Pages',
    //                 'icon' => 'fas fa-fw fa-laptop',
    //                 'url'  => 'admin/cms',
    //                 'active' => ['admin/cms*'],
    //                 // 'can' => 'view_website_page',
    //             ],
               
    //         ],
    //     ],

      
        
    // ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-WhichVocation/wiki/8.-Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-WhichVocation/wiki/9.-Other-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
        'DateRangePicker' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/daterangepicker/moment.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/daterangepicker/daterangepicker.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/daterangepicker/daterangepicker.css',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-WhichVocation/wiki/9.-Other-Configuration
    */

    'livewire' => false,
];
