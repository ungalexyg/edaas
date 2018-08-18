<?php

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
                $table->unsignedInteger('channel_id');
                $table->unsignedInteger('category_id');
                $table->string('title')->nullable();
                $table->string('path')->nullable();
                $table->string('description')->nullable();
                $table->unsignedInteger('channel_category_id')->comment('The external category id in the channel');
                $table->timestamps();

                // the storage_categories serve as meta & resource reference to the categories records
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
