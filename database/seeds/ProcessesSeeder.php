<?php

use Illuminate\Database\Seeder;

use App\Models\Process;

class ProcessesSeeder extends Seeder
{

    protected $seed = [
        [
            'name'          => 'Categories',
            'description'   => 'Scan categories in channel',
            'key'           => 'categories',
        ],
        [
            'name'          => 'Items',
            'description'   => 'Scan items in channel',
            'key'           => 'items',
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
            $process = new Process;
            $process->name = $record['name'] ?? null;
            $process->description = $record['description'] ?? null;
            $process->key = $record['key'];
            $process->save();
        }
    }
}
