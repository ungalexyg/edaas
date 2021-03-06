<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStorageCategories extends Migration
{
    /**
     * Migration table
     * 
     * @var string
     */
    protected $table = 'storage_categories';


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable($this->table)) 
        {
            Schema::create($this->table, function (Blueprint $table) 
            {
                $table->increments('id');
                $table->string('title', 1060)->nullable();
                $table->string('path', 1060)->nullable();
                $table->string('description', 1060)->nullable();
                $table->unsignedInteger('category_id')->nullable()->comment('The published category that sourced from this record. Some storage records might not be assigned to category');                 
                $table->unsignedInteger('channel_id')->comment('The channel id that this record fetched from');                
                $table->unsignedBigInteger('channel_category_id')->comment('The external category id in the channel');
                $table->unsignedBigInteger('parent_channel_category_id')->comment('The external parent category id in the channel');
                $table->unsignedTinyInteger('active')->default(0)->comment('If the category is active, the ItemsProcesssor will fetch items from this category in the channel [active = 1 | not active = 0]');
                $table->unsignedTinyInteger('published')->default(0)->comment('If the record is published, the CategoriesPublisher will update the sourced category_id with the latest updates from the CategoiresProcessor [published = 1 | not published = 0]');
                $table->unsignedInteger('process_count')->nullable()->comment('Count how many times the items scanning process launched on this storage category');                
                //$table->dateTime('last_process')->default(Carbon::now())->comment('Last process time of items scanning from this storage category');
                $table->dateTime('last_process')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Last process time of items scanning from this storage category');
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
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
