<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableCategoriesAddFkChannelId extends Migration
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
            
            // extra reference to the source channel of the organic categories.
            // no need to cascade if channel deleted, the category can still be published
            $table->foreign('channel_id')->references('id')->on('channels'); //->onDelete('cascade');
        });    
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
