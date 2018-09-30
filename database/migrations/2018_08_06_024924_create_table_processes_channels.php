<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProcessesChannels extends Migration
{
    /**
     * Migration table
     */
    protected $table = 'processes_channels';

    
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
                $table->unsignedInteger('process_id');
                $table->unsignedInteger('channel_id');                                
                $table->unsignedInteger('process_count')->comment('Count of how many times this process has been launched');
                $table->dateTime('last_process')->nullable()->comment('Last process time');
                
                $table->foreign('process_id')->references('id')->on('processes')->onDelete('cascade');
                $table->foreign('channel_id')->references('id')->on('channels')->onDelete('cascade');
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
