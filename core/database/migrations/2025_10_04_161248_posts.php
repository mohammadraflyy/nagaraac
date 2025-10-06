<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('client_name');
            $table->string('hash_name');
            $table->string('file_size');
            $table->string('file_format');
            $table->enum('media_type', ['promotions', 'post', 'galleries'])->default('post');
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('status', 20)->default('unpublished');
            $table->foreignId('users_id');
            $table->uuid('featured_media')->nullable();
            $table->longText('content');
            $table->timestamps();

            $table->foreign('featured_media')->references('id')->on('media')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
        Schema::dropIfExists('posts');
    }
};
