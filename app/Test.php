<?php

namespace App;

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

}
