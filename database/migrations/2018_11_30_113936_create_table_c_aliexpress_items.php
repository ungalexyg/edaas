<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Lib\Migrations\ProcessableMigration; 
use App\Enums\ProcessableEnum as Processable;



class CreateTableCAliexpressItems extends Migration
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
    protected $table = Processable::TABLE_ALIEXPRESS_ITEMS;


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
                $table->unsignedBigInteger('item_id')->comment('The item id in the channel');
                $table->unsignedInteger('category_id')->nullable()->comment('The category id of this item in the app (not the channel)');                
                $table->string('title', 1060)->nullable();
                $table->string('path', 1060)->nullable()->comment('The realtive path of the collection in the channel');
                $table->string('description', 2083)->nullable();
                $table->integer('orders')->default(0)->nullable()->comment('Item orders count in channel');
                $table->float('price_min', 9, 2)->nullable();
                $table->float('price_max', 9, 2)->nullable();
                $table->text('img_src')->nullable()->comment('Thumbnail image src');

                // add processable fields
                $this->processable($table); 

                // timestamps
                $table->timestamps();                     

                // foreign keys
                // category refer to app category id to keep control on data integrity 
                // from the it can be refered to the channel category id 
                $table->foreign('category_id')->references('id')->on(Processable::TABLE_ALIEXPRESS_CATEGORIES);//->onDelete('cascade');                                               
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
