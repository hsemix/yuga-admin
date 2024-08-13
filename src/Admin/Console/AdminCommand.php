<?php

namespace Yuga\Admin\Console;

use Yuga\Console\Command;

class AdminCommand extends Command
{
    protected $name = 'admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Admin Panel of Your Application';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info("Yuga Admin Panel of Your Application");
    }
}