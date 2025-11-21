<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'benefits')) {
                $table->text('benefits')->nullable()->after('desc');
            }
            if (!Schema::hasColumn('products', 'usage')) {
                $table->text('usage')->nullable()->after('benefits');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['benefits', 'usage']);
        });
    }
};
