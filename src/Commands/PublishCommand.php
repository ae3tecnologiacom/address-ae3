<?php

namespace Paiva\address\Commands;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    protected $signature = 'address:publish';

    protected $description = 'Publica os arquivos de configuração e migração da biblioteca de endereços';

    public function handle(): void
    {
        $this->info('Publicando arquivos...');

        $this->call('vendor:publish', ['--tag' => 'address-config']);
        $this->call('vendor:publish', ['--tag' => 'address-migrations']);

        $this->info('Publicação concluída.');
    }
}
