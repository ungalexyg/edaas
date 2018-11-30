<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Enums\DBEnum as DBS;
use App\Enums\ProcessEnum as Process;
use App\Enums\CollectionStatusEnum as Collection;



class CreateTableCAliexpressItems extends Migration
{
    /**
     * Migration table
     * 
     * @var string
     */
    protected $table = DBS::COLLECTION . 'aliexpress_items';


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable($this->table)) 
        {
            Schema::create($this->table, function (Blueprint $table) 
            {
                // info fields
                $table->increments('id');
                $table->string('title', 1060)->nullable();
                $table->string('path', 1060)->nullable()->comment('The realtive path of the collection in the channel');
                $table->string('description', 2083)->nullable();
                $table->integer('orders')->default(0)->comment('Item orders count in channel');
                $table->float('price_min', 9, 2)->nullable();
                $table->float('price_max', 9, 2)->nullable();
                $table->text('img_src')->nullable()->comment('Thumbnail image src');
                $table->unsignedInteger('category_id')->comment('The category id of this item in the channel');
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
                $table->foreign('category_id')->references('id')->on(DBS::COLLECTION . 'aliexpress_categories');//->onDelete('cascade');                                               
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
