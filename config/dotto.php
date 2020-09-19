<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Databases
    |--------------------------------------------------------------------------
    |
    | Here you may specify which database connections you would like to use.
    |
    | By default, Dotto uses the "default" database connection.
    |
    */

    // 'databases' => ['mysql'],

    /*
    |--------------------------------------------------------------------------
    | Redids
    |--------------------------------------------------------------------------
    |
    | Here you may specify if your application has Redis enabled.
    |
    | By default, Redis is enabled if Session, Queue or Cache
    | driver is configured to use Redis.
    |
    */

    // 'redis' => true,

    /*
    |--------------------------------------------------------------------------
    | PHP Version
    |--------------------------------------------------------------------------
    |
    | Here you may specify which PHP version you would like to use for your
    | application.
    |
    | By Default, Dotto uses the 7.3 PHP version.
    |
    */

    // 'php_version' => '7.3'


    /*
    |--------------------------------------------------------------------------
    | Route Caching
    |--------------------------------------------------------------------------
    |
    | Here you may specify if you wish to cache your routes.
    |
    | By default, Dotto caches your routes if your
    | application does not use any Closure routes.
    |
    */

    // 'cache_routes' => true,

    /*
    |--------------------------------------------------------------------------
    | PHP Dependencies
    |--------------------------------------------------------------------------
    |
    | Here you may specify which PHP dependencies you would like to use for
    | your application.
    |
    | By default, Dotto only includes the depencencies required by the
    | Laravel framework.
    |
    */

    // 'php_dependencies' => [
    //     'pdo', 'pdo_mysql', 'mbstring', 'opcache',
    //     'tokenizer', 'xml', 'ctype', 'json', 'bcmath', 'pcntl'
    // ],

    /*
    |--------------------------------------------------------------------------
    | Frontend
    |--------------------------------------------------------------------------
    |
    | Here you may specify if you need to build your frontend assets.
    |
    | By default, Dotto builds your frontend assets.
    |
    */

    // 'frontend' => true,

    /*
    |--------------------------------------------------------------------------
    | Build Command.
    |--------------------------------------------------------------------------
    |
    | Here you may specify the command to build your frontend assets.
    |
    | By default, Dotto runs the "production" script from your
    | "package.json" file.
    |
    */

    // 'frontend_command' => 'npm run production',

    /*
    |--------------------------------------------------------------------------
    | NodeJS Package Manager
    |--------------------------------------------------------------------------
    |
    | Here you may specify which package manager you wish to use to build your
    | assets.
    |
    | By default, Dotto checks for the existing "lock" file and determines
    | which package manager was used to generate it.
    |
    */

    // 'frontend_manager' => 'npm',

];
