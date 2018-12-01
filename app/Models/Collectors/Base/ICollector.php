<?php

namespace App\Models\Collectors\Base;

use App\Enums\CollectionEnum as Collections;
use App\App\Models\Collectors\Base\ICollector as CollectorModel;

/**
 * Collector Interface
 * Implemented by models which responsoble on Collection Tables
 */
interface ICollector
{    
    /**
     * Store a batch of records
     * 
     * @param array $batch
     * @return void
     */
    public function storeBatch(array $batch);


    /**
     * Store single collection record
     * 
     * @param array $collection
     * @return void
     */
    public function store($collection);

    
    /**
     * Publish all collection records
     * 
     * @return void
     */
    public function publishAll();
    

    /**
     * Publish collection record
     * 
     * @param CollectorModel $model 
     * @return void
     */
    public function publish(CollectorModel $model);


    /**
     * Unpublish all published collection records
     * 
     * @return void
     */
    public function unpublishAll();    


    /**
     * Unpublish published collection record
     * 
     * @param CollectorModel $model 
     * @return void
     */
    public function unpublish(CollectorModel $model);    
    
    
    /**
     * Aactivate all inactive collection records
     * 
     * @return void
     */
    public function activateAll();    
    
    
    /**
     * Activate collection record 
     * 
     * @param CollectorModel $model
     * @return void
     */
    public function activate(CollectorModel $model);    
    
    
    /**
     * Deactivate all active collection records
     * 
     * @return void
     */
    public function deactivateAll();    
    
    
    /**
     * Deactivate collection record
     * 
     * @param CollectorModel $model
     * @return void
     */
    public function deactivate(CollectorModel $model);    
}
