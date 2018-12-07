<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Enums\ProcessableEnum as Processable;


class CreateTableProcesses extends Migration
{
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

                // global process settings fields
                $table->unsignedTinyInteger(Processable::ACTIVE_STATUS)->default(Processable::ACTIVE_STATUS_PAUSED)->comment('The process status define if this processable entity should be processed');                        
                $table->unsignedInteger(Processable::MULTIPLE_LIMIT)->default(1)->nullable()->comment('How many "awake" processable records should be processed in single process flight ');
                $table->unsignedTinyInteger(Processable::STORE_RESPONSE)->default(Processable::STORE_RESPONSE_FALSE)->nullable()->comment('If the response of the process should be stored as backup');                
                $table->unsignedBigInteger(Processable::PROCESS_COUNT)->default(0)->nullable()->comment('Count how many times this process has run');                
                $table->unsignedInteger(Processable::SLEEP_TIME)->default(0)->nullable()->comment('Count how many times this process has run');                                
                $table->dateTime(Processable::LAST_PROCESS)->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Last process timestamp');        
                
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
