<?php

use App\Lib\Vendor\Laravel\Log;
use Monolog\Handler\StreamHandler;


// global logs path
$logs_path = storage_path('logs');

// default process log days old to be deleted 
$log_days = 30;


return [

    /*
    |--------------------------------------------------------------------------
    | Log levels
    |--------------------------------------------------------------------------
    |
    */

    // Log::emergency($message);
    // Log::alert($message);
    // Log::critical($message);
    // Log::error($message);
    // Log::warning($message);
    // Log::notice($message);
    // Log::info($message);
    // Log::debug($message);

    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that gets used when writing
    | messages to the logs. The name specified in this option should match
    | one of the channels defined in the "channels" configuration array.
    |
    */

    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log channels for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Drivers: "single", "daily", "slack", "syslog",
    |                    "errorlog", "monolog",
    |                    "custom", "stack"
    |
    |
    | Sample channel usage :
    |
    | Log::channel(Log::PROCESSOR_MAIN)->info('Message...', ['in' => __METHOD__ .':'.__LINE__]);
    |
    */

    'channels' => [

   
        /**
         * Processes logs 
         */        
        Log::MAIN_PROCESSOR => [
            'driver'    => 'daily',
            'path'      => $logs_path . '/processes/'. Log::MAIN_PROCESSOR.'/'. Log::MAIN_PROCESSOR . '.log',
            'days'      => $log_days,
            'level'     => 'debug', 
        ],

        Log::ALIEXPRESS_CATEGORIES => [
            'driver'    => 'daily',
            'path'      => $logs_path . '/processes/'. Log::ALIEXPRESS_CATEGORIES.'/'. Log::ALIEXPRESS_CATEGORIES .'.log',
            'days'      => $log_days,
            'level'     => 'debug', 
        ],

        Log::ALIEXPRESS_ITEMS => [
            'driver'    => 'daily',
            'path'      => $logs_path . '/processes/'. Log::ALIEXPRESS_ITEMS.'/'. Log::ALIEXPRESS_ITEMS .'.log',
            'days'      => $log_days, 
            'level'     => 'debug', 
        ],

        Log::SHOPIFY_SITES => [
            'driver'    => 'daily',
            'path'      => $logs_path . '/processes/'. Log::SHOPIFY_SITES.'/'. Log::SHOPIFY_SITES .'.log',
            'days'      => $log_days, 
            'level'     => 'debug', 
        ],
 


        #############################################
        # Default sample logs
        #############################################
        

        /**
         * Sample stack
         */
        'stack' => [
            'driver' => 'stack',
            'channels' => ['single'],
        ],


        /**
         * Available drivers
         */
        'single' => [
            'driver' => 'single',
            'path' => $logs_path . '/laravel.log',
            'level' => 'debug',
        ],

        'daily' => [
            'driver' => 'daily',
            'path' => $logs_path . '/laravel.log',
            'level' => 'debug',
            'days' => 7,
        ],

        'slack' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => 'Laravel Log',
            'emoji' => ':boom:',
            'level' => 'critical',
        ],

        'stderr' => [
            'driver' => 'monolog',
            'handler' => StreamHandler::class,
            'with' => [
                'stream' => 'php://stderr',
            ],
        ],

        'syslog' => [
            'driver' => 'syslog',
            'level' => 'debug',
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level' => 'debug',
        ],
    ],

];
