<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCategories extends Migration
{

    /**
     * Migration table
     * 
     * @var string
     */
    protected $table = 'categories';


    /**
     * Run the migrations.
     *
     * There are 2 types of category records:
     * 
     * 1) Organic Category - 
     * generated organically by the categories scan process 
     * and has oneToOne relation with StorageCategories which serve as their resource
     * for category contents (name, etc).
     * 
     * 2) Manual Category - 
     * generated manually by insertion and has no relations to organic resources.
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
                // if it's not organic category, the storage_category_id can be null
                $table->unsignedInteger('storage_category_id')->nullable()->comment('reference to the corresponding storage record for Organic Categories - storage_categories.id');
                $table->unsignedInteger('parent_category_id')->nullable()->comment('parent category id');
                $table->string('title', 1060)->nullable();
                $table->string('description', 1060)->nullable();
                $table->string('path',1060)->nullable();
                $table->timestamps();
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
