<?php

namespace App\Models\Collectors\Base;

use App\Enums\ProcessableEnum as Processable;
use App\Models\Base\BaseModel;
use App\Exceptions\ModelException as Exception;
use App\Models\Collectors\Base\Traits\{CollectorRelations, CollectorScopes, CollectorValidations, CollectorActs};


/**
 * Base Collector Model
 */
abstract class BaseCollector extends BaseModel implements ICollector
{
    /**
     * Model's traits 
     */
    use CollectorRelations, CollectorScopes, CollectorValidations, CollectorActs; 


    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = []; // if $guarded is empty, all the cols are $fillable   
    

    /**
     * Associate collector model with it's collection processs
     * the process that collect records for this table
     * 
     * @var string|null
     */
    protected $process_key; 


    /**
     * Process enum reference
     * 
     * @var App\Enums\ProcessableEnum as Processable
     */
    protected static $processable;
    

    /**
     * Boot setup
     */
    public static function boot()
    {
        // refer the collection enum for shared usage 
        $enum = (new Processable);
        static::$processable =& $enum;
    }    
}
