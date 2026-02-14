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
        Schema::create('experts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('tags')->nullable();
            $table->string('expertise_tags')->nullable();
            $table->string('tools_known')->nullable();
            $table->string('skills')->nullable();
            $table->string('location')->nullable();
            $table->string('languages')->nullable();
            $table->string('rate')->nullable();
            $table->string('portfolio_url')->nullable();
            $table->text('short_bio')->nullable();
            $table->text('profile_bio')->nullable();
            $table->string('profile_file')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experts');
    }
};
