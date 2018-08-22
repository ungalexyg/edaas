<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
//use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Moloquent;

class Test extends Moloquent
{
    protected $connection = 'mongodb';

    protected $collection = 'collection1';

    protected $attributes = [
        'key'
    ];


    
    /*
     * Test mongo
     *
     * @return \Illuminate\Http\Response
     
        public function mongo()
        {
            $data = Test::all();
            echo '<pre>';
            var_dump($data[0]->key);
            die;
        }
    */

}
