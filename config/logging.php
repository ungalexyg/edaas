<?php

use App\Lib\Vendor\Laravel\Log;
use Monolog\Handler\StreamHandler;
use App\Enums\ProcessEnum as Processes;

// process categories log path
$process_categories_path = 'logs/processes/'.Processes::CATEGORIES; 

// process  items log path
$process_items_path = 'logs/processes/'.Processes::ITEMS;

// default process log days old to be deleted 
$default_log_days = 7;




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


        ##############################################
        # Actions Logs
        ##############################################   


        /**
         * Main processor log
         * 
         * Log::channel(Log::ACTS)->info('Message...', ['in' => __METHOD__ .':'.__LINE__]);
         */        
        Log::ACTS => [
            'driver' => 'daily',
            'path' => storage_path('logs/acts/acts.log'),
            'days' => $default_log_days, // after how many the log days theoldest will be deleted
            'level' => 'debug', // determines the minimum "level" a message must be in order to be logged by the channel
        ],        


        ##############################################
        # Processor logs
        ##############################################    


        /**
         * Main processor log
         * 
         * Log::channel(Log::MAIN_PROCESSOR)->info('Message...', ['in' => __METHOD__ .':'.__LINE__]);
         */        
        Log::MAIN_PROCESSOR => [
            'driver' => 'daily',
            'path' => storage_path('logs/processes/main/processor.log'),
            'days' => $default_log_days, // after how many the log days theoldest will be deleted
            'level' => 'debug', // determines the minimum "level" a message must be in order to be logged by the channel
        ],


        ##############################################
        # Process Categories Logs
        ##############################################        


        /**
         * Categories processor log
         * 
         * Log::channel(Log::CATEGORIES_PROCESSOR)->info('Message...', ['in' => __METHOD__ .':'.__LINE__]);
         */        
        Log::CATEGORIES_PROCESSOR => [
            'driver' => 'daily',
            'path' => storage_path($process_categories_path . '/'.Log::CATEGORIES_PROCESSOR.'.log'),
            'days' => $default_log_days, // after how many the log days theoldest will be deleted
            'level' => 'debug', // determines the minimum "level" a message must be in order to be logged by the channel
        ],

        /**
         * Categories adapters log
         * 
         * Log::channel(Log::CATEGORIES_ADAPTERS)->info('Message...', ['in' => __METHOD__ .':'.__LINE__]);
         */        
        Log::CATEGORIES_ADAPTERS => [
            'driver' => 'daily',
            'path' => storage_path($process_categories_path . '/adapters.log'),
            'days' => $default_log_days, 
            'level' => 'debug', 
        ],        
        

        /**
         * Categories observers log
         * 
         * Log::channel(Log::CATEGORIES_OBSERVER)->info('Message...', ['in' => __METHOD__ .':'.__LINE__]);
         */        
        Log::CATEGORIES_OBSERVER => [
            'driver' => 'daily',
            'path' => storage_path($process_categories_path . '/observer.log'),
            'days' => $default_log_days, 
            'level' => 'debug', 
        ],   
  



        ##############################################
        # Process Items Logs
        ##############################################


        /**
         * Categories processor log
         * 
         * Log::channel(Log::ITEMS_PROCESSOR)->info('Message...', ['in' => __METHOD__ .':'.__LINE__]);
         */        
        Log::ITEMS_PROCESSOR => [
            'driver' => 'daily',
            'path' => storage_path($process_items_path . '/processor.log'),
            'days' => $default_log_days, // after how many the log days theoldest will be deleted
            'level' => 'debug', // determines the minimum "level" a message must be in order to be logged by the channel
        ],


        /**
         * Categories adapters log
         * 
         * Log::channel(Log::ITEMS_ADAPTERS)->info('Message...', ['in' => __METHOD__ .':'.__LINE__]);
         */        
        Log::ITEMS_ADAPTERS => [
            'driver' => 'daily',
            'path' => storage_path($process_items_path . '/adapters.log'),
            'days' => $default_log_days, 
            'level' => 'debug', 
        ],        
        

        /**
         * Categories observers log
         * 
         * Log::channel(Log::ITEMS_OBSERVER)->info('Message...', ['in' => __METHOD__ .':'.__LINE__]);
         */        
        Log::ITEMS_OBSERVER => [
            'driver' => 'daily',
            'path' => storage_path($process_items_path . '/observer.log'),
            'days' => $default_log_days, 
            'level' => 'debug', 
        ],   

        /**
         * Categories publishers log
         * 
         * Log::channel(Log::ITEMS_PUBLISHER)->info('Message...', ['in' => __METHOD__ .':'.__LINE__]);
         */        
        Log::ITEMS_PUBLISHER => [
            'driver' => 'daily',
            'path' => storage_path($process_items_path . '/publishers.log'),
            'days' => $default_log_days, 
            'level' => 'debug', 
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
