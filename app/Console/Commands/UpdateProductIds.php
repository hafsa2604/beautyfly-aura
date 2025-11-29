<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class UpdateProductIds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:update-ids';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update product IDs to be sequential from 1 to 15';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Fetching products...');
        
        $products = Product::orderBy('id')->get();
        
        if ($products->count() !== 15) {
            $this->error("Expected 15 products, found {$products->count()}");
            return 1;
        }

        $this->info("Found {$products->count()} products. Updating IDs...");

        // Disable foreign key checks temporarily
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        try {
            // Create a mapping of old ID to new ID
            $mapping = [];
            $newId = 1;
            
            foreach ($products as $product) {
                $oldId = $product->id;
                if ($oldId != $newId) {
                    $mapping[$oldId] = $newId;
                }
                $newId++;
            }

            if (empty($mapping)) {
                $this->info("Product IDs are already sequential 1-15!");
                return 0;
            }

            // Update IDs in reverse order to avoid conflicts
            krsort($mapping);
            
            foreach ($mapping as $oldId => $newId) {
                // First, update to a temporary high ID to avoid conflicts
                $tempId = 9999 + $oldId;
                DB::table('products')->where('id', $oldId)->update(['id' => $tempId]);
                $this->line("Product ID {$oldId} -> {$tempId} (temporary)");
            }

            // Update foreign key references in related tables (before updating products)
            $this->info("Updating foreign key references...");
            
            // Update reviews table - first update to temp IDs
            foreach ($mapping as $oldId => $newId) {
                $tempId = 9999 + $oldId;
                $updated = DB::table('reviews')->where('product_id', $oldId)->update(['product_id' => $tempId]);
                if ($updated > 0) {
                    $this->line("Updated {$updated} review(s) for product ID {$oldId} -> {$tempId} (temporary)");
                }
            }
            
            // Update order_items table - first update to temp IDs
            foreach ($mapping as $oldId => $newId) {
                $tempId = 9999 + $oldId;
                $updated = DB::table('order_items')->where('product_id', $oldId)->update(['product_id' => $tempId]);
                if ($updated > 0) {
                    $this->line("Updated {$updated} order item(s) for product ID {$oldId} -> {$tempId} (temporary)");
                }
            }

            // Now update products to final IDs
            foreach ($mapping as $oldId => $newId) {
                $tempId = 9999 + $oldId;
                DB::table('products')->where('id', $tempId)->update(['id' => $newId]);
                $this->line("Product ID {$tempId} -> {$newId}");
            }

            // Update foreign key references to final IDs
            foreach ($mapping as $oldId => $newId) {
                $tempId = 9999 + $oldId;
                
                // Update reviews table
                $updated = DB::table('reviews')->where('product_id', $tempId)->update(['product_id' => $newId]);
                if ($updated > 0) {
                    $this->line("Updated {$updated} review(s) for product ID {$tempId} -> {$newId}");
                }
                
                // Update order_items table
                $updated = DB::table('order_items')->where('product_id', $tempId)->update(['product_id' => $newId]);
                if ($updated > 0) {
                    $this->line("Updated {$updated} order item(s) for product ID {$tempId} -> {$newId}");
                }
            }

            // Reset auto increment
            $maxId = Product::max('id');
            DB::statement("ALTER TABLE products AUTO_INCREMENT = " . ($maxId + 1));

            $this->info("Successfully updated product IDs to 1-15!");
            $this->info("Auto-increment reset to " . ($maxId + 1));

        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
            return 1;
        } finally {
            // Re-enable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

        return 0;
    }
}
