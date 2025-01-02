<?php

namespace NgoTools\Connector\Commands;

use Illuminate\Console\Command;

class ConnectorCommand extends Command
{
    public $signature = 'connector';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
