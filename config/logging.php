<?php

use Monolog\Handler\StreamHandler;

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
    */

    'channels' => [


        ####################################
        # custom logs
        ####################################        


        /**
         * Processes log
         * 
         * Log::channel('processes')->info('Something happened!', ['location' => __METHOD__ .':'.__LINE__]);
         */
        'processes' => [
            'driver' => 'daily',
            'path' => storage_path('logs/processes/process'),
            'days' => 14, // after how many the log days theoldest will be deleted
            'level' => 'debug', // determines the minimum "level" a message must be in order to be logged by the channel
        ],


        /**
         * Adapters log
         * 
         * Log::channel('adapters')->info('Something happened!', ['location' => __METHOD__ .':'.__LINE__]);
         */
        'adapters' => [
            'driver' => 'daily',
            'path' => storage_path('logs/processes/adapters'),
            'days' => 14, // after how many the log days theoldest will be deleted
            'level' => 'debug', // determines the minimum "level" a message must be in order to be logged by the channel
        ],        
        

        /**
         * Adapters log
         * 
         * Log::channel('adapters')->info('Something happened!', ['location' => __METHOD__ .':'.__LINE__]);
         */
        'observers' => [
            'driver' => 'daily',
            'path' => storage_path('logs/processes/observers'),
            'days' => 14, // after how many the log days theoldest will be deleted
            'level' => 'debug', // determines the minimum "level" a message must be in order to be logged by the channel
        ],   

        

        ####################################
        # Default sample logs
        ####################################


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
            'path' => storage_path('logs/laravel.log'),
            'level' => 'debug',
        ],

        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
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
