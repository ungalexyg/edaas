<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableChannelsProcesses extends Migration
{
    /**
     * Migration table
     */
    protected $table = 'channels_processes';

    
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
                $table->unsignedInteger('process_id');
                $table->dateTime('last_activity')->nullable()->comment('Last activity time');
                
                $table->foreign('channel_id')->references('id')->on('channels')->onDelete('cascade');
                $table->foreign('process_id')->references('id')->on('processes')->onDelete('cascade');
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
