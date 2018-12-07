<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Lib\Migrations\ProcessableMigration; 
use App\Enums\ProcessableEnum as Processable;

class CreateTableCShopifySites extends Migration
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
    protected $table = Processable::TABLE_SHOPIFY_SITES;    


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
                $table->string('url', 2083)->nullable();  // best practice url size  https://boutell.com/newfaq/misc/urllength.html
                $table->string('domain', 255)->nullable();
                $table->string('title', 1060)->nullable()->comment('The meta title of the site');
                $table->string('description', 2083)->nullable()->commet('The meta description of the site');

                // add processable fields
                $this->processable($table); 
                
                // timestamps
                $table->timestamps();     

                // foreign keys
                // $table->foreign(Collection::CHANNEL_ID)->references('id')->on('channels')->onDelete('cascade');                                
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
