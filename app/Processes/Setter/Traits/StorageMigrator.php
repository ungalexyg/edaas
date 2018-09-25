<?php 

namespace App\Processes\Setter\Traits;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Database\Migrations\Migration;


/**
 * Storage Migrator
 * 
 * Handle generic storage tables migrations for the processes based on processes config
 */ 
trait StorageMigrator  
{
    /**
     * Storage items table prefix
     * 
     * @var string
     */
    protected $table_prefix_items = 'storage_items_';


    /**
     * Migration, create generic storage items table
     * 
     * @param int $channel_id
     * @return void
     */
    public function createStorageItemsTable($channel_id) 
    {
        $table = $this->table_prefix_items . $channel_id;

        Schema::connection('mysql')->create($table , function(Blueprint $table)
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
