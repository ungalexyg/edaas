<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableChannels extends Migration
{
    /**
     * Migration table
     */
    protected $table = 'channels';


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
                $table->string('domain', 255)->unique();
                $table->string('name', 255)->nullable()->comment('General usage');
                $table->string('description')->nullable()->comment('General usage');
                $table->string('key', 255)->unique()->comment('System usage, must be snake_case'); 
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
