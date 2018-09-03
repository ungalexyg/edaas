<?php

use Illuminate\Database\Seeder;

use App\Models\Channel\Channel;

/**
 * Channel Seeder
 */
class ChannelsSeeder extends Seeder
{   
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = config('processes.channels');

        foreach($seeds as $key => $seed) 
        {
            Channel::updateOrCreate(['key' => $key], $seed);
        }
    }
}
