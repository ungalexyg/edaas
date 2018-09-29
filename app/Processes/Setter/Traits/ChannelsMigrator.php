<?php 

namespace App\Processes\Setter\Traits;

use App\Models\Channel\Channel;
//use App\Models\Process\Process;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Database\Migrations\Migration;


/**
 * Storage Migrator
 * 
 * Handle generic storage tables migrations for the processes based on processes config
 */ 
trait ChannelsMigrator  
{
    /**
     * Storage categories table prefix
     * 
     * @var string
     */    
    protected $prefix_categories = 'storage_categories_';


    /**
     * Storage items table prefix
     * 
     * @var string
     */
    protected $prefix_items = 'storage_items_';
    
    
    /**
     * Migaret channels tables
     * 
     * @return void
     */
    public function migrate() 
    {
        $channels = Channel::all();

        foreach($channels as $key => $channel) 
        {            
            $this->createStorageCategoriesTable($channel->id); 
           
            $this->createStorageItemsTable($channel->id); 
        }
    }


    /**
     * Migration, create generic storage categories table
     * 
     * TODO: implemented method with considertion to generic storage categories...
     * 
     * @param int $channel_id
     * @return void
     */
    protected function createStorageCategoriesTable($channel_id) 
    {
        $table_name = $this->prefix_categories . $channel_id;

        if(!Schema::hasTable($table_name)) 
        {
            Schema::create($table_name, function (Blueprint $table) 
            {
                $table->increments('id');
                $table->string('title', 1060)->nullable();
                $table->string('path', 1060)->nullable();
                $table->string('description', 1060)->nullable();
                $table->unsignedInteger('category_id')->nullable()->comment('The published category that sourced from this record. Some storage records might not be assigned to category');                 
                $table->unsignedInteger('channel_id')->comment('The channel id that this record fetched from');                
                $table->unsignedInteger('channel_category_id')->comment('The external category id in the channel');
                $table->unsignedInteger('parent_channel_category_id')->comment('The external parent category id in the channel');
                $table->unsignedTinyInteger('active')->default(0)->comment('If the category is active, the ItemsProcesssor will fetch items from this category in the channel [active = 1 | not active = 0]');
                $table->unsignedTinyInteger('published')->default(0)->comment('If the record is published, the CategoriesPublisher will update the sourced category_id with the latest updates from the CategoiresProcessor [published = 1 | not published = 0]');
                $table->timestamps();
                
                // the storage_categories serve as resource reference to the categories records when they published
                // no need to cascade storages, the storage record can be deleted and the category can stay published 
                // and if the categories added manually, they can't be cascaded.                
                $table->foreign('channel_id')->references('id')->on('channels');//->onDelete('cascade');                
                $table->foreign('category_id')->references('id')->on('categories'); //->onDelete('cascade');                
            });
        }        
    }


    /**
     * Migration, create generic storage items table
     * 
     * @param int $channel_id
     * @return void
     */
    protected function createStorageItemsTable($channel_id) 
    {
        $table_name = $this->prefix_items . $channel_id;

        if(!Schema::hasTable($table_name)) 
        {
            Schema::create($table_name, function (Blueprint $table) 
            {
                $table->increments('id');
                $table->string('title', 1060)->nullable();
                $table->string('path', 1060)->nullable();
                $table->string('description', 1060)->nullable();
                $table->unsignedInteger('item_id')->nullable()->comment('The published item that sourced from this record.');                                 
                $table->unsignedInteger('channel_item_id')->comment('The external item id in the channel');
                $table->unsignedTinyInteger('active')->default(0)->comment('If the storage record is active, the processors will fetch updates for this row & update it. [active = 1 | not active = 0]');
                $table->unsignedTinyInteger('published')->default(0)->comment('If the record marked as published, the processors will update the related public record [published = 1 | not published = 0]');
                $table->timestamps();             
            });
        }         
    }
}
