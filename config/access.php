<?php

return [

    // Whether or not registration is enabled
    'registration' => env('ENABLE_REGISTRATION', true),

    // Configurations for the user
    'users' => [
        // Whether or not the user has to confirm their email when signing up
        'confirm_email' => env('CONFIRM_EMAIL', false),

        // Whether or not the users email can be changed on the edit profile screen
        'change_email' => env('CHANGE_EMAIL', false),

        // The name of the super administrator role
        'admin_role' => 'administrator',
        'admin_role_readable_name' => 'Administrator',

        // The name of the human resource manager role
        'human_resource_manager_role' => 'human_resource_manager',
        'human_resource_manager_role_readable_name' => 'Human Resource Manager',

        // The name of the human resource role
        'human_resource_role' => 'human_resource',
        'human_resource_role_readable_name' => 'Human Resource',


        /*
         * Whether or not new users need to be approved by an administrator before logging in
         * If this is set to true, then confirm_email is not in effect
         */
        'requires_approval' => env('REQUIRES_APPROVAL', false),

        // Login username to be used by the controller.
        'username' => 'email',
    ],

];
