<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tools', function (Blueprint $table) {
            $table->unsignedBigInteger('tool_status_id')
                ->default(1)
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('tools', function (Blueprint $table) {
            $table->unsignedBigInteger('tool_status_id')
                ->default(null)
                ->change();
        });
    }
};
