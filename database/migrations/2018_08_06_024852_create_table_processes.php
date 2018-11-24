<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProcesses extends Migration
{

    protected $table = 'processes';

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
                $table->string('name', 255)->nullable()->comment('Process reference key, must be snake_case');                 
                $table->string('description')->nullable()->comment('Process usage description');
                $table->string('key', 255)->comment('Process reference key, must be snake_case');
                $table->unsignedInteger('processable_id')->comment('Processable entity id');
                $table->unsignedInteger('processable_type')->nullable()->comment('Processable entity model');
                $table->dateTime('last_process')->nullable()->comment('Last process time');               
                $table->unsignedInteger('process_count')->nullable()->comment('Count of how many times this process has been launched');
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
