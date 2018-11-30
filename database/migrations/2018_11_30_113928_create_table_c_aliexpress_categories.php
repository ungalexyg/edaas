<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Enums\DBEnum as DBS;
use App\Enums\ProcessEnum as Process;
use App\Enums\CollectionStatusEnum as Collection;



class CreateTableCAliexpressCategories extends Migration
{
    /**
     * Migration table
     * 
     * @var string
     */
    protected $table = DBS::COLLECTION . 'aliexpress_categories';


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
                $table->string('title', 1060)->nullable();
                $table->string('path', 1060)->nullable()->comment('The realtive path of the collection in the channel');                ;
                $table->string('description', 1060)->nullable();
                $table->unsignedBigInteger('category_id')->comment('The category id in the channel');
                $table->unsignedBigInteger('parent_category_id')->comment('The parent category id in the channel');
                $table->unsignedInteger('channel_id')->comment('The channel id that represent this table\'s collections');

                // processable fields
                $table->unsignedTinyInteger(DBS::COLLECTION_STATUS)->default(Collection::ARCHIVED)->comment('The collection stauts define the status of this record in temrs of publicity');
                $table->unsignedTinyInteger(DBS::PROCESS_STATUS)->default(Process::PAUSED)->comment('The process status define if this processable entity should be processed');
                $table->unsignedInteger(DBS::PROCESS_COUNT)->default(0)->nullable()->comment('Count how many times this process has run');                
                $table->dateTime(DBS::LAST_PROCESS)->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Last process timestamp');

                 // timestamps
                $table->timestamps();

                // foreign keys
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