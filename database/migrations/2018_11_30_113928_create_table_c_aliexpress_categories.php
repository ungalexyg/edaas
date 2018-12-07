<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Lib\Migrations\ProcessableMigration; 
use App\Enums\ProcessableEnum as Processable;


class CreateTableCAliexpressCategories extends Migration
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
    protected $table = Processable::TABLE_ALIEXPRESS_CATEGORIES;


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
                
                // add processable fields
                $this->processable($table); 

                 // add timestamps fields
                $table->timestamps();

                // foreign keys
                // $table->foreign('channel_id')->references('id')->on('channels')->onDelete('cascade');                
                
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
