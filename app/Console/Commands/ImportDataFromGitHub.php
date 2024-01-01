<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Models\Domain;

class ImportDataFromGitHub extends Command
{
    protected $signature = 'import:github {url}';
    protected $description = 'Import data from a GitHub URL into the database';

    public function handle()
    {
        $url = $this->argument('url');
        $data = file_get_contents($url);

        // Assuming you have a 'domains' table with a 'name' column
        $lines = explode("\n", $data);
        foreach ($lines as $line) {
            // Validation or other processing logic can be added here
            $line = trim($line);
            if (!empty($line)) {
                // Check if the record already exists
                $existingRecord = Domain::where('name', $line)->first();

                if (!$existingRecord) {
                    // Create a new record only if it doesn't exist
                    Domain::create(['name' => $line]);
                }
            }
        }

        $this->info('Data imported successfully!');
    }
}
