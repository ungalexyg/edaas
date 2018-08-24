<?php

use Illuminate\Database\Seeder;

use App\Models\Process;


/**
 * Processes Seeder
 */
class ProcessesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = config('processes.processes');

        foreach($seeds as  $key => $seed) 
        {
            Process::updateOrCreate(['key' => $key], $seed);
        }
    }
}
