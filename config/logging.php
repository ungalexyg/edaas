<?php

use App\Lib\Vendor\Laravel\Log;
use Monolog\Handler\StreamHandler;
use App\Enums\ProcessEnum as Processes;

// global logs path
$logs_path = storage_path('logs');

// default process log days old to be deleted 
$log_days = 7;


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
         * Models channels
         */        
        Log::STORAGE_CATEGORY => [
            'driver'    => 'daily',
            'path'      => $logs_path . '/models/storage_category/model.log',
            'days'      => $log_days, 
            'level'     => 'debug', 
        ],        

   
        /**
         * Processors channels 
         */        
        Log::PROCESSOR_MAIN => [
            'driver'    => 'daily',
            'path'      => $logs_path . '/processors/main/processor.log',
            'days'      => $log_days,
            'level'     => 'debug', 
        ],

        Log::PROCESSOR_CATEGORIES => [
            'driver'    => 'daily',
            'path'      => $logs_path . '/processors/categories/processor.log',
            'days'      => $log_days, 
            'level'     => 'debug', 
        ],

        Log::PROCESSOR_ITEMS => [
            'driver'    => 'daily',
            'path'      => $logs_path . '/processors/items/processor.log',
            'days'      => $log_days, 
            'level'     => 'debug', 
        ],


        /**
         * Adapters channels
         */        
        Log::ADAPTERS_CATEGORIES => [
            'driver'    => 'daily',
            'path'      => $logs_path . '/adapters//categories/adapters.log',
            'days'      => $log_days, 
            'level'     => 'debug', 
        ],        

        Log::ADAPTERS_ITEMS => [
            'driver'    => 'daily',
            'path'      => $logs_path . '/adapters/items/adapters.log',
            'days'      => $log_days, 
            'level'     => 'debug', 
        ],           


        /**
         * Observers channels
         */
        Log::OBSERVER_STORAGE_CATEGORY => [
            'driver'    => 'daily',
            'path'      => $logs_path . '/observers/storage_category/observer.log',
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
            'path' => $log_days . '/laravel.log',
            'level' => 'debug',
        ],

        'daily' => [
            'driver' => 'daily',
            'path' => $log_days . '/laravel.log',
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
