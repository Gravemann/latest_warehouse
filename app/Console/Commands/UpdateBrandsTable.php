<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateBrandsTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-brands-table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        \App\Models\Brand::query()->update([
            'created_at' => \now()->toDateTimeString(),
            'updated_at' => \now()->toDateTimeString(),
        ]);
    }
}
