<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStorageItems extends Migration
{
    /**
     * Migration table
     * 
     * @var string
     */
    protected $table = 'storage_items';


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if(!Schema::hasTable($this->table)) 
        {
            Schema::create($this->table, function (Blueprint $table) 
            {
                $table->increments('id');
                $table->string('title', 1060)->nullable();
                $table->string('path', 1060)->nullable();
                $table->string('description', 1060)->nullable();
                $table->unsignedInteger('item_id')->nullable()->comment('The published item that sourced from this record.');                                 
                $table->unsignedInteger('storage_category_id')->comment('Storage category id');
                $table->unsignedInteger('channel_item_id')->comment('The external item id in the channel');
                $table->unsignedTinyInteger('active')->default(0)->comment('If the storage record is active, the processors will fetch updates for this row & update it. [active = 1 | not active = 0]');
                $table->unsignedTinyInteger('published')->default(0)->comment('If the record marked as published, the processors will update the related public record [published = 1 | not published = 0]');
                $table->timestamps();     
                
                $table->foreign('storage_category_id')->references('id')->on('storage_categories');//->onDelete('cascade');                                
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
