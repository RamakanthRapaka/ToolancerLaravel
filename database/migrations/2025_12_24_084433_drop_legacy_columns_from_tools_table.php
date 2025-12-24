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
        Schema::table('tools', function (Blueprint $table) {

            // Drop legacy / duplicate columns
            if (Schema::hasColumn('tools', 'category')) {
                $table->dropColumn('category');
            }

            if (Schema::hasColumn('tools', 'sub_category')) {
                $table->dropColumn('sub_category');
            }

            if (Schema::hasColumn('tools', 'pricing_type')) {
                $table->dropColumn('pricing_type');
            }

            if (Schema::hasColumn('tools', 'pricing_details')) {
                $table->dropColumn('pricing_details');
            }

            if (Schema::hasColumn('tools', 'status')) {
                $table->dropColumn('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tools', function (Blueprint $table) {

            // Restore old columns (only if rollback needed)
            $table->string('category')->after('tool_category_id');
            $table->string('sub_category')->nullable()->after('category');

            $table->enum('pricing_type', ['free', 'freemium', 'paid', 'lifetime'])
                ->after('affiliate_link');

            $table->string('pricing_details')->nullable()->after('pricing_type');

            $table->enum('status', ['pending', 'active', 'rejected'])
                ->default('pending')
                ->after('rating');
        });
    }
};
