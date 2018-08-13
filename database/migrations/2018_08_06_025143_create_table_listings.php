<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableListings extends Migration
{
    /**
     * Migration table
     */
    protected $table = 'listings';

    
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
                $table->string('title', 255);
                $table->string('description');
                $table->unsignedInteger('channel_id');
                $table->unsignedInteger('item_id');
                $table->timestamps();

                $table->foreign('channel_id')->references('id')->on('channels')->onDelete('cascade');
                $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');                
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
