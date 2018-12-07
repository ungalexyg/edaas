<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Lib\Migrations\ProcessableMigration; 
use App\Enums\ProcessableEnum as Processable;


class CreateTableProcesses extends Migration
{
    /**
     * Use migration trait
     */
    use ProcessableMigration;


    /**
     * Migration table
     * 
     * @var string
     */    
    protected $table = Processable::TABLE_PROCESESS;


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
                // info fields   
                $table->increments('id');
                $table->string('key', 255)->unique()->comment('Process reference key, must be snake_case');
                $table->unsignedInteger('processable_id')->comment('Processable entity id');
                $table->string('processable_type', 255)->comment('Processable entity model');

                // add processable fields
                $this->processable($table); 
                
                $table->string('name', 255)->nullable()->comment('Process reference key, must be snake_case');                 
                $table->string('description')->nullable()->comment('Process usage description');
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
