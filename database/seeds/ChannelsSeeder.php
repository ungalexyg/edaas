<?php

use Illuminate\Database\Seeder;

use App\Models\Channel;

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
            $process = Channel::updateOrCreate(['key' => $key], $seed);
        }
    }
}
