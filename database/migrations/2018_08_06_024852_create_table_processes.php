<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Enums\DBEnum as DBS;
use App\Enums\ProcessEnum as Process;
use App\Enums\CollectionStatusEnum as Collection;


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
                // info fields   
                $table->increments('id');
                $table->string('key', 255)->unique()->comment('Process reference key, must be snake_case');
                $table->unsignedInteger('processable_id')->comment('Processable entity id');
                $table->string('processable_type', 255)->comment('Processable entity model');

                
                // processable fields
                $table->unsignedTinyInteger(DBS::PROCESS_STATUS)->default(Process::PAUSED)->comment('The process status define if this processable entity should be processed');
                $table->unsignedInteger(DBS::PROCESS_COUNT)->default(0)->nullable()->comment('Count how many times this process has run');                
                $table->dateTime(DBS::LAST_PROCESS)->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Last process timestamp');


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
