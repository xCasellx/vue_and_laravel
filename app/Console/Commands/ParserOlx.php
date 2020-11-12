<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Classes\Parser;
class ParserOlx extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Parser:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Starting parsing site OLX';

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
     * @return int
     */
    public function handle()
    {
        $parser = new Parser("https://www.olx.ua/transport/legkovye-avtomobili/daewoo/kremenchug");
        $parser->run();
        return 0;
    }

}
