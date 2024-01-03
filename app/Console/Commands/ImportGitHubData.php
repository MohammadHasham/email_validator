<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ImportGitHubData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:github-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from GitHub';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Artisan::call('import:github https://raw.githubusercontent.com/flotwig/disposable-email-addresses/master/domains.txt');
        Artisan::call('import:github https://raw.githubusercontent.com/disposable-email-domains/disposable-email-domains/master/disposable_email_blocklist.conf');
        Artisan::call('import:github https://raw.githubusercontent.com/FGRibreau/mailchecker/master/list.txt');
        Artisan::call('import:github https://raw.githubusercontent.com/wesbos/burner-email-providers/master/emails.txt');
        Artisan::call('import:github https://raw.githubusercontent.com/7c/fakefilter/main/txt/data.txt');
        Artisan::call('import:github https://raw.githubusercontent.com/daisy1754/jp-disposable-emails/master/list.txt');
        Artisan::call('import:github https://raw.githubusercontent.com/di/martenson-disposable-email-domains/master/disposable_email_blacklist.conf');
        Artisan::call('import:github https://raw.githubusercontent.com/disposable/disposable-email-domains/master/domains.txt');
        Artisan::call('import:github https://gist.githubusercontent.com/jamesonev/7e188c35fd5ca754c970e3a1caf045ef/raw/9ee7a249c2287c19cb7a31127fd4c82c56f6463f/disposableEmailDomains.txt');



        $this->info('GitHub data import completed successfully.');
    }
}
