<?php

namespace App\Lib\Migrations;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use App\Enums\ProcessableEnum as Processable;


/**
 * Processable Migration trait
 */
trait ProcessableMigration 
{
    /**
     * Add processable fields to the table
     * 
     * @param Blueprint $table
     * @return void
     */
    public function processable(Blueprint &$table) 
    {
        $table->unsignedTinyInteger(Processable::ACTIVE_STATUS)->default(Processable::ACTIVE_STATUS_PAUSED)->nullable()->comment('The process status define if this processable entity should be processed');
        
        $table->unsignedTinyInteger(Processable::PUBLIC_STATUS)->default(Processable::PUBLIC_STATUS_HIDDEN)->nullable()->comment('The collection stauts define the status of this record in temrs of publicity');
                
        $table->unsignedBigInteger(Processable::PROCESS_COUNT)->default(0)->nullable()->comment('Count how many times this process has run');                
                        
        $table->dateTime(Processable::LAST_PROCESS)->default(DB::raw('CURRENT_TIMESTAMP'))->nullable()->comment('Last process timestamp');        
    }
}   


