<?php

namespace App\Console\Commands;

use App\Helpers\Serializer;
use Illuminate\Console\Command;

class CheckSessionUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:session:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if the user session has already finished his/her session and eliminate these users in file.txt';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $filename = "file.txt";

        $array_unserializer = Serializer::restore($filename);
        $array_decoded = json_decode($array_unserializer);

        $time = time();
        $new_array = [];

        
        foreach($array_decoded as $key => $value) {
            if(($time - $value[2]) < 1800) {
                $new_array[$key] = $value;
            }
        }

        Serializer::save(json_encode($new_array), $filename);        

    }
}
