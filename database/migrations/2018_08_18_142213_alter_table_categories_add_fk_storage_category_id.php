<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableCategoriesAddFkStorageCategoryId extends Migration
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
     * @return void
     */
    public function up()
    {
        Schema::table($this->table, function (Blueprint $table) {
            
            // the storage_categories serve as meta & resource reference to the categories records
            // no need to cascade storages, the storage record can be deleted and the category can stay published 
            // and if the categories added manually, they can't be cascaded
            $table->foreign('storage_category_id')->references('id')->on('storage_categories'); //->onDelete('cascade');       

        });    
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign(['storage_category_id']);
    }
}
