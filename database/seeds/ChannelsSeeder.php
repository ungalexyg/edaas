<?php

use Illuminate\Database\Seeder;

use App\Models\Channel;

class ChannelsSeeder extends Seeder
{


    protected $seed = [
        [
            'domain' => 'aliexpress.com',
            'key' => 'aliexpress',
        ],
        [
            'domain' => 'ebay.com',
            'key' => 'ebay',
        ],
        [
            'domain' => 'amazon.com',
            'key' => 'amazon',
        ],                
    ];



    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->seed as $key => $record) 
        {
            $channel = new Channel;
            $channel->domain = $record['domain'];
            $channel->name = $record['name'] ?? null;
            $channel->description = $record['description'] ?? null;
            $channel->key = $record['key'];
            $channel->save();
        }
    }
}
