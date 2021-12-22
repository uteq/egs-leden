<?php

namespace App\Console\Commands;

use App\Jobs\ImportMembersFromKerkspot;
use Illuminate\Console\Command;

class ImportMembers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:members';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports the members';

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
        ImportMembersFromKerkspot::dispatchSync();

        return 0;
    }
}
