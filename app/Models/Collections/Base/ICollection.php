<?php

namespace App\Models\Collections\Base;

use App\Enums\CollectionsEnum as Collections;

/**
 * Collection Interface
 */
interface ICollection
{
    /**
     * Processable collection fields
     */
    const COLLECTION_STATUS     = Collections::CONTENT_STATUS;    
    const PROCESS_STATUS        = Collections::PROCESS_STATUS;
    const PROCESS_COUNT         = Collections::PROCESS_COUNT;
    const LAST_PROCESS          = Collections::LAST_PROCESS;

    
    /**
     * Store a batch of collection records
     * 
     * @param array $collections
     * @return void
     */
    public function storeBatch($collections);


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
     * @param ICollectionModel $model 
     * @return void
     */
    public function publish(ICollectionModel $model);


    /**
     * Unpublish all published collection records
     * 
     * @return void
     */
    public function unpublishAll();    


    /**
     * Unpublish published collection record
     * 
     * @param ICollectionModel $model 
     * @return void
     */
    public function unpublish(ICollectionModel $model);    
    
    
    /**
     * Aactivate all inactive collection records
     * 
     * @return void
     */
    public function activateAll();    
    
    
    /**
     * Activate collection record 
     * 
     * @param ICollectionModel $model
     * @return void
     */
    public function activate(ICollectionModel $model);    
    
    
    /**
     * Deactivate all active collection records
     * 
     * @return void
     */
    public function deactivateAll();    
    
    
    /**
     * Deactivate collection record
     * 
     * @param ICollectionModel $model
     * @return void
     */
    public function deactivate(ICollectionModel $model);    
}
