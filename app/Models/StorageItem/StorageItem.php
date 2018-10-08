<?php

namespace App\Models\StorageItem;

use App\Models\Base\BaseModel;


/**
 * Storage Category Model
 */
class StorageItem extends BaseModel implements IStorageItem
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'storage_items';    
    

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = []; // if $guarded is empty, all the cols are $fillable


    /*
$url = "http://www.google.co.in/intl/en_com/images/srpr/logo1w.png";
$contents = file_get_contents($url);
$name = substr($url, strrpos($url, '/') + 1);
Storage::put($name, $contents);    
    */    
}
