<?php

namespace App\Models\Collectors\Base;

use App\Models\Base\BaseModel;
use App\Enums\CollectionEnum as Collection;
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
     * Processable collection fields
     */
    const CONTENT_STATUS        = Collection::CONTENT_STATUS;    
    const PROCESS_STATUS        = Collection::PROCESS_STATUS;
    const PROCESS_COUNT         = Collection::PROCESS_COUNT;
    const PROCESS_LAST          = Collection::PROCESS_LAST;    


    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = []; // if $guarded is empty, all the cols are $fillable    
}
