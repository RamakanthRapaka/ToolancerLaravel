<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tools', function (Blueprint $table) {
            $table->foreignId('tool_category_id')->after('name')->constrained();
            $table->foreignId('tool_sub_category_id')->nullable()->constrained();
            $table->foreignId('pricing_type_id')->constrained();
            $table->foreignId('pricing_detail_id')->nullable()->constrained();
            $table->foreignId('tool_status_id')->constrained();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
