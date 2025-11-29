<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class RemoveDuplicateProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:remove-duplicates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove duplicate products, keeping the newest one for each title';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Finding duplicate products...');

        // Find all duplicate titles
        $duplicates = Product::select('title', DB::raw('COUNT(*) as count'))
            ->groupBy('title')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        if ($duplicates->isEmpty()) {
            $this->info('No duplicates found!');
            return 0;
        }

        $this->info("Found {$duplicates->count()} products with duplicates.");

        $deletedCount = 0;

        foreach ($duplicates as $duplicate) {
            // Get all products with this title, ordered by ID (newest first)
            $products = Product::where('title', $duplicate->title)
                ->orderBy('id', 'desc')
                ->get();

            // Keep the first one (newest), delete the rest
            $toDelete = $products->skip(1);
            
            foreach ($toDelete as $product) {
                $product->delete();
                $deletedCount++;
                $this->line("Deleted duplicate: {$product->title} (ID: {$product->id})");
            }
        }

        $this->info("Removed {$deletedCount} duplicate products.");
        $this->info("Remaining products: " . Product::count());

        return 0;
    }
}
