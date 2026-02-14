<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tools', function (Blueprint $table) {
            $table->id();

            // Ownership
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Basic Info
            $table->string('name');
            $table->string('category');
            $table->string('sub_category')->nullable();

            // Links & Pricing
            $table->string('affiliate_link')->nullable();
            $table->enum('pricing_type', ['free', 'freemium', 'paid', 'lifetime']);
            $table->string('pricing_details')->nullable();

            // Media
            $table->string('logo')->nullable();
            $table->string('demo_video')->nullable();
            $table->string('demo_video_link')->nullable();

            // Meta / SEO
            $table->string('tags')->nullable(); // comma separated
            $table->string('official_reviews_url')->nullable();
            $table->string('comparison_group')->nullable();
            $table->decimal('rating', 2, 1)->nullable(); // 4.6

            // Status
            $table->enum('status', ['pending', 'active', 'rejected'])->default('pending');

            // Content
            $table->text('use_cases')->nullable();
            $table->text('features')->nullable();
            $table->text('short_description');
            $table->longText('full_description');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tools');
    }
};
