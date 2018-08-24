<?php 

namespace App\Processes\Keepers;

use App\Models\Channel;
use App\Models\Category;
use App\Models\StorageCategory;
use Illuminate\Support\Facades\Log;
use App\Exceptions\Processors\Keepers\CategoriesKeeperException;


/**
 * Categories Keeper
 */ 
class CategoriesKeeper extends BaseKeeper 
{
	/**
	 * Store fresh scanned data in the storage
     *
     * At this stage $this->bag shouldhave the following contents:
     *  
     * [categories] => Array
     *   (
     *       [aliexpress] => Array
     *           (
     *               [0] => Array
     *                   (
     *                       [title] => Women's Clothing & Accessories
     *                       [path] => /women-clothing-accessories.html
     *                       [channel_category_id] => 100003109
     *                       [parent_channel_category_id] => 100003222
     *                   )
	 * 
	 * @see App\Observers\StorageCategoryObserver
     * @return self
	 */
	public function store()
    {
        $categories = $this->bag[$this->process] ?? null;

        if(!is_array($categories)) throw new CategoriesKeeperException(CategoriesKeeperException::INVALID_BAG_CONTENTS . ' | ' . print_r(['bag' => $this->bag], 1));

        foreach($categories as $channel_key => $channel_categories) 
        {
            $channel = Channel::where('key', $channel_key)->first();

            if(!isset($channel->id)) throw new CategoriesKeeperException(CategoriesKeeperException::INVALID_CHANNEL_KEY . ' | key: ' .  $channel_key);            

            foreach($channel_categories as $k => $category_data) 
            {                
                $channel_category_id = $category_data['channel_category_id'] ?? null;

                if(!is_numeric($channel_category_id)) throw new CategoriesKeeperException(CategoriesKeeperException::INVALID_CHANNEL_CATEGORY_ID . ' | channel_category_id : ' . var_export($channel_category_id, 1));

                unset($category_data['channel_category_id']); // adjustment for updateOrCreate

                $category_data['channel_id'] = $channel->id;
                                
                // if there's a StorageCategory with the given channel_category_id, set the rest of the data to the given $category_data, otherwise create it.
                $storage_category = StorageCategory::updateOrCreate(['channel_category_id' => $channel_category_id], $category_data);

                if(($this->config['auto_publish'] ?? false)) 
                {
                    static::publish($storage_category);
                }
            }
        }

        Log::channel('keepers')->info('completed store categories', ['location' => __METHOD__ .':'.__LINE__]);

        if(($this->config['auto_publish'] ?? false)) 
        {
            static::publishLinkParents();
        }        

        return $this;
    }


	/**
	 * Publish data from the storage to the public tables
	 * 
     * @see App\Observers\StorageCategoryObserver
     * @param StorageCategory $storage_category
	 * @return Category $category // the published category
	 */
    public static function publish(StorageCategory $storage_category) 
    {
        // if there's a Category with the given storage_category_id, set the rest of the data to the 2nd given array, otherwise create it.
        $category = Category::updateOrCreate(
            [
                'storage_category_id' => $storage_category->id
            ], [
                'title' => $storage_category->title, 
                'description' => $storage_category->description
            ]
        );

        // link the fresh category to the storage_category 
        $storage_category->category_id = $category->id;
       
        $storage_category->save();

        return $category;
    }


    /**
     * Link published cateogires parents 
     * based on channel's hirarchy in storage category
     * 
     * // TODO: consider channel_id if multiple channels involved
     * 
     * 
     * @return void
     */
    public static function publishLinkParents() 
    {
        // get categoies where there is storage link but the parent category not set yet
        $categories = Category::where('storage_category_id', '!=', null)->where('parent_category_id', '=', null)->get();

        foreach($categories as $category) 
        {
            $storage_category = StorageCategory::withParent($category->storage_category_id)->first();
            
            if(isset($storage_category->parent->id)) // if it has a parent
            {
                // check if the parent already published
                $parent_category = Category::where('storage_category_id', '=', $storage_category->parent->id)->first();

                // if it's published, assign it to the child now
                if(isset($parent_category->id)) 
                {
                    $category->parent_category_id = $parent_category->id;
    
                    $category->save();
                }
            }
            elseif($storage_category->parent_channel_category_id == 0) // if the storage record is parent category in the channel
            {
                $category->parent_category_id = 0; // update the published category also as parent category
    
                $category->save();                
            }
        }  
        
        Log::channel('keepers')->info('completed publishLinkParents', ['location' => __METHOD__ .':'.__LINE__]);        
    }
}



