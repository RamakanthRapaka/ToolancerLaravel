<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('experts', function (Blueprint $table) {
            $table->json('tags')->nullable()->change();
            $table->json('expertise_tags')->nullable()->change();
            $table->json('tools_known')->nullable()->change();
            $table->json('skills')->nullable()->change();
            $table->json('languages')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('experts', function (Blueprint $table) {
            $table->string('tags')->nullable()->change();
            $table->string('expertise_tags')->nullable()->change();
            $table->string('tools_known')->nullable()->change();
            $table->string('skills')->nullable()->change();
            $table->string('languages')->nullable()->change();
        });
    }
};
